<?php

# CLASSE DATABASE PDO CRIADA POR KERLON PARA FACILITAR A EXECUÇÃO DE QUERIES NO BANCO DE DADOS

namespace Midspace;


use LDAP\Result;
use PDO;
use PDOException;
use stdClass;
use PDOStatement;



class Database
{

    // properties

    private $_host;
    private $_database;
    private $_username;
    private $_password;
    private $_return_type;
    protected $boundParameters = [];
    protected $parameters;
    public function __construct($cfg_options, $_return_type = 'object')
    {

        // set connections configurations

        $this->_host = $cfg_options['host'];
        $this->_database = $cfg_options['database'];
        $this->_username = $cfg_options['username'];
        $this->_password = $cfg_options['password'];
        $this->parameters = array(); 
        if (!empty($_return_type) && $_return_type == 'object') {

            $this->_return_type = PDO::FETCH_OBJ;
        } else {

            $this->_return_type = PDO::FETCH_ASSOC;
        }
    }

    public function bind($parameter, $value)
    {
        $this->boundParameters[$parameter] = $value;
        return $this;
    }
    protected function bindParameters(PDOStatement $statement)
    {
        foreach ($this->boundParameters as $parameter => $value) {
            
            $statement->bindValue($parameter, $value);
        }

        $this->boundParameters = [];
    }

    public function execute_query($sql, $parameters = null)
    {
        // execute a query with results
        $connection = new PDO(
            "mysql:host=" . $this->_host . ";dbname=" . $this->_database . ";charset=utf8",
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );
    
        try {
            $db = $connection->prepare($sql);
    
            // Bind parameters before executing the query
            $this->bindParameters($db);
    
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {
                $db->execute();
            }
    
            $results = $db->fetchAll($this->_return_type);
        } catch (PDOException $err) {
            //close connection
            $connection = null;
            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }
    
        // close connection
        $connection = null;
    
        return $this->_result('success', 'success', $sql, $results, $db->rowCount(), null);
    }
    public function execute_non_query($sql, $parameters = null)
    {

        //executes a query without results

        //connection

        $connection = new PDO(
            "mysql:host=" . $this->_host . ";dbname=" . $this->_database . ";charset=utf8",
            $this->_username,
            $this->_password,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //init transaction 

        $connection->beginTransaction();

        // prepare and execute the query
        try {

            $db = $connection->prepare($sql);
            if (!empty($parameters)) {
                $db->execute($parameters);
            } else {

                $db->execute();
            }

            // last inserted id
            $last_inserted_id = $connection->lastInsertId();

            //finish transaction
            $connection->commit();
        } catch (PDOException $err) {

            //undo all sql operations on error

            $connection->rollBack();



            //close connection
            $connection = null;



            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }

        //close connection
        $connection = null;


        return $this->_result('success', 'success', $sql, null, $db->rowCount(), $last_inserted_id);
    }
    public function insertWithCheck($tableName, $data)
    {
        $existingDataCheck = $this->checkDuplicateData($tableName, $data);

        if (!$existingDataCheck->status === 'error') {
            return $existingDataCheck;
        }

        if ($existingDataCheck->results) {
            return $this->_result('error', 'Os dados já existem na base.', null, null, 0, null);
        }

        $insertResult = $this->insertData($tableName, $data);

        return $insertResult;
    }

    private function checkDuplicateData($tableName, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(function ($value) {
            return "'" . $value . "'";
        }, $data));

        $sql = "SELECT * FROM $tableName WHERE $columns = $values";

        try {
            $result = $this->execute_query($sql);

            return $result;
        } catch (PDOException $err) {
            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }
    }

    private function insertData($tableName, $data)
    {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_map(function ($value) {
            return "'" . $value . "'";
        }, $data));

        $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

        try {
            $result = $this->execute_non_query($sql);
            return $result;
        } catch (PDOException $err) {
            return $this->_result('error', $err->getMessage(), $sql, null, 0, null);
        }
    }

    public function dataExists($tableName, $columnName, $value)
    {


        $sql = "SELECT * FROM $tableName WHERE $columnName = :value";

        try {
            $result = $this->execute_query($sql, array(':value' => $value));

            if ($result->status === 'success') {
                return count($result->results) > 0;
            } else {
                return false;
            }
        } catch (PDOException $err) {
            return false;
        }
    }
    public function toJson($result)
    {
        return json_encode($result, JSON_PRETTY_PRINT);
    }
    
    public function execute_query_and_get_json($sql, $parameters = null)
{
    $result = $this->execute_query($sql, $parameters);

    return $this->toJson($result);
}

    private function _result($status, $message, $sql, $results, $affected_rows, $last_id)
    {

        $tmp = new stdClass();
        $tmp->status = $status;
        $tmp->message = $message;
        $tmp->query = $sql;
        $tmp->results = $results;
        $tmp->affected_rows = $affected_rows;
        $tmp->last_id = $last_id;

        return $tmp;
    }
}

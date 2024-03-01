<?php
require "./src/SupAid.php";
use HelpersClass\SupAid;

$h = new SupAid();
// Exemplo de uso do método encodeURL
$texto_original = 'test';
$url_codificada = $h->encodeURL($texto_original);
echo 'Texto Original: ' . $texto_original . '<br>';
echo 'URL Codificada: ' . $url_codificada . '<br>';

// Exemplo de uso do método decodeURL
$url_decodificada = $h->decodeURL($url_codificada);
echo ' ' . $url_decodificada . '<br>';

<?php
$dataString = "12/12/2024";

// Converter a string da data para um objeto DateTime
$dataObj = DateTime::createFromFormat('d \d\e e \of F \d\e Y', $dataString);

// Verificar se a conversão foi bem-sucedida
if ($dataObj !== false) {
    // Definir o fuso horário para São Paulo
    $dataObj->setTimezone(new DateTimeZone('America/Sao_Paulo'));

    // Formatar a data para a escrita em português
    $dataFormatada = $dataObj->format('d \de F \de Y');
    echo $dataFormatada; // Saída: "12 de dezembro de 2024"
} else {
    echo "Formato de data inválido.";
}
?>

<?php

require_once 'app/db.php';
require_once 'app/periodo.php';

$con = connect();
$stmt = $con->query('SELECT DISTINCT periodo FROM despesas ORDER BY periodo ASC');
$periodos = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

foreach ($periodos as $p) {
    $periodo = int2periodo($p);
    
// Inicializa uma sessão cURL
    $ch = curl_init();

// Define a URL da página que você deseja acessar
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/index.php?periodo=".$periodo);

// Define a opção para retornar o resultado como uma string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a sessão cURL e armazena o resultado na variável $html
    $html = curl_exec($ch);

// Fecha a sessão cURL
    curl_close($ch);

// Agora a variável $html contém o código fonte da página HTML
    file_put_contents("docs/$periodo.html", $html);
}
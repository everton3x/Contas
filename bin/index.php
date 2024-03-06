<?php
// Inicializa uma sessão cURL
$ch = curl_init();

// Define a URL da página que você deseja acessar
curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/index.php");

// Define a opção para retornar o resultado como uma string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a sessão cURL e armazena o resultado na variável $html
$html = curl_exec($ch);

// Fecha a sessão cURL
curl_close($ch);

// Agora a variável $html contém o código fonte da página HTML
file_put_contents('docs/index.html', $html);

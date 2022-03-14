<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);

if (key_exists('periodo', $_POST)) {
    $periodo = $_POST['periodo'];
} else {
    trigger_error("Período não informado.", E_USER_ERROR);
}

if (key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
    $descricao = $_POST['descricao'];
} else {
    trigger_error("Descrição não informada.", E_USER_ERROR);
}

if (key_exists('devedor', $_POST) && strlen($_POST['devedor']) > 0) {
    $devedor = $_POST['devedor'];
} else {
    trigger_error("Devedor não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('vencimento', $_POST)) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '';
}

if (key_exists('agrupador', $_POST)) {
    $agrupador = $_POST['agrupador'];
} else {
    $agrupador = '';
}

if (key_exists('localizador', $_POST)) {
    $localizador = $_POST['localizador'];
} else {
    $localizador = '';
}

if (key_exists('recebido', $_POST)) {
    $recebido = $_POST['recebido'];
} else {
    $recebido = '';
}

$cod = receita_adicionar($periodo, $descricao, $devedor, $valor, $vencimento, $agrupador, $localizador, $recebido);
$receita = receita_detalhes($cod);
//print_r($receita);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_adicionar.php">Novo</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <table class="table">
        <tbody>
            <tr>
                <td>Código</td>
                <td><?= $receita['cod']; ?></td>
            </tr>
            <tr>
                <td>Período</td>
                <td><?= format_periodo(int2periodo($receita['periodo'])); ?></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><?= $receita['descricao']; ?></td>
            </tr>
            <tr>
                <td>Devedor</td>
                <td><?= $receita['devedor']; ?></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><?= currency($receita['valor']); ?></td>
            </tr>
            <tr>
                <td>Vencimento</td>
                <td><?= format_date($receita['vencimento']); ?></td>
            </tr>
            <tr>
                <td>Agrupador</td>
                <td><?= $receita['agrupador']; ?></td>
            </tr>
            <tr>
                <td>Localizador</td>
                <td><?= $receita['localizador']; ?></td>
            </tr>
            <tr>
                <td>Recebido em</td>
                <td><?= format_date($recebido); ?></td>
            </tr>
        </tbody>
    </table>
</main>


<?php require '../tpl/pagef.php'; ?>
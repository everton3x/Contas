<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);
if (key_exists('cod', $_POST)) {
    $cod = (int) $_POST['cod'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

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

if (key_exists('valor', $_POST)) {
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
$anterior = receita_detalhes($cod);
receita_alterar($cod, $periodo, $descricao, $devedor, $valor, $vencimento, $agrupador, $localizador);
$receita = receita_detalhes($cod);
//print_r($receita);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?=$cod;?>">Detalhes</a>
    <a class="item" href="receita_editar.php?receita=<?=$cod;?>">Editar</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <table class="table">
        <tbody>
            <tr>
                <td>Código</td>
                <td><?= $receita['cod']; ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Período</td>
                <td>de <?= format_periodo(int2periodo($anterior['periodo'])); ?></td>
                <td>para <?= format_periodo(int2periodo($receita['periodo'])); ?></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td>de <?= $anterior['descricao']; ?></td>
                <td>para <?= $receita['descricao']; ?></td>
            </tr>
            <tr>
                <td>Devedor</td>
                <td>de <?= $anterior['devedor']; ?></td>
                <td>para <?= $receita['devedor']; ?></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>de <?= currency($anterior['valor']); ?></td>
                <td>para <?= currency($receita['valor']); ?></td>
            </tr>
            <tr>
                <td>Vencimento</td>
                <td>de <?= format_date($anterior['vencimento']); ?></td>
                <td>para <?= format_date($receita['vencimento']); ?></td>
            </tr>
            <tr>
                <td>Agrupador</td>
                <td>de <?= $anterior['agrupador']; ?></td>
                <td>para <?= $receita['agrupador']; ?></td>
            </tr>
            <tr>
                <td>Localizador</td>
                <td>de <?= $anterior['localizador']; ?></td>
                <td>para <?= $receita['localizador']; ?></td>
            </tr>
        </tbody>
    </table>
</main>


<?php require '../tpl/pagef.php'; ?>
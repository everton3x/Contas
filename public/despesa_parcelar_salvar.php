<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

//print_r($_POST);
//exit();

if (key_exists('periodo', $_POST)) {
    $periodo = $_POST['periodo'];
} else {
    trigger_error("Período não informado.", E_USER_ERROR);
}

if (key_exists('parcela', $_POST)) {
    $parcela = $_POST['parcela'];
} else {
    trigger_error("Parcelas não informado.", E_USER_ERROR);
}

if (key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
    $descricao = $_POST['descricao'];
} else {
    trigger_error("Descrição não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('gastoem', $_POST)) {
    $gastoem = $_POST['gastoem'];
} else {
    trigger_error("Data do gasto não informada.", E_USER_ERROR);
}

if (key_exists('mp', $_POST)) {
    $mp = $_POST['mp'];
} else {
    trigger_error("Meio de pagamento não informado.", E_USER_ERROR);
}

if (key_exists('observacao_gasto', $_POST)) {
    $observacao = $_POST['observacao_gasto'];
} else {
    $observacao = '';
}

if (key_exists('credor', $_POST)) {
    $credor = $_POST['credor'];
} else {
    trigger_error("Credor não informado.", E_USER_ERROR);
}

if (key_exists('vencimento', $_POST)) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '';
}

if (key_exists('agrupador', $_POST)) {
    $agrupador = $_POST['agrupador'];
} else {
    trigger_error("Agrupador não informado.", E_USER_ERROR);
}

if (key_exists('localizador', $_POST)) {
    $localizador = $_POST['localizador'];
} else {
    $localizador = '';
}

$cod = despesa_parcelar($periodo, $descricao, $credor, $valor, $vencimento, $agrupador, $localizador, $gastoem, $mp, $descricao);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="javascript:history.back();">Parcelar</a>
    <a class="item">Conferir</a>
</nav>

<main class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cod as $parc => $item): ?>
            <?php
            $despesa = despesa_detalhes($item);
            ?>
                <tr>
                    <td><?= $parc; ?></td>
                    <td><?= $despesa['cod']; ?></td>
                    <td><?= format_periodo(int2periodo($despesa['periodo'])); ?></td>
                    <td><?= $despesa['descricao']; ?></td>
                    <td><?= currency($despesa['valor']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<?php require '../tpl/pagef.php'; ?>
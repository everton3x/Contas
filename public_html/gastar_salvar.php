<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

//print_r($_POST);
//exit();

if (key_exists('cod', $_POST)) {
    $cod = $_POST['cod'];
} else {
    trigger_error("Código da despesa não informado.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('gasto', $_POST)) {
    $gastoem = $_POST['gasto'];
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

if (key_exists('vencimento', $_POST) && strlen($_POST['vencimento']) > 0) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '0000-00-00';
}

if (key_exists('pagar', $_POST) && strlen($_POST['pagar']) > 0) {
    $pagoem = $gastoem;
} else {
    $pagoem = '0000-00-00';
}

if (key_exists('observacao_pgto', $_POST)) {
    $observacao_pgto = $_POST['observacao_pgto'];
} else {
    $observacao_pgto = '';
}

$gasto = gastar($cod, $gastoem, $observacao, $valor, $credor, $mp, $vencimento, $agrupador, $localizador, $pagoem, $observacao_pgto);
$despesa = despesa_detalhes($cod);
$detalhesGasto = gasto_detalhes($gasto);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?= $cod; ?>">Detalhes</a>
    <a class="item" href="gastos.php">Gastos</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <table class="table">
        <tbody>
            <tr>
                <td>Código</td>
                <td><?= $despesa['cod']; ?></td>
            </tr>
            <tr>
                <td>Período</td>
                <td><?= format_periodo(int2periodo($despesa['periodo'])); ?></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><?= $despesa['descricao']; ?></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><?= currency($despesa['valor']); ?></td>
            </tr>
        </tbody>
    </table>
</main>

<?php if ($detalhesGasto !== false): ?>
    <main class="container">
        <table class="table">
            <caption>Gasto</caption>
            <tbody>
                <tr>
                    <td>Código</td>
                    <td><?= $detalhesGasto['cod']; ?></td>
                </tr>
                <tr>
                    <td>Gasto em</td>
                    <td><?= format_date($detalhesGasto['gastoem']); ?></td>
                </tr>
                <tr>
                    <td>Observação</td>
                    <td><?= $detalhesGasto['observacao']; ?></td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td><?= currency($detalhesGasto['valor']); ?></td>
                </tr>
                <tr>
                    <td>Credor</td>
                    <td><?= $detalhesGasto['credor']; ?></td>
                </tr>
                <tr>
                    <td>Meio de pagamento</td>
                    <td><?= $detalhesGasto['mp']; ?></td>
                </tr>
                <tr>
                    <td>Vencimento</td>
                    <td><?= format_date($detalhesGasto['vencimento']); ?></td>
                </tr>
                <tr>
                    <td>Agrupador</td>
                    <td><?= $detalhesGasto['agrupador']; ?></td>
                </tr>
                <tr>
                    <td>Localizador</td>
                    <td><?= $detalhesGasto['localizador']; ?></td>
                </tr>
                <tr>
                    <td>Pago em</td>
                    <td><?= format_date($detalhesGasto['pagoem']); ?></td>
                </tr>
                <tr>
                    <td>Observação do pagamento</td>
                    <td><?= $detalhesGasto['observacao_pgto']; ?></td>
                </tr>
            </tbody>
        </table>
    </main>
<?php endif; ?>


<?php require '../tpl/pagef.php'; ?>
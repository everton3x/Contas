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
    trigger_error('Nenhum gasto informado.', E_USER_ERROR);
}

if (key_exists('pagoem', $_POST)) {
    $pagoem = $_POST['pagoem'];
} else {
    trigger_error('Data do pagamento não informada.', E_USER_ERROR);
}

if (key_exists('observacao_pgto', $_POST)) {
    $observacao_pgto = $_POST['observacao_pgto'];
} else {
    $observacao_pgto = '';
}


pagar($cod, $pagoem, $observacao_pgto);
$gasto = gasto_detalhes($cod);
$despesa = despesa_detalhes($gasto['despesa']);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?= $despesa['cod']; ?>">Despesa</a>
    <a class="item" href="gastos.php">Gastos</a>
    <a class="item" href="javascript:history.back();">Pagar</a>
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

<?php if ($gasto !== false): ?>
    <main class="container">
        <table class="table">
            <caption>Gasto</caption>
            <tbody>
                <tr>
                    <td>Código</td>
                    <td><?= $gasto['cod']; ?></td>
                </tr>
                <tr>
                    <td>Gasto em</td>
                    <td><?= format_date($gasto['gastoem']); ?></td>
                </tr>
                <tr>
                    <td>Observação</td>
                    <td><?= $gasto['observacao']; ?></td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td><?= currency($gasto['valor']); ?></td>
                </tr>
                <tr>
                    <td>Credor</td>
                    <td><?= $gasto['credor']; ?></td>
                </tr>
                <tr>
                    <td>Meio de pagamento</td>
                    <td><?= $gasto['mp']; ?></td>
                </tr>
                <tr>
                    <td>Vencimento</td>
                    <td><?= format_date($gasto['vencimento']); ?></td>
                </tr>
                <tr>
                    <td>Agrupador</td>
                    <td><?= $gasto['agrupador']; ?></td>
                </tr>
                <tr>
                    <td>Localizador</td>
                    <td><?= $gasto['localizador']; ?></td>
                </tr>
                <tr>
                    <td>Pago em</td>
                    <td><?= format_date($gasto['pagoem']); ?></td>
                </tr>
                <tr>
                    <td>Observação do pagamento</td>
                    <td><?= $gasto['observacao_pgto']; ?></td>
                </tr>
            </tbody>
        </table>
    </main>
<?php endif; ?>


<?php require '../tpl/pagef.php'; ?>
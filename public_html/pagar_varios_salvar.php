<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

//print_r($_POST);
//exit();

if (key_exists('cod', $_POST)) {
    $lista = $_POST['cod'];
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

$total = 0.0;
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?= $despesa['cod']; ?>">Despesa</a>
    <a class="item" href="gastos.php">Gastos</a>
    <a class="item" href="javascript:history.back();">Pagar vários</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <table class="table">
                <thead>
                    <tr>
                        <th>Período</th>
                        <th>Despesa</th>
                        <th>Gasto</th>
                        <th>Gasto em</th>
                        <th>Meio de pagamento</th>
                        <th>Valor</th>
                        <th>Pago em</th>
                        <th>Observação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista as $item):?>
                    <?php
                        pagar($item, $pagoem, $observacao_pgto);
                        $gasto = gasto_detalhes($item);
                        $despesa = despesa_detalhes($gasto['despesa']);
                        $total += $gasto['valor'];
                    ?>
                        <tr>
                            <td><?= int2periodo($despesa['periodo']);?></td>
                            <td><?=$despesa['descricao'];?></td>
                            <td><?=$gasto['observacao'];?></td>
                            <td><?= format_date($gasto['gastoem']);?></td>
                            <td><?=$gasto['mp'];?></td>
                            <td class="text align right"><?= currency($gasto['valor']);?></td>
                            <td><?= format_date($pagoem);?></td>
                            <td><?=$observacao_pgto;?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th class="text align right"><?=currency($total);?></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
</main>


<?php require '../tpl/pagef.php'; ?>
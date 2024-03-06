<?php
require '../tpl/pageh.php';

require_once '../app/valor.php';
require_once '../app/mp.php';
require_once '../app/despesa.php';

if(key_exists('mp', $_GET)){
    $mp = $_GET['mp'];
}else{
    trigger_error('Meio de pagamento não informado.', E_USER_ERROR);
}

$gastos = gastos_filtrar('0000-00', '9999-12', '0000-00-00', '9999-12-31', '0000-00-00', '9999-12-31', '0000-00-00', '9999-12-31', '%', '%', '%', $mp, PHP_INT_MIN, PHP_INT_MAX, '%', '%');

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item" href="mps.php">Meio de pagamento</a>
    <a class="item"><?=$mp;?></a>
</nav>


<div class="container" style="margin: 1em;">
    <table class="table" style="margin-left: auto; margin-right: auto;">
        <caption>Despesas</caption>
        <thead>
            <tr>
                <th>*</th>
                <th>?</th>
                <th>Cód</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Gasto em</th>
                <th>Observação</th>
                <th>Valor</th>
                <th>Credor</th>
                <th>MP</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
                <th>Pago em</th>
                <th>Obs. Pgto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $item): ?>
                <tr>
                    <td>
                        <input type="radio" name="cod" form="processar_gasto" value="<?=$item['cod'];?>">
                    </td>
                    <td>
                        <?php if($item['pagoem'] === '0000-00-00'):?>
                            <input type="checkbox" name="cod[<?=$item['cod'];?>]" form="pagar_varios" value="<?=$item['cod'];?>">
                        <?php endif;?>
                    </td>
                    <td style="text-align: right"><?= $item['cod']; ?></td>
                    <td style="text-align: right"><?= format_periodo(int2periodo($item['periodo'])); ?></td>
                    <td>
                        <a href="despesa_detalhes.php?despesa=<?= $item['despesa']; ?>"><?= $item['descricao']; ?></a>
                    </td>
                    <td><?= format_date($item['gastoem']);?></td>
                    <td><?= $item['observacao'];?></td>
                    <td style="text-align: right"><?= currency($item['valor']); ?></td>
                    <td><?= $item['credor'];?></td>
                    <td><?= $item['mp'];?></td>
                    <td><?= format_date($item['vencimento']);?></td>
                    <td><?= $item['agrupador'];?></td>
                    <td><?= $item['localizador'];?></td>
                    <td><?= format_date($item['pagoem']);?></td>
                    <td><?= $item['observacao_pgto'];?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="13">
                    <form id="processar_gasto" class="buttons">
                        <button type="submit" class="button primary" formaction="pagar.php" formmethod="GET">Pagar</button>
                        <button type="submit" class="button" formaction="gasto_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="gasto_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
                <td colspan="2">
                    <form id="pagar_varios" class="buttons">
                        <button type="submit" class="button primary" formaction="pagar_varios.php" formmethod="POST">Pagar Vários</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<?php require '../tpl/pagef.php'; ?>
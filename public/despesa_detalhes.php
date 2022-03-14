<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

//print_r($_POST);

if (key_exists('despesa', $_GET)) {
    $cod = $_GET['despesa'];
} else {
    trigger_error("Despesa não informada.", E_USER_ERROR);
}

$despesa = despesa_detalhes($cod);
//print_r($receita);
$previsto = $despesa['valor'];
$total_gasto = total_gasto($cod);
$agastar = round($previsto - $total_gasto, 2);
$total_pago = total_pago($cod);
$apagar = round($previsto - $total_pago, 2);
$gastos = gastos_listar($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item">Detalhes</a>
</nav>

<article class="panel">
    <header class="title">Detalhes da Despesa</header>
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
        </tbody>
    </table>
</article>

<article class="panel">
    <header class="title">Valores</header>
    <table class="table">
        <tbody>
            <tr>
                <td>Previsto</td>
                <td class="text align right"><?= currency($previsto); ?></td>
            </tr>
            <tr>
                <td>Gasto</td>
                <td class="text align right"><?= currency($total_gasto); ?></td>
            </tr>
            <tr>
                <td>A gastar</td>
                <td class="text align right"><?= currency($agastar); ?></td>
            </tr>
            <tr>
                <td>Pago</td>
                <td class="text align right"><?= currency($total_pago); ?></td>
            </tr>
            <tr>
                <td>A pagar</td>
                <td class="text align right"><?= currency($apagar); ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <form class="buttons">
                        <input type="hidden" value="<?=$cod;?>" name="despesa">
                        <button type="submit" class="button primary" formaction="gastar.php" formmethod="GET">Gastar</button>
                        <button type="submit" class="button" formaction="despesa_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="despesa_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</article>

<article class="panel">
    <header class="title">Gastos</header>
    <table class="table">
        <thead>
            <tr>
                <th>*</th>
                <th>Cód.</th>
                <th>Gasto em</th>
                <th>Observação</th>
                <th>Valor</th>
                <th>Credor</th>
                <th>MP</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
                <th>Pago em</th>
                <th>Obs. Pgto.</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $item): ?>
            <tr>
                <td>
                    <input type="radio" name="cod" value="<?=$item['cod'];?>" form="processar_gasto">
                </td>
                <td><?=$item['cod'];?></td>
                <td><?= format_date($item['gastoem']);?></td>
                <td><?=$item['observacao'];?></td>
                <td><?= currency($item['valor']);?></td>
                <td><?=$item['credor'];?></td>
                <td><?=$item['mp'];?></td>
                <td><?= format_date($item['vencimento']);?></td>
                <td><?=$item['agrupador'];?></td>
                <td><?=$item['localizador'];?></td>
                <td><?= format_date($item['pagoem']);?></td>
                <td><?=$item['observacao_pgto'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="12">
                    <form id="processar_gasto" class="buttons">
                        <input type="hidden" value="<?=$cod;?>" name="despesa">
                        <button type="submit" class="button primary" formaction="gasto_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button" formaction="pagar.php" formmethod="GET">Pagar</button>
                        <button type="submit" class="button error" formaction="gasto_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</article>

<?php require '../tpl/pagef.php'; ?>
<?php
require 'pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

if (key_exists('periodo', $_GET)) {
    $periodo = $_GET['periodo'];
} else {
    $periodo = date('Y-m');
}

$anterior = periodo_anterior($periodo);
$posterior = periodo_posterior($periodo);

$receitas = receitas_periodo($periodo);
$despesas = despesas_periodo($periodo);
?>

<div class="text align center">
    <nav class="pager">
        <a class="item" href="<?= $anterior; ?>.html"><?= format_periodo($anterior); ?></a>
        <a class="item">
            <?= format_periodo($periodo); ?>
            <?php if(!periodo_aberto($periodo)):?>
             [fechado]
            <?php endif;?>
        </a>
        <a class="item" href="<?= $posterior; ?>.html"><?= format_periodo($posterior); ?></a>
    </nav>
</div>

<article class="panel">
    <header class="title text align center">
        Receitas
    </header>
    <table class="table" style="width: 100%">
        <colgroup>
            <col style="width: 60%">
            <col>
            <col>
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>Receita</th>
                <th>Previsto</th>
                <th>Recebido</th>
                <th>A receber</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalReceita= 0.0;
            $totalRecebido = 0.0;
            $totalAReceber = 0.0;
            ?>
            <?php foreach ($receitas as $item): ?>
                <?php
                $detalhes = receita_detalhes($item['cod']);
                $recebido = total_recebido($detalhes['cod']);
                $areceber = round($detalhes['valor'] - $recebido, 2);
                $totalReceita += $detalhes['valor'];
                $totalRecebido += $recebido;
                $totalAReceber += $areceber;
                ?>
                <tr>
                    <td><a href="receita/=<?= $detalhes['cod']; ?>.html"><?= $detalhes['descricao']; ?></a></td>
                    <td class="text align right"><?= currency($detalhes['valor']); ?></td>
                    <td class="text align right"><?= currency($recebido); ?></td>
                    <td class="text align right"><?= currency($areceber); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th class="text align right">Total</th>
                <th class="text align right"><?= currency($totalReceita); ?></th>
                <th class="text align right"><?= currency($totalRecebido); ?></th>
                <th class="text align right"><?= currency($totalAReceber); ?></th>
            </tr>
        </tfoot>
    </table>
</article>

<article class="panel">
    <header class="title text align center">
        Despesas
    </header>
    <table class="table" style="width: 100%">
        <colgroup>
            <col style="width: 60%">
            <col>
            <col>
            <col>
        </colgroup>
        <thead>
            <tr>
                <th>Despesa</th>
                <th>Previsto</th>
                <th>Gasto</th>
                <th>A gastar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalDespesa = 0.0;
            $totalGasto = 0.0;
            $totalAGastar = 0.0;
            ?>
            <?php foreach ($despesas as $item): ?>
                <?php
                $detalhes = despesa_detalhes($item['cod']);
                $gasto = total_gasto($detalhes['cod']);
                $agastar = round($detalhes['valor'] - $gasto, 2);
                $totalDespesa += $detalhes['valor'];
                $totalGasto += $gasto;
                $totalAGastar += $agastar;
                ?>
                <tr>
                    <td><a href="despesa/<?= $detalhes['cod']; ?>.html"><?= $detalhes['descricao']; ?></a></td>
                    <td class="text align right"><?= currency($detalhes['valor']); ?></td>
                    <td class="text align right"><?= currency($gasto); ?></td>
                    <td class="text align right"><?= currency($agastar); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th class="text align right"><?= currency($totalDespesa); ?></th>
                <th class="text align right"><?= currency($totalGasto); ?></th>
                <th class="text align right"><?= currency($totalAGastar); ?></th>
            </tr>
        </tfoot>
    </table>
</article>

<?php
$resultadoPeriodo = round($totalReceita - $totalDespesa, 2);
$resultadoAnterior = resultado_anterior($periodo);
//echo "<h1>$resultadoAnterior</h1>";
//echo "<h1>$periodo</h1>";
//var_dump(periodo_aberto($periodo));
//if(periodo_aberto($periodo)){
if(periodo_aberto($anterior)){
    if($resultadoAnterior > 0){
        $resultadoAnterior = 0.0;
    }
}
//echo "<h1>$resultadoAnterior</h1>";
$resultadoAcumulado = round($resultadoPeriodo + $resultadoAnterior, 2);

?>
<article class="panel">
    <header class="title text align center">
        Resultados
    </header>
    <table class="table" style="width: 100%">
        <colgroup>
            <col style="width: 60%">
            <col>
        </colgroup>
        <tbody>
            <tr>
                <td>Resultado do Período</td>
                <td class="text align right"><?=currency($resultadoPeriodo);?></td>
            </tr>
            <tr>
                <td>Resultado Anterior</td>
                <td class="text align right"><?=currency($resultadoAnterior);?></td>
            </tr>
            <tr>
                <td>Resultado Acumulado</td>
                <td class="text align right"><?=currency($resultadoAcumulado);?></td>
            </tr>
        </tbody>
    </table>
</article>

<?php require 'pagef.php'; ?>
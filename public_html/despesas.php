<?php
require '../tpl/pageh.php';

require_once '../app/despesa.php';
require_once '../app/periodo.php';
require_once '../app/valor.php';

$periodoInicial = $_GET['periodoInicial'] ?? date('Y-m');
$periodoFinal = $_GET['periodoFinal'] ?? date('Y-m');
$descricao = $_GET['descricao'] ?? '%';
$valorInicial = $_GET['valorInicial'] ?? PHP_INT_MIN;
$valorFinal = $_GET['valorFinal'] ?? PHP_INT_MAX;

$despesas = despesas_listar($periodoInicial, $periodoFinal, $descricao, $valorInicial, $valorFinal);
//$despesas = [];
//print_r($receitas);

$totalPrevisto = 0.0;
$totalGasto = 0.0;
$totalAGastar = 0.0;
$totalPago = 0.0;
$totalAPagar = 0.0;
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item">Despesas</a>
</nav>

<div class="container" style="display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch; align-content: stretch; gap: 1em; margin: 1em;">
    <aside class="menu">
        <header class="title">Operações</header>
        <a class="item" href="despesa_adicionar.php">Novo</a>
        <a class="item" href="despesa_repetir.php">Repetir</a>
        <a class="item" href="despesa_parcelar.php">Parcelar</a>
        <a class="item" href="gastos.php">Gastos</a>
    </aside>

    <aside style="flex-grow: 2;">
        <form method="GET" class="panel">
            <header class="title">Filtros</header>
            <div class="container" style="display: flex; flex-flow: row wrap;">
                <fieldset class="fields">
                    <legend>Período</legend>
                    <div class="field">
                        <label for="periodoInicial">Início</label>
                        <input type="month" id="periodoInicial" name="periodoInicial" value="<?= $periodoInicial; ?>">
                    </div>
                    <div class="field">
                        <label for="periodoFinal">Fim</label>
                        <input type="month" id="periodoFinal" name="periodoFinal" value="<?= $periodoFinal; ?>">
                    </div>
                </fieldset>
                <fieldset class="fields">
                    <legend>Valor</legend>
                    <div class="field">
                        <label for="valorInicial">Inicial</label>
                        <input type="number" id="valorInicial" name="valorInicial" value="<?= $valorInicial; ?>" step="0.01" style="width: 7em">
                    </div>
                    <div class="field">
                        <label for="valorFinal">Final</label>
                        <input type="number" id="valorFinal" name="valorFinal" value="<?= $valorFinal; ?>" step="0.01" style="width: 7em">
                    </div>
                </fieldset>
            </div>
            <footer class="buttons">
                <button class="button primary" type="submit">Filtrar</button>
                <button class="button" type="submit" formaction="despesas.php" formmethod="POST">Limpar</button>
            </footer>
        </form>
    </aside>
</div>

<div class="container" style="margin: 1em;">
    <table class="table" style="margin-left: auto; margin-right: auto;">
        <caption>Despesas</caption>
        <thead>
            <tr>
                <th>*</th>
                <th>Cód</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Previsto</th>
                <th>Gasto</th>
                <th>A gastar</th>
                <th>Pago</th>
                <th>A pagar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($despesas as $item): ?>
                <?php
                $gasto = total_gasto($item['cod']);
                $agastar = $item['valor'] - $gasto;
                $pago = total_pago($item['cod']);
                $apagar = $gasto - $pago;
                $totalPrevisto += $item['valor'];
                $totalGasto += $gasto;
                $totalAGastar += $agastar;
                $totalPago += $pago;
                $totalAPagar += $apagar;
                ?>
                <tr>
                    <td>
                        <input type="radio" name="despesa" form="processar_despesa" value="<?= $item['cod']; ?>">
                    </td>
                    <td style="text-align: right"><?= $item['cod']; ?></td>
                    <td style="text-align: right"><?= format_periodo(int2periodo($item['periodo'])); ?></td>
                    <td>
                        <a href="despesa_detalhes.php?despesa=<?= $item['cod']; ?>"><?= $item['descricao']; ?></a>
                    </td>
                    <td style="text-align: right"><?= currency($item['valor']); ?></td>
                    <td style="text-align: right">
                        <?= currency($gasto); ?>
                    </td>
                    <td style="text-align: right">
                        <a href="gastar.php?despesa=<?= $item['cod']; ?>"><?= currency($agastar); ?></a>
                    </td>
                    <td style="text-align: right">
                        <?= currency($pago); ?>
                    </td>
                    <td style="text-align: right">
                        <?= currency($apagar); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th style="text-align: right;"><?=currency($totalPrevisto);?></th>
                <th style="text-align: right;"><?=currency($totalGasto);?></th>
                <th style="text-align: right;"><?=currency($totalAGastar);?></th>
                <th style="text-align: right;"><?=currency($totalPago);?></th>
                <th style="text-align: right;"><?=currency($totalAPagar);?></th>
            </tr>
        </tfoot>
    </table>
    <form id="processar_despesa" class="buttons">
        <button type="submit" class="button primary" formaction="gastar.php" formmethod="GET">Gastar</button>
        <button type="submit" class="button" formaction="despesa_detalhes.php" formmethod="GET">Detalhes</button>
        <button type="submit" class="button" formaction="despesa_editar.php" formmethod="GET">Editar</button>
        <button type="submit" class="button error" formaction="despesa_apagar.php" formmethod="GET">Apagar</button>
    </form>
</div>

<?php require '../tpl/pagef.php'; ?>
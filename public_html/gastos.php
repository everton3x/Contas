<?php
require '../tpl/pageh.php';

require_once '../app/despesa.php';
require_once '../app/periodo.php';
require_once '../app/valor.php';
require_once '../app/pessoas.php';
require_once '../app/agrupador.php';
require_once '../app/localizador.php';
require_once '../app/mp.php';


$periodoInicial = $_GET['periodoInicial'] ?? date('Y-m');
$periodoFinal = $_GET['periodoFinal'] ?? date('Y-m');
$gastoemInicial = $_GET['gastoemInicial'] ?? '0000-00-00';
$gastoemFinal = $_GET['gastoemFinal'] ?? '9999-12-31';
$vencimentoInicial = $_GET['vencimentoInicial'] ?? '0000-00-00';
$vencimentoFinal = $_GET['vencimentoFinal'] ?? '9999-12-31';
$pagoemInicial = $_GET['pagoemInicial'] ?? '0000-00-00';
$pagoemFinal = $_GET['pagoemFinal'] ?? '9999-12-31';
$observacao = $_GET['observacao'] ?? '%';
$observacao_pgto = $_GET['observacao_pgto'] ?? '%';
$credor = $_GET['credor'] ?? '%';
$mp = $_GET['mp'] ?? '%';
$agrupador = $_GET['agrupador'] ?? '%';
$localizador = $_GET['localizador'] ?? '%';
$valorInicial = $_GET['valorInicial'] ?? PHP_INT_MIN;
$valorFinal = $_GET['valorFinal'] ?? PHP_INT_MAX;

$gastos = gastos_filtrar($periodoInicial, $periodoFinal, $gastoemInicial, $gastoemFinal, $vencimentoInicial, $vencimentoFinal, $pagoemInicial, $pagoemFinal, $observacao, $observacao_pgto, $credor, $mp, $valorInicial, $valorFinal, $agrupador, $localizador);
//print_r($gastos);
//exit();
$totalGasto = 0.0;
$totalPago = 0.0;
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item">Gastos</a>
</nav>

<div class="container" style="display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch; align-content: stretch; gap: 1em; margin: 1em;">
    <aside>
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
                    <legend>Gasto em</legend>
                    <div class="field">
                        <label for="gastoemInicial">Início</label>
                        <input type="date" id="gastoemInicial" name="gastoemInicial" value="<?= $gastoemInicial; ?>">
                    </div>
                    <div class="field">
                        <label for="gastoemFinal">Fim</label>
                        <input type="date" id="gastoemFinal" name="gastoemFinal" value="<?= $gastoemFinal; ?>">
                    </div>
                </fieldset>
                <fieldset class="fields">
                    <legend>Vencimento</legend>
                    <div class="field">
                        <label for="vencimentoInicial">Início</label>
                        <input type="date" id="vencimentoInicial" name="vencimentoInicial" value="<?= $vencimentoInicial; ?>">
                    </div>
                    <div class="field">
                        <label for="vencimentoFinal">Fim</label>
                        <input type="date" id="vencimentoFinal" name="vencimentoFinal" value="<?= $vencimentoFinal; ?>">
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
                <fieldset class="fields">
                    <legend>Observação/Credor/Meio de pagamento</legend>
                    <div class="field">
                        <label for="observacao">Observação</label>
                        <input type="search" id="observacao" name="observacao" value="<?= $observacao; ?>">
                    </div>
                    <div class="field">
                        <label for="credor">Credor</label>
                        <input type="search" id="credor" name="credor" value="<?= $credor; ?>" list="credores" autocomplete="off">
                    </div>
                    <div class="field">
                        <label for="mp">Meio de pagamento</label>
                        <input type="search" id="mp" name="mp" value="<?= $mp; ?>" list="mps" autocomplete="off">
                    </div>
                </fieldset>
                <fieldset class="fields">
                    <legend>Pagamento</legend>
                    <div class="field">
                        <label for="pagoemInicial">Início</label>
                        <input type="date" id="pagoemInicial" name="pagoemInicial" value="<?= $pagoemInicial; ?>">
                    </div>
                    <div class="field">
                        <label for="pagoemFinal">Fim</label>
                        <input type="date" id="pagoemFinal" name="pagoemFinal" value="<?= $pagoemFinal; ?>">
                    </div>
                    <div class="field">
                        <label for="observacao_pgto">Observação</label>
                        <input type="search" id="observacao_pgto" name="observacao_pgto" value="<?= $observacao_pgto; ?>">
                    </div>
                </fieldset>
                <fieldset class="fields">
                    <legend>Agrupador/Localizador</legend>
                    <div class="field">
                        <label for="agrupador">Agrupador</label>
                        <input type="search" id="agrupador" name="agrupador" value="<?= $agrupador; ?>" list="agrupadores" autocomplete="off">
                    </div>
                    <div class="field">
                        <label for="localizador">Localizador</label>
                        <input type="search" id="localizador" name="localizador" value="<?= $localizador; ?>" list="localizadores" autocomplete="off">
                    </div>
                </fieldset>
            </div>
            <footer class="buttons">
                <button class="button primary" type="submit">Filtrar</button>
                <button class="button" type="submit" formaction="gastos.php" formmethod="POST">Limpar</button>
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
            <?php
            $totalGasto += $item['valor'];
            if($item['pagoem'] != '0000-00-00'){
                $totalPago += $item['valor'];
            }
            ?>
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
                <tr>
                    <th colspan="7">
                        Total gasto:
                    </th>
                    <th style="text-align: right;"><?=currency($totalGasto);?></th>
                    <th colspan="4">Total pago:</th>
                    <th style="text-align: right;"><?=currency($totalPago);?></th>
                    <th>Total a pagar:</th>
                    <th style="text-align: right;"><?=currency($totalGasto - $totalPago);?></th>
                </tr>
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

<datalist id="credores">
    <?php foreach (pessoas_listar() as $item): ?>
        <option value="<?=$item['pessoa'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="localizadores">
    <?php foreach (localizadores_listar() as $item): ?>
        <option value="<?=$item['localizador'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="agrupadores">
    <?php foreach (agrupadores_listar() as $item): ?>
        <option value="<?=$item['agrupador'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="mps">
    <?php foreach (mps_listar() as $item): ?>
        <option value="<?=$item['mp'];?>">
    <?php endforeach;?>
</datalist>

<?php require '../tpl/pagef.php'; ?>
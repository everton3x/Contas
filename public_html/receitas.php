<?php
require '../tpl/pageh.php';

require_once '../app/receita.php';
require_once '../app/periodo.php';
require_once '../app/valor.php';
require_once '../app/pessoas.php';
require_once '../app/agrupador.php';
require_once '../app/localizador.php';

$periodoInicial = $_GET['periodoInicial'] ?? date('Y-m');
$periodoFinal = $_GET['periodoFinal'] ?? date('Y-m');
$descricao = $_GET['descricao'] ?? '%';
$devedor = $_GET['devedor'] ?? '%';
$valorInicial = $_GET['valorInicial'] ?? PHP_INT_MIN;
$valorFinal = $_GET['valorFinal'] ?? PHP_INT_MAX;
$agrupador = $_GET['agrupador'] ?? '%';
$localizador = $_GET['localizador'] ?? '%';
$vencimentoInicial = $_GET['vencimentoInicial'] ?? '0000-00-00';
$vencimentoFinal = $_GET['vencimentoFinal'] ?? '9999-12-31';

$receitas = receitas_listar($periodoInicial, $periodoFinal, $descricao, $devedor, $valorInicial, $valorFinal, $vencimentoInicial, $vencimentoFinal, $agrupador, $localizador);
//print_r($receitas);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item">Receitas</a>
</nav>

<div class="container" style="display: flex; flex-direction: row; justify-content: flex-start; align-items: stretch; align-content: stretch; gap: 1em; margin: 1em;">
    <aside class="menu">
        <header class="title">Operações</header>
        <a class="item" href="receita_adicionar.php">Novo</a>
        <a class="item" href="receita_repetir.php">Repetir</a>
        <a class="item" href="receita_parcelar.php">Parcelar</a>
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
                    <legend>Descrição/Devedor</legend>
                    <div class="field">
                        <label for="descricao">Descrição</label>
                        <input type="search" id="descricao" name="descricao" value="<?= $descricao; ?>">
                    </div>
                    <div class="field">
                        <label for="devedor">Devedor</label>
                        <input type="search" id="devedor" name="devedor" value="<?= $devedor; ?>" autocomplete="off" list="devedores">
                    </div>
                </fieldset>
                <fieldset class="fields">
                    <legend>Agrupador/Localizador</legend>
                    <div class="field">
                        <label for="agrupador">Agrupador</label>
                        <input type="search" id="agrupador" name="agrupador" value="<?= $agrupador; ?>" autocomplete="off" list="agrupadores">
                    </div>
                    <div class="field">
                        <label for="localizador">Localizador</label>
                        <input type="search" id="localizador" name="localizador" value="<?= $localizador; ?>" autocomplete="off" list="localizadores">
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
                    <legend>Vencimento</legend>
                    <div class="field">
                        <label for="vencimentoInicial">Início</label>
                        <input type="date" id="vencimentoInicial" name="vencimentoInicial" value="<?= $vencimentoInicial; ?>" style="width: 10em">
                    </div>
                    <div class="field">
                        <label for="vencimentoFinal">Fim</label>
                        <input type="date" id="vencimentoFinal" name="vencimentoFinal" value="<?= $vencimentoFinal; ?>" style="width: 10em">
                    </div>
                </fieldset>
            </div>
            <footer class="buttons">
                <button class="button primary" type="submit">Filtrar</button>
                <button class="button" type="submit" formaction="receitas.php" formmethod="POST">Limpar</button>
            </footer>
        </form>
    </aside>
</div>

<div class="container" style="margin: 1em;">
    <table class="table" style="margin-left: auto; margin-right: auto;">
        <caption>Receitas</caption>
        <thead>
            <tr>
                <th>*</th>
                <th>Cód</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Devedor</th>
                <th>Previsto</th>
                <th>Recebido</th>
                <th>A receber</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($receitas as $item): ?>
                <?php
                    $recebido = total_recebido($item['cod']);
                    $areceber = $item['valor'] - $recebido;
                ?>
                <tr>
                    <td>
                        <input type="radio" name="receita" form="processar_receita" value="<?=$item['cod'];?>">
                    </td>
                    <td style="text-align: right"><?= $item['cod']; ?></td>
                    <td style="text-align: right"><?= format_periodo(int2periodo($item['periodo'])); ?></td>
                    <td>
                        <a href="receita_detalhes.php?receita=<?= $item['cod']; ?>"><?= $item['descricao']; ?></a>
                    </td>
                    <td><?= $item['devedor']; ?></td>
                    <td style="text-align: right"><?= currency($item['valor']); ?></td>
                    <td style="text-align: right">
                        <?= currency($recebido);?>
                    </td>
                    <td style="text-align: right">
                        <a href="receber.php?receita=<?= $item['cod']; ?>"><?= currency($areceber);?></a>
                    </td>
                    <td style="text-align: right"><?= format_date($item['vencimento']); ?></td>
                    <td><?= $item['agrupador']; ?></td>
                    <td><?= $item['localizador']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="11">
                    <form id="processar_receita" class="buttons">
                        <button type="submit" class="button primary" formaction="receber.php" formmethod="GET">Receber</button>
                        <button type="submit" class="button" formaction="receita_detalhes.php" formmethod="GET">Detalhes</button>
                        <button type="submit" class="button" formaction="receita_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="receita_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<datalist id="devedores">
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

<?php require '../tpl/pagef.php'; ?>
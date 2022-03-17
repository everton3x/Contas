<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);

if (key_exists('receita', $_GET)) {
    $cod = $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

$receita = receita_detalhes($cod);
//print_r($receita);
$previsto = $receita['valor'];
$recebido = total_recebido($cod);
$areceber = round($previsto - $recebido, 2);

$recebimentos = recebimentos_listar($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item">Detalhes</a>
</nav>

<article class="panel">
    <header class="title">Detalhes da Receita</header>
    <table class="table">
        <tbody>
            <tr>
                <td>Código</td>
                <td><?= $receita['cod']; ?></td>
            </tr>
            <tr>
                <td>Período</td>
                <td><?= format_periodo(int2periodo($receita['periodo'])); ?></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><?= $receita['descricao']; ?></td>
            </tr>
            <tr>
                <td>Devedor</td>
                <td><?= $receita['devedor']; ?></td>
            </tr>
            <tr>
                <td>Vencimento</td>
                <td><?= format_date($receita['vencimento']); ?></td>
            </tr>
            <tr>
                <td>Agrupador</td>
                <td><?= $receita['agrupador']; ?></td>
            </tr>
            <tr>
                <td>Localizador</td>
                <td><?= $receita['localizador']; ?></td>
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
                <td>Recebido</td>
                <td class="text align right"><?= currency($recebido); ?></td>
            </tr>
            <tr>
                <td>A receber</td>
                <td class="text align right"><?= currency($areceber); ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <form class="buttons">
                        <input type="hidden" value="<?=$cod;?>" name="receita">
                        <button type="submit" class="button primary" formaction="receber.php" formmethod="GET">Receber</button>
                        <button type="submit" class="button" formaction="receita_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="receita_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</article>

<article class="panel">
    <header class="title">Recebimentos</header>
    <table class="table">
        <thead>
            <tr>
                <th>*</th>
                <th>Cód.</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Observação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recebimentos as $item): ?>
            <tr>
                <td>
                    <input type="radio" name="recebimento" value="<?=$item['cod'];?>" form="processar_recebimento">
                </td>
                <td><?=$item['cod'];?></td>
                <td><?= format_date($item['data']);?></td>
                <td><?= currency($item['valor']);?></td>
                <td><?=$item['observacao'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <form id="processar_recebimento" class="buttons">
                        <input type="hidden" value="<?=$cod;?>" name="receita">
                        <button type="submit" class="button primary" formaction="recebimento_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="recebimento_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</article>

<?php require '../tpl/pagef.php'; ?>
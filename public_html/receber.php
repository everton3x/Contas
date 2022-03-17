<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_GET);

if (key_exists('receita', $_GET)) {
    $cod = (int) $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

$receita = receita_detalhes($cod);
//print_r($receita);
$previsto = $receita['valor'];
$recebido = total_recebido($cod);
$areceber = round($previsto - $recebido, 2);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?=$cod;?>">Detalhes</a>
    <a class="item">Receber</a>
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
                <td><?= currency($previsto); ?></td>
            </tr>
            <tr>
                <td>Recebido</td>
                <td><?= currency($recebido); ?></td>
            </tr>
            <tr>
                <td>A receber</td>
                <td>
                    <div class="field">
                        <input type="number" min="0.01" value="<?=$areceber;?>" step="0.01" name="valor" required autofocus form="receber">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    <div class="field">
                        <input type="date" value="<?=date('Y-m-d');?>" name="data" required form="receber">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Observação</td>
                <td>
                    <div class="field">
                        <input type="text" name="observacao" placeholder="Opcional" form="receber">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text align right">
                    <button type="submit" class="button primary" form="receber">Salvar</button>
                </td>
            </tr>
        </tbody>
    </table>
</article>

<form id="receber" action="recebimento_salvar.php" method="POST">
    <input type="hidden" value="<?=$cod;?>" name="receita">
</form>

<?php require '../tpl/pagef.php'; ?>
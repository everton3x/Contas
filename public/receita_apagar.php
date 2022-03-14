<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

if (key_exists('receita', $_GET)) {
    $cod = (int) $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

$receita = receita_detalhes($cod);

$previsto = $receita['valor'];
$recebido = total_recebido($cod);
$areceber = round($previsto - $recebido, 2);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?= $cod; ?>">Detalhes</a>
    <a class="item">Apagar</a>
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
    </table>
</article>

<form class=" panel buttons">
    <input type="hidden" value="<?= $cod; ?>" name="receita">
    <button type="submit" class="button error" formaction="receita_apagar_salvar.php" formmethod="GET">Apagar</button>
</form>

<?php require '../tpl/pagef.php'; ?>
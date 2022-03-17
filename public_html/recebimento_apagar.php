<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

if (key_exists('recebimento', $_GET)) {
    $cod = (int) $_GET['recebimento'];
} else {
    trigger_error("Recebimento não informado.", E_USER_ERROR);
}

if (key_exists('receita', $_GET)) {
    $codReceita = (int) $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

$receita = receita_detalhes($codReceita);
$detalhes = recebimento_detalhes($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?= $cod; ?>">Detalhes</a>
    <a class="item">Recebimento</a>
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
    <header class="title">Recebimento</header>
    <table class="table">
        <thead>
            <tr>
                <th>Cód.</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Observação</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$detalhes['cod'];?></td>
                <td><?= format_date($detalhes['data']);?></td>
                <td><?= currency($detalhes['valor']);?></td>
                <td><?=$detalhes['observacao'];?></td>
            </tr>
        </tbody>
    </table>
</article>

<form class=" panel buttons">
    <input type="hidden" value="<?= $cod; ?>" name="recebimento">
    <input type="hidden" value="<?= $codReceita; ?>" name="receita">
    <button type="submit" class="button error" formaction="recebimento_apagar_salvar.php" formmethod="GET">Apagar</button>
</form>

<?php require '../tpl/pagef.php'; ?>
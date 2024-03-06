<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

if (key_exists('despesa', $_GET)) {
    $cod = (int) $_GET['despesa'];
} else {
    trigger_error("Despesa não informada.", E_USER_ERROR);
}

$despesa = despesa_detalhes($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?= $cod; ?>">Detalhes</a>
    <a class="item">Apagar</a>
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
            <tr>
                <td>Valor</td>
                <td><?= $despesa['valor']; ?></td>
            </tr>
        </tbody>
    </table>
</article>

<form class=" panel buttons">
    <input type="hidden" value="<?= $cod; ?>" name="despesa">
    <button type="submit" class="button error" formaction="despesa_apagar_salvar.php" formmethod="GET">Apagar</button>
</form>

<?php require '../tpl/pagef.php'; ?>
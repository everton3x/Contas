<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);

if (key_exists('receita', $_POST)) {
    $codReceita = $_POST['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

if (key_exists('cod', $_POST)) {
    $cod = $_POST['cod'];
} else {
    trigger_error("Recebimento não informado.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('data', $_POST)) {
    $data = $_POST['data'];
} else {
    trigger_error("Data não informada.", E_USER_ERROR);
}

if (key_exists('observacao', $_POST)) {
    $observacao = $_POST['observacao'];
} else {
    $observacao = '';
}

$receita = receita_detalhes($codReceita);
$anterior = recebimento_detalhes($cod);
recebimento_alterar($cod, $codReceita, $data, $valor, $observacao);
$recebimento = recebimento_detalhes($cod);

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?= $codReceita; ?>">Detalhes</a>
    <a class="item">Recebimento</a>
    <a class="item" href="javascript:history.back();">Editar</a>
    <a class="item">Salvar</a>
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
                <td>Valor do recebimento</td>
                <td>de <?= currency($anterior['valor']); ?></td>
                <td>para <?= currency($recebimento['valor']); ?></td>
            </tr>
            <tr>
                <td>Data</td>
                <td>de <?= format_date($anterior['data']); ?></td>
                <td>para <?= format_date($recebimento['data']); ?></td>
            </tr>
            <tr>
                <td>Observação</td>
                <td>de <?= $anterior['observacao']; ?></td>
                <td>para <?= $recebimento['observacao']; ?></td>
            </tr>
        </tbody>
    </table>
</article>

<?php require '../tpl/pagef.php'; ?>
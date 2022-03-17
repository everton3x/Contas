<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);
//exit();

if (key_exists('periodo', $_POST)) {
    $periodo = $_POST['periodo'];
} else {
    trigger_error("Período não informado.", E_USER_ERROR);
}

if (key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
    $descricao = $_POST['descricao'];
} else {
    trigger_error("Descrição não informada.", E_USER_ERROR);
}

if (key_exists('devedor', $_POST) && strlen($_POST['devedor']) > 0) {
    $devedor = $_POST['devedor'];
} else {
    trigger_error("Devedor não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('vencimento', $_POST)) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '';
}

if (key_exists('agrupador', $_POST)) {
    $agrupador = $_POST['agrupador'];
} else {
    $agrupador = '';
}

if (key_exists('localizador', $_POST)) {
    $localizador = $_POST['localizador'];
} else {
    $localizador = '';
}

$cod = receita_parcelar($periodo, $descricao, $devedor, $valor, $vencimento, $agrupador, $localizador);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_parcelar.php">Repetir</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Devedor</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cod as $parc => $item): ?>
            <?php $receita = receita_detalhes($item);?>
                <tr>
                    <td><?= $parc; ?></td>
                    <td><?= $receita['cod']; ?></td>
                    <td><?= format_periodo(int2periodo($receita['periodo'])); ?></td>
                    <td><?= $receita['descricao']; ?></td>
                    <td><?= $receita['devedor']; ?></td>
                    <td><?= currency($receita['valor']); ?></td>
                    <td><?= format_date($receita['vencimento']); ?></td>
                    <td><?= $receita['agrupador']; ?></td>
                    <td><?= $receita['localizador']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<?php require '../tpl/pagef.php'; ?>
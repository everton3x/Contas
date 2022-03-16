<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
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

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
$valor = $_POST['valor'];
} else {
trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('repetir', $_POST)) {
$repetir = $_POST['repetir'];
} else {
trigger_error("Número de repetições não informado.", E_USER_ERROR);
}
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_repetir.php">Repetir</a>
    <a class="item">Salvar</a>
</nav>

<main class="container">
    <?php
    for ($i = 1; $i <= $repetir; $i++):
        $cod = despesa_adicionar($periodo, $descricao, $valor);
        $despesa = despesa_detalhes($cod);
    ?>
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
                <td><?= currency($despesa['valor']); ?></td>
            </tr>
        </tbody>
    </table>
    <?php endfor;?>
</main>


<?php require '../tpl/pagef.php'; ?>
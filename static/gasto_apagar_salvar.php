<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

if (key_exists('despesa', $_POST)) {
    $despesa = $_POST['despesa'];
} else {
    trigger_error('Nenhuma despesa informada.', E_USER_ERROR);
}

if (key_exists('cod', $_POST)) {
    $cod = $_POST['cod'];
} else {
    trigger_error('Nenhum gasto informado.', E_USER_ERROR);
}

$detalhes = despesa_detalhes($despesa);
$gasto = gasto_detalhes($cod);
gasto_apagar($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?= $cod; ?>">Despesa</a>
    <a class="item">Gasto</a>
    <a class="item">Apagar</a>
    <a class="item">Salvar</a>
</nav>

<main class="panel">
    <input type="hidden" value="<?= $cod; ?>" name="cod">
    <input type="hidden" value="<?= $despesa; ?>" name="despesa">
    <fieldset class="fields">
        <legend class="title">Despesa</legend>
        <div class="field">
            <label for="periodo">Período</label>
            <input type="month" id="periodo" name="periodo" readonly value="<?= int2periodo($detalhes['periodo']); ?>">
        </div>
        <div class="field">
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" readonly value="<?= $detalhes['descricao']; ?>">
        </div>
    </fieldset>
    <fieldset class="fields">
        <legend class="title">Gasto</legend>
        <div class="field">
            <label for="valor">Valor</label>
            <input type="number" id="valor" name="valor" value="<?= $gasto['valor']; ?>" readonly>
        </div>
        <div class="field">
            <label for="gasto">Gasto em</label>
            <input type="date" id="gasto" name="gasto" readonly value="<?= $gasto['gastoem']; ?>">
        </div>
        <div class="field">
            <label for="mp">Meio de pagamento</label>
            <input type="text" id="mp" name="mp" readonly value="<?= $gasto['mp']; ?>">
        </div>
        <div class="field">
            <label for="observacao_gasto">Observação do gasto</label>
            <input type="text" id="observacao_gasto" name="observacao_gasto" value="<?= $gasto['observacao']; ?>" readonly>
        </div>
        <div class="field">
            <label for="credor">Credor</label>
            <input type="text" id="credor" name="credor" readonly value="<?= $gasto['credor']; ?>">
        </div>
        <div class="field">
            <label for="localizador">Localizador</label>
            <input type="text" id="localizador" name="localizador" value="<?= $gasto['localizador']; ?>" readonly>
        </div>
        <div class="field">
            <label for="agrupador">Agrupador</label>
            <input type="text" id="agrupador" name="agrupador" value="<?= $gasto['agrupador']; ?>" readonly>
        </div>
        <div class="field">
            <label for="vencimento">Vencimento</label>
            <input type="date" id="vencimento" name="vencimento" value="<?= $gasto['vencimento']; ?>" readonly>
        </div>

        <div class="field">
            <label for="pagoem">Pago em</label>
            <input type="date" id="pagoem" name="pagoem"  value="<?= $gasto['pagoem']; ?>" readonly>
        </div>
        <div class="field">
            <label for="observacao_pgto">Observação do pagamento</label>
            <input type="text" id="observacao_pgto" name="observacao_pgto" value="<?= $gasto['observacao_pgto']; ?>" readonly>
        </div>
    </fieldset>

</main>

<?php require '../tpl/pagef.php'; ?>
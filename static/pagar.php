<?php require '../tpl/pageh.php';

 require_once '../app/periodo.php';
 require_once '../app/despesa.php';
 
 if(key_exists('cod', $_GET)){
     $cod = $_GET['cod'];
 }else{
     trigger_error('Nenhum gasto informad8.', E_USER_ERROR);
 }
 
$gasto = gasto_detalhes($cod);
$despesa = despesa_detalhes($gasto['despesa']);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?=$despesa['cod'];?>">Despesa</a>
    <a class="item" href="gastos.php">Gastos</a>
    <a class="item">Pagar</a>
</nav>

<main class="panel">
    <form action="pagar_salvar.php" method="POST">
        <input type="hidden" value="<?=$cod;?>" name="cod">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" readonly value="<?= int2periodo($despesa['periodo']);?>">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" readonly value="<?=$despesa['descricao'];?>">
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend class="title">Gasto</legend>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" min="0.01" step="0.01" value="<?=$gasto['valor'];?>" readonly>
            </div>
            <div class="field">
                <label for="gasto">Gasto em</label>
                <input type="date" id="gasto" name="gasto" value="<?=date('Y-m-d');?>" readonly>
            </div>
            <div class="field">
                <label for="mp">Meio de pagamento</label>
                <input type="text" id="mp" name="mp" readonly>
            </div>
            <div class="field">
                <label for="observacao_gasto">Observação do gasto</label>
                <input type="text" id="observacao_gasto" name="observacao_gasto" readonly>
            </div>
            <div class="field">
                <label for="credor">Credor</label>
                <input type="text" id="credor" name="credor" readonly>
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" readonly>
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" readonly>
            </div>
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento" readonly>
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend>Pagamento</legend>
            <div class="field">
                <label for="pagoem">Pago em</label>
                <input type="date" id="pagoem" name="pagoem" value="<?=date('Y-m-d');?>" required autofocus>
            </div>
            <div class="field">
                <label for="observacao_pgto">Observação do pagamento</label>
                <input type="text" id="observacao_pgto" name="observacao_pgto" autocomplete="off">
            </div>
        </fieldset>

        <footer class="buttons">
            <button class="primary button" type="submit">Salvar</button>
            <button class="button" type="reset">Limpar</button>
        </footer>
    </form>
</main>

<?php require '../tpl/pagef.php'; ?>
<?php require '../tpl/pageh.php';

 require_once '../app/pessoas.php';
 require_once '../app/periodo.php';
 require_once '../app/despesa.php';
 require_once '../app/localizador.php';
 require_once '../app/agrupador.php';
 require_once '../app/mp.php';
 
 if(key_exists('despesa', $_GET)){
     $despesa = $_GET['despesa'];
 }else{
     trigger_error('Nenhuma despesa informada.', E_USER_ERROR);
 }
 
 if(key_exists('cod', $_GET)){
     $cod = $_GET['cod'];
 }else{
     trigger_error('Nenhum gasto informado.', E_USER_ERROR);
 }
 
 $detalhes = despesa_detalhes($despesa);
 $gasto = gasto_detalhes($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?=$cod;?>">Despesa</a>
    <a class="item">Gasto</a>
    <a class="item">Editar</a>
</nav>

<main class="panel">
    <form action="gasto_editar_salvar.php" method="POST">
        <input type="hidden" value="<?=$cod;?>" name="cod">
        <input type="hidden" value="<?=$despesa;?>" name="despesa">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" readonly value="<?= int2periodo($detalhes['periodo']);?>">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" readonly value="<?=$detalhes['descricao'];?>">
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend class="title">Gasto</legend>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" required min="0.01" step="0.01" value="<?=$gasto['valor'];?>" autofocus>
            </div>
            <div class="field">
                <label for="gasto">Gasto em</label>
                <input type="date" id="gasto" name="gasto" required value="<?=$gasto['gastoem'];?>">
            </div>
            <div class="field">
                <label for="mp">Meio de pagamento</label>
                <input type="text" id="mp" name="mp" list="mps" autocomplete="off" required value="<?=$gasto['mp'];?>">
            </div>
            <div class="field">
                <label for="observacao_gasto">Observação do gasto</label>
                <input type="text" id="observacao_gasto" name="observacao_gasto" autocomplete="off" value="<?=$gasto['observacao'];?>">
            </div>
            <div class="field">
                <label for="credor">Credor</label>
                <input type="text" id="credor" name="credor" list="credores" autocomplete="off" required value="<?=$gasto['credor'];?>">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" list="localizadores" value="<?=$gasto['localizador'];?>">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" list="agrupadores" value="<?=$gasto['agrupador'];?>">
            </div>
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento" value="<?=$gasto['vencimento'];?>">
            </div>
            
            <div class="field">
                <label for="pagoem">Pago em</label>
                <input type="date" id="pagoem" name="pagoem"  value="<?=$gasto['pagoem'];?>">
            </div>
            <div class="field">
                <label for="observacao_pgto">Observação do pagamento</label>
                <input type="text" id="observacao_pgto" name="observacao_pgto" autocomplete="off" value="<?=$gasto['observacao_pgto'];?>">
            </div>
        </fieldset>

        <footer class="buttons">
            <button class="primary button" type="submit">Salvar</button>
            <button class="button" type="reset">Limpar</button>
        </footer>
    </form>
</main>

<datalist id="credores">
    <?php foreach (pessoas_listar() as $item): ?>
        <option value="<?=$item['pessoa'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="localizadores">
    <?php foreach (localizadores_listar() as $item): ?>
        <option value="<?=$item['localizador'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="agrupadores">
    <?php foreach (agrupadores_listar() as $item): ?>
        <option value="<?=$item['agrupador'];?>">
    <?php endforeach;?>
</datalist>

<datalist id="mps">
    <?php foreach (mps_listar() as $item): ?>
        <option value="<?=$item['mp'];?>">
    <?php endforeach;?>
</datalist>

<?php require '../tpl/pagef.php'; ?>
<?php require '../tpl/pageh.php';

 require_once '../app/pessoas.php';
 require_once '../app/localizador.php';
 require_once '../app/agrupador.php';
 require_once '../app/mp.php';
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item">Novo</a>
</nav>

<main class="panel">
    <form action="despesa_adicionar_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" required autofocus>
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da despesa" autocomplete="off">
            </div>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" required min="0.01" step="0.01">
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend class="title">Gasto</legend>
            <div class="field">
                <label for="gasto">Gasto em</label>
                <input type="date" id="gasto" name="gasto">
            </div>
            <div class="field">
                <label for="mp">Meio de pagamento</label>
                <input type="text" id="mp" name="mp" list="mps" autocomplete="off">
            </div>
            <div class="field">
                <label for="observacao_gasto">Observação do gasto</label>
                <input type="text" id="observacao_gasto" name="observacao_gasto" autocomplete="off">
            </div>
            <div class="field">
                <label for="credor">Credor</label>
                <input type="text" id="credor" name="credor" list="credores" autocomplete="off">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" list="localizadores">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" list="agrupadores">
            </div>
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento">
            </div>
            <div class="checkbox">
                <input type="checkbox" id="pagar" name="pagar">
                <label for="pagar">Pagar?</label>
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
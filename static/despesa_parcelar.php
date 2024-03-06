<?php require '../tpl/pageh.php';

 require_once '../app/pessoas.php';
 require_once '../app/localizador.php';
 require_once '../app/agrupador.php';
 require_once '../app/mp.php';
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item">Parcelar</a>
</nav>

<main class="panel">
    <form action="despesa_parcelar_conferir.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período Inicial</label>
                <input type="month" id="periodo" name="periodo" required autofocus>
            </div>
            <div class="field">
                <label for="parcelas">Parcelas</label>
                <input type="number" id="parcelas" name="parcelas" required min="2" step="1" value="2">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da despesa" autocomplete="off">
            </div>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" required min="0.01" step="0.01">
            </div>
            <div class="checkbox">
                <input type="radio" id="valorTotal" name="tipoValor" value="total">
                <label for="valorTotal">Valor total</label>
                <input type="radio" id="valorParcela" name="tipoValor" value="parcela">
                <label for="valorParcela">Valor da parcela</label>
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend class="title">Gasto</legend>
            <div class="field">
                <label for="gasto">Gasto em</label>
                <input type="date" id="gasto" name="gasto" required>
            </div>
            <div class="field">
                <label for="mp">Meio de pagamento</label>
                <input type="text" id="mp" name="mp" list="mps" autocomplete="off" required>
            </div>
            <div class="field">
                <label for="observacao_gasto">Observação do gasto</label>
                <input type="text" id="observacao_gasto" name="observacao_gasto" autocomplete="off">
            </div>
            <div class="field">
                <label for="credor">Credor</label>
                <input type="text" id="credor" name="credor" list="credores" autocomplete="off" required>
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" list="localizadores">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" list="agrupadores" required>
            </div>
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento">
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
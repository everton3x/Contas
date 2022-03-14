<?php require '../tpl/pageh.php';

require_once '../app/pessoas.php';
require_once '../app/localizador.php';
require_once '../app/agrupador.php';
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item">Parcelar</a>
</nav>

<main class="panel">
    <form action="receita_parcelar_conferir.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Receita</legend>
            <div class="field">
                <label for="periodo">Período inicial</label>
                <input type="month" id="periodo" name="periodo" required autofocus>
            </div>
            <div class="field">
                <label for="nvezes">Número de parcelas</label>
                <input type="number" id="nvezes" name="nvezes" required min="2" step="1" value="2">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da receita" autocomplete="off">
            </div>
            <div class="field">
                <label for="devedor">Devedor</label>
                <input type="text" id="devedor" name="devedor" required placeholder="Nome do devedor" list="devedores" autocomplete="off">
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
            <div class="field">
                <label for="vencimento">Vencimento inicial</label>
                <input type="date" id="vencimento" name="vencimento">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" placeholder="Agrupador da receita" required list="agrupadores">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" placeholder="Localizador da receita" list="localizadores">
            </div>
        </fieldset>
        
        <footer class="buttons">
            <button class="primary button" type="submit">Salvar</button>
            <button class="button" type="reset">Limpar</button>
        </footer>
    </form>
</main>

<datalist id="devedores">
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

<?php require '../tpl/pagef.php'; ?>
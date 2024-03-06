<?php require '../tpl/pageh.php';

require_once '../app/pessoas.php';
require_once '../app/agrupador.php';
require_once '../app/localizador.php';
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item">Novo</a>
</nav>

<main class="panel">
    <form action="receita_adicionar_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Receita</legend>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" required autofocus value="<?=date('Y-m');?>">
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
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" placeholder="Agrupador da receita" list="agrupadores">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" placeholder="Localizador da receita" list="localizadores">
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend class="title">Recebimento</legend>
            <div class="field">
                <label for="recebido">Recebido em</label>
                <input type="date" id="recebido" name="recebido">
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
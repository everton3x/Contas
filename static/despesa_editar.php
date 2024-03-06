<?php require '../tpl/pageh.php';

 require_once '../app/pessoas.php';
 require_once '../app/localizador.php';
 require_once '../app/agrupador.php';
 require_once '../app/mp.php';
 require_once '../app/despesa.php';
 
 if (key_exists('despesa', $_GET)) {
    $cod = $_GET['despesa'];
} else {
    trigger_error("Despesa não informada.", E_USER_ERROR);
}

$despesa = despesa_detalhes($cod);

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?=$cod;?>">Despesas</a>
    <a class="item">Editar</a>
</nav>

<main class="panel">
    <form action="despesa_editar_salvar.php" method="POST">
        <input type="hidden" name="despesa" value="<?=$cod;?>">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" required autofocus value="<?= int2periodo($despesa['periodo']);?>">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da despesa" autocomplete="off" value="<?=$despesa['descricao'];?>">
            </div>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" required min="0.00" step="0.01" value="<?=$despesa['valor'];?>">
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
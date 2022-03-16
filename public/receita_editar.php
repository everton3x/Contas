<?php require '../tpl/pageh.php'; 

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/agrupador.php';
require_once '../app/localizador.php';
require_once '../app/pessoas.php';

if (key_exists('receita', $_GET)) {
    $cod = (int) $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

$receita = receita_detalhes($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?=$cod;?>">Detalhes</a>
    <a class="item">Editar</a>
</nav>

<main class="panel">
    <form action="receita_editar_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Receita</legend>
            <div class="field">
                <label>Código</label>
                <input type="number" name="cod" required value="<?= $cod;?>" readonly>
            </div>
            <div class="field">
                <label for="periodo">Período</label>
                <input type="month" id="periodo" name="periodo" required autofocus value="<?= int2periodo($receita['periodo']);?>">
            </div>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da receita" autocomplete="off" value="<?=$receita['descricao'];?>">
            </div>
            <div class="field">
                <label for="devedor">Devedor</label>
                <input type="text" id="devedor" name="devedor" required placeholder="Nome do devedor" list="devedores" value="<?=$receita['devedor'];?>" list="devedores">
            </div>
            <div class="field">
                <label for="valor">Valor</label>
                <input type="number" id="valor" name="valor" required min="0.00" step="0.01" value="<?=$receita['valor'];?>">
            </div>
            <div class="field">
                <label for="vencimento">Vencimento</label>
                <input type="date" id="vencimento" name="vencimento" value="<?=$receita['vencimento'];?>">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" value="<?=$receita['agrupador'];?>" list="agrupadores">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" value="<?=$receita['localizador'];?>" list="localizadores">
            </div>
        </fieldset>
        
        <footer class="buttons">
            <button class="primary button" type="submit">Atualizar</button>
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
<?php require '../tpl/pageh.php';

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item">Repetir</a>
</nav>

<main class="panel">
    <form action="despesa_repetir_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="periodo">Período Inicial</label>
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
            <div class="field">
                <label for="repetir">Repetições</label>
                <input type="number" id="repetir" name="repetir" required min="2" step="1" value="2">
            </div>
        </fieldset>

        <footer class="buttons">
            <button class="primary button" type="submit">Salvar</button>
            <button class="button" type="reset">Limpar</button>
        </footer>
    </form>
</main>

<?php require '../tpl/pagef.php'; ?>
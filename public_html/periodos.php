<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';

$abrir = periodo_ultimo_fechado();
$fechar = periodo_posterior($abrir);

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item">Períodos</a>
</nav>

<main class="container">

    <form method="GET" action="fechar_periodo.php">
        <fieldset class="fields">
            <legend>Fechar período</legend>
            <div class="field">
                <label for="fechar">Período</label>
                <input type="month" id="fechar" name="periodo" required value="<?= $fechar; ?>">
            </div>
            <button class="button" type="submit">Fechar</button>
        </fieldset>
    </form>
    
    <form method="GET" action="abrir_periodo.php">
        <fieldset class="fields">
            <legend>Abrir período</legend>
            <div class="field">
                <label for="abrir">Período</label>
                <input type="month" id="abrir" name="periodo" required value="<?= $abrir; ?>">
            </div>
            <button class="button" type="submit">Abrir</button>
        </fieldset>
    </form>
</main>

<?php require '../tpl/pagef.php'; ?>
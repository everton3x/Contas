<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';

if(key_exists('periodo', $_GET)){
    $periodo = $_GET['periodo'];
}else{
    trigger_error("Nenhum período informado.", E_USER_ERROR);
}

abrir_periodo($periodo);

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="periodos.php">Períodos</a>
    <a class="item">Abrir</a>
</nav>

<main class="container">

    <div class="message success">
        <p>Período <?=format_periodo($periodo);?> aberto!</p>
    </div>
    
</main>

<?php require '../tpl/pagef.php'; ?>
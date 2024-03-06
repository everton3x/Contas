<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';

if(key_exists('periodo', $_GET)){
    $periodo = $_GET['periodo'];
}else{
    trigger_error("Nenhum período informado.", E_USER_ERROR);
}

fechar_periodo($periodo);

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="periodos.php">Períodos</a>
    <a class="item">Fechar</a>
</nav>

<main class="container">

    <div class="message success">
        <p>Período <?=format_periodo($periodo);?> fechado!</p>
    </div>
    
</main>

<?php require '../tpl/pagef.php'; ?>
<?php
require '../tpl/pageh.php';

require_once '../app/despesa.php';
require_once '../app/receita.php';
require_once '../app/periodo.php';

if(key_exists('periodo', $_POST)){
    $periodo = $_POST['periodo'];
}else{
    $periodo = periodo_posterior(periodo_ultimo_fechado());
}
if(key_exists('cx', $_POST)){
    $cx = $_POST['cx'];
}else{
    $cx = 0.0;
}
if(key_exists('banrisul', $_POST)){
    $banrisul = $_POST['banrisul'];
}else{
    $banrisul = 0.0;
}
if(key_exists('cef', $_POST)){
    $cef = $_POST['cef'];
}else{
    $cef = 0.0;
}


$resumo = periodo_resumo($periodo);

$areceber = round($resumo['receita'] - $resumo['recebido'], 2);
$agastar = round($resumo['despesa'] - $resumo['gasto'], 2);
$apagar = round($resumo['gasto'] - $resumo['pago'], 2);

$disponivel = round($cx + $banrisul + $cef + $areceber, 2);
$dispendio = round($agastar + $apagar, 2);

$calculado = round($disponivel - $dispendio, 2);

$sistema = $resumo['resultado_acumulado'];

if($calculado > $sistema){
    $diferenca_receita = round($calculado - $sistema, 2);
    $diferenca_despesa = 0;
}else{
    $diferenca_receita = 0;
    $diferenca_despesa = round($sistema - $calculado, 2);
}


?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="extras.php">Extras</a>
    <a class="item">Conciliação</a>
</nav>

<main class="container">

    <form method="POST" class="panel">
        <fieldset class="fields">
            <legend>Período</legend>
            <div class="field">
                <input type="month" name="periodo" value="<?=$periodo;?>" autofocus>
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend>Recursos</legend>
            <div class="field">
                <label for="cx">Caixa</label>
                <input type="number" min="0" step="0.01" id="cx" name="cx" value="<?=$cx;?>">
            </div>
            <div class="field">
                <label for="banrisul">Banrisul</label>
                <input type="number" step="0.01" id="banrisul" name="banrisul" value="<?=$banrisul;?>">
            </div>
            <div class="field">
                <label for="cef">CEF</label>
                <input type="number" step="0.01" id="cef" name="cef" value="<?=$cef;?>">
            </div>
            <div class="field">
                <label for="areceber">A receber</label>
                <input type="number" step="0.01" id="areceber" name="areceber" value="<?=$areceber;?>" readonly>
            </div>
            <div class="field">
                <label for="disponivel">Disponível</label>
                <input type="number" step="0.01" id="disponivel" name="disponivel" value="<?=$disponivel;?>" readonly>
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend>Dispêndios</legend>
            <div class="field">
                <label for="agastar">A gastar</label>
                <input type="number" min="0" step="0.01" id="agastar" name="agastar" value="<?=$agastar;?>" readonly>
            </div>
            <div class="field">
                <label for="apagar">A pagar</label>
                <input type="number" min="0" step="0.01" id="apagar" name="apagar" value="<?=$apagar;?>" readonly>
            </div>
            <div class="field">
                <label for="dispendio">A dispender</label>
                <input type="number" step="0.01" id="dispendio" name="dispendio" value="<?=$dispendio;?>" readonly>
            </div>
        </fieldset>
        <fieldset class="fields">
            <legend>Resultados</legend>
            <div class="field">
                <label for="calculado">Calculado</label>
                <input type="number" step="0.01" id="calculado" name="calculado" value="<?=$calculado;?>" readonly>
            </div>
            <div class="field">
                <label for="sistema">do sistema</label>
                <input type="number" step="0.01" id="sistema" name="sistema" value="<?=$sistema;?>" readonly>
            </div>
            <div class="field">
                <label for="diferenca_receita">Diferença (lançar receita)</label>
                <input type="number" step="0.01" id="diferenca_receita" name="diferenca_receita" value="<?=$diferenca_receita;?>" readonly>
            </div>
            <div class="field">
                <label for="diferenca_despesa">Diferença (lançar despesa)</label>
                <input type="number" step="0.01" id="diferenca_despesa" name="diferenca_despesa" value="<?=$diferenca_despesa;?>" readonly>
            </div>
        </fieldset>
        <div class="buttons">
            <button type="submit" class="button">Calcular</button>
        </div>
    </form>
    
</main>

<?php require '../tpl/pagef.php'; ?>
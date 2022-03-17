<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/despesa.php';
require_once '../app/valor.php';

//print_r($_POST);
//exit();

if (key_exists('periodo', $_POST)) {
    $periodo = $_POST['periodo'];
} else {
    trigger_error("Período não informado.", E_USER_ERROR);
}

if (key_exists('parcelas', $_POST)) {
    $nvezes = $_POST['parcelas'];
} else {
    trigger_error("Número de parcelas não informado.", E_USER_ERROR);
}

if (key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
    $descricao = $_POST['descricao'];
} else {
    trigger_error("Descrição não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('tipoValor', $_POST)) {
    $tipoValor = $_POST['tipoValor'];
} else {
    trigger_error("Tipo de valor não informado.", E_USER_ERROR);
}

if (key_exists('gasto', $_POST)) {
    $gastoem = $_POST['gasto'];
} else {
    trigger_error("Data do gasto não informada.", E_USER_ERROR);
}

if (key_exists('mp', $_POST)) {
    $mp = $_POST['mp'];
} else {
    trigger_error("Meio de pagamento não informado.", E_USER_ERROR);
}

if (key_exists('observacao_gasto', $_POST)) {
    $observacao = $_POST['observacao_gasto'];
} else {
    $observacao = '';
}

if (key_exists('credor', $_POST)) {
    $credor = $_POST['credor'];
} else {
    trigger_error("Credor não informado.", E_USER_ERROR);
}

if (key_exists('vencimento', $_POST)) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '';
}

if (key_exists('agrupador', $_POST)) {
    $agrupador = $_POST['agrupador'];
} else {
    trigger_error("Agrupador não informado.", E_USER_ERROR);
}

if (key_exists('localizador', $_POST)) {
    $localizador = $_POST['localizador'];
} else {
    $localizador = '';
}

if($tipoValor === 'total'){
    $valorTotal = $valor;
    $valor = round($valorTotal / $nvezes, 2);
}else{
    $valorTotal = round($valor * $nvezes);
}

$usado = 0.0;
for($i = 1; $i <= $nvezes; $i++){
    if($i == $nvezes) $valor = round($valorTotal - $usado, 2);
    $parcelas[$i] = [
        'periodo' => $periodo,
        'valor' => $valor,
        'vencimento' => $vencimento
    ];
    $periodo = periodo_posterior($periodo);
    $vencimento = vencimento_posterior($vencimento);
    $usado += $valor;
}
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="javascript:history.back();">Parcelar</a>
    <a class="item">Conferir</a>
</nav>

<main class="panel">
    <form action="despesa_parcelar_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Despesa</legend>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required autocomplete="off" value="<?=$descricao;?>">
            </div>
            <div class="field">
                <label for="credor">Credor</label>
                <input type="text" id="credor" name="credor" required list="credores" autocomplete="off" value="<?=$credor;?>">
            </div>
            <div class="field">
                <label for="gastoem">Gasto em</label>
                <input type="date" id="gastoem" name="gastoem" required value="<?=$gastoem;?>">
            </div>
            <div class="field">
                <label for="mp">Meio de pagamento</label>
                <input type="text" id="mp" name="mp" autocomplete="off" required value="<?=$mp;?>" list="mps">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" required value="<?=$agrupador;?>" list="agrupadores">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" value="<?=$localizador;?>" list="localizadores">
            </div>
        </fieldset>
        
        <fieldset class="fields">
            <legend class="title">Parcelas</legend>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Período</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($parcelas as $parc => $item): ?>
                    <tr>
                        <td>
                            <input type="number" name="parcela[<?=$parc;?>]" value="<?=$parc;?>" readonly>
                        </td>
                        <td>
                            <input type="month" name="periodo[<?=$parc;?>]" value="<?=$item['periodo'];?>" required>
                        </td>
                        <td>
                            <input type="number" name="valor[<?=$parc;?>]" value="<?=$item['valor'];?>" required min="0.01" step="0.01">
                        </td>
                        <td>
                            <input type="date" name="vencimento[<?=$parc;?>]" value="<?=$item['vencimento'];?>">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            <?=sizeof($parcelas);?>
                        </th>
                        <th></th>
                        <th>
                            <?=currency($usado);?>
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
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
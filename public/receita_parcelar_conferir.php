<?php require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';
require_once '../app/pessoas.php';
require_once '../app/agrupador.php';
require_once '../app/localizador.php';

//print_r($_POST);

if (key_exists('periodo', $_POST)) {
    $periodo = $_POST['periodo'];
} else {
    trigger_error("Período não informado.", E_USER_ERROR);
}

if (key_exists('descricao', $_POST) && strlen($_POST['descricao']) > 0) {
    $descricao = $_POST['descricao'];
} else {
    trigger_error("Descrição não informada.", E_USER_ERROR);
}

if (key_exists('devedor', $_POST) && strlen($_POST['devedor']) > 0) {
    $devedor = $_POST['devedor'];
} else {
    trigger_error("Devedor não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('vencimento', $_POST)) {
    $vencimento = $_POST['vencimento'];
} else {
    $vencimento = '';
}

if (key_exists('agrupador', $_POST)) {
    $agrupador = $_POST['agrupador'];
} else {
    $agrupador = '';
}

if (key_exists('localizador', $_POST)) {
    $localizador = $_POST['localizador'];
} else {
    $localizador = '';
}

if (key_exists('nvezes', $_POST)) {
    $nvezes = $_POST['nvezes'];
} else {
    trigger_error("Número de repetições não informado.", E_USER_ERROR);
}

if (key_exists('tipoValor', $_POST)) {
    $tipoValor = $_POST['tipoValor'];
} else {
    trigger_error("Tipo do valor não informado.", E_USER_ERROR);
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
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="javascript:history.back();">Parcelar</a>
    <a class="item">Conferir</a>
</nav>

<main class="panel">
    <form action="receita_parcelar_salvar.php" method="POST">
        <fieldset class="fields">
            <legend class="title">Receita</legend>
            <div class="field">
                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" required placeholder="Descrição da receita" autocomplete="off" value="<?=$descricao;?>">
            </div>
            <div class="field">
                <label for="devedor">Devedor</label>
                <input type="text" id="devedor" name="devedor" required placeholder="Nome do devedor" list="devedores" autocomplete="off" value="<?=$devedor;?>">
            </div>
            <div class="field">
                <label for="agrupador">Agrupador</label>
                <input type="text" id="agrupador" name="agrupador" autocomplete="off" placeholder="Agrupador da receita" required value="<?=$agrupador;?>" list="agrupadores">
            </div>
            <div class="field">
                <label for="localizador">Localizador</label>
                <input type="text" id="localizador" name="localizador" autocomplete="off" placeholder="Localizador da receita" value="<?=$localizador;?>" list="localizadores">
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
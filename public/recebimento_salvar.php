<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_POST);

if (key_exists('receita', $_POST)) {
    $cod = $_POST['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

if (key_exists('valor', $_POST) && $_POST['valor'] > 0) {
    $valor = $_POST['valor'];
} else {
    trigger_error("Valor não informado.", E_USER_ERROR);
}

if (key_exists('data', $_POST)) {
    $data = $_POST['data'];
} else {
    trigger_error("Data não informada.", E_USER_ERROR);
}

if (key_exists('observacao', $_POST)) {
    $observacao = $_POST['observacao'];
} else {
    $observacao = '';
}

$receita = receita_detalhes($cod);
//print_r($receita);
$previsto = $receita['valor'];
$recebido = total_recebido($cod);
$areceber = round($previsto - $recebido, 2);

$novoRecebido = round($recebido + $valor, 2);
if($novoRecebido > $previsto){
    $complementar = round($novoRecebido - $previsto, 2);
}else{
    $complementar = 0;
}
if($complementar > 0){
    receita_atualizar_valor($cod, $novoRecebido);
}

$codRecebimento = receber($cod, $data, $valor, $observacao);

$receita = receita_detalhes($cod);
$previsto = $receita['valor'];
$recebido = total_recebido($cod);
$areceber = round($previsto - $recebido, 2);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?=$cod;?>">Detalhes</a>
    <a class="item" href="javascript:history.back();">Receber</a>
    <a class="item">Salvar</a>
</nav>

<?php if($complementar > 0):?>
<section class="message info">
    <p>Foi complementado o valor previsto da receita em <?=currency($complementar);?>.</p>
</section>
<?php endif;?>
<article class="panel">
    <header class="title">Detalhes da Receita</header>
    <table class="table">
        <tbody>
            <tr>
                <td>Código</td>
                <td><?= $receita['cod']; ?></td>
            </tr>
            <tr>
                <td>Período</td>
                <td><?= format_periodo(int2periodo($receita['periodo'])); ?></td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td><?= $receita['descricao']; ?></td>
            </tr>
            <tr>
                <td>Devedor</td>
                <td><?= $receita['devedor']; ?></td>
            </tr>
            <tr>
                <td>Vencimento</td>
                <td><?= format_date($receita['vencimento']); ?></td>
            </tr>
            <tr>
                <td>Agrupador</td>
                <td><?= $receita['agrupador']; ?></td>
            </tr>
            <tr>
                <td>Localizador</td>
                <td><?= $receita['localizador']; ?></td>
            </tr>
        </tbody>
    </table>
</article>

<article class="panel">
    <header class="title">Valores</header>
    <table class="table">
        <tbody>
            <tr>
                <td>Valor do recebimento</td>
                <td><?= currency($valor); ?></td>
            </tr>
            <tr>
                <td>Previsto</td>
                <td><?= currency($previsto); ?></td>
            </tr>
            <tr>
                <td>Recebido</td>
                <td><?= currency($recebido); ?></td>
            </tr>
            <tr>
                <td>A receber</td>
                <td>
                    <?= currency($areceber); ?>
                </td>
            </tr>
        </tbody>
    </table>
</article>

<form id="receber" action="recebimento_salvar.php" method="POST">
    <input type="hidden" value="<?=$cod;?>">
</form>

<?php require '../tpl/pagef.php'; ?>
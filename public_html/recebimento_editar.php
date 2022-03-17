<?php
require '../tpl/pageh.php';

require_once '../app/periodo.php';
require_once '../app/receita.php';
require_once '../app/valor.php';

//print_r($_GET);

if (key_exists('receita', $_GET)) {
    $codReceita = (int) $_GET['receita'];
} else {
    trigger_error("Receita não informada.", E_USER_ERROR);
}

if (key_exists('recebimento', $_GET)) {
    $cod = (int) $_GET['recebimento'];
} else {
    trigger_error("Recebimento não informado.", E_USER_ERROR);
}

$receita = receita_detalhes($codReceita);
$recebimento = recebimento_detalhes($cod);
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="receitas.php">Receitas</a>
    <a class="item" href="receita_detalhes.php?receita=<?= $codReceita; ?>">Detalhes</a>
    <a class="item">Recebimento</a>
    <a class="item">Editar</a>
</nav>

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
    <header class="title">Recebimento</header>
    <table class="table">
        <tbody>
            <tr>
                <td>Cód.</td>
                <td>
                    <div class="field">
                        <input type="number" value="<?=$recebimento['cod'];?>" name="cod" required form="salvar" readonly>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Valor</td>
                <td>
                    <div class="field">
                        <input type="number" min="0.01" value="<?=$recebimento['valor'];?>" step="0.01" name="valor" required form="salvar" autofocus>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    <div class="field">
                        <input type="date" value="<?=$recebimento['data'];?>" name="data" required form="salvar">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Observação</td>
                <td>
                    <div class="field">
                        <input type="text" name="observacao" value="<?=$recebimento['observacao'];?>" form="salvar">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text align right">
                    <button type="submit" class="button primary" form="salvar">Salvar</button>
                </td>
            </tr>
        </tbody>
    </table>
</article>

<form id="salvar" action="recebimento_editar_salvar.php" method="POST">
    <input type="hidden" value="<?=$codReceita;?>" name="receita">
</form>

<?php require '../tpl/pagef.php'; ?>
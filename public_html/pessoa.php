<?php
require '../tpl/pageh.php';

require_once '../app/valor.php';
require_once '../app/pessoas.php';
require_once '../app/receita.php';
require_once '../app/despesa.php';

if(key_exists('pessoa', $_GET)){
    $pessoa = $_GET['pessoa'];
}else{
    trigger_error('Pessoa não informada.', E_USER_ERROR);
}

$receitas = receitas_listar('0000-00', '9999-12', '%', $pessoa, PHP_INT_MIN, PHP_INT_MAX, '0000-00-00', '9999-12-31', '%', '%');
$gastos = gastos_filtrar('0000-00', '9999-12', '0000-00-00', '9999-12-31', '0000-00-00', '9999-12-31', '0000-00-00', '9999-12-31', '%', '%', $pessoa, '%', PHP_INT_MIN, PHP_INT_MAX, '%', '%');

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item" href="pessoas.php">Pessoa</a>
    <a class="item"><?=$pessoa;?></a>
</nav>

<div class="container" style="margin: 1em;">
    <table class="table" style="margin-left: auto; margin-right: auto;">
        <caption>Receitas</caption>
        <thead>
            <tr>
                <th>*</th>
                <th>Cód</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Devedor</th>
                <th>Previsto</th>
                <th>Recebido</th>
                <th>A receber</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($receitas as $item): ?>
                <?php
                    $recebido = total_recebido($item['cod']);
                    $areceber = $item['valor'] - $recebido;
                ?>
                <tr>
                    <td>
                        <input type="radio" name="receita" form="processar_receita" value="<?=$item['cod'];?>">
                    </td>
                    <td style="text-align: right"><?= $item['cod']; ?></td>
                    <td style="text-align: right"><?= format_periodo(int2periodo($item['periodo'])); ?></td>
                    <td>
                        <a href="receita_detalhes.php?receita=<?= $item['cod']; ?>"><?= $item['descricao']; ?></a>
                    </td>
                    <td><?= $item['devedor']; ?></td>
                    <td style="text-align: right"><?= currency($item['valor']); ?></td>
                    <td style="text-align: right">
                        <?= currency($recebido);?>
                    </td>
                    <td style="text-align: right">
                        <a href="receber.php?receita=<?= $item['cod']; ?>"><?= currency($areceber);?></a>
                    </td>
                    <td style="text-align: right"><?= format_date($item['vencimento']); ?></td>
                    <td><?= $item['agrupador']; ?></td>
                    <td><?= $item['localizador']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="11">
                    <form id="processar_receita" class="buttons">
                        <button type="submit" class="button primary" formaction="receber.php" formmethod="GET">Receber</button>
                        <button type="submit" class="button" formaction="receita_detalhes.php" formmethod="GET">Detalhes</button>
                        <button type="submit" class="button" formaction="receita_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="receita_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="container" style="margin: 1em;">
    <table class="table" style="margin-left: auto; margin-right: auto;">
        <caption>Despesas</caption>
        <thead>
            <tr>
                <th>*</th>
                <th>?</th>
                <th>Cód</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Gasto em</th>
                <th>Observação</th>
                <th>Valor</th>
                <th>Credor</th>
                <th>MP</th>
                <th>Vencimento</th>
                <th>Agrupador</th>
                <th>Localizador</th>
                <th>Pago em</th>
                <th>Obs. Pgto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gastos as $item): ?>
                <tr>
                    <td>
                        <input type="radio" name="cod" form="processar_gasto" value="<?=$item['cod'];?>">
                    </td>
                    <td>
                        <?php if($item['pagoem'] === '0000-00-00'):?>
                            <input type="checkbox" name="cod[<?=$item['cod'];?>]" form="pagar_varios" value="<?=$item['cod'];?>">
                        <?php endif;?>
                    </td>
                    <td style="text-align: right"><?= $item['cod']; ?></td>
                    <td style="text-align: right"><?= format_periodo(int2periodo($item['periodo'])); ?></td>
                    <td>
                        <a href="despesa_detalhes.php?despesa=<?= $item['despesa']; ?>"><?= $item['descricao']; ?></a>
                    </td>
                    <td><?= format_date($item['gastoem']);?></td>
                    <td><?= $item['observacao'];?></td>
                    <td style="text-align: right"><?= currency($item['valor']); ?></td>
                    <td><?= $item['credor'];?></td>
                    <td><?= $item['mp'];?></td>
                    <td><?= format_date($item['vencimento']);?></td>
                    <td><?= $item['agrupador'];?></td>
                    <td><?= $item['localizador'];?></td>
                    <td><?= format_date($item['pagoem']);?></td>
                    <td><?= $item['observacao_pgto'];?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="13">
                    <form id="processar_gasto" class="buttons">
                        <button type="submit" class="button primary" formaction="pagar.php" formmethod="GET">Pagar</button>
                        <button type="submit" class="button" formaction="gasto_editar.php" formmethod="GET">Editar</button>
                        <button type="submit" class="button error" formaction="gasto_apagar.php" formmethod="GET">Apagar</button>
                    </form>
                </td>
                <td colspan="2">
                    <form id="pagar_varios" class="buttons">
                        <button type="submit" class="button primary" formaction="pagar_varios.php" formmethod="POST">Pagar Vários</button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<?php require '../tpl/pagef.php'; ?>
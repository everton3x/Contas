<?php require '../tpl/pageh.php';

 require_once '../app/periodo.php';
 require_once '../app/despesa.php';
 require_once '../app/valor.php';
 
 if(key_exists('cod', $_POST) && $_POST['cod'] !== []){
     $lista = $_POST['cod'];
 }else{
     trigger_error('Nenhum gasto informad.', E_USER_ERROR);
 }
 
 $total = 0.0;
?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="despesas.php">Despesas</a>
    <a class="item" href="despesa_detalhes.php?despesa=<?=$despesa['cod'];?>">Despesa</a>
    <a class="item" href="gastos.php">Gastos</a>
    <a class="item">Pagar vários</a>
</nav>

<main class="panel">
    <form action="pagar_varios_salvar.php" method="POST">
        <fieldset class="fields">
            <legend>Pagamento</legend>
            <div class="field">
                <label for="pagoem">Pago em</label>
                <input type="date" id="pagoem" name="pagoem" value="<?=date('Y-m-d');?>" required autofocus>
            </div>
            <div class="field">
                <label for="observacao_pgto">Observação do pagamento</label>
                <input type="text" id="observacao_pgto" name="observacao_pgto" autocomplete="off">
            </div>
        </fieldset>
        
        <fieldset class="fields">
            <legend class="title">Gastos</legend>
            <table class="table">
                <thead>
                    <tr>
                        <th>Período</th>
                        <th>Despesa</th>
                        <th>Gasto</th>
                        <th>Gasto em</th>
                        <th>Meio de pagamento</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista as $item):?>
                    <?php
                        $gasto = gasto_detalhes($item);
                        $despesa = despesa_detalhes($gasto['despesa']);
                        $total += $gasto['valor'];
                    ?>
                    
                        
                        <input type="hidden" name="cod[<?=$item;?>]" value="<?=$item;?>">
                        <tr>
                            <td><?= int2periodo($despesa['periodo']);?></td>
                            <td><?=$despesa['descricao'];?></td>
                            <td><?=$gasto['observacao'];?></td>
                            <td><?= format_date($gasto['gastoem']);?></td>
                            <td><?=$gasto['mp'];?></td>
                            <td class="text align right"><?= currency($gasto['valor']);?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total</th>
                        <th class="text align right"><?=currency($total);?></th>
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

<?php require '../tpl/pagef.php'; ?>
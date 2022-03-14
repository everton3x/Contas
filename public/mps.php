<?php
require '../tpl/pageh.php';

require '../app/valor.php';
require '../app/mp.php';

$data = mps_resumo();

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item">Meios de pagamento</a>
</nav>

<table class="table">
    <caption>Meios de pagamento</caption>
    <thead>
        <tr>
            <th>Meio de pagamento</th>
            <th>Gasto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $item):?>
        <tr>
            <td><a href="mp.php?mp=<?=$item['nome'];?>"><?=$item['nome'];?></a></td>
            <td class="text align right"><?=currency($item['despesa']);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php require '../tpl/pagef.php'; ?>
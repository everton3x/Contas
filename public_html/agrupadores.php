<?php
require '../tpl/pageh.php';

require '../app/valor.php';
require '../app/agrupador.php';

$data = agrupadores_resumo();

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item">Agrupadores</a>
</nav>

<table class="table">
    <caption>Agrupadores</caption>
    <thead>
        <tr>
            <th>Agrupador</th>
            <th>Receita</th>
            <th>Gasto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $item):?>
        <tr>
            <td><a href="agrupador.php?agrupador=<?=$item['nome'];?>"><?=$item['nome'];?></a></td>
            <td class="text align right"><?=currency($item['receita']);?></td>
            <td class="text align right"><?=currency($item['despesa']);?></td>
            <td class="text align right"><?=currency($item['receita'] - $item['despesa']);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php require '../tpl/pagef.php'; ?>
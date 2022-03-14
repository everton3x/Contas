<?php
require '../tpl/pageh.php';

require_once '../app/valor.php';
require_once '../app/localizador.php';

$data = localizadores_resumo();

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item">Localizadores</a>
</nav>

<table class="table">
    <caption>Localizadores</caption>
    <thead>
        <tr>
            <th>Localizador</th>
            <th>Receita</th>
            <th>Gasto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $item):?>
        <tr>
            <td><a href="localizador.php?localizador=<?=$item['nome'];?>"><?=$item['nome'];?></a></td>
            <td class="text align right"><?=currency($item['receita']);?></td>
            <td class="text align right"><?=currency($item['despesa']);?></td>
            <td class="text align right"><?=currency($item['receita'] - $item['despesa']);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php require '../tpl/pagef.php'; ?>
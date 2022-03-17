<?php
require '../tpl/pageh.php';

require '../app/valor.php';
require '../app/pessoas.php';

$data = pessoas_resumo();

?>

<nav class="breadcrumb">
    <a class="item" href="index.php">Início</a>
    <a class="item" href="cadastros.php">Cadastros</a>
    <a class="item">Pessoas</a>
</nav>

<table class="table">
    <caption>Pessoas</caption>
    <thead>
        <tr>
            <th>Pessoa</th>
            <th>Receita</th>
            <th>Gasto</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $item):?>
        <tr>
            <td><a href="pessoa.php?pessoa=<?=$item['nome'];?>"><?=$item['nome'];?></a></td>
            <td class="text align right"><?=currency($item['receita']);?></td>
            <td class="text align right"><?=currency($item['despesa']);?></td>
            <td class="text align right"><?=currency($item['receita'] - $item['despesa']);?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php require '../tpl/pagef.php'; ?>
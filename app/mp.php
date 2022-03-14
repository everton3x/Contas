<?php

require_once 'db.php';

function mps_listar(): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT DISTINCT mp FROM gastos ORDER BY mp ASC;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao buscar a lista de meios de pagamento.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function mps_resumo(): array {
    $lista = mps_listar();
    $dados = [];
    $dbh = connect();
    $stmtd = $dbh->prepare('SELECT SUM(valor) total FROM gastos WHERE mp LIKE :mp;');
    foreach ($lista as $item) {
        if($item['mp'] === '') continue;
        $data = [
            'mp' => $item['mp']
        ];
        if ($stmtd->execute($data) === false) {
            trigger_error("Falha ao buscar o gasto do meio de pagamento {$item['mp']}.", E_USER_ERROR);
        }
        $despesa = (float) $stmtd->fetch()['total'];
        $dados[] = [
            'nome' => $item['mp'],
            'despesa' => $despesa
        ];
    }
    return $dados;
}

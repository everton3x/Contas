<?php

require_once 'db.php';

function pessoas_listar(): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT devedor AS pessoa FROM receitas UNION DISTINCT SELECT credor AS pessoa FROM gastos ORDER BY pessoa ASC;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao buscar a lista de pessoas.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function pessoas_resumo(): array {
    $lista = pessoas_listar();
    $dados = [];
    $dbh = connect();
    $stmtr = $dbh->prepare('SELECT SUM(valor) total FROM receitas WHERE devedor LIKE :pessoa;');
    $stmtd = $dbh->prepare('SELECT SUM(valor) total FROM gastos WHERE credor LIKE :pessoa;');
    foreach ($lista as $item) {
        if($item['pessoa'] === '') continue;
        $data = [
            'pessoa' => $item['pessoa']
        ];
        if ($stmtr->execute($data) === false) {
            trigger_error("Falha ao buscar a receita da pessoa {$item['pessoa']}.", E_USER_ERROR);
        }
        $receita = (float) $stmtr->fetch()['total'];
        if ($stmtd->execute($data) === false) {
            trigger_error("Falha ao buscar o gasto da pessoa {$item['pessoa']}.", E_USER_ERROR);
        }
        $despesa = (float) $stmtd->fetch()['total'];
        $dados[] = [
            'nome' => $item['pessoa'],
            'receita' => $receita,
            'despesa' => $despesa
        ];
    }
    return $dados;
}

<?php

require_once 'db.php';

function agrupadores_listar(): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT agrupador FROM receitas agrupador UNION DISTINCT SELECT agrupador FROM gastos ORDER BY agrupador ASC;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao buscar a lista de agrupadores.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if ($data === false)
        return [];
    return $data;
}

function agrupadores_resumo(): array {
    $lista = agrupadores_listar();
    $dados = [];
    $dbh = connect();
    $stmtr = $dbh->prepare('SELECT SUM(valor) total FROM receitas WHERE agrupador LIKE :agrupador;');
    $stmtd = $dbh->prepare('SELECT SUM(valor) total FROM gastos WHERE agrupador LIKE :agrupador;');
    foreach ($lista as $item) {
        if($item['agrupador'] === '') continue;
        $data = [
            'agrupador' => $item['agrupador']
        ];
        if ($stmtr->execute($data) === false) {
            trigger_error("Falha ao buscar a receita do agrupador {$item['agrupador']}.", E_USER_ERROR);
        }
        $receita = (float) $stmtr->fetch()['total'];
        if ($stmtd->execute($data) === false) {
            trigger_error("Falha ao buscar o gasto do agrupador {$item['agrupador']}.", E_USER_ERROR);
        }
        $despesa = (float) $stmtd->fetch()['total'];
        $dados[] = [
            'nome' => $item['agrupador'],
            'receita' => $receita,
            'despesa' => $despesa
        ];
    }
    return $dados;
}

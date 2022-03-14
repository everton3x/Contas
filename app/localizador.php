<?php

require_once 'db.php';

function localizadores_listar(): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT localizador FROM receitas UNION DISTINCT SELECT localizador FROM gastos ORDER BY localizador ASC;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao buscar a lista de localizadores.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function localizadores_resumo(): array {
    $lista = localizadores_listar();
    $dados = [];
    $dbh = connect();
    $stmtr = $dbh->prepare('SELECT SUM(valor) total FROM receitas WHERE localizador LIKE :localizador;');
    $stmtd = $dbh->prepare('SELECT SUM(valor) total FROM gastos WHERE localizador LIKE :localizador;');
    foreach ($lista as $item) {
        if($item['localizador'] === '') continue;
        $data = [
            'localizador' => $item['localizador']
        ];
        if ($stmtr->execute($data) === false) {
            trigger_error("Falha ao buscar a receita do localizador {$item['localizador']}.", E_USER_ERROR);
        }
        $receita = (float) $stmtr->fetch()['total'];
        if ($stmtd->execute($data) === false) {
            trigger_error("Falha ao buscar o gasto do localizador {$item['localizador']}.", E_USER_ERROR);
        }
        $despesa = (float) $stmtd->fetch()['total'];
        $dados[] = [
            'nome' => $item['localizador'],
            'receita' => $receita,
            'despesa' => $despesa
        ];
    }
    return $dados;
}

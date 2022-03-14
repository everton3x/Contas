<?php

require_once 'db.php';
require_once 'periodo.php';

function receita_adicionar(string $periodo, string $descricao, string $devedor, float $valor, string $vencimento, string $agrupador, string $localizador, string $recebido): int {
    
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('INSERT INTO receitas (periodo, descricao, devedor, valor, vencimento, agrupador, localizador) VALUES (:periodo, :descricao, :devedor, :valor, :vencimento, :agrupador, :localizador);');
    $data = [
        'periodo' => periodo2int($periodo),
        'descricao' => $descricao,
        'devedor' => $devedor,
        'valor' => $valor,
        'vencimento' => $vencimento,
        'agrupador' => $agrupador,
        'localizador' => $localizador
    ];
    if ($stmt->execute($data) === false) {
        trigger_error('Falha ao adicionar a receita.', E_USER_ERROR);
    }
    $cod = $dbh->lastInsertId();

    if ($recebido !== '') {
        receber($cod, $recebido, $valor, "Recebimento integrado à previsão da receita");
    }

    return $cod;
}

function receita_repetir(string $periodo, string $descricao, string $devedor, float $valor, string $vencimento, string $agrupador, string $localizador, int $nvezes): array {
    $cod = [];
    for($i = 1; $i <= $nvezes; $i++){
        $cod[$i] = receita_adicionar($periodo, $descricao, $devedor, $valor, $vencimento, $agrupador, $localizador, '');
        $periodo = periodo_posterior($periodo);
        if($vencimento !== '') $vencimento = vencimento_posterior ($vencimento);
    }
    return $cod;
}

function receita_parcelar(array $periodos, string $descricao, string $devedor, array $valores, array $vencimentos, string $agrupador, string $localizador): array {
    $cod = [];
    $nvezes = sizeof($periodos);
    for($i = 1; $i <= $nvezes; $i++){
        $cod[$i] = receita_adicionar($periodos[$i], "$descricao ($i/$nvezes)", $devedor, $valores[$i], $vencimentos[$i], $agrupador, $localizador, '');
    }
    return $cod;
}

function receita_alterar(int $cod, string $periodo, string $descricao, string $devedor, float $valor, string $vencimento, string $agrupador, string $localizador): void {
    
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE receitas SET periodo = :periodo, descricao = :descricao, devedor = :devedor, valor = :valor, vencimento = :vencimento, agrupador = :agrupador, localizador = :localizador WHERE cod = :cod;');
    $data = [
        'cod' => $cod,
        'periodo' => periodo2int($periodo),
        'descricao' => $descricao,
        'devedor' => $devedor,
        'valor' => $valor,
        'vencimento' => $vencimento,
        'agrupador' => $agrupador,
        'localizador' => $localizador
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao editar a receita [$cod]", E_USER_ERROR);
    }
}

function receita_apagar(int $cod): void {
    
    $detalhes = receita_detalhes($cod);
    periodo_permite_lancamento(int2periodo($detalhes['periodo']));
    
    $dbh = connect();
    $stmt = $dbh->prepare('DELETE FROM receitas WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar a receita [$cod]", E_USER_ERROR);
    }
    
    $stmt = $dbh->prepare('DELETE FROM recebimentos WHERE receita = :receita;');
    $data = [
        'receita' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar os recebimentos da receita [$cod]", E_USER_ERROR);
    }
}

function recebimento_apagar(int $cod, int $receita): void {
    
    $detalhes = receita_detalhes($receita);
    periodo_permite_lancamento(int2periodo($detalhes['periodo']));
    
    $dbh = connect();
    $stmt = $dbh->prepare('DELETE FROM recebimentos WHERE receita = :receita;');
    $data = [
        'receita' => $receita
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar os recebimentos da receita [$cod]", E_USER_ERROR);
    }
}

function receita_detalhes(int $cod): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM receitas WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar dados da receita [$cod].", E_USER_ERROR);
    }

    return $stmt->fetch();
}

function recebimento_detalhes(int $cod): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM recebimentos WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar dados do recebimento [$cod].", E_USER_ERROR);
    }

    return $stmt->fetch();
}

function receitas_listar(string $periodoInicial, string $periodoFinal, string $descricao, string $devedor, float $valorInicial, float $valorFinal, string $vencimentoInicial, string $vencimentoFinal, string $agrupador, string $localizador): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM receitas WHERE (periodo BETWEEN :periodoInicial AND :periodoFinal) AND (descricao LIKE :descricao) AND (valor BETWEEN :valorInicial AND :valorFinal) AND (devedor LIKE :devedor) AND (vencimento BETWEEN :vencimentoInicial AND :vencimentoFinal) AND (agrupador LIKE :agrupador) AND (localizador LIKE :localizador);');
    $data = [
        ':periodoInicial' => periodo2int($periodoInicial),
        ':periodoFinal' => periodo2int($periodoFinal),
        ':descricao' => $descricao,
        ':devedor' => $devedor,
        ':valorInicial' => $valorInicial,
        ':valorFinal' => $valorFinal,
        ':vencimentoInicial' => $vencimentoInicial,
        ':vencimentoFinal' => $vencimentoFinal,
        ':agrupador' => $agrupador,
        ':localizador' => $localizador
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar as receitas.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    return $stmt->fetchAll();
}

function receber(int $receita, string $data, float $valor, string $observacao): int {
    $detalhes = receita_detalhes($receita);
    $periodo = int2periodo($detalhes['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('INSERT INTO recebimentos (receita, data, valor, observacao) VALUES (:receita, :data, :valor, :observacao);');
    $data = [
        'receita' => $receita,
        'data' => $data,
        'valor' => $valor,
        'observacao' => $observacao
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao adicionar a recebimento para a receita [$receita].", E_USER_ERROR);
    }
    $cod = $dbh->lastInsertId();
    return $cod;
}

function recebimento_alterar(int $cod, int $receita, string $data, float $valor, string $observacao): void {
    $detalhes = receita_detalhes($receita);
    $periodo = int2periodo($detalhes['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE recebimentos SET data = :data, valor = :valor, observacao = :observacao WHERE cod = :cod;');
    $data = [
        'cod' => $cod,
        'data' => $data,
        'valor' => $valor,
        'observacao' => $observacao
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao alterar o recebimento [$cod] para a receita [$receita].", E_USER_ERROR);
    }
}

function recebimentos_listar(int $receita): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM recebimentos WHERE receita = :receita;');
    $data = [
        ':receita' => $receita
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os recebimentos da receita [$receita].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function total_recebido(int $receita): float {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT SUM(valor) AS total FROM recebimentos WHERE receita = :receita;');
    $data = [
        ':receita' => $receita
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os recebimentos da receita [$receita].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetch();
    if($data === false) return  0.0;
    return round($data['total'], 2);
}

function receita_atualizar_valor(int $receita, $novoValor): void {
    $detalhes = receita_detalhes($receita);
    $periodo = int2periodo($detalhes['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE receitas SET valor = :valor WHERE cod = :receita;');
    $data = [
        ':receita' => $receita,
        ':valor' => $novoValor
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao atualizar o valor da receita [$receita].", E_USER_ERROR);
    }
}

/**
 * 
 * @param string $periodo AAAA-MM
 * @return array
 */
function receitas_periodo(string $periodo): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM receitas WHERE periodo = :periodo;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar as receitas para [$periodo].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}
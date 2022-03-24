<?php

require_once 'db.php';
require_once 'periodo.php';

function despesas_listar(string $periodoInicial, string $periodoFinal, string $descricao, float $valorInicial, float $valorFinal): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM despesas WHERE (periodo BETWEEN :periodoInicial AND :periodoFinal) AND (descricao LIKE :descricao) AND (valor BETWEEN :valorInicial AND :valorFinal);');
    $data = [
        ':periodoInicial' => periodo2int($periodoInicial),
        ':periodoFinal' => periodo2int($periodoFinal),
        ':descricao' => $descricao,
        ':valorInicial' => $valorInicial,
        ':valorFinal' => $valorFinal
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar as despesas.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    return $stmt->fetchAll();
}

function despesa_adicionar(string $periodo, string $descricao, float $valor): int {
    
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('INSERT INTO despesas (periodo, descricao, valor) VALUES (:periodo, :descricao, :valor);');
    $data = [
        'periodo' => periodo2int($periodo),
        'descricao' => $descricao,
        'valor' => $valor
    ];
    if ($stmt->execute($data) === false) {
        trigger_error('Falha ao adicionar a despesa.', E_USER_ERROR);
    }
    $cod = $dbh->lastInsertId();

    return $cod;
}

function gastar(int $despesa, string $gastoem, string $observacao, float $valor, string $credor, string $mp, string $vencimento, string $agrupador, string $localizador, string $pagoem, string $observacao_pgto): int {
    $detalhes = despesa_detalhes($despesa);
    periodo_permite_lancamento(int2periodo($detalhes['periodo']));
    
    $dbh = connect();
    $stmt = $dbh->prepare('INSERT INTO gastos (despesa, gastoem, observacao, valor, credor, mp, vencimento, agrupador, localizador, pagoem, observacao_pgto) VALUES (:despesa, :gastoem, :observacao, :valor, :credor, :mp, :vencimento, :agrupador, :localizador, :pagoem, :observacao_pgto);');
    $data = [
        'despesa' => $despesa,
        'gastoem' => $gastoem,
        'observacao' => $observacao,
        'valor' => $valor,
        'credor' => $credor,
        'mp' => $mp,
        'vencimento' => $vencimento,
        'agrupador' => $agrupador,
        'localizador' => $localizador,
        'pagoem' => $pagoem,
        'observacao_pgto' => $observacao_pgto
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao adicionar gasto da despesa [$despesa].", E_USER_ERROR);
    }
    $cod = $dbh->lastInsertId();
    
    $previsto = round($detalhes['valor'], 2);
    $gasto = round(total_gasto($despesa), 2);
    
    if($gasto > $previsto){
        despesa_atualizar_valor($despesa, $gasto);
    }

    return $cod;
}

function gasto_atualizar(int $cod, string $gastoem, string $observacao, float $valor, string $credor, string $mp, string $vencimento, string $agrupador, string $localizador, string $pagoem, string $observacao_pgto): void {
    $gasto = gasto_detalhes($cod);
    $detalhes = despesa_detalhes($gasto['despesa']);
    periodo_permite_lancamento(int2periodo($detalhes['periodo']));
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE gastos SET gastoem = :gastoem, observacao = :observacao, valor = :valor, credor = :credor, mp = :mp, vencimento = :vencimento, agrupador = :agrupador, localizador = :localizador, pagoem = :pagoem, observacao_pgto = :observacao_pgto WHERE cod = :cod;');
    $data = [
        'cod' => $cod,
        'gastoem' => $gastoem,
        'observacao' => $observacao,
        'valor' => $valor,
        'credor' => $credor,
        'mp' => $mp,
        'vencimento' => $vencimento,
        'agrupador' => $agrupador,
        'localizador' => $localizador,
        'pagoem' => $pagoem,
        'observacao_pgto' => $observacao_pgto
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao atualizar gasto [$cod] da despesa [{$gasto['despesa']}].", E_USER_ERROR);
    }
    
}

function despesa_atualizar_valor(int $despesa, $novoValor): void {
    $detalhes = despesa_detalhes($despesa);
    $periodo = int2periodo($detalhes['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE despesas SET valor = :valor WHERE cod = :despesa;');
    $data = [
        ':despesa' => $despesa,
        ':valor' => $novoValor
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao atualizar o valor da despesa [$despesa].", E_USER_ERROR);
    }
}

function despesa_atualizar(int $despesa, string $periodo, string $descricao, float $valor): void {
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE despesas SET periodo = :periodo, descricao = :descricao, valor = :valor WHERE cod = :despesa;');
    $data = [
        ':despesa' => $despesa,
        ':periodo' => periodo2int($periodo),
        ':descricao' => $descricao,
        ':valor' => $valor
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao atualizar a despesa [$despesa].", E_USER_ERROR);
    }
}

function despesa_detalhes(int $cod): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM despesas WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar dados da despesa [$cod].", E_USER_ERROR);
    }

    return $stmt->fetch();
}

function despesa_apagar(int $cod): void {
    $detalhes = despesa_detalhes($cod);
    $periodo = int2periodo($detalhes['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('DELETE FROM gastos WHERE despesa = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar gastos da despesa [$cod].", E_USER_ERROR);
    }
    $stmt = $dbh->prepare('DELETE FROM despesas WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar a despesa [$cod].", E_USER_ERROR);
    }
}

function gasto_apagar(int $cod): void {
    $gasto = gasto_detalhes($cod);
    $despesa = despesa_detalhes($gasto['despesa']);
    $periodo = int2periodo($despesa['periodo']);
    periodo_permite_lancamento($periodo);
    
    $dbh = connect();
    $stmt = $dbh->prepare('DELETE FROM gastos WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao apagar gastos [$cod].", E_USER_ERROR);
    }
}

function gasto_detalhes(int $cod): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM gastos WHERE cod = :cod;');
    $data = [
        'cod' => $cod
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar dados do gasto [$cod].", E_USER_ERROR);
    }

    return $stmt->fetch();
}

function total_gasto(int $despesa): float {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT SUM(valor) AS total FROM gastos WHERE despesa = :despesa;');
    $data = [
        ':despesa' => $despesa
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os gastos da despesa [$despesa].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetch();
    if($data === false) return  0.0;
    return round($data['total'], 2);
}

function total_pago(int $despesa): float {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT SUM(valor) AS total FROM gastos WHERE despesa = :despesa AND pagoem NOT LIKE "0000-00-00";');
    $data = [
        ':despesa' => $despesa
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os gastos pagos da despesa [$despesa].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetch();
    if($data === false) return  0.0;
    return round($data['total'], 2);
}

function gastos_listar(int $despesa): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM gastos WHERE despesa = :despesa;');
    $data = [
        ':despesa' => $despesa
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os gastos da despesa [$despesa].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function gastos_filtrar(string $periodoInicial, string $periodoFinal, string $gastoemInicial, string $gastoemFinal, string $vencimentoInicial, string $vencimentoFinal, string $pagoemInicial, string $pagoemFinal, string $observacao, string $observacao_pgto, string $credor, string $mp, float $valorInicial, float $valorFinal, string $agrupador, string $localizador): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT despesas.periodo AS periodo, despesas.descricao AS descricao, gastos.* FROM despesas, gastos WHERE despesas.cod = gastos.despesa AND (despesas.periodo BETWEEN :periodoInicial AND :periodoFinal) AND (gastos.gastoem BETWEEN :gastoemInicial AND :gastoemFinal) AND (gastos.vencimento BETWEEN :vencimentoInicial AND :vencimentoFinal) AND (gastos.pagoem BETWEEN :pagoemInicial AND :pagoemFinal) AND (gastos.observacao LIKE :observacao) AND (gastos.observacao_pgto LIKE :observacao_pgto) AND (gastos.credor LIKE :credor) AND (gastos.mp LIKE :mp) AND (gastos.valor BETWEEN :valorInicial AND :valorFinal) AND (gastos.agrupador LIKE :agrupador) AND (gastos.localizador LIKE :localizador);');
    $data = [
        'periodoInicial' => periodo2int($periodoInicial),
        'periodoFinal' => periodo2int($periodoFinal),
        'gastoemInicial' => $gastoemInicial,
        'gastoemFinal' => $gastoemFinal,
        'vencimentoInicial' => $vencimentoInicial,
        'vencimentoFinal' => $vencimentoFinal,
        'pagoemInicial' => $pagoemInicial,
        'pagoemFinal' => $pagoemFinal,
        'observacao' => $observacao,
        'observacao_pgto' => $observacao_pgto,
        'credor' => $credor,
        'mp' => $mp,
        'valorInicial' => $valorInicial,
        'valorFinal' => $valorFinal,
        'agrupador' => $agrupador,
        'localizador' => $localizador
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao filtrar os gastos.", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function pagar(int $cod, string $pagoem, string $observacao_pgto): void {
    $gasto = gasto_detalhes($cod);
    $detalhes = despesa_detalhes($gasto['despesa']);
    periodo_permite_lancamento(int2periodo($detalhes['periodo']));
    
    $dbh = connect();
    $stmt = $dbh->prepare('UPDATE gastos SET pagoem = :pagoem, observacao_pgto = :observacao_pgto WHERE cod = :cod;');
    $data = [
        'cod' => $cod,
        'pagoem' => $pagoem,
        'observacao_pgto' => $observacao_pgto
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao pagar gasto [$cod].", E_USER_ERROR);
    }
    
}

/**
 * 
 * @param string $periodo AAAA-MM
 * @return array
 */
function despesas_periodo(string $periodo): array {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM despesas WHERE periodo = :periodo ORDER BY descricao ASC;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar as despesas para [$periodo].", E_USER_ERROR);
    }
//    $stmt->debugDumpParams();
    $data = $stmt->fetchAll();
    if($data === false) return  [];
    return $data;
}

function despesa_parcelar(array $periodos, string $descricao, string $credor, array $valores, array $vencimentos, string $agrupador, string $localizador, string $gastoem, string $mp, string $observacao): array {
    $cod = [];
    $nvezes = sizeof($periodos);
    for($i = 1; $i <= $nvezes; $i++){
        $cod[$i] = despesa_adicionar($periodos[$i], "$descricao ($i/$nvezes)", $valores[$i]);
        if($vencimentos[$i] == ''){
            $vencimento = '0000-00-00';
        }else{
            $vencimento = $vencimentos[$i];
        }
        gastar($cod[$i], $gastoem, "$descricao ($i/$nvezes)", $valores[$i], $credor, $mp, $vencimento, $agrupador, $localizador, '0000-00-00', '');
    }
    return $cod;
}
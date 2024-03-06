<?php

require_once 'db.php';
//require_once '../app/despesa.php';
//require_once '../app/receita.php';
require_once 'despesa.php';
require_once 'receita.php';

/**
 * Converte AAAA-MM para AAAAMM
 * 
 * @param string $periodo AAAA-MM
 * @return int AAAAMM
 */
function periodo2int(string $periodo): int {
    $dt = date_create_from_format('Y-m-d', $periodo.'-01');
    return (int) $dt->format('Ym');
}

/**
 * Converte AAAAMM para AAAA-MM
 * @param int $periodo AAAAMM
 * @return string AAAA-MM
 */
function int2periodo(int $periodo): string {
    $dt = date_create_from_format('Ymd', $periodo.'01');
    return $dt->format('Y-m');
}

/**
 * Converte AAAA-MM para MM/AAAA
 * @param string $periodo AAAA-MM
 * @return string MM/AAAA
 */
function format_periodo(string $periodo): string {
    $dt = date_create_from_format('Y-m-d', "$periodo-15");
    return $dt->format('m/Y');
}

/**
 * Converte AAAA-MM-DD para DD/MM/AAAA.
 * 
 * @param string $date AAAA-MM-DD
 * @return string DD/MM/AAAA
 */
function format_date(string $date): string {
    if ($date === '')
        return '';
    if ($date === '0000-00-00')
        return '';
    $dt = date_create_from_format('Y-m-d', $date);
    return $dt->format('d/m/Y');
}

/**
 * Identifica se o período pode receber lançamentos.
 * 
 * @param string $periodo AAAA-MM
 * @return bool
 */
function periodo_aberto(string $periodo): bool {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM fechado WHERE periodo = :periodo;');
    $data = [
        'periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao verificar se o período [$periodo] está aberto ou fechado.", E_USER_ERROR);
    }

    $ultimo = $stmt->fetch();
    if ($ultimo === false)
        return true;
    if ($ultimo['periodo'] >= periodo2int($periodo))
        return false;

    return true;
}

/**
 * Retorna o último período fechado
 * @return string AAAA-MM
 */
function periodo_ultimo_fechado(): string {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT * FROM fechado ORDER BY periodo DESC;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao buscar último período fechado.", E_USER_ERROR);
    }

    $ultimo = $stmt->fetch();
    if ($ultimo === false)
        return '';
    return int2periodo($ultimo['periodo']);
}

/**
 * Verifica se é permitido lançar no período.
 * 
 * Se o período está fechado, dispara um E_USER_ERROR.
 * 
 * @param string $periodo AAAA-MM
 * @return void
 */
function periodo_permite_lancamento(string $periodo): void {
    if (periodo_aberto($periodo) === false) {
        trigger_error("Período [$periodo] já está fechado.", E_USER_ERROR);
    }
}

/**
 * 
 * @param string $periodo AAAA-MM
 * @return string AAAA-MM
 */
function periodo_anterior(string $periodo): string {
    $di = new DateInterval('P1M');
    $dt = date_create_from_format('Y-m-d', "$periodo-15");
    $dt->sub($di);
    return $dt->format('Y-m');
    /*$mes = substr($periodo, 5);
    $ano = substr($periodo, 0, 4);
    if($mes == 1){
        $mes = 12;
        $ano--;
    }else{
        $mes--;
    }
    return "$ano-$mes";*/
}

/**
 * 
 * @param string $periodo AAAA-MM
 * @return string AAAA-MM
 */
function periodo_posterior(string $periodo): string {
    $di = new DateInterval('P1M');
    $dt = date_create_from_format('Y-m-d', "$periodo-15");
    $dt->add($di);
    return $dt->format('Y-m');
}

/**
 * 
 * @param string $vencimento AAAA-MM-DD
 * @return string
 */
function vencimento_posterior(string $vencimento): string {
    $di = new DateInterval('P30D');
    $dt = date_create_from_format('Y-m-d', $vencimento);
    if (!$dt)
        return '';
    $dt->add($di);
    return $dt->format('Y-m-d');
}

function resultado_anterior(string $periodo): float {
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT SUM(valor) as total FROM receitas WHERE periodo < :periodo;');
    $data = [
        'periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar receita acumulada antes do período [$periodo].", E_USER_ERROR);
    }
    $receita = $stmt->fetch()['total'];

    $stmt = $dbh->prepare('SELECT SUM(valor) as total FROM despesas WHERE periodo < :periodo;');
    $data = [
        'periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar despesa acumulada antes do período [$periodo].", E_USER_ERROR);
    }
    $despesa = $stmt->fetch()['total'];

    return round($receita - $despesa, 2);
}

/**
 * Fecha o período.
 * 
 * 1º Testa se está aberto.
 * 2º Testa se o anterior está fechado.
 * 3º Testa se não tem gastos a pagar.
 * 4º Iguala receita prevista ao recebido.
 * 5º Iguala despesa prevista ao gasto.
 * 6º Fecha.
 * 
 * @param string $periodo
 * @return void
 */
function fechar_periodo(string $periodo): void {
    // 1º Testa se está aberto.
    if (periodo_aberto($periodo) === false) {
        trigger_error("Período $periodo não está aberto.", E_USER_ERROR);
    }

    // 2º Testa se o anterior está fechado.
    $anterior = periodo_anterior($periodo);
    if (periodo_aberto($anterior) === true) {
        trigger_error("Período anterior [$anterior] não está fechado.", E_USER_ERROR);
    }

    // 3º Testa se não tem gastos a pagar.
    $dbh = connect();
    $stmt = $dbh->prepare('SELECT COUNT(gastos.pagoem) AS total FROM despesas, gastos WHERE gastos.despesa = despesas.cod AND despesas.periodo = :periodo AND gastos.pagoem LIKE "0000-00-00";');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar os gastos não pagos do período [$periodo].", E_USER_ERROR);
    }
    if ($stmt->fetch()['total'] > 0) {
        trigger_error("Existem gastos não pagos no período $periodo", E_USER_ERROR);
    }

    // 4º Iguala receita prevista ao recebido.
    $receitas = receitas_periodo($periodo);
    foreach ($receitas as $item) {
        $cod = $item['cod'];
        $recebido = total_recebido($cod);
        receita_alterar($cod, $periodo, $item['descricao'], $item['devedor'], $recebido, $item['vencimento'], $item['agrupador'], $item['localizador']);
    }

    // 5º Iguala despesa prevista ao gasto.
    $despesas = despesas_periodo($periodo);
    foreach ($despesas as $item) {
        $cod = $item['cod'];
        $gasto = total_gasto($cod);
        despesa_atualizar_valor($cod, $gasto);
    }
    
    // 6º Fecha.
    $stmt = $dbh->prepare('DELETE FROM fechado;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao apagar último período fechado.", E_USER_ERROR);
    }
    $stmt = $dbh->prepare('INSERT INTO fechado (periodo) VALUES(:periodo);');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao salvar o período [$periodo] como fechado.", E_USER_ERROR);
    }
}

/**
 * Abre/reabre o período.
 * 
 * 1º Testa se está fechado.
 * 2º Testa se o posterior está aberto.
 * 3º Abre.
 * 
 * @param string $periodo
 * @return void
 */
function abrir_periodo(string $periodo): void {
    // 1º Testa se está fechado.
    if (periodo_aberto($periodo) === true) {
        trigger_error("Período $periodo não está fechado.", E_USER_ERROR);
    }

    // 2º Testa se o posterior está aberto.
    $posterior = periodo_posterior($periodo);
    if (periodo_aberto($posterior) === false) {
        trigger_error("Período anterior [$posterior] não está aberto.", E_USER_ERROR);
    }

    // 3º Abre.
    $dbh = connect();
    $stmt = $dbh->prepare('DELETE FROM fechado;');
    if ($stmt->execute() === false) {
        trigger_error("Falha ao apagar último período fechado.", E_USER_ERROR);
    }
    $stmt = $dbh->prepare('INSERT INTO fechado (periodo) VALUES(:periodo);');
    $data = [
        ':periodo' => periodo2int(periodo_anterior($periodo))
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao salvar o período anterior de $periodo como fechado.", E_USER_ERROR);
    }
}

/**
 * 
 * @param string $periodo AAAA-MM
 * @return array
 */
function periodo_resumo(string $periodo): array {
    $resumo = [];
    $dbh = connect();
    
    $stmt = $dbh->prepare('SELECT SUM(valor) AS total FROM receitas WHERE periodo = :periodo;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar o valor da receita para [$periodo].", E_USER_ERROR);
    }
    $resumo['receita'] = $stmt->fetch()['total'];
    
    $stmt = $dbh->prepare('SELECT SUM(recebimentos.valor) AS total FROM receitas, recebimentos WHERE receitas.periodo = :periodo AND recebimentos.receita = receitas.cod;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar o valor da recebimentos para [$periodo].", E_USER_ERROR);
    }
    $resumo['recebido'] = $stmt->fetch()['total'];
    
    $stmt = $dbh->prepare('SELECT SUM(valor) AS total FROM despesas WHERE periodo = :periodo;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar o valor da despesas para [$periodo].", E_USER_ERROR);
    }
    $resumo['despesa'] = $stmt->fetch()['total'];
    
    $stmt = $dbh->prepare('SELECT SUM(gastos.valor) AS total FROM despesas, gastos WHERE despesas.periodo = :periodo AND gastos.despesa = despesas.cod;');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar o valor da gastos para [$periodo].", E_USER_ERROR);
    }
    $resumo['gasto'] = $stmt->fetch()['total'];
    
    $stmt = $dbh->prepare('SELECT SUM(gastos.valor) AS total FROM despesas, gastos WHERE despesas.periodo = :periodo AND gastos.despesa = despesas.cod AND pagoem NOT LIKE "0000-00-00";');
    $data = [
        ':periodo' => periodo2int($periodo)
    ];
    if ($stmt->execute($data) === false) {
        trigger_error("Falha ao buscar o valor da pagamentos para [$periodo].", E_USER_ERROR);
    }
    $resumo['pago'] = $stmt->fetch()['total'];
    
    $resumo['resultado_anterior'] = resultado_anterior($periodo);
    $resumo['resultado_periodo'] = round($resumo['receita'] - $resumo['despesa'], 2);
    $resumo['resultado_acumulado'] = round($resumo['resultado_anterior'] + $resumo['resultado_periodo'], 2);
    
    return $resumo;
}
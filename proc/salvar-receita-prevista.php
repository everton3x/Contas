<?php

//echo '<pre>', print_r($_POST), '</pre>';
//exit();

$parcelas = count($_POST['mes']);

foreach ($_POST['mes'] as $i => $null) {


    /*
     * Prepara o ambiente
     */
    $errors = [];

    /*
     * Pega os dados
     */
    $mes = $_POST['mes'][$i] ?? null;
    $nome = $_POST['nome'] ?? null;
    $descricao = $_POST['descricao'] ?? '';
    $valor_inicial = $_POST['valor_inicial'][$i] ?? 0;
    $vencimento = $_POST['vencimento'][$i] ?? '';
    $recebido = $_POST['recebido'][$i] ?? false;
    
    /*
     * Testa os falores recebidos
     */
    if (is_null($mes)) {
        $errors['mes'] = 'Mês inválido!';
    } else {
        $mes = desformata_mes($mes);
    }

    if (is_null($nome)) {
        $errors['nome'] = 'Receita inválida!';
    }

    /*
     * Se houverem erros, retorna, se não, salva
     */
    if (count($errors) > 0) {
        $errors = new ArrayIterator($errors);
        require 'out/errors.php';
    } else {
        /*
         * Previsão
         */
//        $nova = new Receita($db, null, (int) $mes, (string) $nome, (string) $descricao." ($i/$parcelas)", (float) $valor_inicial, (string) $vencimento, (string) $recebido);
        $receita = new Receita($db, null, (int) $mes, (string) $nome, (string) $descricao." ($i/$parcelas)", (float) $valor_inicial, (string) $vencimento);

        if ($receita->cod > 0) {
            $msg = new ArrayIterator(["Receita salva com código $receita->cod ($i/$parcelas)!"]);
            require 'out/success.php';
        } else {
            $errors = new ArrayIterator(["Parcela $i/$parcelas: {$db->errorInfo()}"]);
            require 'out/errors.php';
        }
        
        /*
         * recebimento
         */
        
        if($recebido){
            if($receita->salvaRecebimento($receita->cod, $recebido, $valor_inicial, $descricao)){
                $msg = new ArrayIterator(["Recebimento salvo com código {$db->lastInsertId()} para receita $receita->cod ($i/$parcelas)!"]);
                require 'out/success.php';
            }else{
                $errors = new ArrayIterator(["Parcela $i/$parcelas: {$db->errorInfo()}"]);
                require 'out/errors.php';
            }
        }
        
    }
}
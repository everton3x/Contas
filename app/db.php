<?php

/**
 * Coneca ao banco de dados.
 * 
 * @return \PDO
 */
function connect(): \PDO {
//    $dbh = new PDO('mysql:host=localhost;dbname=id18621418_contas', 'id18621418_satan', 'yxhkcB1M68u7qb?-');
    $path = realpath(__DIR__);
    $dbh = new PDO(sprintf('sqlite:%s/contas5.sqlite', $path));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $dbh;
}
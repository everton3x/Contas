<?php

/**
 * Coneca ao banco de dados.
 * 
 * @return \PDO
 */
function connect(): \PDO {
//    $dbh = new PDO('mysql:host=localhost;dbname=id18621418_contas', 'id18621418_satan', 'yxhkcB1M68u7qb?-');
    $dbh = new PDO('sqlite:../contas5.sqlite');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $dbh;
}
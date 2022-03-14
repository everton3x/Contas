<?php

/**
 * Coneca ao banco de dados.
 * 
 * @return \PDO
 */
function connect(): \PDO {
    $dbh = new PDO('mysql:host=localhost;dbname=contas', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $dbh;
}
<?php
// j'ai créer une fonction pour me connecter à la bdd
function connect()
{
    require './config/config.php';
    try {
        $options = [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ERRMODE // j'active l'affichage des erreurs et exception sql
        ];
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
        return $bdd;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
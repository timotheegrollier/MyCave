<?php
require('config/db_connect.php');
function getBottles()
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd->query('SELECT id, name, year, grapes, country,region,description,picture FROM bottles');
}
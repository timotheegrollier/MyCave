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

function userConnect($pseudo)
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare('SELECT pseudo, password FROM users WHERE pseudo = ?');
    $req->execute(array($pseudo));
    return $req->fetch(PDO::FETCH_ASSOC);
}

function getBottle($idBottle)
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare('SELECT * FROM bottles WHERE id = ?');
    $req->execute(array($idBottle));
    return $req->fetch(PDO::FETCH_ASSOC);
}
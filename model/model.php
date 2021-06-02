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

function userConnect($email)
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare('SELECT email,pseudo, password FROM users WHERE email = ?');
    $req->execute(array($email));
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


function changeBottle($idBottle)
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare('UPDATE bottles SET name = :newName, country = :newCountry, region = :newRegion,year = :newYear ,grapes=:newGrapes, description = :newDescription  WHERE id = ' . $idBottle);
    return $req;
}





function setBottle()
{
    try {
        $bdd = connect();
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $req = $bdd->prepare('INSERT INTO bottles(name,year,grapes,country,region,description,picture) VALUES(:name,:year,:grapes,:country,:region,:description,:picture)');
    return $req;
}
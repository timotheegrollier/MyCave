<?php
require('model/model.php');

function index()
{
    require('./view/home/home.php');
}

function cave()
{
    $bottles = getBottles()->fetchAll(PDO::FETCH_ASSOC);
    require('./view/cave/cave.php');
}



function connectUser()
{
    $logs = [];
    $logsErrors = [];

    // VERIF DE lA CONNECTION
    if (!empty($_POST)) {

        if (!empty($_POST['pseudo'])) {
            $logs['pseudo'] = htmlspecialchars(strip_tags($_POST['pseudo']));
            $userLog = userConnect($logs['pseudo']);
            if (!$userLog) {
                $logsErrors['noUser'] = "Mauvais ID ou MDP ! ";
                require "./view/home/noConnect.php";
            } else {

                if (!empty($_POST['password'])) {
                    $logs['password'] = htmlspecialchars(strip_tags($_POST['password']));
                    $isPasswordCorrect = password_verify($logs['password'], $userLog['password']);
                    var_dump($isPasswordCorrect);
                    if ($isPasswordCorrect) {
                        // AJOUTE LES SESSIONS

                        session_start();
                        $_SESSION['pseudo'] = $logs['pseudo'];


                        header('Location: ?action=home');
                        exit();
                    } else {
                        $logsErrors['password'] = "Mauvais ID ou MDP !";
                        require "./view/home/noConnect.php";
                    }
                } else {
                    $logsErrors['noPass'] = "Veuillez entrez un mot de passe !";
                    require "./view/home/noConnect.php";
                }
            }
        } else {
            $logsErrors['pseudo'] = "Veuillez entrez un pseudo ! ";
            require "./view/home/noConnect.php";
        }
    } else {
        $logsError['noId'] = "Veuillez entrez des identifiants valide";
        require "./view/home/noConnect.php";
    }
}


// DECONNEXION 

function disconnect()
{
    session_start();

    $_SESSION = array();
    session_destroy();

    header("Location: ?action=home");
    exit();
}


// AFFICHAGE D'UNE BOUTEILLE

function showBottle()
{
    $bottle = getBottle($_GET['id']);
    require "./view/bottle/bottle.php";
}
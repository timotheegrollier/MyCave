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


function notFound()
{
    require "./view/404/404.php";
}






function connectUser()
{
    $logs = [];
    $logsErrors = [];

    // VERIF DE lA CONNECTION
    if (!empty($_POST)) {

        if (!empty($_POST['email'])) {
            $logs['email'] = htmlspecialchars(strip_tags($_POST['email']));
            if (!filter_var($logs['email'], FILTER_VALIDATE_EMAIL)) {
                $logsErrors['email'] = "Adresse Email invalide !";
                require "./view/parts/noConnect.php";
            } else {

                $userLog = userConnect($logs['email']);

                if (!$userLog) {
                    $logsErrors['noUser'] = "Mauvais Email ou MDP ! ";
                    require "./view/parts/noConnect.php";
                } else {

                    if (!empty($_POST['password'])) {
                        $logs['password'] = htmlspecialchars(strip_tags($_POST['password']));
                        $isPasswordCorrect = password_verify($logs['password'], $userLog['password']);
                        // var_dump($isPasswordCorrect);
                        if ($isPasswordCorrect) {
                            // AJOUTE LES SESSIONS
                            $logs['pseudo'] = $userLog['pseudo'];
                            session_start();
                            $_SESSION['pseudo'] = $logs['pseudo'];
                            $_SESSION['email'] = $logs['email'];
                            header('Location: ?action=home');
                            exit();
                        } else {
                            $logsErrors['password'] = "Mauvais ID ou MDP !";
                            require "./view/parts/noConnect.php";
                        }
                    } else {
                        $logsErrors['noPass'] = "Veuillez entrez un mot de passe !";
                        require "./view/parts/noConnect.php";
                    }
                }
            }
        } else {
            $logsErrors['noId'] = "Veuillez un Email !";
            require "./view/parts/noConnect.php";
        }
    } else {
        $logsErrors['error'] = "erreur";
        require "./view/parts/noConnect.php";
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
    if (!empty($_GET['id'])) {
        $bottles = getBottles()->fetchAll(PDO::FETCH_ASSOC);

        $bottle = getBottle($_GET['id']);
        require "./view/bottle/bottle.php";
    } else {
        header("Location: ?action=notFound");
    }
}


// EDITION D UNE BOUTEILLE ---- UPDATE

function editBottle()
{
    $bottle = getBottle($_GET['id']);
    $editDATA = [];
    $editErrors = [];


    // CONTROLE DU POST D UPDATE
    if (!isset($_POST)) {
        $editErrors['noPost'] = "Aucune données reçu !";
        require_once "./view/parts/noConnect.php";
    } else {



        // EDIT NAME

        if (empty($_POST['name'])) {
            $editDATA['name'] = $bottle['name'];
        } else {
            if (!is_string($_POST['name']) || strlen($_POST['name']) < 4 || strlen($_POST['name']) >= 25) {
                $editErrors['name'] = "Nom invalide !";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['name'] = strtoupper(strip_tags(htmlspecialchars($_POST['name'])));
            }
        }


        // EDIT COUNTRY
        if (empty($_POST['country'])) {
            $editDATA['country'] = $bottle['country'];
        } else {
            if (!is_string($_POST['country']) || strlen($_POST['country']) < 3 || strlen($_POST['country']) >= 20) {
                $editErrors['country'] = "Pays invalide !";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['country'] = strip_tags(htmlspecialchars($_POST['country']));
            }
        }


        // EDIT REGION
        if (empty($_POST['region'])) {
            $editDATA['region'] = $bottle['region'];
        } else {
            if (!is_string($_POST['region']) || strlen($_POST['region']) < 4 || strlen($_POST['region']) >= 20) {
                $editErrors['region'] = "Région invalide !";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['region'] = strip_tags(htmlspecialchars($_POST['region']));
            }
        }


        // EDIT YEAR
        if (empty($_POST['year'])) {
            $editDATA['year'] = $bottle['year'];
        } else {
            if (is_int($_POST['year'] == false) || $_POST['year'] < 1700 || $_POST['year'] >= 2022) {
                $editErrors['year'] = "Année invalide !";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['year'] = strip_tags(htmlspecialchars($_POST['year']));
            }
        }






        // EDIT GRAPES
        if (empty($_POST['grapes'])) {
            $editDATA['grapes'] = $bottle['grapes'];
        } else {
            if (!is_string($_POST['grapes']) || strlen($_POST['grapes']) < 4 || strlen($_POST['grapes']) >= 20) {
                $editErrors['grapes'] = "Raisin invalide!";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['grapes'] = strip_tags(htmlspecialchars($_POST['grapes']));
            }
        }


        // EDIT DESCRIPTION
        if (empty($_POST['description'])) {
            $editDATA['description'] = $bottle['description'];
        } else {
            if (!is_string($_POST['description']) || strlen($_POST['description']) < 10) {
                $editErrors['description'] = "Description trop courte ou invalide";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['description'] = strip_tags(htmlspecialchars($_POST['description']));
            }
        }
    }
    if (empty($editErrors)) {
        $req = changeBottle($_GET['id']);
        $req->execute(array('newName' => $editDATA['name'], 'newRegion' => $editDATA['region'], 'newCountry' => $editDATA['country'], 'newYear' => $editDATA['year'], 'newGrapes' => $editDATA['grapes'], 'newDescription' => $editDATA['description']));
        header('location:?action=bottle&id=' . $_GET['id']);
        exit;
    } else {
        require_once './view/parts/noConnect.php';
    }
}
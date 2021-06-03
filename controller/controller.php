<?php
require('./model/model.php');

function index()
{
    require('./view/home/home.php');
}

function cave()
{
    require('./view/cave/cave.php');
    $bottles = getBottles()->fetchAll(PDO::FETCH_ASSOC);
}


function notFound()
{
    require "./view/404/404.php";
}




function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
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
        require "./view/bottle/bottle.php";
        $bottles = getBottles()->fetchAll(PDO::FETCH_ASSOC);

        $bottle = getBottle($_GET['id']);
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
            if (strlen($_POST['name']) < 4 || strlen($_POST['name']) >= 25) {
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
            if (strlen($_POST['country']) < 3 || strlen($_POST['country']) >= 20) {
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
            if (strlen($_POST['region']) < 4 || strlen($_POST['region']) >= 20) {
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
            if (strlen($_POST['grapes']) < 4 || strlen($_POST['grapes']) >= 20) {
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
            if (strlen($_POST['description']) < 5 || strlen($_POST['description']) >= 250) {
                $editErrors['description'] = "Description trop courte ou invalide";
                require_once "./view/parts/noConnect.php";
            } else {
                $editDATA['description'] = strip_tags(htmlspecialchars($_POST['description']));
            }
        }




        // EDIT PICTURE


        if (is_uploaded_file($_FILES['picture']['tmp_name'])) {


            $newFileName = generateRandomString();
            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $bonneExtensions = ["jpg", "png", "gif", "jfif"];
            $uploads_dir = './public/img/noBg';
            $editDATA['picture'] = $_FILES["picture"]["tmp_name"];
            $name = basename($_FILES["picture"]["name"]);

            if (in_array($extension, $bonneExtensions)) {
                if ($_FILES['picture']['size'] <= 3000000) {

                    if (!is_dir($uploads_dir)) {
                        mkdir($uploads_dir);
                    } else {
                        move_uploaded_file($editDATA['picture'], "$uploads_dir/$name");
                        rename("$uploads_dir/$name", "$uploads_dir/$newFileName.$extension");
                        $editDATA['picture'] = $newFileName . "." . $extension;
                    }
                } else {
                    $addErrors['pictureSize'] = "Poid de l'image supérieur a la limite de 3Mo";
                }
            } else {
                $addErrors['pictureExtension'] = "Mauvaise extension d'image";
            }
        } else {
            $editDATA['picture'] = "generic.png";
        }
    }



    // SI PAS DERREURS ON EXECUTE LA REQUETE
    if (empty($editErrors)) {
        $req = changeBottle($_GET['id']);
        $req->execute(array(
            'newName' => $editDATA['name'],
            'newRegion' => $editDATA['region'],
            'newCountry' => $editDATA['country'],
            'newYear' => $editDATA['year'],
            'newGrapes' => $editDATA['grapes'],
            'newDescription' => $editDATA['description'],
            'newPicture' => $editDATA['picture'],
        ));
        header('location:?action=bottle&id=' . $bottle['id']);
        exit;
    } else {
        require_once './view/parts/noConnect.php';
    }
}


// AJOUT DE BOUTEILLE --CREATE


function addBottle()
{
    $addDATA = [];
    $addErrors = [];

    if (!empty($_POST)) {

        // ADD NAME


        if (empty($_POST['name'])) {
            $addErrors['noName'] = "Vous devez ajouter un nom !";
            require("./view/parts/noConnect.php");
        } else {
            if (strlen($_POST['name']) < 3 || strlen($_POST['name']) > 30) {
                $addErrors['noName'] = "Le nom n'est pas valide !";
                require("./view/parts/noConnect.php");
            } else {
                $addDATA['name'] = strtoupper(htmlspecialchars(strip_tags($_POST["name"])));
            }
        }

        // ADD COUNTRY

        if (empty($_POST["country"])) {
            $addErrors['noCountry'] = "Vous devez ajouter un pays !";
            require("./view/parts/noConnect.php");
        } else {
            if (strlen($_POST['country']) < 2 || strlen($_POST["country"]) >= 20) {
                $addErrors['country'] = "Le pays est invalide !";
                require("./view/parts/noConnect.php");
            } else {
                $addDATA['country'] = trim(stripslashes(htmlspecialchars(strip_tags($_POST["country"]))));
            }
        }



        // ADD REGION


        if (empty($_POST["region"])) {
            $addErrors['noRegion'] = "Vous devez ajouter une Région !";
            require("./view/parts/noConnect.php");
        } else {
            if (strlen($_POST['region']) < 3 || strlen($_POST["region"]) > 30) {
                $addErrors['region'] = "La région n'est pas valide !";
                require("./view/parts/noConnect.php");
            } else {
                $addDATA['region'] = trim(stripslashes(htmlspecialchars(strip_tags($_POST["region"]))));
            }
        }

        // ADD YEAR


        if (empty($_POST["year"])) {
            $addErrors['noYear'] = "Vous devez ajouter un millésime !";
            require("./view/parts/noConnect.php");
        } else {
            if (is_int($_POST['year'] == false) || $_POST['year'] < 1700 || $_POST['year'] >= 2022) {
                $addErrors['year'] = "Le millésime est invalide !";
                require("./view/parts/noConnect.php");
            } else {
                $addDATA['year'] = trim(stripslashes(htmlspecialchars(strip_tags($_POST["year"]))));
                // var_dump($addDATA['year']);
            }
        }


        // ADD GRAPES 
        if (empty($_POST['grapes'])) {
            $addErrors['noGrapes'] = "Vous devez ajouter une variété !";
            require("./view/parts/noConnect.php");
        } else {
            if (strlen($_POST['grapes']) < 3 || strlen($_POST['grapes']) >= 20) {
                $addErrors['grapes'] = "Raisin invalide!";
                require_once "./view/parts/noConnect.php";
            } else {
                $addDATA['grapes'] = trim(stripslashes(strip_tags(htmlspecialchars($_POST['grapes']))));
                // var_dump($addDATA['grapes']);
            }
        }





        // ADD DESCRIPTION
        if (empty($_POST['description'])) {
            $addDATA['description'] = "";
        } else {
            if (strlen($_POST['description']) < 10 ) {
                $addErrors['description'] = "Description invalide !";
                require_once "./view/parts/noConnect.php";
            } else {
                $addDATA['description'] = trim(stripslashes(strip_tags(htmlspecialchars($_POST['description']))));
                // var_dump($addDATA['description']);
            }
        }

        // ADD IMAGE

        $newFileName = generateRandomString();
        $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        $bonneExtensions = ["jpg", "png", "gif", "jfif"];
        $uploads_dir = './public/img/noBg';

        if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
            $addDATA['picture'] = $_FILES["picture"]["tmp_name"];
            $name = basename($_FILES["picture"]["name"]);
            if (in_array($extension, $bonneExtensions)) {
                if ($_FILES['picture']['size'] <= 3000000) {

                    if (!is_dir($uploads_dir)) {
                        mkdir($uploads_dir);
                    } else {
                        move_uploaded_file($addDATA['picture'], "$uploads_dir/$name");
                        rename("$uploads_dir/$name", "$uploads_dir/$newFileName.$extension");
                        $addDATA['picture'] = $newFileName . "." . $extension;
                    }
                } else {
                    $addErrors['pictureSize'] = "Poid de l'image supérieur a la limite de 3Mo";
                }
            } else {
                $addErrors['pictureExtension'] = "Mauvaise extension d'image";
            }
        } else {
            $addDATA['picture'] = "generic.png";
        }




        // SI PAS DERREURS ON EXECUTE LA REQUETE
        if (empty($addErrors)) {
            $addReq = setBottle();
            $addReq->execute(array(
                "name" => $addDATA['name'],
                "country" => $addDATA['country'],
                "region" => $addDATA['region'],
                "year" => $addDATA['year'],
                "grapes" => $addDATA['grapes'],
                "description" => $addDATA['description'],
                "picture" => $addDATA['picture'],
            ));
            header("location:?action=cave");
        } else {
            require("./view/parts/noConnect.php");
        }
    }
}


// DELETE BOTTLE --DELETE 
function deleteCross()
{

    if (empty($_GET['id'])) {
        $deleteError = 1;
        require("./view/parts/noConnect.php");
    } else {
        $req = deleteBottle($_GET['id']);
        header("location: ?action=cave");
    }
}
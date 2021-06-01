<!-- Router si je prend la valeur de $_GET['action'] et j' appelle la méthode de mon controller correspondant
Je fais un require de mon controller afin de pouvoir éxécuté les méthodes stocké dedans -->
<?php
require('controller/controller.php');
// je  vérifie si j'ai une clef action dans mon $_GET['action']

if (isset($_GET['action'])) {
    // je  vérifie si ma clef action dans mon $_GET est == à list-users
    if ($_GET['action'] == "home") {
        index();
    } elseif ($_GET['action'] == "cave") {
        cave();
    } elseif ($_GET['action'] == "connect") {
        connectUser();
    } elseif ($_GET['action'] == "disconnect") {
        disconnect();
    } elseif ($_GET['action'] == "bottle") {
        showBottle();
    } elseif ($_GET['action'] == "edit_bottle") {
        editBottle();
    } else {
        notFound();
    }
} else {
    index();
}
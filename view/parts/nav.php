<nav class="navbar navbar-expand-lg navbar-dark fixed-top ">
    <a class="navbar-brand d-none d-sm-block" href="?action=home"><img src="../../mvCave/public/img/logo.png"
            class="img-fluid w-75"></a>


    <!-- SI ON EST CONNECTE ON AFFICHE LE PSEUDO -->

    <?php if (isset($_SESSION['pseudo'])) { ?>
    <div class="d-flex col-6 justify-content-center justify-content-sm-start  text-light">
        <h3><?= $_SESSION['pseudo'] ?> </h3>
    </div><?php
            } ?>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- ON ENVOIE LA CLASSE ACTIVE SUR LES NAVLINKS SELON LA PAGE TROUVE EN GET -->

    <div class="collapse navbar-collapse navbar-light justify-content-end " id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php if (isset($_GET['action'])) {
                                    if ($_GET['action'] == 'home') {
                                        echo "active";
                                    }
                                } else {
                                    echo "active";
                                } ?> ">
                <a class="nav-link" href="?action=home">Home</a>
            </li>
            <li class="nav-item <?php if (isset($_GET['action'])) {
                                    if ($_GET['action'] == 'cave') {
                                        echo "active";
                                    }
                                } ?>">
                <a class="nav-link" href="?action=cave">Cave</a>
            </li>


            <!-- AFFICHAGE DE LA BOUTEILLE CONSULTER EN NAV  -->

            <?php if (isset($_GET['action']) && $_GET['action'] == "bottle") { ?>
            <li class="nav-item active">
                <a class="nav-link" href="?action=bottle&id=<?= $bottle['id'] ?>"><?= $bottle['name'] ?></a>
            </li><?php
                    } ?>



            <!-- ON AFFICHE UN ICONE DIFFERENTE QUAND ON EST CONNECTE ET ON REDIRIGE SUR LA fonction disconnect -->

            <?php if (isset($_SESSION['pseudo'])) { ?>
            <li><a href="?action=disconnect"><i data-toggle="modal" data-target="#exampleModal"
                        class="fas fa-power-off disconnect btn"></i></a>
            </li>
            <?php
            } else { ?>
            <!-- SINON ON AFFICHE L'ICONE BLANCHE ET ON OUVRE LA MODAL DE CONNEXION -->
            <li><i data-toggle="modal" data-target="#loginModal" class="fas fa-power-off login btn"></i></li> <?php
                                                                                                                } ?>
        </ul>

    </div>

</nav>




<!-- Modal de connexion-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="loginModal">Connexion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form class="form-inline d-flex" action="?action=connect" method="POST">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                            aria-describedby="basic-addon1" name="pseudo">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                            aria-describedby="basic-addon1" name="password">
                    </div>
                    <div class="input-group d-flex justify-content-center align-items-center w-100">
                        <button class="btn btn-outline-success" type="submit">Login</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
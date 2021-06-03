<?php session_start(); ?>

<?php $title = $bottle['name']; ?>

<?php ob_start(); ?>

<section id="bottle" class="d-flex w-100 justify-content-center align-items-center h-100">

    <div class="homeCave d-flex align-items-center col-12 col-sm-8 flex-column justify-content-center">



        <div class="h-75 d-flex flex-column align-items-center justify-content-center">


            <div class="row justify-content-center">

                <img class="bottleImg" src="../mvCave/public/img/noBg/<?= $bottle['picture'] ?>" alt="">
            </div>

            <div class="container-fluid bottleText">
                <div class="text-center">
                    <h2 class="h5 text-danger"><?= $bottle['name'] ?> </h2>
                    <p><?= $bottle['description'] ?></p>
                </div>
            </div>


            <div class="accordion container-fluid mb-5 w-100" id="accordionExample">
                <div class="card w-100 card-dark">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0" id="fuckBtn">
                            <button class="btn btn-link btn-block text-center card-btn" type="button"
                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne" id="infoBtn">
                                Informations
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse" data-parent="#accordionExample">

                        <div class="card-body card-infos">
                            <?php if (isset($_SESSION['pseudo'])) {
                                if ($_SESSION['pseudo'] == "LeCaviste") { ?>
                            <i class="fas fa-cog h-2 editIcon" data-toggle="modal" data-target="#editBottleModal"
                                role="button" aria-expanded="false" aria-controls="settingsBottle"></i>
                            <?php
                                }
                            }
                            ?>
                            <ul class="infos">
                                <li> <span class="badge badge-dark">Pays:</span> <?= $bottle['country'] ?></li>
                                <li>
                                    <span class="badge badge-dark">Région:</span> <?= $bottle['region'] ?>
                                </li>
                                <li> <span class="badge badge-dark">Millésime:</span> <?= $bottle['year'] ?></li>
                                <li> <span class="badge badge-dark">Raisins:</span> <?= $bottle['grapes'] ?></li>
                            </ul>
                        </div>

                    </div>

                </div>
            </div>



        </div>


    </div>

</section>












<!-- MODAL D'EDITION -->
<div class="modal fade" id="editBottleModal" tabindex="-1" role="dialog" aria-labelledby="editBottleModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="?action=edit_bottle&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class=" form-group">
                        <label for="bottleName">Nom:</label>
                        <input type="text" name="name" class="form-control" id="botleName"
                            placeholder="<?= $bottle['name'] ?>">

                        <div class="form-group">
                            <label for="countryBottle">Pays: </label>
                            <input type="text" name="country" class="form-control" id="countryBottle"
                                placeholder="<?= $bottle['country'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="regionBottle">Région:</label>
                            <input type="text" name="region" class="form-control" id="regionBottle"
                                placeholder="<?= $bottle['region'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="yearBottle">Millésime:</label>
                            <input type="text" name="year" class="form-control" id="yearBottle"
                                placeholder="<?= $bottle['year'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="grappesBottle">Raisin:</label>
                            <input type="text" name="grapes" class="form-control" id="grappesBottle"
                                placeholder="<?= $bottle['grapes'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="descriptionEdit">Description:</label>
                            <textarea class="form-control" name="description" id="descriptionEdit" rows="3"
                                placeholder="<?= $bottle['description'] ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1"><img class="w-25"
                                    src="./public/img/noBg/<?= $bottle['picture'] ?>" alt=""></label>
                            <input name="picture" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="row justify-content-center">
                            <input type="submit" class="btn btn-success col-4" value="Editer">
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
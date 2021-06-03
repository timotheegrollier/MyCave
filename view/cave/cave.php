<?php session_start(); ?>

<?php $title = 'cave'; ?>

<?php ob_start(); ?>
<section id="myCave" class="d-flex w-100 justify-content-center align-items-center h-100">

    <div class="cave container-fluid row">

        <?php foreach ($bottles as $bottle) {
            require "view/parts/bottleCard.php";
        } ?>


        <div class="container-fluid d-flex justify-content-center">
            <?php
            if ($_GET['action'] == 'cave')
                if (isset($_SESSION['pseudo'])) {
                    if ($_SESSION['pseudo'] == "LeCaviste") { ?>
            <button class="btn btn-success col-10 col-sm-6 col-lg-4" data-toggle="modal" data-target="#addBottleModal"
                role="button" aria-expanded="false" aria-controls="addBottle">ADD</button>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>













<!-- MODAL D'AJOUT -->
<div class="modal fade" id="addBottleModal" tabindex="-1" role="dialog" aria-labelledby="addBottleModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <form action="?action=add_bottle" method="POST" enctype="multipart/form-data">
                    <div class=" form-group">
                        <label for="bottleName"><span class="required">*</span>Nom:</label>
                        <input type="text" name="name" class="form-control" id="botleName" required>

                        <div class="form-group">
                            <label for="countryBottle"><span class="required">*</span>Pays: </label>
                            <input type="text" name="country" class="form-control" id="countryBottle" required>
                        </div>
                        <div class="form-group">
                            <label for="regionBottle"><span class="required">*</span>Région:</label>
                            <input type="text" name="region" class="form-control" id="regionBottle" required>
                        </div>
                        <div class="form-group">
                            <label for="yearBottle"><span class="required">*</span>Millésime:</label>
                            <input type="text" name="year" class="form-control" id="yearBottle" required>
                        </div>
                        <div class="form-group">
                            <label for="grappesBottle"><span class="required">*</span>Raisin:</label>
                            <input type="text" name="grapes" class="form-control" id="grappesBottle" required>
                        </div>
                        <div class="form-group">
                            <label for="descriptionEdit">Description:</label>
                            <textarea class="form-control" name="description" id="descriptionEdit" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Image</label>
                            <input name="picture" type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <div class="row justify-content-center">

                            <input type="submit" class="btn btn-success col-4" value="Ajouter">
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
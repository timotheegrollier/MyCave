<?php session_start(); ?>

<?php $title = 'home'; ?>

<?php ob_start(); ?>


<div class="container homeCave d-flex align-items-center justify-content-center col-12 col-sm-8">
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">

        <div class="container col-12">

            <a href="#" class="logo-mobile d-sm-none d-flex justify-content-center col-12"><img
                    src="public/img/logo-large.png" alt="" class="img-fluid"></a>
        </div>

        <div class="bestBottle">
            <h2 class="text-center">Nos meilleures bouteilles:</h2>
            <?php require "carousel.php" ?>
        </div>
    </div>

</div>






<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
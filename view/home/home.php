<?php session_start(); ?>

<?php $title = 'home'; ?>

<?php ob_start(); ?>


<div class="container homeCave d-flex align-items-center justify-content-center col-12 col-sm-8">
    <div class="container-fluid h-75 justify-content-center align-items-center">


        <a href="#" class="logo-mobile d-sm-none d-block col-12 text-center"><img
                src="../mvCave/public/img/logo-large.png" alt="" class="img-fluid"></a>

        <div class="bestBottle">
            <h2 class="text-center">Nos meilleures bouteilles:</h2>
            <?php require "carousel.php" ?>
        </div>
    </div>

</div>






<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
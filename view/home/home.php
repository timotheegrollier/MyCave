<?php $title = 'home'; ?>

<?php ob_start(); ?>
<div class="container homeCave d-flex align-items-center col-12 col-sm-6">
    <a href="#" class="logo-mobile"><img src="../mvCave/public/img/logo-large.png" alt="" class="img-fluid"></a>
    <div class="bestBottle">
        <h2 class="text-center">Nos meilleures bouteilles:</h2>
        <?php require "carousel.php" ?>
    </div>

</div>



<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
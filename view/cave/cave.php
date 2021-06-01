<?php session_start(); ?>

<?php $title = 'cave'; ?>

<?php ob_start(); ?>
<section id="myCave" class="d-flex w-100 justify-content-center align-items-center h-100">

    <div class="cave container-fluid row">


        <?php foreach ($bottles as $bottle) {
            require "../mvCave/view/parts/bottleCard.php";
        } ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
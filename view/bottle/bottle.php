<?php $title = "bottle"; ?>

<?php ob_start(); ?>
<section id="myCave" class="d-flex w-100 justify-content-center align-items-center h-100">
    <div class="container homeCave d-flex align-items-center col-12 col-sm-6 flex-column justify-content-start">
        <div
            class="bottleImg d-flex justify-content-center align-items-center h-50  flex-column justify-content-sm-end">
            <img src="../mvCave/public/img/noBg/<?= $bottle['picture'] ?>" alt="" class="img-fluid w-75">
        </div>
        <div class="container-fluid bottleText ">
            <div class="text-center">
                <h2 class="h5 text-danger"><?= $bottle['name'] ?> <span class="text-muted">--
                        <?= $bottle['year'] ?>
                    </span></h2>
                <p><?= $bottle['description'] ?></p>
            </div>
        </div>

    </div>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
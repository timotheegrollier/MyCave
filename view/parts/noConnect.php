<?php session_start(); ?>

<?php $title = 'ConnectError'; ?>

<?php ob_start(); ?>
<div class="error flex-column">
    <div class="container-fluid d-flex justify-content-center flex-column h1 align-items-center">
        <?php
        if (isset($logsErrors)) {
            foreach ($logsErrors as $error) {
                echo $error; ?> <div>

            <a class="btn btn-danger" href="?action=home">Retour</a>
        </div>
        <?php
            }
        } else {
            if (isset($editErrors)) {
                foreach ($editErrors as $editError) {
                    echo $editError; ?> <div>

            <a class="btn btn-danger" href="?action=bottle&id=<?= $_GET['id'] ?>">Retour</a>
        </div>
        <?php
                }
            } else {
                if (isset($addErrors)) {
                    foreach ($addErrors as $addError) {
                        echo $addError; ?>
        <div>
            <a class="btn btn-danger" href="?action=cave">Retour</a>
        </div>
        <?php

                    }
                }
            }
        } ?>
    </div>

</div>



<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
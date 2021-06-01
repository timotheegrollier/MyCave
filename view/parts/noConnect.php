<?php session_start(); ?>

<?php $title = 'ConnectError'; ?>

<?php ob_start(); ?>
<div class="error flex-column">
    <h3><?php
        if (isset($logsErrors)) {
            foreach ($logsErrors as $error) {
                echo $error; ?> <div>

            <a class="btn btn-danger" href="?action=home">Retour</a>
        </div> <?php
                    }
                } else {
                    if (isset($editErrors)) {
                        foreach ($editErrors as $editError) {
                            echo $editError; ?> <div>

            <a class="btn btn-danger" href="?action=bottle&id=<?= $_GET['id'] ?>">Retour</a>
        </div> <?php
                        }
                    }
                } ?>
    </h3>

</div>



<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
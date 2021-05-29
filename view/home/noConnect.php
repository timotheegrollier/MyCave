<?php $title = 'ConnectError'; ?>

<?php ob_start(); ?>
<div class="error flex-column">
    <h3><?php foreach ($logsErrors as $error) {
            echo $error;
        } ?></h3>


    <div>

        <a class="btn btn-danger" href="?action=home">Retour</a>
    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
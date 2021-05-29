<?php $title = 'ConnectError'; ?>

<?php ob_start(); ?>
<div class="error">
    <h3><?php foreach ($logsErrors as $error) {
            echo $error;
        } ?></h3>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>
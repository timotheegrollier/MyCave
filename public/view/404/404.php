<?php session_start(); ?>

<?php $title = "bottle"; ?>

<?php ob_start(); ?>
<div class="container-fluid h-100 d-flex align-items-center justify-content-center flex-column">
    <h1 class="display-4">404</h1>
    <h3>La page n'existe pas !</h3>
    <a href="?action=home" class="btn btn-danger">Retour</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require './view/template.php'; ?>
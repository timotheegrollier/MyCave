<?php
require('model/model.php');

function index()
{
    require('./view/home/home.php');
}

function cave()
{
    $bottles = getBottles()->fetchAll(PDO::FETCH_ASSOC);
    require('./view/cave/cave.php');
}
<?php

use App\Auth;
use App\Table\FoodTable;

Auth::check();

$title = 'Mes aliments';
$foods = (new FoodTable())->all();
?>

<a href="<?= $router->url('newFood') ?>" class="btn btn-primary mb-3">Ajouter un aliment</a>

<table class="table table-striped">
    <?php foreach ($foods as $food): ?>
        <?php require '_tile.php' ?>
    <?php endforeach; ?>
</table>
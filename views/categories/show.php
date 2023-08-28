<?php

use App\Auth;
use App\Table\CategoryTable;
use App\Table\FoodTable;

Auth::check();

$cid = (int) $params['id'];
$category = (new CategoryTable())->find($cid);
$foods = (new FoodTable())->findByCategory($cid);
$title = $category->getName();
?>

<a href="<?= $router->url('new_food') ?>" class="btn btn-primary mb-3">
    Ajouter dans <?= strtolower($category->getName()) ?>
</a>

<table class="table table-striped">
    <?php foreach ($foods as $food) : ?>
        <?php require '_tile.php' ?>
    <?php endforeach; ?>
</table>
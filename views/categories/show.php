<?php

use App\Auth;
use App\Table\CategoryTable;
use App\Table\FoodTable;

Auth::guard();

$cid = (int) $params['id'];
$category = (new CategoryTable())->find($cid);
$foods = (new FoodTable())->findAllByCid($cid);
$count = count($foods);
$title = "{$category->getName()} : $count";
?>

<a href="<?= $router->url('new_food') ?>" class="btn btn-primary mb-3">
    Ajouter dans <?= strtolower($category->getName()) ?>
</a>

<div class="card mb-3">
  <div class="card-body"><?= $count ?> aliment<?= $count > 1 ? 's' : '' ?></div>
</div>

<table class="table table-striped">
    <?php foreach ($foods as $food) : ?>
        <?php require '_tile.php' ?>
    <?php endforeach; ?>
</table>
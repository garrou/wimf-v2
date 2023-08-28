<?php

use App\Auth;
use App\Table\CategoryTable;

Auth::guard();

$title = 'Catégories';
$categories = (new CategoryTable())->all();
?>

<div class="row">
    <?php foreach ($categories as $category) : ?>
        <div class="col-sm-6 col-md-4">
            <?php require '_card.php' ?>
        </div>
    <?php endforeach; ?>
</div>

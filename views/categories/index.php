<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;

if (!Auth::isConnected()) {
    header('Location: ' . $router->url('login'));
}
$title = 'Catégories';
$categories = (new CategoryTable(Connection::getPDO()))->all();
?>

<div class="row">
    <?php foreach ($categories as $category) : ?>
        <div class="col-sm-6 col-md-4">
            <?php require '_card.php' ?>
        </div>
    <?php endforeach; ?>
</div>

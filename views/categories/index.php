<?php

use App\Auth;
use App\Connection;
use App\Table\CategoryTable;

if (!Auth::isConnected()) {
    header('Location: ' . $router->url('login'));
}
$categories = (new CategoryTable(Connection::getPDO()))->all();
?>

<table className="table table-striped">
    <tbody>
        <?php foreach ($categories as $category) : ?>
            <?php require 'tile.php' ?>
        <?php endforeach; ?>
    </tbody>
</table>

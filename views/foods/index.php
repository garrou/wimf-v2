<?php

use App\Auth;
use App\Table\FoodTable;

Auth::guard();

$foods = (new FoodTable())->findAll();
$count = count($foods);
$title = "Mes aliments : $count";
?>

<?php if (isset($_GET['deleted'])) : ?>
    <div class="alert alert-success">
        Aliment supprimé
    </div>
<?php endif; ?>

<?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">
        Aliment ajouté
    </div>
<?php endif; ?>

<?php if (isset($_GET['updated'])): ?>
    <div class="alert alert-success">
        Aliment modifié
    </div>
<?php endif; ?>

<a href="<?= $router->url('new_food') ?>" class="btn btn-primary mb-3">Ajouter un aliment</a>

<div class="card mb-3">
  <div class="card-body"><?= $count ?> aliment<?= $count > 1 ? 's' : '' ?></div>
</div>

<table class="table table-striped">
    <?php foreach ($foods as $food): ?>
        <?php require '_tile.php' ?>
    <?php endforeach; ?>
</table>
<?php

use App\Auth;
use App\Table\FoodTable;

Auth::check();

$title = 'Mes aliments';
$foods = (new FoodTable())->all('id');
?>

<?php if (isset($_GET['delete'])) : ?>
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

<table class="table table-striped">
    <?php foreach ($foods as $food): ?>
        <?php require '_tile.php' ?>
    <?php endforeach; ?>
</table>
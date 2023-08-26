<?php

use App\Auth;
use App\Connection;
use App\Helpers\ObjectHelper;
use App\Html\Form;
use App\Models\Food;
use App\Table\CategoryTable;
use App\Table\FoodTable;
use App\Validators\FoodValidator;

if (!Auth::isConnected()) {
    header('Location: ' . $router->url('login'));
}
$title = 'Ajouter un aliment';
$food = new Food();
$errors = [];
$pdo = Connection::getPDO();

if (!empty($_POST)) 
{
    $validator = new FoodValidator($_POST);

    if ($validator->isValidFood(new CategoryTable($pdo))) {
        ObjectHelper::hydrate($food, $_POST, ['name', 'quantity', 'details', 'category']);
        (new FoodTable($pdo))->create($food);
        header('Location: ' . $router->url('foods'));
    } else {
        $errors = $validator->getErrors();
    }
}
$form = new Form($food, $errors);
$categories = (new CategoryTable($pdo))->all();
?>

<form method="POST">
    <div class="text-center">
        <?= $form->input('name', "Nom de l'aliment"); ?>
        <?= $form->input('quantity', 'Quantité'); ?>
        <?= $form->input('details', 'Détails'); ?>
        
        <label for="categories" class="font-weight-bold mt-3">Catégories</label>
        <select name="category" id="categories" class="form-select">
            <?php foreach ($categories as $category) : ?> 
                <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>
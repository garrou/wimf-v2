<?php

use App\Auth;
use App\Helpers\ObjectHelper;
use App\Html\Form;
use App\Models\Food;
use App\Table\CategoryTable;
use App\Table\FoodTable;
use App\Validators\FoodValidator;

Auth::guard();

$title = 'Ajouter un aliment';
$table = new CategoryTable();
$food = new Food();
$errors = [];
$form = new Form($food, $errors);

if (!empty($_POST)) 
{
    $validator = new FoodValidator($_POST);

    if ($validator->isValidFood($table)) {
        ObjectHelper::hydrate($food, $_POST, ['name', 'quantity', 'details', 'category']);
        (new FoodTable($pdo))->create($food);
        header('Location: ' . $router->url('foods') . '?created=1');
    } else {
        $errors = $validator->getErrors();
    }
}
require '_form.php';
?>
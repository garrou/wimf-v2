<?php

use App\Auth;
use App\Helpers\ObjectHelper;
use App\Html\Form;
use App\Table\CategoryTable;
use App\Table\FoodTable;
use App\Validators\FoodValidator;

Auth::guard();

$table = new FoodTable();
$food = $table->findById($params['id']);
$errors = [];
$form = new Form($food, $errors);
$name = strtolower($food->getName());
$title = "Modifier $name";

if (!empty($_POST)) 
{
    $validator = new FoodValidator($_POST);

    if ($validator->isValidFood(new CategoryTable())) {
        ObjectHelper::hydrate($food, $_POST, ['name', 'quantity', 'details', 'category']);
        $table->update($food);
        header('Location: ' . $router->url('foods') . '?updated=1');
    } else {
        $errors = $validator->getErrors();
    }
}
require '_form.php';
?>

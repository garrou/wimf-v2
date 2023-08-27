<?php

use App\Auth;
use App\Helpers\ObjectHelper;
use App\Html\Form;
use App\Table\CategoryTable;
use App\Table\FoodTable;
use App\Validators\FoodValidator;

Auth::check();

$id = (int) $params['id'];
$table = new FoodTable();
$food = $table->find($id);
$errors = [];
$form = new Form($food, $errors);
$title = "Modifier {$food->getName()}";

if (!empty($_POST)) 
{
    $validator = new FoodValidator($_POST);

    if ($validator->isValidFood(new CategoryTable())) {
        ObjectHelper::hydrate($food, $_POST, ['name', 'quantity', 'details', 'category']);
        $table->update($food);
        header('Location: ' . $router->url('foods'));
    } else {
        $errors = $validator->getErrors();
    }
}
require '_form.php';
?>

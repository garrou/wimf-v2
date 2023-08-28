<?php

use App\Auth;
use App\Table\FoodTable;

Auth::guard();

$id = (int) $params['id'];
(new FoodTable())->deleteById($id);
header('Location: ' . $router->url('foods') . '?deleted=1');
exit();
?>
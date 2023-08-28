<?php

use App\Auth;
use App\Table\FoodTable;

Auth::guard();

(new FoodTable())->deleteById($params['id']);
header('Location: ' . $router->url('foods') . '?deleted=1');
exit();
?>
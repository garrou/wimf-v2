<?php

use App\Auth;
use App\Table\FoodTable;

Auth::check();

$id = (int) $params['id'];
(new FoodTable())->deleteByIdAndUid($id, $_SESSION['SESSION']);
header('Location: ' . $router->url('foods') . '?delete=1');
exit();
?>
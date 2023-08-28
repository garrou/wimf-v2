<?php

use App\Auth;
use App\Helpers\SessionHelper;
use App\Table\FoodTable;
use App\Table\UserTable;

Auth::guard();

$user = (new UserTable())->find(SessionHelper::extractUserId());
$foods = (new FoodTable())->resume();
?>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= $user->getUsername() ?></h5>
    </div>
</div>

<table class="table table-striped">
    <?php foreach ($foods as $food) : ?>
        <tr>
            <td><?= $food['category_name'] ?></td>
            <td><?= $food['total'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>


<?php

use App\Auth;
use App\Helpers\SessionHelper;
use App\Table\UserTable;

Auth::guard();

$user = (new UserTable())->find(SessionHelper::extractUserId());
?>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= $user->getUsername() ?></h5>
    </div>
</div>
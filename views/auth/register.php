<?php

use App\Auth;
use App\Connection;
use App\Html\Form;
use App\Models\User;
use App\Table\UserTable;
use App\Validators\UserValidator;

$title = 'Créer un compte';

$user = new User();
$errors = [];

if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {
    $table = new UserTable(Connection::getPDO());
    $validator = new UserValidator($_POST, $table, $user->getUsername());

    if ($_POST['password'] === $_POST['confirm'] && $validator->validate()) {
        $table->create($user);
        header('Location: ' . $router->url('login'));
        exit();
    } else {
        $errors = $v->errors();
    }
}

$form = new Form($user, $errors);

if (Auth::isConnected()) {
    header('Location: ' . $router->url('categories'));
}
?>

<h1 class="font-weight-normal text-center">Créer un compte</h1>

<form method="POST">
    <div class="text-center">
        <?= $form->input('username', "Nom d'utilisateur"); ?>
        <?= $form->input('password', 'Mot de passe'); ?>
        <!-- confirm -->
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Créer un compte</button>
    </div>

    <div class="text-center mt-2">
        <a href="<?= $router->url('login') ?>">Se connecter</a>
    </div>
</form>
<?php

use App\Auth;
use App\Connection;
use App\Dto\UserRegistration;
use App\Html\Form;
use App\Table\UserTable;
use App\Validators\UserValidator;

$title = 'Créer un compte';

$dto = new UserRegistration();
$errors = [];

if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm'])) {
    $table = new UserTable(Connection::getPDO());
    $validator = (new UserValidator($_POST))->userRegistration($table, $dto->getUsername());

    if ($validator->validate()) {
        $table->create($dto->toUser());
        header('Location: ' . $router->url('login'));
        exit();
    } else {
        $errors = $validator->errors();
    }
}

$form = new Form($dto, $errors);

if (Auth::isConnected()) {
    header('Location: ' . $router->url('categories'));
}
?>

<h1 class="font-weight-normal text-center">Créer un compte</h1>

<form method="POST">
    <div class="text-center">
        <?= $form->input('username', "Nom d'utilisateur"); ?>
        <?= $form->input('password', 'Mot de passe'); ?>
        <?= $form->input('confirm', 'Confirmer le mot de passe'); ?>
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Créer un compte</button>
    </div>

    <div class="text-center mt-2">
        <a href="<?= $router->url('login') ?>">Se connecter</a>
    </div>
</form>
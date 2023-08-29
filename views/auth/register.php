<?php

use App\Auth;
use App\Dto\UserAuth;
use App\Helpers\ObjectHelper;
use App\Html\Form;
use App\Table\UserTable;
use App\Validators\UserValidator;

if (Auth::isConnected()) {
    header('Location: ' . $router->url('categories'));
}
$title = 'Créer un compte';
$dto = new UserAuth();
$errors = [];

if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm'])) 
{
    $table = new UserTable();
    $validator = new UserValidator($_POST);

    if ($validator->isValidRegister($table)) {
        ObjectHelper::hydrate($dto, $_POST, ['username', 'password', 'confirm']);
        $table->create($dto->toUser());
        header('Location: ' . $router->url('login') . '?registed=1');
        exit();
    } else {
        $errors = $validator->getErrors();
    }
}
$form = new Form($dto, $errors);
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
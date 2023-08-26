<?php

use App\Auth;
use App\Connection;
use App\Html\Form;
use App\Models\User;
use App\Table\UserTable;

if (Auth::isConnected()) {
    header('Location: ' . $router->url('categories'));
}
$title = 'Se connecter';
$user = new User();
$errors = [];

if (!empty($_POST)) 
{
    $user->setUsername($_POST['username'])->setPassword($_POST['password']);
    $errors['password'] = 'Identifiant ou mot de passe incorrect';

    if (!empty($user->getUsername()) && !empty($user->getPassword())) {
        $table = new UserTable(Connection::getPDO());

        try {
            $userFound = $table->findByUsername($user->getUsername());

            if (password_verify($user->getPassword(), $userFound->getPassword())) {
                session_start();
                $_SESSION['SESSION'] = $userFound->getID();
                header('Location: ' . $router->url('categories'));
                exit();
            }
        } catch (Exception $e) {
            $errors['password'] = 'Identifiant ou mot de passe incorrect';
        }
    }
}
$form = new Form($user, $errors);
?>

<?php if (isset($_GET['forbidden'])) : ?>
    <div class="alert alert-danger">
        Vous devez vous connecter pour accéder à cette page
    </div>
<?php endif; ?>

<h1 class="font-weight-normal text-center">Se connecter</h1>

<form method="POST">
    <div class="text-center">
        <?= $form->input('username', "Nom d'utilisateur"); ?>
        <?= $form->input('password', 'Mot de passe'); ?>
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </div>

    <div class="text-center mt-2">
        <a href="<?= $router->url('register') ?>">Créer un compte</a>
    </div>
</form>
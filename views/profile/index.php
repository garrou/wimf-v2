<?php

use App\Auth;
use App\Dto\UserAuth;
use App\Helpers\ObjectHelper;
use App\Helpers\SessionHelper;
use App\Html\Form;
use App\Table\UserTable;
use App\Validators\UserValidator;

Auth::guard();
$title = 'Profil';
$errors = [];
$table = new UserTable();
$found = $table->find(SessionHelper::extractUserId());
$dto = (new UserAuth())->setUsername($found->getUsername());
$form = new Form($update, $errors);

if (isset($_POST)) 
{
    $validator = new UserValidator($_POST);

    if ($validator->isValidUpdate($table)) {
        ObjectHelper::hydrate($dto, $_POST, ['username', 'password', 'confirm']);
        // TODO: update
        header('Location: ' . $router->url('profile') . '?updated=1');
        exit();
    } else {
        $errors = $validator->getErrors();
    }
}
?>

<?php if (isset($_GET['updated'])) : ?>
    <div class="alert alert-success">Compte modifié</div>
<?php endif; ?>

<form method="POST">
    <div class="text-center">
        <?= $form->input('username', "Nom d'utilisateur"); ?>
        <?= $form->input('password', 'Mot de passe'); ?>
        <?= $form->input('confirm', 'Confirmer le mot de passe'); ?>
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
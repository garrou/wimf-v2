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

if (!empty($_POST)) 
{
    $validator = new UserValidator($_POST);

    if ($validator->isValidUpdate($table)) {
        ObjectHelper::hydrate($dto, $_POST, ['username', 'password', 'confirm']);
        
        if (!empty($dto->getUsername()) && !empty($dto->getPassword())) {
            $table->update($dto->toUser());
        } else if (!empty($dto->getUsername())) {
            $table->updateUsername($dto->getUsername());
        } else if (!empty($dto->getPassword())) {
            $table->updatePassword($dto->getPassword());
        }
        header('Location: ' . $router->url('profile') . '?updated=1');
        exit();
    } else {
        $errors = $validator->getErrors();
    }
}
$form = new Form($dto, $errors);
?>

<?php if (isset($_GET['updated'])) : ?>
    <div class="alert alert-success">Compte modifié</div>
<?php endif; ?>

<form method="POST">
    <div class="text-center">
        <?= $form->input('username', "Nom d'utilisateur", false); ?>
        <?= $form->input('password', 'Mot de passe', false); ?>
        <?= $form->input('confirm', 'Confirmer le mot de passe', false); ?>
    </div>

    <div class="text-center mt-2">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>
</form>
<?php

use App\Table\CategoryTable;

$categories = (new CategoryTable())->all();
?>

<form method="POST">
    <div class="text-center">
        <?= $form->input('name', "Nom de l'aliment"); ?>
        <?= $form->input('quantity', 'Quantité'); ?>
        <?= $form->input('details', 'Détails', false); ?>

        <label for="categories" class="font-weight-bold mt-3">Catégories</label>
        <select name="category" id="categories" class="form-select">
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category->getId() ?>" <?php if ($category->getId() == $food->getCategory()) echo 'selected'; ?>><?= $category->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary mt-3">
        <?php if ($food->getId() !== null) : ?>
            Enregistrer
        <?php else : ?>
            Ajouter
        <?php endif; ?>
    </button>
</form>
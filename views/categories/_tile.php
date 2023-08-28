<tr>
    <td><?= $food->getName() ?></td>
    <td>Quantité : <?= $food->getQuantity() ?></td>   
    <td><a class="btn btn-primary" href="<?= $router->url('edit', ['id' => $food->getId()]) ?>">Modifier</td>
    <td>
        <form action="<?= $router->url('delete_food', ['id' => $food->getId()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiment supprimer ?')" style="display:inline">
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </td>
</tr>
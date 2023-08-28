<tr>
    <td>
        <a href="<?= $router->url('edit', ['id' => $food->getId()]) ?>"><?= $food->getName() ?></a>
    </td>
    <td><?= $food->getQuantity() ?></td>
    <td>
        <form action="<?= $router->url('delete_food', ['id' => $food->getId()]) ?>" method="POST" onsubmit="return confirm('Voulez vous vraiment supprimer ?')" style="display:inline">
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </td>
</tr>
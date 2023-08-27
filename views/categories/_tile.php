<tr>
    <td>
        <a href="<?= $router->url('edit', ['id' => $food->getId()]) ?>"><?= $food->getName() ?></a>
    </td>
    <td><?= $food->getQuantity() ?></td>
</tr>
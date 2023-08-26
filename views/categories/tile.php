<tr>
    <td>
        <a href="<?= $router->url('category', ['id' => $category->getId()]) ?>">
            <img src="<?= $category->getPicture() ?>" className="img-fluid my-2" width="50" height="50" alt="Logo de la catégorie" />
        </a>
    </td>
    <td className="align-middle">
        <a className="text-decoration-none" href="<?= $router->url('category', ['id' => $category->getId()]) ?>"><?= $category->getName() ?></a>
    </td>
    <td>TEST</td>
</tr>
<div class="card mb-3">
    <div class="card-body">
        <div class="text-center">
            <a href="<?= $router->url('category', ['id' => $category->getId()]) ?>" class="btn btn-link">
                <img src="<?= $category->getPicture() ?>" class="img-fluid" width="100" height="100" />
            </a>
        </div>
        <div class="text-center">
            <a href="<?= $router->url('category', ['id' => $category->getId()]) ?>" class="text-decoration-none">
                <h5 class="card-title"><?=  $category->getName() ?> : <?=  $category->getTotal() ?></h5>
            </a>
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="fr">

<?php
use App\Auth;
use App\Html\Nav;

$nav = new Nav($router, $view);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="img/logo.png" />
    <title><?= $title ?? 'WIMF' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="container d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="<?= $router->url('categories') ?>" class="navbar-brand"><?= $logo ?? 'WIMF' ?></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#reponsiveNav" aria-controls="reponsiveNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="reponsiveNav">
            <ul class="navbar-nav">
                <?php if (Auth::isConnected()) : ?>
                    <?= $nav->link('Catégories', 'categories') ?>
                    <?= $nav->link('Aliments', 'foods') ?>
                    <?= $nav->link('Profil', 'profile') ?>
                    
                    <li class="nav-item">
                        <form action="<?= $router->url('logout') ?>" method="POST" style="display:inline">
                            <button type="submit" class="nav-link" style="background:transparent; border:none;">Se déconnecter</button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="mt-3">
        <?= $content ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>
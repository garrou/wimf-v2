<!DOCTYPE html>
<html lang="fr">

<?php
use App\Auth;
use App\Html\Nav;

$nav = new Nav($router, $view);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/logo.png" />
    <title><?= $title ?? 'WIMF' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="container">
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
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
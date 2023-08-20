<?php
http_response_code(404);
?>

<div class="text-center">
    <h1 class="text-center">PAGE INTROUVABLE</h1>
    <a href="<?= $router->url('home') ?>">Retour à l'accueil</a>
</div>
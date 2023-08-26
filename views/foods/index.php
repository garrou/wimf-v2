<?php

use App\Auth;

if (!Auth::isConnected()) {
    header('Location: ' . $router->url('login'));
}
?>
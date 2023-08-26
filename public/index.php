<?php

require '../vendor/autoload.php';

use App\Router;

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
$router
    ->get('/', '/index', 'home')
    
    ->get('/categories', '/categories/index', 'categories')
    ->get('/categories/[i:id]', '/categories/show', 'category')

    ->get('/foods', '/foods/index', 'foods')
    ->get('/foods/[i:id]', '/foods/show', 'food')
    ->match('/foods/new', '/foods/new', 'newFood')

    ->get('/profile', '/profile/index', 'profile')

    ->match('/login', '/auth/login', 'login')
    ->match('/register', '/auth/register', 'register')
    ->post('/logout', '/auth/logout' , 'logout')
    ->run();
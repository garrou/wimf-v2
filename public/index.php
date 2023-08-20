<?php

require '../vendor/autoload.php';

use App\Router;

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
$router
    // HOME
    ->get('/', '/index', 'home')
    
    // CATEGORIES
    ->get('/categories', '/categories/index', 'categories')
    ->get('/categories/[i:id]', '/categories/category', 'category')

    // FOODS
    ->get('/foods', '/foods/index', 'foods')
    ->get('/foods/[i:id]', '/foods/food', 'food')

    // PROFILE  
    ->get('/profile', '/profile/index', 'profile')

    // AUTH
    ->match('/login', '/auth/login', 'login')
    ->match('/register', '/auth/register', 'register')
    ->post('/logout', '/auth/logout' , 'logout')
    ->run();
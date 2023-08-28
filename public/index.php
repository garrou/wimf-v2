<?php

require '../vendor/autoload.php';

use App\Router;

$router = new Router(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
$router
    ->get('/', '/index', 'home')
    
    ->get('/categories', '/categories/index', 'categories')
    ->get('/categories/[i:id]', '/categories/show', 'category')

    ->get('/foods', '/foods/index', 'foods')
    ->match('/foods/[i:id]', '/foods/edit', 'edit')
    ->match('/foods/new', '/foods/new', 'new_food')
    ->post('/foods/[i:id]/delete', '/foods/delete', 'delete_food')

    ->get('/profile', '/profile/index', 'profile')
    ->match('/profile/edit_username', '/profile/edit_username', 'edit_profile_username')
    ->match('/profile/edit_password', '/profile/edit_password', 'edit_profile_pass')

    ->match('/login', '/auth/login', 'login')
    ->match('/register', '/auth/register', 'register')
    ->post('/logout', '/auth/logout' , 'logout')
    ->run();
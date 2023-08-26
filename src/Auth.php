<?php

namespace App;

use App\Exceptions\ForbiddenException;

class Auth {
    
    public static function check(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['SESSION'])) {
            throw new ForbiddenException();
        }
    }

    public static function isConnected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['SESSION']);
    }
}
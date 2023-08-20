<?php

namespace App;

use App\Exceptions\ForbiddenException;

class Auth
{
    
    /**
     * @return void
     */
    public static function check(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['auth'])) {
            throw new ForbiddenException();
        }
    }

    /**
     * @return bool
     */
    public static function isConnected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['auth']);
    }
}
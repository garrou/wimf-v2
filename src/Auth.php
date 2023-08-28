<?php

namespace App;

use App\Exceptions\ForbiddenException;
use App\Helpers\SessionHelper;

class Auth {
    
    public static function guard(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (SessionHelper::extractUserId() === null) {
            throw new ForbiddenException();
        }
    }

    public static function isConnected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return SessionHelper::extractUserId() !== null;
    }
}
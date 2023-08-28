<?php

namespace App\Helpers;

class SessionHelper
{
    public static function extractUserId(): ?string
    {
        return isset($_SESSION['SESSION']) ? $_SESSION['SESSION'] : null;
    }
}
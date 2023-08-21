<?php

namespace App;

use PDO;

class Connection {
    
    public static function getPDO(): PDO
    {
        return new PDO('pgsql:dbname=wimf;host=localhost;port=5432', 'postgres', 'admin', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}
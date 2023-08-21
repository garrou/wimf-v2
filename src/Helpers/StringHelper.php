<?php

namespace App\Helpers;

class StringHelper
{
    public static function toCamel(string $prefix, string $field): string
    {
        return $prefix . str_replace(' ', '', ucwords(str_replace('_', ' ', $field)));
    }
}

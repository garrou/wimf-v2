<?php

namespace App\Helpers;

class ObjectHelper {

    public static function hydrate(mixed $object, array $data, array $fields): void
    {
        foreach ($fields as $field) {
            $method = StringHelper::toCamel('set', $field);
            $object->$method($data[$field]);
        }
    }
}
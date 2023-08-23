<?php

namespace App\Helpers;

class ObjectHelper
{

    public static function hydrate(mixed $object, array $data, array $fields): void
    {
        foreach ($fields as $field) {
            $method = StringHelper::toCamel('set', $field);

            if (method_exists($object, $method)) {
                $object->$method($data[$field]);
            }
        }
    }
}

<?php

namespace App\Html;

use DateTimeInterface;
use App\Helpers\StringHelper;

class Form
{
    private mixed $data;

    private array $errors;

    public function __construct(mixed $data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label): string
    {
        $value = $this->getValue($key);
        $required = $this->getRequired($key);
        $type = $this->getType($key);

        return <<<HTML
            <div class="form-group mt-3">
                <label for="field$key" class="font-weight-bold">$label</label>
                <input type="$type" id="field{$key}" class="{$this->getInputClass($key)} " name="$key" value="$value" $required>
                {$this->getErrorFeedback($key)}
            </div>
        HTML;
    }

    public function textarea(string $key, string $label): string
    {
        $value = $this->getValue($key);

        return <<<HTML
            <div class="form-group">
                <label for="field$key" class="font-weight-bold">$label</label>
                <textarea type="text" id="field{$key}" class="{$this->getInputClass($key)}" name="$key" rows="10" cols="40" required>$value</textarea>
                {$this->getErrorFeedback($key)}
            </div>
        HTML;
    }

    private function getRequired(string $key): ?string
    {
        if ($key === 'link' || $key === 'details' || $key === 'categoryId') {
            return '';
        }
        return 'required';
    }

    private function getType(string $key): ?string
    {
        if ($key === 'password' || $key === 'confirm') {
            return 'password';
        } else if ($key === 'quantity') {
            return 'number';
        }
        return 'text';
    }

    private function getValue(string $key): ?string
    {
        if (is_array($this->data)) {
            return $this->data[$key] ?? null;
        }
        $method = StringHelper::toCamel('get', $key);
        $value = $this->data->$method();

        if ($value instanceof DateTimeInterface) {
            return $value->format('Y-m-d');
        }
        return $value;
    }

    private function getInputClass(string $key): string
    {
        $class = 'form-control';

        if (isset($this->errors[$key])) {
            $class .= ' is-invalid';
        }
        return $class;
    }

    private function getErrorFeedback(string $key): string
    {
        if (isset($this->errors[$key])) {
            if (is_array($this->errors[$key])) {
                $error = implode('<br/>', $this->errors[$key]);
            } else {
                $error = $this->errors[$key];
            }
            return '<div class="invalid-feedback">' . $error . '</div>';
        }
        return '';
    }
}

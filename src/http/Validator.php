<?php

class Validator
{
    private array $errors = [];

    public function required(array $data, string $field): void
    {
        if (!isset($data[$field]) || trim($data[$field]) === '') {
            $this->errors[$field][] = "Field '$field' is required";
        }
    }

    public function string(array $data, string $field): void
    {
        if (isset($data[$field]) && !is_string($data[$field])) {
            $this->errors[$field][] = "Field '$field' must be a string";
        }
    }

    public function numeric(array $data, string $field): void
    {
        if (isset($data[$field]) && !is_numeric($data[$field])) {
            $this->errors[$field][] = "Field '$field' must be numeric";
        }
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
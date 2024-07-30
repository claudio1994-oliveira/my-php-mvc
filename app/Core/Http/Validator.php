<?php

namespace App\Core\Http;

use InvalidArgumentException;

class Validator
{
    private array $errors = [];

    public function required($field, $value, $message = "This field is required."): void
    {
        if (empty($value)) {
            $this->addError($field, $message);
        }
    }

    public function email($field, $value, $message = "Invalid email address."): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $message);
        }
    }

    public function num($field, $value, $message = "This field must be a number."): void
    {
        if (!is_numeric($value)) {
            $this->addError($field, $message);
        }
    }

    public function min($field, $value, $min, $message = "This field is too short."): void
    {
        if (strlen($value) < $min) {
            $this->addError($field, $message);
        }
    }

    public function max($field, $value, $max, $message = "This field is too long."): void
    {

        if (strlen($value) > $max) {
            $this->addError($field, $message);
        }
    }

    private function addError($field, $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function validate($data, $rules, $messages = []): void
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule => $ruleValue) {
                $method = is_array($ruleValue) ? $rule : $ruleValue;
                $params = is_array($ruleValue) ? $ruleValue : [];

                if (!method_exists($this, $method)) {

                    throw new InvalidArgumentException('Method ' . $method . ' does not exist.');
                }


                if ($message = $this->parseMessages($messages, $field, $method)) {

                    $this->$method($field, $data[$field] ?? null, ...$params, message: $message);
                    continue;
                }

                $this->$method($field, $data[$field] ?? null, ...$params);
            }
        }
        
    }

    private function parseMessages(array $messages, string $field, string $rule)
    {
        foreach ($messages as $type => $message) {
            $dataRule = explode('.', $type);
            if (count($dataRule) > 1) {
                if ($dataRule[0] === $field && $dataRule[1] === $rule) {

                    return $message;
                }
            }
        }
    }

}
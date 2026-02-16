<?php

namespace App\Core;

class Validator
{
    private array $data;
    private array $rules;
    private array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;

        $this->validate();
    }

    public function fails(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }

    private function validate(): void
    {
        foreach ($this->rules as $field => $fieldRules) {
            // Haal de waarde op, of lege string als het veld niet bestaat
            $value = $this->data[$field] ?? '';

            foreach ($fieldRules as $rule) {
                $this->applyRule($field, $value, $rule);
            }
        }
    }

    private function applyRule(string $field, string $value, string $rule): void
    {
        $parts = explode(':', $rule, 2);
        $ruleName = $parts[0];
        $parameter = $parts[1] ?? null;

        $label = ucfirst(str_replace('_', ' ', $field));

        match ($ruleName) {
            'required' => $this->validateRequired($field, $value, $label),
            'min'      => $this->validateMin($field, $value, $label, (int) $parameter),
            'max'      => $this->validateMax($field, $value, $label, (int) $parameter),
            'email'    => $this->validateEmail($field, $value, $label),
            'numeric'  => $this->validateNumeric($field, $value, $label),
            'in'       => $this->validateIn($field, $value, $label, $parameter),
            default    => throw new \InvalidArgumentException("Onbekende validatie regel: {$ruleName}")
        };
    }

    private function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    private function validateRequired(string $field, string $value, string $label): void
    {
        if (trim($value) === '') {
            $this->addError($field, "{$label} is verplicht.");
        }
    }

    private function validateMin(string $field, string $value, string $label, int $min): void
    {
        if (trim($value) !== '' && mb_strlen($value) < $min) {
            $this->addError($field, "{$label} moet minimaal {$min} karakters zijn.");
        }
    }

    private function validateMax(string $field, string $value, string $label, int $max): void
    {
        if (mb_strlen($value) > $max) {
            $this->addError($field, "{$label} mag maximaal {$max} karakters zijn.");
        }
    }

    private function validateEmail(string $field, string $value, string $label): void
    {
        if (trim($value) !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "{$label} is geen geldig e-mailadres.");
        }
    }

    private function validateNumeric(string $field, string $value, string $label): void
    {
        if (trim($value) !== '' && !is_numeric($value)) {
            $this->addError($field, "{$label} moet een nummer zijn.");
        }
    }

    private function validateIn(string $field, string $value, string $label, string $options): void
    {
        $allowed = explode(',', $options);

        if (trim($value) !== '' && !in_array($value, $allowed, true)) {
            $allowedList = implode(', ', $allowed);
            $this->addError($field, "{$label} moet één van de volgende zijn: {$allowedList}.");
        }
    }
}
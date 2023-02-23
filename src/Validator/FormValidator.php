<?php

/**
 * FormValidator Class
 *
 * @package    TimeAgo
 * @category   Security
 * @author     Ramazan Çetinkaya
 * @license    MIT License
 * @version    1.0
 * @link       https://github.com/ramazancetinkaya/Form-Validator
 */
class FormValidator
{
    /**
     * @var array $rules The validation rules for each field in the form.
     */
    private array $rules = [];

    /**
     * @var array $errors The errors for each field in the form.
     */
    private array $errors = [];

    /**
     * @var bool $isValid Indicates if the form data is valid or not.
     */
    private bool $isValid = true;

    /**
     * Add a validation rule for a field in the form.
     *
     * @param string $field The name of the field to validate.
     * @param string $label The human-readable label for the field.
     * @param string $rule  The validation rule to apply (as a Regex pattern).
     * @param string $error The error message to display if the rule fails.
     */
    public function addRule(string $field, string $label, string $rule, string $error): void
    {
        $this->rules[$field][] = [
            'label' => $label,
            'rule' => $rule,
            'error' => $error,
        ];
    }

    /**
     * Validate the form data against the registered rules.
     *
     * @param array $data The form data to validate.
     * @return bool Returns true if the form data is valid, false otherwise.
     */
    public function validate(array $data): bool
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                $value = $data[$field] ?? '';
                $isValid = preg_match("/{$rule['rule']}/", $value);
                if (!$isValid) {
                    $this->errors[$field][] = str_replace(':field', $rule['label'], $rule['error']);
                    $this->isValid = false;
                }
            }
        }

        return $this->isValid;
    }

    /**
     * Get the error messages for a field in the form.
     *
     * @param string $field The name of the field to get the errors for.
     * @return array Returns an array of error messages for the field.
     */
    public function getErrors(string $field): array
    {
        return $this->errors[$field] ?? [];
    }
}

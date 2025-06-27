<?php

namespace App\Exception;

class PropertiesValidationErrorsException extends \Exception
{
    private array $errors;

    public function __construct(
        array $errors,
        int   $code = 400
    )
    {
        $this->errors = $errors;
        parent::__construct(
            'Properties validation failed',
            $code
        );
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}

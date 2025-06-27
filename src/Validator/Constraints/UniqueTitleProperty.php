<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueTitleProperty extends Constraint
{
    public string $message = 'Property title must be unique.';
    public string $mode    = 'strict';

    public function __construct(
        ?string $mode = null,
        ?string $message = null,
        ?array  $groups = null,
                $payload = null
    )
    {
        parent::__construct(
            [],
            $groups,
            $payload
        );

        $this->mode = $mode ?? $this->mode;
        $this->message = $message ?? $this->message;
    }
}

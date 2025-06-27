<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class UniqueSlugProperty extends Constraint
{
    public string $message = 'Property slug must be unique.';
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

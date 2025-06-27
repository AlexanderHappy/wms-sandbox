<?php

namespace App\Validator\Constraints;

use App\Entity\Properties;
use App\Entity\PropertyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class PropertyTypeExistsValidator extends ConstraintValidator
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function validate(
        mixed      $value,
        Constraint $constraint
    ): void
    {
        if (!$constraint instanceof PropertyTypeExists) {
            throw new UnexpectedTypeException(
                $constraint,
                PropertyTypeExists::class
            );
        }

        $existingProperty = $this->entityManager
            ->getRepository(PropertyType::class)
            ->find($value);

        // If type do not exist in property_type add violation.
        if (is_null($existingProperty)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}

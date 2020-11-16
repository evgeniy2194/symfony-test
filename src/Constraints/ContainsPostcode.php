<?php


namespace App\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class ContainsPostcode
 * @package App\Constraints
 * @Annotation
 */
class ContainsPostcode extends Constraint
{
    public function validatedBy()
    {
        return PostcodeValidator::class;
    }
}

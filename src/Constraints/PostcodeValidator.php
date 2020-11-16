<?php


namespace App\Constraints;


use App\Service\PostcodeService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PostcodeValidator extends ConstraintValidator
{
    /**
     * @var PostcodeService $postcodeService
     */
    protected $postcodeService;

    public function __construct(PostcodeService $postcodeService)
    {
        $this->postcodeService = $postcodeService;
    }

    /**
     * @param string $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$this->postcodeService->isPostcodeValid($value)) {
            $this->context->buildViolation("ERROR - {$value} is invalid")
                ->atPath('postcode')
                ->addViolation();
        } else if (!$this->postcodeService->isPostcodeM25($value)) {
            $this->context->buildViolation("ERROR - {$value} Outside M25")
                ->atPath('postcode')
                ->addViolation();
        }
    }
}

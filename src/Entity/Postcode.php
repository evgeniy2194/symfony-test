<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Constraints as Constraints;

class Postcode
{
    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Constraints\ContainsPostcode
     */
    protected $postcode = "";

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode): void
    {
        $this->postcode = $postcode;
    }
}

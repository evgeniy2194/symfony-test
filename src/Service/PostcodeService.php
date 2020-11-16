<?php


namespace App\Service;


use Symfony\Component\HttpKernel\KernelInterface;

class PostcodeService
{
    /**
     * @var array
     */
    protected $codes = [];

    /**
     * @var string
     */
    protected $projectDir;

    /**
     * PostcodeService constructor.
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
        $this->loadPostcodes();
    }

    /**
     * @param string $postcode
     * @return bool
     */
    public function isPostcodeValid(string $postcode): bool
    {
        $code = $this->trimPostcode($postcode);

        return preg_match("/^[A-Z]{1,2}\d[A-Z\d]?\d[A-Z]{2}$/", $code);
    }

    /**
     * @param string $postcode
     * @return bool
     */
    public function isPostcodeM25(string $postcode): bool
    {
        $code = $this->trimPostcode($postcode);

        return !empty(array_intersect([
            substr($code, 0, 4),
            substr($code, 0, 3),
            substr($code, 0, 2)
        ], $this->codes));
    }

    /**
     * Remove spaces from code
     *
     * @param string $postcode
     * @return string|string[]
     */
    private function trimPostcode(string $postcode)
    {
        return strtoupper(str_replace(' ', '', $postcode));
    }

    /**
     * Read postcodes from file
     */
    private function loadPostcodes()
    {
        $content = file_get_contents($this->projectDir . '/data/m25Postcodes.md');
        $codes = json_decode($content);

        $this->codes = $codes;
    }
}

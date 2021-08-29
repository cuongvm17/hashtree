<?php
declare(strict_types=1);

namespace HashTree\Traits;

/**
 * Trait HashingTrait
 * @package HashTree\Traits
 */
trait HashingTrait
{
    /**
     * @param $data
     * @return string
     */
    public function hexitHash($data)
    {
        return hash('sha256', $data, false);
    }

    /**
     * @param $data
     * @return string
     */
    public function binaryHash($data)
    {
        return hash('sha256', $data, true);
    }
}
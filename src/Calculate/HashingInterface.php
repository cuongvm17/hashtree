<?php
declare(strict_types=1);

namespace HashTree\Calculate;

/**
 * Interface HashingInterface
 * @package HashTree\Calculate
 */
interface HashingInterface
{
    /**
     * @param array $data
     * @param int $size
     * @return string
     */
    public function calculate(array $data, int $size): string;
}
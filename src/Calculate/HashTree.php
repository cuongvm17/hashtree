<?php
declare(strict_types=1);

namespace HashTree\Calculate;

use HashTree\Traits\HashingTrait;

/**
 * Class HashTree
 * @package HashTree\Calculate
 */
class HashTree implements HashingInterface
{
    use HashingTrait;

    /**
     * @param array $data
     * @param int $size
     * @return string
     */
    public function calculate(
        array $data,
        int $size
    ): string
    {
        $len = count($data);

        if ($len === 1) {
            return $this->hexitHash($data[0]);
        }

        if ($len <= $size) {
            return $this->getHashOfArray($data, false);
        }

        $nextLevel = [];

        for ($i = 0; $i < $len; $i += $size)
        {
            $nextLevel[] = $this->getHashOfArray(array_slice($data, $i, $size));
        }

        return $this->calculate($nextLevel, $size);
    }

    /**
     * @param array $data
     * @param bool $isBinary
     * @return string
     */
    private function getHashOfArray(
        array $data,
        bool $isBinary = true
    )
    {
        $buffer = [];

        foreach ($data as $value)
        {
            $buffer[] = $this->binaryHash($value);
        }

        $hashKey = join("", $buffer);

        if ($isBinary) {
            $hash = $this->binaryHash($hashKey);
        } else {
            $hash = $this->hexitHash($hashKey);
        }

        return $hash;
    }
}
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
        $buffer = $this->convertArrayToBuffer($data);

        return $this->exec($buffer, $size);
    }

    /**
     * @param array $buffer
     * @param int $size
     * @param bool $flag
     * @return string
     */
    private function exec(array $buffer, int $size, bool $flag = false): string
    {
        $len = count($buffer);

        if ($len === 1 && !$flag) {
            return $this->hexitHash($buffer[0]);
        }

        if ($len <= $size) {
            return $this->getHashOfArray($buffer, true);
        }

        $nextLevel = [];

        for ($i = 0; $i < $len; $i += $size)
        {
            $nextLevel[] = $this->getHashOfArray(array_slice($buffer, $i, $size));
        }

        return $this->exec($nextLevel, $size, true);
    }

    /**
     * @param array $buffer
     * @param bool $isDone
     * @return string
     */
    private function getHashOfArray(
        array $buffer,
        bool $isDone = false
    )
    {
        $hashKey = join("", $buffer);

        if ($isDone) {
            $hash = $this->hexitHash($hashKey);
        } else {
            $hash = $this->binaryHash($hashKey);
        }

        return $hash;
    }

    /**
     * @param array $data
     * @return array
     */
    private function convertArrayToBuffer(array $data): array
    {
        $len = count($data);

        for ($i = 0; $i < $len; $i++)
        {
            $data[$i] = $this->binaryHash($data[$i]);
        }

        return $data;
    }
}
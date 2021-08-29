<?php

declare(strict_types=1);

namespace HashTree\Traits;

use HashTree\Exceptions\InvalidDataException;
use HashTree\Exceptions\InvalidSizeException;

/**
 * Trait ValidatorDataTrait
 * @package HashTree\Traits
 */
trait ValidatorDataTrait
{
    /**
     * @param array $data
     * @param int $size
     * @throws InvalidDataException
     * @throws InvalidSizeException
     */
    public function validate(
        array $data,
        int $size
    )
    {
        if (count($data) === 0) {
            throw new InvalidDataException('Invalid input data!');
        }

        if ($size < 1) {
            throw new InvalidSizeException('Invalid size!');
        }
    }
}
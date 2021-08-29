<?php

declare(strict_types=1);

namespace HashTree\Services;

use HashTree\Calculate\HashingInterface;
use HashTree\Traits\Base64UrlTrait;
use HashTree\Traits\ValidatorDataTrait;

/**
 * Class GetBase64HashTreeService
 * @package HashTree\Services
 */
class GetBase64HashTreeService
{
    use ValidatorDataTrait, Base64UrlTrait;

    /**
     * @var HashingInterface
     */
    private $hashingAlgorithm;

    /**
     * GrowableTree constructor.
     * @param HashingInterface $hashingAlgorithm
     */
    public function __construct(HashingInterface $hashingAlgorithm)
    {
        $this->hashingAlgorithm = $hashingAlgorithm;
    }

    /**
     * @param array $data
     * @param int $leafSize
     * @return string
     * @throws \HashTree\Exceptions\InvalidDataException
     * @throws \HashTree\Exceptions\InvalidSizeException
     */
    public function __invoke(
        array $data,
        int $leafSize
    ): string
    {
        $this->validate($data, $leafSize);
        $hashValue = $this->hashingAlgorithm->calculate($data, $leafSize);

        return $this->hexToBase64Url($hashValue);
    }
}
<?php
declare(strict_types=1);

namespace HashTree\Traits;

/**
 * Trait Base64UrlTrait
 * @package HashTree\Traits
 */
trait Base64UrlTrait
{
    /**
     * @param $hexadecimalString
     * @return string
     */
    public function hexToBase64($hexadecimalString)
    {
        return base64_encode(pack('H*', $hexadecimalString));
    }

    /**
     * @param $hexadecimalString
     * @return string
     */
    public function hexToBase64Url($hexadecimalString)
    {
        return $this->base64urlEncode(pack('H*', $hexadecimalString));
    }

    /**
     * @param $data
     * @return string
     */
    function base64urlEncode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * @param $data
     * @return bool|string
     */
    function base64urlDecode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}
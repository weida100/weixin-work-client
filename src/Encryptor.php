<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/23 22:20
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient;

use Weida\WeixinWorkClient\Contract\EncryptorInterface;

class Encryptor implements EncryptorInterface
{
    /**
     * @param string $msgData
     * @return array|null
     * @author Weida
     */
    public function decrypt(string $msgData): ?array
    {
        return (array)json_decode($msgData);
    }

    /**
     * @param array|string $msgData
     * @return string
     * @author Weida
     */
    public function encrypt(array|string $msgData): string
    {
        if(is_string($msgData)) return $msgData;
        return json_encode($msgData,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
    }
}

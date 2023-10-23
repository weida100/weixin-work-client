<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/23 22:16
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Contract;

interface EncryptorInterface
{
    public function decrypt(string $msgData ): ?array;
    public function encrypt(string|array $msgData):string;
}

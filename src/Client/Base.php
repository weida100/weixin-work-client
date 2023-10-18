<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/18 23:01
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Client;

use Weida\WeixinWorkClient\Contact\HttpClientInterface;

abstract class Base
{
    protected HttpClientInterface $httpClient;
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

}

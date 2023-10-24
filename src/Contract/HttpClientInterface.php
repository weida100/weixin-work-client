<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/15 09:30
 * Email: Sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Contract;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function request(string $method, $uri, array $options = []): ResponseInterface;
    public function requestAsync(string $method, $uri, array $options = []): PromiseInterface;
    public function sendBody(array $data,$uri=''):ResponseInterface;

}

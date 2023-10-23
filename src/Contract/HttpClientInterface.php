<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/15 09:30
 * Email: Sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Contact;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface extends ClientInterface
{
    public function postJson($uri,array $data):ResponseInterface;

}

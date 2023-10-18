<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/18 23:00
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Client;

use Psr\Http\Message\ResponseInterface;

class Login extends Base
{
    /**
     * @return ResponseInterface
     * @author Weida
     */
    public function getCodeQr():ResponseInterface{
        $params=[
            'type'=>1000
        ];
       return $this->httpClient->postJson('',$params);
    }

    /**
     * @return ResponseInterface
     * @author Weida
     */
    public function closeClient():ResponseInterface{
        $params=[
            'type'=>2
        ];
        return $this->httpClient->postJson('',$params);
    }

}

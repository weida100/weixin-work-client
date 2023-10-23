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
     * 验证登录请求
     * @param string $code
     * @param string $qrcodeKey
     * @return ResponseInterface
     * @author Weida
     *
     */
    public function verifyCode(string $code,string $qrcodeKey):ResponseInterface {
        $params=[
            'type'=>1000,
            'data'=>[
                'login_verify_code'=>$code,
                'login_qrcode_key'=>$qrcodeKey,
                'request_key'=>''
            ]
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

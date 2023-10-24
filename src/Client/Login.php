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
        return $this->httpClient->sendBody($params);
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
        return $this->httpClient->sendBody($params);
    }

    /**
     * @return ResponseInterface
     * @author Weida
     */
    public function closeClient():ResponseInterface
    {
        $params = [
            'type' => 2
        ];
        return $this->httpClient->sendBody($params);
    }
    /**
     * 接口准备完毕通知
     * {"data":{"process_id":61760},"error":0,"type":10000}
     */
    const winSuccessCode=1000;

    /**
     * 登录成功通知
     * 企微账号首次登录可能只返回了一个user_id，此时可通过2601命令获取详细信息
     * {"data":{"acctid":"yh","avator_url":"http://wework.qpic.cn/bizmail/RYUT9ia06KVp63dFTsTr5IqrMxGuR8KuoWd9lFz9l1WYDiaKSE22j15Q/0",
     * "corp_full_name":"Alt","corp_id":"562952205422622","corp_short_name":"Alt","email":"","job":"",
     * :"15971376167","name":"eWg=","real_name":"5p2o5Lqo","sex":1,"user_id":"1688851271444534"},
     * "error":0,"type":11001}
     */
    const loginSuccessCode=11001;

    /**
     * 登出通知
     * quit_reason 原因
     * {"type":11002,"error":0,"data":{"user_id":"1688xxxxxxx01","quit_reason":10}}
     */
    const logoutCode=11002;

    /**
     * 扫码通知
     *{"data":{"avator_url":"https://wework.qpic.cn/wwhead/duc2TvpEgSQl4wxMPWAVtibdf7ibKulHfMpTrZgchm4h00YKwpP24BaNzIbrsdmJEkW3EFBnKJiccs/0",
     * "corp_id":1970325954977992,"corp_logo":"https://p.qlogo.cn/bizmail/6MOIfPFPMqMuIS3mibsRCu2I9RS5J6kLicicj8t0icxHBD1QVdosb4bmBA/0",
     * "nickname":"QZA==","user_id":1688856240301763,"login_qrcode_key":"2135A882EF203F3B4D423FFC833064B1","login_status":10},
     * "error":0,"type":11100}
     */
    const scanQrCode=11100;

    /**
     * 发送验证码后返回结果
     *{"data":{"request_key":"123"},"error":0,"type":11005}
     */
    const verifyCodeResult=11005;


}

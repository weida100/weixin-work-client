<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/15 09:37
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Client;

use Psr\Http\Message\ResponseInterface;

class Group extends Base
{
    /**
     * 获取群聊列表
     *     获取群聊时会分段返回群聊列表，一次最多返回512个群；
    current_index: 当前已返回的群聊的总数目；
    total_count: 群聊的总数目；
    room_ext_type: =0是内部群；=1或者=2是外部群
    room_is_collect: 是否已将该群保存到了通讯录
     *
     * {"data":{"current_index":14,"room_list":[{"is_manager":1,"room_chat_id":"R:10696053273019504",
     * "room_create_time":"1627783223","room_ext_type":1,"room_is_collect":0,"room_name":"11",
     * "room_owner_id":"1688851271444534"}],"total_count":14},"error":0,"type":12502}

     * 此接口获取的是本地缓存的群列表，如果查询到的群列表不全，此时可通过2600命令网络获取群列表
     * @return ResponseInterface
     * @author Weida
     */
    public function getList():ResponseInterface {
        $params=[
            'type'=>2502
        ];
        return $this->httpClient->postJson('',$params);
    }


}

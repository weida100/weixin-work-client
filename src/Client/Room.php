<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/24 23:10
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Client;

use Psr\Http\Message\ResponseInterface;

class Room extends Base
{
    /**
     * @return ResponseInterface
     * @author Weida
     */
    public function getList():ResponseInterface {
        $params=[
            'type'=>2502
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * @param string $ghRoomId
     * @return ResponseInterface
     * @author Weida
     */
    public function getUserList(string $ghRoomId):ResponseInterface{
        $params=[
            'type'=>2503,
            'data'=>[
                'room_chat_id'=>str_starts_with($ghRoomId,'R:')?$ghRoomId:'R:'.$ghRoomId
            ]
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取群聊列表 结果
     * 获取群聊时会分段返回群聊列表，一次最多返回512个群；
    current_index: 当前已返回的群聊的总数目；
    total_count: 群聊的总数目；
    room_ext_type: =0是内部群；=1或者=2是外部群
    room_is_collect: 是否已将该群保存到了通讯录

    此接口获取的是本地缓存的群列表，如果查询到的群列表不全，此时可通过2600命令网络获取群列表
     * {"data":{"current_index":14,"room_list":[{"is_manager":0,"room_chat_id":"R:10696051769040594",
     * "room_create_time":"1637924001","room_ext_type":2,"room_is_collect":1,"room_name":"","room_owner_id":"1688850839952225"}],
     * "total_count":14},"error":0,"type":12502}
     */
    const listCode=12502;

    /**
     * 获取群成员列表
     *
     *  room_announcement: 群公告
    room_createtime: 群创建时间
    room_ext_type：群类型 =0是内部群，其他则是外部群
    room_flag: 是否已开启 群聊邀请确认
    room_is_forbid_change_name: 是否已开启 禁止改群名
     *
     * {"data":{"member_list":[{"acctid":"altai","avator_url":"http://wework.qpic.cn/bizqrMxGuR8KuoWd9lFz9l1WYDiaKSE22j15Q/0",
     * "corp_id":"1970329934","email":"","inviter_id":"168885170","inviter_name":"AA","inviter_nickname":"*A",
     * "is_admin":0,"job":"","join_time":"16326282","mobile":"","name":"杨","nickname":"","real_name":"AA","sex":1,
     * "user_id":"168881769920"}],"room_announcement":"","room_chat_id":"R:1069601038843","room_createtime":1639559412,
     * "room_ext_type":2,"room_name":"R:106968843","room_owner":0,"room_flag":1,"room_is_forbid_change_name":1},"error":0,"type":12503}
     */
    const userListCode=12503;
}

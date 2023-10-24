<?php
declare(strict_types=1);
/**
 * Author: Weida
 * Date: 2023/10/15 09:36
 * Email: sgenmi@gmail.com
 */

namespace Weida\WeixinWorkClient\Client;

use Psr\Http\Message\ResponseInterface;

class User extends Base
{
    /**
     * 获取当前登录账户的个人信息
     *
     * @return ResponseInterface
     * @author Weida
     */
    public function getOwnInfo():ResponseInterface{
        $params=[
            'type'=>2000
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取联系人信息
     * @param string $ghUserId
     * @return ResponseInterface
     * @author Weida
     */
    public function getContactInfo(string $ghUserId):ResponseInterface{
        $params=[
            'type'=>2001,
            'data'=>[
                'user_id'=>$ghUserId
            ]
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取联系人信息【通过name查询】
     * @param string $name
     * @return ResponseInterface
     * @author Weida
     */
    public function getContactByName(string $name):ResponseInterface{
        $params=[
            'type'=>2002,
            'data'=>[
                'query_name'=>$name
            ]
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取内部联系人列表, status: 1正常， 3表示未加入
     * 数据会分段返回，每次最多返回512个内部联系人的信息，通过比较【total_count】和【current_index】字段的值可以判断是否已经全部返回，相等则已全部返回完毕。
     * @return ResponseInterface
     * @author Weida
     */
    public function getInternalContactList():ResponseInterface{
        $params=[
            'type'=>2500
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取外部联系人列表, source_info: 参照2001
     * 如果外部联系人比较多，可能返回多条12501的消息。每次最多返回512个外部联系人的信息，直到全部返回完毕。
     * @return ResponseInterface
     * @author Weida
     */
    public function getExternalContactList():ResponseInterface {
        $params=[
            'type'=>2501
        ];
        return $this->httpClient->sendBody($params);
    }



    /**
     * @return ResponseInterface
     * @author Sgenmi
     */
    public function getTagList():ResponseInterface{
        $params=[
            'type'=>2504
        ];
        return $this->httpClient->sendBody($params);
    }

    /**
     * 获取当前登录账户的个人信息 返回结果
     * {
     * "data":{"acctid":"yh","avator_url":"http://wework.qpic.cn/bizmail/RYUT9ia06KVp63dFTsTr5IqrMxGuR8KuoWd9lFz9l1WYDiaKSE22j15Q/0",
     * "corp_full_name":"Alt","corp_id":"562952205422622","corp_short_name":"Alt","email":"","internation_code":"86",
     * "job":"","mobile":"15971376167","name":"yh","real_name":"AAAA","sex":1,"union_id":"ozynqsp2GIiSYZa0-HQHKFrsZaRc",
     * "user_id":"1688851271444534"},"error":0,"type":12000
     * }
     */
    const ownInfoResultCode=12000;

    /**
     * 获取联系人信息 结果
     * status: 该参数&0x1=1,则表示是好友关系 source_info: 只有外部联系人才有此字段，表示外部联系人的来源
     * add_source: =1通过扫一扫添加  =2通过搜索手机号添加 =4通过群聊添加
     *
     * {"data":{"acctid":"","add_time":0,"alias":"",
     * "avator_url":"http://wx.qlogo.cn/mmhead/Q3auHg24ps5YmSX740MADvZdoOzfZVNlFDqWEedm37ahQ/0",
     * "corp_full_name":"微信联系人","corp_id":"1970322xx6788","corp_short_name":"微信","desc":"","email":"",
     * "internation_code":"","job":"","mobile":"","name":"AAAAA","real_name":"","remark":"Al2i","sex":1,"status":9,
     * "union_id":"ozynqsp2G2Za0-HQHKFrsZaRc","user_id":"7882xxx4946238","source_info":{"add_source":4,"op_user_id":0,
     * "source_room_id":1069605131122281}},"error":0,"type":12001}
     */
    const contactInfoCode=12001;

    /**
     * 获取联系人信息【通过name查询】 结果
     *
     * {"data":{"query_name":"hl","user_list":[{"acctid":"","add_time":1654658871,"alias":"",
     * "avator_url":"http://wx.qlogo.cn/mmhead/PiajxSqBR3ZfbQD1jtbvyzkcyFkiavWxO4w/0","corp_full_name":"微信",
     * "corp_id":"1970325326788","corp_short_name":"微信","desc":"3wsjRs0","email":"","internation_code":"","job":"",
     * "label_list":null,"mobile":"","mobile_list":["000003980"],"name":"hl","real_name":"","remark":"","sex":1,
     * "source_info":{"add_source":4,"op_user_id":0,"source_room_id":1078832972},"status":2057,
     * "union_id":"ozynqsni3zV83sYox6A","user_id":"788133123976"}]},"error":0,"type":12002}
     *
     */
    const contactSearchNameCode=12002;

    /**
     * 获取内部联系人列表 结果
     * status: 1正常， 3表示未加入
     * {"data":{"contact_list":[{"account":"yh",
     * "avatar":"http://wework.qpic.cn/bizmail/RYUT9ia06KVp63dFTsTr5IqrMxGuR8KuoWd9lFz9l1WYDiaKSE22j15Q/0",
     * "email":"","job":"","mobile":"15971376167","name":"yh","realname":"","remark":"","sex":1,
     * "user_id":"1688851271444534","status":1}],"current_index":1,"total_count":1},"error":0,"type":12500}
     */
    const internalContactListCode=12500;

    /**
     * 获取外部联系人列表 结果
     * source_info: 参照2001
     * {"data":{"contact_list":[{"account":"","add_time":0,
     * "avatar":"http://wx.qlogo.cn/mmhead/Q3auHgzwzMx0MADvZdoOzfZVNlFDqWEedm37ahQ/0","corp_id":"19703x788",
     * "corp_name":"微信联系人","corp_short_name":"微信","desc":"","email":"","job":"","mobile":"",
     * "mobile_list":null,"name":"Axi","nickname":"Alxi","realname":"","remark":"Axi","sex":1,"status":9,
     * "user_id":"7881xx946238","source_info":{"add_source":4,"op_user_id":0,"source_room_id":10690000122281}}],
     * "current_index":1,"total_count":1},"error":0,"type":12501}
     */
    const externalContactListCode=12501;



    /**
     * 获取标签列表 结果
     * label_id ：标签ID
    super_id：上级标签，=0表示没有上级标签
    name：标签名
    level：标签等级，=1的可能存在上级标签
    type：标签类型，=1表示企业管理员创建的标签, =2表示系统默认标签
     * {"data":[{"create_time":1612167236,"label_id":"14073749729629572","level":1,"name":"666",
     * "super_id":"14073751376603171","type":2}],"error":0,"type":12504}
     */
    const tagListCode=12504;



}

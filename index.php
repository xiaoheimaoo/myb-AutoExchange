<?php
function main_handler($event, $context) {
    //商品id（原石*60的商品，目前仅支持原神分类下的虚拟商品。）
    $GLOBALS['goods_id'] = "2021102012224";
    //游戏内的uid
    $GLOBALS['uid'] = "";
    //米游社cookie
    $GLOBALS['cookie'] = "";
	/* 仅需改动上面的配置即可，下面的为兑换逻辑 */
    $GLOBALS['device_id'] = uuid();
    $raw = sendpost();
    $data = json_decode($raw, true);
    $time = time();
    while($data['message'] != "OK"){
        $raw = sendpost();
        $data = json_decode($raw, true);
        if(time()-$time > 60){
        break;
        }
    }
    $result = "米游社原石兑换结果：".$data['message'];
    $rep = array(
        "isBase64Encoded" => false,
        "statusCode"=> 200,
        "headers"=> array(
            "Content-Type"=>"text/html;charset=utf-8"
            ),
        "body"=> $result,
        );
    return $rep;
}
function sendpost()
{
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => "Host: api-takumi.mihoyo.com\r\n" .
                "x-rpc-device_model: iPhone13,1\r\n" .
                "Accept: application/json, text/plain, */*\r\n" .
                "x-rpc-device_id: ".$GLOBALS['device_id']."\r\n" .
                "x-rpc-client_type: 1\r\n" .
                "x-rpc-channel: appstore\r\n" .
                "Accept-Language: zh-cn\r\n" .
                "Accept-Encoding: gzip, deflate, br\r\n" .
                "Content-Type: application/json;charset=utf-8\r\n" .
                "Origin: https://webstatic.mihoyo.com\r\n" .
                "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) miHoYoBBS/2.10.0\r\n" .
                "Referer: https://webstatic.mihoyo.com/app/community-shop/index.html?bbs_presentation_style=fullscreen\r\n" .
                "x-rpc-app_version: 2.10.0\r\n" .
                "x-rpc-device_name: iPhone\r\n" .
                "Cookie: ".$GLOBALS['cookie']."\r\n" .
                "x-rpc-sys_version: 14.6\r\n" .
                "\r\n",
            'content' => '{"app_id":1,"point_sn":"myb","goods_id":"'.$GLOBALS['goods_id'].'","exchange_num":1,"uid":"'.$GLOBALS['uid'].'","region":"cn_gf01","game_biz":"hk4e_cn"}',
            'timeout' => 60
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents("https://api-takumi.mihoyo.com/mall/v1/web/goods/exchange", false, $context);
    return $result;
}
function uuid()
{
    $chars = strtoupper(md5(uniqid(mt_rand(), true)));
    $uuid = substr($chars, 0, 8) . '-'
        . substr($chars, 8, 4) . '-'
        . substr($chars, 12, 4) . '-'
        . substr($chars, 16, 4) . '-'
        . substr($chars, 20, 12);
    return $uuid;
}
?>

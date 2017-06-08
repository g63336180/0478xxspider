<?php

ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';

$group_id_list = array(
    '155485152' => '水源聊房',
    '484482528' => '老司机带带我',
    '728151117' => '小道消息',
    '288815881' => 'NUKE的情报圈',
    '1111424852' => '旁友圈',
    '1112485412' => '跨境电商凯文',
    '1141114252' => '税在身边蔡和',
    '1185888122' => '运营狗工作日记',
    '1824528822' => '生财有术',
    '2481541281' => '互联网运营那些事',
    '4251218448' => '外贸资源圈',
    '5581582454' => '计算广告',
    '5418888224' => '中澳商机',
    '5444255414' => '何涛的写作工坊',
    '5811115514' => '左叔密圈',
    '5825425284' => '问天观测-大杂烩',
    '8212858222' => 'SVI-分享价值信息',
    '8412581252' => 'L先生的智识沙龙',
    '8414185182' => '休克文案✘小黑屋',
    '8424258282' => 'Caoz的小密圈',
    '8458218812' => '尹姐的广告DMP',
    '158282282122' => '创业者群',
    '158214458212' => '创业法律顾问',
    '158214445852' => '律界新人成长记',
    '158214185182' => '水库90买房',
    '281542518581' => '通货朋仗',
    '281518512851' => '分独投资精英',
    '281544588241' => '北京大土豆房产投资群',
    '281542212511' => '水库',
    '281512252421' => '托尼富圈子',
    '481422851828' => '耳鼻喉科张医生的咨询',
    '481422885148' => '老化看房',
    '881515285142' => '股市学习进阶',
    '881544525242' => '涨停最强王者',
    '881544822882' => '爱踩盘',
    '8188412842' => '互联网赚钱之道',
    '158285114242' => '小怪兽SEO',
    '4222422848' => '创业直播间',
    '511244584' => 'WLJ的创业笔记',
    '481884185118' => '专注互联网灰产',
    '2155144551' => '屠龙会', //1001
    '5812455514' => 'Google小密圈', //3000
    '4188885488' => '掌股', //2888
    '4188824418' => '体验思维', //456装
    '4185854118' => '职业打工者',//180
    '2188212821' => '扶墙老师和他的朋友',//168
    '158285425512' => '汽车零部件采购情报所',//
    '481844428228' => '电商创业投资圈',
    '518122425484' => '腾讯京东离职创业群',
    '281881184511' => 'Design Stuff',
    '481818445248' => '朱深投资圈',
    '158585224212' => '解惑英语语法',
    '281815442411' => '阿法布雷音基',
    '158514282142' => '阿朵从入门到精通',


    // '881884518482' => 'Tumblr社交圈',
    // '158552588882' => 'PUZZLES',
    // '158552551122' => '调教研发中心',
    // '4144114228' => 'SM',
    // '4188445288' => '娱乐圈',
);
//先获取cookies并保存
$shencaiyoushu_index_url = "https://wx.xiaomiquan.com/mweb/views/joingroup/join_group.html?group_id=1824528822";
$shencaiyoushu_limit_url = "https://wapi.xiaomiquan.com/v1.5/groups/1824528822/topics/limit";
requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36');

foreach ($group_id_list as $id_k => $id_v) {
    $shencaiyoushu_limit_url = "https://wapi.xiaomiquan.com/v1.5/groups/" . $id_k . "/topics/limit";
    // 发送抓取请求
    $html = requests::get($shencaiyoushu_limit_url);
    // var_dump($html);die();
    //数据存储
    save_db($html, $id_v);
}

/**
 * [save_ip description]
 * @param  [type] $result [description]
 * @return [type]         [description]
 */
function save_db($result, $group_name) {
    $table_topic_name = 'ask_xmq_topic';
    $table_comment_name = 'ask_xmq_comment';
    $table_user_name = 'ask_xmq_user';

    $result = json_decode($result, true);
    // print_r($result);die();
    if (empty($result) == true) {
        return false;
    }
    $i = 0;
    $insert_count = 0;
    $update_count = 0;
    if (isset($result['resp_data']['topics']) && empty($result['resp_data']['topics']) == false) {
        foreach ($result['resp_data']['topics'] as $rk => $rv) {
            $i++;
            //主题操作
            $check_result = db::get_one("select id from " . $table_topic_name . " where topic_id='" . $rv['topic_id'] . "'");

            if (empty($check_result) == false) {
                $update_count++;
                //db::update($table_topic_name, $rv, ["sourceIp='" . $rv['sourceIp'] . "'"]);
            } else {
                $insert_count++;
                $images_str = '';
                if (isset($rv['talk']['images']) == true) {
                    foreach ($rv['talk']['images'] as $tik => $tiv) {
                        $images_str .= $tiv['large']['url'] . ',';
                    }
                }
                rtrim($images_str, ',');
                if ($rv['type'] == 'q&a') {
                    $item_key = 'question';
                } else {
                    $item_key = 'talk';
                }
                $topic_info = [
                    'topic_id' => $rv['topic_id'],
                    'group_id' => $rv['group']['group_id'],
                    'type' => $rv['type'],
                    'owner' => $rv[$item_key]['owner']['user_id'],
                    'content' => $rv[$item_key]['text'],
                    'images' => $images_str,
                    'created_at' => time(),
                ];
                //用户入库
                if (isset($rv[$item_key]['owner']) == true) {
                    save_user($rv[$item_key]['owner']);
                }
                //主题入库
                db::insert($table_topic_name, $topic_info);
                // print_r($topic_info);die();
                if ($item_key == 'question') {
                    //回答当评论存储
                    $comment_info = array(
                        'comment_id' => time() . rand(1111,999),
                        'created_at' => time(),
                        'owner' => $rv['answer']['owner']['user_id'],
                        'content' => $rv['answer']['text'],
                        'topic_id' => $rv['topic_id'],
                    );
                    db::insert($table_comment_name, $topic_info);
                }
            }

            //评论操作
            if(isset($rv['show_comments']) == true) {
                foreach ($rv['show_comments'] as $ck => $cv) {
                    $check_result = db::get_one("select id from " . $table_comment_name . " where comment_id='" . $cv['comment_id'] . "'");
                    if (empty($check_result) == false) {
                        continue;
                    }
                    $images_str = '';
                    if (isset($cv['images']) == true) {
                        foreach ($cv['images'] as $tik => $tiv) {
                            $images_str .= $tiv['large']['url'] . ',';
                        }
                    }
                    rtrim($images_str, ',');
                    $comment_info = [
                        'comment_id' => $cv['comment_id'],
                        'created_at' => strtotime($cv['create_time']),
                        'owner' => $cv['owner']['user_id'],
                        'content' => $cv['text'],
                        'likes_count' => $cv['likes_count'],
                        'topic_id' => $rv['topic_id'],
                        'images' => $images_str,
                    ];
                    //用户入库
                    save_user($cv['owner']);
                    //评论入库
                    db::insert($table_comment_name, $comment_info);
                }
            }
        }
    }

    echo $group_name . ' : db save done: ' . $i . '; insert:' . $insert_count . '; update:' . $update_count, PHP_EOL;
}

function save_user($user){
    $table_user_name = 'ask_xmq_user';

    $user['created_at'] = time();
    $check_result = db::get_one("select id from " . $table_user_name . " where user_id='" . $user['user_id'] . "'");
    if (empty($check_result) == true) {
        db::insert($table_user_name, $user);
    }

}
?>

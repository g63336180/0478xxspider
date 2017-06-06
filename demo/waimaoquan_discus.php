<?php
ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';
/**
 * 1 外贸新闻
 * 2 外贸英语
 * 3 外贸知识
 * 4 外贸经验
 * 5 外贸职场
 * 6
 * 7 外贸公司
 * 8 外贸平台
 * 9 外贸英语函电
 * 10 外贸英语口语
 * 11 外贸英语词汇
 * 12 
 * 13 贸易术语
 * 14 英语听力技巧
 * 15 英语学习方法
 * 16 外贸单证
 * 17 外贸跟单
 * 18 出口退税
 * 19 检验检疫
 * 20 外贸流程
 * 21 国际物流
 * 22  出口保险
 * 24 新手入门
 * 26 岗位职责
 * 28 国际结算
 * 31 B2C开店
 * 33 外贸建站
 * 36 邮件营销
 * 38 谷歌推广
 * 39商务英语阅读
 * 40  外贸B2B
 * 42 营销策划
 * 43 商业人物
 * 44 商务签证
 * 45 离岸公司
 * 46 广交会
 * 47 
 */

// $url = "https://waimaoquan.alibaba.com/ask/q1001338070/?spm=a2700.7705449.0.0.XZC8IN";
// requests::set_useragents([
//         'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
//         'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
//         'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;',
//         'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)',
//         'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
//         'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)'
//         ]);
//     requests::set_header('Referer','http://www.toxue.com');
//     requests::set_cookies("__utmz=119447770.1484795311.1.1.utmccn=(organic)|utmcsr=baidu|utmctr=|utmcmd=organic; 5HD_oldtopics=D405194D; 5HD_visitedfid=71D2D3; __utma=119447770.150480320.1484795311.1484795311.1484804588.2; __utmc=119447770; __utmb=119447770; 5HD_sid=BDrvEP");
// $html = requests::get($url);
// // 选择器规则
// $selector = "//div[@id='question-detail']/div[@class='question-info']/div[@class='question-info-container']/p[@class='question-info-more']";
// // 提取结果
// $result = selector::select($html, $selector);
// var_dump($result);die();
/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '外贸圈',
    'tasknum' => 1,
    'log_show' => true,
    'domains' => array(
        'alibaba.com',
        'waimaoquan.alibaba.com'
    ),
    'scan_urls' => array(
        'https://waimaoquan.alibaba.com/ask/latestmore.html',
    ),
    'list_url_regexes' => array(
        'http\:\/\/waimaoquan\.alibaba\.com/bbs/read-htm-tid-2933775-\d+-fid-2933775\.html'
    ),
    'content_url_regexes' => array(
        "https://waimaoquan\.alibaba\.com/ask/q\d+/\?\w+",
    ),
    'max_try' => 1,
    'max_depth' => 5,
    'export' => array(
        'type' => 'db', 
        'table' => 'ask_article',
    ),
    'fields' => array(
        array(
            'name' => "title",
            'selector' => "//div[@id='question-detail']/div[@class='question-info']/div[@class='question-info-container']/div[@class='question-info-title']/h1",
            //'selector' => "/html/body/center/div[@class='maintable'][4]/div[@class='spaceborder']/table/tbody/tr[@class='header']/td/text()",
            'required' => true,
        ),
        array(
            'name' => "description",
            'selector' => "//div[@id='question-detail']/div[@class='question-info']/div[@class='question-info-container']/p[@class='question-info-more']",
            'required' => true,
        ),
        array(
            'name' => 'category_id',
            'selector' => "//div[@id='question-detail']/div[@class='question-info']/div[@class='question-info-container']/div[@class='question-info-cate']/a",
        ),
        array(
            'name' => 'user_id',
            'selector' => "",
        ),
        array(
            'name' => 'device',
            'selector' => "",
        ),
        array(
            'name' => 'status',
            'selector' => "",
        ),
        array(
            'name' => 'created_at',
            'selector' => "",
        ),
        array(
            'name' => 'updated_at',
            'selector' => "",
        ),
        array(
            'name' => 'a_id',
            'selector' => "",
        ),
    ),
);

$spider = new phpspider($configs);
$spider->on_scan_page = function($page, $html, $spider){
    for($i = 8; $i < 500; $i ++){
        $url = "https://waimaoquan.alibaba.com/ask/latestmore.html?page=" . $i . "&spm=a";
        $spider->add_url($url);
    }
};
$spider->on_extract_field = function($fieldname, $data, $page) 
{
    $category_arr = array(
  // 1 => '外贸新闻',
  // 2 => '外贸英语',
  3 => '产品发布与管理',
  4 => '采购直达',
  5 => '外贸邮（询盘和客户）',
  7 => '找卖家',
  8 => '找买家',
  // 9 => '外贸英语函电',
  // 10 => '外贸英语口语',
  // 11 => '外贸英语词汇',
  13 => '买卖沟通',
  // 14 => '英语听力技巧',
  // 15 => '英语学习方法',
  // 16 => '外贸单证',
  // 17 => '外贸跟单',
  // 18 => '出口退税',
  // 19 => '检验检疫',
  // 20 => '外贸流程',
  // 21 => '国际物流',
  // 22  => '出口保险',
  24 => '外贸心情,外贸新人,外贸SOHO,农业食品,服装纺织配饰,汽摩交通',
  // 26 => '岗位职责',
  // 28 => '国际结算',
  // 31 => 'B2C开店',
  // 33 => '外贸建站',
  // 36 => '邮件营销',
  // 38 => '谷歌推广',
  // 39 => '商务英语阅读',
  // 40  => '外贸B2B',
  // 42 => '营销策划',
  // 43 => '商业人物',
  // 44 => '商务签证',
  // 45 => '离岸公司',
  // 46 => '广交会',
    );
    if ($fieldname == 'category_id'){
        foreach ($category_arr as $key => $value) {
            if (strpos($value, $data) != false) {
                $data = $key;
            }
        }
    }
    return $data;
};
$spider->on_extract_page = function($page, $fields){
    // if (strpos($page['url'], '?') != false){
    //     return [];
    // }
    $fields['user_id'] = 2;
    $fields['device'] = 1;
    $fields['status'] = 1;
    $fields['views']  = 1;
    $fields['created_at'] = date('Y-m-d H:i:s');
    $fields['updated_at'] = date('Y-m-d H:i:s');
    preg_match("#/q(\d+)#", $page['url'], $match);
    if (isset($match[1])) {
        $fields['a_id'] = $match[1];
    }
    return $fields;
};

$spider->start();



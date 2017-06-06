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

// $url = "http://bbs.fob5.com/thread-101548-1-1.html";
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
// $selector = "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[2]/td";
// // 提取结果
// $result = selector::select($html, $selector);
// var_dump($result);die();
/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => 'Toxue 外贸网',
    'tasknum' => 1,
    'log_show' => true,
    'domains' => array(
        'fob5.com',
        'bbs.fob5.com'
    ),
    'scan_urls' => array(
        'http://bbs.fob5.com/',
    ),
    'list_url_regexes' => array(
        'http://bbs.fob5.com/forum-144-\d+.html'
    ),
    'content_url_regexes' => array(
        "http://bbs.fob5.com/thread-\d+-1-1.html",
    ),
    'max_try' => 1,
    'export' => array(
        'type' => 'db', 
        'table' => 'ask_people',
    ),
    'fields' => array(
        array(
            'name' => "title",
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']/table[1]//span[@id='thread_subject']",
            //'selector' => "/html/body/center/div[@class='maintable'][4]/div[@class='spaceborder']/table/tbody/tr[@class='header']/td/text()",
            'required' => true,
        ),
        array(
            'name' => "user_name",
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[1]/td",
            'required' => true,
        ),
        array(
            'name' => 'city',
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[2]/td",
        ),
        array(
            'name' => 'hangye',
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[3]/td",
        ),
        array(
            'name' => 'lianxi',
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[4]/td",
        ),
        array(
            'name' => 'desc',
            'selector' => "//div[@id='wp']/div[@id='ct']/div[@id='postlist']//div[@class='typeoption']//table[1]/tbody/tr[5]/td",
        ),
    ),
);

$spider = new phpspider($configs);

$spider->on_start = function($phpspider) 
{
    requests::set_useragents([
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
        'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;',
        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)',
        'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)'
        ]);
    requests::set_header('Referer','http://bbs.fob5.com/');
};
$spider->on_scan_page = function($page, $html, $spider) {
  for($i = 1;$i < 625; $i++){
        $spider->add_url('http://bbs.fob5.com/forum-144-' . $i . '.html');
  }
};
$spider->on_extract_field = function($fieldname, $data, $page) 
{
    return $data;
};
$spider->on_extract_page = function($page, $fields){
    return $fields;
};

$spider->start();
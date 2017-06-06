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

// $url = "http://www.toxue.com/view/2016/0919/733.html";
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
// $selector = "//section[@class='container']/div[@class='content-wrap']/div[@class='content']/article[@class='article-content']";
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
        'toxue.com',
        'www.toxue.com'
    ),
    'scan_urls' => array(
        'http://www.toxue.com/',
    ),
    'list_url_regexes' => array(
        'http://www.toxue.com/page/\d+.html'
    ),
    'content_url_regexes' => array(
        "http://www.toxue.com/view/\d+/\d+/\d+.html",
    ),
    'max_try' => 1,
    'export' => array(
        'type' => 'db', 
        'table' => 'ask_articles',
    ),
    'fields' => array(
        array(
            'name' => "title",
            'selector' => "//div[@class='content']/header[@class='article-header']/h1[@class='article-title']",
            //'selector' => "/html/body/center/div[@class='maintable'][4]/div[@class='spaceborder']/table/tbody/tr[@class='header']/td/text()",
            'required' => true,
        ),
        array(
            'name' => "content",
            'selector' => "//section[@class='container']/div[@class='content-wrap']/div[@class='content']/article[@class='article-content']",
            'required' => true,
        ),
        array(
            'name' => 'category_id',
            'selector' => "//div[@class='content']/header[@class='article-header']/div[@class='article-meta']/span[@class='item'][2]/a",
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
    ),
);

$spider = new phpspider($configs);

$spider->on_extract_field = function($fieldname, $data, $page) 
{
    $category_arr = array(
  1 => '外贸新闻',
  2 => '外贸英语',
  3 => '外贸知识',
  4 => '外贸经验',
  5 => '外贸职场',
  7 => '外贸公司',
  8 => '外贸平台',
  9 => '外贸英语函电',
  10 => '外贸英语口语',
  11 => '外贸英语词汇',
  13 => '贸易术语',
  14 => '英语听力技巧',
  15 => '英语学习方法',
  16 => '外贸单证',
  17 => '外贸跟单',
  18 => '出口退税',
  19 => '检验检疫',
  20 => '外贸流程',
  21 => '国际物流',
  22  => '出口保险',
  24 => '新手入门',
  26 => '岗位职责',
  28 => '国际结算',
  31 => 'B2C开店',
  33 => '外贸建站',
  36 => '邮件营销',
  38 => '谷歌推广',
  39 => '商务英语阅读',
  40  => '外贸B2B',
  42 => '营销策划',
  43 => '商业人物',
  44 => '商务签证',
  45 => '离岸公司',
  46 => '广交会',
    );
    if ($fieldname == 'category_id'){
        foreach ($category_arr as $key => $value) {
            if ($value == $data) {
                $data = $key;
            }
        }
    }
    return $data;
};
$spider->on_extract_page = function($page, $fields){
    $fields['user_id'] = 2;
    $fields['device'] = 1;
    $fields['status'] = 1;
    $fields['views']  = 1;
    $fields['created_at'] = date('Y-m-d H:i:s');
    $fields['updated_at'] = date('Y-m-d H:i:s');
    return $fields;
};

$spider->start();



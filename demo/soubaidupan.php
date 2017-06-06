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

// $url = "http://www.sobaidupan.com/file-1335158.html";
// requests::set_useragents([
//         'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
//         'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
//         'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;',
//         'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)',
//         'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
//         'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)'
//         ]);
//     requests::set_header('Referer','http://www.sobaidupan.com/search.asp?r=0&wd=%E5%A4%96%E8%B4%B8&p=&page=2&m=ff9965cd000dfbc0322afe63ec27d4f5');
//     requests::set_cookies("__cfduid=d16594fc4838442fda461287dc8a638751486607137; ASPSESSIONIDAADSBADT=EMFJBFODAEAALFFBLGFLGOCK; userid=188255b07dcc241873a45b9eedb0408c; ASPSESSIONIDCCDTDBCT=EMGDFFODCLGPOIABCBIALAIG; ASPSESSIONIDCCASCCBT=LPHCFFODJPCCJEIGFBINOIHF; CNZZDATA1254604262=832858749-1486606446-null%7C1486778909; Hm_lvt_f9d133598d63eabee77f59430aefa2ab=1486607296,1486615843,1486699028,1486771865; Hm_lpvt_f9d133598d63eabee77f59430aefa2ab=1486783939");
// $html = requests::get($url);
// // 选择器规则
// $selector = "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div";
// // 提取结果
// $result = selector::select($html, $selector);
// $tmp = explode('<b>', $result);

// $tmp = strip_tags($tmp[1]);
// $tmp = explode('：', $tmp);
// var_dump($tmp[1]);die();
/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '搜百度盘',
    'tasknum' => 1,
    'log_show' => true,
    'domains' => array(
        'sobaidupan.com',
        'www.sobaidupan.com'
    ),
    'scan_urls' => array(
        'http://www.sobaidupan.com/',
    ),
    'list_url_regexes' => array(
        'http://www.sobaidupan.com/search.asp?r=0&wd=%E5%A4%96%E8%B4%B8&p=&page=\d+&m=ff9965cd000dfbc0322afe63ec27d4f5',
    ),
    'content_url_regexes' => array(
        "http://www.sobaidupan.com/file-\d+.html",
    ),
    'max_try' => 1,
    'export' => array(
        'type' => 'db', 
        'table' => 'ask_sopan',
    ),
    'fields' => array(
        array(
            'name' => "title",//<b>资源名称：</b>网上外贸.doc
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[3]/td/div",
            'required' => true,
        ),
        array(
            'name' => "size",//<b>资源大小：</b>21 KB <b>资料扩展名：</b>.doc <b>访问/下载次数</b>：226/36 <b>分享日期：</b>2015/3/21 23:08:00
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div",
            'required' => true,
        ),
        array(
            'name' => 'views',
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div",
        ),
        array(
            'name' => 'downloads',
            'selector' => "/html/body/div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div",
        ),
        array(
            'name' => 'username',//用户名：eshopun
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[1]/table/tr[2]/td/div",
        ),
        array(
            'name' => 'user_id',//user-1879474161-1.html
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[1]/table/tr[3]/td/div/a/@href",
        ),
        array(
            'name' => 'source',
            'selector' => "",
        ),
        array(
            'name' => 'extension',
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div",
        ),
        array(
            'name' => 'description',
            'selector' => "",
        ),
        array(
            'name' => 'create_datetime',
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[5]/td/div",
        ),
        array(
            'name' => 'open_id',
            'selector' => "",
        ),
        array(
            'name' => 'open_url',
            'selector' => "",
        ),

        array(
            'name' => 'download_url',
            'selector' => "",
        ),
        array(
            'name' => 'open_download_url',
            'selector' => "//div[@class='main w c']/div[@class='art_box']/table/tr/td[2]/table/tr[7]/td/table/tr/td[1]/div/a/@href",
        ),
    ),
);

$spider = new phpspider($configs);
$spider->on_scan_page = function($page, $html, $spider){
      for ($i = 1; $i < 100; $i ++) {
          $spider->add_url('http://www.sobaidupan.com/search.asp?r=0&wd=外贸&p=&page=' . $i . '&m=ff9965cd000dfbc0322afe63ec27d4f5');
      }
};
$spider->on_extract_field = function($fieldname, $data, $page) 
{
    if ($fieldname == 'title') {
        $data = strip_tags($data);
        $tmp = explode('：', $data);
        $data = $tmp[1];
    } elseif ($fieldname == 'size'){
        $tmp = explode('<b>', $data);

        $tmp = strip_tags($tmp[1]);
        $tmp = explode('：', $tmp);

        $data = $tmp[1];
    } elseif ($fieldname == 'views'){
        $tmp = explode('<b>', $data);

        $tmp = strip_tags($tmp[3]);
        $tmp = explode('：', $tmp);
        $tmp = explode('/', $tmp[1]);
        $data = $tmp[0];
    } elseif ($fieldname == 'downloads'){
        $tmp = explode('<b>', $data);

        $tmp = strip_tags($tmp[3]);
        $tmp = explode('：', $tmp);
        $tmp = explode('/', $tmp[1]);
        $data = $tmp[1];
    } elseif ($fieldname == 'username'){
        $tmp = explode('：', $data);
        $data = $tmp[1];
    } elseif ($fieldname == 'user_id'){
        $tmp = explode('-', $data);
        $data = $tmp[1];
    } elseif ($fieldname == 'extension'){
        $tmp = explode('<b>', $data);

        $tmp = strip_tags($tmp[2]);
        $tmp = explode('：', $tmp);

        $data = $tmp[1];
    } elseif ($fieldname == 'create_datetime'){
        $tmp = explode('<b>', $data);

        $tmp = strip_tags($tmp[4]);
        $tmp = explode('：', $tmp);

        $data = strtotime($tmp[1]);
    }
    return $data;
};
$spider->on_extract_page = function($page, $fields){
    $fields['source'] = 1;
    return $fields;
};

$spider->start();



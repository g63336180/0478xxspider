<?php
ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';


$url = "http://bbs.fobshanghai.com/thread-405194-1-1.html";
requests::set_useragents([
        'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; en-us) AppleWebKit/534.50 (KHTML, like Gecko) Version/5.1 Safari/534.50',
        'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
        'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0;',
        'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0)',
        'Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
        'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; 360SE)'
        ]);
    requests::set_header('Referer','http://bbs.fobshanghai.com/index.php');
    requests::set_cookies("__utmz=119447770.1484795311.1.1.utmccn=(organic)|utmcsr=baidu|utmctr=|utmcmd=organic; 5HD_oldtopics=D405194D; 5HD_visitedfid=71D2D3; __utma=119447770.150480320.1484795311.1484795311.1484804588.2; __utmc=119447770; __utmb=119447770; 5HD_sid=BDrvEP");
$html = requests::get($url);
var_dump($html);die();
// 选择器规则
$selector = "/html";
// 提取结果
$result = selector::select($html, $selector);
echo $result;die();
/* Do NOT delete this comment */
/* 不要删除这段注释 */

$configs = array(
    'name' => '福布外贸',
	'tasknum' => 1,
	'log_show' => true,
    'domains' => array(
        'fobshanghai.com',
        'bbs.fobshanghai.com'
    ),
	'scan_urls' => array(
		'http://bbs.fobshanghai.com/index.php',
    ),
	'list_url_regexes' => array(
		'http://bbs.fobshanghai.com/forum-\d+-\d+.html',
    ),
	'content_url_regexes' => array(
		'http://bbs.fobshanghai.com/thread-\d+-1-1.html',
    ),
    'max_try' => 1,
    'export' => array(
        'type' => 'db', 
        'table' => 'ask_questions',
    ),
    'fields' => array(
        array(
			'name' => "title",
			'selector' => "/html/body/center/div[@class='maintable']/div[@class='spaceborder']/table/tbody/tr[@class='header']/td/text()",
            //'selector' => "/html/body/center/div[@class='maintable'][4]/div[@class='spaceborder']/table/tbody/tr[@class='header']/td/text()",
            'required' => true,
        ),
        array(
            'name' => "description",
            'selector' => "/html/body/center/div[@class='maintable']/form/div[@class='spaceborder'][1]/table[@class='t_row']/tbody/tr/td[2]/table[@class='t_msg']/tbody/tr[2]/td[@class='line']",
            'required' => true,
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
    if ($fieldname == 'content') 
    {
        $data = strip_tags($data);
    }
    return $data;
};
$spider->on_extract_page = function($page, $fields){
	$fields['user_id'] = 1;
	$fields['device'] = 1;
	$fields['status'] = 1;
	$fields['created_at'] = date('Y-m-d H:i:s');
	$fields['updated_at'] = date('Y-m-d H:i:s');
};

$spider->start();



<?php

ini_set("memory_limit", "1024M");
require dirname(__FILE__).'/../core/init.php';

//1.先访问登录页，获取cookies并保存
$login_url = "https://signin.aliyun.com/1040727955031058/login.htm?callback=https%3A%2F%2Fhome.console.aliyun.com%2Fnew&oauth_callback=https%3A%2F%2Fhome.console.aliyun.com%2Fnew";
// 发送登录请求
$content = requests::get($login_url);
// 登录成功后本框架会把Cookie保存到www.waduanzi.com域名下，我们可以看看是否是已经收集到Cookie了
$cookies = requests::get_cookies('signin.aliyun.com');
// 解析HTTP数据流 
preg_match('/name="sec_token" value="(\w+)"/', $content, $matches);
$sec_token = $matches[1];

//构建登录表单信息
$params = array(
    'sec_token' => $sec_token,
    'callback'  => 'https://home.console.aliyun.com/new',
    'parent'    => '1040727955031058',
    'name'      => 'taishiganzhi',
    'password'  => 'tai&35shiganzhi'
);
// 登录请求url
$login_url = 'https://signin.aliyun.com/login.htm';
$cookie_str = build_cookie_str($cookies);
requests::set_cookies($cookie_str);
requests::set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36');
// 2.发送登录请求
requests::post($login_url, $params);

// 3.登录成功，发起session请求
$session_url = requests::$info['redirect_url'];
$cookies = requests::get_cookies("signin.aliyun.com");
$cookie_str = build_cookie_str($cookies);
requests::set_cookies($cookie_str);
requests::get($session_url);


// requests对象自动收集Cookie，访问这个域名下的URL会自动带上
// 4.登录成功，获取态势感知API内容
$url = "https://yundun.console.aliyun.com/sas/application/getAccessList.json?__preventCache=1490770687048&limit=1200&start=0";
$cookies = requests::get_cookies("signin.aliyun.com");
$cookie_str = build_cookie_str($cookies);
requests::set_cookies($cookie_str);
$html = requests::get($url);
save_ip($html);
echo 'done';     // 可以看到登录后的页面，非常棒

/**
 * 构建cookie字符串
 * @param  [type] $cookies [description]
 * @return [type]          [description]
 */
function build_cookie_str($cookies){
    $cookie_str = '';
    if (empty($cookies) == false) {
        foreach ($cookies as $ck => $cv) {
            $cookie_str .= $ck . '=' . $cv . ';';
        }
    }

    return $cookie_str;
}

/**
 * [save_ip description]
 * @param  [type] $result [description]
 * @return [type]         [description]
 */
function save_ip($result) {
    $table_name = 'cj_aliyun_access_log';

    $result = json_decode($result, true);
    if (empty($result) == true) {
        return false;
    }
    $i = 0;
    $insert_count = 0;
    $update_count = 0;
    if (isset($result['data']['items']) && empty($result['data']['items']) == false) {
        foreach ($result['data']['items'] as $rk => $rv) {
            $i++;
            $check_result = db::get_one("select id from " . $table_name . " where sourceIp='" . $rv['sourceIp'] . "'");
            $rv['firstAccessDate'] = strtotime($rv['firstAccessDate']);
            $rv['log_id'] = $rv['id'];
            unset($rv['id']);
            if (empty($check_result) == false) {
                $update_count++;
                db::update($table_name, $rv, ["sourceIp='" . $rv['sourceIp'] . "'"]);
            } else {
                $insert_count++;
                //入库
                db::insert($table_name, $rv);
            }
        }
    }

    echo 'db save done: ' . $i . '; insert:' . $insert_count . '; update:' . $update_count;
}

?>

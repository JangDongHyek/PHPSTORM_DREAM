<?php

define('__HHGYU__',"hhgyu");
ob_start();
ob_implicit_flush(0);
session_cache_limiter('');
session_start();
set_time_limit(0);

$path = $_SERVER['SCRIPT_FILENAME'];
$tmp = explode("/",$_SERVER['SCRIPT_FILENAME']);
$path = str_replace($tmp[count($tmp)-1],"",$path);

$server_path = str_replace(basename(__FILE__), "", realpath(__FILE__));

define("__ROOT_PATH__", $server_path);
define("__INCLUDE_PATH__", __ROOT_PATH__ . "include/");

require_once(__INCLUDE_PATH__ . 'config.php');
$config = &Config::getInstance();
require_once(__INCLUDE_PATH__ . 'include.php');
$mysql_query->connent();
//$json = new Services_JSON();
//header('Content-Type: text/html; charset=utf-8');
if(!$mysql_query->isConnected())
{
	$rows = array();
	$rows['error']['message']='DB에 접속할수 없습니다!\r\n';
	$rows['error']['number']=0;
	json_encode($rows);
	return;
}

//이벤트 생성 후 자동 푸쉬 알림 현재는 테스트 아이디만
$eventTitle = "테스트GCM입니다 ^^";
$msg = <<<EOD
<!DOCTYPE html>
<html lang="ko">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi" />
</head>
<body>
<p style="color:#512504;font-size=11pt;">※새로운 게시물이 등록되었습니다.</p>
</body>
</html>
EOD;
//<img src="http://wimg.fileham.com/event/gcm/FridayEvent/pop_event.jpg" style="width:100%;display: block;margin: 0 auto;" />


//$sa_id = "ab@#c";
$post_user = $user_name;
if($post_user == null || $post_user == "") return;
$options = array();
$options['ID'] = $post_user;

//$options['ID'] = "gogoflvhxj";
//$options['arrID'] = array("gogoflvhxj", "gogoflvhxj");

if($options != null && count($options) > 0){
	$options = $evnet_manager->allowOptions($options);
	if(count($options) != 1) {
		echo "여러개의 조건은 지원하지 않습니다.\n<br />";
		exit;
	}
}
$post_title = $button_string;
$result2 = false;
$returnObj = array();
if($options != null && count($options) > 0){
	if(count($options) == 1) {
		reset ($options);
		$firstKey = key($options);
		if($firstKey == "idx") {
			$result2 = $gcm_manager->sendToMember_idx($postNo, $options["idx"], $post_title, $post_content, "$button_string", "$url", null, $returnObj);
		} else if($firstKey == "ID") {
			$result2 = $gcm_manager->sendToMember_ID($postNo, $options["ID"], $post_title, $post_content, "$button_string", "$url", null, $returnObj);
		} else if($firstKey == "arrID") {
			if(is_array($options["arrID"])) {
				foreach($options["arrID"] as $id) {
					$result2 = $gcm_manager->sendToMember_ID($postNo, $id, $post_title, $post_content, "$button_string", "$url", null, $returnObj);
					if($result2 == false) {
						 $id . " GCM Push failed!\n<br />";
					}
				}
				$result2 = false;
			}
		} else {
			echo "허용하지 않는 key 입니다.\n<br />";
			exit;
		}
	}

}else {
	
	$result2 = $gcm_manager->sendToMember_ALL($postNo,$post_title, $post_content, "", "$url", null, $returnObj);
}
if($result2 != false) {
	 json_encode($returnObj);
}
$mysql_query->close();
GzDocOut(9,0);
ob_end_flush();


?>
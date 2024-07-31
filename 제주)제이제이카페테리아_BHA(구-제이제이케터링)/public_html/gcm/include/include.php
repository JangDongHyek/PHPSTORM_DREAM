<?php
if(!defined('__HHGYU__')) exit();

// 짧은 환경변수를 지원하지 않는다면
if (isset($HTTP_POST_VARS) && !isset($_POST)) {
	$_POST   = &$HTTP_POST_VARS;
	$_GET    = &$HTTP_GET_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_ENV    = &$HTTP_ENV_VARS;
	$_FILES  = &$HTTP_POST_FILES;

    if (!isset($_SESSION))
		$_SESSION = &$HTTP_SESSION_VARS;
}

//
// phpBB2 참고
// php.ini 의 magic_quotes_gpc 값이 FALSE 인 경우 addslashes() 적용
// SQL Injection 등으로 부터 보호
//
if( !get_magic_quotes_gpc() )
{
	if( is_array($_GET) )
	{
		while( list($k, $v) = each($_GET) )
		{
			if( is_array($_GET[$k]) )
			{
				while( list($k2, $v2) = each($_GET[$k]) )
				{
					$_GET[$k][$k2] = addslashes($v2);
				}
				@reset($_GET[$k]);
			}
			else
			{
				$_GET[$k] = addslashes($v);
			}
		}
		@reset($_GET);
	}

	if( is_array($_POST) )
	{
		while( list($k, $v) = each($_POST) )
		{
			if( is_array($_POST[$k]) )
			{
				while( list($k2, $v2) = each($_POST[$k]) )
				{
					if (!is_array($v2)) $_POST[$k][$k2] = addslashes($v2);
				}
				@reset($_POST[$k]);
			}
			else
			{
				$_POST[$k] = addslashes($v);
			}
		}
		@reset($_POST);
	}

	if( is_array($_COOKIE) )
	{
		while( list($k, $v) = each($_COOKIE) )
		{
			if( is_array($_COOKIE[$k]) )
			{
				while( list($k2, $v2) = each($_COOKIE[$k]) )
				{
					$_COOKIE[$k][$k2] = addslashes($v2);
				}
				@reset($_COOKIE[$k]);
			}
			else
			{
				$_COOKIE[$k] = addslashes($v);
			}
		}
		@reset($_COOKIE);
	}
}

require_once(__ROOT_PATH__."include/DB.php");
require_once(__ROOT_PATH__."include/mobile.php");
require_once(__ROOT_PATH__."include/member_class.php");
require_once(__ROOT_PATH__."include/gcm_manager.php");
require_once(__ROOT_PATH__."include/event_manager.php");
require_once(__ROOT_PATH__."include/function_tool.php");

$mobile = &Mobile::getInstance();
$member_class = &Member_Class::getInstance();
$gcm_manager = &GCM_Manager::getInstance();
$evnet_manager = &Event_Manager::getInstance();

$DB = &DB::getInstance();
$mysql_query = $DB->db;

/* 브로우저가 gzip 인코딩을 지원하는지 판정하는 함수 */
function CheckCanGzip(){
    global $_SERVER;
    if (headers_sent() || connection_aborted()){
        return 0;
    }
    if (strpos($_SERVER["HTTP_ACCEPT_ENCODING"], 'x-gzip') !== false) return "x-gzip";
    if (strpos($_SERVER["HTTP_ACCEPT_ENCODING"],'gzip') !== false) return "gzip";
    return 0;
}

/* $level = 압축 레벨, 0=압축 안함, 9=최대 */
function GzDocOut($level=9,$debug=0){
	global $phpEx;
    $ENCODING = CheckCanGzip();
//	$ENCODING = 'gzip';
    if ($ENCODING){
        $Contents = ob_get_contents();
        ob_end_clean();
        if ($debug){
            $s = "<p>Not compress length: ".strlen($Contents);
            $s .= "<br>Compressed length: ".strlen(gzcompress($Contents,$level));
            $Contents .= $s;
        }
        header("Content-Encoding: $ENCODING");
        print "\x1f\x8b\x08\x00\x00\x00\x00\x00";
        $Size = strlen($Contents);
        $Crc = crc32($Contents);
        $Contents = gzcompress($Contents,$level);
        $Contents = substr($Contents, 0, strlen($Contents) - 4);
        print $Contents;
        print pack('V',$Crc);
        print pack('V',$Size);
    }
}
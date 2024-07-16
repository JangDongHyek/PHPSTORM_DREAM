<?php
/*******************************************************************************
** 공통 변수, 상수, 코드
*******************************************************************************/
error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING );

// 보안설정이나 프레임이 달라도 쿠키가 통하도록 설정
header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

if (!defined('G5_SET_TIME_LIMIT')) define('G5_SET_TIME_LIMIT', 0);
@set_time_limit(G5_SET_TIME_LIMIT);


//==========================================================================================================================
// extract($_GET); 명령으로 인해 page.php?_POST[var1]=data1&_POST[var2]=data2 와 같은 코드가 _POST 변수로 사용되는 것을 막음
// 081029 : letsgolee 님께서 도움 주셨습니다.
//--------------------------------------------------------------------------------------------------------------------------
$ext_arr = array ('PHP_SELF', '_ENV', '_GET', '_POST', '_FILES', '_SERVER', '_COOKIE', '_SESSION', '_REQUEST',
                  'HTTP_ENV_VARS', 'HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS',
                  'HTTP_COOKIE_VARS', 'HTTP_SESSION_VARS', 'GLOBALS');
$ext_cnt = count($ext_arr);
for ($i=0; $i<$ext_cnt; $i++) {
    // POST, GET 으로 선언된 전역변수가 있다면 unset() 시킴
    if (isset($_GET[$ext_arr[$i]]))  unset($_GET[$ext_arr[$i]]);
    if (isset($_POST[$ext_arr[$i]])) unset($_POST[$ext_arr[$i]]);
}
//==========================================================================================================================


function g5_path()
{
    $result['path'] = str_replace('\\', '/', dirname(__FILE__));
    $tilde_remove = preg_replace('/^\/\~[^\/]+(.*)$/', '$1', $_SERVER['SCRIPT_NAME']);
    $document_root = str_replace($tilde_remove, '', $_SERVER['SCRIPT_FILENAME']);
    $root = str_replace($document_root, '', $result['path']);
    $port = $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '';
    $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ? 's' : '') . '://';
    $user = str_replace(str_replace($document_root, '', $_SERVER['SCRIPT_FILENAME']), '', $_SERVER['SCRIPT_NAME']);
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    if(isset($_SERVER['HTTP_HOST']) && preg_match('/:[0-9]+$/', $host))
        $host = preg_replace('/:[0-9]+$/', '', $host);
    $result['url'] = $http.$host.$port.$user.$root;
    return $result;
}

$g5_path = g5_path();

include_once($g5_path['path'].'/config.php');   // 설정 파일

unset($g5_path);


// multi-dimensional array에 사용자지정 함수적용
function array_map_deep($fn, $array)
{
    if(is_array($array)) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                $array[$key] = array_map_deep($fn, $value);
            } else {
                $array[$key] = call_user_func($fn, $value);
            }
        }
    } else {
        $array = call_user_func($fn, $array);
    }

    return $array;
}


// SQL Injection 대응 문자열 필터링
function sql_escape_string($str)
{
    if(defined('G5_ESCAPE_PATTERN') && defined('G5_ESCAPE_REPLACE')) {
        $pattern = G5_ESCAPE_PATTERN;
        $replace = G5_ESCAPE_REPLACE;

        if($pattern)
            $str = preg_replace($pattern, $replace, $str);
    }

    $str = call_user_func('addslashes', $str);

    return $str;
}


//==============================================================================
// SQL Injection 등으로 부터 보호를 위해 sql_escape_string() 적용
//------------------------------------------------------------------------------
// magic_quotes_gpc 에 의한 backslashes 제거
if (get_magic_quotes_gpc()) {
    $_POST    = array_map_deep('stripslashes',  $_POST);
    $_GET     = array_map_deep('stripslashes',  $_GET);
    $_COOKIE  = array_map_deep('stripslashes',  $_COOKIE);
    $_REQUEST = array_map_deep('stripslashes',  $_REQUEST);
}

// sql_escape_string 적용
$_POST    = array_map_deep(G5_ESCAPE_FUNCTION,  $_POST);
$_GET     = array_map_deep(G5_ESCAPE_FUNCTION,  $_GET);
$_COOKIE  = array_map_deep(G5_ESCAPE_FUNCTION,  $_COOKIE);
$_REQUEST = array_map_deep(G5_ESCAPE_FUNCTION,  $_REQUEST);
//==============================================================================


// PHP 4.1.0 부터 지원됨
// php.ini 의 register_globals=off 일 경우
@extract($_GET);
@extract($_POST);
@extract($_SERVER);


// 완두콩님이 알려주신 보안관련 오류 수정
// $member 에 값을 직접 넘길 수 있음
$config = array();
$member = array();
$board  = array();
$group  = array();
$g5     = array();


//==============================================================================
// 공통
//------------------------------------------------------------------------------
$dbconfig_file = G5_DATA_PATH.'/'.G5_DBCONFIG_FILE;
if (file_exists($dbconfig_file)) {
    include_once($dbconfig_file);
    include_once(G5_LIB_PATH.'/common.lib.php');    // 공통 라이브러리

    $connect_db = sql_connect(G5_MYSQL_HOST, G5_MYSQL_USER, G5_MYSQL_PASSWORD) or die('MySQL Connect Error!!!');
    $select_db  = sql_select_db(G5_MYSQL_DB, $connect_db) or die('MySQL DB Error!!!');

    // mysql connect resource $g5 배열에 저장 - 명랑폐인님 제안
    $g5['connect_db'] = $connect_db;

    sql_set_charset('utf8mb4', $connect_db); // utf8 ==> utf8mb4로 변경 (이모지 사용 때문)
    if(defined('G5_MYSQL_SET_MODE') && G5_MYSQL_SET_MODE) sql_query("SET SESSION sql_mode = ''");
    if (defined(G5_TIMEZONE)) sql_query(" set time_zone = '".G5_TIMEZONE."'");
} else {
?>

<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>오류! <?php echo G5_VERSION ?> 설치하기</title>
<link rel="stylesheet" href="install/install.css">
</head>
<body>

<div id="ins_bar">
    <span id="bar_img">GNUBOARD5</span>
    <span id="bar_txt">Message</span>
</div>
<h1>그누보드5를 먼저 설치해주십시오.</h1>
<div class="ins_inner">
    <p>다음 파일을 찾을 수 없습니다.</p>
    <ul>
        <li><strong><?php echo G5_DATA_DIR.'/'.G5_DBCONFIG_FILE ?></strong></li>
    </ul>
    <p>그누보드 설치 후 다시 실행하시기 바랍니다.</p>
    <div class="inner_btn">
        <a href="<?php echo G5_URL; ?>/install/"><?php echo G5_VERSION ?> 설치하기</a>
    </div>
</div>
<div id="ins_ft">
    <strong>GNUBOARD5</strong>
    <p>GPL! OPEN SOURCE GNUBOARD</p>
</div>

</body>
</html>

<?php
    exit;
}
//==============================================================================


//==============================================================================
// SESSION 설정
//------------------------------------------------------------------------------
@ini_set("session.use_trans_sid", 0);    // PHPSESSID를 자동으로 넘기지 않음
@ini_set("url_rewriter.tags",""); // 링크에 PHPSESSID가 따라다니는것을 무력화함 (해뜰녘님께서 알려주셨습니다.)

session_save_path(G5_SESSION_PATH);

if (isset($SESSION_CACHE_LIMITER))
    @session_cache_limiter($SESSION_CACHE_LIMITER);
else
    @session_cache_limiter("no-cache, must-revalidate");

ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 10800); // session data의 garbage collection 존재 기간을 지정 (초)
ini_set("session.gc_probability", 1); // session.gc_probability는 session.gc_divisor와 연계하여 gc(쓰레기 수거) 루틴의 시작 확률을 관리합니다. 기본값은 1입니다. 자세한 내용은 session.gc_divisor를 참고하십시오.
ini_set("session.gc_divisor", 100); // session.gc_divisor는 session.gc_probability와 결합하여 각 세션 초기화 시에 gc(쓰레기 수거) 프로세스를 시작할 확률을 정의합니다. 확률은 gc_probability/gc_divisor를 사용하여 계산합니다. 즉, 1/100은 각 요청시에 GC 프로세스를 시작할 확률이 1%입니다. session.gc_divisor의 기본값은 100입니다.

session_set_cookie_params(0, '/');
ini_set("session.cookie_domain", G5_COOKIE_DOMAIN);

@session_start();
//==============================================================================


//==============================================================================
// 공용 변수
//------------------------------------------------------------------------------
// 기본환경설정
// 기본적으로 사용하는 필드만 얻은 후 상황에 따라 필드를 추가로 얻음
$config = sql_fetch(" select * from {$g5['config_table']} ");

define('G5_HTTP_BBS_URL',  https_url(G5_BBS_DIR, false));
define('G5_HTTPS_BBS_URL', https_url(G5_BBS_DIR, true));
if ($config['cf_editor'])
    define('G5_EDITOR_LIB', G5_EDITOR_PATH."/{$config['cf_editor']}/editor.lib.php");
else
    define('G5_EDITOR_LIB', G5_LIB_PATH."/editor.lib.php");

// 4.00.03 : [보안관련] PHPSESSID 가 틀리면 로그아웃한다.
if (isset($_REQUEST['PHPSESSID']) && $_REQUEST['PHPSESSID'] != session_id())
    goto_url(G5_BBS_URL.'/logout.php');

// QUERY_STRING
$qstr = '';

if (isset($_REQUEST['sca']))  {
    $sca = clean_xss_tags(trim($_REQUEST['sca']));
    if ($sca) {
        $sca = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)]/", "", $sca);
        $qstr .= '&amp;sca=' . urlencode($sca);
    }
} else {
    $sca = '';
}

if (isset($_REQUEST['sfl']))  {
    $sfl = trim($_REQUEST['sfl']);
    $sfl = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $sfl);
    if ($sfl)
        $qstr .= '&amp;sfl=' . urlencode($sfl); // search field (검색 필드)
} else {
    $sfl = '';
}


if (isset($_REQUEST['stx']))  { // search text (검색어)
    $stx = get_search_string(trim($_REQUEST['stx']));
    if ($stx)
        $qstr .= '&amp;stx=' . urlencode(cut_str($stx, 20, ''));
} else {
    $stx = '';
}

if (isset($_REQUEST['sst']))  {
    $sst = trim($_REQUEST['sst']);
    $sst = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\s]/", "", $sst);
    if ($sst)
        $qstr .= '&amp;sst=' . urlencode($sst); // search sort (검색 정렬 필드)
} else {
    $sst = '';
}

if (isset($_REQUEST['sod']))  { // search order (검색 오름, 내림차순)
    $sod = preg_match("/^(asc|desc)$/i", $sod) ? $sod : '';
    if ($sod)
        $qstr .= '&amp;sod=' . urlencode($sod);
} else {
    $sod = '';
}

if (isset($_REQUEST['sop']))  { // search operator (검색 or, and 오퍼레이터)
    $sop = preg_match("/^(or|and)$/i", $sop) ? $sop : '';
    if ($sop)
        $qstr .= '&amp;sop=' . urlencode($sop);
} else {
    $sop = '';
}

if (isset($_REQUEST['spt']))  { // search part (검색 파트[구간])
    $spt = (int)$spt;
    if ($spt)
        $qstr .= '&amp;spt=' . urlencode($spt);
} else {
    $spt = '';
}

if (isset($_REQUEST['page'])) { // 리스트 페이지
    $page = (int)$_REQUEST['page'];
    if ($page)
        $qstr .= '&amp;page=' . urlencode($page);
} else {
    $page = '';
}

if (isset($_REQUEST['w'])) {
    $w = substr($w, 0, 2);
} else {
    $w = '';
}

if (isset($_REQUEST['wr_id'])) {
    $wr_id = (int)$_REQUEST['wr_id'];
} else {
    $wr_id = 0;
}

if (isset($_REQUEST['bo_table'])) {
    $bo_table = preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['bo_table']));
    $bo_table = substr($bo_table, 0, 20);
} else {
    $bo_table = '';
}

// URL ENCODING
if (isset($_REQUEST['url'])) {
    $url = strip_tags(trim($_REQUEST['url']));
    $urlencode = urlencode($url);
} else {
    $url = '';
    $urlencode = urlencode($_SERVER['REQUEST_URI']);
    if (G5_DOMAIN) {
        $p = @parse_url(G5_DOMAIN);
        $urlencode = G5_DOMAIN.urldecode(preg_replace("/^".urlencode($p['path'])."/", "", $urlencode));
    }
}

if (isset($_REQUEST['gr_id'])) {
    if (!is_array($_REQUEST['gr_id'])) {
        $gr_id = preg_replace('/[^a-z0-9_]/i', '', trim($_REQUEST['gr_id']));
    }
} else {
    $gr_id = '';
}
//===================================

// 자동로그인
if ($app_mb_id != "") {
    $mb = get_member($app_mb_id, 'mb_id, mb_datetime');
    if ($mb) {
        // 회원아이디 세션 생성
        set_session('ss_mb_id', $mb['mb_id']);
        // FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
        set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
    }
}

// 자동로그인 부분에서 첫로그인에 포인트 부여하던것을 로그인중일때로 변경하면서 코드도 대폭 수정하였습니다.
if ($_SESSION['ss_mb_id']) { // 로그인중이라면
    $member = get_member($_SESSION['ss_mb_id']);

    // 차단된 회원이면 ss_mb_id 초기화
    if($member['mb_intercept_date'] && $member['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
        set_session('ss_mb_id', '');
        $member = array();
    } else {
        // 오늘 처음 로그인 이라면
        if (substr($member['mb_today_login'], 0, 10) != G5_TIME_YMD) {
            // ==마지막 접속일로부터 90일 지나면 보너스 포인트 삭제
            if($member['mb_bunker_bonus'] != 0) {
                $timestamp = strtotime(substr($member['mb_today_login'], 0, 10) . " +90 days");
                $expire_date = date('Y-m-d', $timestamp);

                if($expire_date < G5_TIME_YMD) { // 90일 초과
                    sql_query(" update g5_member set mb_bunker_bonus = 0 where mb_id = '{$member['mb_id']}' ");
                    sql_query(" insert into g5_bunker_history set mb_id = '{$member['mb_id']}', mode = '차감', bunker = '{$member['mb_bunker_bonus']}', bonus_remain = 0, contents = '보너스 벙커 유효기간 만료', wr_datetime = '".G5_TIME_YMDHIS."', etc = 'bonus' ");
                }
            }
            // ==//마지막 접속일로부터 90일 지나면 보너스 포인트 삭제

            // 첫 로그인 포인트 지급
            insert_point($member['mb_id'], $config['cf_login_point'], G5_TIME_YMD.' 첫로그인', '@login', $member['mb_id'], G5_TIME_YMD);

            // 오늘의 로그인이 될 수도 있으며 마지막 로그인일 수도 있음
            // 해당 회원의 접근일시와 IP 를 저장
            $sql = " update {$g5['member_table']} set mb_today_login = '".G5_TIME_YMDHIS."', mb_login_ip = '{$_SERVER['REMOTE_ADDR']}' where mb_id = '{$member['mb_id']}' ";
            sql_query($sql);
        }
    }
} else {
    // 자동로그인 ---------------------------------------
    // 회원아이디가 쿠키에 저장되어 있다면 (3.27)
    if ($tmp_mb_id = get_cookie('ck_mb_id')) {

        //$tmp_mb_id = substr(preg_replace("/[^a-zA-Z0-9_]*/", "", $tmp_mb_id), 0, 20);
        // 최고관리자는 자동로그인 금지
        if (strtolower($tmp_mb_id) != strtolower($config['cf_admin'])) {
            $sql = " select mb_password, mb_intercept_date, mb_leave_date, mb_email_certify from {$g5['member_table']} where mb_id = '{$tmp_mb_id}' ";
            $row = sql_fetch($sql);

            //$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $row['mb_password']);
			$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $row['mb_password']);

            // 쿠키에 저장된 키와 같다면
            $tmp_key = get_cookie('ck_auto');
            if ($tmp_key == $key && $tmp_key) {
                // 차단, 탈퇴가 아니고 메일인증이 사용이면서 인증을 받았다면
                if ($row['mb_intercept_date'] == '' &&
                    $row['mb_leave_date'] == '' &&
                    (!$config['cf_use_email_certify'] || preg_match('/[1-9]/', $row['mb_email_certify'])) ) {
                    // 세션에 회원아이디를 저장하여 로그인으로 간주
                    set_session('ss_mb_id', $tmp_mb_id);

                    // ==마지막 접속일로부터 90일 지나면 보너스 포인트 삭제
                    $member = get_member($_SESSION['ss_mb_id']);
                    if (substr($member['mb_today_login'], 0, 10) != G5_TIME_YMD && $member['mb_bunker_bonus'] != 0) {
                        $timestamp = strtotime(substr($member['mb_today_login'], 0, 10) . " +90 days");
                        $expire_date = date('Y-m-d', $timestamp);

                        if($expire_date < G5_TIME_YMD) { // 90일 초과
                            sql_query(" update g5_member set mb_bunker_bonus = 0 where mb_id = '{$member['mb_id']}' ");
                            sql_query(" insert into g5_bunker_history set mb_id = '{$member['mb_id']}', mode = '차감', bunker = '{$member['mb_bunker_bonus']}', bonus_remain = 0, contents = '보너스 벙커 유효기간 만료', wr_datetime = '".G5_TIME_YMDHIS."', etc = 'bonus' ");
                        }
                        // ==//마지막 접속일로부터 90일 지나면 보너스 포인트 삭제
                    }

                    // 페이지를 재실행
                    echo "<script type='text/javascript'> window.location.reload(); </script>";
                    exit;
                }
            }
            // $row 배열변수 해제
            unset($row);
        }
    }
    // 자동로그인 end ---------------------------------------
}


$write = array();
$write_table = "";
if ($bo_table) {
    $board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
    if ($board['bo_table']) {
        set_cookie("ck_bo_table", $board['bo_table'], 86400 * 1);
        $gr_id = $board['gr_id'];
        $write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
        //$comment_table = $g5['write_prefix'] . $bo_table . $g5['comment_suffix']; // 코멘트 테이블 전체이름
        if (isset($wr_id) && $wr_id)
            $write = sql_fetch(" select * from $write_table where wr_id = '$wr_id' ");
    }
}

if ($gr_id) {
    $group = sql_fetch(" select * from {$g5['group_table']} where gr_id = '$gr_id' ");
}


// 회원, 비회원 구분
$is_member = $is_guest = false;
$is_admin = '';
if ($member['mb_id']) {
    $is_member = true;
    $is_admin = is_admin($member['mb_id']);
    $member['mb_dir'] = substr($member['mb_id'],0,2);
} else {
    $is_guest = true;
    $member['mb_id'] = '';
    $member['mb_level'] = 1; // 비회원의 경우 회원레벨을 가장 낮게 설정
}


if ($is_admin != 'super') {
    // 접근가능 IP
    $cf_possible_ip = trim($config['cf_possible_ip']);
    if ($cf_possible_ip) {
        $is_possible_ip = false;
        $pattern = explode("\n", $cf_possible_ip);
        for ($i=0; $i<count($pattern); $i++) {
            $pattern[$i] = trim($pattern[$i]);
            if (empty($pattern[$i]))
                continue;

            $pattern[$i] = str_replace(".", "\.", $pattern[$i]);
            $pattern[$i] = str_replace("+", "[0-9\.]+", $pattern[$i]);
            $pat = "/^{$pattern[$i]}$/";
            $is_possible_ip = preg_match($pat, $_SERVER['REMOTE_ADDR']);
            if ($is_possible_ip)
                break;
        }
        if (!$is_possible_ip)
            die ("접근이 가능하지 않습니다.");
    }

    // 접근차단 IP
    $is_intercept_ip = false;
    $pattern = explode("\n", trim($config['cf_intercept_ip']));
    for ($i=0; $i<count($pattern); $i++) {
        $pattern[$i] = trim($pattern[$i]);
        if (empty($pattern[$i]))
            continue;

        $pattern[$i] = str_replace(".", "\.", $pattern[$i]);
        $pattern[$i] = str_replace("+", "[0-9\.]+", $pattern[$i]);
        $pat = "/^{$pattern[$i]}$/";
        $is_intercept_ip = preg_match($pat, $_SERVER['REMOTE_ADDR']);
        if ($is_intercept_ip)
            die ("접근 불가합니다.");
    }
}


// 테마경로
if(defined('_THEME_PREVIEW_') && _THEME_PREVIEW_ === true)
    $config['cf_theme'] = trim($_GET['theme']);

if(isset($config['cf_theme']) && trim($config['cf_theme'])) {
    $theme_path = G5_PATH.'/'.G5_THEME_DIR.'/'.$config['cf_theme'];
    if(is_dir($theme_path)) {
        define('G5_THEME_PATH',        $theme_path);
        define('G5_THEME_URL',         G5_URL.'/'.G5_THEME_DIR.'/'.$config['cf_theme']);
        define('G5_THEME_MOBILE_PATH', $theme_path.'/'.G5_MOBILE_DIR);
        define('G5_THEME_LIB_PATH',    $theme_path.'/'.G5_LIB_DIR);
        define('G5_THEME_CSS_URL',     G5_THEME_URL.'/'.G5_CSS_DIR);
        define('G5_THEME_IMG_URL',     G5_THEME_URL.'/'.G5_IMG_DIR);
        define('G5_THEME_JS_URL',      G5_THEME_URL.'/'.G5_JS_DIR);
    }
    unset($theme_path);
}


// 테마 설정 로드
if(is_file(G5_THEME_PATH.'/theme.config.php'))
    include_once(G5_THEME_PATH.'/theme.config.php');

//=====================================================================================
// 사용기기 설정
// 테마의 G5_THEME_DEVICE 설정에 따라 사용자 화면 제한됨
// 테마에 별도 설정이 없는 경우 config.php G5_SET_DEVICE 설정에 따라 사용자 화면 제한됨
// pc 설정 시 모바일 기기에서도 PC화면 보여짐
// mobile 설정 시 PC에서도 모바일화면 보여짐
// both 설정 시 접속 기기에 따른 화면 보여짐
//-------------------------------------------------------------------------------------
$is_mobile = false;
$set_device = true;

if(defined('G5_THEME_DEVICE') && G5_THEME_DEVICE != '') {
    switch(G5_THEME_DEVICE) {
        case 'pc':
            $is_mobile  = false;
            $set_device = false;
            break;
        case 'mobile':
            $is_mobile  = true;
            $set_device = false;
            break;
        default:
            break;
    }
}

if(defined('G5_SET_DEVICE') && $set_device) {
    switch(G5_SET_DEVICE) {
        case 'pc':
            $is_mobile  = false;
            $set_device = false;
            break;
        case 'mobile':
            $is_mobile  = true;
            $set_device = false;
            break;
        default:
            break;
    }
}
//==============================================================================

//==============================================================================
// Mobile 모바일 설정
// 쿠키에 저장된 값이 모바일이라면 브라우저 상관없이 모바일로 실행
// 그렇지 않다면 브라우저의 HTTP_USER_AGENT 에 따라 모바일 결정
// G5_MOBILE_AGENT : config.php 에서 선언
//------------------------------------------------------------------------------
if (G5_USE_MOBILE && $set_device) {
    if ($_REQUEST['device']=='pc')
        $is_mobile = false;
    else if ($_REQUEST['device']=='mobile')
        $is_mobile = true;
    else if (isset($_SESSION['ss_is_mobile']))
        $is_mobile = $_SESSION['ss_is_mobile'];
    else if (is_mobile())
        $is_mobile = true;
} else {
    $set_device = false;
}

$_SESSION['ss_is_mobile'] = $is_mobile;
define('G5_IS_MOBILE', $is_mobile);
define('G5_DEVICE_BUTTON_DISPLAY', $set_device);
if (G5_IS_MOBILE) {
    $g5['mobile_path'] = G5_PATH.'/'.$g5['mobile_dir'];
}
//==============================================================================


//==============================================================================
// 스킨경로
//------------------------------------------------------------------------------
if (G5_IS_MOBILE) {
    $board_skin_path    = get_skin_path('board', $board['bo_mobile_skin']);
    $board_skin_url     = get_skin_url('board', $board['bo_mobile_skin']);
    $member_skin_path   = get_skin_path('member', $config['cf_mobile_member_skin']);
    $member_skin_url    = get_skin_url('member', $config['cf_mobile_member_skin']);
    $new_skin_path      = get_skin_path('new', $config['cf_mobile_new_skin']);
    $new_skin_url       = get_skin_url('new', $config['cf_mobile_new_skin']);
    $search_skin_path   = get_skin_path('search', $config['cf_mobile_search_skin']);
    $search_skin_url    = get_skin_url('search', $config['cf_mobile_search_skin']);
    $connect_skin_path  = get_skin_path('connect', $config['cf_mobile_connect_skin']);
    $connect_skin_url   = get_skin_url('connect', $config['cf_mobile_connect_skin']);
    $faq_skin_path      = get_skin_path('faq', $config['cf_mobile_faq_skin']);
    $faq_skin_url       = get_skin_url('faq', $config['cf_mobile_faq_skin']);
} else {
    $board_skin_path    = get_skin_path('board', $board['bo_skin']);
    $board_skin_url     = get_skin_url('board', $board['bo_skin']);
    $member_skin_path   = get_skin_path('member', $config['cf_member_skin']);
    $member_skin_url    = get_skin_url('member', $config['cf_member_skin']);
    $new_skin_path      = get_skin_path('new', $config['cf_new_skin']);
    $new_skin_url       = get_skin_url('new', $config['cf_new_skin']);
    $search_skin_path   = get_skin_path('search', $config['cf_search_skin']);
    $search_skin_url    = get_skin_url('search', $config['cf_search_skin']);
    $connect_skin_path  = get_skin_path('connect', $config['cf_connect_skin']);
    $connect_skin_url   = get_skin_url('connect', $config['cf_connect_skin']);
    $faq_skin_path      = get_skin_path('faq', $config['cf_faq_skin']);
    $faq_skin_url       = get_skin_url('faq', $config['cf_faq_skin']);
}
//==============================================================================

//==============================================================================
// 포도씨
//------------------------------------------------------------------------------
define('G5_CSS_VER', 0.19);
define('G5_JS_VER', 0.43);

// 방문자수의 접속을 남김
//include_once(G5_BBS_PATH.'/visit_insert.inc.php');


// 일정 기간이 지난 DB 데이터 삭제 및 최적화
include_once(G5_BBS_PATH.'/db_table.optimize.php');


// common.php 파일을 수정할 필요가 없도록 확장합니다.
$extend_file = array();
$tmp = dir(G5_EXTEND_PATH);
while ($entry = $tmp->read()) {
    // php 파일만 include 함
    if (preg_match("/(\.php)$/i", $entry))
        $extend_file[] = $entry;
}

if(!empty($extend_file) && is_array($extend_file)) {
    natsort($extend_file);

    foreach($extend_file as $file) {
        include_once(G5_EXTEND_PATH.'/'.$file);
    }
}
unset($extend_file);

ob_start();

// 자바스크립트에서 go(-1) 함수를 쓰면 폼값이 사라질때 해당 폼의 상단에 사용하면
// 캐쉬의 내용을 가져옴. 완전한지는 검증되지 않음
header('Content-Type: text/html; charset=utf-8');
$gmnow = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: 0'); // rfc2616 - Section 14.21
header('Last-Modified: ' . $gmnow);
header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0

$html_process = new html_process();

//ip 본인의 아이피
$ip       = $_SERVER['REMOTE_ADDR'];

// 일반회원 비즈니스 활동 분야
$business_active_list = array(
	1 => '대학생, 취업준비생',
	2 => '조선소',
	3 => '플랜트, 오프쇼어',
	4 => '해운, 항만, 물류',
	5 => '선주, 선사',
	6 => '선급, 유관기관 및 단체',
	7 => '해기사 (항해, 기관)',
	8 => '조선 해양 기자재',
	9 => '선박관리, 선박수리',
	10 => '수산 (Fishery)',
	11 => '요트, 해양 레저',
	12 => '선용품',
	13 => '기타 관련 업체'
);

// 기업회원 상세업종
$company_sectors = array(
    1 => '조선소',
    2 => '플랜트, 오프쇼어',
    3 => '해운, 항만, 물류',
    4 => '선주, 선사',
    5 => '선급, 유관기관 및 단체',
    6 => '조선 해양 기자재',
    7 => '선박관리, 선박수리',
    8 => '수산 (Fishery)',
    9 => '요트, 해양 레저',
    10 => '선용품',
    11 => '기타 관련 업체'
);

// 일반회원등급, 기업회원은 (Baisc, Premium)
$member_grade = array(
    1 => '실습항해사',
    2 => '3등항해사',
    3 => '2등항해사',
    4 => '1등항해사',
    5 => '선장',
    6 => 'Basic',
    7 => 'Premium',
);

// 헬프미 카테고리
$helpme_category = array(
    1 => '전체',
    2 => '선박 운항, 항해',
    3 => '선박 기관, 정비',
    4 => '조선',
    5 => '플랜트',
    6 => '수산',
    7 => '해운',
    8 => '항만,물류',
    9 => '기타',
    10 => '고민 Q&A'
);

// 기업의뢰 BUDGET
$company_budget = array(
1 => 'less than $3,000',
2 => '$3,000 ~ $10,000',
3 => '$10,000 ~ $50,000',
4 => '$50,000 ~ $100,000',
5 => '$100,000 ~ $500,000',
6 => '$500,000 ~ $1million',
7 => 'more than $1million'
);

// 채용공고 연봉
$recruit_salary = array(
1 => '회사내규에 따름',
2 => '2,000만원 이하',
3 => '2,000~2,200만원',
4 => '2,200~2,400만원',
5 => '2,400~2,600만원',
6 => '2,600~2,800만원',
7 => '2,800~3,000만원',
8 => '3,000~3,200만원',
9 => '3,200~3,400만원',
10 => '3,400~3,600만원',
11 => '3,600~3,800만원',
12 => '3,800~4,000만원',
13 => '4,000~5,000만원',
14 => '5,000~6,000만원',
15 => '6,000~7,000만원',
16 => '7,000~8,000만원',
17 => '8,000~9,000만원',
18 => '9,000~1억원',
19 => '1억원 이상',
20 => '면접후 결정'
);

// 은행 정보
$bank_list = array('001'=>'한국은행', '002'=>'산업은행', '003'=>'기업은행', '004'=>'국민은행', '005'=>'외환은행', '007'=>'수협중앙회', '008'=>'수출입은행', '011'=>'농협은행', '012'=>'지역농∙축협',
                   '020'=>'우리은행', '023'=>'SC은행', '027'=>'한국씨티은행', '031'=>'대구은행', '032'=>'부산은행', '034'=>'광주은행', '035'=>'제주은행', '037'=>'전북은행', '039'=>'경남은행',
                   '045'=>'새마을금고중앙회', '048'=>'신협중앙회', '050'=>'상호저축은행', '052'=>'모건스탠리은행', '054'=>'HSBC은행', '055'=>'도이치은행', '056'=>'알비에스피엘씨은행',
                   '057'=>'제이피모간체이스은행', '058'=>'미즈호은행', '059'=>'미쓰비시도쿄UFJ은행', '060'=>'BOA은행', '061'=>'비엔피파리바은행', '062'=>'중국공상은행', '063'=>'중국은행',
                   '064'=>'산림조합중앙회', '065'=>'대화은행', '071'=>'우체국', '076'=>'신용보증기금', '077'=>'기술보증기금', '081'=>'하나은행', '088'=>'신한은행', '089'=>'케이뱅크',
                   '090'=>'카카오뱅크', '093'=>'한국주택금융공사', '094'=>'서울보증보험', '095'=>'경찰청', '096'=>'한국전자금융㈜', '099'=>'금융결제원', '209'=>'유안타증권', '218'=>'현대증권',
                   '230'=>'미래에셋증권', '238'=>'대우증권', '240'=>'삼성증권', '243'=>'한국투자증권', '247'=>'우리투자증권', '261'=>'교보증권', '262'=>'하이투자증권', '263'=>'HMC투자증권',
                   '264'=>'키움증권', '265'=>'이베스트투자증권', '266'=>'SK증권', '267'=>'대신증권', '268'=>'아이엠투자증권', '269'=>'한화투자증권', '270'=>'하나대투증권', '278'=>'신한금융투자',
                   '279'=>'동부증권', '280'=>'유진투자증권', '287'=>'메리츠종합금융증권', '290'=>'부국증권', '291'=>'신영증권', '292'=>'LIG투자증권');

// 업체에 오픈하지 않고 내부적으로 작업 시
$private = false;
if($ip == '183.103.22.103' || $ip == '124.54.11.180' || $ip == '121.140.204.65') { $private = true; }

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$aos_app_user_agent = "APodosea"; // AOD USER AGENT
$android = false;
$mobile = false;
if(strpos($user_agent, $aos_app_user_agent) !== false) { // 안드로이드 접속 시
    $android = true;
    $mobile = true;
}
else if(strpos(strtolower($user_agent), 'mobile') !== false) { // 모바일 접속 시 (앱/모바일 웹)
    $mobile = true;
}

// 인앱체크 및 자동로그인
$is_inapp = false;
$inapp_vercode = 0;
if(strpos($user_agent, $aos_app_user_agent) !== false) {
    $is_inapp = true;
    // 앱버전확인
    $_tmp = explode("/APP_VER=", $_SERVER['HTTP_USER_AGENT']);
    $inapp_vercode = (int)$_tmp[1];
}

// 기업 리뷰 항목
$company_review = array(
1 => '의뢰 내용을 정확히 준수하였습니다.',
2 => '업무 대응이 신속합니다.',
3 => '전문성을 갖추고 있습니다.',
4 => '제품 또는 서비스의 품질이 우수합니다.',
5 => '기타',
);

// 신고 사유
$report = array(
1 => '비매너 사용자',
2 => '답변 채택 or 거래 분쟁',
3 => '광고성, 도배성 글',
4 => '거짓 프로필 or 기업 정보 게시',
5 => '기타(직접 입력)',
);

// 카카오 로그인 JavaScript 키 (내 애플리케이션 > 앱 설정 > 앱 키)
$kakao_javascript_key = '8249829aab1c20472d703a8b9f393c8f';
$kakao_javascript_key_new = '74a469d96146fad0c7d923d621b76157'; // 카카오디벨로퍼 계정 찾지 못하여 새로 등록

// 페이스북 로그인 앱 ID
$face_app_id = "1033759944015972";

// 이노페이 실결제
if($private) {
    $MID = 'testpay01m';
    $MerchantKey = 'Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg==';
}
else {
    $MID = 'pgvineplam';
    $MerchantKey = 'gOAqi14M/18OCX/llwzBJmRrqMzcI1flqjF25wtAvUwFCDy1yfyTeNzCNjHdYKZzP6Gxclw/eSPGO/BX4JN/3w==';
}
define("IPAY_SUCCESS_CODE", [3001, 4000, 4100]); // 이노페이 결제완료 코드 (3001:카드결제/간편결제성공, 4000:계좌이체성공, 4110:가상계좌발급성공)

// 프로필 업데이트 경로
if($member['mb_level'] == 2) {
    $profile_url = G5_BBS_URL.'/profile_update01.php';
} else if($member['mb_level'] == 3) {
    $profile_url = G5_BBS_URL.'/profile_company_update01.php';
}

// 자료실 접근 가능 계정 (테스트용)
$reference_test = false;
if($private || $member['mb_id'] == 'admin' || $member['mb_id'] == 'test01' || $member['mb_id'] == 'com01' || $member['mb_id'] == 'drongo147' || $member['mb_id'] == 'vineplant' || $member['mb_id'] == 'testcompany' || $member['mb_id'] == 'podosea1' || $member['mb_id'] == 'podosea2' || $member['mb_id'] == 'podosea3' || $member['mb_id'] == 'podosea4' || $member['mb_id'] == 'podosea5') {
    $reference_test = true;
}

// 자료실 판매자인지 확인
$seller = false;
if($member['seller'] == 'Y') $seller = true;

// 자료실 카테고리
$refer_category = array(0=>'양식/서식', 1=>'비즈니스(산업)', 2=>'보고서/회의', 3=>'노하우', 4=>'리포트/논문', 5=>'기타');
$refer_sub_category0 = array(0=>'양식', 1=>'서식');
$refer_sub_category1 = array(0=>'해운', 1=>'조선', 2=>'선박수리');
$refer_sub_category2 = array(0=>'보고서', 1=>'회의');
$refer_sub_category3 = array();
$refer_sub_category4 = array(0=>'리포트', 1=>'논문', 2=>'결과자료');
$refer_sub_category5 = array(0=>'법률', 1=>'행정', 2=>'취미');

// // 22.12.06 기업검색 메뉴 및 기업회원 접근불가
// if($reference_test) {
//     $now_page = $_SERVER['PHP_SELF'];
//     if($is_member && $member['mb_level'] == 3 && strpos($now_page, 'logout.php') == 0) {
//         alert("잘못된 접근입니다.", G5_BBS_URL.'/logout.php', true);
//     }
// }

//SSL 리다이렉트
if(!isset($_SERVER["HTTPS"])) {header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'],true,301);}
//SSL 리다이렉트 끝


?>

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

    sql_set_charset('utf8', $connect_db);
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

//ini_set("session.cache_expire", 180); // 세션 캐쉬 보관시간 (분)
//ini_set("session.gc_maxlifetime", 10800); // session data의 garbage collection 존재 기간을 지정 (초)
// 20200910 1440,86400 수정
ini_set("session.cache_expire", 1440); // 세션 캐쉬 보관시간 (분)
ini_set("session.gc_maxlifetime", 86400); // session data의 garbage collection 존재 기간을 지정 (초)

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

// qstr 추가 (티대리)
if (isset($_REQUEST['map_si']))  { // 시
    $map_si = get_search_string(trim($_REQUEST['map_si']));
    if ($map_si)
        $qstr .= '&amp;map_si=' . urlencode(cut_str($map_si, 30, ''));
} else {
    $map_si = '';
}
if (isset($_REQUEST['map_gu']))  { // 구
    $map_gu = get_search_string(trim($_REQUEST['map_gu']));
    if ($map_gu)
        $qstr .= '&amp;map_gu=' . urlencode(cut_str($map_gu, 30, ''));
} else {
    $map_gu = '';
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

$app_auto_login = false;
$app_auto_login_id = "";

// 앱자동로그인추가 (AOS)
if ($_REQUEST['app_mb_id'] != "") {
    $app_auto_login = true;
    $app_auto_login_id = $_REQUEST['app_mb_id'];
}
// 앱자동로그인추가 (IOS)
if (strpos($_SERVER['HTTP_USER_AGENT'], "IOS_APP") !== false && get_cookie('ck_mb_id') != "" && $_SESSION['ss_mb_id'] == "") {
    $app_auto_login = true;
    $app_auto_login_id = get_cookie('ck_mb_id');
}
if ($app_auto_login) {
    $mb = get_member($app_auto_login_id, 'mb_id, mb_datetime, agency_no');
    if ($mb) {
        // 회원아이디 세션 생성
        set_session('ss_mb_id', $mb['mb_id']);
        // FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
        set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

        setAgencySession($mb['agency_no']);
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
                    $row['mb_leave_date'] == '' ) {
                    // 세션에 회원아이디를 저장하여 로그인으로 간주
                    set_session('ss_mb_id', $tmp_mb_id);

                    // 페이지를 재실행
                    echo "<script type='text/javascript'> window.location.reload(); </script>";
                    exit;
                }
                /*
                if ($row['mb_intercept_date'] == '' &&
                    $row['mb_leave_date'] == '' &&
                    (!$config['cf_use_email_certify'] || preg_match('/[1-9]/', $row['mb_email_certify'])) ) {
                    // 세션에 회원아이디를 저장하여 로그인으로 간주
                    set_session('ss_mb_id', $tmp_mb_id);

                    // 페이지를 재실행
                    echo "<script type='text/javascript'> window.location.reload(); </script>";
                    exit;
                }*/
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


/*******************************************************************************
티대리 분양플랫폼
*******************************************************************************/
define('G5_CSS_VER', "1.35");
define('G5_JS_VER', "1.58");

// 회원 전체등급
$tdr_member = array("0"=>"탈퇴회원", "1"=>"기사대기", "2"=>"고객", "3"=>"타기사", "4"=>"자기사", "5"=>"자기사(콜)", "9"=>"대리점", "10"=>"최고관리자");

// 회원등급 중 기사만
$driver_list = array("1"=>"기사대기", "3"=>"타기사", "4"=>"자기사", "5"=>"자기사(콜)");

// 기사유형
$driver_call_type = array("0"=>"탁송", "1"=>"대리", "2"=>"탁송+대리");

// 대리콜, 탁송콜 클래스
$calltype_class = array("0"=>"dae", "1"=>"tak");
$calltype_name = array("0"=>"탁송콜", "1"=>"대리콜","2"=>"퀵");
// 콜상태
$callstt_name = array("0"=>"신청", "R"=>"접수", "1"=>"진행중", "2"=>"진행완료", "-1"=>"취소");
// 콜종류?
$callkind_name = array("0"=>"빠른콜", "1"=>"환급콜", "2"=>"적립콜", "3"=>"가장빠른콜"); // 콜무(가장빠른콜)
// 콜결제
$callpay_name = array("P"=>"포인트", "C"=>"현금", "CD"=>"카드결제");


// 앱 구분
$app_user_agent = "TDAERI";
$is_inapp = false;
$aos_ver = 1;
if (strpos($_SERVER['HTTP_USER_AGENT'], $app_user_agent) !== false) {
	$is_inapp = true;
    // AOS 앱버전확인
    $_tmp = explode("TDAERI/APP_VER=", $_SERVER['HTTP_USER_AGENT']);
    if ((int)$_tmp[1] > 0) $aos_ver = (int)$_tmp[1];
}

//echo "쿠키:".get_cookie('cc_cur_lat');
// 1) 현재위치 초기값
$cur_lat = (empty(get_cookie('cc_cur_lat')))? 35.1795596 : get_cookie('cc_cur_lat');
$cur_lng =  (empty(get_cookie('cc_cur_lng')))? 129.0741443 : get_cookie('cc_cur_lng');
// 2) 앱에서 위치 받음
if ($_GET['cur_lat'] != "" && $_GET['cur_lat'] != $cur_lat) $cur_lat = $_GET['cur_lat'];
if ($_GET['cur_lng'] != "" && $_GET['cur_lng'] != $cur_lng) $cur_lng = $_GET['cur_lng'];
// 3) 쿠키저장
set_cookie('cc_cur_lat', $cur_lat, 86400 * 31 * 9999);
set_cookie('cc_cur_lng', $cur_lng, 86400 * 31 * 9999);

//if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") echo $cur_lat."/init:35.1795596";

$is_driver = false;
// 기사면 현재위치 저장
if ($is_member && array_key_exists($member['mb_level'], $driver_list)) {
    $is_driver = true;
    setMemberPos($member['mb_id'], $cur_lat, $cur_lng);
}

// 광역시
$si_list = array('서울', '부산', '대구', '인천', '광주', '대전', '울산', '세종', '경기', '강원', '충북', '충남', '전북', '전남', '경북', '경남', '제주');
$seoul_list = array('강남구', '강동구', '강북구', '강서구', '관악구', '광진구', '구로구', '금천구', '노원구', '도봉구', '동대문구', '동작구', '마포구', '서대문구', '서초구', '성동구', '성북구', '송파구', '양천구', '영등포구', '용산구', '은평구', '종로구', '중구', '중랑구');
$ic_list = array('강화군', '계양구', '남동구', '동구', '미추홀구', '부평구', '서구', '연수구', '옹진군', '중구');
$kg_list = array('가평군', '고양시', '과천시', '광명시', '광주시', '구리시', '군포시', '김포시', '남양주시', '대부도', '동두천시', '부천시', '성남시', '수원시', '시흥시', '안산시', '안성시', '안양시', '양주시', '양평군', '여주시', '연천군', '오산시', '용인시', '의왕시', '의정부시', '이천시', '파주시', '평택시', '포천시', '하남시', '화성시');

// 서울,경기,인천
$depth_local_list = array("서울", "인천", "경기");

// 포인트처리시 작업종류
$point_actions = array(
	"admin_save"=>"관리자 충전",
	"admin_use"=>"관리자 차감",
	"user_call"=>"고객 콜요청",
	"user_call_cancel"=>"고객 콜취소",
    "user_call_modify"=>"고객 콜요청 금액수정",
	"call_fin"=>"콜 완료",

	"call_fin_p_dv"=>"콜 완료(기사80%충전)",
	"call_fin_p_mb"=>"콜 완료(고객10%충전)",
	"call_fin_p_agc"=>"콜 완료(분양사10%충전)", // 분양사포인트 기능사라짐

	"call_fin_c_dv"=>"콜 완료(기사20%차감)",
	"call_fin_c_mb"=>"콜 완료(고객10%충전)",
	"call_fin_c_agc"=>"콜 완료(분양사10%충전)",

	"point_charge"=>"포인트 현금충전",
	"point_trans"=>"포인트 현금출금",

    "driv_accept"=>"콜 요청수락(기사20%차감)",
    "adm_save"=>"콜 요청수락(본사20%적립)",
    "driv_save"=>"콜 완료(본사적립)",
    "adm_support"=>"콜 완료(본사차감)",
    "cust_save"=>"콜 완료(적립콜)",
    "minus_call_mu"=>"콜무 고용보험, 원천징수 차감",

    "call_fin_cancel"=>"콜 완료 취소",
    "driv_accept_cancel"=>"콜 요청수락 취소",
    "driv_cancel"=>"콜 취소(본사적립)",
    "cust_cancel"=>"콜 취소(적립콜)",
    "call_mu_cancel"=>"콜 취소(콜무)",

    "auto_point_month"=>"포인트 자동차감/월",
    "auto_point_day"=>"포인트 자동차감/일",
);



// 이노페이PG정보
// 1) 지급대행 (송금요청)
define('INNO_ACC_MID', "butdrivinm");
define('INNO_ACC_KEY', "BJQTPtoda47ieFmZgux2SCUGgk9LXDBcWRMqa3Wd/D5vVtfpW4KbBfq61n0H3cZdOD9V/XC6eNsE06HOGuiBg==");
define('INNO_DEP_ACCNO', "66400000397893");
define('INNO_DEP_ACCNM', "고천수");
// 카드결제용 
define('INNO_PG_MID', "testpay01m");
define('INNO_PG_MerchantKey', "Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg==");
// 2) 가상계좌


// 서명 경로
define('G5_SIGN_PATH', G5_DATA_PATH."/sign");
define('G5_SIGN_URL', G5_DATA_URL."/sign");

// 승인안된 (회원)은 로그아웃처리
if ($is_member && (int)$member['mb_level'] < 9 && $member['mb_user_auth'] != "1") {
	$auth_msg = "";
	switch ($member['mb_user_auth']) {
		case "2" : $auth_msg = '관리자 승인이 되지 않은 회원입니다.';
		case "3" : $auth_msg = '해당 회원은 퇴사신청 처리중으로 로그인이 불가능합니다.';
		case "4" : $auth_msg = '퇴사완료된 아이디 입니다.';
	}

	session_unset();
	session_destroy();
	set_cookie('ck_mb_id', '', 0);
	set_cookie('ck_auto', '', 0);

	alert($auth_msg, G5_URL);
}

// 회원승인 (대리점승인과 별개임)
$user_auth_list = array("1"=>"승인완료", "2"=>"미승인", "3"=>"퇴사신청", "4"=>"퇴사승인");
// 기사출금계좌승인
$driver_acc_list = array("N"=>"대기", "Y"=>"승인완료");

$bank_list = array('001'=>'한국은행', '002'=>'산업은행', '003'=>'기업은행', '004'=>'국민은행', '005'=>'외환은행', '007'=>'수협중앙회', '008'=>'수출입은행', '011'=>'농협은행', '012'=>'지역농∙축협', '020'=>'우리은행', '023'=>'SC은행', '027'=>'한국씨티은행', '031'=>'대구은행', '032'=>'부산은행', '034'=>'광주은행', '035'=>'제주은행', '037'=>'전북은행', '039'=>'경남은행', '045'=>'새마을금고중앙회', '048'=>'신협중앙회', '050'=>'상호저축은행', '052'=>'모건스탠리은행', '054'=>'HSBC은행', '055'=>'도이치은행', '056'=>'알비에스피엘씨은행', '057'=>'제이피모간체이스은행', '058'=>'미즈호은행', '059'=>'미쓰비시도쿄UFJ은행', '060'=>'BOA은행', '061'=>'비엔피파리바은행', '062'=>'중국공상은행', '063'=>'중국은행', '064'=>'산림조합중앙회', '065'=>'대화은행', '071'=>'우체국', '076'=>'신용보증기금', '077'=>'기술보증기금', '081'=>'하나은행', '088'=>'신한은행', '089'=>'케이뱅크', '090'=>'카카오뱅크', '093'=>'한국주택금융공사', '094'=>'서울보증보험', '095'=>'경찰청', '096'=>'한국전자금융㈜', '099'=>'금융결제원', '209'=>'유안타증권', '218'=>'현대증권', '230'=>'미래에셋증권', '238'=>'대우증권', '240'=>'삼성증권', '243'=>'한국투자증권', '247'=>'우리투자증권', '261'=>'교보증권', '262'=>'하이투자증권', '263'=>'HMC투자증권', '264'=>'키움증권', '265'=>'이베스트투자증권', '266'=>'SK증권', '267'=>'대신증권', '268'=>'아이엠투자증권', '269'=>'한화투자증권', '270'=>'하나대투증권', '278'=>'신한금융투자', '279'=>'동부증권', '280'=>'유진투자증권', '287'=>'메리츠종합금융증권', '290'=>'부국증권', '291'=>'신영증권', '292'=>'LIG투자증권');

$innopay_method = array("01"=>"현금", "02"=>"신용카드수기", "03"=>"신용카드 ARS", "04"=>"신용카드 SMS 수기", "05"=>"신용카드 SMS 인증", "0108"=>"신용카드 인증", "0110"=>"신용카드 IC 결제", "06"=>"휴대폰", "07"=>"계좌이체", "08"=>"가상계좌", "09"=>"신용카드자동결제");

$innopay_namechk_result = array('0000'=>'정상 처리', '101'=>'1일 이체가능 건수초과', '106'=>'1종 사고계좌 (입지정지)', '107'=>'1종 사고계좌 (잔액증명 발급)', '108'=>'1 종 사고계좌 (적수변경 대상)', '109'=>'1 종 사고계좌 (파산)', '115'=>'2 종 사고계좌 (3 차 부도)', '116'=>'2 종 사고계좌 (거래해지등록)', '118'=>'2 종 사고계좌 (법적수속)', '119'=>'2 종 사고계좌 (압류사고)', '120'=>'2 종 사고계좌 (인감사고)', '121'=>'2 종 사고계좌 (지급정지)', '122'=>'2 종 사고계좌 (통장사고)', '140'=>'입금은행 가계당좌예금계정 거래불가', '141'=>'입금은행 기업자유예금계정 거래불가', '142'=>'입금은행 당좌예금계정 거래불가', '143'=>'입금은행 별단예정계정 거래불가', '144'=>'입금은행 보통예금계정 거래불가', '146'=>'입금은행 자유저축예금계정 거래불가', '148'=>'입금은행 저축예금계정 거래불가', '155'=>'거래금액오류', '171'=>'입금액이 입금한도액 초과', '186'=>'결제구분 오류', '193'=>'계좌번호 확인 (해지, 미등록)', '196'=>'계좌상태 오류', '197'=>'계좌번호 오류', '199'=>'계좌번호 오류 (검증번호)', '203'=>'계좌번호 오류', '247'=>'기타 오류', '248'=>'기타 오류', '257'=>'당일자 환율 미고시', '273'=>'기취소 거래 오류', '292'=>'수취인계좌 무통장입금건수 초과', '294'=>'미신청계좌', '304'=>'법적제한 계좌', '307'=>'복기부호 오류', '308'=>'복기부호 오류', '320'=>'통장비밀번호 불일치', '321'=>'비밀번호 오류', '322'=>'비밀번호 3 회 오류', '326'=>'1 종 사고계좌 (기타)', '329'=>'입금은행 업무장애', '330'=>'상대은행 코드 오류', '344'=>'수취인계좌 없음', '345'=>'수취인계좌 잔액증명서 발급계좌', '348'=>'수취인성명 오류', '362'=>'수취인계좌 입금한도 초과', '374'=>'비실명 계좌', '375'=>'실명번호 오류', '381'=>'업무마감처리불가', '389'=>'회원연체 상태', '424'=>'이관계좌', '432'=>'이자조회필 계좌, 계좌점에 문의요망', '435'=>'개시전문 수신전 상태', '436'=>'업무미개시', '442'=>'금액 오류 (금액 = 0)', '443'=>'이체금액 초과', '444'=>'이체일자 오류', '454'=>'입금거래가 불가능합니다', '458'=>'해당 계좌점 마감', '485'=>'입금계좌 오류', '492'=>'입금은행 장애', '493'=>'입금은행 코드틀림', '495'=>'입금인성명 오류 (특수문자)', '502'=>'자금이체 업무마감', '505'=>'지급금액이 지불가능금액 초과', '514'=>'전문코드/업무구분 오류', '519'=>'전문번호 중복', '522'=>'전자어음 관리번호 오류', '523'=>'전자어음번호 오류 (반드시 10 자리)', '544'=>'주민/사업자 번호 오류', '553'=>'해당 전문번호 없음', '555'=>'시스템 오류', '557'=>'기관서비스 종료', '574'=>'지급계좌 미등록상태', '575'=>'지급계좌 오류', '580'=>'연체상태, 지급거래 불가', '599'=>'처리일자 오류', '628'=>'취소불가 (기거래)', '662'=>'잡좌편입계좌', '663'=>'타행 전산시스템 장애', '666'=>'통장분실 재발행계좌', '669'=>'해약계좌', '696'=>'타행환 LOCK', '699'=>'타행환 미실시 은행', '710'=>'폐쇄점 계좌 거래불가', '716'=>'계좌번호 불일치', '730'=>'해당 업체코드 없음', '741'=>'입금은행 업무장애', '753'=>'해당지점 처리불가', '754'=>'해당회차 환율 미고시', '755'=>'해약계좌', '758'=>'해지,이관,잡좌,잡수입계좌', '771'=>'CENTER 계좌에 대한 거래불가', '806'=>'관련업무 아님', '823'=>'전산시스템 오류 (금액검증부호)', '851'=>'해당내용 없음', '858'=>'사업자번호 오류', '873'=>'약정중복신청(기신청)', '9979'=>'내부 서버오류', '9980'=>'내부 통신오류', '9981'=>'JSONData 값이 미입력 되었습니다.', '9985'=>'SECR_KEY 미입력', '9986'=>'REQ_DATA 값이 미입력 되었습니다.', '9987'=>'KEY 값이 올바르지 않습니다.', '9989'=>'허용된 아이피가 아닙니다.', '9990'=>'잘못된 제휴기관코드입니다.', '9993'=>'해당기관은 서비스 되지 않는 기관입니다.', '9994'=>'조회계좌은행코드 미입력 오류', '9995'=>'조회계좌은행코드 길이 오류 (3 자리)', '9998'=>'JSON 파싱오류', '9999'=>'내부 통신오류', 'GWS09993'=>'서비스 설정 값이 잘못되었습니다.', '801'=>'주민번호(6자리)/사업자번호(10자리) 길이 오류', '1014'=>'예금주명불일치(조회결과 예금주명 확인요망)');

//$innopay_namechk_result = array('0000'=>'정상처리', 'FFFF 예금주성명불일치', '1001'=>'가맹점번호미입력', '1002'=>'라이센스키미입력', '1003'=>'서비스종류미입력', '1004'=>'서비스종류오류', '1005'=>'은행코드미입력', '1006'=>'계좌번호미입력', '1007'=>'예금주명미입력', '1008'=>'은행코드입력오류', '1009'=>'미등록가맹점', '1010'=>'미사용가맹점', '1011'=>'해지가맹점', '1012'=>'가맹점인증실패', '1999'=>'서버통신오류', '2119'=>'입금계좌 압류상태이므로 입금불가', '2124'=>'가상계좌거래내역생성오류', '2134'=>'개설은행 업무종료', '2150'=>'거래불가능 시간입니다．', '2154'=>'거래금액 에러', '2155'=>'거래금액 오류', '2171'=>'거래한도액 오류', '2172'=>'거래할 수 없는 과목의 계좌입니다', '2192'=>'계좌에 관련정보 없음', '2196'=>'현계좌상태 오류입니다', '2197'=>'계좌오류', '2199'=>'계좌번호 체계 오류', '2202'=>'입금계좌번호가 일치하지 않습니다', '2203'=>'계좌번호오류', '2215'=>'과목코드오류', '2235'=>'기 통지전문', '2246'=>'기타수취불가（해당개설점연락）', '2247'=>'기타오류 입니다．', '2248'=>'기타이체 불능', '2249'=>'기타입출금 불가(계좌없음 or 가상계좌)', '2260'=>'당행 계좌번호 오류', '2281'=>'마감후 거래 불가함. ', '2297'=>'미참가 이용기관코드', '2304'=>'법적제한계좌', '2308'=>'복기부호 오류', '2330'=>'상대은행 코드 오류', '2344'=>'해당계좌없음', '2345'=>'수취인계좌 잔액증명서발부', '2362'=>'수취인계좌 입금한도 초과', '2381'=>'업무마감처리불가', '2415'=>'은행코드 오류입니다', '2435'=>'업무개시전문 수신전 입니다．', '2436'=>'타행환미개시', '2437'=>'이체 가능시간이 아직 안되었읍니다', '2441'=>'이체금액을 입력해주십시요', '2453'=>'일자오류 입니다．', '2457'=>'입금계좌번호가 일치하지 않습니다', '2460'=>'입금금액 확인하세요', '2473'=>'입금계좌가 거래제한된 상태입니다．', '2485'=>'입금계좌 오류', '2490'=>'입금계좌 해지상태임', '2492'=>'입금은행이 장애입니다', '2498'=>'입력항목 오류 입니다．', '2501'=>'자금이체 관련된 거래가 없읍니다', '2510'=>'한도금액 초과', '2555'=>'은행시스템에러', '2557'=>'해당기관 서비스종료', '2604'=>'총금액 상이', '2612'=>'출금계좌번호 오류입니다．', '2614'=>'출금계좌 미등록 상태임', '2678'=>'타행환 거래불가 계좌', '2704'=>'통장 계좌번호가 해약된 계좌임.', '2709'=>'특수조건 설정계좌임', '2713'=>'해당내용 없음', '2716'=>'해당계좌없음', '2733'=>'해당은행 개시이전', '2736'=>'해당은행에서 응답이 없습니다', '2741'=>'해당은행 장애', '2753'=>'해당지점 처리불가', '2755'=>'활동좌아님', '2758'=>'해지,이관,잡좌,잡수입계좌', '2831'=>'불입금 상이 (1회 불입 단위가 있는 계좌)');


// 기사 거리설정
$driver_distance = array(1=>"1km", 2=>"2km", 3=>"3km", 4=>"4km", 5=>"5km", 10=>"10km", 20=>"20km", 50=>"50km", 100=>"100km", 999=>"전체보이기");

// 문자박스
define("SMS_RECEIVE_NUM", "01091196888"); // 01091196888
define("SMS_SEND_NUM", "0518910088");



/********************************
대리점 세션없으면 intro로 이동
 ********************************/
$agency_chk_page = array("index.php", "map_search.php", "call.php", "board.php", "register.php", "register_form.php", "login.php");
$intro_page = G5_URL."/theme/basic/mobile/intro.php";

if ($is_admin || defined('G5_IS_ADMIN') || basename($_SERVER["PHP_SELF"]) == "all_round.php") {
    // pass
} else {
    // 대리점 선택세션 없으면 인트로 이동
    if (($_SESSION['myAgency'] == "" || $_SESSION['myAgency'] == "0") && (in_array(basename($_SERVER["PHP_SELF"]), $agency_chk_page)) ) {
        // 인트로에서 대리점 선택했을경우 세션설정
        if (isset($_REQUEST['myAgency'])) {
            setAgencySession($_REQUEST['myAgency']);
        } else {
            if(strpos($url, "adm") !== false || strpos($_SERVER["PHP_SELF"], "/test/") !== false) {
            } else {
                goto_url($intro_page);
            }
        }
    }
}

// 포인트 자동차감
define("AT_POINT_TYPE", [0=>"없음", 1=>"일 차감", 2=>"월 차감"]);

define("AT_POINT_MONTH", [0=>"없음", 1=>"월 차감"]); // 월
define("AT_POINT_DAY", [0=>"없음", 1=>"일 차감"]); // 일


$private = ($_SERVER['REMOTE_ADDR'] == "183.103.22.103");
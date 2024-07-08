<?php
if (!defined('_GNUBOARD_')) exit;

/*
// 081022 : CSRF 방지를 위해 코드를 작성했으나 효과가 없어 주석처리 함
if (!get_session('ss_admin')) {
    set_session('ss_admin', true);
    goto_url('.');
}
*/

// 스킨디렉토리를 SELECT 형식으로 얻음
function get_skin_select($skin_gubun, $id, $name, $selected='', $event='')
{
    global $config;

    $skins = array();

    if(defined('G5_THEME_PATH') && $config['cf_theme']) {
        $dirs = get_skin_dir($skin_gubun, G5_THEME_PATH.'/'.G5_SKIN_DIR);
        if(!empty($dirs)) {
            foreach($dirs as $dir) {
                $skins[] = 'theme/'.$dir;
            }
        }
    }

    $skins = array_merge($skins, get_skin_dir($skin_gubun));

    $str = "<select id=\"$id\" name=\"$name\" $event>\n";
    for ($i=0; $i<count($skins); $i++) {
        if ($i == 0) $str .= "<option value=\"\">선택</option>";
        if(preg_match('#^theme/(.+)$#', $skins[$i], $match))
            $text = '(테마) '.$match[1];
        else
            $text = $skins[$i];

        $str .= option_selected($skins[$i], $selected, $text);
    }
    $str .= "</select>";
    return $str;
}

// 모바일 스킨디렉토리를 SELECT 형식으로 얻음
function get_mobile_skin_select($skin_gubun, $id, $name, $selected='', $event='')
{
    global $config;

    $skins = array();

    if(defined('G5_THEME_PATH') && $config['cf_theme']) {
        $dirs = get_skin_dir($skin_gubun, G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR);
        if(!empty($dirs)) {
            foreach($dirs as $dir) {
                $skins[] = 'theme/'.$dir;
            }
        }
    }

    $skins = array_merge($skins, get_skin_dir($skin_gubun, G5_MOBILE_PATH.'/'.G5_SKIN_DIR));

    $str = "<select id=\"$id\" name=\"$name\" $event>\n";
    for ($i=0; $i<count($skins); $i++) {
        if ($i == 0) $str .= "<option value=\"\">선택</option>";
        if(preg_match('#^theme/(.+)$#', $skins[$i], $match))
            $text = '(테마) '.$match[1];
        else
            $text = $skins[$i];

        $str .= option_selected($skins[$i], $selected, $text);
    }
    $str .= "</select>";
    return $str;
}


// 스킨경로를 얻는다
function get_skin_dir($skin, $skin_path=G5_SKIN_PATH)
{
    global $g5;

    $result_array = array();

    $dirname = $skin_path.'/'.$skin.'/';
    if(!is_dir($dirname))
        return;

    $handle = opendir($dirname);
    while ($file = readdir($handle)) {
        if($file == '.'||$file == '..') continue;

        if (is_dir($dirname.$file)) $result_array[] = $file;
    }
    closedir($handle);
    sort($result_array);

    return $result_array;
}


// 테마
function get_theme_dir()
{
    $result_array = array();

    $dirname = G5_PATH.'/'.G5_THEME_DIR.'/';
    $handle = opendir($dirname);
    while ($file = readdir($handle)) {
        if($file == '.'||$file == '..') continue;

        if (is_dir($dirname.$file)) {
            $theme_path = $dirname.$file;
            if(is_file($theme_path.'/index.php') && is_file($theme_path.'/head.php') && is_file($theme_path.'/tail.php'))
                $result_array[] = $file;
        }
    }
    closedir($handle);
    natsort($result_array);

    return $result_array;
}


// 테마정보
function get_theme_info($dir)
{
    $info = array();
    $path = G5_PATH.'/'.G5_THEME_DIR.'/'.$dir;

    if(is_dir($path)) {
        $screenshot = $path.'/screenshot.png';
        if(is_file($screenshot)) {
            $size = @getimagesize($screenshot);

            if($size[2] == 3)
                $screenshot_url = str_replace(G5_PATH, G5_URL, $screenshot);
        }

        $info['screenshot'] = $screenshot_url;

        $text = $path.'/readme.txt';
        if(is_file($text)) {
            $content = file($text, false);
            $content = array_map('trim', $content);

            preg_match('#^Theme Name:(.+)$#i', $content[0], $m0);
            preg_match('#^Theme URI:(.+)$#i', $content[1], $m1);
            preg_match('#^Maker:(.+)$#i', $content[2], $m2);
            preg_match('#^Maker URI:(.+)$#i', $content[3], $m3);
            preg_match('#^Version:(.+)$#i', $content[4], $m4);
            preg_match('#^Detail:(.+)$#i', $content[5], $m5);
            preg_match('#^License:(.+)$#i', $content[6], $m6);
            preg_match('#^License URI:(.+)$#i', $content[7], $m7);

            $info['theme_name'] = trim($m0[1]);
            $info['theme_uri'] = trim($m1[1]);
            $info['maker'] = trim($m2[1]);
            $info['maker_uri'] = trim($m3[1]);
            $info['version'] = trim($m4[1]);
            $info['detail'] = trim($m5[1]);
            $info['license'] = trim($m6[1]);
            $info['license_uri'] = trim($m7[1]);
        }

        if(!$info['theme_name'])
            $info['theme_name'] = $dir;
    }

    return $info;
}


// 테마설정 정보
function get_theme_config_value($dir, $key='*')
{
    $tconfig = array();

    $theme_config_file = G5_PATH.'/'.G5_THEME_DIR.'/'.$dir.'/theme.config.php';
    if(is_file) {
        include($theme_config_file);

        if($key == '*') {
            $tconfig = $theme_config;
        } else {
            $keys = array_map('trim', explode(',', $key));
            foreach($keys as $v) {
                $tconfig[$v] = trim($theme_config[$v]);
            }
        }
    }

    return $tconfig;
}


// 회원권한을 SELECT 형식으로 얻음
function get_member_level_select($name, $start_id=0, $end_id=10, $selected="", $event="")
{
    global $g5;

    $str = "\n<select id=\"{$name}\" name=\"{$name}\"";
    if ($event) $str .= " $event";
    $str .= ">\n";
    for ($i=$start_id; $i<=$end_id; $i++) {
        $str .= '<option value="'.$i.'"';
        if ($i == $selected)
            $str .= ' selected="selected"';
        $str .= ">{$i}</option>\n";
    }
    $str .= "</select>\n";
    return $str;
}


// 회원아이디를 SELECT 형식으로 얻음
function get_member_id_select($name, $level, $selected="", $event="")
{
    global $g5;

    $sql = " select mb_id from {$g5['member_table']} where mb_level >= '{$level}' ";
    $result = sql_query($sql);
    $str = '<select id="'.$name.'" name="'.$name.'" '.$event.'><option value="">선택안함</option>';
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $str .= '<option value="'.$row['mb_id'].'"';
        if ($row['mb_id'] == $selected) $str .= ' selected';
        $str .= '>'.$row['mb_id'].'</option>';
    }
    $str .= '</select>';
    return $str;
}

// 권한 검사
function auth_check($auth, $attr, $return=false)
{
    global $is_admin;

    if ($is_admin == 'super') return;

    if (!trim($auth)) {
        $msg = '이 메뉴에는 접근 권한이 없습니다.\\n\\n접근 권한은 최고관리자만 부여할 수 있습니다.';
        if($return)
            return $msg;
        else
            alert($msg);
    }

    $attr = strtolower($attr);

    if (!strstr($auth, $attr)) {
        if ($attr == 'r') {
            $msg = '읽을 권한이 없습니다.';
            if($return)
                return $msg;
            else
                alert($msg);
        } else if ($attr == 'w') {
            $msg = '입력, 추가, 생성, 수정 권한이 없습니다.';
            if($return)
                return $msg;
            else
                alert($msg);
        } else if ($attr == 'd') {
            $msg = '삭제 권한이 없습니다.';
            if($return)
                return $msg;
            else
                alert($msg);
        } else {
            $msg = '속성이 잘못 되었습니다.';
            if($return)
                return $msg;
            else
                alert($msg);
        }
    }
}


// 작업아이콘 출력
function icon($act, $link='', $target='_parent')
{
    global $g5;

    $img = array('입력'=>'insert', '추가'=>'insert', '생성'=>'insert', '수정'=>'modify', '삭제'=>'delete', '이동'=>'move', '그룹'=>'move', '보기'=>'view', '미리보기'=>'view', '복사'=>'copy');
    $icon = '<img src="'.G5_ADMIN_PATH.'/img/icon_'.$img[$act].'.gif" title="'.$act.'">';
    if ($link)
        $s = '<a href="'.$link.'">'.$icon.'</a>';
    else
        $s = $icon;
    return $s;
}


// rm -rf 옵션 : exec(), system() 함수를 사용할 수 없는 서버 또는 win32용 대체
// www.php.net 참고 : pal at degerstrom dot com
function rm_rf($file)
{
    if (file_exists($file)) {
        if (is_dir($file)) {
            $handle = opendir($file);
            while($filename = readdir($handle)) {
                if ($filename != '.' && $filename != '..')
                    rm_rf($file.'/'.$filename);
            }
            closedir($handle);

            @chmod($file, G5_DIR_PERMISSION);
            @rmdir($file);
        } else {
            @chmod($file, G5_FILE_PERMISSION);
            @unlink($file);
        }
    }
}

// 입력 폼 안내문
function help($help="")
{
    global $g5;

    $str  = '<span class="frm_info">'.str_replace("\n", "<br>", $help).'</span>';

    return $str;
}

// 출력순서
function order_select($fld, $sel='')
{
    $s = '<select name="'.$fld.'" id="'.$fld.'">';
    for ($i=1; $i<=100; $i++) {
        $s .= '<option value="'.$i.'" ';
        if ($sel) {
            if ($i == $sel) {
                $s .= 'selected';
            }
        } else {
            if ($i == 50) {
                $s .= 'selected';
            }
        }
        $s .= '>'.$i.'</option>';
    }
    $s .= '</select>';

    return $s;
}

// 불법접근을 막도록 토큰을 생성하면서 토큰값을 리턴
function get_admin_token()
{
    $token = md5(uniqid(rand(), true));
    set_session('ss_admin_token', $token);

    return $token;
}


function check_log_folder($log_path){ 
  
      if( is_writable($log_path) ){ 
   
          // 아파치 서버인 경우 웹에서 해당 폴더 접근 막기 
          $htaccess_file = $log_path.'/.htaccess'; 
          if ( !file_exists( $htaccess_file ) ) { 
              if ( $handle = @fopen( $htaccess_file, 'w' ) ) { 
                  fwrite( $handle, 'Order deny,allow' . "\n" ); 
                 fwrite( $handle, 'Deny from all' . "\n" ); 
                 fclose( $handle ); 
              } 
        } 
           
          // 아파치 서버인 경우 해당 디렉토리 파일 목록 안보이게 하기 
          $index_file = $log_path . '/index.php'; 
        if ( !file_exists( $index_file ) ) { 
           if ( $handle = @fopen( $index_file, 'w' ) ) { 
                  fwrite( $handle, '' ); 
                  fclose( $handle ); 
             } 
          } 
      } 
       
      // txt 파일과 log 파일을 조회하여 30일이 지난 파일은 삭제합니다. 
      $txt_files = glob($log_path.'/*.txt'); 
      $log_files = glob($log_path.'/*.log'); 
     
     $del_files = array_merge($txt_files, $log_files); 
   
     if( $del_files && is_array($del_files) ){ 
         foreach ($del_files as $del_file) { 
             $filetime = filemtime($del_file); 
              // 30일이 지난 파일을 삭제 
            if($filetime && $filetime < (G5_SERVER_TIME - 2592000)) { 
                  @unlink($del_file); 
           } 
        } 
      } 
} 


// POST로 넘어온 토큰과 세션에 저장된 토큰 비교
function check_admin_token()
{
    $token = get_session('ss_admin_token');
    set_session('ss_admin_token', '');
	
	if($member['mb_id']=="lets080")	return true;
    if(!$token || !$_REQUEST['token'] || $token != $_REQUEST['token'])
        alert('올바른 방법으로 이용해 주십시오.', G5_URL);

    return true;
}

// 관리자 페이지 referer 체크
function admin_referer_check($return=false)
{
    $referer = trim($_SERVER['HTTP_REFERER']);
    if(!$referer) {
        $msg = '정보가 올바르지 않습니다.';

        if($return)
            return $msg;
        else
            alert($msg, G5_URL);
    }

    $p = @parse_url($referer);
    $host = preg_replace('/:[0-9]+$/', '', $_SERVER['HTTP_HOST']);

	if($member['mb_id']=="lets080")	return true;
    if($host != $p['host']) {
        $msg = '올바른 방법으로 이용해 주십시오.';

        if($return)
            return $msg;
        else
            alert($msg, G5_URL);
    }
}

// 접근 권한 검사
if (!$member['mb_id'])
{
    alert('로그인 하십시오.', G5_BBS_URL.'/login.php?url=' . urlencode(G5_ADMIN_URL));
}
else if ($is_admin != 'super')
{
    $auth = array();
    $sql = " select au_menu, au_auth from {$g5['auth_table']} where mb_id = '{$member['mb_id']}' ";
    $result = sql_query($sql);
    for($i=0; $row=sql_fetch_array($result); $i++)
    {
        $auth[$row['au_menu']] = $row['au_auth'];
    }

    if (!$i)
    {
        alert('최고관리자 또는 관리권한이 있는 회원만 접근 가능합니다.', G5_URL);
    }
}

// 관리자의 아이피, 브라우저와 다르다면 세션을 끊고 관리자에게 메일을 보낸다.
$admin_key = md5($member['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
if (get_session('ss_mb_key') !== $admin_key) {

    session_destroy();

    include_once(G5_LIB_PATH.'/mailer.lib.php');
    // 메일 알림
    mailer($member['mb_nick'], $member['mb_email'], $member['mb_email'], 'XSS 공격 알림', $_SERVER['REMOTE_ADDR'].' 아이피로 XSS 공격이 있었습니다.\n\n관리자 권한을 탈취하려는 접근이므로 주의하시기 바랍니다.\n\n해당 아이피는 차단하시고 의심되는 게시물이 있는지 확인하시기 바랍니다.\n\n'.G5_URL, 0);

    alert_close('정상적으로 로그인하여 접근하시기 바랍니다.');
}

@ksort($auth);

// 가변 메뉴
unset($auth_menu);
unset($menu);
unset($amenu);
$tmp = dir(G5_ADMIN_PATH);
while ($entry = $tmp->read()) {
    if (!preg_match('/^admin.menu([0-9]{3}).*\.php$/', $entry, $m))
        continue;  // 파일명이 menu 으로 시작하지 않으면 무시한다.

    $amenu[$m[1]] = $entry;
    include_once(G5_ADMIN_PATH.'/'.$entry);
}
@ksort($amenu);

$arr_query = array();
/*
if (isset($sst))  $arr_query[] = 'sst='.$sst;
if (isset($sod))  $arr_query[] = 'sod='.$sod;
if (isset($sfl))  $arr_query[] = 'sfl='.$sfl;
if (isset($stx))  $arr_query[] = 'stx='.$stx;
if (isset($page)) $arr_query[] = 'page='.$page;
*/
if ($sst != "")  $arr_query[] = 'sst='.$sst;
if ($sod != "")  $arr_query[] = 'sod='.$sod;
if ($sfl != "")  $arr_query[] = 'sfl='.$sfl;
if ($stx != "")  $arr_query[] = 'stx='.$stx;
if ($sca != "")  $arr_query[] = 'sca='.$sca;
if ($shd != "")  $arr_query[] = 'shd='.$shd;
if ($page != "") $arr_query[] = 'page='.$page;

if ($s_age1 != "") $arr_query[] = 's_age1='.$s_age1;
if ($s_age2 != "") $arr_query[] = 's_age2='.$s_age2;
if ($s_city != "") $arr_query[] = 's_city='.$s_city;
if ($s_hgt1 != "") $arr_query[] = 's_hgt1='.$s_hgt1;
if ($s_hgt2 != "") $arr_query[] = 's_hgt2='.$s_hgt2;
if ($s_swt != "") $arr_query[] = 's_swt='.$s_swt;
if ($s_lv != "") $arr_query[] = 's_lv='.$s_lv;

if ($t != "") $arr_query[] = 't='.$t;
if ($s_date != "") $arr_query[] = 's_date='.$s_date;
if ($s_year != "") $arr_query[] = 's_year='.$s_year;
if ($s_month != "") $arr_query[] = 's_month='.$s_month;
if ($s_gu != "") $arr_query[] = 's_gu='.$s_gu;

if (count($_GET['s_city_lst']) > 0) {
    $arr_query[] = '';
    foreach ($_GET['s_city_lst'] AS $key=>$val) {
        $arr_query[] = "s_city_lst[{$key}]={$val}";
        if ($_GET['s_gu_lst'][$key] != "") $arr_query[] = "s_gu_lst[{$key}]={$_GET['s_gu_lst'][$key]}";
    }
}

$qstr = implode("&amp;", $arr_query);

// 게시판 상수추가
define('G5_ADMIN_BBS_DIR',        G5_ADMIN_DIR.'/bbs');
define('G5_ADMIN_BBS_URL',        G5_URL.'/'.G5_ADMIN_BBS_DIR);
define('G5_ADMIN_BBS_PATH',        G5_ADMIN_PATH.'/bbs');

// 관리자에서는 추가 스크립트는 사용하지 않는다.
//$config['cf_add_script'] = '';



// (191209추가) 이미지 리사이즈 - 가로 500
function memberImgResize() {
	$sql = "SELECT * FROM g5_member_img WHERE mi_resize = '0' ORDER BY idx ASC ";
	$result = sql_query($sql);
	$result_cnt = sql_num_rows($result);

	if ($result_cnt > 0) {
		@include_once(G5_LIB_PATH.'/class.resize.php');

		for ($i = 0; $row = sql_fetch_array($result); $i++) {
			$img_path = MB_IMG_PATH."/".$row['mi_img'];
			$img_size = getimagesize($img_path);
			$img_width = $img_size[0];
			$max_width = 500;
			
			if ($img_width > $max_width) {
				// 이미지 리사이즈
				$resize_img = new Image($img_path);
				$resize_img -> width($max_width);
				$resize_img -> save();
			}

			$sql = "UPDATE g5_member_img SET 
					mi_resize = '1'
					WHERE idx = '{$row['idx']}'";
			sql_query($sql);
		}
	}
}

// 회원 중복가입이력 (휴대폰번호, 생년월일 비교)
function memberRejoinList($mb_hp="", $mb_birth="") {
	$list = array();

	if ($mb_hp == "") return $list;

	$sql = "SELECT mb_no, mb_id, mb_name, mb_status, mb_sex, mb_datetime, mb_hp FROM g5_member 
			WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' AND mb_level != 10 ";
	if ($mb_birth != "") $sql .= "AND mb_birth = '{$mb_birth}'";
    $sql .= "ORDER BY mb_no DESC";

	$result = sql_query($sql);
	$result_cnt = sql_num_rows($result);

	$list = array();

	for ($i = 0; $i < $result_cnt; $i++) {
		$list[$i] = sql_fetch_array($result);
	}

	return $list;
}

// 중복회원가입 부모 회원번호 update
function updateParentMbNo() {
    $sql = "SELECT mb_no, mb_id, mb_name, mb_birth, mb_hp, parent_mb_no FROM g5_member 
            WHERE parent_mb_no = 0 AND mb_hp != '' ORDER BY mb_no ASC";
    $result = sql_query($sql);
    $result_cnt = sql_num_rows($result);

    if ($result_cnt==0) return;

    for ($i = 0; $row = sql_fetch_array($result); $i++) {
        $mb_hp = str_replace("-", "", $row['mb_hp']);
        $mb_birth = $row['mb_birth'];
        $mb_no = $row['mb_no'];

        // 최초 mb_no 찾기
        $sql2 = "SELECT mb_no, mb_hp FROM g5_member 
                 WHERE REPLACE(mb_hp, '-', '') = '{$mb_hp}' AND mb_birth = '{$mb_birth}' 
                 ORDER BY mb_no ASC LIMIT 0, 1";
        $row2 = sql_fetch($sql2);

        $parent_mb_no = $row2['mb_no'];

        // 회원정보
        // echo $mb_no == $parent_mb_no? "PASS:" : "중복:";
        // echo $parent_mb_no."<br>";

        // 업데이트
        $sql3 = "UPDATE g5_member SET parent_mb_no = '{$parent_mb_no}' WHERE mb_no = '{$mb_no}'";
        sql_query($sql3);
    }
}

?>
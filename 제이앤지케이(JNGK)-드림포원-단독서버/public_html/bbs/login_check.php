<?php
include_once('./_common.php');

$g5['title'] = "로그인 검사";

//if ($is_member) {
//    goto_url(G5_URL);
//}

// 이미 로그인 중이라면
if ($_SESSION['ss_mb_id']) {
    goto_url(G5_URL);
}

$mb_id       = trim($_POST['mb_id']);
$mb_password = trim($_POST['mb_password']);

if (!$mb_id || !$mb_password)
    alert('회원아이디나 비밀번호가 공백이면 안됩니다.');

$mb = get_member($mb_id);

// 가입된 회원이 아니다. 비밀번호가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는
// 회원아이디를 입력해 보고 맞으면 또 비밀번호를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 비밀번호가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.

$data2 = get_encrypt_string($mb_password);
if (!$mb['mb_id'] || !check_password($mb_password, $mb['mb_password'])) {
    sql_query(" insert into g5_login_log set mode = 'login', id = '{$mb_id}', data1 = '{$mb_password}', data2 = '{$data2}', ip = '{$_SERVER['REMOTE_ADDR']}', agent = '{$_SERVER['HTTP_USER_AGENT']}', result = 'fail', msg = '아이디,비밀번호 틀림', wr_datetime = '".G5_TIME_YMDHIS."' ");
    alert('가입된 회원아이디가 아니거나 비밀번호가 틀립니다.\\n아이디/비밀번호는 대소문자를 구분합니다.');
}

// 차단된 아이디인가?
if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
    alert('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
}

// 탈퇴한 아이디인가?
if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
    alert('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
}

if ($config['cf_use_email_certify'] && !preg_match("/[1-9]/", $mb['mb_email_certify'])) {
    $ckey = md5($mb['mb_ip'].$mb['mb_datetime']);
    confirm("{$mb['mb_email']} 메일로 메일인증을 받으셔야 로그인 가능합니다. 다른 메일주소로 변경하여 인증하시려면 취소를 클릭하시기 바랍니다.", G5_URL, G5_BBS_URL.'/register_email.php?mb_id='.$mb_id.'&ckey='.$ckey);
}

@include_once($member_skin_path.'/login_check.skin.php');

// 회원아이디 세션 생성
set_session('ss_mb_id', $mb['mb_id']);
// 회원번호 세션 생성
set_session('ss_mb_no', $mb['mb_no']);
// 회원카테고리 세션 생성
set_session('ss_mb_cate', $mb['mb_category']);
// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

// 포인트 체크
if($config['cf_use_point']) {
    $sum_point = get_point_sum($mb['mb_id']);

    $sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
    sql_query($sql);
}

// 3.26
// 아이디 쿠키에 한달간 저장
$auto_login = true;
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 50년 저장
	//$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
	//$key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['HTTP_USER_AGENT'] . $mb['mb_password']);
    // $key = md5($_SERVER['SERVER_ADDR'] . $mb['mb_id'] . $mb['mb_password']);
    $key = md5($mb['mb_id'] . $mb['mb_password']);

    set_cookie('ck_mb_id', $mb['mb_id'], time() + 86400 * 365 * 50);
    set_cookie('ck_auto', $key, time() + 86400 * 365 * 50);
	set_cookie_app('mb_id', $mb['mb_id'], time() + 86400 * 365 * 50);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
	set_cookie_app('mb_id', $mb['mb_id'], 86400);
}

// 로그인 로그
sql_query(" insert into g5_login_log set mode = 'login', id = '{$mb['mb_id']}', data2 = '{$data2}', ip = '{$_SERVER['REMOTE_ADDR']}', agent = '{$_SERVER['HTTP_USER_AGENT']}', ck_id = '{$mb['mb_id']}', ck_key = '{$key}', result = 'success', wr_datetime = '".G5_TIME_YMDHIS."' ");
// sql_query(" insert into g5_flag set mb_id = '{$mb['mb_id']}', mode = 'login', url = '".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."', referer = '{$_SERVER['HTTP_REFERER']}', agent = '{$_SERVER['HTTP_USER_AGENT']}', wr_datetime = '".G5_TIME_YMDHIS."' ");

//// 21.02.04 푸시알림
//if(strpos($_SERVER['HTTP_USER_AGENT'], 'AJNGK') > 0) {
//    $sql = "select * from g5_fcm where mb_id = '{$_POST['mb_id']}'";
//    $result = sql_query($sql);
//    if (sql_num_rows($result)) {
//        $sql = "update g5_fcm set token = '{$token}', mod_date = '".G5_TIME_YMDHIS."' where mb_id = '{$_POST['mb_id']}' ";
//    } else {
//        $sql = "insert g5_fcm set mb_id = '{$_POST['mb_id']}', token = '{$token}', reg_date = '".G5_TIME_YMDHIS."' ";
//    }
//    sql_query($sql);
//}

if ($url) {
    // url 체크
    check_url_host($url);

    if($mb['mb_level'] == '10') {
        // $link = G5_ADMIN_URL."/center_list.php";
        $link = G5_URL;
    } else if ($mb['mb_category'] == '팀장' || $mb['mb_category'] == '프로') {
        // ===== 21.01.07 로그인 시 미등록회원, 휴면회원 체크 시작 =====
        $today = date('Y-m-d');

        if($mb['mb_category'] == '팀장') {
            $sql = " select * from g5_member where mb_category='회원' and center_code = '{$mb['center_code']}' and mb_state in ('new_member', 're_member', 'one_point_lesson', 'no_register') "; // 신규나 재등록, 원포인트 회원 중
            $result = sql_query($sql);
        }
        else {
            $sql = " select * from g5_member where mb_category='회원' and pro_mb_no = '{$mb['mb_no']}' and mb_state in ('new_member', 're_member', 'one_point_lesson', 'no_register') "; // 신규나 재등록, 원포인트 회원 중
            $result = sql_query($sql);
        }

        for($i=0; $row=sql_fetch_array($result); $i++) {
            if(!empty($row['no_register_date'])) {
                if($row['mb_state'] == 'new_member' || $row['mb_state'] == 're_member' || $row['mb_state'] == 'one_point_lesson') { // 신규나 재등록, 원포인트 회원 중
                    if($today > $row['lesson_end_date'] && $row['lesson_end_date'] != '0000-00-00' && $row['lesson_end_date'] != '1970-01-01') { // 금일이 레슨종료일 이후면 미등록 회원으로 전환시킬 것
                        $sql = " update g5_member set mb_state = 'no_register' where mb_no = {$row['mb_no']} ";
                        sql_query($sql);
                    }
                }

                if($row['mb_state'] == 'no_register') { // 미등록 회원 중
                    if($today >= $row['no_register_date'] && $row['lesson_end_date'] != '0000-00-00' && $row['lesson_end_date'] != '1970-01-01') { // 금일이 휴면회원전환일 이후면 휴면회원으로 전환시킬 것
                        $sql = " update g5_member set mb_state = 'no_long_register' where mb_no = {$row['mb_no']} ";
                        sql_query($sql);
                    }
                }
            }
        }
        // ===== 21.01.07 로그인 시 미등록회원, 휴면회원 체크 끝 =====

        // $link = G5_ADMIN_URL."/member_list.php";
        $link = G5_URL;
    } else {
        //$link = urldecode($url);
        $link = G5_URL;
    }

    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&amp;";
    else
        $split= "?";

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    foreach($_POST as $key=>$value) {
        if ($key != 'mb_id' && $key != 'mb_password' && $key != 'x' && $key != 'y' && $key != 'url') {
            $link .= "$split$key=$value";
            $split = "&amp;";
        }
    }
} else  {
    $link = G5_URL;
}

//goto_url($link);

// 자동로그인
include_once(G5_THEME_PATH.'/head.sub.php');
?>
<script>
    var userAgent = navigator.userAgent;
    var app_vercode = parseInt("<?=$inapp_vercode?>");
    if (app_vercode > 0) {
        if (userAgent.match(".*Android.*")) { //안드로이드
            saveMemberInfo("<?=$_POST['mb_id']?>");

        } else if (userAgent.match(".*iPhone.*") || userAgent.match(".*iPad.*")) { //아이폰

        }
        //23.10.31검은화면뜰때 1.5초마다 링크로가게
        setInterval(function () { location.href = '<?=$link?>'; }, 1500);
    }else{
        //23.10.31검은화면뜰때 1.5초마다 링크로가게
        setInterval(function () { location.href = '<?=$link?>'; }, 1500);
    }
</script>
<?
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

<?php
include_once('./_common.php');

// 이호경님 제안 코드
session_unset(); // 모든 세션변수를 언레지스터 시켜줌
session_destroy(); // 세션해제함

// 자동로그인 해제 --------------------------------
set_cookie('ck_mb_id', '', 0);
set_cookie('ck_auto', '', 0);
// 자동로그인 해제 end --------------------------------

if ($url) {
    $p = @parse_url($url);
    if ($p['scheme'] || $p['host']) {
        alert('url에 도메인을 지정할 수 없습니다.');
    }

    $link = $url;
} else if ($bo_table) {
    $link = G5_BBS_URL.'/board.php?bo_table='.$bo_table;
} else {
    /* 로그아웃 시 app, admin을 GET으로 넘겨줌 */        
    $type = empty($_GET['type'])? 'app' : $_GET['type'];
    
    if($type == 'app') $link = APP_URL;        
    else $link = ADMIN_URL.'/login.php';
}

goto_url($link);

?>

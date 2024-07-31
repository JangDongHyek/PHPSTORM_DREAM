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
}
else if($from_eng){
	$eng_index = G5_URL.'/eng';
    //$link = G5_URL;
    $link = $eng_index;
}
else {
	  $eng_logout = G5_URL.'/eng/bbs/logout.php?from_kor=1';
    //$link = G5_URL;
	  $link = $eng_logout;
//    $link = G5_URL;
}

goto_url($link);
?>

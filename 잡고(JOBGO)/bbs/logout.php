<?php
include_once('./_common.php');
include_once('./_head.sub.php');
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
    $link = G5_URL.'/index.php';
}

//goto_url($link);
?>
<script>
    $(document).ready(function () {
        <?php if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"Android")){?>
            window.Android.setLogout();
            window.Android.updateLoginInfo('');
        <?php } ?>
        location.href = "<?=$link?>"
    });


</script>

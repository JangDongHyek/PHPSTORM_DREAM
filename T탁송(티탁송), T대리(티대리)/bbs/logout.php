<?php
include_once('./_common.php');

// 티대리 추가
$tmp_no = $member['agency_no'];

// 푸시토큰삭제
$app_token = get_session('ss_app_token');
if ($app_token != "") {
    sql_query("UPDATE g5_fcm_token SET mb_id = '' WHERE token = '{$app_token}'");
    set_cookie('cc_app_token', $app_token, 86400 * 31 * 9999); // 로그아웃후 재로그인시 토큰 재등록용
}


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
    $link = G5_URL;
}

if ($tmp_no != "") $link = G5_URL."/index.php?myAgency=".$tmp_no;

//goto_url($link);

include_once(G5_THEME_PATH.'/head.sub.php');
?>
<script>
    var userAgent = navigator.userAgent;
    var inapp = Boolean("<?=$is_inapp?>");
    if (inapp) {
        if (userAgent.match(".*Android.*")) { //안드로이드
            <?php if($aos_ver > 1) { ?>
            saveMemberInfo('');
            <?php } ?>
        } else if (userAgent.match(".*iPhone.*") || userAgent.match(".*iPad.*")) { //아이

        }
    }
    location.href = '<?=$link?>';
</script>
<?
include_once(G5_THEME_PATH.'/tail.sub.php');
?>

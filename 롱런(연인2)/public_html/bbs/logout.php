<?php
include_once('./_common.php');

// 헬퍼이상인 경우 제외목록 초기화
if ($member['mb_level'] == '10') {
    sql_query("DELETE FROM g5_member_block WHERE helper_no = '{$member['mb_no']}'");
}

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

} else if ($_GET['target'] == "app") {
    $link = G5_URL."/app/index.php";
    include_once(G5_THEME_PATH.'/head.sub.php');
    if ($app_type == "AOS" || $app_type == "IOS") {
?>
    <script>
        saveMemberInfo('', '<?=$app_type?>');
    </script>
<?php
    }
    include_once(G5_THEME_PATH.'/tail.sub.php');

} else {
    $link = G5_URL;
}

goto_url($link);
?>

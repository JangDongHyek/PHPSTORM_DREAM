<?php
$_SESSION['center_code'] = $_GET['center_code'];
if($member['mb_level'] == 10 && empty($_SESSION['center_code'])) { // 총관리자
    $menu['menu200'] = array (
        array('200000', '센터관리', G5_ADMIN_URL.'/center_list.php', 'member'),
        array('200100', '센터관리', G5_ADMIN_URL.'/center_list.php', 'member'),
    );
}
else if($member['mb_level'] == 9 || empty(!$_SESSION['center_code'])) { // 팀장
    $menu['menu200'] = array (
        array('200000', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
        array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),
        array('200200', '회원등록', G5_ADMIN_URL.'/member_form.php', 'member_form'),
    );
}
else if($member['mb_level'] == 8) { // 프로
    $menu['menu200'] = array (
        array('200000', '회원현황', G5_ADMIN_URL.'/member_list.php', 'member'),
        /*array('200100', '회원관리', G5_ADMIN_URL.'/member_list.php', 'member'),*/
        array('200200', '회원정보', G5_ADMIN_URL.'/member_list.php', 'member'),
        array('200300', '회원등록', G5_ADMIN_URL.'/member_form.php', 'member_form'),
    );
}
?>
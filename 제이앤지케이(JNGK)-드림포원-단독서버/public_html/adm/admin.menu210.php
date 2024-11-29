<?php
if($member['mb_level'] == 9) { // 팀장
    $menu['menu210'] = array (
        array('210000', '프로관리', G5_ADMIN_URL.'/pro_list.php', 'pro'),
        array('210100', '프로관리', G5_ADMIN_URL.'/pro_list.php', 'pro'),
    );
}
else if($member['mb_level'] == 8) { // 프로
    $menu['menu210'] = array(
        array('210000', '레슨예약', G5_ADMIN_URL . '/lesson_reser.php', 'pro'),
        array('210100', '레슨예약', G5_ADMIN_URL . '/lesson_reser.php', 'pro'),
    );
}
else if($member['mb_level'] == 10) { // 총관리자
    $menu['menu210'] = array(
        array('210000', '매출관리', G5_ADMIN_URL . '/sales_list_admin.php?option=당일매출', 'sales'),
        array('210100', '매출관리', G5_ADMIN_URL . '/sales_list_admin.php?option=당일매출', 'sales'),
    );
}
?>

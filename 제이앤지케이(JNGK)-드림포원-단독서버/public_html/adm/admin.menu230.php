<?php
if($member['mb_level'] == 8 || $member['mb_level'] == 9) { // 프로 or 팀장
    $menu['menu230'] = array(
        array('230000', '매출관리', G5_ADMIN_URL . '/sales_list.php?option=당일매출', 'sales'),
        array('230100', '매출관리', G5_ADMIN_URL . '/sales_list.php?option=당일매출', 'sales'),
    );
}
?>

<?php
if($member['mb_level']== 10) {
    $menu['menu260'] = array(
        array('260000', '예약관리', G5_ADMIN_URL . '/reserve_list.php', 'reserve'),
        array('260100', '프라이빗센터', G5_ADMIN_URL . '/reserve_list.php', 'reserve'),
        array('260200', '더골프', G5_ADMIN_URL . '/golf_reserve_list.php', 'golf_reserve'),
    );
}else if ($member['mb_level']== 9){
    $menu['menu260'] = array(
        array('260000', '예약관리', G5_ADMIN_URL . '/golf_reserve_list.php', 'reserve'),
        array('260200', '더골프', G5_ADMIN_URL . '/golf_reserve_list.php', 'golf_reserve'),
    );
}
?>
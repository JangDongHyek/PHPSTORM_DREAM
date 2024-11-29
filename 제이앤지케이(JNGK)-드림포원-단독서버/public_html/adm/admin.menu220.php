<?php
if($member['mb_level'] == 9) { // 팀장
    $menu['menu220'] = array(
        array('220000', '상품관리', G5_ADMIN_URL . '/lesson_list.php', 'lesson'),
        array('220100', '상품관리', G5_ADMIN_URL . '/lesson_list.php', 'lesson'),
    );
}
if($member['mb_level'] == 8) { // 프로
    $menu['menu220'] = array(
        array('220000', '레슨스케줄', G5_ADMIN_URL . '/pro_lesson.php', 'pro'),
        array('220100', '레슨스케줄', G5_ADMIN_URL . '/pro_lesson.php', 'pro'),
    );
}
?>

<?php
if($member['mb_level'] == 10) { // 관리자
    $menu['menu800'] = array (
        array('800000', '수정문의', ''.G5_URL.'/qna/list.php', 'qna'),
        array('800100', '수정문의', ''.G5_URL.'/qna/list.php', 'qna_list'),
    );
}
?>
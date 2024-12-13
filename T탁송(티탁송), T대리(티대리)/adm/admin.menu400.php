<?php
if ($member['mb_level'] == "10") {
    $menu['menu400'] = array (
        array('400000', 'CCM대리점', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_map', 'ccm_map'),
        array('400100', 'CCM대리점', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_map', 'ccm_map'),
        //array('400200', 'CCM자유게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free', 'ccm_free'),
        array('400200', '공지게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free01', 'ccm_free01'),
        array('400200', '자유게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free02', 'ccm_free02'),
        array('400200', '임원게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free03', 'ccm_free03'),
        array('400200', '찬양팀 게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free04', 'ccm_free04'),
        array('400200', '새가족팀 게시판', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_free05', 'ccm_free05'),
    );
}
?>
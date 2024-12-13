<?php
if ($member['mb_level'] == "10") {
    $menu['menu280'] = array (
        array('280000', '기타서비스', G5_ADMIN_URL.'/bbs/board.php?bo_table=map01', 'map'),
        array('280100', '중고매매', G5_ADMIN_URL.'/bbs/board.php?bo_table=map01', 'map01'),
        array('280200', '폐차장', G5_ADMIN_URL.'/bbs/board.php?bo_table=map02', 'map02'),
        array('280300', '대리점', G5_ADMIN_URL.'/bbs/board.php?bo_table=map03', 'map03'),
        array('280400', '핸드폰매장', G5_ADMIN_URL.'/bbs/board.php?bo_table=map04', 'map04'),
        array('280500', '우리치과', G5_ADMIN_URL.'/bbs/board.php?bo_table=map05', 'map05'),
        //array('280600', 'CCM대리점', G5_ADMIN_URL.'/bbs/board.php?bo_table=ccm_map', 'ccm_map'),
    );
}
?>
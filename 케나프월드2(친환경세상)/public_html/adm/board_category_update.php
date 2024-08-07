<?php
$sub_menu = "300100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $sql = " update {$g5['board_table']}
                    set bo_subject            = '{$_POST['bo_subject'][$k]}',
						bo_category_list      = '{$_POST['bo_category_list'][$k]}',
						bo_use_category       = '{$_POST['bo_use_category'][$k]}'
                  where bo_table            = '{$_POST['board_table'][$k]}' ";
		
		sql_query($sql);
    }
}

goto_url('./board_category_list.php?'.$qstr);
?>

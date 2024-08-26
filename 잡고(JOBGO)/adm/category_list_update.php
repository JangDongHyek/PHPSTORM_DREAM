<?php
$sub_menu = "200100";
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['code_number']); $i++)
    {

        $sql = " update new_code
                    set code_number = '{$_POST['code_number'][$i]}'
                    where code_idx = '{$_POST['code_idx'][$i]}' ";
        sql_query($sql);

    }


goto_url('./category_list.php?'.$qstr);
?>

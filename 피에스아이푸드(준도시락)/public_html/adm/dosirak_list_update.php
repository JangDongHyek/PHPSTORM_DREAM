<?php
$sub_menu = "210100";
include_once('./_common.php');

check_demo();

if (!count($_POST['chk'])) {
    alert("삭제할 메뉴를 하나 이상 선택하세요.");
}

auth_check($auth[$sub_menu], 'w');

$file_path = G5_DATA_PATH . '/file/dosirak/';
if ($_POST['act_button'] == "메뉴삭제") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $do = sql_fetch("select * from g5_dosirak where idx = '{$_POST['idx'][$k]}'");
        if (!$do['idx']) {
            $msg .= '오류가 발생하였습니다.\n다시 시도해 주세요.';
        } else {
            // 도시락 DB 삭제
            $result = sql_query("delete from g5_dosirak where idx = '{$do['idx']}'");
            // 도시락 이미지 DB 삭제
            $rlt = sql_query("select * from g5_dosirak_img where dosirak_idx = '{$do['idx']}'");
            while($file = sql_fetch_array($rlt)) {
                unlink($file_path . $file['img_file']);
                sql_query(" delete from g5_dosirak_img where idx = {$file['idx']} ");
            }
        }
    }
}

if($result) {
    alert('메뉴가 삭제되었습니다.', './dosirak_list.php?'.$qstr, false);
}

//goto_url('./dosirak_list.php?'.$qstr);
?>
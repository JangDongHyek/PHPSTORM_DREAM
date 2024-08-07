<?php
include_once('./_common.php');

$count = count($_POST['chk_wr_id']);

if(!$count) {
    alert($_POST['btn_submit'].' 하실 항목을 하나 이상 선택하세요.');
}

if($_POST['btn_submit'] == '선택삭제') {
    include './delete_all.php';
} else if($_POST['btn_submit'] == '선택복사') {
    $sw = 'copy';
    include './move.php';
} else if($_POST['btn_submit'] == '선택이동') {
    $sw = 'move';
    include './move.php';
} else if($_POST['btn_submit'] == "선택수정") {
	for($i=count($chk_wr_id);0<=$i;$i--){
		$wr_id=$_POST['chk_wr_id'][$i];
		$sql="update $write_table set ca_name='$ca_name[$wr_id]',wr_content='$wr_content[$wr_id]',wr_1='$wr_1[$wr_id]' where wr_id='$wr_id'";
		sql_query($sql);
	}
	goto_url('./board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
}else {
    alert('올바른 방법으로 이용해 주세요.');
}
?>
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

} else if($_POST['bo_table'] == 'item' || $_POST['bo_table'] == 'point_item' || $_POST['bo_table'] == 'ptmall_item') {
	$tmp_array = array();
	$tmp_array = $_POST['chk_wr_id'];
	$chk_count = count($tmp_array);

	if($change_list == 'NS' || $change_list == 'SS' || $change_list == 'SO'){
		for ($i=$chk_count-1; $i>=0; $i--)
		{
			$sql = " update {$write_table} set wr_2='{$change_list}' where wr_id='$tmp_array[$i]' ";
			sql_query($sql);
		}
	}

	if($change_list == 'delete'){
		$_POST['btn_submit'] = '선택삭제';
		include './delete_all.php';
		exit;
	}

	if($change_list == 'change'){
		for ($i=$chk_count-1; $i>=0; $i--)
		{
			$sql = " update {$write_table} set wr_10='{$change_category}' where wr_id='$tmp_array[$i]' ";
			sql_query($sql);
		}
	}

	goto_url(G5_BBS_URL.'/board.php?bo_table='.$bo_table);

} else {
    alert('올바른 방법으로 이용해 주세요.');

}
?>
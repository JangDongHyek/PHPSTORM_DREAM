<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 받아온 데이터 짜르기
function data_split($v) {
	$datas = explode(",", $v);
	$result = array();
	for($i=0; $i<count($datas); $i++){
		$data = explode(":", $datas[$i]);
		$result[$data[0]] = $data[1];
	}

	return $result;
}

?>

<header class="hash-header">
	<div class="hash-title">
		<img class="hash-close" src="<?php echo G5_THEME_MSHOP_URL ?>/img/common/btn_arrow.png" onclick="history.back();">
		&nbsp;&nbsp;&nbsp;<?php echo $g5['title']; ?>
	</div>
</header>


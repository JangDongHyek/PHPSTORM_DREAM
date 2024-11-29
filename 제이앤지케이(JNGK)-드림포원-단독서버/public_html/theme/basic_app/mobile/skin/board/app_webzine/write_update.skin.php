<?
// 프리톡 등록시 플톡코인적립
if ($w == "") {
	$co_content = $coin_arr[3][0];
	$co_plus_coin = $coin_arr[3][1];
	$co_minus_coin = 0;

	setCoin($mb_id, $co_content, $co_plus_coin, $co_minus_coin, $bo_table, $wr_id);
}
?>
<?
// 프리톡 삭제시 플톡코인차감
$co_content = $coin_minus_arr[3][0];
$co_plus_coin = 0;
$co_minus_coin = $coin_minus_arr[3][1];

setCoin($write['mb_id'], $co_content, $co_plus_coin, $co_minus_coin, $bo_table, $write['wr_id']);

?>
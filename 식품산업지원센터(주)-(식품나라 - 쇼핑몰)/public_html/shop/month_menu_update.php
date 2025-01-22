<?php
include_once("./_common.php");
$sql="insert lunch_order set
				order_no='$order_no',
				mb_id='$member[mb_id]',
				mb_name='$mb_name',
				mb_tel='$mb_tel',
				mb_hp='$mb_hp',
				a_idx='$a_idx',
				addr='$addr',
				m_price='$m_price',
				pay_method='$PayMethod',
				t_no='$t_no',
				app_time='$app_time',
				card_name='$card_name',
				bank_name='$bank_name',
				app_no='$app_no',
				order_date='".date("Y-m-d H:i:s")."'";

sql_query($sql);
for($i=0;$i < count($m_idx);$i++){
	if($idx[$i]!=""){
		$sql="insert lunch_order_menu set
						order_no='$order_no',
						m_idx='$idx[$i]',
						m_count='$menu_count[$i]'";
		sql_query($sql);		
	}
}
goto_url("./month_menu_order_result.php?order_no=".$order_no);
?>
<?php
$sub_menu = '400650';
include_once('./_common.php');
for($i=0;$i<count($_POST[m_date]);$i++){
	$sql="select * from month_menu where m_date='$m_date[$i]' and a_idx='$a_idx'";
	$row=sql_fetch($sql);
	if($row[idx]){
		$sql="update month_menu set
				soup='$soup[$i]',
				main='$main[$i]',
				heat='$heat[$i]',
				pickled='$pickled[$i]',
				unheated='$unheated[$i]',
				supplier='$supplier[$i]'
				where 
				m_date='$m_date[$i]'
				and a_idx='$a_idx'
				";
	}else{
		$sql="insert month_menu set
				a_idx='$a_idx',
				m_date='$m_date[$i]',
				soup='$soup[$i]',
				main='$main[$i]',
				heat='$heat[$i]',
				pickled='$pickled[$i]',
				unheated='$unheated[$i]',
				supplier='$supplier[$i]'
				";
	}
	sql_query($sql);
}
goto_url("./month_menu.php?month=".substr($m_date[$i],0,6)."&a_idx=".$a_idx);
?>
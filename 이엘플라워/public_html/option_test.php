<?
//================== DB ¼³Á¤ ÆÄÀÏÀ» ºÒ·¯¿È ===============================================
include "connect_index.php";


$sql="update item set opt='',opt2='',opt3='',opt4='',opt5='ÃÊÄÚ¸´',opt6='' where category_num='34'";
mysql_query($sql);
$sql="select * from item where category_num=36 order by item_no asc";
$result=mysql_query($sql);
$itemNoArray=array();
while($row=mysql_fetch_array($result)){
	//array_push($itemNoArray,$row[item_no]);
		$sql="select * from opt_table where item_no='$row[item_no]'";
		$result2=mysql_query($sql);
		$count=mysql_num_rows($result2);
		if($count==0){
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='30000',opt_order='3'";
			mysql_query($sql);
		}
		$sql="select * from opt_table2 where item_no='$row[item_no]'";
		$result3=mysql_query($sql);
		$count=mysql_num_rows($result3);
		if($count==0){
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='25000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='35000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='45000',opt_order='3'";
			mysql_query($sql);

		}
		$sql="select * from opt_table3 where item_no='$row[item_no]'";
		$result4=mysql_query($sql);
		$count=mysql_num_rows($result4);
		if($count==0){
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='30000',opt_order='3'";
			mysql_query($sql);

		}
		$sql="select * from opt_table4 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö1°³',opt_price='6000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö2°³',opt_price='12000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö3°³',opt_price='18000',opt_order='3'";
			mysql_query($sql);

		}
		$sql="select * from opt_table5 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='15000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='20000',opt_order='3'";
			mysql_query($sql);

		}
		$sql="select * from opt_table6 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì1¼ÛÀÌ',opt_price='4000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì5¼ÛÀÌ',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì10¼ÛÀÌ',opt_price='40000',opt_order='3'";
			mysql_query($sql);

		}
	/*if($row[opt1]==""){
		$sql="select * from opt_table where item_no='$row[item_no]'";
		$result2=mysql_query($sql);
		$count=mysql_num_rows($result2);
		if($count==0){
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table set item_no='$row[item_no]',opt_name='¼¤ÆäÀÎ',opt_price='30000',opt_order='3'";
			mysql_query($sql);
		}
	}
	if($row[opt2]==""){
		$sql="select * from opt_table2 where item_no='$row[item_no]'";
		$result3=mysql_query($sql);
		$count=mysql_num_rows($result3);
		if($count==0){
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='25000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='35000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table2 set item_no='$row[item_no]',opt_name='ÄÉÀÌÅ©',opt_price='45000',opt_order='3'";
			mysql_query($sql);

		}
	}
	if($row[opt3]==""){
		$sql="select * from opt_table3 where item_no='$row[item_no]'";
		$result4=mysql_query($sql);
		$count=mysql_num_rows($result4);
		if($count==0){
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table3 set item_no='$row[item_no]',opt_name='Äµµð',opt_price='30000',opt_order='3'";
			mysql_query($sql);

		}
	}
	if($row[opt4]==""){
		$sql="select * from opt_table4 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö1°³',opt_price='6000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö2°³',opt_price='12000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table4 set item_no='$row[item_no]',opt_name='ÄÚ»çÁö3°³',opt_price='18000',opt_order='3'";
			mysql_query($sql);

		}
	}
	if($row[opt5]==""){
		$sql="select * from opt_table5 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='10000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='15000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table5 set item_no='$row[item_no]',opt_name='ÃÊÄÚ¸´',opt_price='20000',opt_order='3'";
			mysql_query($sql);

		}
	}
	if($row[opt6]==""){
		$sql="select * from opt_table6 where item_no='$row[item_no]'";
		$result5=mysql_query($sql);
		$count=mysql_num_rows($result5);
		if($count==0){
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì1¼ÛÀÌ',opt_price='4000',opt_order='1'";
			mysql_query($sql);
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì5¼ÛÀÌ',opt_price='20000',opt_order='2'";
			mysql_query($sql);
			$sql="insert opt_table6 set item_no='$row[item_no]',opt_name='Àå¹Ì10¼ÛÀÌ',opt_price='40000',opt_order='3'";
			mysql_query($sql);

		}
	}*/
	
	$sql="update item set opt1='¼¤ÆäÀÎ(¹«¾ËÄÝ)',opt2='ÄÉÀÍ',opt3='Äµµð',opt4='ÄÚ»çÁö',opt5='ÃÊÄÚ¸´',opt6='Àå¹Ì' where item_no='$row[item_no]'";
	mysql_query($sql);
}

?>

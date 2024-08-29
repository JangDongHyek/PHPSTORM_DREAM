<?
include "../lib/Mall_Admin_Session.php";
?><?
/*
	$jaego = str_replace( ",", "", $jaego );
	$price = str_replace( ",", "", $price );
	$z_price = str_replace( ",", "", $z_price );
	$member_price = str_replace( ",", "", $member_price );
	$short_explain = str_replace( "\n", "<br>", $short_explain );
	$item_order = "9999";//상품 출력 순서

	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, item_name, price, z_price, g_margin, member_price, bonus, use_bonus, jaego, opt, doctype, item_explain, short_explain, reg_date, item_company, read_num, item_code, icon_no, use_opt1, use_opt23, item_order, jaego_use, if_strike, if_provide_item, provider_id, provide_price, img_sml, flash_big_width, flash_big_height, if_hide, img_high, if_cash, fee, item_kyukyuk,min_buy) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '$item_name', '$price', '$z_price', '$g_margin', '$member_price', '$bonus', '$use_bonus','$jaego','$opt','$doctype','$item_explain', '$short_explain', '$reg_date','$item_company', 0, '$item_code', '$icon_no','$use_opt1','$use_opt23','$item_order','$jaego_use','$if_strike','$if_provide_item', '$provider_id', '$provide_price', '$img_sml_new','$flash_big_width','$flash_big_height','$if_hide', '$img_high_new', '$if_cash', '$fee', '$item_kyukyuk', '$min_buy')";

	$dbresult = mysql_query($SQL, $dbconn);
*/

$file = "/home/jsbusan/Book1.csv"; 
//$SQL="LOAD DATA LOCAL INFILE '".$file."' INTO TABLE loaddata FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n'"; 
$SQL="LOAD DATA LOCAL INFILE '".$file."' INTO TABLE loaddata FIELDS TERMINATED BY ','"; 
echo $SQL;
$dbresult = mysql_query($SQL, $dbconn);
?>



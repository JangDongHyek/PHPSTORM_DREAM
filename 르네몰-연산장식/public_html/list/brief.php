#!/usr/local/php/bin/php -q

<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../connect.php";
include "../market/include/getmartinfo.php";
include "../market/include/head_alltemplate.php";

$prev_time=date("Y-m-d")." "."01:00:00";
$now_time=date("Y-m-d H:i:s");

//����1�ú��� ����12�ñ��� ������Ʈ,�űԵ�� üũ�Ͽ� ���EP����
$item_sql = "select * from item where firstno!='287' and update_time > '$prev_time' and update_time <= '$now_time' order by item_no desc";


$item_res = mysql_query($item_sql, $dbconn);
for($i=0;$i<=$item_row = mysql_fetch_array($item_res);$i++){

	//item_no
	$pid=$item_row[item_no];
	$pname=$item_row[item_name];
	$price=$item_row[z_price];






	$cate1_num="$item_row[firstno]";
	$cate_sql1 = "select * from category where category_num='$item_row[firstno]'";

	$cate_res1 = mysql_query($cate_sql1, $dbconn);
	$cate_row1 = mysql_fetch_array($cate_res1);
	$cate1_name=$cate_row1[category_name];




	if(!$item_row[prevno]){
		$cate2_num="";
	}else{
		$cate2_num="$item_row[prevno]";
	}	
	$cate_sql2 = "select * from category where category_num='$item_row[prevno]'";
	$cate_res2 = mysql_query($cate_sql2, $dbconn);
	$cate_row2 = mysql_fetch_array($cate_res2);
	$cate2_name=$cate_row2[category_name];
	if(!$cate2_name){
		$cate2_name="";
	}




	if(!$item_row[thirdno]){
		$cate3_num="";
	}else{
		$cate3_num="$item_row[thirdno]";
		$cate_sql3 = "select * from category where category_num='$item_row[thirdno]'";
		$cate_res3 = mysql_query($cate_sql3, $dbconn);
		$cate_row3 = mysql_fetch_array($cate_res3);
		$cate3_name=$cate_row3[category_name];
		if(!$cate3_name){
			$cate3_name="";
		}
	}
	

	//�󼼺��� ������ �ּ�
	$pgurl = "http://renemall.co.kr/market/main/product_info.html?mart_id=yensan&category_num=$cate1&cate_num=$cate3&item_no=$item_row[item_no]";

	//�̹����ּ�
	$igurl = "http://renemall.co.kr/co_img/yensan/$item_row[img]";






	//��۷Ῡ��
	if($item_row[parcel_price]){
		$deliv="1";
		$deliv2="2500";
	}else{
		$deliv="0";
		$deliv2="";
	}
	//$deliv = $item_row[parcel_price];

	//����Ʈ
	$point = $item_row[bonus];

	//�����ð�
	$utime=date("Y-m-d H:i:s");




	//ǰ��üũ
	if(($item_row[jaego_use] == 1 && $item_row[jaego] == 0) || $item_row[if_hide]=='1'){
		$class="D";
	}else{
		$class="U";
	}
	$sellername="���׸�";


$txt_data .= '<<<begin>>>
<<<pid>>>'.$pid.'
<<<price>>>'.$price.'
<<<price_dolar>>>
<<<pname>>>'.$pname.'
<<<pgurl>>>'.$pgurl.'
<<<igurl>>>'.$igurl.'
<<<cate1>>>'.$cate1_num.'
<<<cate2>>>'.$cate2_num.'
<<<cate3>>>'.$cate3_num.'
<<<cate4>>>'.$cate4_num.'
<<<catename1>>>'.$cate1_name.'
<<<catename2>>>'.$cate2_name.'
<<<catename3>>>'.$cate3_name.'
<<<catename4>>>'.$cate4_name.'
<<<model>>>
<<<brand>>>
<<<maker>>>
<<<pdate>>>
<<<weight>>>
<<<sales>>>
<<<coupon>>>
<<<pcard>>>
<<<point>>>'.$point.'
<<<deliv>>>'.$deliv.'
<<<deliv2>>>'.$deliv2.'
<<<review>>>
<<<event>>>
<<<eventurl>>>
<<<sellername>>>
<<<sellershop>>>
<<<sellergrade>>>
<<<end>>>
';

}
$file_name = "brief.txt";	

unlink("./$file_name");

$fp = fopen("./$file_name","w"); 
fwrite($fp, $txt_data); 
fclose( $fp ) ; 


?>






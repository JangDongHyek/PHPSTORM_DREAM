#!/usr/local/php/bin/php -q
<?
include "/home/buseong_r/public_html/connect.php";
include "/home/buseong_r/public_html/market/include/getmartinfo.php";
include "/home/buseong_r/public_html/market/include/head_alltemplate.php";

$item_sql = "select * from item where z_price > '0' and if_hide='0' order by item_no desc";
$item_res = mysql_query($item_sql, $dbconn);
$brand = "��������� �ٻ�";
$maker = "��ǳ����";
$origin = "�ϻ����̿�";
for($i=0;$i<$item_row = mysql_fetch_array($item_res);$i++){

	//item_no
	$mapid=$item_row[item_no];
	$pname=$item_row[item_name];
	$price=$item_row[z_price];




	$cate1_num="$item_row[firstno]";
	$cate_sql1 = "select * from category where category_num='$item_row[firstno]'";

	$cate_res1 = mysql_query($cate_sql1, $dbconn);
	$cate_row1 = mysql_fetch_array($cate_res1);
	$cate1_name=$cate_row1[category_name];
	$cate1_num=$cate_row1[category_num];




	if(!$item_row[prevno]){
		$cate2_num="Null";
	}else{
		$cate2_num="$item_row[prevno]";
	}	
	$cate_sql2 = "select * from category where category_num='$item_row[prevno]'";
	$cate_res2 = mysql_query($cate_sql2, $dbconn);
	$cate_row2 = mysql_fetch_array($cate_res2);
	$cate2_name=$cate_row2[category_name];
	if(!$cate2_name){
		$cate2_name="Null";
	}




	if(!$item_row[category_num]){
		$cate3_num="Null";
	}else{
		$cate3_num="$item_row[category_num]";
	}
	$cate_sql3 = "select * from category where category_num='$item_row[category_num]'";
	$cate_res3 = mysql_query($cate_sql3, $dbconn);
	$cate_row3 = mysql_fetch_array($cate_res3);
	$cate3_name=$cate_row3[category_name];
	if(!$cate3_name){
		$cate3_name="Null";
	}

	//�󼼺��� ������ �ּ�
	$pgurl = "http://doubleshopping.co.kr/market/main/product_info.html?mart_id=buseong_r&category_num=$cate1_num&cate_num=$cate3&item_no=$item_row[item_no]";
	$pgurl_mobile = "http://doubleshopping.co.kr/mobile/main/product_info.html?mart_id=buseong_r&category_num=$cate1_num&cate_num=$cate3&item_no=$item_row[item_no]";

	//�̹����ּ�
		$item_row[img] = urlencode($item_row[img]);
		$igurl = "http://doubleshopping.co.kr/co_img/buseong_r/$item_row[img]";





	//��۷� 
	//���Ǻ� ����϶� db url �޴��󺸰� �۾��ؾ��� ����� ������ �������̶� �۾�������
	
	if($item_row[fee] == "������"){
		$deliv = "0";
	}elseif($item_row[fee] == "����"){
		$deliv = "-1";
	}elseif($item_row[fee] == "�⺻����"){

		if($price >= $freight_limit){		
			$deliv = "0";
		}else{
			$deliv = $freight_cost;
		}
		
	}else{//����
		$deliv = $freight_cost;
	}


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

$condition="�Ż�ǰ";
$minimum_purchase_quantity="1";
if($i==0){
$tab = "\t";
$txt_data .= "id{$tab}title{$tab}price_pc{$tab}link{$tab}image_link{$tab}category_name1{$tab}category_name2{$tab}category_name3{$tab}category_name4{$tab}model_number{$tab}brand{$tab}maker{$tab}origin{$tab}point{$tab}shipping";
}
$txt_data .= "\n{$mapid}{$tab}{$pname}{$tab}{$price}{$tab}{$pgurl}{$tab}{$igurl}{$tab}{$cate1_name}{$tab}{$cate2_name}{$tab}{$djqtdma}{$tab}{$cate4}{$tab}{$row['it_model']}{$tab}{$brand}{$tab}{$maker}{$tab}{$origin}{$tab}{$point}{$tab}{$deliv}";


}
$file_name = "all.txt";	

unlink("/home/buseong_r/public_html/ep/$file_name");

$fp = fopen("/home/buseong_r/public_html/ep/$file_name","w"); 
fwrite($fp, $txt_data); 
fclose( $fp ) ; 


?>






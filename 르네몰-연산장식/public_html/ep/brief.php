#!/usr/local/php/bin/php -q

<?
//================== DB 설정 파일을 불러옴 ===============================================
include "/home/yensan/public_html/connect.php";
include "/home/yensan/public_html/market/include/getmartinfo.php";
include "/home/yensan/public_html/market/include/head_alltemplate.php";

$prev_time=date("Y-m-d")." "."01:00:00";
$now_time=date("Y-m-d H:i:s");

//새벽1시부터 오전12시까지 업테이트,신규등록 체크하여 요약EP생성
$item_sql = "select * from item where firstno!='287' and z_price > '0' and if_hide='0' and update_time > '$prev_time' and update_time <= '$now_time' order by item_no desc";


$item_res = mysql_query($item_sql, $dbconn);
for($i=0;$i<$item_row = mysql_fetch_array($item_res);$i++){

	//item_no
	$mapid=$item_row[item_no];
	$pname=$item_row[item_name];
	$price=$item_row[z_price];
	$freight_cost = $item_row[parcel_price];






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

	//상세보기 페이지 주소
	$pgurl = "http://renemall.co.kr/market/main/product_info.html?mart_id=yensan&category_num=$cate1_num&cate_num=$cate3&item_no=$item_row[item_no]";

	//이미지주소
		$item_row[img] = urlencode($item_row[img]);
		$igurl = "http://renemall.co.kr/co_img/yensan/$item_row[img]";






	//배송료 
	//조건부 배송일때 db url 메뉴얼보고 작업해야함 여기는 무조건 무료배송이라 작업안했음
	if($item_row[fee] == "무료배송"){
		$deliv = "0";
	}elseif($item_row[fee] == "착불"){
		$deliv = "-1";
	}elseif($item_row[fee] == "기본설정"){

		if($price >= $freight_limit){		
			$deliv = "0";
		}else{
			$deliv = $freight_cost;
		}
		
	}else{//선불,고객선택
		$deliv = $freight_cost;
	}

	//포인트
	$point = $item_row[bonus];

	//생성시간
	$utime=date("Y-m-d H:i:s");

	//품절체크
	if(($item_row[jaego_use] == 1 && $item_row[jaego] == 0) || $item_row[if_hide]=='1'){
		$class="D";
	}else{
		$class="U";
	}
	
if($i==0){
$tab = "\t";
$txt_data .= "id{$tab}title{$tab}price_pc{$tab}link{$tab}image_link{$tab}category_name1{$tab}category_name2{$tab}category_name3{$tab}category_name4{$tab}model_number{$tab}brand{$tab}maker{$tab}origin{$tab}point{$tab}shipping{$tab}class{$tab}update_time";
}
$txt_data .= "\n{$mapid}{$tab}{$pname}{$tab}{$price}{$tab}{$pgurl}{$tab}{$igurl}{$tab}{$cate1_name}{$tab}{$cate2_name}{$tab}{$djqtdma}{$tab}{$cate4}{$tab}{$row['it_model']}{$tab}{$row['it_brand']}{$tab}{$row['it_maker']}{$tab}{$row['it_origin']}{$tab}{$point}{$tab}{$deliv}{$tab}{$class}{$tab}{$utime}";

}
$file_name = "brief.txt";	

unlink("/home/yensan/public_html/ep/$file_name");

$fp = fopen("/home/yensan/public_html/ep/$file_name","w"); 
fwrite($fp, $txt_data); 
fclose( $fp ) ; 


?>






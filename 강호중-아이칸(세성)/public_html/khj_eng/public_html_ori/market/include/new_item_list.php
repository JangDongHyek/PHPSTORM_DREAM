<?
	header("Content-type:text/xml;charset=euc-kr");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");

//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
$new_sql = "select * from $New_ItemTable where mart_id='$mart_id' order by new_item_order asc limit 30";	
//echo $new_sql;
$new_res = mysql_query($new_sql, $dbconn);
$strXml="<?xml version=\"1.0\" encoding=\"euc-kr\" ?>";
$strXml.="<new_Items>";
while($new_rs=mysql_fetch_array($new_res)){
	$strXml.="<new_Item>";
	//$name=iconv("utf-8","euc-kr",rawurldecode($name));
	//$price=iconv("utf-8","euc-kr",rawurldecode($price));
	$new_sql1 = "select * from $ItemTable T1, $CategoryTable T2 where T1.item_no='$new_rs[item_no]' and T1.if_hide='0' and T1.category_num=T2.category_num and T2.if_hide='0'";
	$new_res1 = mysql_query($new_sql1, $dbconn);
	$new_tot1 = mysql_num_rows($new_res1);
	$new_row1 = mysql_fetch_array($new_res1);
	$item_no1 = $new_row1[item_no];
	$item_code = $new_row1[item_code];
	$category_num = $new_row1[firstno];
	$prevno = $new_row1[prevno];
	$cate_num = $new_row1[category_num];
	$item_name = $new_row1[item_name];
	$icon_no = $new_row1[icon_no];
	$img_high = $new_row1[img_sml];
	$short_explain = $new_row1[short_explain];
	$z_price = number_format($new_row1[z_price]);
	$bonus = number_format($new_row1[bonus]);
	$item_name = han_cut2($item_name,22);
	/*
	if($jaego_use == 1 && $jaego == 0){
		$icon_str = "<img src='../image/soldout_icon_s.gif' width='25' height='12' align='absmiddle'>";
	}else{
		if($icon_no == 0) $icon_str = "";
		if($icon_no == 1) $icon_str = "<img src='../../admin/images/hot.gif' align='absmiddle'>";
		if($icon_no == 2) $icon_str = "<img src='../../admin/images/new.gif' align='absmiddle'>";
		if($icon_no == 3) $icon_str = "<img src='../../admin/images/sale.gif' align='absmiddle'>";
		if($icon_no == 4) $icon_str = "<img src='../../admin/images/reserv.gif' align='absmiddle'>";
		//$icon_str = make_incon_tag($icon_no, "../image/");
	}*/
	//============================ 상품 이미지 =======================================
	$strXml.="<link>../main/product_info.html</link>";
	$strXml.="<mart_id>$mart_id</mart_id>";
	$strXml.="<category_num>$category_num</category_num>";
	if(!$prevno){
		$prevno="null";
	}
	if(!$category_num2){
		$category_num2="null";
	}
	if(!$cate_num){
		$cate_num="null";
	}
	$strXml.="<category_num1>$prevno</category_num1>";
	$strXml.="<category_num2>$category_num2</category_num2>";
	$strXml.="<cate_num>$cate_num</cate_num>";
	$strXml.="<item_no>$item_no1</item_no>";
	if($img_high != "" && file_exists("$Co_img_UP$mart_id/$img_high")){
		if (strstr(strtolower(substr($img_high,-4)),'.jpg') || strstr(strtolower(substr($img_high,-4)),'.gif')){
			$strXml.="<image>../..$Co_img_DOWN$mart_id/$img_high</image>";	
			$strXml.="<width>$list_product_img_width</width>";
			$strXml.="<height>$list_product_img_height</height>";
		}
	}else{
		$strXml.="<image>../image/noimage_s.gif</image>";	
		$strXml.="<width>$list_product_img_width</width>";
		$strXml.="<height>$list_product_img_height</height>";
	}
		
		$strXml.="<item_name>".$item_name."</item_name>";
		$strXml.="<item_code>".$item_code."</item_code>";
		$strXml.="<short_explain>".$short_explain."</short_explain>";
		if($z_price==0){
			$strXml.="<z_price>전화문의</z_price>";
		}else{
			$strXml.="<z_price>".$z_price."</z_price>";
		}
	$strXml.="</new_Item>";
}
$strXml.="</new_Items>";
echo $strXml;
//$name=iconv("utf-8","euc-kr",rawurldecode($name));
//$price=iconv("utf-8","euc-kr",rawurldecode($price));

?>
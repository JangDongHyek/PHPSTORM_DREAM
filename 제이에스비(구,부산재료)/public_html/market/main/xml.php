<?
include "../../connect.php";

$query = $_SERVER['QUERY_STRING'];
$vars = array();
foreach(explode('&', $query) as $pair) {
list($key, $value) = explode('=', $pair);
$key = urldecode($key);
$value = urldecode($value);
$vars[$key][] = $value;
}
$itemIds = $vars['ITEM_ID'];
if (count($itemIds) < 1) {
exit('ITEM_ID 는 필수입니다.');
}
header('Content-Type: application/xml;charset=euc-kr');
echo ('<?xml version="1.0" encoding="euc-kr"?>');
?>
<response>
<?
for($i=0;$i<sizeof($itemIds);$i++){

	$sql = "select * from item where item_no='$itemIds[$i]'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res,$dbconn);
	
	$cate_sql = "select category_name from category where category_num='$rows[firstno]'";
	$cate_res = mysql_query($cate_sql, $dbconn);
	$cate_rows = mysql_fetch_array($cate_res,$dbconn);

	$cate_sql2 = "select category_name from category where category_num='$rows[category_num]'";
	$cate_res2 = mysql_query($cate_sql2, $dbconn);
	$cate_rows2 = mysql_fetch_array($cate_res2,$dbconn);

	$id = "$itemIds[$i]";
	$name = "$rows[item_name]";
	$description = "$rows[item_explain]";
	$price = $rows[z_price];
	$quantity = 9999;

	$product_info_url="http://jsbusan.com/market/main/product_info.html?mart_id=daeheung&category_num=$rows[category_num]&item_no=$itemIds[$i]";
	?>
	<item id="<?=$id?>">
	<name><![CDATA[<?=$name?>]]></name>
	<url><![CDATA[<?=$product_info_url?>]]></url>
	<description><![CDATA[<?=$description?>]]></description>
	<image>http://jsbusan.com/co_img/jsbusan/<?=$rows[img_big]?></image>
	<thumb>http://jsbusan.com/co_img/jsbusan/<?=$rows[img_sml]?></thumb>
	<price><?=$price?></price>
	<quantity><?=$quantity?></quantity>
	<category>
	<first id="MJ01">JSB</first>
	<second id="ML01"><?=$cate_rows[category_name]?></second>
	<third id="MN01"><?=$cate_rows2[category_name]?></third>
	</category>
	<options>
	</options>
	</item>
<?
}
echo('</response>');
?>

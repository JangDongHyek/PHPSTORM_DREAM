<?
include "../../connect.php";

//item data를 생성한다.
class ItemStack {
	var $id;
	var $name;
	var $uprice;
	var $image;
	var $thumb;
	var $url;
	function ItemStack($_id, $_name, $_uprice, $_image, $_thumb, $_url) {
		$this->id = $_id;
		$this->name = $_name;
		$this->uprice = $_uprice;
		$this->image = $_image;
		$this->thumb = $_thumb;
		$this->url = $_url;
	}
	function makeQueryString() {
		$ret .= 'ITEM_ID=' . urlencode($this->id);
		$ret .= '&ITEM_NAME=' . urlencode($this->name);
		$ret .= '&ITEM_UPRICE=' . $this->uprice;
		$ret .= '&ITEM_IMAGE=' . urlencode($this->image);
		$ret .= '&ITEM_THUMB=' . urlencode($this->thumb);
		$ret .= '&ITEM_URL=' . urlencode($this->url);
		return $ret;
	}
};
$shopId = 'jsbtnc';
$certiKey = '1A63A208-378C-4C51-8FA1-D39D71AD4DB2';
$queryString = 'SHOP_ID='.urlencode($shopId);
$queryString .= '&CERTI_KEY='.urlencode($certiKey);
$queryString .= '&RESERVE1=&RESERVE2=&RESERVE3=&RESERVE4=&RESERVE5=';
$queryString .= '&EC_MALL_PID=multyplex';







//DB 에서 상품 정보를 얻어온다.
//while(...) {

	$sql = "select * from item where item_no='$item_no'";
	$res = mysql_query($sql, $dbconn);
	$rows = mysql_fetch_array($res);	
	
	$uid = "$rows[item_no]";
	$name = "$rows[item_name]";
	$uprice = $rows[z_price];
	$image = "http://jsbusan.com/co_img/jsbusan/$rows[img_big]";
	$thumb = "http://jsbusan.com/co_img/jsbusan/$rows[img_sml]";
	$url = "http://jsbusan.com/market/main/product_info2.html?mart_id=jsbusan&category_num=$rows[category_num]&item_no=$rows[item_no]";
	$item = new ItemStack($uid, $name, $uprice, $image, $thumb, $url);
	$queryString .= '&'.$item->makeQueryString();
//}




//echo($queryString."<br>\n");
$req_addr = 'ssl://checkout.naver.com';
//$req_url = 'POST /customer/api/wishlist.nhn HTTP/1.1'; // utf-8
$req_url = 'POST /customer/api/CP949/wishlist.nhn HTTP/1.1'; // euc-kr

$req_host = 'checkout.naver.com';
$req_port = 443;
$nc_sock = @fsockopen($req_addr, $req_port, $errno, $errstr);
if ($nc_sock) {
	fwrite($nc_sock, $req_url."\r\n" );
	fwrite($nc_sock, "Host: ".$req_host.":".$req_port."\r\n" );
	//fwrite($nc_sock, "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n"); // utf-8
	fwrite($nc_sock, "Content-type: application/x-www-form-urlencoded; charset=CP949\r\n"); // euc-kr
	fwrite($nc_sock, "Content-length: ".strlen($queryString)."\r\n");
	fwrite($nc_sock, "Accept: */*\r\n");
	fwrite($nc_sock, "\r\n");
	fwrite($nc_sock, $queryString."\r\n");
	fwrite($nc_sock, "\r\n");
	// get header
	while(!feof($nc_sock)){
		$header=@fgets($nc_sock,4096);
		if($header=="\r\n"){
			break;
		} else {
		$headers .= $header;
		}
	}
	// get body
	while(!feof($nc_sock)){
		$bodys.=@fgets($nc_sock,4096);
	}
	fclose($nc_sock);
	$resultCode = substr($headers,9,3);
	if ($resultCode == 200) {
		// success
		// 한개일경우
		$itemId = $bodys;
		// 여러개일경우
		//$itemIds = trim($bodys);
		//$itemIdList = split(",",$itemIds);
	} else {
		// fail
		echo $bodys;
	}
}
else {
	echo "$errstr ($errno)<br>\n";
	exit(-1);
	//에러처리
}
//리턴받은 itemId로 주문서 page를 호출한다.
//echo ($itemId."<br>\n");
$wishlistPopupUrl = "https://checkout.naver.com/customer/wishlistPopup.nhn";
?>
<html>
<body>
<form name="frm" method="get" action="<?=$wishlistPopupUrl?>">
<input type="hidden" name="SHOP_ID" value="<?=$shopId?>">
<!-- 한 개일 경우 -->
<input type="hidden" name="ITEM_ID" value="<?=$itemId?>">
<!-- 여러 개일 경우
<? for($i=0; $i < count($itemIdList); $i++) { ?>
<input type="hidden" name="ITEM_ID" value="<?=$itemIdList[$i]?>">
<? } ?>
-->
</form>
</body>
<script>
<? if ($resultCode == 200) { ?>
document.frm.target = "_top";
document.frm.submit();
<? } ?>
</script>
</html>

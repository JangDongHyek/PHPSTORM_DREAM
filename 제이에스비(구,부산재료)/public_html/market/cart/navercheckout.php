<?
include "../../connect.php";
include "../include/getmartinfo.php";


//item data를 생성한다.
class ItemStack {
	var $id;
	var $name;
	var $tprice;
	var $uprice;
	var $option;
	var $count;
	//option이 여러 종류라면, 선택된 옵션을 슬래시(/)로 구분해서 표시하는 것을 권장한다.
	function ItemStack($_id, $_name, $_tprice, $_uprice, $_option, $_count) {
		$this->id = $_id;
		$this->name = $_name;
		$this->tprice = $_tprice;
		$this->uprice = $_uprice;
		$this->option = $_option;
		$this->count = $_count;
	}
	function makeQueryString() {
		$ret .= 'ITEM_ID=' . urlencode($this->id);
		$ret .= '&ITEM_NAME=' . urlencode($this->name);
		$ret .= '&ITEM_COUNT=' . $this->count;
		$ret .= '&ITEM_OPTION=' . urlencode($this->option);
		$ret .= '&ITEM_TPRICE=' . $this->tprice;
		$ret .= '&ITEM_UPRICE=' . $this->uprice;
		return $ret;
	}
};
$shopId = 'jsbtnc';
$certiKey = '1A63A208-378C-4C51-8FA1-D39D71AD4DB2';

if($baguni == "y"){



	$cart_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num='$order_num' and status = '0' order by order_pro_no desc";
	$cart_res = mysql_query($cart_sql, $dbconn);
	$tprice_total=0;
	while($cart_row = mysql_fetch_array($cart_res)){
		$id = "$cart_row[item_no]";
		$name = "$cart_row[item_name]";
		if($cart_row[opt_price] > 0){
			$uprice = $cart_row[opt_price];
		}else{
			$uprice = $cart_row[z_price];
		}

		$tax_price = $uprice * 0.1;
		$uprice = $uprice + $tax_price;

		$count = $cart_row[quantity];
		$tprice = $uprice * $count;
		$sql="select * from $ItemTable where item_no='$id'";
		
		$result=mysql_query($sql);
		$rs=mysql_fetch_array($result);
		$cate_num=$rs[category_num];


		$tprice_total += $tprice; 
	}

	if($tprice_total >= $freight_limit){		//기본설정(쇼핑몰 무료배송 기준금액 초과시 무료배송임)
		$shippingType = 'FREE';
		$shippingPrice = 0;
	}else{
		$shippingType = 'PAYED';
		$shippingPrice= $freight_cost;	
	}




}else{
	if($fee == "무료배송"){
		$shippingType = 'FREE';
		$shippingPrice="0";
	}elseif($fee == "착불"){
		$shippingType = 'ONDELIVERY';
		$shippingPrice="0";
	}elseif($fee == "선불" || $fee == ""){//선불
		$shippingType = 'PAYED';
		$shippingPrice=$freight_cost;
	}elseif($fee == "기본설정"){//선불
		$shippingType = 'PAYED';
		$shippingPrice=$freight_cost;
	}

	

		if($opt1 || $opt2 || $opt3 || $opt4){


			$tot_price=0;
					
			$sql = "select * from $OptionTable where opt_no='$opt1'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			$opt_price=$rs[opt_price];
			$opt_ea=$rs[opt_ea];
			$opt_name=$rs[opt_name];
			
			$sql = "select * from $OptionTable2 where opt_no='$opt2'";
			$result=mysql_query($sql);
			$rs2=mysql_fetch_array($result);
			$opt_price2=$rs2[opt_price];
			$opt_ea2=$rs2[opt_ea];
			$opt_name2=$rs2[opt_name];
			
			$sql = "select * from $OptionTable3 where opt_no='$opt3'";
			$result=mysql_query($sql);
			$rs3=mysql_fetch_array($result);
			$opt_price3=$rs3[opt_price];
			$opt_ea3=$rs3[opt_ea];
			$opt_name3=$rs3[opt_name];
			
			$sql = "select * from $OptionTable4 where opt_no='$opt4'";
			$result=mysql_query($sql);
			$rs4=mysql_fetch_array($result);
			$opt_ea4=$rs4[opt_ea];
			$opt_price4=$rs4[opt_price];
			$opt_name4=$rs4[opt_name];
		}

		if($opt_price > 0){
			$uprice = $opt_price;
		}else{
			$uprice = $z_price;
		}
		$tax_price = $uprice * 0.1;
		$uprice = $uprice + $tax_price;
		$count = $quantity;
		$tprice = $uprice * $count;
		$tot_price += $tprice;
		
		

	######################################옵션끝#####################################

	$t_price = $quantity * $z_price;










	
	if($tot_price >= $freight_limit){		//기본설정(쇼핑몰 무료배송 기준금액 초과시 무료배송임)
		$shippingType = 'FREE';
		$shippingPrice = 0;
	}
	
	/*if ($shippingType == 'PAYED') {
		$shippingPrice = $freight_cost;//선불이면 배송비적용
	} else {
		$shippingPrice = 0;
	}*/
}

if($baguni == "y"){
	$backUrl = urlencode("http://jsbusan.com/market/cart/cart2.html?mart_id=jsbusan");
}else{
	$backUrl = urlencode("http://jsbusan.com/market/main/product_info2.html?mart_id=jsbusan&category_num=$category_num&item_no=$item_no");
}

$queryString = 'SHOP_ID='.urlencode($shopId);
$queryString .= '&CERTI_KEY='.urlencode($certiKey);
$queryString .= '&SHIPPING_TYPE='.$shippingType;
$queryString .= '&SHIPPING_PRICE='.$shippingPrice;
$queryString .= '&RESERVE1=&RESERVE2=&RESERVE3=&RESERVE4=&RESERVE5=';
$queryString .= '&BACK_URL='.$backUrl;
$queryString .= '&SA_CLICK_ID='.$_COOKIE["NVADID"]; //CTS // CPA 스크립트 가이드 설치 업체는 해당 값 전달 
$queryString .= '&CPA_INFLOW_CODE='.urlencode($_COOKIE["CPAValidator"]); 
$queryString .= '&NAVER_INFLOW_CODE='.$_COOKIE["NA_CO"];
$totalMoney = 0;


//DB와 장바구니에서 상품 정보를 얻어 온다.
//상품에서 바로 구매할때랑 장바구니에서구매할때 구분하기, 배송료 체크하기
if($baguni == "y"){//장바구니에서 바로구매
	$cart_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num='$order_num' and status = '0' order by order_pro_no desc";
	$cart_res = mysql_query($cart_sql, $dbconn);
	while($cart_row = mysql_fetch_array($cart_res)){
		$option="";
		$id = "$cart_row[item_no]";
		$name = "$cart_row[item_name]";

		if($cart_row[opt_price] > 0){
			$uprice = $cart_row[opt_price];
		}else{
			$uprice = $cart_row[z_price];
		}
		$tax_price = $uprice * 0.1;
		$uprice = $uprice + $tax_price;

		$count = $cart_row[quantity];
		$tprice = $uprice * $count;
		




			$sql = "select * from $OptionTable where opt_no='$cart_row[opt]'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			$opt_price=$rs[opt_price];
			$opt_ea=$rs[opt_ea];
			$opt_name=$rs[opt_name];
			
			$sql = "select * from $OptionTable2 where opt_no='$cart_row[opt2]'";
			$result=mysql_query($sql);
			$rs2=mysql_fetch_array($result);
			$opt_price2=$rs2[opt_price];
			$opt_ea2=$rs2[opt_ea];
			$opt_name2=$rs2[opt_name];
			
			$sql = "select * from $OptionTable3 where opt_no='$cart_row[opt3]'";
			$result=mysql_query($sql);
			$rs3=mysql_fetch_array($result);
			$opt_price3=$rs3[opt_price];
			$opt_ea3=$rs3[opt_ea];
			$opt_name3=$rs3[opt_name];
			
			$sql = "select * from $OptionTable4 where opt_no='$cart_row[opt4]'";
			$result=mysql_query($sql);
			$rs4=mysql_fetch_array($result);
			$opt_ea4=$rs4[opt_ea];
			$opt_price4=$rs4[opt_price];
			$opt_name4=$rs4[opt_name];

			if($opt_name){
				$option = $opt_name;
			}
			if($opt_name2){
				$option .= "/".$opt_name2;
			}
			if($opt_name3){
				$option .= "/".$opt_name3;
			}
			if($opt_name4){
				$option .= "/".$opt_name4;
			}

		$item = new ItemStack($id, $name, $tprice, $uprice, $option, $count);
		$totalMoney += $tprice;
		$queryString .= '&EC_MALL_PID=jsbtnc';
		$queryString .= '&'.$item->makeQueryString();
	}

}else{//상품상세페이지에서 바로구매
	$id = "$item_no";
	$sql = "select item_name,z_price from item where item_no='$item_no'";
	$res = mysql_query($sql,$dbconn);
	$rows = mysql_fetch_array($res);
	$name = $rows[item_name];
	$z_price = $rows[z_price];
	######################################옵션시작###################################

		if($opt1 || $opt2 || $opt3 || $opt4){


			$tot_price=0;
			$option="";		
			$sql = "select * from $OptionTable where opt_no='$opt1'";
			$result=mysql_query($sql);
			$rs=mysql_fetch_array($result);
			$opt_price=$rs[opt_price];
			$opt_ea=$rs[opt_ea];
			$opt_name=$rs[opt_name];
			
			$sql = "select * from $OptionTable2 where opt_no='$opt2'";
			$result=mysql_query($sql);
			$rs2=mysql_fetch_array($result);
			$opt_price2=$rs2[opt_price];
			$opt_ea2=$rs2[opt_ea];
			$opt_name2=$rs2[opt_name];
			
			$sql = "select * from $OptionTable3 where opt_no='$opt3'";
			$result=mysql_query($sql);
			$rs3=mysql_fetch_array($result);
			$opt_price3=$rs3[opt_price];
			$opt_ea3=$rs3[opt_ea];
			$opt_name3=$rs3[opt_name];
			
			$sql = "select * from $OptionTable4 where opt_no='$opt4'";
			$result=mysql_query($sql);
			$rs4=mysql_fetch_array($result);
			$opt_ea4=$rs4[opt_ea];
			$opt_price4=$rs4[opt_price];
			$opt_name4=$rs4[opt_name];



			
			if($opt_name){
				$option = $opt_name;
			}
			if($opt_name2){
				$option .= "/".$opt_name2;
			}
			if($opt_name3){
				$option .= "/".$opt_name3;
			}
			if($opt_name4){
				$option .= "/".$opt_name4;
			}

		}
				
				
		if($opt_price > 0){
			$uprice = $opt_price;
		}else{
			$uprice = $z_price;
		}
		$tax_price = $uprice * 0.1;
		$uprice = $uprice + $tax_price;
		$count = $quantity;
		$tprice = $uprice * $count;


		$item = new ItemStack($id, $name, $tprice, $uprice, $option, $count);
		$totalMoney += $tprice;
		$queryString .= '&EC_MALL_PID=jsbtnc';
		$queryString .= '&'.$item->makeQueryString();
				

}






$totalPrice = (int)$totalMoney + (int)$shippingPrice;
$queryString .= '&TOTAL_PRICE='.$totalPrice;
//echo($queryString."<br>\n");
//exit;
$req_addr = 'ssl://checkout.naver.com';
//$req_url = 'POST /customer/api/order.nhn HTTP/1.1'; // utf-8
 $req_url = 'POST /customer/api/CP949/order.nhn HTTP/1.1'; // euc-kr
$req_host = 'checkout.naver.com';
$req_port = 443;
$nc_sock = @fsockopen($req_addr, $req_port, $errno, $errstr);
if ($nc_sock) {
fwrite($nc_sock, $req_url."\r\n" );
fwrite($nc_sock, "Host: ".$req_host.":".$req_port."\r\n" );
//fwrite($nc_sock, "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n");
fwrite($nc_sock, "Content-type: application/x-www-form-urlencoded;charset=CP949\r\n");
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
$orderId = $bodys;
} else {
// fail
echo iconv("utf-8","euc-kr",$bodys);
}
}
else {
echo "$errstr ($errno)<br>\n";
exit(-1);
//에러처리
}
//리턴받은 order_id로 주문서 page를 호출한다.
//echo ($orderId."<br>\n");
//$orderUrl =   "https://checkout.naver.com/customer/order.nhn";
$orderUrl = "https://checkout.naver.com/customer/order.nhn";
?>
<html>
<body>
<form name="frm" method="get" action="<?=$orderUrl?>">
<input type="hidden" name="ORDER_ID" value="<?=$orderId?>">
<input type="hidden" name="SHOP_ID" value="<?=$shopId?>">
<input type="hidden" name="TOTAL_PRICE" value="<?=$totalPrice?>">
</form>
</body>
<script>
<? if ($resultCode == 200) { ?>
document.frm.target = "_top";
document.frm.submit();
<? } ?>
</script>
</html>

<?
include "../../connect.php";
if($payMethod=="CARD"){
		$paymethod="bycard";
	}else{
		$paymethod="byaccount";
	}
//	echo iconv("utf-8","euc-kr",$AcquCardName);
if($payMethod=="EPAY"){
	$AcquCardName = "간편결제";
	$CardQuota="";
}

$noti = $_REQUEST;
$sql="insert noti set request = '$noti'";
mysql_query($sql);


/*
$sql="update $Order_BuyTable_Temp set authnumber='$AuthCode',field3='".iconv("utf-8","euc-kr",$AcquCardName)."',field2='$CardQuota',card_paid='t',field4='$TID' where order_num='$OID'";
mysql_query($sql);
$sql="update $Order_BuyTable_Temp2 set authnumber='$AuthCode',field3='".iconv("utf-8","euc-kr",$AcquCardName)."',field2='$CardQuota',card_paid='t',field4='$TID' where order_num='$OID'";
mysql_query($sql);*/

?>
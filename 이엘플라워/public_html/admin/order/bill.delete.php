<?
include "../lib/Mall_Admin_Session.php";
if($mode!="all"){
	$sql="delete from shop_bill where idx='$idx'";
	mysql_query($sql);
}else{
	$idxArray=stripslashes($idxArray);
	$sql="delete from shop_bill where idx in ($idxArray)";
	mysql_query($sql);
}
echo "<meta http-equiv='refresh' content='0;url=bill.list.php?page=$page&key=$key&search=$search'>";
exit;
?>
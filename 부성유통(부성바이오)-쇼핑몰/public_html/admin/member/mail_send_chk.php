<?
include "../lib/Mall_Admin_Session.php";

include "../admin_head.php";
	for($i=0; $i<sizeof($loan_number); $i++){
		$query = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and username='$loan_number[$i]'";
		$result	=	mysql_query($query,$dbconn);
		$rows	=	mysql_fetch_array($result);


	if($rows[email] != "--"){
		if($SEL){
			$SEL .= ",";
		}
		$SEL .= $rows[email];
	}

}
echo $SEL;
?>
<?
	include_once("./_common.php");
	header( "Content-type: application/vnd.ms-excel" );
	header( "Content-type: application/vnd.ms-excel; charset=utf-8");
	header( "Content-Disposition: attachment; filename = gps.".date("YmdHis").".xls" );
	header( "Content-Description: PHP4 Generated Data" );
	//등급별로 생상 나타나게 배열로 처리
	$backColorArr=array("A"=>"#ff4a4a","B"=>"#0086df","C"=>"#8ae600","D"=>"#e6eb05");

	$sql="select * from g5_gps where wr_id='$wr_id'";
	$result=sql_query($sql);
?>
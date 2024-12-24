<?
include_once("./_common.php");
for($i=1;$i<=15;$i++){
	$no=$i<10?"0".$i:$i;
	$mb_id="010424219".$no;
	$j=$i-1;
	if($i==1){
		$mb_recommend="01042421950";
	}else{
		$mb_recommend=$j<10?"0104242190".$j:"010424219".$j;
	}

	$sql="insert into g5_member set 
		mb_id = '$mb_id', 
		mb_password = '*6BB4837EB74329105EE4568DDA7DC67ED2CA2AD9', 
		mb_name = '테스트{$no}', 
		mb_nick = 'nick15765595{$i}', 
		mb_nick_date = '2019-12-17', 
		mb_today_login = '2019-12-17 14:11:57', 
		mb_datetime = '2019-12-17 14:11:57', 
		mb_ip = '183.103.22.103', 
		mb_level = '2', 
		mb_recommend = '$mb_recommend', 
		mb_login_ip = '183.103.22.103', 
		mb_open_date = '2019-12-17'
	";


}


?>
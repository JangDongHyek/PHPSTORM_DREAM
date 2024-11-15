<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

include "../include/getmartinfo.php";

$write_date = date("Y-m-d H:i:s");
$get_date = date("Y-m-d H:i:s");
$today1 = date("Y-m");

//========================= 지급될 쿠폰이 있음 지급함 ====================================
if( $flag == "goodcupon" ){
	$sql = "select * from $TicketTable where t_title='$t_title'";
}else{
	$sql = "select * from $TicketTable AS a LEFT JOIN $CustomerTable AS b ON a.t_title = b.t_title where a.t_title='$t_title' and a.t_jumin1='$t_jumin1' and a.t_jumin2='$t_jumin2' and b.cupon_check='쿠폰발급'";
}
$res = mysql_query( $sql, $dbconn );
$tot = mysql_num_rows( $res );

if( $tot > 0 ){
	$row = mysql_fetch_array($res);

	$t_uid = $row[t_uid];
	$mart_id = $row[mart_id];
	$provider_id = $row[provider_id];
	$t_id = $row[t_id];
	$t_title = $row[t_title];
	$t_money = $row[t_money];
	$t_name = $row[t_name];
	$t_jumin1 = $row[t_jumin1];
	$t_jumin2 = $row[t_jumin2];
	$t_date = $row[t_date];
	$t_regdate = $row[t_regdate];
	$t_ok = $row[t_ok];

	if( $res ){
		mysql_free_result( $res );
	}

	if( $today1 > $t_date ){
		echo "
		<script>
		window.alert('{$t_title} 번호는 유효기간이 지난 쿠폰입니다.');
		history.go(-1);
		</script>
		";
		exit;
	}

	if( $t_ok == "y" ){
		echo "
		<script>
		window.alert('{$t_title} 번호는 지급된 쿠폰입니다.');
		history.go(-1);
		</script>
		";
		exit;
	}

	$mem_sql = "select name from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$mem_res = mysql_query($mem_sql, $dbconn);
	$mem_row = mysql_fetch_array( $mem_res );
	$mem_name = $mem_row[name];

	if( $mem_res ){
		mysql_free_result( $mem_res );
	}
	//========================= 쿠폰을 적립금으로 지급함 =================================
	$content = "$mem_name $t_title 쿠폰 지급";
	$bonus_sql = "insert into $BonusTable ( num, mart_id, provider_id, t_title, id, write_date, bonus, content, mode ) values ( '', '$mart_id', '$provider_id', '$t_title', '$UnameSess', '$write_date', '$t_money', '$content', 'g')";
	$bonus_res = mysql_query($bonus_sql, $dbconn);

	if( !$bonus_res ){
		echo "
		<script>
		window.alert('쿠폰을 적립금으로 지급하는데 실패했습니다. 관리자에게 문의바랍니다');
		history.go(-1);
		</script>
		";
	}

	//========================= 지급된 적립금을 회원테이블에 업데이트 함 =================
	$bonus_sql1 = "update $Mart_Member_NewTable set bonus_total=bonus_total + $t_money, customer='y', provider_id='$provider_id' where username='$UnameSess' and mart_id='$mart_id'";
	$bonus_res1 = mysql_query($bonus_sql1, $dbconn);
	if( !$bonus_res1 ){
		echo "
		<script>
		window.alert('적립금을 회원에게 지급하는데 실패했습니다. 관리자에게 문의바랍니다');
		history.go(-1);
		</script>
		";
	}
	//========================= 쿠폰이 지급되면 체크함 ===================================
	$sql1 = "update $TicketTable set t_id='$UnameSess', t_ok='y', t_getdate='$get_date' where t_uid='$t_uid'";
	$res1= mysql_query( $sql1, $dbconn );
	if( !$res1 ){
		echo "
		<script>
		window.alert('쿠폰 업데이트에 실패했습니다. 관리자에게 문의바랍니다');
		history.go(-1);
		</script>
		";
		exit;
	}else{
		echo "<meta http-equiv='refresh' content='0; URL=coupon_ok.html?t_title=$t_title'>";
		exit;
	}
}else{
	echo "
		<script>
		window.alert('지급된 쿠폰이 없습니다. 쿠폰번호와 가입자 주문번호를 다시 확인바랍니다.');
		history.go(-1);
		</script>
	";
	exit;
}
//========================================================================================

mysql_close($dbconn);
?>
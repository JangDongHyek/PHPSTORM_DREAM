<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";

include "../include/getmartinfo.php";

$write_date = date("Y-m-d H:i:s");
$get_date = date("Y-m-d H:i:s");
$today1 = date("Y-m");

//========================= ���޵� ������ ���� ������ ====================================
if( $flag == "goodcupon" ){
	$sql = "select * from $TicketTable where t_title='$t_title'";
}else{
	$sql = "select * from $TicketTable AS a LEFT JOIN $CustomerTable AS b ON a.t_title = b.t_title where a.t_title='$t_title' and a.t_jumin1='$t_jumin1' and a.t_jumin2='$t_jumin2' and b.cupon_check='�����߱�'";
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
		window.alert('{$t_title} ��ȣ�� ��ȿ�Ⱓ�� ���� �����Դϴ�.');
		history.go(-1);
		</script>
		";
		exit;
	}

	if( $t_ok == "y" ){
		echo "
		<script>
		window.alert('{$t_title} ��ȣ�� ���޵� �����Դϴ�.');
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
	//========================= ������ ���������� ������ =================================
	$content = "$mem_name $t_title ���� ����";
	$bonus_sql = "insert into $BonusTable ( num, mart_id, provider_id, t_title, id, write_date, bonus, content, mode ) values ( '', '$mart_id', '$provider_id', '$t_title', '$UnameSess', '$write_date', '$t_money', '$content', 'g')";
	$bonus_res = mysql_query($bonus_sql, $dbconn);

	if( !$bonus_res ){
		echo "
		<script>
		window.alert('������ ���������� �����ϴµ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�');
		history.go(-1);
		</script>
		";
	}

	//========================= ���޵� �������� ȸ�����̺� ������Ʈ �� =================
	$bonus_sql1 = "update $Mart_Member_NewTable set bonus_total=bonus_total + $t_money, customer='y', provider_id='$provider_id' where username='$UnameSess' and mart_id='$mart_id'";
	$bonus_res1 = mysql_query($bonus_sql1, $dbconn);
	if( !$bonus_res1 ){
		echo "
		<script>
		window.alert('�������� ȸ������ �����ϴµ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�');
		history.go(-1);
		</script>
		";
	}
	//========================= ������ ���޵Ǹ� üũ�� ===================================
	$sql1 = "update $TicketTable set t_id='$UnameSess', t_ok='y', t_getdate='$get_date' where t_uid='$t_uid'";
	$res1= mysql_query( $sql1, $dbconn );
	if( !$res1 ){
		echo "
		<script>
		window.alert('���� ������Ʈ�� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�');
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
		window.alert('���޵� ������ �����ϴ�. ������ȣ�� ������ �ֹ���ȣ�� �ٽ� Ȯ�ιٶ��ϴ�.');
		history.go(-1);
		</script>
	";
	exit;
}
//========================================================================================

mysql_close($dbconn);
?>
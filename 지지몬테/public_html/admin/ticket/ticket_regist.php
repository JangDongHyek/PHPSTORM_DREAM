<?
include "../lib/Mall_Admin_Session.php";
?>
<?
/** //================== SMS DB ���� ������ �ҷ��� ===========================================
include "../../connect_sms.php";**/
include "../../market/include/getmartinfo.php";

$tl_regdate = date("Y-m-d H:i:s");
$tl_getdate = date("Y-m-d H:i:s");//ȸ��������Ʈ ������

$tl_money = str_replace( ",", "", $tl_money );
$tl_memo = str_replace( "\n", "<br>", $tl_memo );

if($flag == "insert"){						
	$sql = "insert into $TicketListTable ( tl_uid, mart_id, provider_id, tl_money, tl_content, tl_memo, tl_ok,	tl_regdate ) values ( '', '$mart_id', '$provider_id', '$tl_money', '$tl_content', '$tl_memo', '��û', '$tl_regdate' )";
	$result = mysql_query($sql, $dbconn);
	if( $result ){
		echo "
			<script>
			alert('����߽��ϴ�.');
			</script>
			<meta http-equiv='refresh' content='0; URL= ticket_list.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>
		";
	}else{
		echo ("
			<script>
			alert('����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "update"){
	if( ($tl_ok_old == "��û") && ($tl_ok == "����") ){
		$SQL = "update $TicketListTable set tl_money='$tl_money', tl_memo='$tl_memo', tl_ok='$tl_ok', tl_getdate='$tl_getdate' where tl_uid='$tl_uid'";

		/** //================== SMS ���� ====================================================
		//================== ȸ���� ���̵� �ҷ��� ======================================
		$pro_sql = "select * from $TicketListTable where tl_uid='$tl_uid'";
		$pro_res = mysql_query( $pro_sql, $dbconn );
		$pro_row = mysql_fetch_array($pro_res);
		$provider_id = $pro_row[provider_id];

		//================== ȸ���� ������ �ҷ��� ========================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone = "$pro_phon";//�޴� ��� ��ȣ
		$tran_callback = "$shop_tel";//������ ��� ��ȣ
		$tran_msg = "$pro_name"." ȸ����� "."$tl_money"." ����Ʈ�� ���޵Ǿ����ϴ�.[$mart_id]";

		$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
		$sms_res = mysql_query( $sms_sql, $connect );

		if( !$sms_res ){
			echo "
			<script>
				alert('���� ���� ����');
			</script>
			";
		}**/
		//================================================================================
	}else{
		$SQL = "update $TicketListTable set tl_money='$tl_money', tl_memo='$tl_memo', tl_ok='$tl_ok' where tl_uid='$tl_uid'";
	}
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= ticket_view.php?tl_uid=$tl_uid&mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "ok"){
	for($i=0; $i<count($checkSel); $i++){
		$check_values = explode("#", $checkSel[$i]);
		$tl_uid_ok = $check_values[0];

		$SQL = "update $TicketListTable set tl_ok='����', tl_getdate='$tl_getdate' where tl_uid='$tl_uid_ok'";
		$dbresult = mysql_query($SQL, $dbconn);

		//================== ȸ���� ���̵� �ҷ��� ======================================
		$pro_sql = "select * from $TicketListTable where tl_uid='$tl_uid_ok'";
		$pro_res = mysql_query( $pro_sql, $dbconn );
		$pro_row = mysql_fetch_array($pro_res);
		$provider_id = $pro_row[provider_id];
		$tl_money =  $pro_row[tl_money];

		//================== ȸ���� �޴��� ��ȣ�� �ҷ��� =================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone = "$pro_phon";//�޴� ��� ��ȣ
		$tran_callback = "$shop_tel";//������ ��� ��ȣ
		$tran_msg = "$pro_name"." ȸ����� "."$tl_money"." ����Ʈ�� ���޵Ǿ����ϴ�.[$mart_id]";

		$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
		$sms_res = mysql_query( $sms_sql, $connect );

		if( !$sms_res ){
			echo "
			<script>
				alert('���� ���� ����');
			</script>
			";
		}
		//================================================================================
	}

	if( $dbresult ){
		if( $mo == 'view' ){
			echo "
				<script>
				alert('ȸ��������Ʈ�� �����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= ticket_view.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page&sort=$sort&sort2=$sort2&tl_uid=$tl_uid'>
			";

		}else{
			echo "
				<script>
				alert('ȸ��������Ʈ�� �����߽��ϴ�.');
				</script>
				<meta http-equiv='refresh' content='0; URL= ticket_list.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page&sort=$sort&sort2=$sort2'>
			";
		}
	}else{
		echo ("
			<script>
			alert('ȸ��������Ʈ�� �����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}

if($flag=="del"){	
	$SQL = "delete from $TicketListTable where tl_uid='$tl_uid'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= ticket_list.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>";
	}else{
		echo ("
			<script>
			alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>
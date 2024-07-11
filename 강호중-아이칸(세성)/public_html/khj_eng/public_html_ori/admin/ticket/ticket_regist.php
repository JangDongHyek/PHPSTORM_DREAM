<?
include "../lib/Mall_Admin_Session.php";
?>
<?
/** //================== SMS DB 설정 파일을 불러옴 ===========================================
include "../../connect_sms.php";**/
include "../../market/include/getmartinfo.php";

$tl_regdate = date("Y-m-d H:i:s");
$tl_getdate = date("Y-m-d H:i:s");//회원사포인트 지급일

$tl_money = str_replace( ",", "", $tl_money );
$tl_memo = str_replace( "\n", "<br>", $tl_memo );

if($flag == "insert"){						
	$sql = "insert into $TicketListTable ( tl_uid, mart_id, provider_id, tl_money, tl_content, tl_memo, tl_ok,	tl_regdate ) values ( '', '$mart_id', '$provider_id', '$tl_money', '$tl_content', '$tl_memo', '신청', '$tl_regdate' )";
	$result = mysql_query($sql, $dbconn);
	if( $result ){
		echo "
			<script>
			alert('등록했습니다.');
			</script>
			<meta http-equiv='refresh' content='0; URL= ticket_list.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page'>
		";
	}else{
		echo ("
			<script>
			alert('등록하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "update"){
	if( ($tl_ok_old == "신청") && ($tl_ok == "승인") ){
		$SQL = "update $TicketListTable set tl_money='$tl_money', tl_memo='$tl_memo', tl_ok='$tl_ok', tl_getdate='$tl_getdate' where tl_uid='$tl_uid'";

		/** //================== SMS 전송 ====================================================
		//================== 회원사 아이디를 불러옴 ======================================
		$pro_sql = "select * from $TicketListTable where tl_uid='$tl_uid'";
		$pro_res = mysql_query( $pro_sql, $dbconn );
		$pro_row = mysql_fetch_array($pro_res);
		$provider_id = $pro_row[provider_id];

		//================== 회원사 정보를 불러옴 ========================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone = "$pro_phon";//받는 사람 번호
		$tran_callback = "$shop_tel";//보내는 사람 번호
		$tran_msg = "$pro_name"." 회원사님 "."$tl_money"." 포인트가 지급되었습니다.[$mart_id]";

		$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
		$sms_res = mysql_query( $sms_sql, $connect );

		if( !$sms_res ){
			echo "
			<script>
				alert('문자 전송 실패');
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
			alert('수정하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}

if($flag == "ok"){
	for($i=0; $i<count($checkSel); $i++){
		$check_values = explode("#", $checkSel[$i]);
		$tl_uid_ok = $check_values[0];

		$SQL = "update $TicketListTable set tl_ok='승인', tl_getdate='$tl_getdate' where tl_uid='$tl_uid_ok'";
		$dbresult = mysql_query($SQL, $dbconn);

		//================== 회원사 아이디를 불러옴 ======================================
		$pro_sql = "select * from $TicketListTable where tl_uid='$tl_uid_ok'";
		$pro_res = mysql_query( $pro_sql, $dbconn );
		$pro_row = mysql_fetch_array($pro_res);
		$provider_id = $pro_row[provider_id];
		$tl_money =  $pro_row[tl_money];

		//================== 회원사 휴대폰 번호를 불러옴 =================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		$tr_senddate = date("YmdHis");
		$tran_phone = "$pro_phon";//받는 사람 번호
		$tran_callback = "$shop_tel";//보내는 사람 번호
		$tran_msg = "$pro_name"." 회원사님 "."$tl_money"." 포인트가 지급되었습니다.[$mart_id]";

		$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
		$sms_res = mysql_query( $sms_sql, $connect );

		if( !$sms_res ){
			echo "
			<script>
				alert('문자 전송 실패');
			</script>
			";
		}
		//================================================================================
	}

	if( $dbresult ){
		if( $mo == 'view' ){
			echo "
				<script>
				alert('회원사포인트를 승인했습니다.');
				</script>
				<meta http-equiv='refresh' content='0; URL= ticket_view.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page&sort=$sort&sort2=$sort2&tl_uid=$tl_uid'>
			";

		}else{
			echo "
				<script>
				alert('회원사포인트를 승인했습니다.');
				</script>
				<meta http-equiv='refresh' content='0; URL= ticket_list.php?mode=$mode&select_key=$select_key&input_key=$input_key&page=$page&sort=$sort&sort2=$sort2'>
			";
		}
	}else{
		echo ("
			<script>
			alert('회원사포인트를 승인하는데 실패했습니다.');
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
			alert('삭제하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>
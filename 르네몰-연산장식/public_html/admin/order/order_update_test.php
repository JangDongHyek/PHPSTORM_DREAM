<?
include "../lib/Mall_Admin_Session.php";
?>
<?
/** //================== SMS DB 설정 파일을 불러옴 ===========================================
include "../../connect_sms.php";**/
include "../../market/include/getmartinfo.php";

if($update_flag == 'update_all'){	
	for($i=0; $i<count($order_pro_no); $i++){

		if($opt1_quantity[$i] == ""){
			$where_opts .= "";
		}else{
			$where_opts .= ", opt1_quantity_total='".$opt1_quantity[$i]."'";
		}
		if($opt2_quantity[$i] == ""){
			$where_opts .= "";
		}else{
			$where_opts .= ", opt2_quantity_total='".$opt2_quantity[$i]."'";
		}
		if($opt3_quantity[$i] == ""){
			$where_opts .= "";
		}else{
			$where_opts .= ", opt3_quantity_total='".$opt3_quantity[$i]."'";
		}
		$SQL = "update $Order_ProTable set quantity='$quantity[$i]' $where_opts where order_pro_no='$order_pro_no[$i]'";
		$dbresult = mysql_query($SQL, $dbconn);
		$where_opts = "";

		if( !$dbresult ){
			echo "
				<script>
				window.alert('수량 변경에 실패했습니다');
				self.close();
				</script>
			";
			exit;
		}
	
		$SQL1 = "update $Order_ProTable set status='$good_status[$i]' where order_pro_no='$order_pro_no[$i]'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		if( !$dbresult1 ){
			echo "
				<script>
				window.alert('주문상태 저장에 실패했습니다');
				self.close();
				</script>
			";
			exit;
		}

		$SQL2 = "update $Order_ProTable set pro_freight_code='$pro_freight_code[$i]' where order_pro_no='$order_pro_no[$i]'";
		$dbresult2 = mysql_query($SQL2, $dbconn);

		if( !$dbresult2 ){
			echo "
				<script>
				window.alert('송장번호 저장에 실패했습니다');
				self.close();
				</script>
			";
			exit;
		}

		$SQL3 = "update $Order_ProTable set pro_delivery='$pro_delivery[$i]' where order_pro_no='$order_pro_no[$i]'";
		$dbresult3 = mysql_query($SQL3, $dbconn);

		if( !$dbresult3 ){
			echo "
				<script>
				window.alert('택배회사 저장에 실패했습니다');
				self.close();
				</script>
			";
			exit;
		}

		/**if( $good_status_old[$i] != '3' && $good_status[$i] == '3' ){ //배송완료일때 sms보내기
			//구매자 정보 알아내기
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== 입점몰 정보를 불러옴 ========================================
			$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id[$i]'";
			$phon_res = mysql_query($phon_sql, $dbconn);
			$phon_row = mysql_fetch_array($phon_res);
			$pro_phon = $phon_row[tel2];
			$pro_name = $phon_row[name];

			//================== SMS 전송 ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//받는 사람 번호
			$tran_callback = "$pro_phon";//보내는 사람 번호
			$tran_msg = "$name"."님이 주문하신 상품이 배송되었습니다.송장번호 "."$pro_freight_code[$i]"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('문자 전송 실패');
				</script>
				";
			}
			//============================================================================	
		}**/
	}//for end
		
	$up_sql = "update $Order_BuyTable set name='$name', tel1='$tel1', tel2='$tel2', email='$email', freight_code='$freight_code', deposite='$deposite', delivery='$delivery', status = '$status', money_sender = '$money_sender', pay_day = '$pay_day', account_no='$account_no', keeper_message='$keeper_message' where order_num='$order_num' and mart_id='$mart_id'";
	$up_res = mysql_query($up_sql, $dbconn);
	
	if( !$up_res ){
		echo "
		<script>
			alert('주문상태 저장에 실패했습니다!');
			self.close();
		</script>
		";
		exit;
	}

	if($status == 3 && $bonus_ok == 't'){ //배송완료일때만, 포인트 사용할 때만 포인트 추가
		
		//기존 포인트 테이블에 데이타가 없을때만 
		$SQL = "select * from $BonusTable where order_num = '$order_num' and mart_id='$mart_id' and mode='p'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);

		if($numRows == 0){
			//구매자 id 알아내기
			$id = '';
			$SQL = "select id from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if($numRows > 0){
				$id = mysql_result($dbresult,0,0);
			}
			
			if(!empty($id)){//회원구매에만 적용
				//포인트 지급
				$SQL = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);
				$numRows = mysql_num_rows($dbresult);
							
				for ($i=0; $i<$numRows; $i++) {
					mysql_data_seek($dbresult,$i);
					$ary = mysql_fetch_array($dbresult);
					$order_num = $ary["order_num"];
					$order_pro_no = $ary["order_pro_no"];
					$item_name = $ary["item_name"];
					$quantity = $ary["quantity"];
					$bonus = $ary["bonus"];
					if($bonus > 0){
						$bonus_sum = $bonus * $quantity;
						$content = "주문번호:".$order_num."\n제품명:".$item_name."\n수량:".$quantity; 
						
						$write_date = date("Ymd H:i:s");
												
						$SQL2 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) ".
						"values ('$mart_id', '$id', '$write_date', $bonus_sum, '$content', '$order_num', 'p')";
						$dbresult2 = mysql_query($SQL2, $dbconn);

						$SQL3 = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus_sum 
						where username='$id' and mart_id='$mart_id'";
						$dbresult3 = mysql_query($SQL3, $dbconn);
					}
				}
			}	
		}
	}

	if($status_old != '3' && $status == '3'){ //배송완료일때만, 구매총액 추가
		$id = '';
		//구매자 id 알아내기
		$SQL = "select id from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$id = mysql_result($dbresult,0,0);
		}
		
		if(!empty($id)){
			//구매총액변경
			$SQL = "select * from $Order_ProTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			$sum_total = 0;
			for ($i=0; $i<$numRows; $i++) {
				mysql_data_seek($dbresult,$i);
				$ary = mysql_fetch_array($dbresult);
				$z_price_tmp = $ary["z_price"];
				$quantity_tmp = $ary["quantity"];
				$sum_tmp = $z_price_tmp * $quantity_tmp;
				$sum_total += $sum_tmp;
			}
			$SQL = "update $Mart_Member_NewTable set money_total = money_total + $sum_total
			where username='$id' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
		}
		$send_date = date("Y-m-d H:i:s");
		$SQL = "update $Order_BuyTable set send_date='$send_date' where order_num='$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);	
	}	

	if(($status_old != '5' && $status == '5')||($status_old != '4' && $status == '4')||($status_old != '10' && $status == '10')){ //주문취소시 보너스에서 빼기
		
		//사용한 보너스 복구
		$SQL = "select id, use_bonus_tot from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		
		$SQL1 = "select * from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		
		if($numRows > 0 &&$numRows1>0){
			
			$id = mysql_result($dbresult,0,0);
			$use_bonus_tot = mysql_result($dbresult,0,1);
			
			if(!empty($id)&&!empty($use_bonus_tot)){
				//회원테이블에서 보너스 총액 복구
				$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);				
				
				//보너스 테이블에 취소된 주문의 사용포인트 다시입력
				$write_date = date("Ymd H:i:s");
				$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$id', '$write_date', $use_bonus_tot, '주문번호 : $order_num_query 주문취소', '$order_num_query', 'c')";
				$dbresult = mysql_query($SQL, $dbconn);
			}	
		}		
	}

	if($status_old != '10' && $status == '10'){ //주문취소시 보너스에서 빼기
		
		//사용한 보너스 복구
		$SQL = "select id, use_bonus_tot from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		
		$SQL1 = "select * from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		$numRows1 = mysql_num_rows($dbresult1);
		
		if($numRows > 0 &&$numRows1>0){
			
			$id = mysql_result($dbresult,0,0);
			$use_bonus_tot = mysql_result($dbresult,0,1);
			
			if(!empty($id)&&!empty($use_bonus_tot)){
				//회원테이블에서 보너스 총액 복구
				$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);				
				
				//보너스 테이블에 취소된 주문의 사용포인트 다시입력
				$write_date = date("Ymd H:i:s");
				$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num) values ('$mart_id', '$id', '$write_date', $use_bonus_tot, '주문번호 : <a href=\"../stat/order_view.html?mart_id=$mart_id&order_num=$order_num_query\">$order_num_query</a> 주문취소', '$order_num')";
				$dbresult = mysql_query($SQL, $dbconn);
			}	
		}
		echo "
		<script>
		alert(\"수정되었습니다.\\n\\n결제관리 사이트에서 승인 취소하십시오.\");
		window.close();
		window.opener.location.reload();
		</script>
		";
		exit;
	}

	if( $status_old != '2' && $status == '2' ){ //입금완료시 ip, 시간 기록하기
		$ipgum_date = date("Y-m-d H:i:s");
		$SQL = "update $Order_BuyTable set ipgum_date='$ipgum_date', ipgum_ip='$REMOTE_ADDR' where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	if(($status_old != '5' && $status == '5')||($status_old != '4' && $status == '4')||($status_old != '10' && $status == '10')){ //주문취소시 보너스에서 빼기//결제 취소 주문취소 환불시에 재고 복구
		$sql="select * from $Order_ProTable where order_num='$order_num'";
		$result=mysql_query($sql);
		while($rs=mysql_fetch_array($result)){
			$item_no2=$rs[item_no];
			$quantity=$rs[quantity];
			$sql="select * from $ItemTable where item_no='$item_no2'";
			$result2=mysql_query($sql);
			$rs2=mysql_fetch_array($result2);
			$jaego_use=$rs2[jaego_use];
			if($jaego_use=="1"){
				$sql="update $ItemTable set jaego=jaego+$quantity where item_no='$item_no2'";
				mysql_query($sql);
			}else{}
		}
	}else if(($status_old == '5' && $status != '5')||($status_old == '4' && $status != '4')||($status_old == '10' && $status != '10')){
		$sql="select * from $Order_ProTable where order_num='$order_num'";
		$result=mysql_query($sql);
		while($rs=mysql_fetch_array($result)){
			$item_no2=$rs[item_no];
			$quantity=$rs[quantity];
			$sql="select * from $ItemTable where item_no='$item_no2'";
			$result2=mysql_query($sql);
			$rs2=mysql_fetch_array($result2);
			$jaego_use=$rs2[jaego_use];
			if($jaego_use=="1"){
				$sql="update $ItemTable set jaego=jaego-$quantity where item_no='$item_no2'";
				mysql_query($sql);
			}else{}
		}
	}
	/**if( $status_old != '4' && $status == '4' ){ //환불시 sms보내기
		//구매자 정보 알아내기
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== SMS 전송 ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//받는 사람 번호
		$tran_callback = "$shop_tel";//보내는 사람 번호
		$tran_msg = "$name"."님이 주문하신 상품이 환불되었습니다.주문번호 "."$order_num"."[$mart_id]";

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
	}**/
	
	/**if( $status_old != '5' && $status == '5' ){ //주문취소시 sms보내기
		//구매자 정보 알아내기
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== SMS 전송 ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//받는 사람 번호
		$tran_callback = "$shop_tel";//보내는 사람 번호
		$tran_msg = "$name"."님이 주문하신 상품이 취소되었습니다.주문번호 "."$order_num"."[$mart_id]";

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
	}**/

	/**if( $status_old != '6' && $status == '6' ){ //배송중일때 sms보내기
		//구매자 정보 알아내기
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== 입점몰 정보를 불러옴 ========================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$Mall_Admin_ID'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		//================== SMS 전송 ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//받는 사람 번호
		$tran_callback = "$pro_phon";//보내는 사람 번호
		$tran_msg = "$name"."님이 주문하신 상품이 배송되었습니다.주문번호 "."$order_num"."[$mart_id]";

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
	}**/
	
	echo "
		<script>
		alert(\"수정되었습니다.\");
		window.close();
		window.opener.location.reload();
		</script>
	";
	exit;
}
if($update_flag == 'send'){
	for($i=0; $i<count($provider_id); $i++) {
		$SQL = "update $Order_ProTable set account_no = $account_no[$i] where order_num='$order_num' and provider_id='$provider_id[$i]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$SQL = "update $Order_ProTable set status = '2' where order_num='$order_num' and provider_id='$provider_id[$i]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "
	<script>
	alert(\"공급처로 주문정보를 보냈습니다..\");
	window.close();
	window.opener.location.reload();
	</script>
	";
	exit;
}

if($update_flag=='add_memo'){
	$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id='$provider_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$SQL = "update $Gnt_MemoTable set content = '$content' where order_num = '$order_num' and mart_id='$mart_id' and provider_id='$provider_id'";
	}			
	else{
		$date = date("Y-m-d H:i:s");
		$SQL = "insert into $Gnt_MemoTable (order_num, mart_id, provider_id, content, date) 
	values('$order_num','$mart_id', '$provider_id','$content','$date')";
  }
	$dbresult = mysql_query($SQL, $dbconn);

	echo "
	<script>
	alert(\"메모가 수정되었습니다.\");
	window.close();
	window.opener.location.reload();
	</script>
	";
	exit;
}
if($update_flag=='add_mymemo'){
	$SQL = "select * from $Gnt_MemoTable where order_num = '$order_num' and mart_id='$mart_id' and provider_id=''";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$SQL = "update $Gnt_MemoTable set content = '$content' where order_num = '$order_num' and mart_id='$mart_id' and provider_id=''";
	}			
	else{
		$date = date("Y-m-d H:i:s");
		$SQL = "insert into $Gnt_MemoTable (order_num, mart_id, provider_id, content, date) 
	values('$order_num','$mart_id', '','$content','$date')";
  }
	$dbresult = mysql_query($SQL, $dbconn);

	echo "
	<script>
	alert(\"메모가 수정되었습니다.\");
	window.close();
	window.opener.location.reload();
	</script>
	";
	exit;
}
if($update_flag=='add_secretmemo'){
	
	$SQL = "update $Order_BuyTable set secret_message = '$secret_message' where order_num = '$order_num' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	echo "
	<script>
	alert(\"메모가 수정되었습니다.\");
	window.close();
	window.opener.location.reload();
	</script>
	";
	exit;
}
if($update_flag=='jaego_back'){

	$SQL = "select jaego_back from $Order_BuyTable where order_num='$order_num'";
	$dbresult = mysql_query($SQL, $dbconn);
	$jaego_back = mysql_result($dbresult, 0, 0);
	
	if($jaego_back == '0'){
		$SQL = "select item_no,quantity from $Order_ProTable where order_num = '$order_num'";
		//echo "sql=$SQL";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
				
		for ($i=0; $i<$numRows; $i++) {
			$item_no = mysql_result($dbresult,$i,0);
			$quantity = mysql_result($dbresult,$i,1);
			
			$SQL1 = "select jaego,jaego_use from $ItemTable where item_no=$item_no";
			$dbresult1 = mysql_query($SQL1, $dbconn);
			$jaego = mysql_result($dbresult1, 0, 0);
			$jaego_use = mysql_result($dbresult1, 0, 1);
			if($jaego_use == '1'){
				$jaego_new = $jaego + $quantity;
				$SQL2 = "update $ItemTable set jaego = $jaego_new where item_no = $item_no";
				$dbresult2 = mysql_query($SQL2, $dbconn);
			}	
		}
		$SQL = "update $Order_BuyTable set jaego_back = '1' where order_num = '$order_num'";
		$dbresult = mysql_query($SQL, $dbconn);
	}
	echo "
	<script>
	alert(\"재고수량이 복구되었습니다.\");
	window.close();
	window.opener.location.reload();
	</script>
	";
	exit;
}	
?>
<?
mysql_close($dbconn);
?>
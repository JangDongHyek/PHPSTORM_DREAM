<?
include "../lib/Mall_Admin_Session.php";
?>
<?
/** //================== SMS DB ���� ������ �ҷ��� ===========================================
include "../../connect_sms.php";**/
include "../../market/include/getmartinfo.php";

if($update_flag == 'update_all'){	
	for($i=0; $i<count($order_pro_no); $i++){
		$SQL = "select * from $Order_ProTable where order_pro_no='$order_pro_no[$i]'";
		$result=mysql_query($SQL);
		if(!$result){
			echo mysql_error();
			echo mysql_errno();
			exit;
		}
		$rs=mysql_fetch_array($result);
		$opt=$rs[opt];
		$opt2=$rs[opt2];
		$opt3=$rs[opt3];
		$opt4=$rs[opt4];
		$quantity2=$rs[quantity];
		$item_no2=$rs[item_no];
		
		$sql="select if_opt_jaego,if_opt_jaego2,if_opt_jaego3,if_opt_jaego4 from $ItemTable where item_no='$item_no2'";
		$i_result=mysql_query($sql);
		$i_rs=mysql_fetch_array($i_result);

		$if_opt_jaego=$i_rs[if_opt_jaego];
		$if_opt_jaego2=$i_rs[if_opt_jaego2];
		$if_opt_jaego3=$i_rs[if_opt_jaego3];
		$if_opt_jaego4=$i_rs[if_opt_jaego4];

		
		if($if_opt_jaego=="1"){
			$sql="update $OptionTable set opt_ea=opt_ea+$quantity2 where opt_no='$opt'";
			mysql_query($sql);
			$sql="update $OptionTable set opt_ea=opt_ea-$quantity[$i] where opt_no='$opt'";
			mysql_query($sql);
		}
		if($if_opt_jaego2=="1"){
			$sql="update $OptionTable2 set opt_ea=opt_ea+$quantity2 where opt_no='$opt2'";
			mysql_query($sql);
			$sql="update $OptionTable2 set opt_ea=opt_ea-$quantity[$i] where opt_no='$opt2'";
			mysql_query($sql);
		}
		if($if_opt_jaego3=="1"){
			$sql="update $OptionTable3 set opt_ea=opt_ea+$quantity2 where opt_no='$opt3'";
			mysql_query($sql);
			$sql="update $OptionTable3 set opt_ea=opt_ea-$quantity[$i] where opt_no='$opt3'";
			mysql_query($sql);
		}
		if($if_opt_jaego4=="1"){
			$sql="update $OptionTable4 set opt_ea=opt_ea+$quantity2 where opt_no='$opt4'";
			mysql_query($sql);
			$sql="update $OptionTable4 set opt_ea=opt_ea-$quantity[$i] where opt_no='$opt4'";
			mysql_query($sql);
		}
		$SQL = "update $Order_ProTable set quantity = $quantity[$i] where order_pro_no='$order_pro_no[$i]'";
		$dbresult = mysql_query($SQL, $dbconn);

		if( !$dbresult ){
			echo "
				<script>
				window.alert('���� ���濡 �����߽��ϴ�');
				self.close();
				</script>
			";
			exit;
		}
	
		$SQL1 = "update $Order_ProTable set status='$status' where order_pro_no='$order_pro_no[$i]'";
		$dbresult1 = mysql_query($SQL1, $dbconn);
		if( !$dbresult1 ){
			echo "
				<script>
				window.alert('�ֹ����� ���忡 �����߽��ϴ�');
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
				window.alert('�����ȣ ���忡 �����߽��ϴ�');
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
				window.alert('�ù�ȸ�� ���忡 �����߽��ϴ�');
				self.close();
				</script>
			";
			exit;
		}

		/**if( $good_status_old[$i] != '3' && $good_status[$i] == '3' ){ //��ۿϷ��϶� sms������
			//������ ���� �˾Ƴ���
			$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$id = mysql_result($dbresult,0,0);
			$tel2 = mysql_result($dbresult,0,1);
			$name = mysql_result($dbresult,0,2);

			//================== ������ ������ �ҷ��� ========================================
			$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id[$i]'";
			$phon_res = mysql_query($phon_sql, $dbconn);
			$phon_row = mysql_fetch_array($phon_res);
			$pro_phon = $phon_row[tel2];
			$pro_name = $phon_row[name];

			//================== SMS ���� ================================================
			$tr_senddate = date("YmdHis");
			$tran_phone = "$tel2";//�޴� ��� ��ȣ
			$tran_callback = "$pro_phon";//������ ��� ��ȣ
			$tran_msg = "$name"."���� �ֹ��Ͻ� ��ǰ�� ��۵Ǿ����ϴ�.�����ȣ "."$pro_freight_code[$i]"."[$mart_id]";

			$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
			$sms_res = mysql_query( $sms_sql, $connect );

			if( !$sms_res ){
				echo "
				<script>
					alert('���� ���� ����');
				</script>
				";
			}
			//============================================================================	
		}**/
	}//for end
	$pay_day = date("Y-m-d H:i:s");
	$up_sql = "update $Order_BuyTable set name='$name', tel1='$tel1', tel2='$tel2', email='$email', freight_code='$freight_code', deposite='$deposite', delivery='$delivery', status = '$status', money_sender = '$money_sender', payment_date = '$pay_day', account_no='$account_no', keeper_message='$keeper_message' where order_num='$order_num' and mart_id='$mart_id'";
	$up_res = mysql_query($up_sql, $dbconn);
	
	if( !$up_res ){
		echo "
		<script>
			alert('�ֹ����� ���忡 �����߽��ϴ�!');
			self.close();
		</script>
		";
		exit;
	}

	if($status == 3 && $bonus_ok == 't'){ //��ۿϷ��϶���, ����Ʈ ����� ���� ����Ʈ �߰�

		//������ id �˾Ƴ���
		$id = '';
		$SQL = "select id, paymethod from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$row = mysql_fetch_array($dbresult);
			$id = $row["id"];
			$paymethod = $row["paymethod"];
		}
		
		//���� ����Ʈ ���̺� ����Ÿ�� �������� 
		$SQL = "select * from $BonusTable where order_num = '$order_num' and mart_id='$mart_id' and mode='p'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);

		if($numRows == 0 && !empty($id)){
			
			//����Ʈ ����
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
					$content = "�ֹ���ȣ:".$order_num."\n��ǰ��:".$item_name."\n����:".$quantity; 
					
					$write_date = date("Y-m-d H:i:s");
												
					$SQL2 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) ".
						"values ('$mart_id', '$id', '$write_date', $bonus_sum, '$content', '$order_num', 'p')";
					$dbresult2 = mysql_query($SQL2, $dbconn);

					$SQL3 = "update $Mart_Member_NewTable set bonus_total = bonus_total + $bonus_sum 
						where username='$id' and mart_id='$mart_id'";
					$dbresult3 = mysql_query($SQL3, $dbconn);
				}
			}
		}			

		if($by_cash_bonus_ok=="t" && ($paymethod == "byonline" || $paymethod == "byaccount"))
		{
			//���� ����Ʈ ���̺� ����Ÿ�� �������� 
			$SQL = "select * from $BonusTable where order_num = '$order_num' and mart_id='$mart_id' and mode='cs'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			if(!$numRows)
			{
				$content = "�ֹ���ȣ:".$order_num."\n���ݱ��Ž� �߰�����Ʈ"; 
							
				$write_date = date("Y-m-d H:i:s");
													
				$SQL2 = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) ".
									"values ('$mart_id', '$id', '$write_date', $init_by_cash_bonus , '$content', '$order_num', 'cs')";
				$dbresult2 = mysql_query($SQL2, $dbconn);

				$SQL3 = "update $Mart_Member_NewTable set bonus_total = bonus_total + $init_by_cash_bonus  
				where username='$id' and mart_id='$mart_id'";
				$dbresult3 = mysql_query($SQL3, $dbconn);
			}
		}
	}

	if($status_old != '3' && $status == '3'){ //��ۿϷ��϶���, �����Ѿ� �߰�
		$id = '';
		//������ id �˾Ƴ���
		
		$SQL = "select * from $Order_ProTable where order_num = '$num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		$rs=mysql_fetch_array($dbresult);
		$item_no=$rs[item_no];
		
		$SQL = "select id from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$numRows = mysql_num_rows($dbresult);
		if($numRows > 0){
			$id = mysql_result($dbresult,0,0);
		}
		
		if(!empty($id)){
			//�����Ѿ׺���
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

	if(($status_old != '5' && $status == '5')||($status_old != '4' && $status == '4')||($status_old != '10' && $status == '10')){ //�ֹ���ҽ� ���ʽ����� ����
			
			//����� ���ʽ� ����
			$SQL = "select id,use_bonus_tot from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			
			$SQL1 = "select * from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
			$dbresult1 = mysql_query($SQL1, $dbconn);
			$numRows1 = mysql_num_rows($dbresult1);

			
			if($numRows > 0 &&$numRows1>0){
			
				$id = mysql_result($dbresult,0,0);
				$use_bonus_tot = mysql_result($dbresult,0,1);
				
				if(!empty($id)&&!empty($use_bonus_tot)){
					//ȸ�����̺��� ���ʽ� �Ѿ� ����
					$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
					$dbresult = mysql_query($SQL, $dbconn);
					
					//���ʽ� ���̺��� ����
					$SQL = "delete from $BonusTable where order_num='$order_num' and bonus<0 and mart_id='$mart_id'";
					
					$dbresult = mysql_query($SQL, $dbconn);
				}	
			}
			
			//���ʽ����� ����
			$SQL = "select id,bonus from $BonusTable where order_num ='$order_num' and mart_id='$mart_id'";
			$dbresult = mysql_query($SQL, $dbconn);
			$numRows = mysql_num_rows($dbresult);
			$bonus_total = 0;
			for ($k=0; $k<$numRows; $k++) {
				$id = mysql_result($dbresult,$k,0);
				$bonus = mysql_result($dbresult,$k,1);
				$bonus_total += $bonus;
			}
			if(!empty($id)){	
				$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total-$bonus_total where username='$id' and mart_id='$mart_id'";
				
				$dbresult = mysql_query($SQL, $dbconn);
			}
			
			$SQL = "delete from $BonusTable where order_num='$order_num' and bonus>0 and mart_id='$mart_id'";
			
			$dbresult = mysql_query($SQL, $dbconn);
		}	
	if(($status_old != '5' && $status == '5')||($status_old != '4' && $status == '4')||($status_old != '10' && $status == '10')){ //�ֹ���ҽ� ���ʽ����� ����//���� ��� �ֹ���� ȯ�ҽÿ� ��� ����
		$sql="select * from $Order_ProTable where order_num='$order_num'";
		$result=mysql_query($sql);
		while($rs=mysql_fetch_array($result)){
			$item_no2=$rs[item_no];
			$quantity=$rs[quantity];
			$opt=$rs[opt];
			$opt2=$rs[opt2];
			$opt3=$rs[opt3];
			$opt4=$rs[opt4];
			
			$sql="select * from $ItemTable where item_no='$item_no2'";
			$result2=mysql_query($sql);
			$rs2=mysql_fetch_array($result2);
			$if_opt_jaego=$rs2[if_opt_jaego];
			$if_opt_jaego2=$rs2[if_opt_jaego2];
			$if_opt_jaego3=$rs2[if_opt_jaego3];
			$if_opt_jaego4=$rs2[if_opt_jaego4];
			$jaego_use=$rs2[jaego_use];
			if($jaego_use=="1"){
				$sql="update $ItemTable set jaego=jaego+$quantity where item_no='$item_no2'";
				mysql_query($sql);
			}else{}
			if($if_opt_jaego){
				$sql="update $OptionTable set opt_ea=opt_ea+$quantity where opt_no='$opt'";
				mysql_query($sql);
			}
			if($if_opt_jaego2){
				$sql="update $OptionTable2 set opt_ea=opt_ea+$quantity where opt_no='$opt2'";
				mysql_query($sql);
			}
			if($if_opt_jaego3){
				$sql="update $OptionTable3 set opt_ea=opt_ea+$quantity where opt_no='$opt3'";
				mysql_query($sql);
			}
			if($if_opt_jaego4){
				$sql="update $OptionTable4 set opt_ea=opt_ea+$quantity where opt_no='$opt4'";
				mysql_query($sql);
			}
			echo $sql;
		}
	}else if(($status_old == '5' && $status != '5')||($status_old == '4' && $status != '4')||($status_old == '10' && $status != '10')){
		$sql="select * from $Order_ProTable where order_num='$order_num'";
		$result=mysql_query($sql);
		while($rs=mysql_fetch_array($result)){
			$item_no2=$rs[item_no];
			$quantity=$rs[quantity];
			$opt=$rs[opt];
			$opt2=$rs[opt2];
			$opt3=$rs[opt3];
			$opt4=$rs[opt4];
			$sql="select * from $ItemTable where item_no='$item_no2'";
			$result2=mysql_query($sql);
			$rs2=mysql_fetch_array($result2);
			$if_opt_jaego=$rs2[if_opt_jaego];
			$if_opt_jaego2=$rs2[if_opt_jaego2];
			$if_opt_jaego3=$rs2[if_opt_jaego3];
			$if_opt_jaego4=$rs2[if_opt_jaego4];
			$jaego_use=$rs2[jaego_use];
			if($jaego_use=="1"){
				$sql="update $ItemTable set jaego=jaego-$quantity where item_no='$item_no2'";
				mysql_query($sql);
			}else{}
			if($if_opt_jaego){
				$sql="update $OptionTable set opt_ea=opt_ea-$quantity where opt_no='$opt'";
				mysql_query($sql);
			}
			if($if_opt_jaego2){
				$sql="update $OptionTable2 set opt_ea=opt_ea-$quantity where opt_no='$opt2'";
				mysql_query($sql);
			}
			if($if_opt_jaego3){
				$sql="update $OptionTable3 set opt_ea=opt_ea-$quantity where opt_no='$opt3'";
				mysql_query($sql);
			}
			if($if_opt_jaego4){
				$sql="update $OptionTable4 set opt_ea=opt_ea-$quantity where opt_no='$opt4'";
				mysql_query($sql);
			}
		}
	}
	if($status_old != '10' && $status == '10'){ //�ֹ���ҽ� ���ʽ����� ����
		
		//����� ���ʽ� ����
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
				//ȸ�����̺��� ���ʽ� �Ѿ� ����
				$SQL = "update $Mart_Member_NewTable set bonus_total=bonus_total+$use_bonus_tot where username='$id' and mart_id='$mart_id'";
				$dbresult = mysql_query($SQL, $dbconn);				
				
				//���ʽ� ���̺� ��ҵ� �ֹ��� �������Ʈ �ٽ��Է�
				$write_date = date("Y-m-d H:i:s");
				$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num) values ('$mart_id', '$id', '$write_date', $use_bonus_tot, '�ֹ���ȣ : <a href=\"../stat/order_view.html?mart_id=$mart_id&order_num=$order_num_query\">$order_num_query</a> �ֹ����', '$order_num')";
				$dbresult = mysql_query($SQL, $dbconn);
			}	
		}
		echo "
		<script>
		alert(\"�����Ǿ����ϴ�.\\n\\n�������� ����Ʈ���� ���� ����Ͻʽÿ�.\");
		window.close();
		window.opener.location.reload();
		</script>
		";
		exit;
	}

	/**if( $status_old != '2' && $status == '2' ){ //�ԱݿϷ�� sms������
		//������ ���� �˾Ƴ���
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== SMS ���� ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//�޴� ��� ��ȣ
		$tran_callback = "$shop_tel";//������ ��� ��ȣ
		$tran_msg = "$name"."���� �Աݳ����� Ȯ�εǾ����ϴ�.�ֹ���ȣ "."$order_num"."[$mart_id]";

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

		//������ ���� �˾Ƴ���
		$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
		$ok_res = mysql_query($ok_sql, $dbconn);
		$ok_tot = mysql_num_rows($ok_res);

		if( $ok_tot > 0 ){
			for( $k = 0; $k < $ok_tot; $k++ ){
				$ok_row = mysql_fetch_array($ok_res);
				$provider_id = $ok_row[provider_id];

				//================== ������ ������ �ҷ��� ====================================
				$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
				$phon_res = mysql_query($phon_sql, $dbconn);
				$phon_row = mysql_fetch_array($phon_res);
				$pro_phon = $phon_row[tel2];
				$pro_name = $phon_row[name];

				$tr_senddate = date("YmdHis");
				$tran_phone = "$pro_phon";//�޴� ��� ��ȣ
				$tran_callback = "$shop_tel";//������ ��� ��ȣ
				$tran_msg = "�ֹ���ȣ "."$order_num"."�Ա��� Ȯ�εǾ����ϴ�.��ǰ�� ������ֽʽÿ�.[$mart_id]";

				$sms_sql = "insert into em_tran (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '$tran_phone', '$tran_callback', '1', sysdate(), '$tran_msg' )";
				$sms_res = mysql_query( $sms_sql, $connect );

				if( !$sms_res ){
					echo "
					<script>
						alert('���������� ���� ���� ����');
					</script>
					";
				}
			}
		}
	}**/

	/**if( $status_old != '4' && $status == '4' ){ //ȯ�ҽ� sms������
		//������ ���� �˾Ƴ���
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== SMS ���� ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//�޴� ��� ��ȣ
		$tran_callback = "$shop_tel";//������ ��� ��ȣ
		$tran_msg = "$name"."���� �ֹ��Ͻ� ��ǰ�� ȯ�ҵǾ����ϴ�.�ֹ���ȣ "."$order_num"."[$mart_id]";

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
	}**/
	
	/**if( $status_old != '5' && $status == '5' ){ //�ֹ���ҽ� sms������
		//������ ���� �˾Ƴ���
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== SMS ���� ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//�޴� ��� ��ȣ
		$tran_callback = "$shop_tel";//������ ��� ��ȣ
		$tran_msg = "$name"."���� �ֹ��Ͻ� ��ǰ�� ��ҵǾ����ϴ�.�ֹ���ȣ "."$order_num"."[$mart_id]";

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
	}**/

	/**if( $status_old != '6' && $status == '6' ){ //������϶� sms������
		//������ ���� �˾Ƴ���
		$SQL = "select id, tel2, name from $Order_BuyTable where order_num = '$order_num' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		$id = mysql_result($dbresult,0,0);
		$tel2 = mysql_result($dbresult,0,1);
		$name = mysql_result($dbresult,0,2);

		//================== ������ ������ �ҷ��� ========================================
		$phon_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$Mall_Admin_ID'";
		$phon_res = mysql_query($phon_sql, $dbconn);
		$phon_row = mysql_fetch_array($phon_res);
		$pro_phon = $phon_row[tel2];
		$pro_name = $phon_row[name];

		//================== SMS ���� ====================================================
		$tr_senddate = date("YmdHis");
		$tran_phone = "$tel2";//�޴� ��� ��ȣ
		$tran_callback = "$pro_phon";//������ ��� ��ȣ
		$tran_msg = "$name"."���� �ֹ��Ͻ� ��ǰ�� ��۵Ǿ����ϴ�.�ֹ���ȣ "."$order_num"."[$mart_id]";

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
	}**/
	
	echo "
		<script>
		alert(\"�����Ǿ����ϴ�.\");
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
	alert(\"����ó�� �ֹ������� ���½��ϴ�..\");
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
	alert(\"�޸� �����Ǿ����ϴ�.\");
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
	alert(\"�޸� �����Ǿ����ϴ�.\");
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
	alert(\"�޸� �����Ǿ����ϴ�.\");
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
	alert(\"�������� �����Ǿ����ϴ�.\");
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

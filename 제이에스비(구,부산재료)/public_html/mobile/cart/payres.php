<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
include "../../market/include/getmartinfo.php";

    /*
     * [최종결제요청 페이지(STEP2-2)]
     *
     * LG유플러스으로 부터 내려받은 LGD_PAYKEY(인증Key)를 가지고 최종 결제요청.(파라미터 전달시 POST를 사용하세요)
     */
	
	/* ※ 중요
	* 환경설정 파일의 경우 반드시 외부에서 접근이 가능한 경로에 두시면 안됩니다.
	* 해당 환경파일이 외부에 노출이 되는 경우 해킹의 위험이 존재하므로 반드시 외부에서 접근이 불가능한 경로에 두시기 바랍니다. 
	* 예) [Window 계열] C:\inetpub\wwwroot\lgdacom ==> 절대불가(웹 디렉토리)
	*/
	
	$configPath = "/home/jsbusan/public_html/mobile/cart/lgdacom"; //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf,/conf/mall.conf") 위치 지정. 

    /*
     *************************************************
     * 1.최종결제 요청 - BEGIN
     *  (단, 최종 금액체크를 원하시는 경우 금액체크 부분 주석을 제거 하시면 됩니다.)
     *************************************************
     */
    $CST_PLATFORM               = $HTTP_POST_VARS["CST_PLATFORM"];
    $CST_MID                    = $HTTP_POST_VARS["CST_MID"];
    $LGD_MID                    = (("test" == $CST_PLATFORM)?"t":"").$CST_MID;
    $LGD_PAYKEY                 = $HTTP_POST_VARS["LGD_PAYKEY"];

    require_once("./lgdacom/XPayClient.php");
    $xpay = &new XPayClient($configPath, $CST_PLATFORM);
    $xpay->Init_TX($LGD_MID);    
    
    $xpay->Set("LGD_TXNAME", "PaymentByKey");
    $xpay->Set("LGD_PAYKEY", $LGD_PAYKEY);
    
    //금액을 체크하시기 원하는 경우 아래 주석을 풀어서 이용하십시요.
	//$DB_AMOUNT = "DB나 세션에서 가져온 금액"; //반드시 위변조가 불가능한 곳(DB나 세션)에서 금액을 가져오십시요.
	//$xpay->Set("LGD_AMOUNTCHECKYN", "Y");
	//$xpay->Set("LGD_AMOUNT", $DB_AMOUNT);
	    
    /*
     *************************************************
     * 1.최종결제 요청(수정하지 마세요) - END
     *************************************************
     */

    /*
     * 2. 최종결제 요청 결과처리
     *
     * 최종 결제요청 결과 리턴 파라미터는 연동메뉴얼을 참고하시기 바랍니다.
     */
    if ($xpay->TX()) {
        //1)결제결과 화면처리(성공,실패 결과 처리를 하시기 바랍니다.)
        /*
		echo "결제요청이 완료되었습니다.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        echo "거래번호 : " . $xpay->Response("LGD_TID",0) . "<br>";
        echo "상점아이디 : " . $xpay->Response("LGD_MID",0) . "<br>";
        echo "상점주문번호 : " . $xpay->Response("LGD_OID",0) . "<br>";
        echo "결제금액 : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
        echo "결과코드 : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";
        echo "결과메세지 : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
          */ 
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            //echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        echo "<p>";


		###########공통변수###########3
		$paymethod= $_POST[ "paymethod"         ];
		$res_cd =	$xpay->Response_Code(); //응답코드
		$order_num =$xpay->Response("LGD_OID",0); //상점 주문번호
		#######카드정보#############
		$app_no =	$xpay->Response("LGD_FINANCEAUTHNUM",0);//결제기관승인번호
		$paydate =  $xpay->Response("LGD_PAYDATE",0); //결제일시
		$tno =		$xpay->Response("LGD_TID",0); //데이콤 거래번호
		$quota =	$xpay->Response("LGD_CARDINSTALLMONTH",0); //카드 할부개월
		$noinf =	$xpay->Response("LGD_CARDNOINTYN",0);//무이자 할부 
		$res_msg =	$xpay->Response("LGD_RESPMSG",0);//응답메세지
		$card_name =$xpay->Response("LGD_FINANCENAME",0);//카드명
		############################3
		if($noinf == 1){ //무이자
			$noinf = "y";
		}else{ //일반
			$noinf = "n";
		}





           
        if( "0000" == $xpay->Response_Code() ) {
         	//최종결제요청 결과 성공 DB처리
           	



						############################### Start 성공 ############################################################################################################################################

				$rSuccYn = 'y';
				$card_paid = 't';
				$status = 2;//카드성공일때 바로 결제완료



				//================== 주문서 테이블에 주문번호가 없을때 ===================================
				$ordcopy_sql0 = "select * from order_buy where order_num='$order_num'";
				$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
				$order_tot0 = mysql_num_rows($ordcopy_res0);
				if($order_tot0 == 0){
				//================== 임시주문서 내용을 주문서 테이블로 복사함 ========================
				$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num')";

				$ordcopy_res = mysql_query($ordcopy_sql, $dbconn);

					if( !$ordcopy_res ){
						echo ("
							<script language=javascript>
								alert('주문서를 복사하는데 실패했습니다.');
								history.go(-1);
							</script>
						");
						exit;
					}

					if( $paymethod == 'byaccount'){
						$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
						//echo $all_sql."<br>";
						$all_res = mysql_query($all_sql, $dbconn);

						$order_str = "결제가 정상적으로 완료되었습니다.";
					}else if( $paymethod == 'bycard' ){
						$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
						//echo $all_sql."<br>";
						$all_res = mysql_query($all_sql, $dbconn);

						$order_str = "결제가 정상적으로 완료되었습니다.";
						
					}else{
						$order_str = "주문이 정상적으로 완료되었습니다.";
					}

					$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
					$cartdel_res = mysql_query($cartdel_sql, $dbconn);
					if($cartdel_res == false){
						echo "쿼리 실행 실패";
					}
					//=============== 임시주문서 내용을 삭제함 ===========================================
					$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
					$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

				}
			################################ End 성공 ###################################################################################################################


            //최종결제요청 결과 성공 DB처리 실패시 Rollback 처리
          	$isDBOK = true; //DB처리 실패시 false로 변경해 주세요.
          	if( !$isDBOK ) {
           		echo "<p>";
           		$xpay->Rollback("상점 DB처리 실패로 인하여 Rollback 처리 [TID:" . $xpay->Response("LGD_TID",0) . ",MID:" . $xpay->Response("LGD_MID",0) . ",OID:" . $xpay->Response("LGD_OID",0) . "]");            		            		
            		
                echo "TX Rollback Response_code = " . $xpay->Response_Code() . "<br>";
                echo "TX Rollback Response_msg = " . $xpay->Response_Msg() . "<p>";
            		
                if( "0000" == $xpay->Response_Code() ) {
                  	echo "자동취소가 정상적으로 완료 되었습니다.<br>";
                }else{
          			echo "자동취소가 정상적으로 처리되지 않았습니다.<br>";
                }
          	}            	
        }else{
          	//최종결제요청 결과 실패 DB처리
         				######################################################## Start 실패 ###################################################################
						$card_paid = 'f'; //결제실패
						$rSuccYn = 'n';
						$status = 1;

						//================== 주문서 테이블에 주문번호가 없을때 ===================================
						$ordcopy_sql0 = "select * from order_buy where order_num='$order_num'";
						$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
						$order_tot0 = mysql_num_rows($ordcopy_res0);
						if($order_tot0 == 0){
						//================== 임시주문서 내용을 주문서 테이블로 복사함 ========================
						$ordcopy_sql = "insert into order_buy ( select * from order_buy_temp where order_num='$order_num')";

						$ordcopy_res = mysql_query($ordcopy_sql, $dbconn);

							if( !$ordcopy_res ){
								echo ("
									<script language=javascript>
										alert('주문서를 복사하는데 실패했습니다.');
										history.go(-1);
									</script>
								");
								exit;
							}
							if( $paymethod == 'byaccount'){
								$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
									//echo $all_sql."<br>";
									$all_res = mysql_query($all_sql, $dbconn);
									$order_str = "결제가 실패했습니다.";
								
							}else if( $paymethod == 'bycard' ){
								$all_sql = "update order_buy set card_paid = '$card_paid', status='$status', authnumber='$app_no', payment_date='$paydate', field1 ='$tno', field2 = '$quota', field3 = '$card_name', field4 = '$noinf', field5='$res_msg' where order_num='$order_num'";
								//echo $all_sql."<br>";
								$all_res = mysql_query($all_sql, $dbconn);

									$order_str = "결제가 실패했습니다.<br><span class=text_red>$res_msg</span>";
								
							}else{
								$order_str = "결제가 실패했습니다.";
							}

							$cartdel_sql = "update order_pro set status='$status' where order_num='$order_num'";
							$cartdel_res = mysql_query($cartdel_sql, $dbconn);
							if($cartdel_res == false){
								echo "쿼리 실행 실패";
							}

							//=============== 임시주문서 내용을 삭제함 ===========================================
							$ordcopy_sql1 = "delete from order_buy_temp where order_num='$order_num'";
							$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

						}
			######################################################### End 실패 ##################################################################    
     
        }
    }else {
        //2)API 요청실패 화면처리
        echo "결제요청이 실패하였습니다.  <br>";
        echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //최종결제요청 결과 실패 DB처리
        echo "최종결제요청 결과 실패 DB처리하시기 바랍니다.<br>";            	                        
    }

















//================== 주문서 설정을 불러옴 ================================================
$sql = "select * from order_config where mart_id ='$mart_id'";
$res = mysql_query($sql, $dbconn);
$tot = mysql_num_rows($res);
if($tot > 0){
	$row = mysql_fetch_array($res);
	$buyer_name_use = $row[buyer_name_use];
	$buyer_passport_use = $row[buyer_passport_use];
	$buyer_email_use = $row[buyer_email_use];
	$buyer_tel_use = $row[buyer_tel_use];
	$buyer_tel1_use = $row[buyer_tel1_use];
	$buyer_zip_use = $row[buyer_zip_use];
	$buyer_address_use = $row[buyer_address_use];
	$receiver_use = $row[receiver_use];
	$rev_tel_use = $row[rev_tel_use];
	$rev_tel1_use = $row[rev_tel1_use];
	$zip_use = $row[zip_use];
	$address_use = $row[address_use];
	$money_sender_use = $row[money_sender_use];
	$pay_day_use = $row[pay_day_use];
	$field1_text = $row[field1_text];
	$field1_use = $row[field1_use];
	$field2_text = $row[field2_text];
	$field2_use = $row[field2_use];
	$field3_text = $row[field3_text];
	$field3_use = $row[field3_use];
	$field4_text = $row[field4_text];
	$field4_use = $row[field4_use];
	$field5_text = $row[field5_text];
	$field5_use = $row[field5_use];
}


if( $paymethod == 'byonline'){ //무통장입금일때
	$status = 1; 
	$order_str = "주문이 정상적으로 완료되었습니다.";


	$cartdel_sql = "update $Order_ProTable set status='$status' where order_num='$order_num' and mart_id='$mart_id'";
	$cartdel_res = mysql_query($cartdel_sql, $dbconn);
	if($cartdel_res == false){
		echo "쿼리 실행 실패";
	}

	//================== 주문서 테이블에 주문번호가 없을때 ===================================
	$ordcopy_sql0 = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
	$ordcopy_res0 = mysql_query($ordcopy_sql0, $dbconn);
	$order_tot0 = mysql_num_rows($ordcopy_res0);
	if($order_tot0 == 0){
		//================== 임시주문서 내용을 주문서 테이블로 복사함 ========================
		$ordcopy_sql = "insert into $Order_BuyTable ( select * from $Order_BuyTable_Temp where order_num='$order_num' and mart_id='$mart_id')";

		$ordcopy_res = mysql_query($ordcopy_sql, $dbconn);

		if( !$ordcopy_res ){
			echo ("
				<script language=javascript>
					alert('주문서를 복사하는데 실패했습니다.');
					history.go(-1);
				</script>
			");
			exit;
		}	
		//=============== 임시주문서 내용을 삭제함 ===========================================
		$ordcopy_sql1 = "delete from $Order_BuyTable_Temp where order_num='$order_num' and mart_id='$mart_id'";
		$ordcopy_res1 = mysql_query($ordcopy_sql1, $dbconn);

	}
}












//================== 주문서 내용을 불러옴 ================================================
$order_sql = "select * from $Order_BuyTable where order_num='$order_num' and mart_id='$mart_id'";
$order_res = mysql_query($order_sql, $dbconn);
$order_tot = mysql_num_rows($order_res);
if($order_tot > 0){
	$order_row = mysql_fetch_array($order_res);
	$id = $order_row[id];
	$name = $order_row[name];
	$passport1 = $order_row[passport1];
	$passport2 = $order_row[passport2];
	$tel1 = $order_row[tel1];
	$tel2 = $order_row[tel2];
	$email = $order_row[email];
	$buyer_zip = $order_row[buyer_zip];
	$buyer_address = $order_row[buyer_address];
	$buyer_address_d = $order_row[buyer_address_d];
	$receiver = $order_row[receiver];
	$rev_tel = $order_row[rev_tel];
	$rev_tel1 = $order_row[rev_tel1];
	$zip = $order_row[zip];
	$address = $order_row[address];
	$address_d = $order_row[address_d];
	$message = $order_row[message];
	$paymethod = $order_row[paymethod];
	$account_no = $order_row[account_no];
	$status = $order_row[status];
	$date = $order_row[date];
	$money_sender = $order_row[money_sender];
	$pay_day = $order_row[pay_day];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	$if_use_bonus = $order_row[if_use_bonus];
	$use_bonus_tot = $order_row[use_bonus_tot];
	$freight_fee = $order_row[freight_fee];
	$field1 = $order_row[field1];
	$field2 = $order_row[field2];
	$field3 = $order_row[field3];
	$field4 = $order_row[field4];
	$field5 = $order_row[field5];
	
	if( !$message ){
		$message = "요청사항 없음";
	}

	//====================== 결제방법 정보 ===============================================
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
		$pay_sql = "select * from $BankTable where mart_id='$mart_id' and account_no='$account_no'";
		$pay_res = mysql_query($pay_sql, $dbconn);
		$pay_row = mysql_fetch_array($pay_res);
		$account_no = $pay_row[account_no];
		$bank_name = $pay_row[bank_name];
		$bank_number = $pay_row[bank_number];
		$owner_name = $pay_row[owner_name];
	}

	if( $paymethod == 'bycard_point'){
		$paystr = "카드결제 + 포인트결제";
		$totpaystr = "실 카드 결제 금액";
	}

	if( $paymethod == 'byaccount_point'){
		$paystr = "실시간계좌이체 + 포인트결제";
		$totpaystr = "실 실시간계좌이체 금액";
	}

	if($paymethod== 'bycard'){
		$paystr = "카드결제";
		$totpaystr = "카드결제 금액";
	}
	if($paymethod== 'byaccount'){
		$paystr = "실시간계좌이체";
		$totpaystr = "실시간계좌이체 금액";
	}
	if($paymethod== 'byescro'){
		$paystr = "우리에스크로";
		$totpaystr = "우리에스크로 금액";
	}
	//====================== 온라인 입금시 계좌 정보 =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "무통장입금";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "무통장입금";
			$totpaystr = "온라인 입금할 금액";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}
	}

	if($paymethod== 'bypoint'){
		$paystr = "포인트결제";
		$totpaystr = "결제할 금액";
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "무통장입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}
	}

}else{
	echo ("
		<script language=javascript>
			alert('주문번호가 없습니다.');
		</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=../main/'>";
	exit;
}
		
//포인트 사용 (온라인 입금, 포인트 결제)
if( ($paymethod == "byaccount_point" || $paymethod == "bycard_point") && $UnameSess ){
	$bonus_sql = "select * from $BonusTable where order_num = '$order_num' and id = '$UnameSess' and mart_id='$mart_id' and mode='u'";
	$bonus_res = mysql_query($bonus_sql, $dbconn);
	$bonus_tot = mysql_num_rows($bonus_res);
	
	if($bonus_tot <= 0){
		$write_date = date("Ymd H:i:s");
		$content = $order_num." 구매에 포인트 사용";
		
		$bonus = - $use_bonus_tot;
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num', 'u')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess' and mart_id='$mart_id'";

		$dbresult = mysql_query($SQL, $dbconn);
	}
}

unset($_SESSION["order_num"]);
?>
<?
include "../../market/include/head_alltemplate.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="euc-kr" />
		<title>블루몰</title>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;" />
		<link rel="apple-touch-icon" href="http://img.orga.co.kr/images/mobile/apple-touch-icon.png" />
        <link rel="shortcut icon" href="http://img.orga.co.kr/images/mobile/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
		<script type="text/JavaScript" src="../js/jquery-1.7.min.js"></script>
		<script type="text/javascript">
			document.createElement('header');
			document.createElement('nav');
			document.createElement('section');
			document.createElement('article');
			document.createElement('footer');
			
			function check_submit() {

				var query = document.searchForm.searchTerm.value;

				if(query != ''){
					document.searchForm.submit();
				} else {
					alert("검색어를 입력하세요");
					document.searchForm.searchTerm.focus(); 
					return;
				}	
			}			
		</script>
		
		
<script language="javascript" src="/js/jquery/plugin/blockUI/jquery.blockUI.js" charset="utf-8"></script>
<script language="javascript" src="/js/jquery/plugin/validate/jquery.validate.js" charset="utf-8"></script>
<script>
function searchZipcode(){
	popView('zipcode_search');
	document.frmMain.keyword.focus();
}
function apply(zipcode,addr,delvAreaType,zipcodeInvoice){
	alert("("+zipcode.substring(0,3)+"-"+zipcode.substring(0,3)+") "+ addr);
	document.frmMain.recvPost1.value = zipcode.substring(0,3);
	document.frmMain.recvPost2.value = zipcode.substring(3,6);
	document.frmMain.recvAddr.value = addr;
	document.frmMain.delvAreaType.value = delvAreaType;
	document.frmMain.zipcodeInvoice.value = zipcodeInvoice;
	$('.zipList').html("");
	popClose('zipcode_search');
	document.frmMain.recvAddrDtl.focus();
}
function popAddress(){

	if(document.getElementsByName('keyword')[0].value.trim()==''){
		alert('지역명을 입력해주세요. ');
		return;
	}
	
	$.getJSON(
        '/ajax/morder/zipcodeSearch.orga'
        ,{
        	keyWord : document.getElementsByName('keyword')[0].value.trim()
        	,keyField : 'addr3'
        }
        ,function(data) {
        	if(data.resultCode=='1'){
        		var p = '';
        		if(data.zipcodeList.length>0){
	            	for(var i=0;i<data.zipcodeList.length;i++){
	            		p += "<li>"
	            			+"<a onclick=\""
	            			+"apply('"+data.zipcodeList[i].zipcode+"','"
	            			+data.zipcodeList[i].addr1+" "+data.zipcodeList[i].addr2+" "+data.zipcodeList[i].addr3+" "+"','"
	            			+data.zipcodeList[i].delvAreaType+"','"
	            			+data.zipcodeList[i].zipcodeInvoice
	            			+"');"
	            			+"\">"
		            		+"<p> "
	                		+data.zipcodeList[i].addr1+" "
	                		+data.zipcodeList[i].addr2+" "
	                		+data.zipcodeList[i].addr3+" "
	                		+"</p><p>"
	                		+data.zipcodeList[i].zipcode.substring(0,3)+"-"+data.zipcodeList[i].zipcode.substring(3,6)	
	                		+"</p></a></li>";	
	            	}
	            	//alert(p);
	        		$('.zipList').html(p);
        		}else{
        			alert('검색된 지역이 없습니다.');
            		$('.zipList').html("");
        		}
        		
        	}else{
        		alert(data.resultMsg);
        		$('.zipList').html("");
        		popClose('zipcode_search');
        	}
        }
    );
}

window.onload = function(){
	
	
	

    $('#orderSame').click(function() {
        $('#recvNm').val($('#ordNm').val());
    });
	
	$('#frmMain').validate({
		rules:{
			ordNm:{required:true}
			,ordEmail:{required:true,email:true}
			,ordPw:{required:true,minlength:4,maxlength:8}
			,ordTel:{required:true}
			,ordMobile:{required:true}
			,recvNm:{required:true}
			,recvTel:{required:true}
			,recvMobile:{required:true}
		},
		messages:{
			ordNm:{required:"주문자명을 입력해주세요"}
			,ordEmail:{required:"이메일을 입력해주세요"}
			,ordPw:{required:"주문암호를 4자이상 8자이하로 입력해주세요"}
			,ordTel:{required:"주문자 전화번호를 입력해주세요"}
			,ordMobile:{required:"주문자 핸드폰번호를 입력해주세요"}
			,recvNm:{required:"수령자명을 입력해주세요"}
			,recvTel:{required:"배송지 전화번호를 입력해주세요"}
			,recvMobile:{required:"배송지 핸드폰번호를 입력해주세요"}
		},
		showErrors: function(errorMap, errorList) {
		},
		invalidHandler : function (form, validator){
			var error = validator.errorList[0];
			alert(error.message);
			$(error.element).focus();
		},
		submitHandler: function(f){
			$('.confirmBtn').hide();
			if(!confirm('결제 하시겠습니까?')){
				$('.confirmBtn').show();
				return false;
			}
			if(document.frmMain.cashOrderCost.value>0){
				
				document.frmMain.action = "/mobile/order/orderCash.orga";
				document.frmMain.submit();
				
			}else{
				alert('쿠폰만으로 결제하실 수 없습니다.');
				$('.confirmBtn').show();
				return;
			}
		}
	});
}

function applyAddress(val){
    if(val == "") return;
    var data = {atOnce : $("input[name=atOnce]").val()};
    data.cartGoodChk = $("input[name=cartGoodChk]").val();
    data.post = val.split("×")[0];

    $.ajaxCustom({
        url : "/ajax/morder/estimatedDeliveryDate.orga",
        data : data,
        successCallBack : function(result){
            $("#deliHopeDtmField").show();
            $("input[name=hopeDeliDtm]").val(result.date);
            $("#hopeDeliDtm").html(result.date.substring(0,4) + "년 " + result.date.substring(4,6) + "월 " + result.date.substring(6,8) + "일");
            if(val.split("×").length==6){
                var zipcode = val.split("×")[0];
                var recvTelText = val.split("×")[1];
                var recvMobileText = val.split("×")[2];
                var	addrText = val.split("×")[3];
                var addrDtlText = val.split("×")[4];
                var zipcodeInvoiceCd = val.split("×")[5];

                with(document.frmMain){
                    recvPost1.value = zipcode.substring(0,3);
                    recvPost2.value = zipcode.substring(3,6);
                    recvTel.value = recvTelText;
                    recvMobile.value = recvMobileText;
                    recvAddr.value = addrText;
                    recvAddrDtl.value = addrDtlText;
                    zipcodeInvoice.value = zipcodeInvoiceCd;
                }
            }else{
                with(document.frmMain){
                    recvPost1.value = "";
                    recvPost2.value = "";
                    recvTel.value = "";
                    recvMobile.value = "";
                    recvAddr.value = "";
                    recvAddrDtl.value = "";
                    zipcodeInvoice.value = "";
                }
            }
        }
    });
}
function applyCoupon(memCouponSeq, discountPrice){
	var totalSalePrice = 19500;
	$('.couponDiscount').html(commaInput(discountPrice));
	document.frmMain.orderMemCouponSeq.value = memCouponSeq;
	popClose('my_coupon');
	$('.totalSalePrice').html(commaInput(parseInt(totalSalePrice,10)-parseInt(discountPrice,10)));
	document.frmMain.cashOrderCost.value = parseInt(totalSalePrice,10)-parseInt(discountPrice,10);
	
}

function commaInput(val){
	var reg = /(^[+-]?\d+)(\d{3})/;
	
	var repText = val+'';
	while(reg.test(repText)){
		repText = repText.replace(reg,'$1' + ',' + '$2');
	} 
	return repText; 
	
}
</script>

	</head>
	<body>
	<? include("../include/top.html"); ?>


 
		<section id="content">

			<article id="contentSubTitle">
				<div class="subTitle">
					<h2>&nbsp;&nbsp;<a href="../">홈</a> > 주문완료</h2>
				</div>
			</article>
 
			<article class="order">
				<b><?=$order_str?></b><br>
				주문번호 : <?=$order_num?> <br />
				주문날짜 : <?=$date_str?>
			</article>

			<article id="productReview">
				<h3><span class="ic"></span>주문하신상품</h3>
 				
 				
				<div class="basket">
					
  <?
$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
$ok_res = mysql_query($ok_sql, $dbconn);
$ok_tot = mysql_num_rows($ok_res);
$mon_tot = 0;
$i = 0;
while($ok_row = mysql_fetch_array($ok_res)){
	$i++;
	$item_name = $ok_row[item_name];
	$coupon_used = $ok_row[coupon_used];
	$item_no_forcash = $ok_row[item_no];
	$item_no_coupon = $ok_row[item_no];
	if($i == 0){
		$item_no_tmp = $ok_row[item_no]; //제일 나중 구매한 상품
	}
	$order_pro_no = $ok_row[order_pro_no];
	$mart_id = $ok_row[mart_id];
	$opt = $ok_row[opt];
	$opt2 = $ok_row[opt2];
	$opt3 = $ok_row[opt3];
	$opt4 = $ok_row[opt4];
	
	$sql="select * from $OptionTable where opt_no='$opt'";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	
	
	$sql="select * from $OptionTable2 where opt_no='$opt2'";
	$result=mysql_query($sql);
	$rs2=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable3 where opt_no='$opt3'";
	$result=mysql_query($sql);
	$rs3=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable4 where opt_no='$opt4'";
	$result=mysql_query($sql);
	$rs4=mysql_fetch_array($result);
	
	$opt_name=$rs[opt_name];
	$opt_name2=$rs2[opt_name];
	$opt_name3=$rs3[opt_name];
	$opt_name4=$rs4[opt_name];

	$opt_price = $ok_row[opt_price];
	$opt_price2 = $ok_row[opt_price2];
	$opt_price3 = $ok_row[opt_price3];
	$opt_price4 = $ok_row[opt_price4];

	$z_price = $ok_row[z_price];
	$bonus = $ok_row[bonus];
		
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ok_row[use_bonus];
	$status = $ok_row[status];
	$quantity = $ok_row[quantity];
	$sum = ($z_price*$quantity)+(($opt_price+$opt_price2+$opt_price3+$opt_price4)*$quantity);

	$sum_str = number_format($sum);
	
	$mon_tot += $sum;

	$cart_sql1 = "select * from $ItemTable where item_no='$item_no_coupon'";
	$cart_res1 = mysql_query($cart_sql1, $dbconn);
	$cart_row1 = mysql_fetch_array($cart_res1);

	$prevno = $cart_row1[prevno];
	$cate_num = $cart_row1[category_num];
	$use_coupon = $cart_row1[use_coupon];
	$provider_id = $cart_row1[provider_id];
	$img_sml = $cart_row1[img_sml];
	$img = $cart_row1[img];
	$img_big = $cart_row1[img_big];
	$img_high = $cart_row1[img_high];
	$fee = $cart_row1[fee];
	$short_explain = $cart_row1[short_explain];
	$short_explain = han_cut($short_explain,28);

	//============================== 상점명을 가져옴 =====================================
	$me_sql = "select * from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$me_res = mysql_query($me_sql, $dbconn);
	$me_row = mysql_fetch_array($me_res);
	$in_name = $me_row[name];
	$me_delivery = $me_row[me_delivery];
	$me_delivery_price = number_format($me_row[me_delivery_price]);

	if( $fee == "착불" ){
		$me_delivery_str = "$fee (배송업체 : $me_delivery / 비용 : $me_delivery_price)";
	}else{
		$me_delivery_str = "$fee";
	}

	if($use_coupon == '1' && $coupon_used=='0'){ 
		$coupon_str = "<a href=\"javascript:CouponWin('$item_no_coupon')\"><img src='http://www.mocoupon.co.kr/onlineShop/img/button-u8.gif' border='0'></a>";	
	}else{
		$coupon_str = '';
	}
  
	$if_cash_str = '';
	$SQL_T = "select if_cash,mart_id from item where item_no='$item_no_forcash'";
	$dbresult_T = mysql_query($SQL_T, $dbconn);
	$if_cash = mysql_result($dbresult_T,0,0);
	$mart_id_tmp = mysql_result($dbresult_T,0,1);
	
	if($mart_id == $mart_id_tmp){
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}else{
		$SQL_T = "select if_cash from gnt_item where seller_id='$mart_id' and item_no='$item_no_forcash'";
		$dbresult_T = mysql_query($SQL_T, $dbconn);
		$numRows_T = mysql_num_rows($dbresult_T);
		if($numRows_T > 0)
		$if_cash = mysql_result($dbresult_T,0,0);
		if($if_cash == '1') $if_cash_str = "<img src='../images/cash.gif' width='46' height='15' absalign='middle'>";
	}

	//============================ 상품 이미지 =======================================
	if($img_sml != "" && file_exists("$Co_img_UP$mart_id/$img_sml")){
		if (strstr(strtolower(substr($img_sml,-4)),'.jpg') || strstr(strtolower(substr($img_sml,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_sml' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'></embed>";
		}
	}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
		if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img' width='50' height='50'></embed>";
		}
	}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
		if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
			$img_str = "<img src='../..$Co_img_DOWN$mart_id/$img_big' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_big,-4)),'.swf')){
			$img_str = "<embed src='../..$Co_img_DOWN$mart_id/$img_big' width='50' height='50'></embed>";
		}
	}else{
		$img_str = "<img src='../image/noimage_ss.gif' border='0' width='50' height='50' border='0'>";
	}
?>                 
					<input type="hidden" name="cartGoodChk" value="25266"/>
					<dl>
						<dt>
							<ul>
								<li><?=$img_str?>[<?=$item_name?>] </li>
<?
													if(isset($opt)&&$opt!=""){
												?>
												
												<?=$opt_name?>-<?=$opt_price?>원
												<?}?>
												<? if(isset($opt2)&&$opt2!=""){?><br>
												<?=$opt_name2?>-<?=$opt_price2?>원
												<? }?>
												<? if(isset($opt3)&&$opt3!=""){?><br>
												<?=$opt_name3?>-<?=$opt_price3?>원
												<? }?>
												<? if(isset($opt4)&&$opt4!=""){?><br>
												<?=$opt_name4?>-<?=$opt_price4?>원
												<? }?>								
								
							</ul>
						</dt>
						<dd>
							<ul>
									<li><span class="item">상품가격</span>: <?=$z_price_str?>원</li>
									<li><span class="item">수량</span>: <?=$quantity?>개</li>
									<li><span class="item">배송정보</span>: <?=$me_delivery_str?></li>
									<li><span class="item">합계금액</span>: <span class="price"> <?=$sum_str?>원</li>
							</ul>
						</dd>
					</dl>
<?
}
$mon_tot_freight = $mon_tot + $freight_fee;

?>				</div>
<!---------------------- 장바구니 테이블 끝 ---------------------->
                    

                 		

				<h3><span class="ic"></span>주문자정보</h3>
				<table class="orderinfoForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>주문자</th>
							<td><?=$name?></td>
						</tr>
						<tr>
							<th class="bg">전화번호</th>
							<td class="bg">
								<?=$tel1?>
							</td>
						</tr>
						<tr>
							<th>휴대폰번호</th>
							<td>
								<?=$tel2?>
							</td>
						</tr>
						<tr>
							<th class="bg">주문자주소</th>
							<td class="bg">
								[
                              <?=$buyer_zip?>
                              ]
                              <?=$buyer_address?>
                              <?=$buyer_address_d?>
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td>
								<?=$email?>
							</td>
						</tr>
					</tbody>
				</table>


				<div class="pt10"></div>
				<h3><span class="ic"></span>배송지정보</h3>
				<table class="deliveryForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>수령자명</th>
							<td>
								<?=$receiver?>
							</td>
						</tr>
						<tr>
							<th class="bg">전화번호</th>
							<td class="bg">
								<?=$rev_tel?>
							</td>
						</tr>
						<tr>
							<th>휴대폰번호</th>
							<td>
								<?=$rev_tel1?>
							</td>
						</tr>
						<tr>
							<th class="bg">배송지주소</th>
							<td class="bg">
								[
                              <?=$zip?>
                              ]
                              <?=$address?>
							  <?=$address_d?>
							</td>
						</tr>
                        <tr id="deliHopeDtmField" style="display:none">
							<th style="color:red">배송예정일</th>
							<td>
								<input type="hidden" name="hopeDeliDtm" value=""/><span id="hopeDeliDtm"></span>
							</td>
						</tr>
					</tbody>
				</table>













				<div class="pt10"></div>
				<h3><span class="ic"></span>결제정보</h3>
				<table class="deliveryForm mb20">
					<colgroup>
						<col width="32%" />
						<col width="68%" />
					</colgroup>
					<tbody>
						<tr>
							<th>결제방법</th>
							<td>
								<?=$paystr?>
                              <?=$account_str?>
							</td>
						</tr>












<?
if( $use_bonus_tot < $mon_tot_freight ){
?>
                        <?
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>
 						<tr>
							<th class="bg">입금자명</th>
							<td class="bg">
								<?=$money_sender?>
							</td>
						</tr>
						<tr>
							<th>입금예정일</th>
							<td>
								<?=$pay_day?>
							</td>
						</tr>

<?
	}else if($paymethod== 'bycard' || $paymethod== 'bycard_point'){
		if($quota == "00")
		{
			$quota_str = "일시불";
		}
		if($noinf == 'y')
		{
			$noinf_str = "무이자";
		}

		if($card_paid == 't'){
?>
 						<tr>
							<th class="bg">카드명</th>
							<td class="bg">
								<?=$card_name?>
							</td>
						</tr>
						<tr>
							<th>승인번호</th>
							<td>
								<?=$app_no?>
							</td>
						</tr>
 						<tr>
							<th class="bg">할부</th>
							<td class="bg">
								<?=$quota_str?>&nbsp;<?=$noinf_str?>
							</td>
						</tr>

		
<?
		}
	}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
		$bank_name = $field3;
?>
 						<tr>
							<th class="bg">은행명</th>
							<td class="bg">
								<?=$bank_name?>
							</td>
						</tr>

<?	
}
}
?>                        
					</tbody>
				</table>















                
				<h3><span class="ic"></span>총 결제금액</h3>
<!---------------------- 배송지정보 끝 -------------------->
					<table class="totalPriceForm mt10 mb20">
					<colgroup>
						<col width="35%" />
						<col width="65%" />
					</colgroup>
					<tbody>
					
						<tr>
							<td>배송비</td>
							<td class="price"><?=number_format($freight_fee)?>원</td>
						</tr>
                     
		
                        
						<tr>
							<th>총 결제금액</th>
							<th class="price totalSalePrice"><?=number_format($mon_tot_freight)?>원</th>
							<input type="hidden" name="cashOrderCost" value="19500"/>
						</tr>
					</tbody>
				</table>
                


			</article>
 
		</section>
 
 
	<? include("../include/bottom.html"); ?>
	</body>
</html>
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";


include "../include/getmartinfo.php";
?>

<?php
###################################################################################################################################################
   /*
     * [최종결제요청 페이지(STEP2-2)]
     *
     * LG텔레콤으로 부터 내려받은 LGD_PAYKEY(인증Key)를 가지고 최종 결제요청.(파라미터 전달시 POST를 사용하세요)
     */

	$configPath = "/home/$mart_id/public_html/market/cart/lgdacom"; //LG텔레콤에서 제공한 환경파일("/conf/lgdacom.conf,/conf/mall.conf") 위치 지정. 

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
  
		$order_num = $xpay->Response("LGD_OID",0); //주문번호
		$res_msg = $xpay->Response("LGD_RESPMSG",0); //응답메세지

		
		//echo "결제요청이 완료되었습니다.  <br>";
        //echo "TX Response_code = " . $xpay->Response_Code() . "<br>";
        //echo "TX Response_msg = " . $xpay->Response_Msg() . "<p>";
            
        //echo "거래번호 : " . $xpay->Response("LGD_TID",0) . "<br>";
        //echo "상점아이디 : " . $xpay->Response("LGD_MID",0) . "<br>";
       // echo "상점주문번호 : " . $xpay->Response("LGD_OID",0) . "<br>";
       // echo "결제금액 : " . $xpay->Response("LGD_AMOUNT",0) . "<br>";
       // echo "결과코드 : " . $xpay->Response("LGD_RESPCODE",0) . "<br>";
        //echo "결과메세지 : " . $xpay->Response("LGD_RESPMSG",0) . "<p>";
           //결제수단 신용카드: SC0010  계좌이체: SC0030
        $keys = $xpay->Response_Names();
        foreach($keys as $name) {
            //echo $name . " = " . $xpay->Response($name, 0) . "<br>";
        }
          
        //echo "<p>";

		   
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

		if( $paymethod == 'byaccount' || $paymethod == 'byaccount_point'){
			$all_sql = "update order_buy set status='$status', field3 = '$card_name', field5='$res_msg', payment_date='$app_time', field1 ='$tno', card_paid='$card_paid' where order_num='$order_num'";
			//echo $all_sql."<br>";
			$all_res = mysql_query($all_sql, $dbconn);

			$order_str = "결제가 정상적으로 완료되었습니다.";
		}else if( $paymethod == 'bycard' || $paymethod == 'bycard_point'){
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

/******************** SMS 세팅 우태하 STR ********************/
/*
$order_sms_sql = "select * from order_buy where order_num='$order_num' and mart_id='$mart_id'";
$order_sms_qry = mysql_query($order_sms_sql,$dbconn);
$order_sms_num = mysql_num_rows($order_sms_qry);
if($order_sms_num > 0){
	$order_sms_row = mysql_fetch_array($order_sms_qry);

	if($order_sms_row['tel2'] != ''){
		$conn_db = mysql_connect("211.51.221.165","emma","wjsghk!@#");
		mysql_select_db("emma");

		$tran_phone1 = $order_sms_row['tel2'];//받는 사람 번호
		$tran_callback1 = '010-5180-2446';//보내는 사람 번호
		$send_date = date("YmdHis");
		$tran_msg1 = "";

		$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
		mysql_query($sms_query,$conn_db);

		//전체기록남기기
		$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
		mysql_query($all_query,$conn_db);
	}

}
*/
/******************** SMS 세팅 우태하 END ********************/

	}
################################ End 성공 ###################################################################################################################
			
			//최종결제요청 결과 성공 DB처리
           //	echo "최종결제요청 결과 성공 DB처리하시기 바랍니다.<br>";

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
       $order_str =  $xpay->Response_Msg() . $xpay->Response_Code();
            
    }
###################################################################################################################################################
?>



<?



//포인트 사용 (온라인 입금, 포인트 결제)
if( ($paymethod == "byaccount_point" || $paymethod == "bycard_point") && $UnameSess ){
	$bonus_sql = "select * from $BonusTable where order_num = '$order_num' and id = '$UnameSess' and mode='u'";
	$bonus_res = mysql_query($bonus_sql, $dbconn);
	$bonus_tot = mysql_num_rows($bonus_res);
	
	if($bonus_tot <= 0){
		$write_date = date("Ymd H:i:s");
		$content = $order_num." 구매에 포인트 사용";
		
		$bonus = - $use_bonus_tot;
		$SQL = "insert into $BonusTable (mart_id, id, write_date, bonus, content, order_num, mode) values ('$mart_id', '$UnameSess', '$write_date', $bonus, '$content', '$order_num', 'u')";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "update $Mart_Member_NewTable set bonus_total = bonus_total - $use_bonus_tot where username='$UnameSess'";

		$dbresult = mysql_query($SQL, $dbconn);
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
		$paystr = "계좌이체 + 포인트결제";
		$totpaystr = "실 계좌이체 금액";
	}

	if($paymethod== 'bycard'){
		$paystr = "카드결제";
		$totpaystr = "카드결제 금액";
	}
	if($paymethod== 'byaccount'){
		$paystr = "계좌이체";
		$totpaystr = "계좌이체 금액";
	}
	
	//====================== 온라인 입금시 계좌 정보 =====================================
	if($paymethod== 'byonline'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "온라인입금";
			$totpaystr = "온라인 입금할 금액";
		}
	}

	if($paymethod== 'byonline_point'){
		if( $account_no ){
			$account_str ="( $bank_name $bank_number 예금주 : $owner_name )";
			$paystr = "온라인입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "온라인입금 + 포인트결제";
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
			$paystr = "온라인입금 + 포인트결제";
			$totpaystr = "온라인 입금할 금액";
		}else{
			$account_str ="";
			$paystr = "온라인입금 + 포인트결제";
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
?>
<?
unset($_SESSION["order_num"]);
?>
<?
include "../include/head_alltemplate.php";
?>
<script language=JavaScript>
<!--
//==================== 마우스오르쪽금지버튼과 키보드 금지 태그 ===========================
document.onkeydown=click;
document.onkeyup=click;
function click(){
	//CTRL+N 막기
	if((event.ctrlKey) && (event.keyCode == 78)){
		event.keyCode=null;
		return false;
	}

	//F11 막기
	if (event.keyCode == 122){
		event.keyCode=null;
		return false;  
	}
	
	//F5 막기
	if (event.keyCode == 116){
		event.keyCode=null;
		return false;  
	}
}

function keydown(){
	return false;
}

function onUnload(fo_path){
}

document.onmousedown=click;
document.onkeydown=keydown;

function wload(){
	window.resizeTo(370, 484);
}

function PlayOpen(mName){
	if(MPlayer.PlayState != 2)
	MPlayer.Open(mName);
}
//-->
</script>

<script>
//================================= 새창띄우기(ctrl + N) 금지 소스 =======================
function checkKP(){
	if (event.ctrlKey)
	if ((event.keyCode == 78) || (event.keyCode == 104))
		event.returnValue = false;
}
//-->
</script>
<script>
//================================= 새창띄우기(ctrl + N) 금지 소스 =======================
function checkKP(){
	if (event.ctrlKey)
	if ((event.keyCode == 78) || (event.keyCode == 104))
		event.returnValue = false;
}
//-->
</script>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>Untitled Document</title>
<meta http-equiv="imagetoolbar" content="no">
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<script language='JavaScript' src='../printEmbed.js'></script>
<body topmargin="0" leftmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="../images/up_bg.gif">
<!---------------------- 탑메뉴 시작 ---------------------------------------------------->

<?
include "../include/top2.htm";
?>

<!---------------------- 탑메뉴 끝 ------------------------------------------------------>	
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="9" valign="top">&nbsp;</td>
        <td width="888" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="157" height="100%" valign="top" background="../images/menu_bg.gif">
		  <!----------------------------------서브메뉴 시작------------------------------------------>
          <? include "../include/sub_menu.htm" ?>
          <!----------------------------------서브메뉴 끝------------------------------------------>
					</td>
                    <td height="100%" valign="top" background="../images/proudct/product_list_box_bg.gif"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td height="2" bgcolor="BE002E"></td>
                        </tr>
                        <tr>
                          <td><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td height="7"></td>
                              </tr>
                              <tr>
                                <td valign="top"><table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="D4CFC3">
                                  <tr>
                                    <td height="25" bgcolor="EAE6E2"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td><img src="../images/proudct/product_info_title_icon.gif" width="13" height="13" align="absmiddle" /> <span class="category_title2">마이페이지</span></td>
                                          <td><div align="right">페이지 경로 </div></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="5" valign="top"></td>
                              </tr>
                              <tr>
                                <td valign="top"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="6" bgcolor="9B002B">
                                    <tr>
                                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                                          <tr>
                                            <td width="220"><img src="../images/mypage/mypage_img1.jpg" width="169" height="66" /></td>
                                            <td><div align="right">
                                                <table width="460" height="66" border="0" cellpadding="0" cellspacing="0">
                                                  <tr>
                                                    <td background="../images/mypage/mypage_menu_bg.gif"><textarea name="textarea" cols="0" rows="0" id="txtResource id #1" style="display:none;"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="460" height="66">
              <param name="movie" value="../swf/mypage_menu.swf?pageNum=2">
              <param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="menu" value="false" />
              <embed src="../swf/mypage_menu.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="460" height="66"></embed>
            </object>
                    </textarea>
                                                        <script>printEmbed("txtResource id #1")</script>                                                    </td>
                                                  </tr>
                                                </table>
                                            </div></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="8"></td>
                              </tr>
                              <tr>
                                <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="7"><img src="../images/mypage/order_view_1.gif" width="7" height="58" /></td>
                                            <td background="../images/mypage/order_view_bg.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                  <td><div align="center"><img src="../images/mypage/order_view_title1.gif" width="101" height="18" /></div></td>
                                                  <td width="10"><div align="center"><img src="../images/mypage/order_view_line.gif" width="4" height="40" /></div></td>
                                                  <td><div align="center"><img src="../images/mypage/order_view_title2.gif" width="101" height="18" /></div></td>
                                                  <td width="10"><div align="center"><img src="../images/mypage/order_view_line.gif" width="4" height="40" /></div></td>
                                                  <td><div align="center"><img src="../images/mypage/order_view_title3.gif" width="101" height="18" /></div></td>
                                                  <td width="10"><div align="center"><img src="../images/mypage/order_view_line.gif" width="4" height="40" /></div></td>
                                                  <td><div align="center"><img src="../images/mypage/order_view_title4_over.gif" width="101" height="18" /></div></td>
                                                </tr>
                                            </table></td>
                                            <td width="7"><img src="../images/mypage/order_view_2.gif" width="7" height="58" /></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="6"></td>
                              </tr>
                              <tr>
                                <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td height="1" bgcolor="A68156"></td>
                                    </tr>
                                    <tr>
                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td height="57"><img src="../images/mypage/baguni_title4.gif" width="504" height="30" /></td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                    <tr>
                                      <td height="1" bgcolor="A68156"></td>
                                    </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td height="5"></td>
                              </tr>
                              <tr>
                                <td>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                      <!---------------------- 주문서 시작 -------------------->
                      <table width="680" border="1" cellpadding="5" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
                        <tr>
                          <td bgcolor="F1766C" height="3" colspan="2"></td>
                        </tr>
                        <tr align="center">
                          <td height="50" colspan="2"  bgcolor="#F7F7F7" class="product"><?=$order_str?>
						  </td>
                        </tr>
                        <tr>
                          <td width="70"  bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">주문번호</td>
                          <td><span class="price">
                            <?=$order_num?>
                          </span></td>
                        </tr>
                        <tr>
                          <td width="70"  bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">주문날짜</td>
                          <td><span class="price">
                            <?=$date_str?>
                          </span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">주문상품</td>
                          <td><?
$ok_sql = "select * from $Order_ProTable where mart_id='$mart_id' and order_num = '$order_num' order by order_pro_no desc";
//echo $ok_sql."<br>";
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
	$z_price = $ok_row[z_price];
	$bonus = $ok_row[bonus];
		
	$z_price_str = number_format($z_price);
	$bonus_str = number_format($bonus);
	
	$use_bonus = $ok_row[use_bonus];
	$status = $ok_row[status];
	$quantity = $ok_row[quantity];


	$opt = $ok_row[opt];
	$opt2 = $ok_row[opt2];
	$opt3 = $ok_row[opt3];
	$opt4 = $ok_row[opt4];
	
	$sql="select * from $OptionTable where opt_no='$opt'";
	$result=mysql_query($sql, $dbconn);
	$rs=mysql_fetch_array($result);
	
	
	$sql="select * from $OptionTable2 where opt_no='$opt2'";
	$result=mysql_query($sql, $dbconn);
	$rs2=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable3 where opt_no='$opt3'";
	$result=mysql_query($sql, $dbconn);
	$rs3=mysql_fetch_array($result);
	

	$sql="select * from $OptionTable4 where opt_no='$opt4'";
	$result=mysql_query($sql, $dbconn);
	$rs4=mysql_fetch_array($result);

	
	$opt_name=$rs[opt_name];
	$opt_name2=$rs2[opt_name];
	$opt_name3=$rs3[opt_name];
	$opt_name4=$rs4[opt_name];

	$opt_price = $ok_row[opt_price];
	$opt_price2 = $ok_row[opt_price2];
	$opt_price3 = $ok_row[opt_price3];
	$opt_price4 = $ok_row[opt_price4];
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
		$me_delivery_str = "$fee";
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
			$img_str = "<img src='$Co_img_DOWN$mart_id/$img_sml' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_sml,-4)),'.swf')){
			$img_str = "<embed src='$Co_img_DOWN$mart_id/$img_sml' width='50' height='50'></embed>";
		}
	}else if($img != "" && file_exists("$Co_img_UP$mart_id/$img")){
		if (strstr(strtolower(substr($img,-4)),'.jpg') || strstr(strtolower(substr($img,-4)),'.gif')){
			$img_str = "<img src='$Co_img_DOWN$mart_id/$img' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img,-4)),'.swf')){
			$img_str = "<embed src='$Co_img_DOWN$mart_id/$img' width='50' height='50'></embed>";
		}
	}else if($img_big != "" && file_exists("$Co_img_UP$mart_id/$img_big")){
		if (strstr(strtolower(substr($img_big,-4)),'.jpg') || strstr(strtolower(substr($img_big,-4)),'.gif')){
			$img_str = "<img src='$Co_img_DOWN$mart_id/$img_big' border='0' width='50' height='50' border='0'>";
		}
		if (strstr(strtolower(substr($img_big,-4)),'.swf')){
			$img_str = "<embed src='$Co_img_DOWN$mart_id/$img_big' width='50' height='50'></embed>";
		}
	}else{
		$img_str = "<img src='../image/noimage_ss.gif' border='0' width='50' height='50' border='0'>";
	}
?>
                              <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                  <td width="70" valign="top"><table width="60" height="60" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr>
                                        <td align="center" background="../image/product/product_back.gif"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$category_num?>&category_num1=<?=$prevno?>&category_num2=<?=$category_num2?>&cate_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no_forcash?>'>
                                          <?=$img_str?>
                                        </a></td>
                                      </tr>
                                  </table></td>
                                  <td width="120"><span class="text_red"><a href='../main/product_info.html?mart_id=<?=$mart_id?>&category_num=<?=$category_num?>&category_num1=<?=$prevno?>&category_num2=<?=$category_num2?>&cate_num=<?=$cate_num?>&flag=<?=$flag?>&item_no=<?=$item_no_forcash?>'>[
                                          <?=$item_name?>
                                          ]</a></span>
                                      <?=$if_cash_str?>
                                      <?=$coupon_str?>
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
<br>
                                      <span class="text_14_s2">
                                      <?=$short_explain?>
                                    </span> </td>
                                  <td width='100'>단가 :
                                      <?=$z_price_str?>
                                      원</td>
                                  <td width='40'><?=$quantity?>
                                    개</td>
                                  <td width='100'>합계 :
                                      <?=$sum_str?>
                                      원</td>
                                  <td width='80' class='mypage_1'>배송 :
                                      <?=$me_delivery_str?></td>
                                </tr>
                              </table>
                              <?
}           			
$mon_tot_freight = $mon_tot + $freight_fee;
?>
                          </td>
                        </tr>
<?
if($freight_fee)
{
?>
                        <tr>
                        	<td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">배송료</td>
                        	<td><span class="text_red"><?=number_format($freight_fee)?>원</span></td>
                       	</tr>
<?
}
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">결제금액</td>
                          <td><span class="price">
                            <?=number_format($mon_tot_freight)?>
                            원</span></td>
                        </tr>
                        <?
if($if_use_bonus == 1){
	$use_bonus_tot_str = number_format($use_bonus_tot);
	//실제 결제해야될 금액 
	$money_to_pay = $mon_tot_freight - $use_bonus_tot;
	$money_to_pay_str = number_format($money_to_pay);

/*	if( !empty($paystr) ){
		$paystr = $paystr." + 포인트 사용";
	}else{
		$paystr = "포인트 사용";
	}*/

?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">포인트 사용</td>
                          <td><span class="price">
                            <?=$use_bonus_tot_str?>
                            원</span></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle"><?=$totpaystr?></td>
                          <td><span class="price">
                            <?=$money_to_pay_str?>
                            원</span></td>
                        </tr>
                        <?
}
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">결제방법</td>
                          <td><?=$paystr?>
                              <?=$account_str?></td>
                        </tr>
                        <?
if( $use_bonus_tot < $mon_tot_freight ){
?>
                        <?
	if($paymethod== 'byonline' || $paymethod== 'byonline_point'){
?>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">입금자명</td>
                          <td><?=$money_sender?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">입금예정일</td>
                          <td><?=$pay_day?></td>
                        </tr>
<?
	}else if($paymethod== 'bycard' || $paymethod== 'bycard_point'){
		if($field2 == "00")
		{
			$quota = "일시불";
		}
		if($field4 == 'y')
		{
			$noinf_str = "무이자";
		}

		if($card_paid == 't'){
?>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">카드명</td>
                          <td><?=$field3?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">승인번호</td>
                          <td><?=$app_no?></td>
                        </tr>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">할부</td>
                          <td><?=$quota?>&nbsp;<?=$noinf_str?></td>
                        </tr>
<?
		}
	}else if($paymethod== 'byaccount' || $paymethod== 'byaccount_point'){
		$bank_name = $field3;
?>
						<tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">은행명</td>
                          <td><?=$bank_name?></td>
                        </tr>
<?
	}
}
?>                        
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">기타요청</td>
                          <td><?=nl2br($message)?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">구매자</td>
                          <td><?=$name?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">연락처</td>
                          <td><?=$tel1?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">휴대폰번호</td>
                          <td><?=$tel2?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">이메일</td>
                          <td><?=$email?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">주소</td>
                          <td>[
                              <?=$buyer_zip?>
                              ]
                              <?=$buyer_address?>
                              <?=$buyer_address_d?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">받는사람</td>
                          <td><?=$receiver?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">연락처</td>
                          <td><?=$rev_tel?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">휴대폰번호</td>
                          <td><?=$rev_tel1?></td>
                        </tr>
                        <tr>
                          <td bgcolor="#F7F7F7" class="text_14_s2"><img src="../image/icon_4.gif" width="15" height="9" align="absmiddle">배송지주소</td>
                          <td>[
                              <?=$zip?>
                              ]
                              <?=$address?>
							  <?=$address_d?></td>
                        </tr>
                        <tr>
                          <td bgcolor="F1766C" height="3" colspan="2"></td>
                        </tr>
                      </table>
                      <!---------------------- 주문서 끝 ---------------------->
<SCRIPT LANGUAGE="JavaScript">
<!--
function receipt_win(mart_id, order_num){
	var url = "../receipt/receipt.php?mart_id="+mart_id+"&order_num="+order_num;
	var uploadwin = window.open(url,"receipt","width=600,height=550,scrollbars=yes,toolbar=no,navationbar=no,resizable=yes");
}
//-->
</SCRIPT>
                      <!---------------------- 버튼 시작 ---------------------->
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="70" align="center"><a href="../main/."><img src="../image/bu_goshop.gif" width="140" height="50" border="0" align="absmiddle"></a>
<? 
if($card_paid == "t"){ ?>
						  <img src="../image/bu_print.gif" width="150" height="50" border="0" align="absmiddle" style='cursor:hand' onclick="receipt_win('<?=$mart_id?>', '<?=$order_num?>')">
<? } ?>
						              </td>
                        </tr>
                      </table>
                      <!---------------------- 버튼 끝 ----------------------->
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
            </table>								</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td height="100%">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="100%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="2" bgcolor="BE002E"></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="10"></td>
            </tr>
        </table></td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<!---------------------- 하단메뉴 시작 -------------------------------------------------->
<?




	$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
	mysql_select_db("emma");
	
	
	$tran_phone1 = "010-8081-8077";//받는 사람 번호 관리자
	$tran_callback1 = "010-8081-8077";//보내는 사람 번호
	$send_date = date("YmdHis");
	$mart_id = "elfower";
	$tran_msg1 = "[이엘플라워]".$name." ".$tel2." 주문이 들어왔습니다.";

	$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
	mysql_query($sms_query,$conn_db);

	//전체기록남기기
	$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
	mysql_query($all_query,$conn_db);






include "../include/bottom.htm";
?>
<!---------------------- 하단메뉴 끝 ---------------------------------------------------->	
</body>
</html>
<?
mysql_close($dbconn);
?>

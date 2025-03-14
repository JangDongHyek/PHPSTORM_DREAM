<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
//================== 함수 파일을 불러옴 ==================================================
include "../../main.class";
?>
<?
include "../../market/include/getmartinfo.php";
?>
<?php
    /*
     * 공통결제결과 정보 
     */
    $LGD_RESPCODE = "";           			// 응답코드: 0000(성공) 그외 실패
    $LGD_RESPMSG = "";            			// 응답메세지
    $LGD_MID = "";                			// 상점아이디 
    $LGD_OID = "";                			// 주문번호
    $LGD_AMOUNT = "";             			// 거래금액
    $LGD_TID = "";                			// 데이콤이 부여한 거래번호
    $LGD_PAYTYPE = "";            			// 결제수단코드
    $LGD_PAYDATE = "";            			// 거래일시(승인일시/이체일시)
    $LGD_HASHDATA = "";           			// 해쉬값
    $LGD_FINANCECODE = "";        			// 결제기관코드(카드종류/은행코드/이통사코드)
    $LGD_FINANCENAME = "";        			// 결제기관이름(카드이름/은행이름/이통사이름)
    $LGD_ESCROWYN = "";           			// 에스크로 적용여부
    $LGD_TIMESTAMP = "";          			// 타임스탬프
    $LGD_FINANCEAUTHNUM = "";     			// 결제기관 승인번호(신용카드, 계좌이체, 상품권)
	
    /*
     * 신용카드 결제결과 정보
     */
    $LGD_CARDNUM = "";            			// 카드번호(신용카드)
    $LGD_CARDINSTALLMONTH = "";   			// 할부개월수(신용카드) 
    $LGD_CARDNOINTYN = "";        			// 무이자할부여부(신용카드) - '1'이면 무이자할부 '0'이면 일반할부
    $LGD_TRANSAMOUNT = "";        			// 환율적용금액(신용카드)
    $LGD_EXCHANGERATE = "";       			// 환율(신용카드)

    /*
     * 휴대폰
     */
    $LGD_PAYTELNUM = "";          			// 결제에 이용된전화번호

    /*
     * 계좌이체, 무통장
     */
    $LGD_ACCOUNTNUM = "";         			// 계좌번호(계좌이체, 무통장입금) 
    $LGD_CASTAMOUNT = "";         			// 입금총액(무통장입금)
    $LGD_CASCAMOUNT = "";         			// 현입금액(무통장입금)
    $LGD_CASFLAG = "";            			// 무통장입금 플래그(무통장입금) - 'R':계좌할당, 'I':입금, 'C':입금취소 
    $LGD_CASSEQNO = "";           			// 입금순서(무통장입금)
    $LGD_CASHRECEIPTNUM = "";     			// 현금영수증 승인번호
    $LGD_CASHRECEIPTSELFYN = "";  			// 현금영수증자진발급제유무 Y: 자진발급제 적용, 그외 : 미적용
    $LGD_CASHRECEIPTKIND = "";    			// 현금영수증 종류 0: 소득공제용 , 1: 지출증빙용

    /*
     * OK캐쉬백
     */
    $LGD_OCBSAVEPOINT = "";       			// OK캐쉬백 적립포인트
    $LGD_OCBTOTALPOINT = "";      			// OK캐쉬백 누적포인트
    $LGD_OCBUSABLEPOINT = "";     			// OK캐쉬백 사용가능 포인트

    /*
     * 구매정보
     */
    $LGD_BUYER = "";              			// 구매자
    $LGD_PRODUCTINFO = "";        			// 상품명
    $LGD_BUYERID = "";            			// 구매자 ID
    $LGD_BUYERADDRESS = "";       			// 구매자 주소
    $LGD_BUYERPHONE = "";         			// 구매자 전화번호
    $LGD_BUYEREMAIL = "";         			// 구매자 이메일
    $LGD_BUYERSSN = "";           			// 구매자 주민번호
    $LGD_PRODUCTCODE = "";        			// 상품코드
    $LGD_RECEIVER = "";           			// 수취인
    $LGD_RECEIVERPHONE = "";      			// 수취인 전화번호
    $LGD_DELIVERYINFO = "";       			// 배송지
    

    $LGD_RESPCODE            = $HTTP_POST_VARS["LGD_RESPCODE"];
    $LGD_RESPMSG             = $HTTP_POST_VARS["LGD_RESPMSG"];
    $LGD_MID                 = $HTTP_POST_VARS["LGD_MID"];
    $LGD_OID                 = $HTTP_POST_VARS["LGD_OID"];
    $LGD_AMOUNT              = $HTTP_POST_VARS["LGD_AMOUNT"];
    $LGD_TID                 = $HTTP_POST_VARS["LGD_TID"];
    $LGD_PAYTYPE             = $HTTP_POST_VARS["LGD_PAYTYPE"];
    $LGD_PAYDATE             = $HTTP_POST_VARS["LGD_PAYDATE"];
    $LGD_HASHDATA            = $HTTP_POST_VARS["LGD_HASHDATA"];
    $LGD_FINANCECODE         = $HTTP_POST_VARS["LGD_FINANCECODE"];
    $LGD_FINANCENAME         = $HTTP_POST_VARS["LGD_FINANCENAME"];
    $LGD_ESCROWYN            = $HTTP_POST_VARS["LGD_ESCROWYN"];
    $LGD_TRANSAMOUNT         = $HTTP_POST_VARS["LGD_TRANSAMOUNT"];
    $LGD_EXCHANGERATE        = $HTTP_POST_VARS["LGD_EXCHANGERATE"];
    $LGD_CARDNUM             = $HTTP_POST_VARS["LGD_CARDNUM"];
    $LGD_CARDINSTALLMONTH    = $HTTP_POST_VARS["LGD_CARDINSTALLMONTH"];
    $LGD_CARDNOINTYN         = $HTTP_POST_VARS["LGD_CARDNOINTYN"];
    $LGD_TIMESTAMP           = $HTTP_POST_VARS["LGD_TIMESTAMP"];
    $LGD_FINANCEAUTHNUM      = $HTTP_POST_VARS["LGD_FINANCEAUTHNUM"];
    $LGD_PAYTELNUM           = $HTTP_POST_VARS["LGD_PAYTELNUM"];
    $LGD_ACCOUNTNUM          = $HTTP_POST_VARS["LGD_ACCOUNTNUM"];
    $LGD_CASTAMOUNT          = $HTTP_POST_VARS["LGD_CASTAMOUNT"];
    $LGD_CASCAMOUNT          = $HTTP_POST_VARS["LGD_CASCAMOUNT"];
    $LGD_CASFLAG             = $HTTP_POST_VARS["LGD_CASFLAG"];
    $LGD_CASSEQNO            = $HTTP_POST_VARS["LGD_CASSEQNO"];
    $LGD_CASHRECEIPTNUM      = $HTTP_POST_VARS["LGD_CASHRECEIPTNUM"];
    $LGD_CASHRECEIPTSELFYN   = $HTTP_POST_VARS["LGD_CASHRECEIPTSELFYN"];
    $LGD_CASHRECEIPTKIND     = $HTTP_POST_VARS["LGD_CASHRECEIPTKIND"];
    $LGD_OCBSAVEPOINT        = $HTTP_POST_VARS["LGD_OCBSAVEPOINT"];
    $LGD_OCBTOTALPOINT       = $HTTP_POST_VARS["LGD_OCBTOTALPOINT"];
    $LGD_OCBUSABLEPOINT      = $HTTP_POST_VARS["LGD_OCBUSABLEPOINT"];

    $LGD_BUYER               = $HTTP_POST_VARS["LGD_BUYER"];
    $LGD_PRODUCTINFO         = $HTTP_POST_VARS["LGD_PRODUCTINFO"];
    $LGD_BUYERID             = $HTTP_POST_VARS["LGD_BUYERID"];
    $LGD_BUYERADDRESS        = $HTTP_POST_VARS["LGD_BUYERADDRESS"];
    $LGD_BUYERPHONE          = $HTTP_POST_VARS["LGD_BUYERPHONE"];
    $LGD_BUYEREMAIL          = $HTTP_POST_VARS["LGD_BUYEREMAIL"];
    $LGD_BUYERSSN            = $HTTP_POST_VARS["LGD_BUYERSSN"];
    $LGD_PRODUCTCODE         = $HTTP_POST_VARS["LGD_PRODUCTCODE"];
    $LGD_RECEIVER            = $HTTP_POST_VARS["LGD_RECEIVER"];
    $LGD_RECEIVERPHONE       = $HTTP_POST_VARS["LGD_RECEIVERPHONE"];
    $LGD_DELIVERYINFO        = $HTTP_POST_VARS["LGD_DELIVERYINFO"];

    $LGD_MERTKEY = "fa1865ca207c711910627982412c734e";  //LG 텔레콤에서 발급한 상점키로 변경해 주시기 바랍니다.
       
    $LGD_HASHDATA2 = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_RESPCODE.$LGD_TIMESTAMP.$LGD_MERTKEY); 

    /*
     * 상점 처리결과 리턴메세지
     *
     * OK   : 상점 처리결과 성공
     * 그외 : 상점 처리결과 실패
     *
     * ※ 주의사항 : 성공시 'OK' 문자이외의 다른문자열이 포함되면 실패처리 되오니 주의하시기 바랍니다.
     */    
    $resultMSG = "결제결과 상점 DB처리(NOTE_URL) 결과값을 입력해 주시기 바랍니다.";
	  
	


		###########공통변수###########3
		$order_num = $LGD_OID;
		if($LGD_PAYTYPE == "SC0010"){
			$paymethod = "bycard";
		}elseif($LGD_PAYTYPE == "SC0030"){
			$paymethod = "byaccount";
		}
		
		$res_cd =	$LGD_RESPCODE; //응답코드
		$order_num =$LGD_OID; //상점 주문번호
		#######카드정보#############
		$app_no =	$LGD_FINANCEAUTHNUM;//결제기관승인번호
		$paydate =  $LGD_PAYDATE; //결제일시
		$tno =		$LGD_TID; //데이콤 거래번호
		$quota =	$LGD_CARDINSTALLMONTH; //카드 할부개월
		$noinf =	$LGD_CARDNOINTYN;//무이자 할부 
		$res_msg =	$LGD_RESPMSG;//응답메세지
		$card_name =$LGD_FINANCENAME;//카드명
		############################3
		if($noinf == 1){ //무이자
			$noinf = "y";
		}else{ //일반
			$noinf = "n";
		}





    if ($LGD_HASHDATA2 == $LGD_HASHDATA) {      //해쉬값 검증이 성공하면
        if($LGD_RESPCODE == "0000"){            //결제가 성공이면
            /*
             * 거래성공 결과 상점 처리(DB) 부분 */

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

			
             //* 상점 결과 처리가 정상이면 "OK"
              
            //if( 결제성공 상점처리결과 성공 ) 

					$resultMSG = "OK";   


				}
			################################ End 성공 ###################################################################################################################




            
			
			

        }else {                                 //결제가 실패이면
            /*
             * 거래실패 결과 상점 처리(DB) 부분
             * 상점결과 처리가 정상이면 "OK"
             */  



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

							//if( 결제실패 상점처리결과 성공 ) 
							$resultMSG = "OK";    


						}
			######################################################### End 실패 ##################################################################    



        }
    } else {                                    //해쉬값 검증이 실패이면
        /*
         * hashdata검증 실패 로그를 처리하시기 바랍니다. 
         */  
		$resultMSG = "결제결과 상점 DB처리(NOTE_URL) 해쉬값 검증이 실패하였습니다.";         
    }

    echo $resultMSG;       
	
	

?>

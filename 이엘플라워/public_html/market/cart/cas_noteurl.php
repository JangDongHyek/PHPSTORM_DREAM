<?php
    /*
     * [상점 결제결과처리(DB) 페이지]
     *
     * 1) 위변조 방지를 위한 hashdata값 검증은 반드시 적용하셔야 합니다.
     *
     */
    $LGD_RESPCODE            = $_POST["LGD_RESPCODE"];				// 응답코드: 0000(성공) 그외 실패
    $LGD_RESPMSG             = $_POST["LGD_RESPMSG"];				// 응답메세지
    $LGD_MID                 = $_POST["LGD_MID"];					// 상점아이디
    $LGD_OID                 = $_POST["LGD_OID"];					// 주문번호
    $LGD_AMOUNT              = $_POST["LGD_AMOUNT"];				// 거래금액
    $LGD_TID                 = $_POST["LGD_TID"];					// LG유플러스에서 부여한 거래번호
    $LGD_PAYTYPE             = $_POST["LGD_PAYTYPE"];				// 결제수단코드
    $LGD_PAYDATE             = $_POST["LGD_PAYDATE"];				// 거래일시(승인일시/이체일시)
    $LGD_HASHDATA            = $_POST["LGD_HASHDATA"];				// 해쉬값
    $LGD_FINANCECODE         = $_POST["LGD_FINANCECODE"];			// 결제기관코드(은행코드)
    $LGD_FINANCENAME         = $_POST["LGD_FINANCENAME"];			// 결제기관이름(은행이름)
    $LGD_ESCROWYN            = $_POST["LGD_ESCROWYN"];				// 에스크로 적용여부
    $LGD_TIMESTAMP           = $_POST["LGD_TIMESTAMP"];				// 타임스탬프
    $LGD_ACCOUNTNUM          = $_POST["LGD_ACCOUNTNUM"];			// 계좌번호(무통장입금)
    $LGD_CASTAMOUNT          = $_POST["LGD_CASTAMOUNT"];			// 입금총액(무통장입금)
    $LGD_CASCAMOUNT          = $_POST["LGD_CASCAMOUNT"];			// 현입금액(무통장입금)
    $LGD_CASFLAG             = $_POST["LGD_CASFLAG"];				// 무통장입금 플래그(무통장입금) - 'R':계좌할당, 'I':입금, 'C':입금취소
    $LGD_CASSEQNO            = $_POST["LGD_CASSEQNO"];				// 입금순서(무통장입금)
    $LGD_CASHRECEIPTNUM      = $_POST["LGD_CASHRECEIPTNUM"];		// 현금영수증 승인번호
    $LGD_CASHRECEIPTSELFYN   = $_POST["LGD_CASHRECEIPTSELFYN"];		// 현금영수증자진발급제유무 Y: 자진발급제 적용, 그외 : 미적용
    $LGD_CASHRECEIPTKIND     = $_POST["LGD_CASHRECEIPTKIND"];		// 현금영수증 종류 0: 소득공제용 , 1: 지출증빙용
	$LGD_PAYER     			 = $_POST["LGD_PAYER"];      			// 입금자명
	
    /*
     * 구매정보
     */
    $LGD_BUYER               = $_POST["LGD_BUYER"];					// 구매자
    $LGD_PRODUCTINFO         = $_POST["LGD_PRODUCTINFO"];			// 상품명
    $LGD_BUYERID             = $_POST["LGD_BUYERID"];				// 구매자 ID
    $LGD_BUYERADDRESS        = $_POST["LGD_BUYERADDRESS"];			// 구매자 주소
    $LGD_BUYERPHONE          = $_POST["LGD_BUYERPHONE"];			// 구매자 전화번호
    $LGD_BUYEREMAIL          = $_POST["LGD_BUYEREMAIL"];			// 구매자 이메일
    $LGD_BUYERSSN            = $_POST["LGD_BUYERSSN"];				// 구매자 주민번호
    $LGD_PRODUCTCODE         = $_POST["LGD_PRODUCTCODE"];			// 상품코드
    $LGD_RECEIVER            = $_POST["LGD_RECEIVER"];				// 수취인
    $LGD_RECEIVERPHONE       = $_POST["LGD_RECEIVERPHONE"];			// 수취인 전화번호
    $LGD_DELIVERYINFO        = $_POST["LGD_DELIVERYINFO"];			// 배송지
      
	$LGD_MERTKEY = "a6865af30975c744971942494249e29d";				//LG유플러스에서 발급한 상점키로 변경해 주시기 바랍니다.
	
    $LGD_HASHDATA2 = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_RESPCODE.$LGD_TIMESTAMP.$LGD_MERTKEY);
    
    /*
     * 상점 처리결과 리턴메세지
     *
     * OK  : 상점 처리결과 성공
     * 그외 : 상점 처리결과 실패
     *
     * ※ 주의사항 : 성공시 'OK' 문자이외의 다른문자열이 포함되면 실패처리 되오니 주의하시기 바랍니다.
     */
    $resultMSG = "결제결과 상점 DB처리(LGD_CASNOTEURL) 결과값을 입력해 주시기 바랍니다.";

    
    if ( $LGD_HASHDATA2 == $LGD_HASHDATA ) { //해쉬값 검증이 성공이면
        if ( "0000" == $LGD_RESPCODE ){ //결제가 성공이면
        	if( "R" == $LGD_CASFLAG ) {
                /*
                 * 무통장 할당 성공 결과 상점 처리(DB) 부분
                 * 상점 결과 처리가 정상이면 "OK"
                 */    
                //if( 무통장 할당 성공 상점처리결과 성공 ) 
                $resultMSG = "OK";   
        	}else if( "I" == $LGD_CASFLAG ) {
 	            /*
    	         * 무통장 입금 성공 결과 상점 처리(DB) 부분
        	     * 상점 결과 처리가 정상이면 "OK"
            	 */    
            	//if( 무통장 입금 성공 상점처리결과 성공 ) 
            	$resultMSG = "OK";
        	}else if( "C" == $LGD_CASFLAG ) {
 	            /*
    	         * 무통장 입금취소 성공 결과 상점 처리(DB) 부분
        	     * 상점 결과 처리가 정상이면 "OK"
            	 */    
            	//if( 무통장 입금취소 성공 상점처리결과 성공 ) 
            	$resultMSG = "OK";
        	}
        } else { //결제가 실패이면
            /*
             * 거래실패 결과 상점 처리(DB) 부분
             * 상점결과 처리가 정상이면 "OK"
             */  
            //if( 결제실패 상점처리결과 성공 ) 
            $resultMSG = "OK";     
        }
    } else { //해쉬값이 검증이 실패이면
        /*
         * hashdata검증 실패 로그를 처리하시기 바랍니다. 
         */      
        $resultMSG = "결제결과 상점 DB처리(LGD_CASNOTEURL) 해쉬값 검증이 실패하였습니다.";     
    }
    
    echo $resultMSG;
?>

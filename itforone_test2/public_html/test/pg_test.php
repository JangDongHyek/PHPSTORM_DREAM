<?php
/**
 * 대표님 PG 테스트
 */
include_once "../common.php";
// include_once "../head.sub.php";

// 에러메시지, 오류메시지 확인 출력
error_reporting(E_ALL);
ini_set("display_errors", 1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- UI 스타일 시작 -->
    <!-- 아래 스타일 시트는 샘플페이지를 위해 작성된 내용으로 결제요청시에는 포함하지 않아도 됩니다. -->
    <style type="text/css">
        body{margin:0;}
        article h2{display: block;width: 100%;font-size: 16px;text-align:center;margin-bottom:20px;}
        form { width:100%;}
        form table{padding:20px 0 0 0px;width:100%;}
        form td{padding:0 0px 5px 0;text-align: left;font-size:12px;}
        form td.title{width: 180px;font-size:12px;}
        .hidden{height:100%; min-height:100%; overflow:hidden !important; touch-action:none;}
        form input{border: 1px solid #aaa;border-radius: 0;padding-left: 10px;width:100%;}
        form .btn_submit{width:150px; border-radius: 4px; padding: 0; margin: 20px 0;height: 30px;background-color: #1e5dd2;border: none;color: #fff;font-weight: bold;font-size:12px;}
        .lb{font-size:12px;}
        .logo{text-align:center;margin-bottom:10px;}
        @media screen and (max-device-width : 736px){form{width: 100%;}form input{width:200px;}}
    </style>
    <!-- UI 스타일 끝 -->

    <!-- InnoPay 결제연동 스크립트(필수) -->
    <script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/innopay-2.0.js" charset="utf-8"></script>
    <!-- <script type="text/javascript" src="./js/innopay-2.0.js" charset="utf-8"></script> -->
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery("input[name=btn_pay]").click(function(){
                // 결제요청 함수
                innopay.goPay({
                        //// 필수 파라미터
                        PayMethod: frm.PayMethod.value,		// 결제수단(CARD,BANK,VBANK,CARS,CSMS,DSMS,EPAY,EBANK)
                        MID: frm.MID.value,							// 가맹점 MID
                        MerchantKey:frm.MerchantKey.value,	// 가맹점 라이센스키
                        GoodsName:frm.GoodsName.value,		// 상품명
                        Amt:frm.Amt.value,							// 결제금액(과세)
                        BuyerName:frm.BuyerName.value,		// 고객명
                        BuyerTel:frm.BuyerTel.value,				// 고객전화번호
                        BuyerEmail:frm.BuyerEmail.value,			// 고객이메일
                        ResultYN:frm.ResultYN.value,				// 결제결과창 출력유뮤
                        Moid:'testpay01m01234567890',			// 가맹점에서 생성한 주문번호 셋팅
                        //// 선택 파라미터
                        ReturnURL:frm.ReturnURL.value,			// 결제결과 전송 URL(없는 경우 아래 innopay_result 함수에 결제결과가 전송됨)
//			ArsConnType:'02', 							///* ARS 결제 연동시 필수 01:호전환, 02(가상번호), 03:대표번호 */

//			FORWARD:'',									// 결제창 연동방식 (X:레이어, 기본값)
//			GoodsCnt:'',									// 상품갯수 (가맹점 참고용)
//			MallReserved:'',								// 가맹점 데이터
//			OfferingPeriod:'',								// 제공기간
//			DutyFreeAmt:'',								// 결제금액(복합과세/면세 가맹점의 경우 금액설정)
//			EncodingType:'utf-8',						// 가맹점 서버 인코딩 타입 (utf-8, euc-kr)
//			MallIP:'',											// 가맹점 서버 IP
//			UserIP:'',											// 고객 PC IP
//			mallUserID:'',									// 가맹점 고객ID
//			User_ID:'',										// Innopay에 등록된 영업사원ID
                        Currency:''										// 통화코드가 원화가 아닌 경우만 사용(KRW/USD)
                    }
                );
            });
        });

        /**
         * 결제결과 수신 Javascript 함수
         * ReturnURL이 없는 경우 아래 함수로 결과가 리턴됩니다 (함수명 변경불가!)
         */
        function innopay_result(data){
            var a = JSON.stringify(data);
            // Sample
            var mid = data.MID;					// 가맹점 MID
            var tid = data.TID;					// 거래고유번호
            var amt = data.Amt;					// 금액
            var moid = data.MOID;				// 주문번호
            var authdate = data.AuthDate;		// 승인일자
            var authcode = data.AuthCode;		// 승인번호
            var resultcode = data.ResultCode;	// 결과코드(PG)
            var resultmsg = data.ResultMsg;		// 결과메세지(PG)
            var errorcode = data.ErrorCode;		// 에러코드(상위기관)
            var errormsg = data.ErrorMsg;		// 에러메세지(상위기관)
            var EPayCl   = data.EPayCl;
            alert("["+resultcode+"]"+resultmsg);
        }
    </script>

    <!-- 샘플 HTML -->
    <title>INNOPAY 전자결제서비스</title>
</head>
<body>
<div style="padding:20px;display:inline-block;max-width:600px;">
    <header>
        <h1 class="logo"><a href="http://web.innopay.co.kr/" target="_blank"><img src="https://pg.innopay.co.kr/ipay/images/innopay_logo.png" alt="INNOPAY 전자결제서비스 logo" height="26px" width="auto" border="0"></a></h1>
    </header>
    <article>
        <h2>쇼핑몰 결제요청 샘플 페이지</h2>
        <form action="" name="frm" id="frm" method="post">
            <table>
                <caption>쇼핑몰 결제요청 폼</caption>
                <tbody>
                <tr>
                    <td class="title" class="title"><div><b>결제수단</b></div></td>
                    <td>
                        <div id="pay_method">
                            <select style="width:100%;" name="PayMethod" id="PayMethod">
                                <!-- 아래 각 결제수단별로 서비스를 신청하셔야 합니다 -->
                                <option value="CARD">신용카드(일반)</option>
                                <option value="BANK">계좌이체</option>
                                <option value="VBANK">무통장입금(가상계좌)</option>
                                <option value="CARS">ARSPAY Web LINK</option>
                                <option value="CSMS">SMS카드결제 Web LINK(인증)</option>
                                <option value="DSMS">SMS카드결제 Web LINK(수기)</option>
                                <option value="EPAY">간편결제</option>
                                <option value="EBANK">계좌간편결제</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>상점 MID</b></div></td>
                    <td class=''>
                        <div>
                            <input type="text" name="MID" value="pgdreamfom" style="width:40%;"> (발급받은 상점MID를 입력)
                            <!-- <input type="text" name="MID" value="i00000001m" style="width:40%;"> (발급받은 상점MID를 입력) -->
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>상점 라이센스키</b></div></td>
                    <td class=''>
                        <div>
                            <input type="text" style="width:100%;" name="MerchantKey" value="y9tG9hJtyAzLIxyYXB/hhjKCCqI3gwTY1O2R5GANG5Yxg3X/esKzOHkFZMmLMsj9jwI93VJf8kKOn2ic0MwhMA=="> <!-- 발급된 가맹점키 -->
                            <!-- <input type="text" style="width:100%;" name="MerchantKey" value="TEST"> --> <!-- 발급된 가맹점키 -->
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title" class="title"><div><b>상품명</b></div></td>
                    <td>
                        <div>
                            <input type="text" name="GoodsName" value="아이티포원 테스트결제" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>상품가격</b></div></td>
                    <td>
                        <div>
                            <input type="text" name="Amt" value="100" onKeyUp="javascript:numOnly(this,document.frm,false);">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>구매자명</b></div></td>
                    <td>
                        <div>
                            <input type="text" name="BuyerName" value="mn_홍길동" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>구매자 연락처</b></div></td>
                    <td>
                        <div>
                            <input type="text" name="BuyerTel" value="01026120220" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>구매자 이메일 주소</b></div></td>
                    <td>
                        <div>
                            <input type="text" name="BuyerEmail" value="dreamforone@naver.com" placeholder="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="title"><div><b>PG결제결과창 유무</b></div></td>
                    <td class="">
                        <div>
                            <input type="text" name="ResultYN" value="Y" style="width:8%;"> (N:결제결과창 없음, 가맹점 ReturnURL로 결과전송)
                        </div>
                    </td>
                </tr>
                <tr height="10">
                    <td></td><td></td>
                </tr>
                <!-- 선택 파라미터 -->
                <tr>
                    <td class="title"><div>결제결과전송 URL</div></td>
                    <td>
                        <div>
                            <input type="text" name="ReturnURL" value="http://letsit.kr/~itforone_test2/test/pg_return.php" placeholder="">
                            <br> (ReturnURL 이 없는 경우 현재페이지로 결제결과가 전송됩니다)
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div align="center" style="height:50px;">
                <input type="button" class="btn_submit" name="btn_pay" value="결제요청" >
            </div>
            <div style="height:10px;"></div>
        </form>
        <!-- End Form -->
    </article>
    <footer style="margin-top: 20px;">
        <ul class='lb'>
            <li>고객지원: 1688-1250</li>
            <li>
                <span>결제내역조회</span>
                <a href="http://web.innopay.co.kr/" title="결제내역조회 페이지 이동 ">web.innopay.co.kr</a>
            </li>
        </ul>
    </footer>
</div>
</body>
</html>




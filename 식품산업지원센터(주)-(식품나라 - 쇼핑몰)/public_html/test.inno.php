<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" type="text/css" href="./css/jquery.mCustomScrollbar.css" />
<link rel="stylesheet" type="text/css" href="./css/common.css" />
<style type="text/css">
article h2{display: block;width: 100%;font-size: 16px;}
form { width:540px;}
form table{padding:20px 0 0 0px;width: 100%;}
form td{padding:0 0px 5px 0;text-align: left;}
form td.title{width: 150px;}
form input{border: 1px solid #aaa;border-radius: 0;padding-left: 10px;width: 100%;}
form .btn_submit{width: 100%; border-radius: 4px; padding: 0; margin: 20px 0;height: 40px;background-color: #1e5dd2;border: none;color: #fff;font-weight: bold;}
@media screen and (max-device-width : 736px){form{width: 100%;}}
</style>
<link href='./css/font.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<!-- InnoPay 결제연동 스크립트(필수) -->
<script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#PayMethod").change(function(){
            if("VBANK"==$("#payMethod").val()){
            	$("#VbankExpDate").removeAttr("disabled");
            	$("#VbankExpDate").val(ediDate.substring(0, 8));
            }else{
            	$("#VbankExpDate").attr("disabled",true);
            }
        });
    });
</script>
<title>INNOPAY 전자결제서비스</title>
</head>
<body>
<!-- *** #wrapper -->
    <div style="padding:30px;">
        <header>
            <h1 class="logo"><img src="images/innopay_logo.png" alt="INNOPAY 전자결제서비스 logo" height="26px" width="auto"></h1>
        </header>
        <article>
            <h2>쇼핑몰 결제요청 샘플 페이지</h2>
            <form action="" name="frm" id="frm" method="post" style=""> 
                <table>
                    <caption>쇼핑몰 결제요청 폼</caption>
                    <tbody>
                        <tr>
                            <td class="title">
                                <div><b>결제수단</b></div>
                            </td>
                            <td>
                                <div id="pay_method">
                                    <select style="width: 100%;" name="PayMethod" id="PayMethod">
                                        <option value="CARD">신용카드</option>
										<option value="BANK">계좌이체</option>
										<option value="VBANK">가상계좌</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="title">
                                <div><b>상품개수</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="GoodsCnt" value="1" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title" class="title">
                                <div><b>상품명</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="GoodsName" value="테스트상품" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>상품가격</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="Amt" value="1000" placeholder="" onKeyUp="javascript:numOnly(this,document.frm,false);">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>가맹점주문번호</b></div>
                            </td>
                            <td>
                                <div><!-- 가맹점에서 사용하는 주문번호 -->
                                    <input type="text" name="Moid" value="mnoid1234567890" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>상점 MID</b></div>
                            </td>
                            <td>
                                <div>
                                    <select style="width: 100%;" name="MID" id="MID">
                                        <option value="testpay01m">testpay01m(인증)</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <div><b>결제결과전송 URL</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="ReturnURL" value="https://pg.innopay.co.kr/pay/returnPay.jsp" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>결제결과창 유무</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="ResultYN" value="N" > (N:결제결과창 없음)
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>결제결과 RETRY URL</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="RetryURL" value="https://pg.innopay.co.kr/pay/returnPay.jsp" placeholder="">
                                    (결제완료 후 결제결과 재전송)
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div>상점 결제 회원 ID</div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="mallUserID" value="mn_test" maxlength="30" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div><b>구매자명</b></div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="BuyerName" value="mn_홍길동" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div>구매자 연락처</div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="BuyerTel" value="012345678" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div>구매자 이메일 주소</div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="BuyerEmail" value="test@test.co.kr" placeholder="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <div>제공기간</div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="OfferingPeriod" value="2016.1.25 ~ 2016.5.25" placeholder="">
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="title">
                                <div>입금예정일(가상계좌)</div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="VbankExpDate" id="VbankExpDate" value="" disabled placeholder="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <div>인코딩타입</div>
                            </td>
                            <td>
                                <div>
                                    <select style="width: 100%;" name="EncodingType" id="EncodingType">
                                        <option value="">[선택]</option>
			                            <option value="euc-kr">[EUC-KR]</option>
			                            <option value="utf-8">[UTF-8]</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <div>결제창 팝업유무</div>
                            </td>
                            <td>
                                <div>
                                    <select style="width: 100%;" name="FORWARD" id="FORWARD">
                                        <option value="Y">Y</option>
			                            <option value="N">N</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <a class="btn_submit btn" href="#" onclick="return goPay(frm)">결제</a>
                </div>
                
                <div>
					<font color=red>※ 결제창을 Pop-up 방식으로 연동하는 경우 반드시 브라우저 Pop-up 해제를 설정해 주시기 바랍니다.</font> 
                </div>
            <!--hidden 데이타 필수-->
            <input type="hidden" name="ediDate" value=""> <!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
            <input type="hidden" name="MerchantKey" value="Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg=="> <!-- 발급된 가맹점키 -->
            <input type="hidden" name="EncryptData" value=""> <!-- 암호화데이터 -->
		    <input type="hidden" name="MallIP" value="127.0.0.1"/> <!-- 가맹점서버 IP 가맹점에서 설정-->
		    <input type="hidden" name="UserIP" value="127.0.0.1"> <!-- 구매자 IP 가맹점에서 설정-->
		    <!-- <input type="hidden" name="FORWARD" value="Y"> Y:팝업연동 N:페이지전환 -->
            <input type="hidden" name="MallResultFWD"   value="N"> <!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
		    <input type="hidden" name="device" value=""> <!-- 자동셋팅 -->
		    <!--hidden 데이타 옵션-->
		    <input type="hidden" name="BrowserType" value="">
            <input type="hidden" name="MallReserved" value="">
		    <!-- 현재는 사용안함 -->
		    <input type="hidden" name="SUB_ID" value=""> <!-- 서브몰 ID -->
            <input type="hidden" name="BuyerPostNo" value="" > <!-- 배송지 우편번호 -->
            <input type="hidden" name="BuyerAddr" value=""> <!-- 배송지주소 -->
		    <input type="hidden" name="BuyerAuthNum">
		    <input type="hidden" name="ParentEmail">
            </form>
<!-- End Form -->            
        </article>

        <footer style="margin-top: 20px;">
            <ul>
                <li>고객지원: 1688-1250</li>
                <li>
                    <span>결제내역조회</span>
                    <a href="https://web.innopay.co.kr" title="결제내역조회 페이지 이동 ">web.innopay.co.kr</a>
                </li>
            </ul>
        </footer>
        
    </div>
    
    <!-- //*** #wrapper -->
</body>
</html>
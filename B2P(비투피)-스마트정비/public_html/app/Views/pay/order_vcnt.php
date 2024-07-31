<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
/* ============================================================================== */
/* =   PAGE : 가상계좌 발급 요청 PAGE                                           = */
/* = -------------------------------------------------------------------------- = */
/* =   Copyright (c)  2024  NHN KCP Inc.   All Rights Reserverd.                = */
/* ============================================================================== */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>*** NHN KCP FIXED VCNT ***</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
    <link href="/css/KCP_vcnt.css?v=<?= filemtime(FCPATH . 'css/KCP_vcnt.css'); ?>" rel="stylesheet" type="text/css" id="cssLink"/>

    <script language="javascript">

        /* 주문번호 생성 예제 */
        function init_orderid()
        {
            var today = new Date();
            var year  = today.getFullYear();
            var month = today.getMonth() + 1;
            var date  = today.getDate();
            var time  = today.getTime();
            var time2  = today.getHours();
            var time3  = today.getMinutes();
            var time4  = today.getSeconds();

            if(parseInt(month) < 10) {
                month = "0" + month;
            }

            if(parseInt(date) < 10) {
                date = "0" + date;
            }

            var order_idxx = "B2P_" + year + "" + month + "" + date + "" + time;
            var ipgm_date = "" + year + "" + month + "" + date + "" + time2 + time3 + time4;
            ipgm_date = String(ipgm_date).padEnd(14, "0");
            var va_uniq_key = "" + time;

            document.order_info.ordr_idxx.value = order_idxx;
            document.order_info.ipgm_date.value = ipgm_date;
            document.order_info.va_uniq_key.value = va_uniq_key;
        }

        function  jsf__chk_ssl_vcnt( form )
        {
            if (form.va_uniq_key.value == "")
            {
                alert("유니크 키를 정확히 입력해 주시기 바랍니다.");
                form.va_uniq_key.focus();
                return false;
            }
            else if (form.ipgm_name.value == "")
            {
                alert("입금자명을 입력해 주시기 바랍니다.");
                form.ipgm_name.focus();
                return false;
            }
            else if (form.ipgm_bank.value == "XXXX")
            {
                alert("입금은행을 선택해 주시기 바랍니다.");
                form.ipgm_bank.focus();
                return false;
            }
            else if (form.ipgm_date.value == "")
            {
                alert("입금예정일을 입력해 주시기 바랍니다.");
                form.ipgm_date.focus();
                return false;
            }
            else
            {
                return true;
            }
        }

        function  jsf__pay_vcnt( form )
        {

            if ( jsf__chk_ssl_vcnt( form ) == false )
            {
                return false;
            }

            form.submit();
        }

    </script>
</head>
<body onload="init_orderid();">
<div id="sample_wrap">
    <form name="order_info" method="post" action="<?=base_url()?>pay/OrderVcntPop" accept-charset="euc-kr" onsubmit="document.charset='euc-kr';">
        <h1>[고정식 가상계좌 요청] <span></span></h1>
        <!-- 상단 문구 -->
        <div class="sample">
            <p>결제에 필요한 정보를 정확하게 입력하시어 결제를 진행하시기 바랍니다.</p>
            <!-- 상단 테이블 End -->

            <!-- 주문정보 타이틀 -->
            <h2>&sdot; 주문 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 주문 번호 -->
                <tr>
                    <th>주문 번호</th>
                    <td><input type="text" name="ordr_idxx" class="w200" value="" maxlength="40"/></td>
                </tr>
                <!-- 유니크 키(가상계좌 고유 키) -->
                <tr>
                    <th>유니크 키(고유 키)</th>
                    <td><input type="text" name="va_uniq_key" class="w100" value=""maxlength="20"/></td>
                </tr>
                <!-- 상품명 -->
                <tr>
                    <th>상품명</th>
                    <td><input type="text" name="good_name" class="w100" value="핸드폰" /></td>
                </tr>
                <!-- 주문자 이름 -->
                <tr>
                    <th>주문자명</th>
                    <td><input type="text" name="buyr_name" class="w100" value="홍길동" maxlength="20" /></td>
                </tr>
                <!-- 주문자 이름 -->
                <tr>
                    <th>주문자 E-Mail</th>
                    <td><input type="text" name="buyr_mail" class="w100" value="test@kcp.co.kr" maxlength="40" /></td>
                </tr>
                <!-- 주문자 이름 -->
                <tr>
                    <th>주문자 전화번호</th>
                    <td><input type="text" name="buyr_tel1" class="w100" value="02-0000-1000" maxlength="20" /></td>
                </tr>
                <!-- 주문자 이름 -->
                <tr>
                    <th>주문자 휴대폰번호</th>
                    <td><input type="text" name="buyr_tel2" class="w100" value="010-1234-5678" maxlength="20" /></td>
                </tr>

            </table>
            <!-- 주문 정보 출력 테이블 End -->

            <!-- 결제정보 타이틀 -->
            <h2>&sdot; 결제 정보</h2>
            <table class="tbl" cellpadding="0" cellspacing="0">
                <!-- 입금 금액 -->
                <tr>
                    <th>입금 금액</th>
                    <td><input type="text" name="good_mny" class="w100" value="1004" maxlength="9"/>원(숫자만 입력)</td>
                </tr>
                <!-- 입금자명 -->
                <tr>
                    <th>입금자명</th>
                    <td><input type="text" name="ipgm_name" value="" maxlength="10"></td>
                </tr>
                <!-- 입금은행 -->
                <tr>
                    <th>입금은행</th>
                    <td>
                        <select name="ipgm_bank">
                            <option value="XXXX" selected>선택</option>
                            <option value="BK03">기업은행</option>
                            <option value="BK04">국민은행</option>
                            <option value="BK07">수협은행</option>
                            <option value="BK11">농협중앙회</option>
                            <option value="BK20">우리은행</option>
                            <option value="BK23">SC제일은행</option>
                            <option value="BK32">부산은행</option>
                            <option value="BK34">광주은행</option>
                            <option value="BK71">우체국</option>
                            <option value="BK81">KEB하나은행</option>
                            <option value="BK26">신한은행</option>
                            <option value="BK31">대구은행</option>
                            <option value="BK39">경남은행</option>
                        </select>
                    </td>
                <tr>
                    <th>입금 예정일</th>
                    <td><input type="text" name="ipgm_date" value="" maxlength="14"> ( 예: 20231228142019 )</td>
                </tr>
            </table>

            <!-- 가상계좌 발급 요청  Start -->

            <div class="btnset" id="display_pay_button" style="display:block">
                <input name="" type="button" class="submit" value="발급요청" onclick="jsf__pay_vcnt(this.form);"/>
                <a href="../index.php" class="home">처음으로</a>
            </div>
        </div>
        <!-- 가상계좌 발급 요청 End -->
        <div class="footer">
            Copyright (c) NHN KCP INC. All Rights reserved.
        </div>

        <!-- KCP 관련 필수항목 수정불가 -->
        <input type="hidden" name="currency"    value="410">  <!-- 필수 항목 : 결제 금액/화폐단위 -->

    </form>
</div>
</body>
</html>
<?php
include_once('./_common.php');
$g5['title'] = "온라인 결제";
include_once(G5_PATH.'/head.php');
$Moid = date('YmdHis',strtotime(G5_TIME_YMDHIS)).'-'.$mb_no;
?>
<style>
    /*스크롤디자인*/
    textarea::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    textarea::-webkit-scrollbar-thumb {
        background-color: #EA5A4F;
        border-radius: 10px;
        background-clip: padding-box;
        border: 1px solid transparent;
    }
    textarea::-webkit-scrollbar-track {
        background-color: #e7e7e7;
        border-radius: 10px;
    }

    input{border-radius: 6px; height: 46px; line-height: 44px!important; background-color: #f8f8f8; border: 1px solid #eee; color: #1a1a1c; padding: 10px; display: block; font-size: 1em!important; opacity: 1; margin-bottom: 8px; width: 100%;}
    input:disabled,
    input:read-only {   background-color: rgba(233, 235, 241); border: 0 ;}
    textarea {  background-color: #FFFFFF; border: 1px solid #eeeeee;   border-radius: 3px; color: #1a1a1c; padding: 10px; display: block; font-size: 1em!important; line-height: 1.6em!important; opacity: 1; margin-bottom: 8px; width: 100%;}
    textarea:disabled,
    textarea:read-only {   background-color: #f3f3f3; border: 0 ;}
    input:last-child{margin-bottom: 0;}
    input::placeholder{opacity: 0.8;}

    /*네모형 라디오*/
    .select input[type=radio]{    display: none;}
    .select input[type=radio]+label{    border-radius: 10px; display: inline-block;    cursor: pointer;    height: 46px; padding: 0 10px;  background-color: #fff;    color: #373844;    line-height: 44px;    text-align: center;  font-weight:400; margin-right: 0; n}
    .select input[type=radio]+label{    background-color: #fff;    color: #373844;  border: 1px solid #C9C9C9;}
    .select input[type=radio]:disabled+label{    background-color: #c9c9c9;    color: #373844;}
    .select input[type=radio]:checked+label{background-color: #EA5A4F12;    border: 1px solid #EA5A4F;  color: #EA5A4F; font-weight:700;}

    .form .txt_red{color:#EA5A4F}
    .payment{max-width: 800px; margin: 0 auto; padding: 2rem;}
    .payment .box{background-color: #eeeeee56; padding: 4rem; border-radius: 20px;}
    .payment h4{font-size: 1.4em; line-height: 1.4em; font-weight: 600; margin-bottom: 16px;}

    .payment .agree textarea{min-height: 160px;}
    .payment .form dl{margin-bottom: 2rem;}
    .payment .form dt{margin-bottom: 4px;}

    .payment .select{display: flex; align-items: center; gap: 6px;}
    .payment .select input[type=radio]+label{width: 100%;}

    .payment .btn_wrap{display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 60px;}
    .payment .btn_wrap button{ display: inline-block; height: 50px; line-height: 50px; max-width: 40%; width: 220px; text-align: center; border: 0; font-size: 1.2em; font-weight: 500; border-radius: 6px;}
    .payment .btn_wrap button.btn_red{background-color: #EA5A4F; color: #fff;}
    .payment .btn_wrap button.btn_gray{background-color: #eee;}

</style>

<div class="payment">
    <div class="box agree">
        <h4>개인 신용정보 수집·이용·제공·취급·위탁에 대한 필수적 동의</h4>
        <textarea>
'디자인우진'은 (이하 '회사'는) 고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 회사는 개인정보취급방침을 개정하는 경우
웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.

■ 수집하는 개인정보 항목회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.
○수집항목 : 이름 , 생년월일 , 성별 , 로그인ID , 비밀번호 , 비밀번호 질문과 답변 , 자택 전화번호 , 자택 주소 , 휴대전화번호 , 이메일 , 직업 , 회사명 , 부서 , 직책 , 회사전화번호 , 취미 , 결혼여부 , 기념일 , 법정대리인정보 , 서비스 이용기록 , 접속 로그 , 접속 IP 정보 , 결제기록
○개인정보 수집방법 : 홈페이지(회원가입) , 서면양식

■ 개인정보의 수집 및 이용목적회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.ο 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산 콘텐츠 제공 , 구매 및 요금 결제 , 물품배송 또는 청구지 등 발송ο 회원 관리회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 연령확인 , 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인 , 고지사항 전달
○ 마케팅 및 광고에 활용접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계

■ 개인정보의 보유 및 이용기간회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외 없이 해당 정보를 지체 없이 파기합니다.

■ 개인정보의 파기절차 및 방법회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.
○ 파기절차회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다.별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.
○ 파기방법- 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.

■ 개인정보 제공회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다. 다만, 아래의 경우에는 예외로 합니다.
- 이용자들이 사전에 동의한 경우- 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우

■ 수집한 개인정보의 위탁회사는 서비스 제공 및 향상을 위하여 아래와 같이 개인정보를 위탁하고 있으며, 관계 법령에 따라 위탁계약시 개인정보가 안전하게 관리될 수 있도록 필요한 사항을 규정하고 있습니다.회사의 개인정보 수탁업체 및 위탁업무의 내용은 아래와 같습니다.
───────────────────────────────────
수탁업체 : 위탁업무 내용
───────────────────────────────────
　　　　　　ⅩⅩ　　　　　: 상품배송
───────────────────────────────────
　　　　　　ⅩⅩ　　　　　: 결제, 구매안전서비스 제공등
───────────────────────────────────
　　　　　　ⅩⅩ　　　　　: 실명확인, 본인인증
───────────────────────────────────

■ 이용자 및 법정대리인의 권리와 그 행사방법이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니 다.이용자 혹은 만 14세 미만 아동의 개인정보 조회,수정을 위해서는 ‘개인정보변 경’(또는 ‘회원정보수정’ 등)을 가입해지(동의철회)를 위해서는 “회원탈퇴”를 클릭 하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다. 혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조 치하겠습니다.귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까 지 당해 개인정보를 이용 또는 제공하지 않습니다. 또한 잘못된 개인정보를 제3자 에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체없이 통지하여 정정이 이루어지도록 하겠습니다. 회사는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 “회사가 수집하는 개인정보의 보유 및 이용기간”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.

■ 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항회사는 귀하의 정보를 수시로 저장하고 찾아내는 ‘쿠키(cookie)’ 등을 운용합니다. 쿠키란 회사의 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다. 회사은(는) 다음과 같은 목적을 위해 쿠키를 사용합니다.

▶ 쿠키 등 사용 목적- 회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스 제공귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 귀하는 웹브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.

▶ 쿠키 설정 거부 방법 예: 쿠키 설정을 거부하는 방법으로는 회원님이 사용하시는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다.설정방법 예(인터넷 익스플로어의 경우): 웹 브라우저 상단의 도구 > 인터넷 옵션 > 개인정보단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.

■ 개인정보에 관한 민원서비스회사는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다.

고객서비스담당 부서 :
이메일 :
개인정보관리책임자 성명 :
전화번호 :
이메일 :

귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다. 회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.

기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.
1.개인분쟁조정위원회 (www.1336.or.kr/1336)
2.정보보호마크인증위원회 (www.eprivacy.or.kr/02-580-0533~4)
3.대검찰청 인터넷범죄수사센터 (http://icic.sppo.go.kr/02-3480-3600)
4.경찰청 사이버테러대응센터 (www.ctrc.go.kr/02-392-0330)​​
        </textarea>
    </div>

    <div class="form">
        <form>
            <h4>결제정보</h4>
            <dl>
                <dt>기관명 <span class="txt_red">*</span></dt>
                <dd><input id="buyer_name" type="text" placeholder="기관명 또는 성함을 입력해주세요" required></dd>
            </dl>
            <dl>
                <dt>품목 <span class="txt_red">*</span></dt>
                <dd><input id="good_name" type="text" placeholder="품목을 입력해주세요" required></dd>
            </dl>
            <dl>
                <dt>연락처 <span class="txt_red">*</span></dt>
                <dd><input id="buyer_hp" type="text" placeholder="연락처를 입력해주세요" required maxlength="13" ></dd>
            </dl>
            <dl>
                <dt>이메일 <span class="txt_red">*</span></dt>
                <dd><input id="buyer_email" type="text" placeholder="이메일을 입력해주세요" required></dd>
            </dl>
            <dl>
                <dt>결제금액 <span class="txt_red">*</span></dt>
                <dd class="select">
                    <input type="radio" id="price10" name="price" required checked value="100000"><label for="price10">10만원</label>
                    <input type="radio" id="price20" name="price" required value="200000"><label for="price20">20만원</label>
                    <input type="radio" id="price30" name="price" required value="300000"><label for="price30">30만원</label>
                </dd>
            </dl>
            <div class="btn_wrap">
                <button type="button" class="btn_red" onclick="payment()">결제하기</button>
                <button class="btn_gray">취소</button>
            </div>
        </form>
    </div>

</div>
    <script type="text/javascript" src="https://pg.innopay.co.kr/pay/js/Innopay.js"></script><!-- InnoPay 결제연동 스크립트(필수) -->
    <!--<script type="text/javascript" src="<?/*=G5_JS_URL*/?>/Innopay.js"></script>--><!-- InnoPay 결제연동 스크립트(필수) -->
    <form id="payfrm" name="payfrm" method="post">
        <!-- 이노페이 필수 -->
        <input type="hidden" name="PayMethod" value="CARD">
        <input type="hidden" name="GoodsCnt" value="1">
        <input type="hidden" name="GoodsName" id="GoodsName" value="">
        <input type="hidden" name="Amt" id="Amt" value="">
        <input type="hidden" name="Moid" id="Moid" value="<?=$Moid?>">
        <?php if(1) { ?>
            <input type="hidden" name="MID" value="testpay01m"> <!-- 테스트 : testpay01m -->
            <input type="hidden" name="MerchantKey" value="Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
        <?php } else { ?>
            <input type="hidden" name="MID" value="pgcsignalm"> <!-- 테스트 : testpay01m -->
            <input type="hidden" name="MerchantKey" value="5xX2sDs2cMv6g/tvLaFRlBHH2iDs9YJMf5p33Zu702qSy4Fj7DTrUSF2Q8X9OPWVWITJW3Sr3GuXWmaWK//cwg=="> <!-- 테스트 : Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg== -->
        <?php } ?>
        <input type="hidden" name="ReturnURL" value="<?=G5_BBS_URL?>/payment_result.php">
        <input type="hidden" name="RetryURL" value="<?=G5_BBS_URL?>/payment_result.php">
        <input type="hidden" name="ResultYN" value="N">

        <input type="hidden" name="mallUserID" value="<?=$member['mb_id']?>">
        <input type="hidden" name="BuyerName" id="BuyerName" value="<?=$member['mb_name']?>">
        <input type="text" name="BuyerTel" id="BuyerTel" value="<?=str_replace ("-","",$member["mb_hp"])?>">
        <input type="hidden" name="BuyerEmail" id="BuyerEmail" value="">
        <input type="hidden" name="EncodingType" id="EncodingType" value="utf-8">
        <input type="hidden" name="FORWARD" value="N"><!-- 팝업유무 Y,N -->

        <input type="hidden" name="ediDate" value=""><!-- 결제요청일시 제공된 js 내 setEdiDate 함수를 사용하거나 가맹점에서 설정 yyyyMMddHHmmss-->
        <input type="hidden" name="EncryptData" value=""><!-- 암호화데이터 -->
        <input type="hidden" name="MallIP" value="127.0.0.1"/>
        <input type="hidden" name="UserIP" value="127.0.0.1">
        <input type="hidden" name="MallResultFWD" value="N"><!-- Y 인 경우 PG결제결과창을 보이지 않음 -->
        <input type="hidden" name="device" value=""><!-- 자동셋팅 -->
    </form>

    <script>

        $(function() {
            $('#buyer_hp').keydown(function(event) {
                var key = event.charCode || event.keyCode || 0;
                $text = $(this);
                if (key !== 8 && key !== 9) {
                    if ($text.val().length === 3) {
                        $text.val($text.val() + '-');
                    }
                    if ($text.val().length === 8) {
                        $text.val($text.val() + '-');
                    }
                }

                return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
                // Key 8번 백스페이스, Key 9번 탭, Key 46번 Delete 부터 0 ~ 9까지, Key 96 ~ 105까지 넘버패트
                // 한마디로 JQuery 0 ~~~ 9 숫자 백스페이스, 탭, Delete 키 넘버패드외에는 입력못함
            })
        });
        // 결제하기
        function payment() {

            var Moid = '<?=$Moid?>';
            if(!$('#buyer_name').val()){
                alert('기관명을 입력해주세요.');
                $('#buyer_name').focus();
                return false;
            }

            if(!$('#good_name').val()){
                alert('품목을 입력해주세요.');
                $('#good_name').focus();
                return false;
            }

            if(!$('#buyer_hp').val()){
                alert('연락처를 입력해주세요.');
                $('#buyer_hp').focus();
                return false;
            }

            if(!$('#buyer_email').val()){
                alert('이메일을 입력해주세요.');
                $('#buyer_email').focus();
                return false;
            }
            
            $('#BuyerName').val($('#good_name').val());
            $('#GoodsName').val($('#buyer_name').val());
            //$('#BuyerTel').val($('#buyer_hp').val());

            // 정규식을 사용해 '-' 제거
            var buyer_hp = $('#buyer_hp').val();
            buyer_hp = buyer_hp.replace(/-/g, '');
            // 전화 리턴값으로 안옴 moid에 포함해서 잘라서 얻어내기
            $('#Moid').val(Moid + '-' + buyer_hp);

            $('#BuyerEmail').val($('#buyer_email').val());
            $('#Amt').val($("input[name='price']:checked").val());
            if('<?=$private?>' || '<?=$member['mb_id']?>' == 'admin' || '<?=$member['mb_id']?>' == 'lets080') {
                $('#Amt').val('10');
            }
            goPay(document.payfrm);
        }
    </script>
<?php
include_once(G5_PATH.'/tail.php');
?>
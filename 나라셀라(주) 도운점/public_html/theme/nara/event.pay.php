<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');


$class_idx = $_GET['idx'];

if(empty($class_idx)){
    alert('해당 CLASS는 종료되었거나 존재하지 않습니다.');
    exit;
}else if(!$is_member){
    alert('로그인 후 이용해주세요.');
    exit;
}

$info = getClassInfo($class_idx, $member['mb_id']);

if(empty($info)){
    alert('해당 CLASS는 종료되었거나 존재하지 않습니다.');
    exit;
}

$checkClass = checkClassEff($class_idx, $member['mb_id']);
        
if(empty($checkClass['result'])){
    alert($checkClass['msg']);
    exit;
}

?>

<style>
    .removeUser {
        font-size: 18px;
        cursor: pointer;
        margin-top: 20px;
    }
</style>

<script type="text/javascript" src="https://pg.innopay.co.kr/ipay/js/innopay-2.0.js" charset="utf-8"></script>
<form action="" name="frm" id="frm" method="post">
    <input type="hidden" id="MID" name="MID" value="<?= $info['floor'] == '2' ? MID_2FLOOR : MID ?>" />
    <input type="hidden" id="MerchantKey" name="MerchantKey" value="<?= $info['floor'] == '2' ? LICENSE_KEY_2FLOOR : LICENSE_KEY?>" />
    <input type="hidden" id="GoodsName" name="GoodsName" value="<?=substr($info['className'], 0, 20)?>" />
    <input type="hidden" id="BuyerName" name="BuyerName" value="<?=$member['mb_name']?>" />
    <input type="hidden" id="BuyerTel" name="BuyerTel" value="<?=unHyphen($member['mb_hp'])?>" />
    <input type="hidden" id="BuyerEmail" name="BuyerEmail" value="<?=$member['mb_email']?>" />
    <input type="hidden" id="ResultYN" name="ResultYN" value="N" />
    <input type="hidden" id="ReturnURL" name="ReturnURL" value="" />

    <section id="class">

        <div class="classInfo v2">
            <div class="img">
                <img src="<?=$info['thumbnail']?>">
            </div>
            <div class="txt">
                <h2>
                    <span><?=$info['classStatus']?></span>
                </h2>
                <h2><?=$info['className']?></h2>
                <p><?=nl2br($info['content'])?></p>
                <h3>
                    <i class="fas fa-calendar-star"></i>
                    <?=replaceHyphenWithDot($info['eventDate'])?>일 <?=$info['eventTime1']?> ~ <?=$info['eventTime2']?><br>
                    <i class="fas fa-user-friends"></i> 정원 <?=$info['maxPerson']?>명
                </h3>
                <h4><strong><?=number_format($info['price'])?></strong> 원</h4>
            </div>
        </div>

        <div class="pay-warp">
            <h6>참여자 정보(<span id="totalUser">1</span>명)</h6>
            <span id="payUser">
                <div class="payUser pay2-wrap">
                    <input type="text" class="name" value="<?=$member['mb_name']?>" placeholder="이름">
                    <input type="date" class="birth" value="<?=$member['mb_1']?>" placeholder="생년월일">
                    <input type="text" class="hp" value="<?=$member['mb_hp']?>" placeholder="연락처">
                    <input type="text" class="email" value="<?=$member['mb_email']?>" placeholder="이메일">
                </div>
            </span>

            <button type="button" class="userAdd" onclick="addUser()">인원추가</button>

            <hr>
            <h6>약관동의</h6>
            <? if($info['floor'] == 2){ /* 2층 */ ?>
<textarea readonly>취소/환불 정책인 수업 7일 전까지 100% 환불 가능하며 기간 경과 후 취소를 희망하는 경우 별도 문의 바랍니다.
환불은 신청일로부터 최대 1~2주 가량 소요됩니다.
수강료 환불 시 반드시 결제하신 방식(카드/입금)으로만 환불 가능합니다.
최저 수강인원에 미달하는 경우와 그 외 불가피한 상황의 경우 강의가 취소될 수 있습니다.
이 경우 기간에 관계없이 100% 환불처리됩니다.
문의 02-547-1522 |  인스타 @the_dowoon DM
			</textarea>
            <? }else{ /* 6층 */ ?>
<textarea readonly>취소/환불 정책인 수업 7일 전까지 100% 환불 가능하며 기간 경과 후 취소를 희망하는 경우 별도 문의 바랍니다.
환불은 신청일로부터 최대 1~2주 가량 소요됩니다.
수강료 환불 시 반드시 결제하신 방식(카드/입금)으로만 환불 가능합니다.
최저 수강인원에 미달하는 경우와 그 외 불가피한 상황의 경우 강의가 취소될 수 있습니다.
이 경우 기간에 관계없이 100% 환불처리됩니다.
문의 02-543-1529 |  인스타 @the_dowoon DM
</textarea>
           	<? } ?>           	
           	
            <input type="checkbox" id="agree"><label for="agree" style="margin-bottom: 0;">동의합니다</label>

            <hr>
            <h6>결제 정보</h6>

            <? foreach(PAY_TYPE as $key => $name){ ?>
            <label class="">
                <input type="radio" name="PayMethod" class="payType" value="<?=$key?>">
                <?=$name?>
            </label>
            <? } ?>

            <!--
        <p>
            * 세금계산서 발행 필요정보<br>
            1) 개인(소득공제용) - 주민번호, 휴대전화번호 중 하나<br>
            2) 사업자(지출증빙용) - 사업자번호 </p>
        <hr>
        <h6>현금영수증 발행정보</h6>
        <div class="pay2-wrap">
            <input type="text" placeholder="현금영수증 번호">
        </div>
-->
        </div>
        <div class="pay3-wrap">
            <input type="hidden" id="Amt" name="Amt" value="<?=$info['price']?>" />
            <p>총 <strong id="totalPrice"><?=number_format($info['price'])?></strong> 원</p>
            <button onclick="classPaySumbit(<?=$class_idx?>)" type="button">결제하기</button>
        </div>

    </section>
</form>

<script>
    const $info = <?=json_encode($info)?>;
    const ReturnURL = '<?=G5_URL.'/returnPay.php?class_idx='.$info['class_idx']?>';

    function addUser() {
        let totalUser = parseInt($('.payUser').length) + 1,
            price = $info.price * totalUser,
            userHtml = `
            <div class="payUser pay2-wrap">
                <input type="text" class="name" placeholder="이름">
                <input type="date" class="birth" placeholder="생년월일">
                <input type="text" class="hp" placeholder="연락처">
                <input type="text" class="email" placeholder="이메일">
                <i class="fas fa-solid fa-user-slash removeUser" onclick="removeUser($(this))"></i>
            </div>`;

        $('#payUser').append(userHtml);
        $('#totalUser').text(totalUser);
        $('#totalPrice').text(comma(price));
        $('#Amt').val(price);
    }

    function removeUser($this) {
        let totalUser = parseInt($('.payUser').length) - 1,
            price = $info.price * totalUser;

        $this.parent().remove();
        $('#totalUser').text(totalUser);
        $('#totalPrice').text(comma(price));
        $('#Amt').val(price);
    }

    async function classPaySumbit(class_idx) {
        let $payUser = $('.payUser'),
            $agree = $('#agree'),
            $payType = $('.payType'),
            users = [];

        for (let i = 0; i < $payUser.length; i++) {

            let $user = $payUser.eq(i),
                $name = $user.children('.name'),
                $birth = $user.children('.birth'),
                $hp = $user.children('.hp'),
                $email = $user.children('.email');

            if (!$name.val()) {
                showAlert("이름을 입력해주세요.", $name.focus());
                return;
            } else if (!$birth.val()) {
                showAlert("생년월일을 입력해주세요.", $birth.focus());
                return;
            } else if (!$hp.val()) {
                showAlert("휴대번호를 입력해주세요.", $hp.focus());
                return;
            } else if (!$email.val()) {
                showAlert("이메일을 입력해주세요.", $email.focus());
                return;
            }

            users.push({
                name: $name.val(),
                birth: $birth.val(),
                hp: $hp.val(),
                email: $email.val()
            });
        }

        if (!$agree.is(':checked')) {
            showAlert("약관동의에 동의해주세요.", $agree.focus());
            return;
        } else if (!$payType.is(':checked')) {
            showAlert("결제하실 정보에 체크해주세요.", $payType.focus());
            return;
        }

        const classPaySumbitRes = await postJson(getAjaxUrl('class'), {
            mode: 'classPay',
            class_idx: class_idx,
            users: users
        });

        if (!classPaySumbitRes.result) {
            showAlert(classPaySumbitRes.msg);
            return;
        }

        $('#ReturnURL').val(`${ReturnURL}&tmp_users_idx=${classPaySumbitRes.tmp_users_idx}`);

        innopay.goPay({
            PayMethod: frm.PayMethod.value, // 결제수단(CARD,BANK,VBANK,CARS,CSMS,DSMS,EPAY,EBANK)
            MID: frm.MID.value, // 가맹점 MID
            MerchantKey: frm.MerchantKey.value, // 가맹점 라이센스키
            GoodsName: frm.GoodsName.value, // 상품명
            Amt: frm.Amt.value, // 결제금액(과세)
            BuyerName: frm.BuyerName.value, // 고객명
            BuyerTel: frm.BuyerTel.value, // 고객전화번호
            BuyerEmail: frm.BuyerEmail.value, // 고객이메일
            ResultYN: frm.ResultYN.value, // 결제결과창 출력유뮤
            Moid: getRandomString(39), // 가맹점에서 생성한 주문번호 셋팅			
            ReturnURL: frm.ReturnURL.value // 결제결과 전송 URL(없는 경우 아래 innopay_result 함수에 결제결과가 전송됨)
        });
    }
</script>

<?php
include_once(G5_PATH.'/tail.php');
?>
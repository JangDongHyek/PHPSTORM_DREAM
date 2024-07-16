<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '판매대금관리';
include_once('./_head.php');
/**
 * 판매 대금 출금
 * 벙커와 동일하나 자료실 수익은 따로 구분하여 15% 제외하고 적용
 */
if($member['seller'] == 'N') alert("판매자 신청 후 승인이 필요합니다.", G5_BBS_URL.'/mypage_seller.php', false);

$data = sql_fetch(" select * from g5_reference_room_seller where mb_id = '{$member['mb_id']}' and state = '승인완료' ");
$readonly = 'readonly';
$disabled = 'disabled';
$registration_number = explode('-', Decrypt($data['registration_number']));
?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<?}?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">

<style>

</style>

<div id="area_mypage" class="withdraw">
    <div class="inr v3">

        <?php include_once('./mypage_info.php'); ?>

        <div id="mypage_wrap">
            <form id="fwithdraw" name="fwithdraw" method="post" action="<?=G5_BBS_URL?>/mypage_pay_withdraw_update.php">
            <input type="hidden" name="exchange_krw" id="exchange_krw" value="">
            <input type="hidden" name="input_bank" value="<?=$data['bank']?>">
            <div class="mypage_cont">
                <div class="box">
                    <h3>판매대금관리</h3>

                    <div class="mybunker">
                        <h3>출금가능한 금액</h3>
                        <p><span><?= number_format($member['sales_proceeds']) ?></span></p>
                    </div>
                    <div class="area_withdraw">
                        <div class="price"></div>
                        <div class="box_cont">
                            <ul class="list_product charge">
                                <li>
                                    <button type="button" class="btn_close" onclick="$('#price').val('');$('#exchange').text('0');"></button>
                                    <input type="text" class="frm_input" id="price" name="price" placeholder="출금금액" onkeyup="comma_number(this);inputPrice(this.value);">
                                </li>
                            </ul>
                            <div class="price">최소 출금 금액: 10,000원<br>계좌로 입금될 금액 : <span id="exchange">0</span>원</div>
                        </div>
                    </div>

                    <div class="withdraw_info">
                        <h2>출금 정보</h2>
                        <ul>
                            <li class="col2">
                                <div class="title"><span>예금주</span></div>
                                <div class="cont"><input type="text" id="account_holder" value="<?=$data['account_holder']?>" name="account_holder" required class="required" <?=$readonly?>></div>
                            </li>
                            <li class="col2">
                                <div class="title"><span>은행명</span></div>
                                <div class="cont">
                                    <select id="bank" name="bank" required class="required" <?=$disabled?>>
                                        <option value="">은행 선택</option>
                                        <?php foreach ($bank_list as $code=>$name) { ?>
                                        <option value="<?=$code?>" <?php echo $data['bank'] == $code ? 'selected' : ''; ?>><?=$name?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <div class="title"><span>계좌번호 (숫자만 입력)</span></div>
                                <div class="cont"><input type="text" id="account_number" value="<?=$data['account_number']?>" name="account_number" required class="required" onkeyup="only_number(this);" <?=$readonly?>></em></div>
                            </li>
                            <li class="secret_num">
                                <div class="title"><span>주민번호</span></div>
                                <div class="cont">
                                    <input type="text" id="reg_number1" value="<?=$registration_number[0]?>" name="reg_number1" required class="required" maxlength="6" onkeyup="only_number(this);" <?=$readonly?>>
                                    <i>-</i>
                                    <input type="password" id="reg_number2" value="<?=$registration_number[1]?>" name="reg_number2" required class="required" maxlength="7" onkeyup="only_number(this);" <?=$readonly?>>
                                </div>
                                <em>* 주민번호는 입금받으실 예금주의 주민번호여야 합니다.</em>
                                <em>* 회원정보와 예금주 정보가 다를 경우 등록이 거절될 수 있습니다.</em>
                            </li>
                        </ul>
                    </div>
                    <div class="withdraw_info v2">
                        <a class="btn_withdraw" href="javascript:withdrawRequest();">출금신청하기</a>
                    </div>
                </div>
            </div>
            </form>
            <?php include_once('./mypage_menu.php'); ?>
            <?php include_once('./mypage_cmenu.php'); ?>
        </div>
    </div>
</div>

<script>
    var flag = false;
    function inputPrice(price) {
        // 출금 가능 금액 입력
        price = price.replace(/,/gi, ""); // 입력 금액
        if(Number(price) > Number('<?=$member['sales_proceeds']?>')) {
            swal('출금 가능 금액이 부족합니다.');
            flag = true;
        } else {
            flag = false;
        }

        var exchange = Math.floor(Number(price) * 85 / 100);
        $("#exchange").text(number_format(exchange.toString())); // 계좌로 입금될 금액
    }

    // 출금신청
    function withdrawRequest() {
        var price = $("#price").val().replace(/,/gi, ""); // 입력 금액
        if(Number(price) < 10000) {
            swal('최소 출금 금액은 10,000원 입니다.');
            return false;
        }

        $('#fwithdraw').submit();
    }
</script>

<?
include_once('./_tail.php');
?>


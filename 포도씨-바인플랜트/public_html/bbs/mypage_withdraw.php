<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '환전하기';
include_once('./_head.php');

// 출금신청 flag = 'Y';
// 출금신청자가 트레이더 등록 후 관리자 승인 완료하였는지 확인
$mode = 'trader';
if($flag == 'Y') {
    $mode = 'withdraw';

    $cnt = sql_fetch(" select count(*) as cnt from g5_bunker_trader where mb_id = '{$member['mb_id']}' and state = '승인완료' ")['cnt'];
    if($cnt == 0) {
        alert('관리자 미승인 상태입니다.', G5_BBS_URL.'/mypage_bunker.php');
    }

    $data = sql_fetch(" select * from g5_bunker_trader where mb_id = '{$member['mb_id']}' and state = '승인완료' ");
    $readonly = 'readonly';
    $disabled = 'disabled';
    $registration_number = explode('-', Decrypt($data['registration_number']));
}
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
            <form id="fwithdraw" name="fwithdraw" method="post" action="<?=G5_BBS_URL?>/mypage_withdraw_update.php">
            <input type="hidden" name="mode" id="mode" value="<?=$mode?>">
            <input type="hidden" name="exchange_krw" id="exchange_krw" value="">
            <input type="hidden" name="input_bank" value="<?=$data['bank']?>">
            <input type="hidden" name="trader_idx" value="<?=$data['idx']?>">
            <div class="mypage_cont">
                <div class="box">
                    <h3>벙커 트레이더 정보</h3>

                    <?php if($flag == 'Y') { ?>
                    <div class="mybunker">
                        <h3>환전가능 벙커</h3>
                        <p><span><?= number_format($member['mb_bunker']) ?></span></p>
                    </div>
                    <div class="area_withdraw">
                        <h3>환전할 벙커를 입력해 주세요.</h3>
                        <div class="box_cont">
                            <ul class="list_product charge">
                                <li>
                                    <button type="button" class="btn_close" onclick="$('#bunker').val('');$('#exchange').text('0');"></button>
                                    <input type="text" class="frm_input" id="bunker" name="bunker" placeholder="환전벙커" onkeyup="comma_number(this);inputBunker(this.value);">
                                </li>
                            </ul>
                            <div class="price">환전될 금액 : <span id="exchange">0</span>원</div>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="withdraw_info">
                        <h2>환전 정보</h2>
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
                        <a class="btn_withdraw" href="javascript:bunkerWithdraw('<?php echo empty($flag) ? 'trader' : 'withdraw'; ?>');"><?php echo empty($flag) ? '등록신청하기' : '환전신청하기'; ?></a>
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
    function inputBunker(bunker) {
        // 환전 신청 벙커 입력
        bunker = bunker.replace(/,/gi, ""); // 입력 벙커
        if(Number(bunker) > Number('<?=$member['mb_bunker']?>')) {
            swal('신청 가능 벙커가 부족합니다.');
            flag = true;
        } else {
            flag = false;
        }

        $.ajax({
            url: g5_bbs_url + '/ajax.exchange_bunker.php',
            data: {bunker: bunker},
            type: 'post',
            success: function(data) {
                $('#exchange').text(number_format(data));
                $('#exchange_krw').val(data);
            },
        });
    }

    // 등록신청(mode:trader) or 환전신청(mode:withdraw)
    function bunkerWithdraw(mode) {
        if($.trim($('#account_holder').val()) == '') {
            swal('예금주를 입력해 주세요.');
            return false;
        }
        if($('#bank').val() == '') {
            swal('은행을 선택해 주세요.');
            return false;
        }
        if($('#account_number').val() == '') {
            swal('계좌번호를 입력해 주세요.');
            return false;
        }
        if($('#reg_number1').val() == '' || $('#reg_number2').val() == '') {
            swal('주민번호를 입력해 주세요.');
            return false;
        }
        if($('#reg_number1').val().length != 6 || $('#reg_number2').val().length != 7) {
            swal('주민번호를 입력해 주세요.');
            return false;
        }
        if($('#bunker').val() == 0 || $('#bunker').val() == '') {
            swal('신청 벙커를 입력해 주세요.');
            return false;
        }

        if(mode == 'withdraw') {
            if(flag) {
                swal('신청 가능 벙커가 부족합니다.');
                return false;
            }
        }

        $('#fwithdraw').submit();
    }
</script>

<?
include_once('./_tail.php');
?>


<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '판매자 신청';
include_once('./_head.php');

// $readonly = 'readonly';
// $disabled = 'disabled';

// 이미 판매자면 접근 불가
if($seller) alert("올바른 경로가 아닙니다.", G5_URL, true);

// 프로필 업데이트 체크
$profile_flag = profileUpdateCheck($member['mb_id'], $member['mb_level']);
if(!$profile_flag) alert('프로필 업데이트 완료 후 신청이 가능합니다.');
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
            <form id="fseller" name="fseller" method="post" action="<?=G5_BBS_URL?>/mypage_seller_update.php">
                <div class="mypage_cont">
                    <div class="box">
                        <h3>판매자 신청 정보</h3>

                        <div class="seller_info">
                            <h2>판매자 정보</h2>
                            <ul>
                                <li class="col2">
                                    <div class="title"><span>이름</span></div>
                                    <div class="cont"><input type="text" id="mb_name" value="<?=$member['mb_name']?>" name="mb_name" required class="required" <?=$readonly?>></div>
                                </li>
                            </ul>
                            <ul>
                                <li class="col2">
                                    <div class="title"><span>휴대폰번호</span></div>
                                    <div class="cont">
                                        <input type="text" id="reg_mb_hp" value="<?=$member['mb_hp']?>"  name="mb_hp" required class="required" <?=$readonly?> maxlength="13" style="width: calc(100% - 140px)">
                                        <button type="button" class="btn_hp" onclick="hpCertify();">인증번호</button>
                                    </div>
                                </li>
                                <li class="col2" id="cert" style="display: none;">
                                    <div class="title"><span>인증번호</span></div>
                                    <div class="cont">
                                        <input type="text" id="cert_no" name="cert_no" placeholder="인증번호를 입력해 주세요." maxlength="6" onkeyup="only_number(this);" style="width: calc(100% - 140px)">
                                        <button type="button" class="btn_hp" onclick="hpCertifyChk();">확인</button>
                                        <p id="chk_msg"></p>
                                    </div>
                                </li>
                                <li class="col2">
                                    <div class="title"><span>예금주</span></div>
                                    <div class="cont"><input type="text" id="account_holder" value="<?=$member['mb_name']?>" name="account_holder" required class="required" <?=$readonly?>></div>
                                </li>
                                <li class="col2">
                                    <div class="title"><span>은행명</span></div>
                                    <div class="cont">
                                        <select id="bank" name="bank" required class="required" <?=$disabled?>>
                                            <option value="">은행 선택</option>
                                            <?php foreach ($bank_list as $code=>$name) { ?>
                                                <option value="<?=$code?>"><?=$name?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="title"><span>계좌번호 (숫자만 입력)</span></div>
                                    <div class="cont"><input type="text" id="account_number" name="account_number" required class="required" onkeyup="only_number(this);" <?=$readonly?>></em></div>
                                </li>
                                <li class="secret_num">
                                    <div class="title"><span>주민번호</span></div>
                                    <div class="cont">
                                        <input type="text" id="reg_number1" name="reg_number1" required class="required" maxlength="6" onkeyup="only_number(this);" <?=$readonly?>>
                                        <i>-</i>
                                        <input type="password" id="reg_number2" name="reg_number2" required class="required" maxlength="7" onkeyup="only_number(this);" <?=$readonly?>>
                                    </div>
                                    <em>* 주민번호는 입금받으실 예금주의 주민번호여야 합니다.</em>
                                    <em>* 회원정보와 예금주 정보가 다를 경우 등록이 거절될 수 있습니다.</em>
                                </li>
                            </ul>
                        </div>
                        <div class="withdraw_info v2">
                            <a class="btn_withdraw" href="javascript:sellerRequest()">판매자신청하기</a>
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
    $(function() {
        // 휴대폰번호 입력
        $("#reg_mb_hp").keyup(function (){
            var mb_hp = $(this).val();
            var state = $(this).parents(".row").find(".status_ico");
            var err = $(this).parents(".row").find(".error");

            // 휴대폰 정규표현식
            var regHp = /^([0-9]{3,4})-?([0-9]{3,4})-?([0-9]{4})$/;

            if (regHp.test(mb_hp)){
                state.removeClass("err").addClass("pas");
                err.html("");
            }else{
                state.removeClass("pas").addClass("err");
                err.addClass("on").html("휴대폰 번호는 10 ~ 12자리 숫자만 입력해 주세요.");
            }

        }).keydown(function (event) {
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
        });
    });

    // 판매자신청하기
    function sellerRequest() {
        if($.trim($('#mb_name').val()) == '') {
            swal('이름을 입력해 주세요.');
            return false;
        }
        if($.trim($('#reg_mb_hp').val()) == '') {
            swal('휴대폰번호를 입력해 주세요.');
            return false;
        }
        // 테스트 완료 후 주석 해제
        // if(!cert_flag) {
        //     swal('휴대폰번호 인증을 완료해 주세요.');
        //     return false;
        // }
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

        // 테스트 완료 후 주석 해제
        // if(cert_no != $('#reg_mb_hp').val()) { // 인증받은 휴대폰 번호가 아니면
        //     swal('휴대폰번호가 변경되었습니다.\n새로운 인증을 진행해 주세요.');
        //     return false;
        // }

        $('#fseller').submit();
    }

    // 인증번호 발송
    function hpCertify() {
        if($.trim($('#reg_mb_hp').val()) == '') {
            swal('휴대폰번호를 입력해 주세요.');
            return false;
        }
        if($.trim($('#reg_mb_hp').val()).length != 13) {
            swal('휴대폰번호를 확인해 주세요.');
            return false;
        }

        $.ajax({
            url: './ajax.hp_certify.php',
            type: 'post',
            data: {hp: $('#reg_mb_hp').val(), mode: 'send'},
            success: function(data) {
                if(data == 'success') {
                    swal('인증번호를 발송하였습니다.')
                    .then(()=>{
                        $('#cert').show();
                        $('#cert_no').focus();
                    });
                }
                else if(data == 'fail') {
                    swal('휴대폰번호를 입력해 주세요.');
                    return false;
                }
            },
        });
    }

    // 인증번호 확인
    var cert_flag = false;
    var cert_no = "";
    function hpCertifyChk() {
       if($.trim($('#cert_no').val()) == '') {
           swal('인증번호를 입력해 주세요.');
           cert_flag = false;
           return false;
       }

       $.ajax({
           url: './ajax.hp_certify.php',
           type: 'post',
           data: {hp: $('#reg_mb_hp').val(), cert_no: $('#cert_no').val(), mode: 'check'},
           success: function(data) {
               if (data == 'success') {
                   cert_flag = true;
                   cert_no = $('#reg_mb_hp').val();
                   //$("#chk_msg").text("인증이 완료되었습니다.");
                   swal("인증이 완료되었습니다.")
                   .then(()=>{
                      $("#cert").hide();
                   });
               } else {
                   $("#chk_msg").text("인증번호를 확인해 주세요.");
               }
           },
       });
    }
</script>

<?
include_once('./_tail.php');
?>

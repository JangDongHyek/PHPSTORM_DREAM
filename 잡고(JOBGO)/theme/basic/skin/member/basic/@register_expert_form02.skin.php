<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');\
?>
<style>
body{background: #f5f5f5;}
</style>


<!-- 회원가입시작 { -->
<div class="mbskin">

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <!--
    <input type="hidden" name="url" value="<?php /*echo $urlencode */?>">
    <input type="hidden" name="cert_type" value="<?php /*echo $member['mb_certify']; */?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_sns_type" value="<?php /*echo $mb_sns_type;*/?>">
    <input type="hidden" name="mb_type" id="mb_type" value="<?php /*echo $mb_type;*/?>">
    <?php /*if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 */?>
    <?php /*} */?>
    <input type="hidden" name="mb_nick_default" value="<?php /*echo get_text($member['mb_nick']) */?>">
    <input type="hidden" name="mb_nick" value="<?php /*echo get_text($member['mb_nick']) */?>">
    <?php /*if (isset($member['mb_sex'])) { */?><input type="hidden" name="mb_sex" value="<?php /*echo $member['mb_sex'] */?>"><?php /*} */?>
    -->
	<input type="hidden" name="mb_level" id="mb_level" value="<?php if($w == '') { echo $mb_level; } else { echo $member['mb_level']; } ?>">
    <input type="hidden" name="mb_email" id="mb_email" value="<?=$_POST['mb_email']?>">
    <input type="hidden" name="mb_password" id="mb_password" value="<?=$_POST['mb_password']?>">
    <input type="hidden" name="mb_nick" id="mb_nick" value="<?=$_POST['mb_nick']?>">
    <input type="hidden" name="mb_5" id="mb_5" value="<?=$_POST['mb_5']?>">

    <!--가입절차단계-->
    <div class="process">
         <ul>
             <li>1</li>
             <li class="current">2</li>
             <li>3</li>
         </ul>
    </div>

	<article class="box-article">
    	<div id="join_exinfo">
		<h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p></h2>
            <div class="box-body">
            
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <span id="button_span"><button type="button" id = "btn_send" class="phone" onclick="sms_register();">인증하기</button></span>
                        <label for="reg_mb_id">휴대폰 인증</label>
                        <input type="text" name="mb_hp" value="<?php echo $member['mb_hp'] ?>" id="reg_mb_hp" class="phone regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" onkeyup="number_check(this);" maxlength="11">
                    </dd>
                    <dd class="error col-xs-12" id="phone"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="mb_cert">인증번호 입력</label>
                        <input type="text" name="mb_cert" value="<?php echo $member['mb_cert'] ?>" placeholder="6자리 인증번호를 입력해주세요." id="mb_cert" class="regist-input <?php echo $required ?>" maxlength="10">
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_password">실명</label>
                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" placeholder="닉네임이 아닌 실명을 입력해주세요." id="reg_mb_name" class="regist-input <?php echo $required ?>" maxlength="10">
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="mb_password_re">생년월일</label>
                        <div class="birth_wrap">
                            <input type="date"  style="padding-left: 20px; height: 55px; font-size: 16px;" name="mb_birthday" min="1910-01-01" class="<?php echo $required ?> regist-input " max="<?=G5_TIME_YMD?>">
                        </div>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_name">출금계좌정보<span>예금주는 휴대폰인증 정보와 동일</span></label>
                        <div class="account_wrap">
                             <ul>
                                  <li>
                                  <select name="mb_1" class="select" id="mb_1" title="은행 선택">
                                   <option value="" hidden>은행 선택</option>
                                        <!--normal select-->
                                      <option value="">은행명</option>
                                      <? foreach ($bank_list as $code=>$name) {?>
                                          <option value="<?=$code?>"><?=$name?></option>
                                      <? } ?>
                                  </select>
                                  </li>
                                  <li>
                                  <input name="mb_2" type="text" value="<?php echo $member['mb_2'] ?>" id="mb_2" class="regist-input" placeholder="예금주 입력">
                                  </li>
                                  <li>
                                  <input name="mb_3" type="text" value="<?php echo $member['mb_3'] ?>" id="mb_3" class="regist-input" placeholder="'-'없이 숫자만 입력해 주세요">
                                  </li>
                              </ul>
                        </div>
                        <!--서비스 판매시 세금관련 유의사항-->
                        <div>
                        </div>
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                            <div class="notice_area">
                            <h3>※서비스 판매 시 "세금"관련 유의사항</h3>
                            <textarea readonly="">잡고를 통해 서비스를 판매하는 전문가는 사업자 등록 후 서비스를 판매하셔야 합니다. 사업자등록은 사업 개시 후 20일 이내에 사업장 소재지 관할 세무서에서 신청하시면 됩니다. 사업자 등록 없이 사업을 영위하는 경우 다음과 같은 가산세 부담 등의 불이익을 받게 됩니다.
                            </textarea>
                            </div>
                </dl>

                <!--<dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_id">전자서명</label>
                        <input type="text" name="mb_phone" value="<?php echo $member['mb_email'] ?>" id="reg_mb_phone" class="phone regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="50">
                    </dd>
                    <dd class="error col-xs-12" id="email_msg"></dd>
                </dl>-->
    
            </div>
        </div><!--//join_info-->
		
		<?php if($w == ""){ ?>
        <div id="join_agr">
        <h2 class="hide">약관동의</h2>
            <div class="box-body agree allcheck">
                <dl class="row agree-row all">
                    <dd class="col-xs-12 chk_ico" data-for="reg_all">
                        <input type="checkbox" name="reg_all" id="reg_all" value="0" onclick="ag_check(this)">
                        <label for="reg_all" class="title">약관전체동의</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                </dl>

				<? /* <dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req0">
                        <input type="checkbox" name="reg_req[]" id="reg_req0" value="0" onclick="ag_check(this)">
                        <label for="reg_req0">서비스 이용약관에 동의합니다. (필수)</label>
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                    </dd>
                </dl>

				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">개인정보처리방침에 동의합니다. (필수)</label>
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>*/ ?>
                
                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">잡고 판매홍보 대행 약관에 동의합니다. (필수)</label>
                        <!--<i></i> 개인정보처리방침 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-3 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                </dl>
                
                <!--<dl class="agree-row">
                    <dd class=" chk_ico" data-for="reg_chk1">
                        <input type="checkbox" name="reg_chk[]" id="reg_chk1" value="">
                        <label for="reg_chk1">선택 동의 (선택)</label>
                        <i></i> 선택 동의 (선택) 
                    </dd>
                </dl>-->
            </div>
            
        </div><!--//join_chk-->
        
        
		<?php } ?>

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'다음단계':'정보수정'; ?>" accesskey="s">
	</article>
    </form>
</div>
<script>

function ag_check(obj){
    if(obj.value == "0"){
        obj.value = "1";
    }else{
        obj.value = "0";
    }
}
//전체동의 체크 클릭시
$("#reg_all").click(function(){
    $("#reg_req1").prop("checked",$(this).prop("checked"));
    $("#reg_req2").prop("checked",$(this).prop("checked"));
    $("#reg_req0").prop("checked",$(this).prop("checked"));
});
// submit 최종 폼체크
function fregisterform_submit(f) {
	// 필수 체크박스
	// 조건들 확인

    // 휴대폰번호 검사
    if (f.w.value=='') {
        if (f.mb_hp.value.length < 1) {
            swal('휴대폰번호를 입력하십시오.');
            return false;
        }
    }

	// 이름 검사
	if (f.w.value=='') {

		if (f.mb_name.value.length < 1) {
            swal('실명을 입력하십시오.');
			// f.mb_name.focus();
			return false;
		}
	}

    // 생년월일 검사
    if (f.w.value=='') {
        if (f.mb_birthday.value.length < 1) {
            swal('생년월일을 입력하십시오.');
            return false;
        }
    }


    <?php if($w == ""){ ?>
    if($("#reg_req0").prop("checked")==false){
        swal("서비스 이용약관 동의(필수)를 체크하십시오");
        return false;
    }
	if($("#reg_req1").prop("checked")==false){
        swal("개인정보처리방침 동의(필수)를 체크하십시오");
		return false;
	}
	if($("#reg_req2").prop("checked")==false){
        swal("잡고 판매홍보대행약관 동의(필수)를 체크하십시오");
		return false;
	}
	<?php } ?>

	// return true;
}

function sms_register() {

    // if ($('#agree01').prop('checked') == false){
    //     swal("휴대폰 번호 수집 및 활용동의를 체크해주세요.");
    //     return false;
    // }

    ajax('sms_send');

}

$("#btn_certi").on("click", function(){

    if ($("#reg_mb_hp").val() == ""){
        swal('인증번호 발송 후 인증번호 확인을 눌러주세요.');
        return false;
    }

    if ( $("#mb_sms").val() == ""){
        swal('인증번호 확인란이 비어있습니다.');
        return false;
    }

    if ($('#sms_check_hp').val() != $('#reg_mb_hp').val()) {
        swal("휴대폰 번호가 같지 않습니다. 재요청 하십시오.");
        return false;
    }

    if ($('#sms_check').val() == $("#mb_sms").val()){
        ajax('cert_insert');
    }else{
        $('#sms_check').val("");
        swal("인증 번호가 같지 않습니다. 재요청 하십시오.");
    }

});




function ajax(mode){

    var mb_hp = $("#mb_hp").val();
    // $('#mb_hp').attr('readonly', true); // 인증 번호 발송 후 휴대폰 번호 수정 불가 처리

    $.ajax({
        type: "POST",
        url: g5_bbs_url+"/ajax.sms_register.php",
        data: {
            "mb_hp": encodeURIComponent($("#reg_mb_hp").val())
            ,"mode":mode,
        },
        dataType: "json",
        success: function(data) {
            console.log(data);

            if (data['msg'] != 'sms_ok'){
                swal(data['msg']);
            }


        }
    });
}

// 숫자 입력 체크
function number_check(data) {
    $('#'+data.id).val(data.value.replace(/[^\d]+/g, ''));
    $('#'+data.id).val(data.value.replace(/(\d)(?=(?:\d{11})+(?!\d))/g, '$1,'));
    // if(isNaN(data.value) == true) {
    //     swal('숫자만 입력할 수 있습니다.')
    //     .then((value) => {
    //         $('#'+data.id).val('');
    //         $('#'+data.id).focus();
    //         return;
    //     });
    // }
}
</script>

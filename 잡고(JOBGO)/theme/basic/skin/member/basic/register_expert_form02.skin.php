<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');\

// nice신용평가 추가
include_once(G5_BBS_PATH.'/nice/register.php');
?>
<style>
body{background: #f5f5f5;}
.box-article .box-body dd input {
    background: #fff !important;
}

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
    <input type="hidden" name="mb_email" id="reg_mb_email" value="<?=$_SESSION['ss_check_mb_email']?>">
    <input type="hidden" name="mb_password" id="reg_mb_password" value="<?=$_POST['mb_password']?>">
    <input type="hidden" name="mb_nick" id="reg_mb_nick" value="<?=$_SESSION['ss_check_mb_nick']?>">
    <input type="hidden" name="mb_5" id="mb_5" value="<?=$_POST['mb_5']?>">
    <input type="hidden" name="mb_division" id="mb_division" value="<?=$mb_division?>">
    <input type="hidden" name="mb_join_division" id="mb_join_division" value="<?php if($w == '') { echo $mb_join_division; } else { echo $member['mb_join_division']; } ?>" >
    <input type="hidden" name="mb_addr1" id="reg_mb_addr1" value="<?=$_POST['mb_addr1']?>" >
    <input type="hidden" name="mb_addr2" id="reg_mb_addr2" value="<?=$_POST['mb_addr2']?>" >
    <input type="hidden" name="mb_birth" id="mb_birth" value="<?=$_POST['mb_birth']?>" >
    <input type="hidden" name="mb_certify" id="mb_certify" value="<?=$_POST['mb_certify']?>" >
    <input type="hidden" name="mb_sex" id="mb_sex" value="<?=$_POST['mb_sex']?>" >

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
                        <span id="button_span"><button type="button" id = "btn_send" class="phone" onclick="nice_certify('2');">인증하기</button></span>
                        <label for="reg_mb_id">휴대폰 인증</label>
                        <input onclick="nice_certify('2');" type="text" name="mb_hp" value="<?=$_REQUEST['mb_hp']?>" id="reg_mb_hp" class="regist-input" readonly maxlength="11">
                    </dd>
                    <dd class="error col-xs-12" id="phone"></dd>
                </dl>

<!--                <dl class="row">-->
<!--                	<dd class="col-xs-1 req">*</dd>-->
<!--                    <dd class="col-xs-12">-->
<!--                        <label for="mb_cert">인증번호 입력</label>-->
<!--                        <input type="text" name="mb_cert" value="--><?php //echo $member['mb_cert'] ?><!--" placeholder="6자리 인증번호를 입력해주세요." id="mb_cert" class="regist-input --><?php //echo $required ?><!--" maxlength="10">-->
<!--                    </dd>-->
<!--                    <dd class="error col-xs-12"></dd>-->
<!--                </dl>-->

                <p class="certi t_padding15"><i class="fal fa-file-certificate"></i> <span>나이스평가정보</span>에서 인증받은 휴대전화번호를 사용하고 있습니다</p>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_password">본인인증정보</label>
                        <input type="text" name="mb_name" readonly value="<?= urldecode($_REQUEST['mb_name']) ?>" placeholder="실명" id="reg_mb_name" class="regist-input <?php echo $required ?>" maxlength="10">
                    </dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                
                <!--실명 데이터 넘어오는 필드-->
                <!--<dl>
                    <dd>
                        <input type="number" placeholder="년(4자)" style="padding-left: 20px; height: 55px;" name="mb_year" id="mb_year" class="<?php echo $required ?> regist-input " >
                    </dd>
                </dl>-->
                
                <dl class="row">

                    <input type="text" readonly placeholder="생년월일" name="mb_birth" id="mb_birth" class="regist-input <?php echo $required ?>" value="<?php if($w == 'u') { echo $member['mb_birth']; }else{echo $_POST['mb_birth'];} ?>" >

                    <dd class="error col-xs-12"></dd>
                </dl>
                <?php /*
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_name">입금계좌정보<span>예금주는 휴대폰인증 정보와 동일</span></label>
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
    */ ?>
                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-12">
				
								<label for="reg_mb_nick">사업자 입니까?</label>
						
							<div class="add_chk st2">
								
							
                            <span class="radioB">
								<input type="radio" onclick="buisnessman_chk('Y')" name = "mb_buisnessman" value="Y" id="busi_chk" class="sound_only"><label for="busi_chk">예</label>
							</span>
                            <span class="radioB">
								<input type="radio" onclick="buisnessman_chk('N')" name = "mb_buisnessman" value="N" <?php if($member["mb_buisnessman"]== "") echo 'checked'; ?> id="busi_chk2" class="sound_only"><label for="busi_chk2">아니오</label>
								</span>
                            <div style="display: none" id="buis_div">
                                <p>사업자 등록증을 첨부해주세요</p>
                                <?php
                                $mb_dir = substr($member['mb_id'], 0, 2);
                                $buis_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg';

                                if(file_exists($buis_file)){ ?>
                                    <img style="height: 150px" src = '<?=G5_DATA_URL.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg'?>'>
                                <?php } ?>
                                <input type="file" id="mb_buisnessman_file" name = "mb_buisnessman_file" style="display: block!important;">
                            </div>
							</div>
                        </dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                <div class="chk_icoBox">
                    <h4>어떻게 해서 청년재능거래마켓 잡고를 알게되었나요?</h4>
					<span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_01" value="옥외광고" >
						<label for="reg_jg_01">옥외광고 (포스터, 전광판 등)</label>
					</span>
					<span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_02" value="SNS" >
						<label for="reg_jg_02">SNS 광고 (인스타그램, 페이스북 등)  </label>
					</span>
					<span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_03" value="인터넷" >
						<label for="reg_jg_03">인터넷 검색</label>
					</span>
					<span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_04" value="지인추천" >
						<label for="reg_jg_04">지인추천</label>
					</span>
					<span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_etc" value="직접입력">
						<label for="reg_jg_etc">기타 (직접입력)</label>
						<input type="text" name="mb_sub_text" style="display: none" class="regist-input on_etc" maxlength="50" >
					</span>	

                </div>
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
function buisnessman_chk(val) {
    if(val == "Y" ){
        if ($('#reg_mb_hp').val() == ""){
            swal("원활한 진행을 위해 휴대폰 인증을 먼저 진행해주세요.");
            $("input:radio[name='mb_buisnessman']:radio[value='N']").prop("checked", true);
            return false;
        }
        $('#buis_div').css('display','block');


    }else{
        $('#buis_div').css('display','none');
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

    // if (f.w.value=='') {
    //     if ( new Date().getFullYear() - $('#mb_birth').val().substr(0,4) < 20 ) {
    //         swal('성인이 아닌 경우 전문가 가입이 불가능 합니다. 일반회원으로 가입해주세요.');
    //         return false;
    //     }
    // }


    // 휴대폰번호 검사
    if (f.w.value=='') {
        if ( $('#mb_certify').val() != 'M') {
            swal('인증하기를 눌러 휴대폰 인증을 진행하세요.');
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
        if (f.mb_year.value.length < 1 || f.mb_month.value == "" ||f.mb_day.value.length < 1) {
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

function nice_certify(type) {

    sessionStorage.setItem("mb_password",  $('#reg_mb_password').val());
    sessionStorage.setItem("mb_addr1",  $('#reg_mb_addr1').val());
    sessionStorage.setItem("mb_addr2",  $('#reg_mb_addr2').val());
    sessionStorage.setItem("mb_5",  $('[name = mb_5]').val());
    sessionStorage.setItem("type",  type);

    fnNicePopup();

}

$('[name = "mb_sub_path[]"]:checkbox[value="직접입력"]').click(function(){
    if (this.checked == true){
        $('[name = mb_sub_text]').css('display','inline-block');
    } else{
        $('[name =mb_sub_text]').css('display','none');
        $('[name =mb_sub_text]').val('');
    }
})
</script>

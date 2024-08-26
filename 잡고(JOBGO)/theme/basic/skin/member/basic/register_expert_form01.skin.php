<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//include_once($member_skin_path.'/mb.head.php');
?>
<style>
body{background: #f5f5f5;}
.box-article .box-body dd input {
    background: #f3f6fc !important;
}

</style>


<!-- 회원가입시작 { -->
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo G5_BBS_URL.'/register_expert_form02.php' ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w;?>">
    <input type="hidden" name="mb_sns" value="">
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
    <input type="hidden" name="mb_division" id="mb_division" value="<?php if($w == '') { echo $mb_division; } else { echo $member['mb_division']; } ?>" >


    <!--가입절차단계-->
    <div class="process">
         <ul>
             <li class="current">1</li>
             <li>2</li>
             <li>3</li>
         </ul>
    </div>
    
    <div class="b_rdo cf">
                <div class="st">
                    <label>
                        <input type="radio" name="mb_5" value="KO" checked="">
                        <em></em>
                        <div class="bx"><h2 class="tit"><span>내국인</span></h2></div>
                    </label>
                </div>
                <div class="st">
                    <label>
                        <input type="radio" name="mb_5" value="FO">
                        <em></em>
                        <div class="bx"><h2 class="tit"><span>외국인</span></h2></div>
                    </label>
                </div>
    </div>
    
	<article class="box-article">
    	<div id="join_info">
		<h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p></h2>
            <div class="box-body">
                <!--<dl class="row" style="background: none">
                    <dd class="col-xs-1 req">*</dd>
                    <dd class="">
                        <label for="reg_mb_password">내외국인</label>
                        내국인
                        <input type="radio" name="mb_5" checked class="regist-input <?php echo $required ?>" value="KO">
                        외국인
                        <input type="radio" name="mb_5" class="regist-input <?php echo $required ?>" value="FO">
                    </dd>
                </dl>-->
                <p class="certi t_padding15 b_padding15"><i class="fal fa-file-certificate"></i> <span>gmail</span>로 인증 시 스팸 메일함을 확인해주세요.</p>
                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <span id="button_span"><button type="button" class="btn cert" onclick="certi_mail_send();">인증하기</button></span>
                        <label for="reg_mb_id">이메일 입력</label>
                        <input type="text" name="mb_email" value="<?php echo $member['mb_email'] ?>" id="reg_mb_email" class="email regist-input <?php echo $required ?> <?php if($w=="u") echo "readonly";?>" minlength="4" maxlength="50" placeholder="이메일 입력" <?php if($w=="u") echo "readonly";?>>
                    </dd>
                    <dd class="error col-xs-12" id="email_msg"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_password">비밀번호 입력</label>
                        <input type="password" name="mb_password" id="reg_mb_password" class="regist-input <?php echo $required ?>" maxlength="20" placeholder="<?php if($w=="u") echo '비밀번호 변경(6자 이상)'; else echo '비밀번호 입력(6자 이상)' ?>">
                    </dd>
                    <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="mb_password_re">비밀번호 확인</label>
                        <input type="password" name="mb_password_re" id="reg_mb_password_re" class="regist-input <?php echo $required ?>" minlength="4" maxlength="20" placeholder="비밀번호 확인">
                    </dd>
                    <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>

                <dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_nick">닉네임 입력</label>
                        <input type="text" name="mb_nick" value="<?php echo $member['mb_nick'] ?>" id="reg_mb_nick" class="regist-input <?php echo $required ?>" placeholder="닉네임 입력" maxlength="8">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>
                <dl class="row">
                    <dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-12">
                        <label for="reg_mb_addr">거주지역</label>
                        <input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="reg_mb_addr1" class="regist-input <?php echo $required ?>" placeholder="거주지역"  onclick="sample2_execDaumPostcode()">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
                </dl>


                <!--<dl class="row">
                	<dd class="col-xs-1 req">*</dd>
                    <dd class="col-xs-11">
                        <label for="reg_mb_email">E-mail</label>
                        <input type="text" name="mb_email" id="reg_mb_email" class="regist-input <?php echo $required ?>" minlength="3" maxlength="50" <?php echo $required ?> placeholder="E-mail" value="<?php echo $member['mb_email']; ?>">
                    </dd>
                    <dd class="status_ico"><i class="fas fa-check"></i></dd>
                    <dd class="error col-xs-12"></dd>
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

				<?php /* <dl class="row agree-row" style="height:37px">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req0">
                        <input type="checkbox" name="reg_req[]" id="reg_req0" value="0" onclick="ag_check(this)">
                        <label for="reg_req0">만 18세 이상 청년입니다. (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                </dl> */ ?>

				<dl class="row agree-row">
                    <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                        <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                        <label for="reg_req1">서비스 이용약관 동의 (필수)</label>
                      	<!-- <i></i> 이용약관 동의 (필수) -->
                    </dd>
                    <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr"></dd>
                    <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                </dl>
                
                <dl class="row agree-row">
                    <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                        <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                        <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
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

		<input type="submit" class="btn_submit ft_btn" value="<?php echo $w==''?'다음단계':'정보수정'; ?>" accesskey="s" style="text-align:center"/>
	</article>
    </form>
</div>


<?php include_once(G5_BBS_PATH."/register_script.php") ?>


<script>

</script>
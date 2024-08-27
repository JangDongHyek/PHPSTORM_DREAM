<?php

$sub_id = "register_form";
include_once('./_common.php');

$g5['title'] = '회원가입';
include_once('./_head.php');

$register_action_url = G5_BBS_URL.'/register_form_update.php';
?>

<style>
    body{background: #f5f5f5;}

</style>



<!-- 회원가입시작 { -->
<div class="mbskin">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js?ver=2"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
        <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="w" value="<?php echo $w;?>">
        <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
        <input type="hidden" name="mb_level" id="mb_level" value="<?php if($w == 'u') { echo $member['mb_level']; } ?>">
        <input type="hidden" name="mb_name" id="mb_name" value="<?php if($w == 'u') { echo $member['mb_name']; }else if($sns != ""){ echo $_SESSION['chk_name']; }else{echo $_POST['mb_name'];} ?>">
        <input type="hidden" name="mb_certify" id="mb_certify" value="<?php if($w == 'u') { echo $member['mb_certify']; }else{echo $_POST['mb_certify'];} ?>" >
        <input type="hidden" name="mb_sex" id="mb_sex" value="<?php if($w == 'u') { echo $member['mb_sex']; }else{echo $_POST['mb_sex'];} ?>" >
        <input type="hidden" name="mb_division" id="mb_division" value="<?php if($w == '') { echo $mb_division; } else { echo $member['mb_division']; } ?>" >
        <input type="hidden" name="mb_join_division" id="mb_join_division" value="<?php if($w == '') { echo $mb_join_division; } else { echo $member['mb_join_division']; } ?>" >
        <input type="hidden" name="mb_birth" id="mb_birth" value="<?php if($w == 'u') { echo $member['mb_birth']; }else if($sns != ""){ echo $_SESSION['chk_birth']; }else{echo $_POST['mb_birth'];} ?>" >
        <input type="hidden" name="mb_sns" id="mb_sns" value="<?php if($sns == "Y"){ echo $_SESSION['ss_sns']; } ?>" >
        <input type="hidden" name="mb_9" id="mb_9" value="<?php if($sns == "Y"){ echo $_SESSION['chk_age']; } ?>" >
        <input type="hidden" name="r_code" id="r_code" value="<?=$_REQUEST['r_code']?>" >
        <input type="hidden" name="simple" id="simple" value="true" >

        <?php if($w == 'u') { ?>
            <p class="t3 b_padding25 text-center">정보수정</p>

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
        <?php }else{ ?>
            <p class="t3 b_padding25 text-center"><span><?= $config['cf_title']?></span> <br>간단 회원가입</p>
        <?php }?>

        <article class="box-article">
            <div id="join_info">
                <h2><?php if($w == ""){ ?>회원정보 입력<? }else { ?>회원정보 확인 및 수정<?php } ?> <p><span style="color:#fb2323;">*</span> 필수입력</p></h2>
                <div class="box-body">
                    <?php if($w == '' && $sns != "Y") { ?>
                    <?php } ?>

                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-12">
                            <label for="reg_mb_id_new">아이디</label>
                            <input type="text" name="mb_email" id="mb_email" class="regist-input <?php echo $required ?>" placeholder="아이디">
                        </dd>
                    </dl>
                    <?php if($w == "u" && $member['mb_sns'] == ''){ ?>

                        <dl class="row" <?=$add_style?>>
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12">
                                <?php /* if ($is_guest){
                                $style = 8; ?>
                            <span id="button_span"><button type="button" class="btn cert" onclick="certi_mail_send();">인증하기</button></span>
                             <?php } */ ?>
                                <?php if($w == "" && $sns != 'Y'){ ?><span id="button_span"><button type="button" id = "btn_send" class="phone" onclick="certi_mail_send();" >인증하기</button></span> <?php } ?>
                                <label for="reg_mb_id">이메일 입력</label>
                                <input type="text" name="mb_e3mail" value="<?php if ($w == 'u'){  echo $member['mb_email']; }else if ($sns == "Y"){ echo $_SESSION['ss_check_mb_id']; }else{ echo $_REQUEST['mb_email'];}?>" id="reg_mb_email" class="<?=$email_class?> regist-input <?php echo $required ?> <?php if($w=="u" || $sns == 'Y') echo "readonly";?>" minlength="4" maxlength="50" placeholder="이메일 입력" <?php if($w=="u"  || $sns == 'Y') echo "readonly";?>>
                            </dd>
                            <dd class="error col-xs-12" id="email_msg"></dd>
                        </dl>
                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12">
                                <label for="reg_mb_password">현재 비밀번호</label>
                                <input type="password" name="now_pw" id="now_pw" class="regist-input <?php echo $required ?>" placeholder="현재 비밀번호">
                            </dd>
                            <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($sns != "Y" && $member['mb_sns'] == ''){ ?>
                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12">
                                <label for="reg_mb_password">비밀번호 입력</label>
                                <input type="password" name="mb_password" value="<? if ($w == "") echo $_REQUEST['mb_password']; ?>" id="reg_mb_password" class="regist-input <?php echo $required ?>" maxlength="15" placeholder="<?php if($w=="u") echo '비밀번호 변경(6자 이상)'; else echo '비밀번호 입력(6자 이상)' ?>">
                            </dd>
                            <dd class="status_ico lock_ico1"><i class="fas fa-lock-open"></i></dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12">
                                <label for="mb_password_re">비밀번호 확인</label>
                                <input type="password" name="mb_password_re" id="reg_mb_password_re" value="<? if ($w == "") echo $_REQUEST['mb_password']; ?>" class="regist-input <?php echo $required ?>" minlength="6" maxlength="15" placeholder="비밀번호 확인">
                            </dd>
                            <dd class="status_ico lock_ico2"><i class="fas fa-lock"></i></dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>
                    <?php } ?>

                    <?php if($w == "u" && $member['mb_sns'] == ''){ ?>
                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-12">
                            <label for="reg_mb_nick">닉네임 입력</label>
                            <input type="text" name="mb_nick" value="<?= $w == 'u' ?  $member['mb_nick'] : $_REQUEST['mb_nick'];?>" id="reg_mb_nick" class="regist-input <?php echo $required ?>" placeholder="닉네임 입력" maxlength="8">
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-12">
                            <label for="reg_mb_addr">거주지역</label>
                            <input type="text" name="mb_addr1" value="<?= $w == 'u' ?  $member['mb_addr1'] : $_REQUEST['mb_addr1'];?>" id="reg_mb_addr1" class="regist-input <?php echo $required ?>" placeholder="거주지역"  onclick="sample2_execDaumPostcode()" readonly>
                        </dd>
                        <dd class="status_ico"><i class="fas fa-check"></i></dd>
                        <dd class="error col-xs-12"></dd>
                    </dl>
                    <?php } ?>
                    <?php if($sns == ""){ ?>

                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12">
                                <label for="reg_mb_nick">이름 입력</label>
                                <input type="text" name="mb_name" value="<?= $w == 'u' ?  $member['mb_name'] : $_REQUEST['mb_name'];?>" id="reg_mb_name" class="regist-input <?php echo $required ?>" placeholder="이름 입력" maxlength="8">
                            </dd>
                            <dd class="status_ico"><i class="fas fa-check"></i></dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>

                    <?php } ?>

                    <dl class="row">
                        <dd class="col-xs-1 req">*</dd>
                        <dd class="col-xs-12">
                            <?php if($w == "" && $sns != 'Y'){ ?><span id="button_span"><button type="button" id = "btn_send" class="phone" onclick="nice_certify('1');" >인증하기</button></span> <?php } ?>
                            <label for="reg_mb_id">휴대폰 인증</label>
                            <input  <?php if($w == "" && $sns != 'Y'){ ?> onclick="nice_certify('1');" <?php } ?> type="text" name="mb_hp" value="010-2475-5170<?php if ($w == 'u'){  echo $member['mb_hp']; }else if ($sns == "Y"){ echo $_SESSION['chk_hp']; }else{ echo $_REQUEST['mb_hp'];}?>" id="reg_mb_hp" class="regist-input <?php echo $required ?>" placeholder="휴대폰 번호" <? if ($sns != 'Y') echo "readonly"; ?> maxlength="11">
                        </dd>
                        <dd class="error col-xs-12" id="phone"></dd>
                    </dl>
                    <?php if($w == '' && $sns != "Y") { ?>
                        <p class="certi t_padding15 b_padding15"><i class="fal fa-file-certificate"></i> <span>나이스평가정보</span>에서 인증받은 휴대전화번호를 사용하고 있습니다</p>
                    <?php }?>
                    <?php if($w == "u" && $member["mb_division"] == 2){ ?>

                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12 add_chk">
                                <div><label for="reg_mb_nick">사업자 입니까?</label>사업자 입니까?</div>
                                <div>
								<span class="radioB">
									<input type="radio" onclick="buisnessman_chk('Y')" name = "mb_buisnessman" value="Y" id="busi_chk" class="sound_only" ><label for="busi_chk">예</label>
								</span>
                                    <span class="radioB">
									<input type="radio" onclick="buisnessman_chk('N')" name = "mb_buisnessman"  id="busi_chk2" value="N" <?php if($member["mb_buisnessman"]== "") echo 'checked'; ?> class="sound_only"><label for="busi_chk2">아니오</label>
								</span>

                                    <div style="display: none" id="buis_div">
                                        <p>사업자 등록증을 첨부해주세요</p>
                                        <input type="file" id="mb_buisnessman_file" name = "mb_buisnessman_file" style="display: block !important;">

                                        <?php
                                        $mb_dir = substr($member['mb_id'], 0, 2);
                                        $buis_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg';

                                        if(file_exists($buis_file)){ ?>
                                            <img style="height: 150px" src = '<?=G5_DATA_URL.'/member/'.$mb_dir.'/'.$member['mb_id'].'_buis.jpg'?>'>
                                        <?php } ?>
                                    </div>
                                </div>
                            </dd>

                            <dd class="error col-xs-12"></dd>

                        </dl>
                        <dl class="row">
                            <dd class="col-xs-1 req">*</dd>
                            <dd class="col-xs-12" style="background: white;">
                                <label for="reg_mb_name">출금계좌정보<span>예금주는 휴대폰인증 정보와 동일</span></label>
                                <div class="account_wrap">
                                    <ul>
                                        <li>
                                            <select name="mb_1" class="select <?php echo $required ?>" id="mb_1" title="은행 선택" >
                                                <option value="" hidden>은행 선택</option>
                                                <!--normal select-->
                                                <option value="">은행명</option>
                                                <? foreach ($bank_list as $code=>$name) { ?>
                                                    <option value="<?=$code?>" <? if ($w == "u" && $code == $member['mb_1']) echo "selected"; ?>><?=$name?></option>
                                                <? } ?>
                                            </select>
                                        </li>
                                        <li>
                                            <input name="mb_2" type="text" value="<?php echo $member['mb_2'] ?>" id="mb_2" class="regist-input <?php echo $required ?>" placeholder="예금주 입력">
                                        </li>
                                        <li>
                                            <input name="mb_3" type="text" value="<?php echo $member['mb_3'] ?>" id="mb_3" class="regist-input <?php echo $required ?>" placeholder="'-'없이 숫자만 입력해 주세요">
                                        </li>
                                    </ul>
                                </div>
                                <!--서비스 판매시 세금관련 유의사항-->
                                <div>
                                </div>
                            </dd>
                            <dd class="error col-xs-12"></dd>
                        </dl>
                    <?php } ?>

                </div>
            </div><!--//join_info-->

            <?php if($w == "u"){ ?>
                <div class="chk_icoBox st2">
                    <h4>어떻게 해서 청년재능거래마켓 잡고를 알게되었나요?</h4>
                    <span class="chk_ico">
	                    <input type="checkbox" name="mb_sub_path[]" id="reg_jg_01"value="옥외광고" >
		                <label for="reg_jg_01">옥외광고 (포스터, 전광판 등)</label>
					</span>
                    <span class="chk_ico">
	                    <input type="checkbox" name="mb_sub_path[]" id="reg_jg_02"value="SNS" >
		                <label for="reg_jg_02">SNS 광고 (인스타그램, 페이스북 등)  </label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_03"value="인터넷" >
						<label for="reg_jg_03">인터넷 검색</label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_04"value="지인추천" >
						<label for="reg_jg_04">지인추천</label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_sub_path[]" id="reg_jg_05"value="직접입력">
						<label for="reg_jg_05">기타 (직접입력)</label>
						<input type="text" name="mb_sub_text" style="display: none"  class="regist-input on_etc" maxlength="50">
					</span>

                </div>
                <div class="chk_icoBox st2">
                    <h4>관심있는(구매하고자 하는) 분야가 있나요?</h4>
                    <span class="chk_ico">
	                    <input type="checkbox" name="mb_want_ctg[]" id="reg_wc_01"value="디자인" >
		                <label for="reg_wc_01">디자인</label>
					</span>
                    <span class="chk_ico">
	                    <input type="checkbox" name="mb_want_ctg[]" id="reg_wc_02"value="IT/프로그램" >
		                <label for="reg_wc_02">IT/프로그램</label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_want_ctg[]" id="reg_wc_03"value="마케팅" >
						<label for="reg_wc_03">마케팅</label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_want_ctg[]" id="reg_wc_04"value="영상/음향/사진" >
						<label for="reg_wc_04">영상/음향/사진</label>
					</span>
                    <span class="chk_ico">
						<input type="checkbox" name="mb_want_ctg[]" id="reg_wc_05"value="문화예술">
						<label for="reg_wc_05">문화예술</label>
						<input type="text" name="mb_sub_text" style="display: none"  class="regist-input on_etc" maxlength="50">
					</span>
                </div>

            <?php } ?>
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

                        <dl class="row agree-row">
                            <dd class="col-xs-8 chk_ico" data-for="reg_req1">
                                <input type="checkbox" name="reg_req[]" id="reg_req1" value="0" onclick="ag_check(this)">
                                <label for="reg_req1">서비스 이용약관 동의 (필수)</label>
                                <!-- <i></i> 이용약관 동의 (필수) -->
                            </dd>
                            <dd class="col-xs-4 text-right"><input type="button" value="보기" class="btn btn-agr btn_mini"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea></dd>
                        </dl>

                        <dl class="row agree-row">
                            <dd class="col-xs-9 chk_ico" data-for="reg_req2">
                                <input type="checkbox" name="reg_req[]" id="reg_req2" value="0" onclick="ag_check(this)">
                                <label for="reg_req2">개인정보처리방침 동의 (필수)</label>
                                <!--<i></i> 개인정보처리방침 동의 (필수) -->
                            </dd>
                            <dd class="col-xs-3 text-right"><input type="button" value="보기" class="btn btn-agr btn_mini"></dd>
                            <dd class="col-xs-12 agr_textarea"><textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea></dd>
                        </dl>
                    </div>
                </div><!--//join_chk-->

            <input type="submit" class="btn_color btn_large" value="<?php echo $w==''?'버튼만 누르면 가입완료':'정보수정'; ?>" accesskey="s">
        </article>
    </form>
</div>


<?php
include_once(G5_BBS_PATH."/nice/register.php");
include_once(G5_BBS_PATH."/register_script.php");
include_once('./_tail.php');
?>

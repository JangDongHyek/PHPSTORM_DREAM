<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css'.LastFileVer.'">', 0);


$settingType = ($w == '')? 'insert' : 'setting';

/* 카카오 주소검색 공통 */
$openDaumPostcode = "openDaumPostcode($('#mb_zip_code'), $('#mb_addr'), $('#mb_addr_detail'), $('#mb_lat'), $('#mb_lng'))";
?>

<header id="hd" class="signup">
    <div id="hd_wrapper">
        <div class="row" style="margin:0;">
            <div class="col-xs-4" style="padding:0 10px;padding-bottom: 10px">
                <a href="javascript:history.back();">
                    <i class="fa-light fa-chevron-left"></i>
                </a>
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_b.svg" class="logo">
            </div>
            <div class="col-xs-8" style="padding:0 10px; text-align: right;">
                <p style="font-size: 1.3em; font-weight: 900; margin-top: 5px;"><span style="color:#4B82C3">고객사 </span><?=$settingType == 'insert'? '회원가입' : '정보수정'; ?></p>
			</div>
        </div>
    </div>
</header>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin" style="padding-top:70px">    
    <input type="hidden" name="w" value="<?php echo $w ?>">
        <div class="tbl_frm01 tbl_wrap" style="position:relative; clear:both;">
            <table>
                <tbody>
                <tr>
                    <td>
                        <label for="mb_id"><strong class="sound_only">필수</strong></label>
                        <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="mb_id" <?php echo $readonly ?> class="frm_input <?php echo $readonly ?>" minlength="3" maxlength="20" placeholder="아이디">
                        <?php if($w=="") { ?>
                        <br>
                        <?php } ?>
                        <span id="msg_mb_id"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_password"><strong class="sound_only">필수</strong></label>
                        <input type="password" name="mb_password" id="mb_password" class="frm_input" minlength="3" maxlength="20" placeholder="비밀번호">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_password_re"><strong class="sound_only">필수</strong></label>
                        <input type="password" name="mb_password_re" id="mb_password_re" class="frm_input" minlength="3" maxlength="20" placeholder="비밀번호 확인">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_company_name"><strong class="sound_only">필수</strong></label>
                        <input type="text" name="mb_company_name" value="<?=$member['mb_company_name']?>" id="mb_company_name" class="frm_input" placeholder="회사명">
                        <span id="msg_mb_place"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_company_tel"><strong class="sound_only">필수</strong></label>
                        <input type="tel" name="mb_company_tel" value="<?=telNoHyphen($member['mb_company_tel'])?>" id="mb_company_tel" class="frm_input" placeholder="대표번호" onkeyup="setHyphen($(this));">
                        <span id="msg_mb_place_no"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_company_number"><strong class="sound_only">필수</strong></label>
                        <input type="tel" name="mb_company_number" value="<?=bizNoHyphen($member['mb_company_number'])?>" id="mb_company_number" class="frm_input" placeholder="사업자등록번호"
                            onkeyup="setBizNoHyphen($(this))" maxlength="12"
                        >
                        <span id="msg_mb_business_no"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_company_email"><strong class="sound_only">필수</strong></label>
                        <input type="email" name="mb_company_email" value="<?=$member['mb_company_email']?>" id="mb_company_email" class="frm_input" placeholder="이메일">
                    </td>
                </tr>
					
					
                <tr>
                    <td style="display:flex">
                        <label for="mb_addr"><strong class="sound_only">필수</strong></label>
                        <input type="text" id="mb_addr" name="mb_addr" value="<?=$member['mb_addr']?>" class="mb_add frm_input" size="20" placeholder="기본주소" onclick="<?=$openDaumPostcode?>" readonly>
						<button type="button" class="btn-add ty1" onclick="<?=$openDaumPostcode?>">우편번호</button>
                   
                        <input type="hidden" id="mb_zip_code" value="<?=$member['mb_zip_code']?>"/>
                        <input type="hidden" id="mb_lat" value="<?=$member['mb_lat']?>"/>
                        <input type="hidden" id="mb_lng" value="<?=$member['mb_lng']?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_addr_detail"><strong class="sound_only">필수</strong></label>
                        <input type="text" name="mb_addr_detail" value="<?=$member['mb_addr_detail']?>" id="mb_addr_detail" class="frm_input" maxlength="50" placeholder="상세주소">
                    </td>
                </tr>					
					
                <tr>
                    <td>
                        <label for="mb_name"><strong class="sound_only">필수</strong></label>
                        <input type="text" id="mb_name" name="mb_name" value="<?=$member['mb_name']?>" class="frm_input" size="10" placeholder="담당자 성함">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="mb_hp"><strong class="sound_only">필수</strong></label>
                        <input type="tel" name="mb_hp" value="<?=telNoHyphen($member['mb_hp'])?>" id="mb_hp" class="frm_input" placeholder="담당자 전화번호" onkeyup="setHyphen($(this));">
                    </td>
                </tr>
                                        
                <? if($settingType == 'insert'){ ?>
                    <!--이용약관 동의는 회원가입만 노출-->
                    <tr>
                        <td  style="display:flex" class="agree">
                            <div class="frm_input">
                                <p>
                                    이용약관 
                                    <button type="button" class="btn-view v1" onclick="viewCf('view1')">전문보기</button> 
                                    <textarea class="div-view view1" readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
                                </p>
                            </div>
                            <label for="is_cf1" class="check">
                                <input id="is_cf1" type="checkbox">
                                <span>동의</span>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td style="display:flex" class="agree">
                            <div class="frm_input">
                                <p>
                                    개인정보처리방침 
                                    <button type="button" class="btn-view v2" onclick="viewCf('view2')">전문보기</button>                                 
                                    <textarea class="div-view view2" readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
                                </p>
                            </div>
                            <label for="is_cf2" class="check">
                                <input id="is_cf2" type="checkbox">
                                <span>동의</span>
                            </label>
                        </td>
                    </tr>
                <? } ?>                
            </tbody>
        </table>
    </div>
    <div class="btn_confirm">
        <input type="submit" value="<?=$settingType == 'insert'? '가입하기' : '정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s" onclick="complete()">
        <?php if ($is_member) { ?>
<!--        <button type="button" id="btn_exit" class="btn_id">삭제하기</button>-->
        <?php } ?>
    </div>    
</div>

<!-- } 회원정보 입력/수정 끝 -->
<script>
    const settingType = '<?=$settingType?>';
    
    /* 전문보기 */
    function viewCf(cls){
        $(`.${cls}`).slideToggle("slow");
    }
    
    /* 회원가입/정보수정 여부 */
    function isInsert(){
        return settingType == 'insert';
    }
    
    /* 회원가입/정보수정 */
    async function complete(){
        let $mb_id = $('#mb_id'), // 아이디
            $mb_password = $('#mb_password'), // 비밀번호
            $mb_password_re = $('#mb_password_re'), // 비밀번호 확인
            $mb_company_name = $('#mb_company_name'), // 회사명
            $mb_company_tel = $('#mb_company_tel'), // 대표번호
            $mb_company_number = $('#mb_company_number'), // 사업자등록번호
            $mb_company_email = $('#mb_company_email'), // 이메일
            $mb_addr = $('#mb_addr'), // 기본주소
            $mb_addr_detail = $('#mb_addr_detail'), // 상세주소
            $mb_name = $('#mb_name'), // 담당자 성함
            $mb_hp = $('#mb_hp'), // 담당자 전화번호
            target = null,
            falseMsg = '';
                
        /* 유효성 검사 */
        if($mb_id.val().length < 4){
            falseMsg = "아이디는 4글자 이상 입력해주세요.";
            target = $mb_id;
        }else if(isInsert() && $mb_password.val().length < 4){
            falseMsg = "비밀번호는 4글자 이상 입력해주세요.";
            target = $mb_password;
        }else if(isInsert() && !$mb_password_re.val()){
            falseMsg = "비밀번호 확인을 입력해주세요.";
            target = $mb_password_re;
        }else if($mb_password.val() != $mb_password_re.val()){
            falseMsg = "비밀번호가 일치하지 않습니다.";
            target = $mb_password_re;
        }else if(!$mb_company_name.val()){
            falseMsg = "회사명을 입력해주세요.";
            target = $mb_company_name;
        }else if(!$mb_company_tel.val()){
            falseMsg = "대표번호를 입력해주세요.";
            target = $mb_company_tel;
        }else if($mb_company_number.val().length != 12){
            falseMsg = "사업자번호 10자리를 정확히 입력해주세요.";
            target = $mb_company_number;
        }else if(!validateEmail($mb_company_email.val())){
            falseMsg = "이메일 형식에 맞게 입력해주세요.";
            target = $mb_company_email;
        }else if(!$mb_addr.val()){
            falseMsg = "주소를 등록해주세요.";
            target = $mb_addr;
        }else if(!$mb_addr_detail.val()){
            falseMsg = "상세주소를 입력해주세요.";
            target = $mb_addr_detail;
        }else if(!$mb_name.val()){
            falseMsg = "담당자 성함을 입력해주세요.";
            target = $mb_name;
        }else if(!$mb_hp.val()){
            falseMsg = "담당자 전화번호를 입력해주세요.";
            target = $mb_hp;
        }else if(isInsert() && (!$('#is_cf1').is(':checked') || !$('#is_cf2').is(':checked'))){
            falseMsg = '이용약관 및 개인정보처리방침에 동의해주세요.';
        }
        
        if(falseMsg != ''){
            swal(falseMsg)
            .then(() => {
                if(target == null) return;
                
                if(target == $mb_addr) target.click();
                else target.focus();
            });
            return;
        }
        
        const completeRes = await postJson(getAjaxUrl('member'), {            
            mode : 'customerSet',
            settingType : settingType,
            mb_id : $mb_id.val(),
            mb_password : $mb_password.val(),
            mb_company_name : $mb_company_name.val(),
            mb_company_tel : unHypen($mb_company_tel.val()),
            mb_company_number : unHypen($mb_company_number.val()),
            mb_company_email : $mb_company_email.val(),
            mb_addr : $mb_addr.val(),
            mb_addr_detail : $mb_addr_detail.val(),
            mb_zip_code : $('#mb_zip_code').val(),
            mb_lat : $('#mb_lat').val(),
            mb_lng : $('#mb_lng').val(),
            mb_name : $mb_name.val(),
            mb_hp : unHypen($mb_hp.val())
        });

        if(!completeRes.result){
            swal(completeRes.msg);
            return false;
        }
        
        let resultMsg = settingType == 'insert'? '가입완료 되었습니다.' : '수정되었습니다.';
        
        swal(resultMsg)
        .then(() => {
            if(settingType == 'insert') location.replace(`${rootUrl}/app/index2.php`);
            else location.reload();
        });
    }        
        
</script>    

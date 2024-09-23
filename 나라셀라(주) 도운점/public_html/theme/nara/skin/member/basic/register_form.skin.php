<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin" id="fregister">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>사이트 이용정보 입력</caption>
        <tbody>                                
        <tr>
            <th scope="row"><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></th>
            <td>
                <span class="frm_info">＊영문+숫자 (6자리 이상)</span>
                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
                <span id="msg_mb_id"></span>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td>
                <span class="frm_info">＊영문+숫자 (6자리 이상)</span>
                <input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></td>
        </tr>
        
        <?php if ($config['cf_use_hp'] || $config['cf_cert_hp']) {  ?>
        <tr>               
            <th scope="row"><label for="reg_mb_hp">휴대번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>                
                <input type="tel" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input <?php echo ($config['cf_req_hp'])?"required":""; ?>" maxlength="13">
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
                <?php } ?>
            </td>
        </tr>
        <?php }  ?>
        
        </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>개인정보 입력</caption>
        <tbody>
        <tr>
            <th scope="row"><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></th>
            <td>
                <?php if ($config['cf_cert_use']) { ?>
                <span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
                <?php } ?>
                <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" size="10">
                <?php
                if($config['cf_cert_use']) {
                    if($config['cf_cert_ipin'])
                        echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
                    if($config['cf_cert_hp'])
                        echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;

                    echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                }
                ?>
                <?php
                if ($config['cf_cert_use'] && $member['mb_certify']) {
                    if($member['mb_certify'] == 'ipin')
                        $mb_cert = '아이핀';
                    else
                        $mb_cert = '휴대폰';
                ?>
                <div id="msg_certify">
                    <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                </div>
                <?php } ?>
            </td>
        </tr>
        <?php if ($req_nick) {  ?>
        <!--tr>
            <th scope="row"><label for="reg_mb_nick">닉네임<strong class="sound_only">필수</strong></label></th>
            <td>
                <span class="frm_info">
                    공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)<br>
                    닉네임을 바꾸시면 앞으로 <?php echo (int)$config['cf_nick_modify'] ?>일 이내에는 변경 할 수 없습니다.
                </span>
                <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                <input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="frm_input required nospace" size="10" maxlength="20">
                <span id="msg_mb_nick"></span>
            </td>
        </tr-->
        <?php }  ?>

        <tr>
            <th scope="row"><label for="reg_mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
            <td>
                <?php if ($config['cf_use_email_certify']) {  ?>
                <span class="frm_info">
                    <?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
                    <?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
                </span>
                <?php }  ?>
                <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
                <input type="email" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required" size="70" maxlength="100">
            </td>
        </tr>                

        <?php if ($config['cf_use_homepage']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td><input type="text" name="mb_homepage" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" <?php echo $config['cf_req_homepage']?"required":""; ?> class="frm_input <?php echo $config['cf_req_homepage']?"required":""; ?>" size="70" maxlength="255"></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_tel']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td><input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20"></td>
        </tr>
        <?php }  ?>        
			
        <tr>
            <th scope="row"><label for="mb_1">생년월일<?php if ($config['mb_1']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>
                <input type="date" name="mb_1" value="<?php echo $member['mb_1'] ?>" id="mb_1" class="frm_input" size="20">
            </td>
        </tr>
        
        <tr>
            <th scope="row"><label for="reg_job">직업</label></th>
            <td>
                <span class="frm_info">＊선택사항으로 미기입 가능합니다.</span>
                <input type="text" name="mb_job" value="<?php echo get_text($member['mb_job']) ?>" id="mb_job"class="frm_input">
            </td>
        </tr>
                                
        <tr class="<?=$w == 'u'? 'hide' : ''?>">
            <th scope="row"><label for="reg_mb_sms">가입경로</label></th>
            <td>
                <input type="radio" name="mb_route" id="mb_route1" value="SNS">
                <label for="mb_route1">SNS</label>
                <input type="radio" name="mb_route" id="mb_route2" value="행사 방문">
                <label for="mb_route2">행사 방문</label>
                <input type="radio" name="mb_route" id="mb_route3" value="지인추천">
                <label for="mb_route3">지인추천</label>
                <input type="radio" name="mb_route" id="mb_route4" value="도보">
                <label for="mb_route4">도보</label>
            </td>
        </tr>

        <?php if ($config['cf_use_addr']) { ?>
        <tr>
            <th scope="row">
                주소
                <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
            </th>
            <td>
                <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                <input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6">
                <button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                <input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50">
                <label for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label><br>
                <input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
                <label for="reg_mb_addr2">상세주소</label>
                <br>
                <input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
                <label for="reg_mb_addr3">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
            </td>
        </tr>
        <?php }  ?>
        </tbody>
        </table>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <!--table>
        <caption>기타 개인설정</caption>
        <tbody>
        <?php if ($config['cf_use_signature']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_signature">서명<?php if ($config['cf_req_signature']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td><textarea name="mb_signature" id="reg_mb_signature" <?php echo $config['cf_req_signature']?"required":""; ?> class="<?php echo $config['cf_req_signature']?"required":""; ?>"><?php echo $member['mb_signature'] ?></textarea></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_profile']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_profile">자기소개</label></th>
            <td><textarea name="mb_profile" id="reg_mb_profile" <?php echo $config['cf_req_profile']?"required":""; ?> class="<?php echo $config['cf_req_profile']?"required":""; ?>"><?php echo $member['mb_profile'] ?></textarea></td>
        </tr>
        <?php }  ?>

        <?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_icon">회원아이콘</label></th>
            <td>
                <span class="frm_info">
                    이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
                    gif만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.
                </span>
                <input type="file" name="mb_icon" id="reg_mb_icon" class="frm_input">
                <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
                <img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
                <input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
                <label for="del_mb_icon">삭제</label>
                <?php }  ?>
            </td>
        </tr>
        <?php }  ?>

<!--
        <tr>
            <th scope="row"><label for="reg_mb_mailling">메일링서비스</label></th>
            <td>
                <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?>>
                정보 메일을 받겠습니다.
            </td>
        </tr>


        <?php if ($config['cf_use_hp']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_sms">마케팅 및 광고 활용동의(SMS)</label></th>
            <td>
                <input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?>>
                휴대폰 문자메세지를 받겠습니다.
            </td>
        </tr>
        <?php }  ?>

        <?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date'])) { // 정보공개 수정일이 지났다면 수정가능  ?>
<!--
        <tr>
            <th scope="row"><label for="reg_mb_open">정보공개</label></th>
            <td>
                <span class="frm_info">
                    정보공개를 바꾸시면 앞으로 <?php echo (int)$config['cf_open_modify'] ?>일 이내에는 변경이 안됩니다.
                </span>
                <input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open'] ?>">
                <input type="checkbox" name="mb_open" value="1" <?php echo ($w=='' || $member['mb_open'])?'checked':''; ?> id="reg_mb_open">
                다른분들이 나의 정보를 볼 수 있도록 합니다.
            </td>
        </tr>
-->
        <?php } else {  ?>
<!--
        <tr>
            <th scope="row">정보공개</th>
            <td>
                <span class="frm_info">
                    정보공개는 수정후 <?php echo (int)$config['cf_open_modify'] ?>일 이내, <?php echo date("Y년 m월 j일", isset($member['mb_open_date']) ? strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400:G5_SERVER_TIME+$config['cf_open_modify']*86400); ?> 까지는 변경이 안됩니다.<br>
                    이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
                </span>
                <input type="hidden" name="mb_open" value="<?php echo $member['mb_open'] ?>">
            </td>
        </tr>

        <?php }  ?>

        <?php if ($w == "" && $config['cf_use_recommend']) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_recommend">추천인아이디</label></th>
            <td><input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input"></td>
        </tr>
        <?php }  ?>

        </tbody>
        </table>
    </div-->
    
    <section id="fregister_term" class="<?=$w == 'u'? 'hide' : ''?>">
        <fieldset class="fregister_agree">
            <label for="agree11">회원가입 약관의 내용에 전체 동의합니다.</label>
            <input type="checkbox" name="agreeAll" value="1" id="agreeAll" onclick="checkAgree('all');">
        </fieldset>
    </section>

    <section id="fregister_term" class="<?=$w == 'u'? 'hide' : ''?>">
        <h2>회원가입약관</h2>
        <textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
        <fieldset class="fregister_agree">
            <label for="agree11">회원가입약관의 내용에 동의합니다. (필수)</label>
            <input type="checkbox" name="agree" class="agree" value="1" id="agree11" onclick="checkAgree('sub');">
        </fieldset>
    </section>

    <section id="fregister_private" class="<?=$w == 'u'? 'hide' : ''?>">
        <h2>마케팅활용을 위한 개인정보수집동의</h2>
        <textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
        <?php /*?><div class="tbl_head01 tbl_wrap">
            <table>
                <caption>개인정보처리방침안내</caption>
                <thead>
                <tr>
                    <th>목적</th>
                    <th>항목</th>
                    <th>보유기간</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>이용자 식별 및 본인여부 확인</td>
                    <td>아이디, 이름, 비밀번호</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                <tr>
                    <td>고객서비스 이용에 관한 통지,<br>CS대응을 위한 이용자 식별</td>
                    <td>연락처 (이메일, 휴대전화번호)</td>
                    <td>회원 탈퇴 시까지</td>
                </tr>
                </tbody>
            </table>
        </div><?php */?>

        <fieldset class="fregister_agree">
            <label for="agree21">마케팅활용을 위한 개인정보수집동의 내용에 동의합니다. (선택)</label>
            <input type="checkbox" name="mb_sms" class="agree" value="1" id="agree21" onclick="checkAgree('sub');">
        </fieldset>
    </section>				    



    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <a  data-toggle="modal" data-target="#exampleModal" class="btn_cancel">취소</a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="font-size: 1.35em; padding: 50px 0">
                            회원가입을 취소하시겠습니까?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="location.href='<?php echo G5_URL ?>'">가입 취소</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">가입 계속</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>

    <script>
        
        function checkAgree(type){
            let $agreeAll = $('#agreeAll'),
                $agree = $('.agree:checked');
            
            if(type == 'all'){
                if($agreeAll.is(':checked')){
                    $('.agree').prop('checked', true);
                }else{
                    $('.agree').prop('checked', false);
                }
            }else{
                if($agree.length == 2){
                    $agreeAll.prop('checked', true);
                }else{
                    $agreeAll.prop('checked', false);
                }
            }
        }
        
    $(function() {
        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {                   
        
        // 회원아이디 검사
        if (f.w.value == "") {
            
            let hasLetter = /[A-Za-z]/.test(f.mb_id.value),
                hasNumber = /[0-9]/.test(f.mb_id.value);
            
            if (!hasLetter || !hasNumber || f.mb_id.value.length < 6) {
                alert("아이디는 영문+숫자(6자리이상) 입력해주세요.");
                f.mb_id.focus();
                return false;
            }
            
            let msg = reg_mb_id_check().trim();
            console.log(msg);
            if (msg) {
                alert(msg);
                f.mb_id.focus();                
                return false;
            }
        }
        
        if (f.w.value=="" || (f.w.value == 'u' && f.mb_password.value != '')) {
            if (f.mb_password.value.length < 6) {
                alert("비밀번호를 6자리 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }            
            
            let hasLetter = /[A-Za-z]/.test(f.mb_password.value),
                hasNumber = /[0-9]/.test(f.mb_password.value);

            if (!hasLetter || !hasNumber) {
                alert("비밀번호는 영문과 숫자 모두 구성되어야 합니다.");
                f.mb_password.focus();
                return false;
            }

            if (f.mb_password.value != f.mb_password_re.value) {
                alert("비밀번호가 같지 않습니다.");
                f.mb_password_re.focus();
                return false;
            }
        }        
        
        // 회원 비밀번호 검사        
        if (f.reg_mb_hp.value.length < 13) {
            alert("휴대폰번호 11자리를 정확히 입력해주세요.");
            f.reg_mb_hp.focus();
            return false;
        }

        // 이름 검사        
        if (f.mb_name.value.length < 1) {
            alert("이름을 입력하십시오.");
            f.mb_name.focus();
            return false;
        }        
        
        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            let msg = reg_mb_email_check().trim();
            if (msg) {
                alert(msg);
                f.reg_mb_email.focus();
                f.reg_mb_email.select();
                return false;
            }
        }
        
        if (f.w.value == "") {
            if(!$('input[name="mb_route"]:checked').length){
                alert("가입경로에 체크해주세요.");            
                return false;
            }                

            if (!$('#agree11').is(':checked')) {
                alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");            
                return false;
            }
        }            

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
        
        $(function(){
            $('#reg_mb_hp').on('keyup', function(){
                $(this).val(telNoHypen($(this).val()));
            });            
        });
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->
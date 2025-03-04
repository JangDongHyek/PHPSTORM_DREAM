<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH."/jl/JlConfig.php");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

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
    <input type="hidden" name="referer" value="<?=$_SERVER['HTTP_REFERER'];?>">
    <input type="hidden" name="cert_no" value="">
    <input type="hidden" name="mb_4" id="mb_4">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>

    <div class="signup">
        <a href="javascript:history.back();" class="btn_back"><i class="fa-solid fa-left"></i></a>
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="임마누엘 교회">
        <br><br>
        <p>서비스 이용을 위해 회원가입이 필요합니다.</p>
        <br><br>
        <div id="app">
            <dl>
                <dt><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <span class="info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
                    <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
                    <span id="msg_mb_id"></span>
                </dd>

            </dl>
            <dl>
                <dt><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></dt>
                <dd><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></dd>
            </dl>
            <dl>
                <dt><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></dt>
                <dd><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></dd>
            </dl>
            <dl>
                <dt><label for="reg_mb_name">이름<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" size="10">

                </dd>
            </dl>
            <dl>
                <dt><label>생년월일<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <input type="date" id="mb_birth" name="mb_birth" value="<?php echo get_text($member['mb_birth']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>">

                </dd>
            </dl>
            <dl>
                <dt><label>성별<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <div class="select">
                        <input type="radio" name="mb_sex" value="남자" id="male" class="frm_input required" <?if($member['mb_sex'] == '남자') echo 'checked';?> ><label for="male">남자</label>
                        <input type="radio" name="mb_sex" value="여자" id="female" class="frm_input required" <?if($member['mb_sex'] == '여자') echo 'checked';?> ><label for="female">여자</label>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></dt>
                <dd><input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" <?php echo $config['cf_req_tel']?"required":""; ?> class="frm_input <?php echo $config['cf_req_tel']?"required":""; ?>" maxlength="20"></dd>
            </dl>

            <dl>
                <dt><label>직분<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <div class="select">
                        <input type="radio" name="mb_1" value="목회자" id="rank1" class="frm_input required" <?if($member['mb_1'] == '목회자') echo 'checked';?>><label for="rank1">목회자</label>
                        <input type="radio" name="mb_1" value="장로" id="rank2" class="frm_input required" <?if($member['mb_1'] == '장로') echo 'checked';?> ><label for="rank2">장로</label>
                        <input type="radio" name="mb_1" value="권사" id="rank3" class="frm_input required" <?if($member['mb_1'] == '권사') echo 'checked';?> ><label for="rank3">권사</label>
                        <input type="radio" name="mb_1" value="집사" id="rank4" class="frm_input required" <?if($member['mb_1'] == '집사') echo 'checked';?> ><label for="rank4">집사</label>
                        <input type="radio" name="mb_1" value="성도" id="rank5" class="frm_input required" <?if($member['mb_1'] == '성도') echo 'checked';?> ><label for="rank5">성도</label>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt><label>소속<strong class="sound_only">필수</strong></label></dt>
                <dd>
                    <span class="info">교구와 속을 모르시는 분은 0교구 0속으로 기입 바랍니다.</span>
                    <div class="select">
                        <select class="frm_input" name="mb_2">
                            <?php
                            for ($i = 0; $i <= 12; $i++) {
                                if($member['mb_2'] == "{$i}교구") $ckd= "selected";
                                else $ckd = "";

                                    echo "<option $ckd>{$i}교구</option>";
                            }
                            ?>
                        </select>
                        <select class="frm_input" name="mb_3">
                            <?php
                            for ($i = 0; $i <= 30; $i++) {
                                if($member['mb_3'] == "{$i}속") $ckd= "selected";
                                else $ckd = "";
                                echo "<option $ckd>{$i}속</option>";
                            }
                            ?>
                        </select>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    <div class="select">
                        <label>활동부서</label>
                        <button type="button" id="departAdd" @click="addObject()">추가</button>
                    </div>
                </dt>
                <dd>
                    <div class="select" v-for="item,index in mb_4">
                        <select class="frm_input" v-model="item.first">
                            <option>선교회</option>
                            <option>부서</option>
                            
                        </select>
                        <select v-if="item.first" class="frm_input" v-model="item.second">
                            <template v-if="item.first == '선교회'">
                                <option v-for="n in 12" :value="n+'남선교회'">{{n+'남선교회'}}</option>
                                <option v-for="n in 12" :value="n+'여선교회'">{{n+'여선교회'}}</option>
                            </template>
                            <template v-if="item.first == '부서'">
                                <option>아브라함</option>
                                <option>모세</option>
                                <option>사라</option>
                                <option>마리아</option>
                                <option>1링커</option>
                                <option>2링커</option>
                                <option>3링커</option>
                                <option>고등부</option>
                                <option>중등부</option>
                                <option>드림1부</option>
                                <option>드림2부</option>
                                <option>유치부</option>
                                <option>영아부</option>
                            </template>
                        </select>
                        <button type="button" id="departDel" @click="mb_4.splice(index,1)">삭제</button>
                    </div>
                </dd>
                <dd>
                    <div class="flex ai-c jc-sb">
                        <label>개인정보 수집·이용동의</label>
                        <span>
                            <input type="checkbox" id="agree"><label for="agree">동의</label>
                        </span>
                    </div>
                    <details>
                        <summary class="btn_sign">보기</summary>
                        <div style="width: 100%; padding: 10px; background: #f8f8f8"> ❏ 개인정보의 수집·이용 목적<br>
                            -귀하의 개인정보는 임마누엘교회 홈페이지 및 앱의 원활한 서비스 제공을 위한 목적으로만 사용됩니다.<br><br>
                            ❏ 수집·이용할 개인정보의 항목<br>
                            -성명, 생년월일, 휴대전화번호, 주소, 교적사항 등)<br><br>

                            ❏ 개인정보의 보유·이용기간<br>
                            -귀하의 개인정보는 회원 탈퇴 시까지 보유 및 이용되며, 동의자의 요구가 있을 경우에는 즉시 해당정보를 파기합니다.<br><br>

                            본인은 위와 같은 목적으로 본인의 개인정보를 수집·이용하는 것에 동의합니다.</div>
                    </details>
                </dd>
            </dl>
            <dl>
                <dt>자동등록방지</dt>
                <dd><?php echo captcha_html(); ?></dd>
            </dl>
        </div>
    </div>

    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
    </div>
</form>
<?$jl->vueLoad("app");?>
    <script>
        <??>
        Jl_data.mb_4 = <?= $jl->jsParseJson($member['mb_4'],"[]")?>;

        Jl_methods.addObject = function() {
            this.mb_4.push({first : "",second : ""});
        }
    </script>
    <script>
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
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }

        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

            /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        }

        if (!f.mb_sex.value) {
            alert("성별을 선택해주세요.");
            return false;
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>

        // E-mail 검사
        //if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
        //    var msg = reg_mb_email_check();
        //    if (msg) {
        //        alert(msg);
        //        f.reg_mb_email.select();
        //        return false;
        //    }
        //}

        <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
        // 휴대폰번호 체크
        var msg = reg_mb_hp_check();
        if (msg) {
            alert(msg);
            f.reg_mb_hp.select();
            return false;
        }
        <?php } ?>


        <?php echo chk_captcha_js();  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        document.getElementById("mb_4").value = JSON.stringify(Jl_data.mb_4);

        return true;
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->
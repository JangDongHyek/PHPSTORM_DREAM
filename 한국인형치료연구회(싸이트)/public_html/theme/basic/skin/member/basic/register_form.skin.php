<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<!-- 회원정보 입력/수정 시작 { -->
<div class="mbskin">

    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>


    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="g_token" id="g_token" value="">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="mb_1" value="<?php echo $member['mb_1']?>">
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
                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
                <span id="msg_mb_id"></span>
				<span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="mb_password" id="reg_mb_password" value="" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="mb_password_re" id="reg_mb_password_re" value="" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></td>
        </tr>
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
                <input type="text" required id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
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
		<tr>
            <th scope="row"><label for="reg_mb_4">생년월일<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="mb_4" id="reg_mb_4" readonly required value="<?=$member['mb_4']?>" class="frm_input picker edu required" minlength="3" maxlength="20">
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="reg_mb_3">최종학력<strong class="sound_only">필수</strong></label></th>
            <td>
				<input type="text" name="mb_3" id="reg_mb_3" required class="frm_input edu required" value="<?=$member['mb_3']?>" minlength="3" maxlength="20">
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
        <?php } ?>


        <tr>
            <th scope="row"><label for="reg_mb_hp">휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>
                <input type="number" required name="mb_hp" value="<?php echo str_replace('-','',$member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> class="frm_input required" maxlength="20">
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
                <?php } ?>
            </td>
        </tr>

        <tr>
            <th scope="row">
                주소
                <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
            </th>
            <td>
                <div>
                    <input type="checkbox" name="foreign_chk" id="foreign_chk" value="Y"/>
                    <label for="foreign_chk">해외 거주자</label>
                </div>
                <div id="addr_hide">
                    <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                    <input type="text" placeholder="우편번호" required name="mb_zip" readonly value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="search_post();">주소 검색</button><br>
                    <input type="text" name="mb_addr1" readonly value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="70" maxlength="100" placeholder="주소검색을 해주세요">
                    <input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="70" maxlength="100" placeholder="상세주소를 입력해주세요">
                </div>
            </td>
        </tr>

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
                <input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required" size="70" maxlength="100">
            </td>
        </tr>

		</tbody>
        </table>
    </div>

    <div class="btn_confirm">
        <input type="button" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit g-recaptcha" accesskey="s"
               data-sitekey="6LcUekkpAAAAAGlS-aDWh1ZlCLnCaF5j9N9vDYTr"
               data-callback='onSubmit'
               data-action='submit'
        >
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>

	<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
	<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script> -->

    <script>
        function onSubmit(token) {
            $("#g_token").val(token);
            let re = fregisterform_submit($("#fregisterform")[0]);
            if(re == true){
                document.getElementById('fregisterform').submit();

            }
        }
    </script>

	<script>
	$(function() {
        $('.picker').datepicker();

        // $.fn.datepicker.language['self'] = {
        //     days: ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'],
        //     daysShort: ['일', '월', '화', '수', '목', '금', '토'],
        //     daysMin: ['일', '월', '화', '수', '목', '금', '토'],
        //     months: ['1월','2월','3월','4월','5월','6월', '7월','8월','9월','10월','11월','12월'],
        //     monthsShort: ['1월','2월','3월','4월','5월','6월', '7월','8월','9월','10월','11월','12월'],
        //     today: 'Today',
        //     clear: 'Clear',
        //     dateFormat: 'yyyy-mm-dd',
        //     timeFormat: 'hh:ii aa',
        //     firstDay: 0,
        // };
        //
        // $( ".picker" ).datepicker({
        //     dateFormat: "yyyy-mm-dd",
        //     language : "self",
        //     onSelect: function onSelect(fd, date) {
        //         $(this).blur();
        //     }
        // });
	});

	$("#foreign_chk").on("click",function(){
	    let chk = $("#foreign_chk").prop("checked");

	    if(chk){
            $("input[name=mb_zip]").prop("required",false);
            $("#addr_hide").css("display","none");
        }else{
            $("input[name=mb_zip]").prop("required",true);
            $("#addr_hide").css("display","block");
        }

    });

	</script>

<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>

function search_post(){

	  new daum.Postcode({
        oncomplete: function(data) {
			console.log(data);
			$("#reg_mb_zip").val(data.zonecode);
			$("#reg_mb_addr1").val(data.address);
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
            // 예제를 참고하여 다양한 활용법을 확인해 보세요.
        }
    }).open();

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
            var msg = reg_mb_id_check();
            msg = msg.replace(/\n/g, "");//행바꿈제거
            msg = msg.replace(/\r/g, "");//엔터제거

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
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>

        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            msg = msg.replace(/\n/g, "");//행바꿈제거
            msg = msg.replace(/\r/g, "");//엔터제거

            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }


        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>

</div>
<!-- } 회원정보 입력/수정 끝 -->

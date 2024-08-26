<?php
include_once('./_common.php');
//**************************************************************************************************************
//NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED

//서비스명 :  체크플러스 - 안심본인인증 서비스
//페이지명 :  체크플러스 - 결과 페이지

//보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다.
//인증 후 결과값이 null로 나오는 부분은 관리담당자에게 문의 바랍니다.	
//**************************************************************************************************************

$sitecode = NICE_CODE;				// NICE로부터 부여받은 사이트 코드
$sitepasswd = NICE_PASSWORD;				// NICE로부터 부여받은 사이트 패스워드

// Linux = /절대경로/ , Window = D:\\절대경로\\ , D:\절대경로\
$cb_encode_path = NICE_PATH;

$enc_data = $_REQUEST["EncodeData"];		// 암호화된 결과 데이타

//////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
//if(preg_match('~[^0-9a-zA-Z+/=]~', $enc_data, $match)) {echo "입력 값 확인이 필요합니다 : ".$match[0]; exit;} // 문자열 점검 추가. 
//if(base64_encode(base64_decode($enc_data))!=$enc_data) {echo "입력 값 확인이 필요합니다"; exit;}
///////////////////////////////////////////////////////////////////////////////////////////////////////////

$returnMsg = "";

if ($enc_data != "") {
    $plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
    //echo "[plaindata]  " . $plaindata . "<br>";

    if ($plaindata == -1){
        $returnMsg  = "암/복호화 시스템 오류";
    }else if ($plaindata == -4){
        $returnMsg  = "복호화 처리 오류";
    }else if ($plaindata == -5){
        $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
    }else if ($plaindata == -6){
        $returnMsg  = "복호화 데이터 오류";
    }else if ($plaindata == -9){
        $returnMsg  = "입력값 오류";
    }else if ($plaindata == -12){
        $returnMsg  = "사이트 비밀번호 오류";
    }else{
        // 복호화가 정상적일 경우 데이터를 파싱합니다.
        $ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)

        $requestnumber = GetValue($plaindata , "REQ_SEQ");
        $responsenumber = GetValue($plaindata , "RES_SEQ");
        $authtype = GetValue($plaindata , "AUTH_TYPE");
        $name = GetValue($plaindata , "NAME");
        $name = GetValue($plaindata , "UTF8_NAME"); //charset utf8 사용시 주석 해제 후 사용
        $birthdate = GetValue($plaindata , "BIRTHDATE");
        $gender = GetValue($plaindata , "GENDER");
        $nationalinfo = GetValue($plaindata , "NATIONALINFO");	//내/외국인정보(사용자 매뉴얼 참조)
        $dupinfo = GetValue($plaindata , "DI");
        $conninfo = GetValue($plaindata , "CI");
        $mobileno = GetValue($plaindata , "MOBILE_NO");
        $mobileco = GetValue($plaindata , "MOBILE_CO");

        if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
        {
            echo "세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.<br>";
            $requestnumber = "";
            $responsenumber = "";
            $authtype = "";
            $name = "";
            $birthdate = "";
            $gender = "";
            $nationalinfo = "";
            $dupinfo = "";
            $conninfo = "";
            $mobileno = "";
            $mobileco = "";
        }
    }

} else {
    $returnMsg = "데이터없음";
}

$g5['title'] = '회원가입 본인인증';
include_once(G5_PATH.'/head.sub.php');


if ($returnMsg != "") {
    // 1) PC화면이면
    if (!!(FALSE !==strstr(strtolower($_SERVER['HTTP_USER_AGENT']),'mobile')) != 1) {
        alert_close("본인인증에 실패하였습니다. 다시 시도해 주세요.");
    } else {
        alert("본인인증에 실패하였습니다. 다시 시도해 주세요.", G5_URL);
    }

} else {
    // 이미 가입되어있는지 조회
    $rs = sql_fetch("SELECT COUNT(*) as cnt FROM g5_member WHERE mb_hp = '".hyphen_hp_number($mobileno)."'");
    if ((int)$rs['cnt'] > 0) {
        //alert("이미 가입된 휴대폰번호입니다. 로그인 페이지로 이동합니다.", G5_BBS_URL."/login.php");
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                //getNoti(1, '이미 가입된 휴대폰번호입니다.');
                alert("이미 가입된 휴대폰번호 입니다.");

                if (!mobilecheck()  && '<?=$user_agent?>' != '/ioshappy100') {
                    // 1) PC화면이면 팝업닫고 부모창 이동
                    opener.location.href = g5_bbs_url + "/login.php";
                    self.close();
                } else {
                    // 2) 모바일
                    location.href = g5_bbs_url + "/login.php";
                }
            });
        </script>
        <?php
        include_once(G5_PATH.'/tail.sub.php');
    }
    ?>

    <form name="niceFrm" id="niceFrm" action="<?=$url?>" method="post">
        <input type="hidden" name="mb_certify" value="<?=$authtype?>"><!-- 인증수단 : M -->
        <input type="hidden" name="mb_name" value="<?=urldecode($name)?>"><!-- 본인인증 이름 -->
        <input type="hidden" name="mb_birth" value="<?=$birthdate?>"><!-- 생년월일 -->
        <input type="hidden" name="mb_hp" value="<?=$mobileno?>"><!-- 휴대폰번호 -->
        <input type="hidden" name="mb_sex" value="<?=$gender?>"><!-- 성별 -->

        <input type="hidden" name="mb_email" value="">
        <input type="hidden" name="mb_password" value="">
        <input type="hidden" name="mb_nick" value="">
        <input type="hidden" name="mb_addr1" value="">
        <input type="hidden" name="mb_addr2" value="">
        <input type="hidden" name="mb_5" value="">
        <input type="hidden" name="r_code" value="">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function(){

            var f = document.niceFrm;

            // 회원구분세션 가져옴
            var mb_email = sessionStorage.getItem("mb_email");
            var mb_password = sessionStorage.getItem("mb_password");
            var mb_nick = sessionStorage.getItem("mb_nick");
            var mb_addr1 = sessionStorage.getItem("mb_addr1");
            var mb_addr2 = sessionStorage.getItem("mb_addr2");
            var mb_5 = sessionStorage.getItem("mb_5");
            var type = sessionStorage.getItem("type");
            var r_code = sessionStorage.getItem("r_code");

            f.mb_email.value = mb_email;
            f.mb_password.value = mb_password;
            f.mb_nick.value = mb_nick;
            f.mb_addr1.value = mb_addr1;
            f.mb_addr2.value = mb_addr2;
            f.r_code.value = r_code;

            // 회원구분세션 초기화
            sessionStorage.removeItem("mb_email");
            sessionStorage.removeItem("mb_password");
            sessionStorage.removeItem("mb_nick");
            sessionStorage.removeItem("mb_addr1");
            sessionStorage.removeItem("mb_addr2");
            sessionStorage.removeItem("mb_5");
            sessionStorage.removeItem("r_code");


            if(type == 1){
                var url = "<?= G5_BBS_URL.'/register_form.php' ?>";
            }else{
                var url = "<?= G5_BBS_URL.'/register_expert_form02.php' ?>";

            }
            if (!mobilecheck()  && '<?=$user_agent?>' != '/ioshappy100' ) {
                // 1) PC화면이면 팝업닫고 부모창 이동
                document.damain = g5_url;
                opener.name = "Parent_window";
                f.target = opener.name;
                $("#niceFrm").attr("action", url );
                f.submit();
                self.close();

            } else {
                // 2) 모바일
                $("#niceFrm").attr("action", url );
                f.submit();
            }
        });
    </script>

    <?php
}

include_once(G5_PATH.'/tail.sub.php');
exit;
?>
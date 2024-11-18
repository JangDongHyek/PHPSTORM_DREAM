<?
include_once ("./_common.php");

//---------------------------------------------------------------------------------------------------------

$rec_cert = $_REQUEST['rec_cert'];
$certNum  = $_REQUEST['certNum']; // 쿠키 또는 Session을 생성하지 않았을때 certNum 수신처리

if(strlen($rec_cert) == 0 || strlen($certNum) == 0){
    echo("결과값 비정상");
    return;
}

$iv = $certNum;

$url = "";
if (extension_loaded('ICERTSecu')) {

    //01.인증결과 1차 복호화
    $rec_cert = ICertSeed(2,0,$iv,$rec_cert);

    //02.복호화 데이터 Split (rec_cert 1차암호화데이터 / 위변조 검증값 / 암복화확장변수)
    $decStr_Split = explode("/", $rec_cert);

    $encPara  = $decStr_Split[0];		//rec_cert 1차 암호화데이터
    $encMsg   = $decStr_Split[1];		//위변조 검증값

    //03.인증결과 2차 복호화
    $rec_cert = ICertSeed(2,0,$iv,$encPara);

    //03-1. 위변조 검증
    $encMsg2 = ICertHMac($encPara);

    if(strcmp($encMsg, $encMsg2) === 1){
        echo("암호화모듈 호출 실패!!!");
        return;
    }

    //04. 복호화 된 결과자료 "/"로 Split 하기
    $decStr_Split = explode("/", $rec_cert);

    $certNum    = $decStr_Split[0];
    $date       = $decStr_Split[1];
    $CI         = $decStr_Split[2];
    $phoneNo    = $decStr_Split[3];
    $phoneCorp  = $decStr_Split[4];
    $birthDay   = $decStr_Split[5];
    $gender     = $decStr_Split[6];
    $nation     = $decStr_Split[7];
    $name       = $decStr_Split[8];
    $result     = $decStr_Split[9];
    $certMet    = $decStr_Split[10];
    $ip         = $decStr_Split[11];
    $reserve1   = $decStr_Split[12];
    $reserve2   = $decStr_Split[13];
    $reserve3   = $decStr_Split[14];
    $reserve4   = $decStr_Split[15];
    $plusInfo   = $decStr_Split[16];
    $DI         = $decStr_Split[17];

    //05. CI,DI 복호화
    if(strlen($CI) > 0){
        $CI = ICertSeed(2,0,$iv,$CI);
    }
    if(strlen($DI) > 0){
        $DI = ICertSeed(2,0,$iv,$DI);
    }

    function paramChk($pattern, $param){
        $result = preg_match($pattern, $param);

        return $result;
    }

    // 요청번호 (최대 40byte까지 유효)
    if(strlen($certNum) > 40 || strlen($certNum) == 0){
        alert("요청번호 비정상 ($certNum)",G5_URL);
    }

    // 요청일시 (숫자 14자리만 유효)
    $patn = "/^[0-9]*$/";
    if(strlen($date) != 14 || paramchk($patn, $date) == 0){
        alert("요청일시 비정상 ($date)",G5_URL);
    }

    // 생년월일 (값이 있는 경우에는 숫자 8자리만 유효)
    $patn = "/^[0-9]*$/";
    if(strlen($birthDay) != 8 || paramChk($patn, $birthDay) == 0){
        alert("생년월일 비정상 ($birthDay)",G5_URL);
    }

    // 성별 (값이 있는 경우에는 숫자 1자리만 유효)
    $patn = "/^[0-9]*$/";
    if(strlen($gender) != 1 || paramChk($patn, $gender) == 0){
        alert("성별 비정상 ($gender)",G5_URL);
    }

    // 내외국인 (값이 있는 경우에는 숫자 1자리만 유효)
    $patn = "/^[0-9]*$/";
    if(strlen($nation) != 1 || paramChk($patn, $nation) == 0){
        alert("내/외국인 비정상 ($nation)",G5_URL);
    }

    // 성명 (값이 있는 경우에는 최대 30byte까지만 유효)
    $patn = "/^[\xa1-\xfea-zA-Z[:space:],.-]*$/";
    if(strlen($name) > 60 || paramChk($patn, $name) == 0){
        alert("성명 비정상 ($name)",G5_URL);
    }

    // 결과값 (영문대문자 1자리만 유효)
    $patn = "/^[[:upper:]]*$/";
    if(strlen($result) != 1 || paramChk($patn, $result) == 0){
        alert("결과값 비정상 ($result)",G5_URL);
    }

    // 본인확인방법 (영문대문자 1자리만 유효)
    $patn = "/^[[:upper:]]*$/";
    if(strlen($certMet) != 1 || paramChk($patn, $certMet) == 0){
        alert("본인확인방법 비정상",G5_URL);
    }

    set_session("name",$name);
    set_session("phoneNo",$phoneNo);
    set_session("ci",$CI);
    set_session("di",$DI);
    set_session("gender",$gender);
    set_session("birthDay",$birthDay);

    if($plusInfo == "r"){
        // 회원가입
        $url = G5_URL."/bbs/register_form.php";
    } else if($plusInfo == "f"){
        // 아이디/비번 찾기
        $url = G5_URL."/bbs/password_lost_new.php";
    } else if($plusInfo == "ru"){
        // 아이디/비번 찾기
        $url = G5_URL."/bbs/register_form.php?w=u";
    }

}else{
    alert("오류가 발행하였습니다.",G5_URL);
    return;
}

if(empty($url)){
    alert("오류가 발행하였습니다.",G5_URL);
    return;
}

?>
<html>
<head>
    <meta name="robots" content="noindex">
    <script type="text/javascript">
        var move_page_url = "<?=$url?>";


        function end() {
            // 결과 페이지 경로 셋팅
            document.kmcis_form.action = move_page_url;

            var UserAgent = navigator.userAgent;
            /* 모바일 접근 체크*/
            // 모바일일 경우 (변동사항 있을경우 추가 필요)
            if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
                document.kmcis_form.submit();
            }

            // 모바일이 아닐 경우
            else {
                document.kmcis_form.target = opener.window.name;
                document.kmcis_form.submit();
                self.close();
            }
        }
    </script>
</head>
<body onload="javascript:end()">
<form id="kmcis_form" name="kmcis_form" method="post">
    <input type="hidden"	name="rec_cert"		id="rec_cert"	value="<?php echo $rec_cert ?>"/>
    <input type="hidden"	name="certNum"		id="certNum"	value="<?php echo $certNum ?>"/>
</form>
</body>
</html>
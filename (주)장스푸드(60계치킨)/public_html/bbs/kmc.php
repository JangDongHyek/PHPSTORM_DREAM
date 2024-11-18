<?
include_once ("./_common.php");

//.com -> 006009
//.co.kr -> 009005

if(empty($type)){
    alert("정상적으로 이용해주세요.",G5_URL);
}

$code = "";
if (strpos(G5_URL, '.com') !== false) {
    $code = "006009";
} else if (strpos(G5_URL, '.co.kr') !== false) {
    $code = "009005";
}

$url = G5_URL."/bbs/kmc_check.php?type=".$type;


if(empty($code)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

if(empty($url)){
    alert("메인으로 돌아갑니다.",G5_URL);
}

$CurTime = date('YmdHis');
$RandNo = rand(100000, 999999);

//요청 번호 생성
$reqNum = $CurTime.$RandNo;

//01.입력값 변수로 받기
$cpId       = "JFDT1001";        // 고객사ID
$urlCode    = $code;     // URL 코드
$certNum    = $reqNum;     // 요청번호 (본인인증 요청시 중복되지 않게 생성해야함. (예-시퀀스번호))
$date       = $CurTime;        // 요청일시
$certMet    = "M";     // 본인확인방법
$birthDay   = $_REQUEST['birthDay'];	// 생년월일
$gender     = $_REQUEST['gender'];		// 성별
$name       = $_REQUEST['name'];        // 성명
$phoneNo    = $_REQUEST['phoneNo'];		// 휴대폰번호
$phoneCorp 	= $_REQUEST['phoneCorp'];	// 이동통신사
$nation     = $_REQUEST['nation'];      // 내외국인 구분
$plusInfo   = $type;
$tr_url     = $url;      // 본인인증 결과수신 POPUP URL
$tr_add     = "N";      // IFrame사용여부
$extendVar  = "0000000000000000";       // 확장변수

$name = str_replace(" ", "+", $name) ;  //성명에 space가 들어가는 경우 "+"로 치환하여 암호화 처리

//02. tr_cert 데이터변수 조합 (서버로 전송할 데이터 "/"로 조합)
$tr_cert	= $cpId . "/" . $urlCode . "/" . $certNum . "/" . $date . "/" . $certMet . "///////" . $plusInfo . "/" . $extendVar;

//암호화모듈 호출
if (extension_loaded('ICERTSecu')) {

    //03. 1차암호화
    $enc_tr_cert = ICertSeed(1,0,'',$tr_cert);

    //04. 변조검증값 생성
    $enc_tr_cert_hash = ICertHMac($enc_tr_cert);

    //05. 2차암호화
    $enc_tr_cert = $enc_tr_cert . "/" . $enc_tr_cert_hash . "/" . "0000000000000000";

    $enc_tr_cert = ICertSeed(1,0,'',$enc_tr_cert);

}else{
    echo("암호화모듈 호출 실패!!!");
    return;
}

?>

<script>

    window.name = "kmcis_web_sample";

    var KMCIS_window;

    function openKMCISWindow(){

        var UserAgent = navigator.userAgent;
        /* 모바일 접근 체크*/
        // 모바일일 경우 (변동사항 있을경우 추가 필요)
        if (UserAgent.match(/iPhone|iPod|Android|Windows CE|BlackBerry|Symbian|Windows Phone|webOS|Opera Mini|Opera Mobi|POLARIS|IEMobile|lgtelecom|nokia|SonyEricsson/i) != null || UserAgent.match(/LG|SAMSUNG|Samsung/) != null) {
            document.reqKMCISForm.target = '';
        }

        // 모바일이 아닐 경우
        else {
            KMCIS_window = window.open('', 'KMCISWindow', 'width=425, height=550, resizable=0, scrollbars=no, status=0, titlebar=0, toolbar=0, left=435, top=250' );

            if(KMCIS_window == null){
                alert(" ※ 윈도우 XP SP2 또는 인터넷 익스플로러 7 사용자일 경우에는 \n    화면 상단에 있는 팝업 차단 알림줄을 클릭하여 팝업을 허용해 주시기 바랍니다. \n\n※ MSN,야후,구글 팝업 차단 툴바가 설치된 경우 팝업허용을 해주시기 바랍니다.");
            }

            document.reqKMCISForm.target = 'KMCISWindow';
        }

        document.reqKMCISForm.action = 'https://www.kmcert.com/kmcis/web/kmcisReq.jsp';
        document.reqKMCISForm.submit();
    }

</script>
<style>
    body{background: #FED71A;}
    .kmc{text-align: center; display: table; width: 100%; height: 100vh; }
    .kmc form{display: table-cell; vertical-align: middle;}
    .kmc .btn{background: #3E1717; border: 3px solid #fff; font-weight: 600; font-size: 1.2em; color: #fff; padding: 1em 1.4em; border-radius: 10px; cursor: pointer;}
    .kmc .btn:hover{background: transparent; color: #3E1717; border-color: #3E1717; transition: all 0.5s;}
</style>
<div class="kmc">

    <form name="reqKMCISForm" method="post" action="#">
        <input type="hidden" name="tr_cert"     value = "<?php echo $enc_tr_cert ?>">
        <input type="hidden" name="tr_url"      value = "<?php echo $tr_url ?>">
        <input type="hidden" name="tr_add"      value = "<?php echo $tr_add ?>">
        <input type="submit" value="KMC 본인확인서비스 요청"  class="btn" onclick= "javascript:openKMCISWindow();">
    </form>
</div>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$sexArr=array("남"=>"male","여"=>"female");
$age=intval(date("Y")-substr($member[mb_birth],0,4));

?>
<script>
$(function() {
	$("#container_title").text("회원가입 완료");

	$('a#back').on("click", function() {
		event.preventDefault();
		location.href = g5_url;
	});
	<? if(strpos($_SERVER['HTTP_USER_AGENT'],"Android")){?>
		
		window.Android.AdBrixData('<?=$member[mb_id]?>','<?=$sexArr[$member[mb_sex]]?>',parseInt('<?=$age?>'));
	<? }else if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"IOS")){?>
//		var data = [];
//		data.push('<?=$member[mb_id]?>,<?=$sexArr[$member[mb_sex]]?>,<?=$age?>');
//		data.push('test,man,20');
		try{		
			webkit.messageHandlers.AdBrix.postMessage('<?=$member[mb_id]?>,<?=$sexArr[$member[mb_sex]]?>,<?=$age?>');
		}catch(error){
			alert(error.toString());
		}
	<? }?>
});
</script>

<style>
#reg_result {padding: 30px 10px !important; text-align: center;}
#reg_result .btn_confirm {margin: 30px 0 0;}
#reg_result h1 {font-size: 2em; font-weight: bold; margin: 20px 0;}
</style>

<div id="reg_result" class="mbskin">
        <img src="<?=G5_URL?>/theme/lover/img/new/channel_t.png" alt="신중하게 찾아주는 당신의인연" style="width:250px">
        <h1>회원가입이<br>완료되었습니다.</h1>


	
	<!--
    <?php if ($config['cf_use_email_certify']) { ?>
    <p>
        회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.<br>
        발송된 인증메일을 확인하신 후 인증처리를 하시면 사이트를 원활하게 이용하실 수 있습니다.
    </p>
    <div id="result_email">
        <span>아이디</span>
        <strong><?php echo $mb['mb_id'] ?></strong><br>
        <span>이메일 주소</span>
        <strong><?php echo $mb['mb_email'] ?></strong>
    </div>
    <p>
        이메일 주소를 잘못 입력하셨다면, 사이트 관리자에게 문의해주시기 바랍니다.
    </p>
    <?php } ?>

    <p>
        회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.<br>
        아이디, 비밀번호 분실시에는 회원가입시 입력하신 이메일 주소를 이용하여 찾을 수 있습니다.
    </p>
    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>
	-->


</div>

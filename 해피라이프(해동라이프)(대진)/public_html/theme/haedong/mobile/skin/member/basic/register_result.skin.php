<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="reg_result" class="mbskin">
    <div class="title">
    	<div class="mg"><img src="<?php echo $member_skin_url;?>/img/welcome.gif" /></div>
        <div class="name"><strong><?php echo get_text($mb['mb_name']); ?></strong>님의 회원가입을 진심으로 축하합니다.</div>
    </div>
    <div id="result_email" class="box">
        <div class="line">
            <span class="st">아이디</span>
            <strong class="ut"><?php echo $mb['mb_id'] ?></strong>
        </div>
		<? if ($mb_group == 1 || $mb_group == 2) { ?>
        <div class="line">
            <span class="st">입금 계좌번호</span>
            <strong class="ut"><?=$config['cf_1']?></strong>
        </div>
        <div class="line">
            <span class="st">예금주</span>
            <strong class="ut"><?=$config['cf_2']?></strong>
        </div>
        <div class="line">
            <span class="st">가입비</span>
            <strong class="ut"><?=number_format($mb['mb_bank_amt'])?>원</strong>
        </div>
		<? } ?>
    </div>
    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>" class="btn02 gohome">메인으로</a>
    </div>
</div>



<!--
<? // 스코피 회원가입인 경우 return
if ((int)$mb['mb_group'] == 3) { ?>
<script>
$(function() {
	var url = "http://app.skopi.com/skopi/event/happyLifeReturn.do";
	var formData = {"memberCd" : "<?=$mb['skopi_memberCd']?>"};

	/*
	$.ajax({
		dataType : 'jsonp',
		jsonpCallback: "callBack",
		url: url,
		async: false,
		type: "GET",
		data: formData,
		scriptCharset : 'UTF-8',
		success: function(data){  
			console.log(data);
		}, error : function(xhr,status,error) {
			console.log(error);
		}
	});
	*/
});
</script>
<? } ?>
-->
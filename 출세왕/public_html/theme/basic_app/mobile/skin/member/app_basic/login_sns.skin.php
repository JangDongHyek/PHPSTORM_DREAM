<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
body{background: #1bc5f6;}
</style>



<div id="sns_login">
    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo_img2.png" class="logo"><span>전문가의 손길이 필요할 땐</span>깨끗한 연구소</span></h1>
    <ul class="lg_btn">
    	<li class="top"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
        <li class="sns kakao"><a href="javascript:;"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/sns_kakao.png" class="카카오"></span>카카오로 로그인</a></li>
        <li class="sns naver"><a href="javascript:;"><span class="ico"><img src="<?php echo G5_THEME_IMG_URL ?>/app/sns_naver.png" class="네이버"></span>네이버로 로그인</a></li>
        <li class="guest"><a href="javascript:;">비회원신청</a></li>
    </ul><!--lg_btn-->
    <div class="cus"><i class="fas fa-asterisk"></i> 비회원신청시 고객센터로 바로 연결됩니다.</div>
</div><!--sns_login-->


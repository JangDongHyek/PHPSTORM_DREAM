<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>
<style>
body{background: #1bc5f6;}
</style>



<div id="welcome">
    <h1><span>깨끗한 연구소에</span>오신 것을 환영합니다</h1>
    <ul class="lg_box">
    	<li><a href="javascript:;">기사님이신가요?</a><span><img src="<?php echo G5_THEME_IMG_URL ?>/app/quest2.png"></span></li>
        <li><a href="javascript:;">고객님이신가요?</a><span><img src="<?php echo G5_THEME_IMG_URL ?>/app/quest1.png"></span></li>
    </ul><!--lg_box-->
    <div class="guest"><a href="#"><i class="fas fa-smile-wink"></i> 한번 둘러볼게요</a></div>
</div><!--welcome-->


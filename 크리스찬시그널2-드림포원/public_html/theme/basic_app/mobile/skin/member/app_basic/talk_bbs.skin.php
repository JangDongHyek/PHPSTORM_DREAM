<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>



<!--커뮤니티-->
<div id="talk_bbs" class="cf">
	<div class="bx">
    	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=talk">
        	<p><i class="far fa-arrow-square-right"></i></p>
        	<img src="<?php echo G5_THEME_IMG_URL; ?>/app/talk01.png"/>
            <h2>커뮤니티</h2>
            <h3>오늘의 말씀 / 자유게시판 / 데이트 등 데이트를 위한 팁과 다양한 정보를 공유하세요.</h3>
    	</a>
    </div>
	<div class="bx">
    	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=info">
        	<p><i class="far fa-arrow-square-right"></i></p>
        	<img src="<?php echo G5_THEME_IMG_URL; ?>/app/talk02.png"/>
            <h2>자료실</h2>
            <h3>교회소식/교회세미나 / 장애인 이동수단 정보 / 부부세미나 등 다양한 자료를 공유하세요.</h3>
    	</a>
    </div>
</div><!--talk_bbs-->
<!--커뮤니티-->
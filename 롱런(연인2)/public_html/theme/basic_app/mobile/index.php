<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>


	<div id="visual">
    	<div class="slg animated slideUp"><img src="<?php echo G5_THEME_IMG_URL ?>/app/visual_slg.png" /></div>
        <div class="bike animated slideUp"><img src="<?php echo G5_THEME_IMG_URL ?>/app/visual_bike.png" /></div>
    </div>
    
    <div id="idx_icon">
    	<ul>
        	<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=serv01"><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon01.png" /><p>배달대행</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=serv02"><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon02.png" /><p>퀵배달</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=used"><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon03.png" /><p>중고거래</p></a></li>
        	<li><a href="javascript:alert('준비중입니다.')"><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon04.png" /><p>센터찾기</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=bike"><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon05.png" /><p>바이크문의</p></a></li>
        	<li><a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/app/idx_icon06.png" /><p>희망기부</p></a></li>
        </ul>
    
    </div>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
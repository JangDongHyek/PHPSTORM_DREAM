<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<div id="idx_container">

	<div class="visual">
        <div class="slogan">
            <strong><?php echo $config['cf_title']; ?></strong>
            <p>BROS &amp; KIM</p>
        </div>
        <ul class="idx_icon idc01">
            <li>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon01.png" alt="">
                </a>
                <p>회사소개</p>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=portfolio01">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon03.png" alt="">
                </a>
                <p>포트폴리오</p>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=invest">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon02.png" alt="">
                </a>
                <p>MY투자내역</p>
            </li>
        </ul>
        <ul class="idx_icon idc02">
            <li>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=partner">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon04.png" alt="">
                </a>
                <p>협력사</p>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=chart">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon05.png" alt="">
                </a>
                <p>투자흐름도</p>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=data">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_icon06.png" alt="">
                </a>
                <p>자료실</p>
            </li>
        </ul>
    </div>
    
    <div class="data_bbs">
        <div class="cf row"><?php echo latest('theme/basic', 'notice', 3, 20); ?></div>
    </div>
    
  
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
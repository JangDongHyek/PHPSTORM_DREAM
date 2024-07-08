<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sub_id = 'intro';

//include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_THEME_PATH.'/head.sub.php');
?>

<div id="intro_new">
    <div class="star">
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
        <i></i>
    </div>

        <h1><img src="<?php echo G5_THEME_IMG_URL ?>/new/logo_w.png" alt="연인"/><p>YEONIN</p></h1>
    <ul class="btn_wrap">
        <li><a href="<?=G5_BBS_URL?>/login.php">로그인</a></li>
        <li><a href="<?=G5_BBS_URL?>/register_form.php">회원가입</a></li>
        <li><a href="http://www.yeonincompany.com/">이용방법</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=review">커플후기</a></li>
    </ul>
</div><!--#intro_new-->

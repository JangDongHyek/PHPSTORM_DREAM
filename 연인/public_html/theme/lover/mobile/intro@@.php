<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$sub_id = 'intro';

//include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_THEME_PATH.'/head.sub.php');
?>

<div id="intro_bg">
    
    <div class="intro_btn"> 
        <ul>
            <li><a href="<?=G5_BBS_URL?>/login.php">로그인</a></li>
            <li><a href="<?=G5_BBS_URL?>/register_form.php">회원가입</a></li>
        </ul>
    </div>
    
    <div id="idx_container">
    
        <div class="intro_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="연인"/></div>
    
        <div class="intro_txt">
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/main/intro_txt01.png" alt="실시간 이상형 매칭"/></div>
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/main/intro_txt02.png" alt="무작위 매칭은 no!"/></div>
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/main/intro_txt03.png" alt="헬퍼 피드백을 통한 성공적인 소개팅"/></div>
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/main/intro_txt04.png" alt="커플탄생 1위 커플 100%리얼후기 보고 다들 인연 만나러 오세요!"/></div>
        </div><!--.intro_txt-->
        
        <div class="intro_review"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=review">커플후기 보러가기</a></div>
        <div class="intro_review"><a href="<?php echo G5_URL ?>/intro_new.php" style="color:#BBAFE3; width: 100px; height: 100px;">intro</a></div>
        
    </div>  
    
</div><!--#intro_bg--> 

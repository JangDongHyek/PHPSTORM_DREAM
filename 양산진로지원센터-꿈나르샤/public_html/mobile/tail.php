<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}
?>
    </div>
</div>

<hr>

<?php echo poll('basic'); // 설문조사 ?>

<hr>

<div id="btn_top"><a href="#"><img src="<?php echo G5_IMG_URL ?>/mobile/btn_top.png"></a></div>

<div id="ft">
    </*?php echo popular('basic'); // 인기검색어 /*?>
    </*?php echo visit('basic'); // 방문자수 /*?>
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4">찾아오시는 길</a>
            
            <!--로그인-->
            <?php if ($is_member) { ?>
            <?php if ($is_admin) { ?>
            <a href="<?php echo G5_ADMIN_URL ?>" id="snb_adm"><b>관리자</b></a>
            <?php } ?>
            <a href="<?php echo G5_BBS_URL ?>/logout.php" id="snb_logout">로그아웃</a>
            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL ?>/login.php" id="snb_login">로그인</a>
            <?php } ?>
            <!--로그인-->
            
			<?php
            if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
            <a href="<?php echo get_device_change_url(); ?>">PC 버전으로</a>
            <?php
			}
			
			if ($config['cf_analytics']) {
				echo $config['cf_analytics'];
			}
			?>
        </div><!--#ft_company-->
        <img src="<?php echo G5_IMG_URL ?>/mobile/copy_logo.gif" /><br /><br />
        양산진로교육지원센터  <br />  주소 : 경상남도 양산시 양주3길 40-13 (양주초등학교내 창의관 1층) <br>
        전화번호 : 055-785-0151 팩스 : 055-785-0152 E-mail : dreamfly0151@hanmail.net  <br> 
        <b>COPYRIGHT(C) 2016 양산진로교육지원센터. ALL RIGHTS RESERVED.</b><br>
       <!-- <a href="#">상단으로</a>-->
    </div><!--#ft_copy-->
</div><!--#ft-->


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
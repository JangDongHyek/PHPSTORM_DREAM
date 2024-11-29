<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//현재주소를 불러옴
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/',$uri);
//배열의 마지막 반환
$arr_last=array_pop($uri);

?>
    </div>
</div>

<?php if(basename($_SERVER["PHP_SELF"]) != 'register_result.php' && basename($_SERVER["PHP_SELF"]) != 'register_form.php') { ?>
<div id="ft">
	<div id="ft_menu">
    	<ul>
        	<li><a href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01<?php if($arr_last == ""){ echo "_on"; } ?>.png" /><p>HOME</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/lesson_reser.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02<?php if($arr_last == "lesson_reser.php"){ echo "_on"; } ?>.png" /><p>레슨예약</p></a></li>
			<li><a href="<?php echo G5_BBS_URL ?>/lesson_list.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03<?php if($arr_last == "lesson_list.php"){ echo "_on"; } ?>.png" /><p>레슨정보</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/family_site.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon04<?php if($arr_last == "family_site.php" || $arr_last == "site_pro.php"){ echo "_on"; } ?>.png" /><p>지점현황</p></a></li>
        	<li><a href="<?php echo G5_BBS_URL ?>/mypage.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05<?php if($arr_last == "mypage.php" || $arr_last == "lesson_confirm.php"){ echo "_on"; } ?>.png" /><p>마이페이지</p></a></li>
        </ul>
    </div>
    <?php /*?><div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        Copyright &copy; <b>RIDERS</b> All rights reserved.<br>
    </div><?php */?>
</div>
<?php } ?>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
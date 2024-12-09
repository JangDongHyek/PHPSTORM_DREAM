<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<div id="ft">
	<div id="ft_menu">
    	<ul>
        	<li><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01.png" /></a></li>
        	<?php /*?><li><a href=""><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02.png" /></a></li><?php */?>
        	<li>
			<?php if ($is_member) { ?>
            <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03.png" /></a>
            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03.png" /></a>
            <?php } ?>
            </li>
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
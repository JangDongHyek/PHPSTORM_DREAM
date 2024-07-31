<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

      </div>
    </div>
</div>

<hr>


<hr>
<div id="ft">
	<div class="ft_menu">
        <?php if ($is_member) { ?>
        <?php if ($is_admin) {  ?>
        <?php } else { ?>
        <a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">Modify</a>
        <?php } ?>
        <a href="<?php echo G5_BBS_URL; ?>/logout.php">Logout</a>
        <?php } else { ?>
        <a href="<?php echo G5_BBS_URL; ?>/login.php">Login</a>
        <?php /*?><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join">회원가입</a><?php */?>
        <?php } ?>
    	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy_eng" class="point">Privacy Policy</a>
    	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision_eng">Terms and Conditions of Service</a>
    </div>

    <div id="ft_copy">
    234, Global edu-ro, Daejeong-eup, Seogwipo-si, Jeju-do, Republic of Korea<br />
    Business license number : 616-85-30005<br />CEO : Bong-woo, Lee<br />
	COPYRIGHTⓒ 2017 제이제이케터링(주). ALL RIGHTS RESERVED.
    </div>
</div>

<!--<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>
<script>
//상하단바로가기 버튼
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});

</script>-->





<?php /*?><?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?><?php */?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
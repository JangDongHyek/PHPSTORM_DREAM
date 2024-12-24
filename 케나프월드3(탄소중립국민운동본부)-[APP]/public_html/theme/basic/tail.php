<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>



<!-- 하단 시작 { -->
<div id="ft">
	<div id="ft_copy">
        <!--상호-->
        <p><?php echo $config['cf_title']; ?></p>
        <!--상호-->
        <!--기본정보-->
        <strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?>&nbsp;
        <strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?>&nbsp;
        <strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?><br />
        <strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?>&nbsp;
        <strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?>&nbsp;
        <strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?>&nbsp;
        <strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?><br>
        <strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?>&nbsp;
        <strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?>&nbsp;
        <strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?>
        <!--기본정보-->
        COPYRIGHTⓒ2015 ITFORONE. ALL RIGHTS RESERVED.<br>
        <a href="#hd" id="ft_totop"><img src="<?php echo G5_THEME_IMG_URL ?>/btn_top.gif" border="0" /></a>
    </div>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<!--<a href="<?php echo get_device_change_url(); ?>" id="device_change">모바일 버전으로 보기</a> -->
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
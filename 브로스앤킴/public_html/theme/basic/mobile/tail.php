<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
	    </div>
    </div>
</div>

<div id="ft" <?php if(!defined('_INDEX_')){ echo "class='sub'"; } ?>>
	<div class="inner">
        <div class="ft_menu">
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a></li>
            <li><a href="<?php echo G5_URL ?>/theme/basic/mobile/sitemap.php">사이트맵</a></li>
        </div>
        <div id="ft_company">
            <!-- address -->
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1>
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span></p>
                <p><span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span> <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
				<p><span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span> <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span> <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span><span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span> <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span></p>
                <p><span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span> <span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span></p>
				<p class="co">Copyright(C) BROS&amp;KIM. All Rights Reserved.</p>
			</address>	
			<!-- //address -->
        </div>
    </div>
    <!--<div id="ft_copy">
        <div>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
            Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br>
            <a href="#hd">maintenance : IT fot one</a>
            <a href="#hd">TOP</a>
        </div>
    </div> -->
</div>
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
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
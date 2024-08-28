<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
		<? if($bo_table){ ?>
			</div>
			<!-- /w1200 -->
		<? } ?>

	<? if(defined('_INDEX_')) { ?>
	<? }else if($type == "subVer"){ ?>

	<?} else {?>
	</div>
	<!-- /subWrap -->

	<footer>
		<div class="w1200">
			<div class="telBox" >
				<p class="tit"><?php echo $config['cf_4_subj']; ?></p><p class="blue tel"><?php echo $config['cf_4']; ?></p>
			</div>
			<div class="adrBox">
				<h1>(주)범아렌터카</h1>
				<p class="st2"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보 처리방침</a><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관</a>
				<?php if(!$is_admin){?>
					<a href="<?php echo G5_BBS_URL?>/login.php" class="admB">관리자</a>
					<?php }else{?>
					<a href="<?php echo G5_BBS_URL?>/logout.php" class="admB st2">로그아웃</a>
					<?php }?>
				
				
				
				</p>
				<p><span><?php echo $config['cf_1']; ?></span><span><?php echo $config['cf_2_subj']; ?> : <?php echo $config['cf_2']; ?></span><span><?php echo $config['cf_3_subj']; ?> : <?php echo $config['cf_3']; ?></span><span><?php echo $config['cf_5_subj']; ?> : <?php echo $config['cf_5']; ?></span></p>
				<p class="copy">COPYRIGHT(c) 2021 (주)범아렌터카. ALL RIGHTS RESERVED.</p>
			</div>

		</div>
	</footer>
	<?}?>
</div>
<!-- /wrap -->



<script>
    AOS.init({
        easing: 'ease-in-out-sine',
		duration: 800
    });
</script>
<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
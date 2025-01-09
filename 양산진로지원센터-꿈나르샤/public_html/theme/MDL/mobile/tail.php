<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
</div>

<footer class="mdl-mega-footer">
	<div class="mdl-mega-footer__middle-section">

		<div class="mdl-mega-footer__drop-down-section">
			<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
			<h1 class="mdl-mega-footer__heading">Features</h1>
			<ul class="mdl-mega-footer__link-list">
				<li><a href="#">About</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Partners</a></li>
				<li><a href="#">Updates</a></li>
			</ul>
		</div>

		<div class="mdl-mega-footer__drop-down-section">
			<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
			<h1 class="mdl-mega-footer__heading">Details</h1>
			<ul class="mdl-mega-footer__link-list">
				<li><a href="#">Specs</a></li>
				<li><a href="#">Tools</a></li>
				<li><a href="#">Resources</a></li>
			</ul>
		</div>

		<div class="mdl-mega-footer__drop-down-section">
			<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
			<h1 class="mdl-mega-footer__heading">Technology</h1>
			<ul class="mdl-mega-footer__link-list">
				<li><a href="#">How it works</a></li>
				<li><a href="#">Patterns</a></li>
				<li><a href="#">Usage</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">Contracts</a></li>
			</ul>
		</div>

		<div class="mdl-mega-footer__drop-down-section">
			<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked>
			<h1 class="mdl-mega-footer__heading">FAQ</h1>
			<ul class="mdl-mega-footer__link-list">
				<li><a href="#">Questions</a></li>
				<li><a href="#">Answers</a></li>
				<li><a href="#">Contact us</a></li>
			</ul>
		</div>

	</div>

	<div class="mdl-mega-footer__bottom-section">
		<div class="mdl-logo">Title</div>
		<ul class="mdl-mega-footer__link-list">
		<li><a href="#">Help</a></li>
		<li><a href="#">Privacy & Terms</a></li>
		</ul>
	</div>
</footer>

<?/*
<?php echo poll('theme/basic'); // 설문조사 ?>

<div id="ft">
    <?php echo popular('theme/basic'); // 인기검색어 ?>
    <?php echo visit('theme/basic'); // 방문자수 ?>
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        Copyright &copy; <b>소유하신 도메인.</b> All rights reserved.<br>
        <a href="#">상단으로</a>
    </div>
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
*/?>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
		<!-- Your content goes here -->
		</div>
	</main>
</div>
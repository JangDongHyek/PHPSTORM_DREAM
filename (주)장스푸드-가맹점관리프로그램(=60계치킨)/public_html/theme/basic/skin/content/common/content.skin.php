<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_EDITOR_LIB);

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<form method="post" name="common_frm" action="<?php echo G5_BBS_URL ?>/common_write_update.php" enctype="MULTIPART/FORM-DATA" onsubmit="return frm_check(this)">
	<input type="hidden" name="co_id" value="<?php echo $co_id ?>">

		<!-- 배송안내 -->
		<div style="margin:20px 0px 10px 0px;">배송안내</div>
		<div>
			<?php echo editor_html('co_content', get_text($co['co_content'], 0)); ?>
		</div>

		<!-- 교환 및 반품안내 -->
		<div style="margin:20px 0px 10px 0px;">교환 및 반품안내</div>
		<div>
			<?php echo editor_html('co_mobile_content', get_text($co['co_mobile_content'], 0)); ?>
		</div>

		<div style="padding: 15px 0px; text-align: center;">
			<input id="edit_btn" type="submit" value="저장하기">
		</div>

	</form>

</div>

<script>
function frm_check(f){
	<?php echo get_editor_js('co_content'); ?>
    <?php echo get_editor_js('co_mobile_content'); ?>

	return true;
}
</script>

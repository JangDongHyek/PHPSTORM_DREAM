<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<aside style="/*display:table-cell;*/text-align:center;">
	<!--서브메뉴 100%-->
	<nav id="depth_menu" class="wow fadeIn" data-wow-delay=".2s">
		<dl>
<!--
			<dd class="home">
				<a href="<?php echo G5_URL ?>/">
					<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_home.svg" alt="">
				</a>
			</dd>
-->
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<? if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03" || $co_id == "greet03" || $co_id == "greet04") {  ?>
			<dd class="item3">
			<? } else if ($bo_table == "pro01" || $bo_table == "pro02" || $bo_table == "pro03" || $bo_table == "pro04") { ?>
			<dd class="item4">
			<? } else  { ?>
			<dd>
			<? } ?>	
			<a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='current'"; } ?>>
				<span><?php echo $sub['sm_name'];?></span>
			</a>
			</dd>
			<?php } ?>
		</dl>
	</nav>
</aside>

<script type="text/javascript">
	$(function() {
		$(".current").each(function() {
			var offset = $(this).offset().left;
			$("#depth_menu").animate({
				scrollLeft: offset - ($(window).width() / 2) + 40
			}, 1000);
			//$("#bo_cate_ul").scrollLeft(offset-($(window).width()/2)+100);
		});
	});

</script>

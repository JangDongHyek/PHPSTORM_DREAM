<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<aside style="/*display:table-cell;*/text-align:center;">
	<!--서브메뉴 100%-->
	<nav id="depth_menu" class="wow fadeIn" data-wow-delay=".2s">
		<dl>
			<dd class="home">
				<a href="<?php echo G5_URL ?>/">
					<i class="fas fa-home"></i>
				</a>
			</dd>
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<dd><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='current'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
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

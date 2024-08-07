<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

//$imgwidth = 200; //표시할 이미지의 가로사이즈
//$imgheight = 107; //표시할 이미지의 세로사이즈
?>

<div class="lt">
    <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong>
    <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div>
</div>
<div id="oneshot_2_7" class="swiper333 swiper-container">
	<!--
	<div class="la_title">
		<?php echo $bo_subject ?>
	</div>
	-->
	<ul class="swiper-wrapper">
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li class="swiper-slide">
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="img_set">
					<?php        
					$bf_no= $bo_table=="review"?"0":"1";
					$sql="select * from g5_board_file where bo_table='$bo_table' and wr_id='".$list[$i][wr_id]."' and bf_no='$bf_no'";
					$imgRow=sql_fetch($sql);
					if($imgRow[bf_file]){
						$img_content = '<img src="'.G5_DATA_URL.'/file/'.$bo_table.'/'.$imgRow[bf_file].'" alt="'.$thumb['alt'].'" width="'.$imgwidth.'" height="'.$imgheight.'">';
					}else{
						$matchs = get_editor_image($list[$i]['wr_content']);
						
						$img_content = $matchs[0][0];
					}
					
					echo $img_content;												               
					?>
				</a>
				<div class="subject_set">
					<div class="sub_title">			
					<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo cut_str($list[$i]['subject'],100, "..") ?></a>
					</div>


				</div>
				
		</li>

	
	<?php } ?>
	<?php if (count($list) == 0) { echo '<p>게시물이 없습니다.</p>'; } ?>
			
	</ul>
</div>


<script type="text/javascript">
	var swiper = new Swiper('.swiper333', {
		slidesPerView: 1,
		loop: true,
		spaceBetween: 0,
		autoplay: {
			delay: 5000,
		},
	});
</script>
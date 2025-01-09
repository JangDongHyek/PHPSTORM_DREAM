<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>



<style>
	.latest_wrap {width:calc(100% - 24px ); border: 0px solid #8DD5F3; padding: 10px;  height:115px; margin-top:-24px}
	.latest_wrap table { table-layout:fixed; width:100%; padding:0; border-spacing:0; }

	.latest_wrap table th { vertical-align:top; margin-left:10px; font-size:9pt; color:#6B6B6B; font-weight:normal; text-align:left; }
	.la_border { border-bottom:1px solid #E6E6E6; }
	.la_contd{
		vertical-align:top;
		padding:0;
		/* 한 줄 자르기 */
		display: inline-block;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;

		/* 여러 줄 자르기 추가 스타일 */
		white-space: normal;
		height: 72px;
		text-align: left;
		word-wrap: break-word;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
	}
</style>


			
<div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div>
				
			
<div class="latest_wrap">


			
			

	<table style="margin:0; padding:0px 0px; width:100%; border-collapse:collapse;">
	<tbody>
	<tr>
		<?php
		for ($i=0; $i<count($list); $i++) {
			$thumb = get_list_thumbnail('galleryy', $list[$i]['wr_id'], 105, 105);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="105px" height="105px">';
			} else {
				$img_content = '<span style="width:90px;height:90px">no image</span>';
			}
		?>
		<td style="margin:0; padding:0px 0px; width:25%;" align="center">
			<table style="margin:0; padding:0px 0px; width:100%; border-collapse:collapse;">
			<tbody>
				<tr>
					<td height="110" align="center"><?php echo "<a href=\"".$list[$i]['href']."\">"; ?><?php echo $img_content; ?></a></td>
				</tr>
				<tr>
					<td valign="top">
					<div style="text-align:center; font-size:12px; height:1px;">
<?php ?>			  <?php echo "<a href=\"".$list[$i]['href']."\">"; ?><?php echo $list[$i]['wr_subject']; ?></a>
<?php ?>	</div>				</td>
				</tr>
			</tbody>
			</table>
		</td>
		<?php
		}
		?>
	</tr>
	</tbody>
	</table>



<?/*
    <?php for ($i=0; $i<count($list); $i++) {  ?>
	<?php echo "<a href=\"".$list[$i]['href']."\">"; ?>
	<table class="<?php if($i!=2) echo "la_border"; ?>">
		<tr>
			<td rowspan="2" style="padding: 22px 0 22px 0; ">
				<?php
					$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $width, $height);

					if($thumb['src']) {
						$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$width.'" height="'.$height.'">';
					} else {
						$img_content = '<span style="width:'.$width.'px;height:'.$height.'px">no image</span>';
					}
					echo $img_content;
				?>
			</td>
			<th style="width:calc( 450px - <?php echo $width;?>px ); padding: 22px 0 0 0; ">
				<span>
					<?php
						if ($list[$i]['is_notice'])
							echo "<strong>".$list[$i]['subject']."</strong>";
						else
							echo $list[$i]['subject'];

						if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
					?>
				</span>
			</th>
		</tr>
		<tr>
			<td class="la_contd"><?php echo $list[$i]['wr_content']; ?></td>
		</tr>
	</table>

			
			
	</a>
    <?php }  ?>
*/?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <dl class="none1">행사가 없습니다.</dl>
    <?php }  ?>
	
	

		
		
		
</div>
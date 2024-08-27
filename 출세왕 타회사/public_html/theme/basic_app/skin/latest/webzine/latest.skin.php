<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$board['bo_gallery_width'] = 150;
$board['bo_gallery_height'] = 200;
?>

<!-- <?php echo $bo_subject; ?> 웹진형 최신글 시작 { -->
<style>
.cont a:link, a:visited{
    color: #656565;
}
.cont p{
    color: #656565;
}
</style>

<div class="wzine">
<br />
<div class="wzine_cont">

<ul class="wzine_list">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li style="height:330px;">
            <?php
			$content = cut_str(preg_replace("@<.*?>@","", $list[$i]['wr_content']),350); // 내용 자르기
	
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
			} else {
				$img_content = '';
			}
			?>
			<table>
				<tr>
					<td style="width:50%;">
						<div class="thumb">
							<a href="<?=$list[$i]['href']?>" style="color:#333;"><?=$img_content?></a>
						</div>
					</td>
					<td style="text-align:center;">
						<a href="<?=$list[$i]['href']?>" class="cont">
							<b><?php echo $list[$i]['subject']; ?></b>
							<br /><br />
							<b><?php echo $list[$i]['wr_1']; ?></b>
						</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br />
						<div class="r_list">
							<a href="<?=$list[$i]['href']?>">
								<span class="cont">									
									<p>
										<?=conv_content($list[$i]['wr_2'], $html, false);?>
									</p>
								</span>
							</a>
						</div>
					</td>
				</tr>
			</table>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
  <li>
  <div class="thumb"><a href="#"><img alt="" src="<?php echo $latest_skin_url ?>/img/no_img.jpg"></a></div>
  <div class="r_list"><a href="#"><span class="cont">게시물이 없습니다.<br>게시물이 없습니다.</span>
  </a></div></li>
  <?php }  ?>
	</ul>
  </div>
 </div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
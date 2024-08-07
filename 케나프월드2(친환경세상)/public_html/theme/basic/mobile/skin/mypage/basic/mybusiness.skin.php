<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="wal-cotainer" id="wal_cotainer">
	<div>
		<a href="<?php echo G5_BBS_URL;?>/write.php?bo_table=<?php echo $bo_table;?>" class="btn btn-danger btn-lg" style="width:100%;height:auto;">정보 등록하기</a>
	</div>
	<div style="padding:5px"></div>
	<article class="wal-frm">
		<div class="wal-req">
			<dl>
				<dt class="wc-price">등록한 정보 ( <?php echo number_format($total_count);?> 개)</dt>
			</dl>
			<dl>
				<?php 
				for($i=0; $i<count($list); $i++){ 
					$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
					if($thumb['src']) {
						$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="100%" style="height:auto;">';
					} else {
						$img_content = '';
					}
				?>
				<dd>
					<a class="font-black" href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&wr_id=<?php echo $list[$i]['wr_id'];?>">
						<table class="wc-tbl">
							<colgroup>
								<col style="width:40%; max-width:300px">
								<col style="width:auto;">
							</colgroup>
							<tbody>
								<tr>
									<th><?php echo $img_content; ?></th>
									<td>
										<p class="wc-title"><?php echo $list[$i]['wr_subject'] ?></p>
										<p class="text-right">
											<?php echo substr($list[$i]['wr_datetime'], 0, 11);?>
										</p>
									</td>
								</tr>
							</tbody>
						</table>
					</a>
				</dd>
				<?php } ?>
			</dl>
		</div>
		<?php echo $write_pages;?>
	</article>
</div>

<script>
$(document).ready(function (){
	$("#wal_cotainer").css("min-height", $(window).height() - 80);
});	

</script>


<?
// 위도경도 테스트
if($member["mb_id"] == "lets080") {



function getDistance($lat1, $lon1, $lat2, $lon2, $unit) { 
	$radius = 6378.137; // earth mean radius defined by WGS84
	$dlon = $lon1 - $lon2; 
	$distance = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius; 

	if ($unit == "K") {			//km
		return ($distance); 
	} else if ($unit == "M") {	//mile
		return ($distance * 0.621371192);
	} else if ($unit == "N") {
		return ($distance * 0.539956803);
	} else {
		return 0;
	}
}
$lat1 = 35.17664375415083;	//아이에스타워
$lon1 = 129.125410468606; 
$lat2 = 35.175396725909174;	//센텀중학교
$lon2 = 129.123758051367;

echo getDistance($lat1, $lon1, $lat2, $lon2, "K") . " km<br>";

} // lets080
?>
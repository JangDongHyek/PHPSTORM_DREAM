<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$bo_table = "practice";
$write_table = "g5_write_".$bo_table;
$sql = "select * from g5_member_like as a left join {$write_table} as b on a.wr_id = b.wr_id where a.mb_id = '{$member['mb_id']}' order by mp_datetime desc";
$result = sql_query($sql);

add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="search_wrap">
    <div id="s_search">
        <h2 class="r_list"><i class="fa fa-eyedropper "></i> 찜 한 연습실
    </div><!--s_search-->

	 <div class="container">	
        <!--탑배너시작-->
        <div class="s2_topten row">
            <div class="topten_in col-xs-12">
                <div id="topten_list">
					<?php 
					for($i=0; $i<$row=sql_fetch_array($result); $i++){
						$row['href'] = "/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id'];

						$thumb = "";
						if($row['wr_19']){
							$thumb = get_list_thumbnail($bo_table, $row['wr_id'], 150, 150);
						}

						if($thumb['src']) {
							$img_href = $thumb['src'];
						}else if(!$thumb['src'] && $row['wr_19']){
							$img_href = G5_THEME_URL."/mobile/skin/board/{$bo_table}/img/noimg_s.jpg";
						} else {
							$img_href = G5_THEME_URL."/mobile/skin/board/{$bo_table}/img/none_s.jpg";
						}
						
						$sql = " select round(avg(wr_1), 1) as wr_1, count(*) as cnt from $write_table where wr_parent = '{$row['wr_id']}' and wr_is_comment = 1";
						$com = sql_fetch($sql);
						$com_avg = floor($com['wr_1']) + 0.5;

						if($com['wr_1'] > $com_avg){
							$com_avg = $com_avg;
						}else{
							$com_avg = $com_avg - 0.5;
						}
						?>
						<div id="room">
							<a onclick="setPractice('<?php echo $row['wr_id'];?>', '<?php echo $row['href'];?>')">
							<span class="thum"><img src="<?php echo $img_href;?>" style="width:100%;"/></span>
							<div class="info">
								<h2 class="title">
									<div class="star" style="display:inline-block">
									<?php 
									for($k=0; $k<5; $k++){ 
										if($k < $com_avg){
											if($com_avg == $k + 0.5)
												echo "<i class=\"fa fa-star-half-o\"></i>";
											else
												echo "<i class=\"fa fa-star\"></i>";
										}else{
											echo "<i class=\"fa fa-star-o\"></i>";
										}
									} 
									?>
									</div>
									<?php echo $row['wr_subject'];?>
								</h2>
								<div class="add"><?php echo $row['wr_2'];?></div>
								<div class="hours"><span class="st">운영시간</span><?php echo $row['wr_17']; ?></div>
								<div class="tel"><span class="st">전화번호</span><?php echo $row['wr_18']; ?> <a href="tel:<?php echo $row['wr_18']; ?>"><i class="fa fa-phone-square"></i></a></div>
							</div><!--info-->
							</a>
							<div style="position:relative;">
								<div style="position:absolute; top:-5px; right:0; width:25px; height:25px; border:1px solid #EAEAEA; text-align:center; font-size:1.15em; line-height:22px;" onclick="delLike('<?php echo $row['wr_id']; ?>', '<?php echo $bo_table;?>')">
									<i class="fa fa-times" aria-hidden="true"></i>
								</div>
							</div>
						</div><!--room-->
					<?php } ?>
                </div><!--topten_list-->
            </div>
        </div><!--topten-->
    </div>
</div>

<script>

function setPractice(wr_id, wr_url){
	$.post(g5_bbs_url + "/ajax.practice.php", { bo_table:"<?php echo $bo_table;?>", wr_id:wr_id }).done(function(data) {
		location.href = g5_bbs_url + wr_url;
	});
}

function delLike(wr_id, bo_table){
	if(confirm("해당 연습실을 찜목록에서 삭제하시겠습니까?")){
		$.post(g5_bbs_url + "/ajax.like.delete.php", { bo_table:"<?php echo $bo_table;?>", wr_id:wr_id }).done(function(data) {
			location.reload();
		});
	}
}
</script>
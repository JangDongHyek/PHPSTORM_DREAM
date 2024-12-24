<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

?>
<link rel="stylesheet" href="<?php echo $latest_skin_url?>/style.css">
<script src="<?php echo G5_JS_URL ?>/thumb_rollover.js" type="text/javascript"></script>

<style>
	.cut_word { display: inline-block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;height: 1.4em; }
	.deal-card-thumnail img {
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;}
	.deal-card-thumnail:hover img {
	-webkit-transform: scale(1.2) rotate(2deg);
	transform: scale(1.2) rotate(2deg);}
</style>

<!--썸네일추출-->
<div class="m_sec_01_area">
	<div>
		<ul>      
			<?php for ($i=0; $i<count($list); $i++) {  ?>
			<?php
				$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $width, $height);
				if(!$thumb['src']) $thumb['src'] = G5_IMG_URL."/noimage.gif";
				$sql = "select * from g5_write_investor where wr_1 = '{$list[$i]['wr_id']}' and (ca_name = '투자신청' or ca_name = '투자완료' or ca_name = '펀딩완료' or ca_name = '상환완료' or ca_name = '펀딩취소')";
				$result = sql_query($sql);
				$mon = 0;
				for($j=0; $j<$row=sql_fetch_array($result);$j++){
					$mon += str_replace(",","",$row['wr_2']);
				}

				if($mon != 0)
					$division = round($mon/str_replace(",","",$list[$i]['wr_3']) * 100);
				else
					$division = 0;

				if($division>=100) $division = 100;
				
				$enddate = explode("-", $list[$i]['wr_6']);
				$datetime = mktime(0,0,0,$enddate[1],$enddate[2],$enddate[0]);

				if($datetime < mktime(0,0,0,date("m"),date("d"),date("Y")) && $list[$i]['ca_name']=="펀딩진행")
					$endtime = 1;

			?>
			<!--썸네일박스-->       
			<li style="width:100%; display:inline-block;">
				<a href="<?php echo $list[$i]['href'] ?>">      
					<div class="thumbnail_latest">
						<div class="progress-detail">
							<div class="deal-card-img">
                                 <div class="deal-card-thumnail"><img src="<?php echo $thumb['src']; ?>"></div>
							</div>
							<div class="deal-card-detail">
								<div>
									<h3 class="txt-cut-line"><?php echo $list[$i]['subject'] ?></h3>
									<div>모집기간 : <?php echo $list[$i]['wr_11']; ?> ~ <?php echo $list[$i]['wr_13']; ?></div>

									<div class="invest_info">
										<div class="money"> 
											<i class="fa fa-arrow-circle-up"></i><span>목표</span> <?php echo $list[$i]['wr_1']?> 원<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span> 
											<span class="txt-sub"> 수익률</span> 연 <?php echo $list[$i]['wr_3']?>%
										</div>
										<div class="rate">
											<i class="fa fa-user"></i> <span>등급</span> <span class="txt-point"><?php echo $list[$i]['wr_18']?></span>&nbsp;&nbsp;|&nbsp;&nbsp;  
											<span class="day">투자기간 </span> 
											<span class="txt-point"><?php echo $list[$i]['wr_2']; ?> 개월</span><!--&nbsp;&nbsp;|&nbsp;&nbsp; -->
											<!--<span class="level">모집기간<span class="txt-point"><?php echo $list[$i]['wr_13'];?></span>-->
										</div>
									</div>
								</div>
								<?/*
								<!-- 프로그레스바 수정 -->
										<div class="progress">
											<div class="progress-bar progress-bar-info" role="progressbar" style="width:<?php echo $division;?>%"></div>
										</div>
										<div>
											<p>
												<span class="txt-point"><?php echo $division;?> %</span> <span class="">
													<?php 
													if($division>=100 && $list[$i]['ca_name']!="펀딩취소" &&  $list[$i]['wr_24']!="펀딩완료" && $list[$i]['wr_24']!="상환완료")
														echo "펀딩확인중";
													else
														echo $list[$i]['wr_24'];
													?>
												</span> 
												<span class="progress-invest-people">(<?php echo $j?> 명)</span> 
											</p>
											<p class="d-day"><span class="txt-point"></span></p>
										</div>
										<!-- 프로그레스바 수정 -->
								*/?>
							</div>
						</div>
					</div> 
				</a>
					
				<?php if (count($list) == 0) { //게시물이 없을 때  ?>
				<div>투자상품이 없습니다.</div>
				<?php } ?>
			</li>
			<!--//썸네일박스-->   
			<?php }  ?>
		</ul>
	</div>
</div> 
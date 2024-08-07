<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<div id="topten_list" style="padding:10px;">
    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
	<?php
	for ($i=0; $i<count($list); $i++) { 
		$sql = "select * from {$write_table} where wr_id = '{$list[$i]['wr_id']}' and wr_is_comment = 0";
		$row = sql_fetch($sql);
		$row['href'] = G5_ADMIN_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id'];

		$thumb = "";
		if($row['wr_19']){
			$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 150, 150);
		}

		if($thumb['src']) {
			$img_href = $thumb['src'];
		}else if(!$thumb['src'] && $row['wr_19']){
			$img_href = $board_skin_url."/img/noimg_s.jpg";
		} else {
			$img_href = $board_skin_url."/img/none_s.jpg";
		}
		
		$sql = " select round(avg(wr_1), 1) as wr_1, count(*) as cnt from $write_table where wr_parent = '{$list[$i]['wr_id']}' and wr_is_comment = 1 and wr_comment_reply = ''";
		$com = sql_fetch($sql);
		$com_avg = floor($com['wr_1']) + 0.5;

		if($com['wr_1'] > $com_avg){
			$com_avg = $com_avg;
		}else{
			$com_avg = $com_avg - 0.5;
		}
	?>
	<div class="room">
		<a href="<?php echo $row['href'];?>">
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
	</div><!--room-->
	<?php } ?>
</div>
<!-- 페이지 -->
<?php echo $write_pages;  ?>

<fieldset id="bo_sch">
	<legend>게시물 검색</legend>

	<form name="fsearch" method="get">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
	<input type="hidden" name="sca" value="<?php echo $sca ?>">
	<input type="hidden" name="sop" value="and">
	<label for="sfl" class="sound_only">검색대상</label>
	
	<select name="sfl" id="sfl">
		<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>><?php echo $board['bo_subject'];?>명</option>
	</select>
	
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
	<input type="submit" value="검색" class="btn_submit02">
	</form>
</fieldset>
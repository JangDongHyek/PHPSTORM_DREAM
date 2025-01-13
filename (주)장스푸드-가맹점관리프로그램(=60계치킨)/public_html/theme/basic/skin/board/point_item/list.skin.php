<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div id="bo_l">

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

<?php if($member['mb_level'] > 2){ ?>
	<div id="search_box">
		<!-- 게시판 검색 시작 { -->
		<form name="fsearch" method="get">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sop" value="and">
		<input type="hidden" name="sfl" value="wr_subject">

		<table class="list_tbl">
		<tbody>
		<tr>
			<td style="margin:0; padding:0; width:510px;">
				<table class="list_tbl">
				<tbody>
				<tr>
					<th class="list_sch_th">판매상태</th>
					<td class="list_sch_td">
						<input type="radio" name="sch_wr_2" id="sch_wr_2_1" value="" <?php if($sch_wr_2 == '') echo 'checked'; ?>>
						<label for="sch_wr_2_1" style="margin:0px 15px 0px 0px;">전체</label>
						<input type="radio" name="sch_wr_2" id="sch_wr_2_2" value="NS" <?php if($sch_wr_2 == 'NS') echo 'checked'; ?>>
						<label for="sch_wr_2_2" style="margin:0px 15px 0px 0px;">정상판매</label>
						<input type="radio" name="sch_wr_2" id="sch_wr_2_3" value="SS" <?php if($sch_wr_2 == 'SS') echo 'checked'; ?>>
						<label for="sch_wr_2_3" style="margin:0px 15px 0px 0px;">판매중지</label>
						<input type="radio" name="sch_wr_2" id="sch_wr_2_4" value="SO" <?php if($sch_wr_2 == 'SO') echo 'checked'; ?>>
						<label for="sch_wr_2_4" style="margin:0px 15px 0px 0px;">품절</label>
					</td>
				</tr>
				<tr>
					<th class="list_sch_th">상품명</th>
					<td class="list_sch_td">
						<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="search_text x300">
					</td>
				</tr>
				</tbody>
				</table>
			</td>
			<td style="margin:0; padding:0; padding-left:15px;">
				<input type="submit" value="검색" class="btn_submit" style="padding:20px 30px;">
			</td>
		</tr>
		</tbody>
		</table>

		</form>
		<!-- } 게시판 검색 끝 -->
	</div>
<?php }else{ ?>
	<? /* 상품분류  */ ?>
	<div id="cate_box" style="margin-top:30px; margin-left:2px;">
		<ul id="bo_cate_ul">
			<?php
			$c_sql = " select * from g5_point_category order by ca_order desc, ca_idx asc ";
			$c_qry = sql_query($c_sql);
			$c_num = sql_num_rows($c_qry);
			if($c_num > 0){
				for($ca=0; $ca<$c_num; $ca++){
					$c_row = sql_fetch_array($c_qry);
					$cate_select = $cate_select_a = '';
					if($c_row['ca_idx'] == $category){
						$cate_select = 'cate_select';
						$cate_select_a = 'cate_select_a';
					}
			?>
			<li class="bo_cate_li <?php echo $cate_select ?>">
				<a class="bo_cate_li_a <?php echo $cate_select_a ?>" href="<?php echo G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&category='.$c_row['ca_idx'] ?>"><?php echo $c_row['ca_name'] ?></a>
			</li>
			<?php
				}
			}
			?>
		</ul>
		<div style="clear:both; margin:0; padding:0; width:0px; height:0px;"></div>
	</div>
<?php } ?>

    
	
	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
	
	
	<?php if($member['mb_level'] > 2){ ?>
	<!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div style="float:left; padding-top:5px;">
			<label style="margin:0;">선택된 상품을 </label>
			<select name="change_list" class="change_list">
				<option value="">선택하세요</option>
				<option value="NS">정상판매</option>
				<option value="SS">판매중지</option>
				<option value="SO">상품품절</option>
				<option value="change">상품분류 변경</option>
				<option value="delete">상품삭제</option>
			</select>
			<select name="change_category" class="change_category">
				<?php echo item_point_cate_option($change_category) ?>
			</select>
			<input name="btn_submit" class="btn_action" onclick="document.pressed=this.value" type="submit" value="처리">
		</div>
		
		<?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
		
		<div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
	<?php }else{ ?>
	<div class="list_line"></div>
	<?php } ?>

    
	<?php if($member['mb_level'] > 2){ ?>
	<table class="list_tbl" style="table-layout:fixed;">
	<thead>
	<tr>
		<th class="x60"></th>
		<?php if ($is_checkbox) { ?>
		<th class="x40"></th>
		<?php } ?>
		<th class="x120"></th>
		<th class="x100"></th>
		<th class="x140"></th>
		<th class=""></th>
		<th class="x140"></th>
	</tr>
	<tr>
		<th class="list_tbl_th">순서</th>
		<?php if ($is_checkbox) { ?>
		<th class="list_tbl_th">
			<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
            <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
		</th>
		<?php } ?>
		<th class="list_tbl_th">분류</th>
		<th class="list_tbl_th">판매상태</th>
		<th class="list_tbl_th" colspan="2">상품명</th>
		<th class="list_tbl_th">판매가격</th>
	</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $i<count($list); $i++) {
		if($i%2 == 0) $tr_bg = 'tr_bg';
		else $tr_bg = '';
	?>
	<tr>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
            ?>
		</td>
		<?php if ($is_checkbox) { ?>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		</td>
		<?php } ?>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<?php
			$ca_sql = " select * from g5_point_category where ca_idx='{$list[$i]['wr_10']}' ";
			$ca_row = sql_fetch($ca_sql);
			echo $ca_row['ca_name'];
			?>
		</td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<?php
			if($list[$i]['wr_2'] == 'NS'){
				echo '<span style="color:#3399cc;">판매중</span>';
			}else if($list[$i]['wr_2'] == 'SS'){
				echo '<span style="color:#fa003b;">판매중지</span>';
			}else if($list[$i]['wr_2'] == 'SO'){
				echo '<span style="color:#333;">품절</span>';
			}
			?>
		</td>
		<td width="100" class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<a href="<?php echo G5_BBS_URL ?>/write.php?w=u&bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $list[$i]['wr_id'] ?>&page=<?php echo $page ?>">
			<?php
			$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="90%">';
			} else {
				$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
			}

			echo $img_content;
			?>
			</a>
		</td>
		<td class="list_tbl_td <?php echo $tr_bg ?>">
			<div style="padding-left:15px; padding-right:15px;">
				<a href="<?php echo G5_BBS_URL ?>/write.php?w=u&bo_table=<?php echo $bo_table ?>&wr_id=<?php echo $list[$i]['wr_id'] ?>&page=<?php echo $page ?>">
					<?php echo $list[$i]['subject'] ?>
				</a>
			</div>
		</td>
		<td class="list_tbl_td talign_c <?php echo $tr_bg ?>" rowspan="2">
			<?php echo number_format($list[$i]['wr_1']).'원' ?>
		</td>
	</tr>
	<tr>
		<td class="list_tbl_td <?php echo $tr_bg ?>">
			<div style="padding:10px 15px;">
			<?php
			if($list[$i]['wr_5'] == 'n'){
				echo '옵션없음';
			}else{
				if($list[$i]['opt_use1'] == 'y' && $list[$i]['wr_opt1'] != ''){
					echo '<div style="margin:4px 0px;">';
					echo $list[$i]['wr_opt1'].'&nbsp;:&nbsp;';
					$opt1_sql = " select * from g5_opt1 where opt_bo_table='{$bo_table}' and opt_wr_id='{$list[$i]['wr_id']}' order by opt_idx asc ";
					$opt1_qry = sql_query($opt1_sql);
					$opt1_num = sql_num_rows($opt1_qry);
					for($o1=0; $o1<$opt1_num; $o1++){
						$opt1_row = sql_fetch_array($opt1_qry);
						echo '<span class="opt_names">'.$opt1_row['opt_name'].'</span>&nbsp;';
					}
					echo '</div>';
				}

				if($list[$i]['opt_use2'] == 'y' && $list[$i]['wr_opt2'] != ''){
					echo '<div style="margin:4px 0px;">';
					echo $list[$i]['wr_opt2'].'&nbsp;:&nbsp;';
					$opt2_sql = " select * from g5_opt2 where opt_bo_table='{$bo_table}' and opt_wr_id='{$list[$i]['wr_id']}' order by opt_idx asc ";
					$opt2_qry = sql_query($opt2_sql);
					$opt2_num = sql_num_rows($opt2_qry);
					for($o2=0; $o2<$opt2_num; $o2++){
						$opt2_row = sql_fetch_array($opt2_qry);
						echo '<span class="opt_names">'.$opt2_row['opt_name'].'</span>&nbsp;';
					}
					echo '</div>';
				}

				if($list[$i]['opt_use3'] == 'y' && $list[$i]['wr_opt3'] != ''){
					echo '<div style="margin:4px 0px;">';
					echo $list[$i]['wr_opt3'].'&nbsp;:&nbsp;';
					$opt3_sql = " select * from g5_opt3 where opt_bo_table='{$bo_table}' and opt_wr_id='{$list[$i]['wr_id']}' order by opt_idx asc ";
					$opt3_qry = sql_query($opt3_sql);
					$opt3_num = sql_num_rows($opt3_qry);
					for($o3=0; $o3<$opt3_num; $o3++){
						$opt3_row = sql_fetch_array($opt3_qry);
						echo '<span class="opt_names">'.$opt3_row['opt_name'].'</span>&nbsp;';
					}
					echo '</div>';
				}
			}
			?>
			</div>
		</td>
	</tr>
	<?php
	}

	if (count($list) == 0) {
	?>
	<tr>
		<td colspan="7" class="list_tbl_td talign_c">등록된 상품이 없습니다.</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	<?php }else{ ?>
	<div>
		<ul id="bo_cate_ul">
			<?php
			for ($i=0; $i<count($list); $i++) {
				if($i>0 && $i%4==0) echo '<div style="clear:both; margin:0; padding:10px 0;"></div>';
			?>
			<li class="bo_item_li">
				<div class="item_box">
					<div class="item_img">
						<a href="<?php echo $list[$i]['href'] ?>&category=<?php echo $category ?>">
						<?php
						$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
						} else {
							$img_content = '<span style="display:inline-block; width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
						}

						echo $img_content;
						?>
						</a>
					</div>
					<div class="item_title"><a href="<?php echo $list[$i]['href'] ?>&category=<?php echo $category ?>"><?php echo $list[$i]['wr_subject'] ?></a></div>
					<div class="item_price"><?php echo number_format($list[$i]['wr_1']).'원' ?></div>
					<div class="item_icon">
						<?php if($list[$i]['wr_4'] == 'y'){ ?><span class="icon1">★추천</span><?php }else{echo '&nbsp;';} ?>
					</div>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
	<div style="clear:both; margin:0; padding:0; width:0px; height:0px;"></div>
	<?php } ?>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <?/*
		<ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <!--
			<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
			-->
        </ul>
		*/?>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
		<!--
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
		-->
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>

</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>


<script>
$(function(){
	$(".change_list").on('change', function(){
		if($(this).val() == 'change'){
			$(".change_category").css('display','inline');
		}else{
			$(".change_category").css('display','none');
		}
	});
});
</script>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 상품을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

	if($(".change_list").val() == ''){
		alert('선택된 상품을 어떻게 변경할지 선택해주세요');
		$(".change_list").focus();
		return false;
	}

	if($(".change_list").val() == 'delete'){
		if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
	}

	if($(".change_list").val() == 'change'){
		if (!confirm("선택한 상품의 상품분류를 정말 변경하시겠습니까?"))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
	}

	if($(".change_list").val() == 'NS' || $(".change_list").val() == 'SS' || $(".change_list").val() == 'SO'){
		if (!confirm("선택한 상품의 판매상태를 정말 변경하시겠습니까?"))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
	}

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 상품을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->

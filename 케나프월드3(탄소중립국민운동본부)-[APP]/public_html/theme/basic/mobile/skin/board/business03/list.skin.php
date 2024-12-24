<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 게시판 목록 시작 -->
<div id="bo_list">

    <?php if ($is_category) { ?>
	<select name="sca" id="sca" onchange="location.href='<?php echo $is_adm?G5_ADMIN_URL."/bbs":G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&sca='+this.value;" style="margin-bottom:10px;">
		<option value="">전체</option>
		<?php for($i=0; $i<count($categories); $i++){ ?>
		<option value="<?php echo $categories[$i];?>" <?php if($sca == $categories[$i]) echo "selected";?>><?php echo $categories[$i];?></option>
		<?php } ?>
	</select>
	<?php } ?>

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
	
	<div class="list-box">
		<?php 
		for ($i=0; $i<count($list); $i++) { 
		$temp = explode(" ", $list[$i]['wr_datetime']);
		$temp_date = explode("-", $temp[0]);
		$temp_time = explode(":", $temp[1]);

		$mk_now = mktime();
		$mk_date = mktime($temp_time[0], $temp_time[1], $temp_time[2], $temp_date[1], $temp_date[2], $temp_date[0]);

		$now_date = $mk_now - $mk_date;
		if($now_date >= 86400)
			$date_str = floor($now_date / 86400)."일 전";
		else if($now_date < 86400 && $now_date >= 3600)
			$date_str = floor($now_date / 3600)."시간 전";
		else if($now_date < 3600 && $now_date >= 60)
			$date_str = floor($now_date / 60)."분 전";
		if($now_date < 60)
			$date_str = $now_date."초 전";
		
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

		if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" style="width:100%; max-width:250px; height:auto; " class="img">';
		} else {
			$img_content = '';
		}

		?>
		
		<?php if ($is_adm) { ?>
		<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
		<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		<?php } ?>
		<dl>
			<a href="<?php echo $list[$i]['href'] ?>">
				<dd class="row">
					<?php $col_xs = 9;?>
					<?php if($list[$i]['ca_name']){ ?>
					<p class="col-xs-3" style="padding:16px 10px; font-size:1.15em; letter-spacing:-0.1em; font-weight:bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
						<?php echo $list[$i]['ca_name']; ?>
					</p>
					<?php $col_xs-= 3;?>
					<?php } ?>
					<?php if($img_content){ ?>
					<p class="col-xs-2 img-box" style="padding-top:5px;">
                        <?php echo $img_content; ?>
					</p>
					<?php $col_xs-= 2;?>
					<?php } ?>
					<p class="col-xs-<?php echo $col_xs;?>" style="padding:10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
						<span class="row-block" style="font-size:1.15em; font-weight:bold; color:#3b5998">
							<?php if($is_adm && $list[$i]['wr_main']){ ?>
							<span class="btn btn-danger btn-xs">메인</span>
							<?php } ?>
							<?php echo $list[$i]['wr_subject']; ?>
						</span>
						<span class="row-block">
							<i class="fa fa-eye" aria-hidden="true"></i> <?php echo number_format($list[$i]['wr_hit']); ?> &nbsp;
							<i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo number_format($list[$i]['wr_good']); ?> &nbsp;
							<i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo number_format($list[$i]['comment_cnt']); ?>
						</span>
					<p>
					<p class="col-xs-3" style="padding:10px 15px 10px 0;text-align:right; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
						<?php echo $list[$i]['wr_name']; ?><br/>
						<span class="time-txt"><?php echo $list[$i]['datetime'];?></span>
					<p>
				</dd>
			</a>
		</dl>
		<?php } ?>
	</div>
	<?php if (count($list) == 0) { echo '등록된 글이 없습니다.'; } ?>

    <?php if ($is_adm) { ?>
	<div>
		<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" style="display:none;">
		<label for="chkall" class="btn btn-default btn-sm">전체선택</label>
		<input type="submit" name="btn_submit" class="btn btn-default btn-sm" value="선택삭제" onclick="document.pressed=this.value">
		<a href="<?php echo $write_href;?>&ca_name=<?php echo urlencode($sca);?>" class="btn btn-primary btn-sm" style="float:right;">글 작성</a>
	</div>
    <?php } ?>
	
	<?php if ($write_href && !$is_adm) { ?>
	<a href="<?php echo $write_href;?>" class="btn-write"><i class="fa fa-pencil" aria-hidden="true"></i></div>
	<?php } ?>
    </form>
	<?php echo $write_pages;?>
</div>
<script>
function getView(wr_id){
	$.pjax({ url: "<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>&wr_id="+wr_id, container:"#pjax_contanier", visibled:"visibled", session:"<?php echo G5_BBS_URL;?>/pjax.visibled.php", speed:"100", timeout:15000});
}

function getWrite(){
    $.pjax({ url: "<?php echo $write_href;?>", container:"#pjax_contanier", visibled:"visibled", session:"<?php echo G5_BBS_URL;?>/pjax.visibled.php", speed:"100", timeout:5000});
}
</script>
<?php if($is_adm) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_adm) { ?>
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
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
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

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
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
<!-- 게시판 목록 끝 -->

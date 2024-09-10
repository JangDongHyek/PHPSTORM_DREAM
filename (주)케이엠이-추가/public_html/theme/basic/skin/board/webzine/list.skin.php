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

<!--<h2 id="container_title"><span class="sound_only"> 목록</span></h2> -->

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
        <nav id="bo_cate">
            <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
            <ul id="bo_cate_ul">
                <?php echo $category_option ?>
            </ul>
        </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 검색 시작 { -->
    <div class="d-lg-flex">
        <fieldset id="bo_sch" class="ms-auto">
            <legend>게시물 검색</legend>
            <form name="fsearch" method="get" class="input-group">
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sop" value="and">
                <input type="hidden" name="sfl" value="wr_subject||wr_content||mb_id,1"> <!-- This line has been changed -->

                <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="form-control py-3 search-box-width" size="15" maxlength="20" placeholder="Please enter a word.">
                <button type="submit" value="검색" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
            </form>
        </fieldset>
    </div>
    <!-- } 게시판 검색 끝 -->


    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?> / </span>
            <?php echo $page ?> Page
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">Admin</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

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

	<div class="tbl_head01 tbl_wrap">
	<?php if ($is_checkbox) { ?>
	<div class="chk">
		<p>
			<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" /> <label for="chkall">Select All</label>
		</p>
	</div>
	<?php } ?>
	<ul>
	<?php
	for($i=0; $i<count($list); $i++){
		//썸네일 이미지 가져오기
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
		
		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_content']),150);
	?>
	<li onclick="location.href='<?php echo $list[$i]['href'] ?>'" onmouseover="window.status='<?php echo $list[$i]['href'] ?>'" onmouseout="window.status=''">
		<?php if ($is_checkbox) { ?>
		<p class="td_chk">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
			<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
		</p>
		<?php } ?>
		<div class="card mb-4 w-100 product-list-border me-4" style="border-radius: 0;">
			<?php if($thumb['src']){ ?>
			<div class="img_area">
			<img src="<?php echo $thumb['ori']?>" alt="<?php echo $thumb['alt']?>" width="<?php echo $board['bo_gallery_width']?>" height="<?php echo $board['bo_gallery_height']?>" /></div>
			<?php } else {?>
			<div class="img_area">
			<img src="<?php echo G5_THEME_IMG_URL ?>/noimg.jpg" alt="noimage"/></div>
			<?php }?>
			<div class="txt_area">
                <div class="p-3">
                    <div class="text-break-1 mb-2"><?php echo $list[$i]['wr_subject']?></div>
                    <div class="text-secondary fs-7">
                        <div class="text-break-1"><?php echo $str_content?></div>
                        <div class="d-flex justify-content-between pt-4">
                            <div class="d-flex">
                                <i class="bi bi-pen me-2"></i>
                                <div><?php echo $list[$i]['name'] ?></div>
                            </div>
                            <div class="mx-1 text-secondary">|</div>
                            <div class="d-flex">
                                <i class="bi bi-calendar-check me-2"></i>
                                <div><?php echo date('Y.m.d', strtotime($list[$i]['wr_datetime'])); ?></div>
                            </div>
                            <div class="mx-1 text-secondary">|</div>
                            <div class="d-flex">
                                <i class="bi bi-eye me-2"></i>
                                <div><?php echo number_format($list[$i]['wr_hit']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</li>
	<?php
	}
	?>
    <?php if (count($list) == 0) { echo '<div class="empty_table">There are no posts.</div>'; } ?>
	</ul>
	</div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <!--<ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul> -->
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">List</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Write</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div>



<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>


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

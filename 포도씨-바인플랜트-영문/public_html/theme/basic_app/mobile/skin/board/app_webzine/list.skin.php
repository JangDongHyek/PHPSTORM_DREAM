<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 100);
?>

<!--<h2 id="container_title"><span class="sound_only"> 목록</span></h2> -->

<!-- 게시판 목록 시작 { -->
<div id="bo_app">
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
	<ul>
	<?php
	for($i=0; $i<count($list); $i++){
		//썸네일 이미지 가져오기
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
		
		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_content']),150);
	?>
	<li onclick="location.href='<?php echo $list[$i]['href'] ?>'" onmouseover="window.status='<?php echo $list[$i]['href'] ?>'" onmouseout="window.status=''">
		<?php if($thumb['src']){ ?>
        <div class="img_area">
        <img src="<?php echo $thumb['src']?>" alt="<?php echo $thumb['alt']?>" width="<?php echo $board['bo_gallery_width']?>" height="<?php echo $board['bo_gallery_height']?>" />
        </div>
        <?php }?>
        <div class="txt_area <?php if(!$thumb['src']){ echo "w100"; } ?>">
        <ul>
            <li class="zine_tit">
			<?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>' ?><?php echo $list[$i]['wr_subject']?></li>
            <li class="zine_info">
                <?php if ($is_category && $list[$i]['ca_name']) { ?>
                <span class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></span>
                <?php } ?>
                <span><? echo $list[$i]['wr_name']; ?></span>
                <span><?php echo $list[$i]['datetime3'] ?></span>
                <span>조회 <strong><?php echo $list[$i]['wr_hit'] ?></strong></span>
            </li>
        </div>
        <div class="comm"><?php echo $list[$i]['wr_comment'] ?></div>
	</li>
	<?php
	}
	?>
    <?php if (count($list) == 0) { echo '<div class="empty_table">게시물이 없습니다.</div>'; } ?>
	</ul>
	</div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
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
</div>
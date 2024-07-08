<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="box_info">
<!-- 게시판 목록 시작 { -->

<? if (!defined('G5_IS_ADMIN')) {  // 사용자페이지면 ?>
<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" placeholder="검색어를 입력해주세요" style="border:0px !important; background:#fff !important;outline-style: none;">
    <button type="submit" id="sch_submit" style="border:0; background:none"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sch_btn.png" alt="검색" style="height:20px"><span class="sound_only">검색</span></button>
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
<? } ?>

<div id="bo_list" style="width:<?php echo $width; ?>">
	<? /*
    <!-- 게시판 카테고리 시작 { -->
    <?if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <? } ?>
    <!-- } 게시판 카테고리 끝 -->
	*/ ?>

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
		<? if (defined('G5_IS_ADMIN')) {  // 관리자페이지면 ?>
        <div id="bo_list_total" style="display:block;">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user hidden-sm hidden-xs">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
		<? } ?>
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
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
		<? if (defined('G5_IS_ADMIN')) {  // 관리자페이지면 ?>
		<colgroup>
			<col width="5%">
			<col width="3%">
			<col width="">
			<col width="15%">
			<col width="15%">
			<col width="8%">
		</colgroup>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">등록일자</th>
            <th scope="col">조회</th>
        </tr>
        </thead>
		<? } ?>

        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
			if (defined('G5_IS_ADMIN')) {  // 관리자페이지면
		?>
		<tr style="text-align:center;">
			<td><?php echo $list[$i]['num']; ?></td>
			<?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
			<td style="text-align:left;">
				<a href="<?php echo $list[$i]['href'] ?>">
					<!--<strong>[<?php echo $list[$i]['ca_name'] ?>]</strong>-->
					<?php echo $list[$i]['subject'] ?> <? if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?>
				</a>
			</td>
			<td><?php echo $list[$i]['wr_name'] ?></td>
			<td><?php echo $list[$i]['wr_datetime'] ?></td>
			<td><?php echo $list[$i]['wr_hit'] ?></td>
		</tr>

		<? 
			} else {						// 사용자페이지면
		?>
        <tr onclick="location.href='<?php echo $list[$i]['href'] ?>'">
            <td class="td_num hidden-sm hidden-xs"><?php echo $list[$i]['num']; ?></td>
            <td class="td_subject">
                <a href="<?php echo $list[$i]['href'] ?>" style="width:70%">
					<!-- 공지, 이벤트 -->
					<? // $ca_class = ($list[$i]['ca_name'] == "공지")? "gong" : "event"; ?>
                    <? /* <span class="<?=$ca_class?>"><?=$list[$i]['ca_name']?></span> */ ?>
                    <span class="gong">공지</span>
					<?php echo $list[$i]['subject'] ?>
                    <!--<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>-->
                </a>
                <div class="m_info hidden-lg hidden-md"><span><?php echo $list[$i]['wr_name'] ?></span>&nbsp;&nbsp;<?php echo $list[$i]['datetime2'] ?></div>
            </td>
            <td class="td_name sv_use hidden-sm hidden-xs"><?php echo $list[$i]['wr_name'] ?></td>
            <td class="td_date hidden-sm hidden-xs"><?php echo $list[$i]['datetime2'] ?></td>
            <td class="td_num hidden-sm hidden-xs"><?php echo $list[$i]['wr_hit'] ?></td>
        </tr>
		<? 
			} // end if
		} // end for
		?>

        <?php if (count($list) == 0) { echo '<tr><td colspan="8" class="empty_table">등록된 게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

	<? if (defined('G5_IS_ADMIN')) {  // 관리자페이지면 ?>
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">

        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <? /* <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li> */ ?>
        </ul>
        <?php } ?>
		
		<? /*
        <? php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
		*/ ?>
    </div>
    <?php } ?>
	<? } ?>


    </form>
</div>
</div><!--//.box_info-->


<!-- 페이지 -->
<?php 
if (defined('G5_IS_ADMIN')) {
	$paging_params = get_paging_params($qstr);
	echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?bo_table='.$bo_table.'&'.$paging_params);
} else {
	echo $write_pages;  
}
?>

<? if (defined('G5_IS_ADMIN')) {  // 관리자페이지면 ?>
<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    
    <span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <!--<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>-->
    </select>
    </span>
    
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="frm_input sch_input" maxlength="20">
    <input type="submit" value="검색" class="btn_submit02">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
<? } ?>


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
	/*
    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }
	*/

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

/*
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
*/
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
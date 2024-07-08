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
    <label for="sfl" class="sound_only">검색대상</label>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" placeholder="검색어를 입력해주세요" style="border:0px !important; background:#fff0 !important">
    <button type="submit" id="sch_submit" style="border:0; background:none"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sch_btn.png" alt="검색" style="height:20px"><span class="sound_only">검색</span></button>
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->
<? } ?>

<style>
strong.gong {color: #755cb7;}
</style>

<div id="bo_list" style="width:<?php echo $width; ?>">
	<? /*
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
	*/ ?>

        <p class="b_write"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_counsel">상담 남기기</a></p>
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
			<col width="10%">
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
            <th scope="col">답변여부</th>
        </tr>
        </thead>
		<? } ?>

        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
			$view_event = "alert('본인글만 열람이 가능합니다.');";

			// 내글 or 관리자면 열람가능
			if ($is_admin || $list[$i]['mb_id'] == $member['mb_id']) {
				$view_event = "location.href='".$list[$i]['href']."'";
			}

			// 운영자 답변여부
			$sql = "SELECT COUNT(wr_id) AS cnt FROM g5_write_{$bo_table} WHERE wr_parent = '{$list[$i]['wr_id']}' AND wr_is_comment = 1 AND mb_id != '{$list[$i]['mb_id']}'";
			$row = sql_fetch($sql);
			$comment_cnt = $row['cnt'];

			if ($comment_cnt > 0) {
				$ca_name = "답변완료";
				$ca_class = "gong";
			} else {
				$ca_name = "답변대기";
				$ca_class = "wait";
			}

			if (defined('G5_IS_ADMIN')) {	// 관리자페이지면
        ?>
		<tr style="text-align:center">
			<td><? echo $list[$i]['num']; ?></td>
			<?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
			<td style="text-align:left;">
				<a href="<?php echo $list[$i]['href'] ?>"><?php echo $list[$i]['subject'] ?> <? if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></a>
			</td>
			<td><a href="../member_form.php?w=u&mb_id=<?=$list[$i]['mb_id']?>"><?php echo $list[$i]['wr_name'] ?></a></td>
			<td><?php echo $list[$i]['wr_datetime'] ?></td>
			<td><?php echo $list[$i]['wr_hit'] ?></td>
			<td><span class="<? echo ($ca_class == "gong")? "btn03" : "btn02"; ?>"><?=$ca_name?></span></td>
		</tr>

		<? } else {							// 사용자페이지면
			
			// 본인글 체크
			$list_subj = "비밀글입니다.";
			$list_writer = iconv_substr($list[$i]['wr_name'], 0, 1, "utf-8")."**";

			if ($member['mb_id'] == $list[$i]['mb_id']) {
				$list_subj = $list[$i]['subject'];
				$list_writer = $list[$i]['wr_name'];
			}
		?>
        <tr onclick="<?=$view_event?>">
            <td class="td_num hidden-sm hidden-xs"><? echo $list[$i]['num']; ?></td>
            <td class="td_subject">
                <a href="javascript:void(0)" style="width:70%">
					<!-- 클래스 gong, wait (답변완료, 대기) -->
                    <span class="<?=$ca_class?>"><?=$ca_name?></span>
					<img src="<? echo $board_skin_url."/img/icon_secret.gif"; ?>" alt="잠금">
					<?=$list_subj?>
                </a>
                <div class="m_info hidden-lg hidden-md"><span><?=$list_writer?></span>&nbsp;&nbsp;<?php echo $list[$i]['datetime2'] ?></div>
            </td>
            <td class="td_name sv_use hidden-sm hidden-xs"><?php echo $list[$i]['name'] ?></td>
            <td class="td_date hidden-sm hidden-xs"><?php echo $list[$i]['datetime2'] ?></td>
            <td class="td_num hidden-sm hidden-xs"><?php echo $list[$i]['wr_hit'] ?></td>
        </tr>
        <? 
			}	//end if
		}	// end for
		?>

        <?php if (count($list) == 0) { echo '<tr><td colspan="8" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

	<? /*
    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
		<!--
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>
		-->
        <? php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
	<? */ ?>

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

<script>
$(function() {
	$("input[name='chk_wr_id[]']").on("click", function(e) {
		e.preventDefault();
		
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
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
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
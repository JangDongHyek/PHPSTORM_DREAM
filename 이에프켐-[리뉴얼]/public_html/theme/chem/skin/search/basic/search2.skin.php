<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style2.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$search_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<?php if ($total_count == 0) { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?php echo number_format($total_count) ?>개</p>
    <div class="empty_list">
           <p><i class="fal fa-search fa-3x"></i></p>
           <p class="t_padding17">검색된 자료가 없습니다.<br />다른 키워드를 사용해 보세요.</p>
    </div>
<?php }else { ?>
<p class="search_tit"><span>'<?php echo $stx ?>'</span> 에 대한 검색결과 <?php echo number_format($total_count) ?>개</p>
<section id="cate_depth">
    <!--<div class="cateTit"><h2>카테고리</h2></div>-->
    <div class="cateList">
        <div class="sort">

                    <?php echo $title_name ?>

<!--                <li class="check">신규등록 순</li>-->
<!--                <li>인기 순</li>-->
<!--                <li>추천 순</li>-->
<!--                <li>평점 순</li>-->
<!--                <li>응답 순</li>-->

        </div>
        <div class="depthList">
            <ul>
               <?= $ctg_html ?>
            </ul>
        </div>
    </div>
</section>
<?php  }  ?>

<!-- 전체검색 시작 { -->
<? /* <form name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
<input type="hidden" name="srows" value="<?php echo $srows ?>">
<fieldset id="sch_res_detail">
    <legend>상세검색</legend>
    <?php echo $group_select ?>
    <script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>

    <label for="sfl" class="sound_only">검색조건</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject||wr_content"<?php echo get_selected($_GET['sfl'], "wr_subject||wr_content") ?>>제목+내용</option>
        <option value="wr_subject"<?php echo get_selected($_GET['sfl'], "wr_subject") ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($_GET['sfl'], "wr_content") ?>>내용</option>
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id") ?>>회원아이디</option>
        <option value="wr_name"<?php echo get_selected($_GET['sfl'], "wr_name") ?>>이름</option>
    </select>

    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required class="frm_input required" maxlength="20">
    <input type="submit" class="btn_submit" value="검색">

    <script>
    function fsearch_submit(f)
    {
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }

        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        f.action = "";
        return true;
    }
    </script>
    <input type="radio" value="or" <?php echo ($sop == "or") ? "checked" : ""; ?> id="sop_or" name="sop">
    <label for="sop_or">OR</label>
    <input type="radio" value="and" <?php echo ($sop == "and") ? "checked" : ""; ?> id="sop_and" name="sop">
    <label for="sop_and">AND</label>
</fieldset>
</form> */ ?>


<!--<div id="sch_result">-->
<div id="bo_gall">

    <?php
    if ($stx) {
        if ($board_count) {
    ?>
    <section id="sch_res_ov">
        <h2><?php echo $stx ?> 전체검색 결과</h2>
        <dl>
            <dt>게시판</dt>
            <dd><strong class="sch_word"><?php echo $board_count ?>개</strong></dd>
            <dt>게시물</dt>
            <dd><strong class="sch_word"><?php echo number_format($total_count) ?>개</strong></dd>
        </dl>
        <p><?php echo number_format($page) ?>/<?php echo number_format($total_page) ?> 페이지 열람 중</p>
    </section>
    <?php
        }
    }
    ?>

    <?php
    if ($stx) {
        if ($board_count) {
     ?>
    <ul id="sch_res_board">
        <li><a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" <?php echo $sch_all ?>>전체게시판</a></li>
        <?php echo $str_board_list; ?>
    </ul>
    <?php
        } else {
     ?>
    <!--<div class="empty_list">검색된 자료가 하나도 없습니다.</div>-->
    <?php } }  ?>

    <hr>

    <?php if ($stx && $board_count) { ?><section class="sch_res_list"><?php }  ?>
    <?php
    $k=0;
    for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
     ?>
        <ul id="gall_ul">
		<?php
			
			for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {
				
		 ?>
			<li class="gall_li <?php if ($wr_id == $list[$idx][$i]['wr_id']) { ?>gall_now<?php } ?>" style="<?php echo $style ?>width:<?php echo $board['bo_gallery_width'] ?>px">
				<ul class="gall_con">
					<li class="gall_href">
						<a href="<?php echo $list[$idx][$i]['href'] ?>"><div class="over"></div>
						<?php
						if ($list[$idx][$i]['is_notice']) { // 공지사항  ?>
							<strong style="width:<?php echo $list[$idx][$i]['bo_gallery_width'] ?>px;line-height:<?php echo $list[$idx][$i]['bo_gallery_height'] ?>px">공지</strong>
						<?php } else {
							
							$thumb = get_list_thumbnail($search_table[$idx], $list[$idx][$i]['wr_id'], $list[$idx][$i]['bo_gallery_width'], $list[$idx][$i]['bo_gallery_height']);

							if($thumb['src']) {
								$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$list[$idx][$i]['bo_gallery_width'].'" height="'.$list[$idx][$i]['bo_gallery_height'].'" class="img">';
							} else {
								$img_content = '<span style="width:'.$list[$idx][$i]['bo_gallery_width'].'px;line-height:'.$list[$idx][$i]['bo_gallery_height'].'px" class="noimg">no image</span>';
							}

							echo $img_content;
						}
						 ?>
					</li>
                    <li class="gall_text_href">
                    <?php
                    // echo $list[$idx][$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
                    if ($is_category && $list[$idx][$i]['ca_name']) {
                     ?>
                    <a href="<?php echo $list[$idx][$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$idx][$i]['ca_name'] ?></a>
                    <?php } ?>
                    <a href="<?php echo $list[$idx][$i]['href'] ?>" class="title">
                        <p class="t9"><?php echo $list[$idx][$i]['wr_1'] ?><!-- 제목 --></p>
                        <p class="t16"><?php echo $list[$idx][$i]['wr_2'] ?><!-- 제품코드 --></p>                        
						<p class="t10 t_margin12"><?php echo $list[$idx][$i]['subject'] ?>
                        <?php /*?><?php if ($list[$idx][$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$idx][$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?><?php */?>
                    </p></a>
                    <?php
                    // if ($list[$idx][$i]['link']['count']) { echo '['.$list[$idx][$i]['link']['count']}.']'; }
                    // if ($list[$idx][$i]['file']['count']) { echo '<'.$list[$idx][$i]['file']['count'].'>'; }

                    //if (isset($list[$idx][$i]['icon_new'])) echo $list[$idx][$i]['icon_new'];
                    //if (isset($list[$idx][$i]['icon_hot'])) echo $list[$idx][$i]['icon_hot'];
                    //if (isset($list[$idx][$i]['icon_file'])) echo $list[$idx][$i]['icon_file'];
                    //if (isset($list[$idx][$i]['icon_link'])) echo $list[$idx][$i]['icon_link'];
                    //if (isset($list[$idx][$i]['icon_secret'])) echo $list[$idx][$i]['icon_secret'];
                     ?>
                   </li>
				</ul>
			</li>	
		<?php }?>

		</ul>
		
		
		
        <div class="sch_more"><a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><strong><?php echo $bo_subject[$idx] ?></strong> 결과 더보기</a></div>

        <hr>
    <?php }  ?>
    <?php if ($stx && $board_count) {  ?></section><?php }  ?>

    <?php echo $write_pages ?>

</div>
<!-- } 전체검색 끝 -->
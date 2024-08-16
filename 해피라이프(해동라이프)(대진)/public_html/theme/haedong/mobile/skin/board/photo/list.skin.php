<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 관리자페이지 아니면 관리자페이지로 이동
if (!defined('G5_IS_ADMIN')) {
	goto_url(G5_ADMIN_URL."/bbs/board.php?bo_table=".$bo_table);
}

$imgmaxwidth = 400; 
$imgmaxheight = 550; 

$imgminwidth = 270; 
$imgminheight = 360; 

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/jquery.fancybox.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/jquery.fancybox.js"></script>', 100);
?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			wrapCSS    : 'fancybox-custom',
			openEffect : 'none',
			helpers : {
						title : {
							type : 'inside'
						},
						overlay : {
							css : {
								'background' : 'rgba(0,0,0,0.5)'
							}
						}
					}
			});
		});
</script>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2> -->

<div class="local_ov01 local_ov">
    <a href="<?=G5_ADMIN_URL?>/bbs/board.php?bo_table=photo" class="ov_listall">전체목록</a>
    <span class="btn_ov01"><span class="ov_txt">총 게시글 </span><span class="ov_num"><?=number_format($total_count)?>건</span></span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" autocomplete="off">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>지점명</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="frm_input" size="15" maxlength="15">
    <input type="submit" value="검색" class="btn_submit">
</form>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">
	
	<? /*
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
	*/ ?>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk" style="background: #6f809a; color: #fff; border: 1px solid #60718b; padding: 5px;">
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
        <label for="chkall">전체선택</label>
    </div>
    <?php } ?>

    <ul id="gall_ul">
        <?php /*?><?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
         ?><?php */?>
         <?php for ($i=0; $i<count($list); $i++) {
         ?>
        <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
            <?php if ($is_checkbox) { ?>
            <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['wr_subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" style="margin-bottom: 5px;">
            <?php } ?>
           
            <ul class="gall_con">
                <li class="gall_href">
                    <a href="<?php echo $list[$i]['href'] ?>">
                    <?php
					    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $imgmaxwidth, $imgmaxheight, 0, 1);

                        if($thumb['src']) {
                            $img_content = '<a class="fancybox" href="'.$list[$i]['href'].'" title="'.$list[$i]['wr_subject'].'"width="'.$imgmaxwidth.'" height="'.$imgmaxheight.'">
											<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'" class="img">';
                        } else {
                            $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;line-height:'.$board['bo_gallery_height'].'px" class="noimg">no image</span>';
                        }
                        echo $img_content;
                     ?>
                    </a>
                </li>
                <li class="gall_text_href">
                    <?php
                    // echo $list[$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
                    if ($is_category && $list[$i]['ca_name']) {
                     ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <a href="<?php echo $list[$i]['href'] ?>">
                        <?php echo $list[$i]['wr_subject'] ?>
                        <?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
                    </a>
                    <?php
                    // if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
                    // if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

                    if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                    if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
                    //if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
                    //if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
                    //if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
                     ?>
                </li>
                <!--<li><span class="gall_subject">작성자 </span><?php echo $list[$i]['name'] ?></li> -->
                <!--<li><span class="gall_subject">작성일 </span><?php echo $list[$i]['datetime2'] ?></li> -->
                <!--<li><span class="gall_subject">조회 </span><?php echo $list[$i]['wr_hit'] ?></li> -->
            </ul>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>

	<?php if ($is_checkbox) { ?>
    <div class="bo_fx">
		<!--<ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>-->
		<div class="btn_fixed_top">
			<input type="submit" name="btn_submit" value="선택삭제" class="btn btn_02" onclick="document.pressed=this.value">
			<a href="<?php echo $write_href ?>" class="btn btn_01">등록하기</a>
		</div>
    </div>
	<?php } ?>

    </form>
</div>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<? /*
<!-- 게시물 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="15">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시물 검색 끝 -->
*/ ?>


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
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다."))
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
<!-- } 게시판 목록 끝 -->

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (defined('G5_IS_ADMIN')) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/all.min.css">', 0);//폰트어썸
    add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/admin.css">', 0);
} else {
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
	$is_checkbox = false;
}

?>
<!-- 게시판 페이지 정보 및 버튼 시작 { -->
<div class="bo_fx">
	<div id="bo_list_total">
		<span>Total <?php echo number_format($total_count) ?>건</span>
		<?php echo $page ?> 페이지
	</div>
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
	<p><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" /> <label for="chkall">현재 페이지 게시물 전체</label></p>
</div>
<?php } ?>
<ul>
<?php
for($i=0; $i<count($list); $i++){
	//썸네일 이미지 가져오기
	$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
	
	//본문내용 텍스트만 가져오기
	$str_content = cut_str(strip_tags($list[$i]['wr_1']),150);
?>
<li onclick="location.href='<?php echo $list[$i]['href'] ?>'" onmouseover="window.status='<?php echo $list[$i]['href'] ?>'" onmouseout="window.status=''">
	<?php if ($is_checkbox) { ?>
	<p class="td_chk">
		<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
		<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
	</p>
	<?php } ?>
	<p>
		<?php if($thumb['src']){ ?>
		<div class="img_area">
		<img src="<?php echo $thumb['src']?>" alt="<?php echo $thumb['alt']?>" width="<?php echo $board['bo_gallery_width']?>" height="<?php echo $board['bo_gallery_height']?>" /></div>
		<?php } else {?>
		<div class="img_area">
		<img src="<?php echo $board_skin_url ?>/img/noimg.gif" alt="noimage"/></div>
		<?php }?>
		<div class="txt_area">
		<ul>
			<li class="zine_tit"><?php echo $list[$i]['wr_subject']?></li>
			<li class="zine_tel"><?php echo $list[$i]['wr_content']?> <a href="tel:<?php echo $list[$i]['wr_content']?>"><i class="fas fa-phone-alt"></i>전화걸기</a></li>
			<li class="zine_con"><?php echo $str_content?></li>
		</ul>
		</div>
	</p>
</li>
<?php
}

if (count($list) == 0) { echo '<div class="empty_table">게시물이 없습니다.</div>'; } 
?>
</ul>
</div>

<?php if ($is_checkbox && $write_href) { ?>
<div class="bo_fx">
	<ul class="btn_bo_user">
		<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
	</ul>
</div>
<?php } ?>
</form>


<!-- 페이지 -->
<?php
// list_rows : 한페이지 개수
// list_page_rows : 한블럭 페이지 개수
$list_rows = $board['bo_page_rows'];
$list_page_rows = 10;

$page_num = ceil($total_count / $list_rows);	// 총페이지
$block_num = ceil($page_num / $list_page_rows);	// 총블럭
$now_block = ceil($page / $list_page_rows);

$s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
if ($s_page <= 1) $s_page = 1;
$e_page = ($now_block * $list_page_rows);
if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록

if ($page_num > 1) {
?>
<nav class="pg_wrap">
	<span class="pg">
		<?php if ($now_block > 1) { ?>
		<a href="javascript:void(0)" onclick="getAjaxList(<?php echo $s_page-1?>)" class="pg_page">이전</a>
		<?php } ?>

		<?php for ($p=$s_page; $p<=$e_page; $p++) { ?>
		<a href="javascript:void(0)" <?php if ($page != $p) { ?>onclick="getAjaxList(<?php echo $p?>)"<?php } ?> class="<?php echo ($page == $p)? "pg_current" : "pg_page"; ?>"><?php echo $p?></a>
		<?php } ?>

		<?php if ($block_num > 1 && $block_num != $now_block) { ?>
		<a href="javascript:void(0)" onclick="getAjaxList(<?php echo $e_page+1?>)" class="pg_page">다음</a>
		<?php } ?>
	</span>
</nav>
<? } ?>
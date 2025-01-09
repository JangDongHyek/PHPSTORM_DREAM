<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

if(!$galType) $list_href = G5_BBS_URL."/board.php?bo_table={$bo_table}&page={$page}&galType=1";
if($galType){ 
	include $board_skin_path."/gal.list.skin.php";
}else{
?>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-common-libraries.js'></script>	
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-functions.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-thumbsgeneral.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-thumbsstrip.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-touchthumbs.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-panelsbase.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-strippanel.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-gridpanel.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-thumbsgrid.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-tiles.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-tiledesign.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-avia.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-slider.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-sliderassets.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-touchslider.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-zoomslider.js'></script>	
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-video.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-gallery.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-lightbox.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-carousel.js'></script>
	<script type='text/javascript' src='<?php echo $board_skin_url?>/js/ug-api.js'></script>

<link href="<?php echo $board_skin_url?>/css/unite-gallery.css" rel="stylesheet" >
<script src="<?php echo $board_skin_url?>/themes/default/ug-theme-default.js"></script>
<link href="<?php echo $board_skin_url?>/themes/default/ug-theme-default.css" rel="stylesheet">

<style>
#gallery{ height:auto;}
</style>

<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:95%">

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

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($ss_mb_id=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($is_admin) { ?><li><a href="<?php echo $list_href ?>" class="btn_admin">객실목록 보기</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <div id="gallery" style="display:none;">
        <?php for ($i=0; $i<count($list); $i++) {
         ?>
                    <?php
                        $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
					$filee = get_file($bo_table, $list[$i]['wr_id']);          
 //           ​		$large_img= $filee[0]['path'] .'/'. $filee[0]['file'];

                     ?>
			<img alt="<?php echo $list[$i]['subject'] ?>"  src="<?php echo $thumb['src'] ?>" data-image="<?php echo $filee[0]['path'] .'/'. $filee[0]['file'] ?>" data-description="<?php echo $list[$i]['subject'] ?> - <?php echo $list[$i]['wr_content'] ?>">

          <?php } ?>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <!--<?php if ($is_admin) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>-->
            <!--<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>-->
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

<!-- 게시물 검색 시작 { -->
<!--<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>-->
<!-- } 게시물 검색 끝 -->

<br />
<br />
<script>
jQuery(document).ready(function(){ 
				jQuery("#gallery").unitegallery(); 
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
<?php } ?>
<!-- } 게시판 목록 끝 -->

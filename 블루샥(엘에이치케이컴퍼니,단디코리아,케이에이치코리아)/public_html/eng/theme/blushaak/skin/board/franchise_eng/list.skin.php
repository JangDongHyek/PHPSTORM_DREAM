<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>

<style>
</style>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2> -->

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" >

<div class="g_map">
   <!--링크영역-->
   <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=franchise_eng2&sca=USA#bo_list_total" title="미국" style="width: 4.5%;height: 13%;top: 32.5%;left: 73.6%;"></a>
   <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=franchise_eng2&sca=Japan#bo_list_total" title="일본" style="width: 4.5%;height: 13%;top: 40.5%;left: 43.6%;"></a>
   <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=franchise_eng2&sca=China#bo_list_total" title="중국" style="width: 4.5%;height: 13%;top: 40.5%;left: 33.6%;"></a>
   <div><img src="<?php echo $board_skin_url; ?>/img/global_store.png" class="gm" alt="Global store map" /></div>
</div>


<div class="flex_wrap">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
           <?php echo str_replace('전체', 'ALL', $category_option); ?>
        </ul>
    </nav>
    <?php } ?>
    
	
<!-- 게시물 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    
    <span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_5"<?php echo get_selected($sfl, 'wr_5', true); ?>>Store Name</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>Address</option>
        <!--<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
        <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
        <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
        <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option> -->
    </select>
    </span>
    
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
    <label for="btn_search" class="btn_search"><i class="fa-solid fa-magnifying-glass"></i></label>
    <input type="submit" value="검색" class="btn_submit02" id="btn_search" style="display:none;">
    </form>
</fieldset>
<!-- } 게시물 검색 끝 -->
</div>
	

    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Store Total <?php echo number_format($total_count) ?></span>
            <!--?php echo $page ?> 페이지-->
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
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
		
		
		
	<!--새양식-->
	<?php for ($i=0; $i<count($list); $i++) {
         ?>
	<div id="new_list">
		<div class="store_item"> <!--요소 반복-->
			<a href="<?php echo $list[$i]['href'] ?>" class="">
			<?php if ($is_checkbox) { ?>
            <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
            <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            <?php } ?>
				<div class="txt_area">
					<p class="title" style="">
						<!--<span>CONTURY</span><?php echo $countryArr[$list[$i]['ca_name']]?>-->
                        <span><?php echo $list[$i]['ca_name']?></span> <?php echo $list[$i]['wr_subject']?>
					</p>
					<p class="address">
						<span>ADDRESS</span> <?php echo $list[$i][wr_1]." ".$list[$i]['wr_2']?>
					</p>
					<p class="tel">
						<span><i class="far fa-phone-rotary"></i> </span>  <?php echo $list[$i]['wr_4']?></p>
				</div>
				<div class="btn_area">
					<div class="btn">
						<span>
							View detail
							<i class="fal fa-angle-right"></i>
						</span>
					</div>
				</div>
			</a>
		</div><!--요소 반복-->
	</div>
	<?php }?>
	<?php if (count($list) == 0) { echo "<div id='new_list' style='padding:20px; text-align:center'>There are no registered stores.</div>"; } ?>
	

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
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

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>


<style>
	#bo_gall #gall_ul{
		display: flex;
	}
	#bo_gall .gall_con .gall_subject{
		display: flex;
		justify-content: space-between;
	}
	.semi{
		margin: 0 7px;
	}
</style>
<!--<script src="<?php echo G5_JS_URL; ?>/jquery.fancylist.js"></script>-->

<!--<h2 id="container_title"><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?><span class="sound_only"> 목록</span></h2>-->
<? if ($bo_table =="gall01") { ?>

	<script src="<?php echo G5_THEME_JS_URL ?>/scroller_roll.js"></script>
    <script type="text/javascript" src="<?php echo G5_THEME_JS_URL ?>/jquery.simplyscroll.js"></script>
    <link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/jquery.simplyscroll.css" media="all" type="text/css">
    <script type="text/javascript">
      (function($) {
        $(function() {
          $("#scrollerFrame").simplyScroll();
        });
      })(jQuery);
    </script>


<div class="flexBox area02 ver_noList scroller_roll_wrap">
	<div class="scroll_tit">
		<img src="<?php echo G5_THEME_IMG_URL ?>/ban_go.gif" alt="">
	</div>
	<div id="scroller_roll3" class="scroller_roll">
		<ul id="scrollerFrame" >
			<li ><a href="http://www.dongwonapt.co.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban01.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.skec.co.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban02.gif" border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.daewooenc.com/default.asp" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban03.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.dongkuk.com/index.dks" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban04.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://info.korail.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban05.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.humetro.busan.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban06.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.ex.co.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban07.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.stxons.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban08.gif" alt="STX??" border="0" style="height: 41px;"></a></li>
			<li ><a href="#" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban09.gif" alt="BNK" border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.nonghyup.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban10.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.shinhancard.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban11.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.hanacard.co.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban12.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.dongbulife.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban13.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.pps.go.kr/kor/jibang/busan/indexBusan.do" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban14.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.samsung.com/sec" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban15.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.ediya.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban16.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.jaguarkorea.co.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban17.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.bsdonggu.go.kr" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban18.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.gsnd.net" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban19.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.hyundai-dvp.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban20.gif"  border="0" style="height: 41px;"></a></li>
			<li ><a href="http://www.samsungshi.com" target="_blank" style="color: blue; font-size: 12px;"><img src="../img2/ban21.gif"  border="0" style="height: 41px;"></a></li>
		</ul>

	</div>
</div>


<? } ?>
<!-- 게시판 목록 시작 -->
<div id="bo_gall">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
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
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

    <fieldset id="bo_sch">
        <legend>게시물 검색</legend>
    
        <form name="fsearch" method="get">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sop" value="and">
        <label for="sfl" class="sound_only">검색대상</label>
        <select name="sfl" id="sfl">
            <option value="wr_subject"<?php echo get_selected($sfl, "wr_subject", true); ?>>제목</option>
            <option value="wr_content"<?php echo get_selected($sfl, "wr_content"); ?>>내용</option>
            <option value="wr_subject||wr_content"<?php echo get_selected($sfl, "wr_subject||wr_content"); ?>>제목+내용</option>
            <option value="mb_id,1"<?php echo get_selected($sfl, "mb_id,1"); ?>>회원아이디</option>
            <option value="mb_id,0"<?php echo get_selected($sfl, "mb_id,0"); ?>>회원아이디(코)</option>
            <option value="wr_name,1"<?php echo get_selected($sfl, "wr_name,1"); ?>>글쓴이</option>
            <option value="wr_name,0"<?php echo get_selected($sfl, "wr_name,0"); ?>>글쓴이(코)</option>
        </select>
        <input name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어(필수)" required id="stx" class="required frm_input" size="15" maxlength="20">
        <input type="submit" value="검색">
        </form>
    </fieldset>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    <h2>이미지 목록</h2>

    <?php/* if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php }*/ ?>

    <ul id="gall_ul">
        <?php 
		$no=$total_count-$from_record;
		for ($i=0; $i<count($list); $i++) {
        ?>
        <li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
            <?php if ($is_checkbox) { ?>
            <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
           <!-- <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">-->
            <?php } ?>
            <span class="sound_only">
                <?php
                if ($wr_id == $list[$i]['wr_id'])
                    echo "<span class=\"bo_current\">열람중</span>";
                else
                    echo $list[$i]['num'];
                ?>
            </span>
            <ul class="gall_con">
				<?php
                if ($list[$i]['is_notice']) { // 공지사항 ?>
                    <strong style="width:<?php echo $board['bo_mobile_gallery_width'] ?>px;height:<?php echo $board['bo_mobile_gallery_height'] ?>px">공지</strong>
                <?php
                } else {
                    $sql="select * from g5_board_file where bo_table='$bo_table' and wr_id='".$list[$i][wr_id]."'";
                    $imgRow=sql_fetch($sql);
                    if($imgRow[bf_file]){
                        //$img_content = '<img src="'.G5_DATA_URL.'/file/'.$bo_table.'/'.$imgRow[bf_file].'" alt="'.$thumb['alt'].'" width=240 height=165>';
                    }else{
                        $img_content = '<span style="width:'.$board['bo_mobile_gallery_width'].'px;height:'.$board['bo_mobile_gallery_height'].'px">no image</span>';
                    }
                    $matchs = get_editor_image($list[$i]['wr_content']);
					$image = substr($matchs[0][0],strpos($matchs[0][0],"src="),strrpos($matchs[0][0],"title="));
					$image = str_replace('src="',"",$image);
					$image = str_replace('title',"",$image);
					$image = str_replace('"',"",$image);
					
					
					
					$img_content  = $imgRow[bf_file]?G5_DATA_URL."/file/".$bo_table."/".$imgRow[bf_file]:$image;
					
                    //echo $img_content;
                }
                ?>
                <div style="border:1px solid #948a54">
					<li class="gall_href" style="background:url('<?php echo $img_content?>'); height:160px; background-size:cover;cursor:pointer;border: 2px solid #fff;" onclick="location.href='<?php echo $list[$i]['href'] ?>';">
						<a href="">
						</a>
					</li>
                </div>
                <li class="gall_text_href">
                    <?php
					echo "[".$no."]";
                    // echo $list[$i]['icon_reply']; 갤러리는 reply 를 사용 안 할 것 같습니다. - 지운아빠 2013-03-04
                    if ($is_category && $list[$i]['ca_name']) {
                    ?>
                    <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                    <?php } ?>
                    <a href="<?php echo $list[$i]['href'] ?>">
                        <?php echo $list[$i]['subject'] ?>
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
				<?php
					if($bo_table=="gall01"){?>
                <li>
                    <span class="gall_subject"><b>고</b><b>객</b><b>사</b> </span><b class="semi">:</b><?php echo $list[$i]['client'] ?>
                    <?php echo $list[$i]['wr_1']?>
                </li>
				<?php }?>
                <li>
                    <span class="gall_subject"><b>일</b><b>자</b> </span><b class="semi">:</b><?php echo $list[$i]['day'] ?>
                    <?php echo date("Y년 m월 d일",strtotime($list[$i]['wr_2']))?>
                </li>
                <li>
                    <span class="gall_subject"><b>행</b><b>사</b><b>장</b><b>소</b> </span><b class="semi">:</b><?php echo $list[$i]['place'] ?>
                    <?php echo $list[$i]['wr_3']?>
                </li>
                <li>
                    <span class="gall_subject"><b>세</b><b>부</b><b>내</b><b>용</b></span><b class="semi">:</b><?php echo $list[$i]['subcon'] ?>
                    <?php echo $list[$i]['wr_4']?>
                </li>
                <?php if ($is_good) { ?><li><span class="gall_subject">추천</span><strong><?php echo $list[$i]['wr_good'] ?></strong></li><?php } ?>
                <?php if ($is_nogood) { ?><li><span class="gall_subject">비추천</span><strong><?php echo $list[$i]['wr_nogood'] ?></strong></li><?php } ?>
            </ul>
        </li>
        <?php $no--;} ?>
        <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
    </ul>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <ul class="btn_bo_adm">
            <?php if ($list_href) { ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
            <?php } ?>
            <?php if ($is_checkbox) { ?>
           <!--  <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li> -->
            <li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
            <?php } ?>
        </ul>

        <ul class="btn_bo_user">
            <li><?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a><?php } ?></li>
        </ul>
    </div>
    <?php } ?>

    </form>
</div>

<script>
$(window).on("load", function() {
    $("#gall_ul").fancyList(".gall_li", "gall_clear");
});
</script>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

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
<!-- 게시판 목록 끝 -->

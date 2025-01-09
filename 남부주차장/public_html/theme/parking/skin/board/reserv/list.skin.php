<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 9;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);
?>
<style>
	td{text-align:center}
</style>
<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->
<? if((!$swr_6&&!$swr_password)&&!$is_admin){?>
<!--예약확인 검색-->
<form name="form" method="get" action="<?=G5_BBS_URL?>/board.php" onsubmit="return checkField(this)">
<input type="hidden" name="bo_table" value="b_reserv">
<div class="reserv_wrap_confirm wow fadeInUp" data-wow-delay='0.5s'>
	 <p class="text-center b_margin20 t4">고객님의 예약상태를 확인하세요.</p>
	 <ul>
		  <li><input name="swr_6" id="wr_6" type="text" placeholder="차량번호"></li>
		  <li><input name="swr_password" id="wr_password" type="text" placeholder="비밀번호"></li>
		  <li><input type="submit" value="예약확인조회" class="btn_reserv"></li>
	 </ul> 
</div>
</form>
<script type="text/javascript">
	function checkField(f){
		if($("#wr_6").val()==""){
			alert("차량번호를 입력하세요");
			return flase;
		}
		if($("#wr_password").val()==""){
			alert("비밀번호를 입력하세요");
			return false;
		}
	}
</script>
<!--//예약확인 검색-->
<? }?>

<? if(($swr_6&&$swr_password)||$is_admin){
	$qstr2.="&swr_6=$swr_6&swr_password=$swr_password";

?>
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

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <!--<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>-->
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
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <colgroup>
             <col style="width:5%" />
             <!--<col style="width:*" />-->
             <col style="width:*" />
             <col style="width:*" />
             <col style="width:*" />
             <col style="width:*" />
             <col style="width:*" />
             <col style="width:15%" />
             <col style="width:15%" />
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
            <th scope="col">국내/국제</th>
			<th scope="col">예약자이름</th>
			<th scope="col">연락처</th>
            <th scope="col">차종</th>
			<th scope="col">차량번호</th>
			<th scope="col">입고예정시간</th>
			<th scope="col">출차예정시간</th>
            <!--<th scope="col">총금액</th>-->
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num">
            <?php
            if ($list[$i]['is_notice']) // 공지사항
                echo '<strong>공지</strong>';
            else if ($wr_id == $list[$i]['wr_id'])
                echo "<span class=\"bo_current\">열람중</span>";
            else
                echo $list[$i]['num'];
             ?>
            </td>
            <?php if ($is_checkbox) { ?>
            <td class="td_chk">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_4']?></a></td>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_name']?></a></td>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_3']?></a></td>
            <td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_5']?></a></td>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_6']?></a></td>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_1']?></a></td>
			<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo $list[$i]['wr_2']?></a></td>
            <!--<td scope="col"><a href="<?php echo $list[$i]['href'].$qstr2 ?>"><?php echo number_format($list[$i]['wr_8'])?>원</a></td>-->
			




        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

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
            <!--<?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>-->
        </ul>
        <?php } ?>
    </div>
    <?php } ?>
    </form>
</div> 
<? }?>
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
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$si_arr = array("서울","세종","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!--<script src="<?php echo G5_JS_URL?>/address.js"></script>-->
<style>
</style>
<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

	<!--<script type="text/javascript">flashWrite('<?php echo $board_skin_path; ?>/img/fran_area.swf','778','293')</script>-->
	<!-- 게시물 검색 시작 { -->
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<input type="hidden" name="sfl" value="wr_1">
				<div class="shop_search" width="100%" style="padding-top:8px;">
					<select name="si" id="si" class="sch_sel">
						<option value="">시/도(전체)</option>
						<?php for($i=0; $i<count($si_arr); $i++){ ?>
						<option value="<?php echo $si_arr[$i]?>" <?php if($si==$si_arr[$i]) echo "selected";?>><?php echo $si_arr[$i]?></option>
						<?php } ?>
					</select>
					<select name="gu" id="gu" class="sch_sel">
						<option value="" >구/군(전체)</option>
					</select>
					<select name="dong" id="dong" class="sch_sel">
						<option value="" >동</option>
					</select>
					<input type="submit" value="가맹점 찾기" class="btn_sch">
				</div>
			</form>
	</fieldset>
	<!-- 게시물 검색 끝 } -->

    <div class="bo_fx">
        <!--div id="bo_list_total">
            <span style="font-size:11pt; font-weight:bold;"><?php if(!$si) echo "전체"; else echo $si." ".$gu." ".$dong; ?> 가맹점 현황 <?php echo number_format($total_count) ?> 개</span>
            <?php echo $page ?> 페이지
        </div-->

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
			<li>
			<!--<a href="<?=G5_BBS_URL?>/excel.list.php?bo_table=<?=$bo_table?>" class="btn_b02">엑셀출력</a></li>-->
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

    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <colgroup>
            <?php if ($is_checkbox) { ?>
            <col class="td_chk" width="5%">
            <?php } ?>
            <col class="td_subject" width="15%">
            <col class="td_location">
            <col class="td_tel" width="15%">
            <col class="td_view" width="10%">
        </colgroup>
        <thead class="hidden-xs">
        <tr>
            <?php if ($is_checkbox) { ?>
            <th scope="col">
                <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
                <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
            </th>
            <?php } ?>
            <th>매장명</th>
            <th>주소</th>
            <th>전화번호</th>
			<th>매장상세</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <?php if ($is_checkbox) { ?>
            <td class="td_chk" style="width:5%">
                <label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
                <input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
            </td>
            <?php } ?>
            <td class="td_subject">
				<!-- 매장명 -->
                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['subject'] ?>
                </a>
                <?php
                if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
                ?>
                <span class="call_btn"><a href="tel:<?php echo $list[$i]['wr_3'] ?>"><i class="fa fa-phone"></i> <?php echo $list[$i]['wr_3'] ?></a></span>
            </td>
            <td class="td_location">
				<!-- 주소 -->
				<?php echo $list[$i]['wr_1'] ?> <?php echo $list[$i]['wr_2'] ?>
			</td>
            <td class="td_tel">
				<!-- 전화번호 -->
				<?php echo $list[$i]['wr_3'] ?>
			</td>
			<td class="td_view">
				<!-- 매장상세 -->
				<a href="<?php echo $list[$i]['href'] ?>" class="btn btn-default">
					VIEW
				</a>
			</td>
            
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="5" class="empty_table">가맹점이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <?php if ($list_href || $is_checkbox || $write_href) { ?>
    <div class="bo_fx">
        <?php if ($is_checkbox) { ?>
        <ul class="btn_bo_adm">
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
        </ul>
        <?php } ?>

        <?php if ($list_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li><?php } ?>
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

function getCity(si, gu){
	if(!si && !gu){
		return false;
	}

	var opt;
	var opt_select;

	$.ajax({
		type:"GET",
		url:"<?php echo G5_PLUGIN_URL?>/address/address.php",
		dataType: "json",
		data: {
			"si": si,
			"gu": gu
		},
		success:function(datas){
			for(var i=0; i<datas.length; i++){
				if("<?php echo $si?>" == datas[i] || "<?php echo $gu?>" == datas[i] || "<?php echo $dong?>" == datas[i])
					opt_select = "selected";
				else 
					opt_select = "";

				opt = "<option value='"+datas[i]+"' "+opt_select+">"+datas[i]+"</option>";

				if(!gu){
					if(si == '세종'){
						$("#dong").append(opt);
					} else {
						$("#gu").append(opt);
					}
					
				}else{
					$("#dong").append(opt);
				}
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	});
}

$(document).ready(function (){
	getCity("<?php echo $si?>");
	getCity("<?php echo $si?>", "<?php echo $gu?>");
});

$("#si").change(function (){
	$("#gu").find("option").remove();
	$("#gu").append("<option value=''>구/군(전체)</option>");
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity($(this).val(), "")
});

$("#gu").change(function (){
	var si = $("#si").val();
	$("#dong").find("option").remove();
	$("#dong").append("<option value=''>동</option>");

	getCity(si, $(this).val())
});

</script>
<!-- } 게시판 목록 끝 -->

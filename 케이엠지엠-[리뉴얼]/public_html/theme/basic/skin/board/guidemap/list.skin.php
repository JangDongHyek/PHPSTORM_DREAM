<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$si_arr = array("서울","경기","인천","부산","대구","대전","울산","광주","충남","충북","경남","경북","전남","전북","강원","제주","세종");

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL?>/address.js"></script>
<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

	<script type="text/javascript">flashWrite('<?php echo $board_skin_path; ?>/img/fran_area.swf','778','293')</script>
	<!-- 게시물 검색 시작 { -->
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<input type="hidden" name="sfl" value="wr_1">
				<div class="shop_search">
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
					<input type="submit" value="지점찾기" class="sch_btn">
				</div>
			</form>
	</fieldset>
	<!-- 게시물 검색 끝 } -->

    <div class="bo_fx">
        <div id="bo_list_total">
            <span style="font-size:11pt; font-weight:bold;"><?php if(!$si) echo "전체"; else echo $si." ".$gu." ".$dong; ?> 체인점 현황 <?php echo number_format($total_count) ?> 개</span>
            <?php echo $page ?> 페이지
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

    <?php if ($is_checkbox) { ?>
    <div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>
    <?php } ?>
	<div id="list_store">
	<?php for ($i=0; $i<count($list); $i++) {?>
	<a href="<?php echo $list[$i]['href'] ?>">
		<div class="list_store">
			<dl>
				<dt>
					<?php
					if ($list[$i]['is_notice']) { // 공지사항  ?>
						<strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
					<?php } else {
						$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
						} else {
							//$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
							$img_content = '<div class="noimg"><img src="'.$board_skin_url.'/img/cover_list.jpg" alt="이미지 준비중입니다."></div>';
						}

						echo $img_content;
					 }
					 ?>
                     <?php /*?><p class="new_icon"><?php if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></p><?php */?>
				</dt>
				<dd>
					<div class="title"><?php if ($is_checkbox) { ?>
					<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
					<?php } ?>
					<span><?php echo $list[$i]['subject'] ?></span>
                    </div>
					<ul class="fa-ul info">
                        <li><i class="fa-li fa fa-map-marker" aria-hidden="true"></i><strong>주　　소</strong> <span><?php echo $list[$i]['wr_1']; ?> <?php echo $list[$i]['wr_2']; ?></span></li>
                        <li><i class="fa-li fa fa-phone" aria-hidden="true"></i><strong>전화번호</strong> <span><?php echo $list[$i]['wr_4']; ?></span></li>
                        <li><i class="fa-li fa fa-car" aria-hidden="true"></i><strong>주차여부</strong> <span><?php echo $list[$i]['wr_6']; ?></span></li>
					</ul>
				</dd>
			</dl>
            <a href="<?php echo $list[$i]['href'] ?>" class="view_btn">자세히 보기 +</a>
		</div>
	</a>
	<?php } ?>
	<?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
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
					$("#gu").append(opt);
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

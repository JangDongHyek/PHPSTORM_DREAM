<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/default.js"></script>', 100);
add_javascript('<script type="text/javascript" src="'.$board_skin_url.'/js/ui.js"></script>', 100);

$action_url = https_url(G5_BBS_DIR)."/write_update.php";

?>


<style>
	#bo_cate a {
		padding: 10px 10px;
	}
</style>

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

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

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
            <?php if ($write_href) { ?><li><a class="btn_b02" data-toggle="modal" data-target="#writeModal">설명회 등록</a></li><?php } ?>
            <!--<?php if ($write_href) { ?><li><a class="btn_b02" data-toggle="modal" data-target="#writeModal_local">지역설정</a></li><?php } ?>-->
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
            <th scope="col" class="hidden-xs"><?php echo subject_sort_link('wr_datetime', $qstr2, 1) ?>날짜</a></th>
            <th scope="col"></th>
            <!--<th scope="col" class="hidden-xs"><?php /*echo subject_sort_link('wr_hit', $qstr2, 1) */?>조회</a></th>-->
            <?php if ($is_good) { ?><th scope="col"><?php echo subject_sort_link('wr_good', $qstr2, 1) ?>추천</a></th><?php } ?>
            <?php if ($is_nogood) { ?><th scope="col"><?php echo subject_sort_link('wr_nogood', $qstr2, 1) ?>비추천</a></th><?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
			if($write_href){
				$write_href .= "&wr_id=".$list[$i]['wr_id'];
			}
			
			$btn_title = "신청하기";
			if(empty($list[$i]['wr_6'])) {
				$list[$i]['wr_6'] = 0;
			}

			if(empty($list[$i]['wr_8'])) {
				$list[$i]['wr_8'] = 0;
			}

			if($list[$i]['wr_6'] == $list[$i]['wr_8']){
				$btn_title = "마감";
				if($member['mb_level'] != "10"){
					$list[$i]['href'] = "";
				}
			
			}
         ?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
            <td class="td_num hidden-xs">
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
            <td class="td_subject">
                <?php
                echo $list[$i]['icon_reply'];
                if ($is_category && $list[$i]['ca_name']) {
                 ?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link hidden-xs"><?php echo $list[$i]['ca_name'] ?></a>
                <?php } ?>

                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php echo $list[$i]['subject']. "(".$list[$i]['wr_8']."/".$list[$i]['wr_6'].")" ?>
                </a>
            </td>
            <td class="td_date"><?=$list[$i]['wr_1']?> <?=$list[$i]['wr_2']?>시 <?=$list[$i]['wr_3']?>분</td>
            <td class="td_name sv_use"><a class="btn_confirm" href="<?php echo $list[$i]['href'] ?>"><?=$btn_title?></a></td>
            <!--<td class="td_num hidden-xs"><?php /*echo $list[$i]['wr_hit'] */?></td>-->
            <?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
            <?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
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
            <!--<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>-->
        </ul>
        <?php } ?>


    </div>
    <?php } ?>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="writeModal" tabindex="-1" role="dialog" aria-labelledby="writeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="writeModalLabel">설명회 등록</h4>
            </div>
				<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
				<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
				<input type="hidden" name="w" value="<?php echo $w ?>">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="ca_name" id="ca_name" value="<?php echo $page ?>">
				<input type="hidden" name="wr_1" id="wr_1"> <!-- 날짜 -->
				<input type="hidden" name="wr_2" id="wr_2"> <!-- 시작 시 -->
				<input type="hidden" name="wr_3" id="wr_3"> <!-- 시작 분 -->
				<input type="hidden" name="wr_4" id="wr_4"> <!-- 끝 시 -->
				<input type="hidden" name="wr_5" id="wr_5"> <!-- 끝 분 -->
				<input type="hidden" name="wr_6" id="wr_6"> <!-- 참여가능인원 -->
				<input type="hidden" name="wr_7" id="wr_7"> <!-- 장소 -->
				<div class="modal-body">
					

					
					<dl>
						<dt>설명회 장소</dt>
						<dd>
							<select class="frm_input" id="location_str" name="location_str">
								<? foreach ($sido_list as $sido) {
									echo "<option value='$sido'>$sido</option>";
								}?>
							</select>
						</dd>
					</dl>
					<dl>
						<dt>설명회 일시</dt>
						<dd>
							<input type="date" class="frm_input" name="date_str" id="date_str">

						</dd>
						<dt></dt>
						<dd>
							<input type="input" class="frm_input" name="start_h" id="start_h"><span>시</span>
							<input type="input" class="frm_input" name="start_m" id="start_m"><span>분</span>
							<span>~</span>
							<input type="input" class="frm_input" name="end_h" id="end_h"><span>시</span>
							<input type="input" class="frm_input" name="end_m" id="end_m"><span>분</span>
						</dd>
					</dl>
					<dl>
						<dt>참석인원</dt>
						<dd>
							<input type="input" class="frm_input" name="p_count" id="p_count"><span>명</span>
						</dd>
					</dl>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">등록하기</button>
				</div>
			</form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="writeModal_local" tabindex="-1" role="dialog" aria-labelledby="writeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="writeModalLabel">설명회 지역 추가</h4>
            </div>
				<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
				<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
				<input type="hidden" name="w" value="<?php echo $w ?>">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<input type="hidden" name="ca_name" id="ca_name" value="<?php echo $page ?>">
				<input type="hidden" name="wr_1" id="wr_1"> <!-- 날짜 -->
				<input type="hidden" name="wr_2" id="wr_2"> <!-- 시작 시 -->
				<input type="hidden" name="wr_3" id="wr_3"> <!-- 시작 분 -->
				<input type="hidden" name="wr_4" id="wr_4"> <!-- 끝 시 -->
				<input type="hidden" name="wr_5" id="wr_5"> <!-- 끝 분 -->
				<input type="hidden" name="wr_6" id="wr_6"> <!-- 참여가능인원 -->
				<input type="hidden" name="wr_7" id="wr_7"> <!-- 장소 -->
				<div class="modal-body">
					

					
					<dl>
						<dt>지역 선택</dt>
						<dd>
						<select class="frm_input" id="location_str" name="location_str">
							<option value="대구">대구</option>
							<option value="인천">인천</option>
						</select>
						</dd>
					</dl>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">추가하기</button>
				</div>
			</form>
        </div>
    </div>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>

<!-- 게시판 검색 시작 { -->
<!--
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>

    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">
    <label for="sfl" class="sound_only">검색대상</label>
    
    <span class="select_box">
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
        <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
        <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
        <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>

    </select>
    </span>
    
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input sch_input required" maxlength="20">
    <input type="submit" value="검색" class="btn_submit02">
    </form>
</fieldset>
-->
<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>

	$('#date_str').change(function(){
		var date = new Date($(this).val());
		var day = ('0' + date.getDate()).slice(-2); // 항상 두 자릿수를 유지하기 위해
		var month = ('0' + (date.getMonth() + 1)).slice(-2); // 월은 0부터 시작하므로 1을 더합니다.
		var year = date.getFullYear().toString().substr(-2); // 마지막 두 자리만 가져오기 위해
		var week = ['일', '월', '화', '수', '목', '금', '토'][date.getDay()];

		var formattedDate = year + '년 ' + month + '월 ' + day + '일(' + week + ')';
		$('#wr_1').val(formattedDate);
  });

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

    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f) {
        
		let location_str = $("#location_str").val();
		let date_str = $("#date_str").val();
		let p_count = $("#p_count").val();
		let start_h = $("#start_h").val();
		let start_m = $("#start_m").val();
		let end_h = $("#end_h").val();
		let end_m = $("#end_m").val();

		if(date_str == "" || date_str == null) {
			alert("날짜를 입력해주세요.");
			return false;
		}
		
		if(location_str == "" || location_str == null) {
			alert("장소를 선택해주세요.");
			return false;
		}

		$("#ca_name").val(location_str);

		if(p_count == "" || p_count == null) {
			alert("참석 가능한 인원수를 선택해주세요.");
			return false;
		}

		if(start_h == "" || start_h == null) {
			alert("시작 시간을 입력해주세요.");
			return false;
		}

		if(start_m == "" || start_m == null) {
			alert("시작 시간을 입력해주세요.");
			return false;
		}

		if(end_h == "" || end_h == null) {
			alert("끝나는 시간을 입력해주세요.");
			return false;
		}

		if(end_m == "" || end_m == null) {
			alert("끝나는 시간을 입력해주세요.");
			return false;
		}

        return true;
    }

</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
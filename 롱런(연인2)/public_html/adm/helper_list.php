<?php
$sub_menu = "400100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$g5['title'] = '카운슬러관리';
include_once('./admin.head.php');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where mb_level = 10 AND mb_status = '카운슬러' AND mb_3 != 'out' ";

if ($stx) {
    $sql_search .= " AND ({$sfl} LIKE '%{$stx}%') ";
}

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

// 페이징
$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);		// 전체 페이지 계산
if ($page < 1) $page = 1;						// 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows;				// 시작 열을 구함


// 리스트
$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

// 삭제권한
$is_chked = false;
if ($member['mb_status'] == "관리자") {
	$is_chked = true;
}

?>

<div class="local_ov01 local_ov">
    <a href="<?=$_SERVER['SCRIPT_NAME']?>" class="ov_listall">전체목록</a>
    <span>전체 <?php echo number_format($total_count) ?>명</span>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
	<label for="sfl" class="sound_only">검색대상</label>
	<select name="sfl" id="sfl">
		<option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>아이디</option>
		<option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
	</select>
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
	<input type="submit" class="btn_submit" value="검색">
</form>

<? if ($member['mb_status'] == '관리자') { ?>
<div class="btn_add01 btn_add">
    <a href="./helper_form.php" id="member_add">카운슬러등록</a>
</div>
<? } ?>

<form name="fmemberlist" id="fmemberlist" method="post">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="mode" value="helper">

<div class="tbl_head02 tbl_wrap mb_tbl">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
	<colgroup>
		<col width="3%">
		<col width="5%">
		<col width="5%">
		<col width="10%">
		<col width="10%">
		<col width="10%">
		<col width="15%">
		<col width="">
		<col width="7%">
		<col width="5%">
	</colgroup>
    <thead>
	<tr>
		<? if ($is_chked) { ?>
		<th scope="col">
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
		<? } ?>
		<th>No.</th>
		<th>출퇴근</th>
		<th>아이디</th>
		<th>카톡아이디</th>
		<th>이름</th>
		<th>사진</th>
		<th>소개요청주소</th>
		<th>매칭수</th>
		<th>관리</th>
	</tr>
    </thead>
    <tbody>
    <?php
	$list_no = $total_count - ($list_rows * ($page - 1));

    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $bg = 'bg'.($i%2);

		$mb_id = $row['mb_id'];

		// 수정화면
		$form_href = "./helper_form.php?w=u&amp;mb_id=".$mb_id;
		if ($qstr != "")
			$form_href .= "&amp;".$qstr;

		// 회원이미지
		$mb_img_arr = getMemberImg($mb_id);
		$mb_img_src = "";

		if ($mb_img_arr['cnt'] > 0) {
			$mb_img_src = MB_IMG_URL."/".$mb_img_arr['list'][0]['mi_img'];
			$tmp_img = getImgSquare($mb_img_src, $base_size = 150);
		}

		// 버튼클래스
		$btn_calss = ($row['mb_3'] == "on")? "btn01" : "btn02";

		// 수정권한
		$edit_flag = false;
		if ($member['mb_status'] == '관리자') {
			$edit_flag = true;
		} else if ($member['mb_id'] == $row['mb_id']) {
			$edit_flag = true;
		}

    ?>
	<tr class="<?php echo $bg; ?>">
		<? if ($is_chked) { ?>
		<td>
            <input type="checkbox" name="chk[]" id="chk_<?php echo $i ?>" value="<?=$row['mb_id']?>">
		</td>
		<? } ?>
		<td><?=$list_no?></td>
		<td><button type="button" class="<?=$btn_calss?>" onclick="setHelperFlag('<?=$row['mb_3']?>', '<?=$row['mb_id']?>');"><?=$row['mb_3']?></button></td>
		<td><?=$row['mb_id']?></td>
		<td><?=$row['mb_1']?></td>
		<td><?=$row['mb_name']?></td>
		<td>
			<? if ($mb_img_src != "") { ?>
			<div class="hp_img"><?=$tmp_img?></div>
			<? } else { ?>
			<div class="hp_no_img">NO IMAGES</div>
			<? } ?>
		</td>
		<td><?=$row['mb_2']?></td>
		<td><?=number_format(getMatchingCnt($row['mb_id']))?></td>
		<td>
			<? if ($edit_flag) { ?>
			<a href="<?=$form_href?>" class="btn02">수정</a>
			<? } else { ?>
			-
			<? } ?>
		</td>
	</tr>
    <?php
		$list_no--;
    }
    if ($i == 0)
        echo "<tr><td colspan='10' class=\"empty_table\">조회된 카운슬러가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<? if ($is_chked) { ?>
<div class="btn_list01 btn_list">
    <input type="button" name="act_button" value="선택삭제" onclick="fnHelperDel();">
</div>
<script>
function fnHelperDel() {
	var chk = document.getElementsByName("chk[]"),
		list = [];
    for (var i=0; i<chk.length; i++) {
        if (chk[i].checked) {
			list.push(chk[i].value);
        }
    }

	if (!is_checked("chk[]") || list.length == 0) {
        alert("삭제하실 항목을 하나 이상 선택하세요.");
        return false;
    }
	
	if (confirm('선택하신 카운슬러를 삭제하시겠습니까?') == true) {
		$.ajax({  
			type : "post",  
			url : "./ajax.helper_update.php",
			data : {"mode" : "delete", "list" : list},
			dataType : "text",  
			success : function(data) {
				if (data == "F") {
					alert("삭제에 실패하였습니다. 다시 시도해 주세요.");
				} else {
					getMoveScroll("on");
				}
			},  
			error : function(xhr,status,error) {
				alert("삭제에 실패하였습니다. 다시 시도해 주세요.");
			}  
		});

	} else {
		return false;
	}
}
</script>
<? } ?>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>


<script>
$(function() {
	getMoveScroll();
});

function setHelperFlag(flag, mb_id) {
	$.ajax({  
		type : "post",  
		url : "./ajax.helper_update.php",
		data : {"mode" : "status", "flag" : flag, "mb_id" : mb_id},
		dataType : "text",  
		success : function(data) {
			if (data == "F") {
				alert("출퇴근 변경에 실패하였습니다. 다시 시도해 주세요.");
			} else if (data == "E") {
				alert("본인정보의 출퇴근만 변경이 가능합니다.");
			} else {
				getMoveScroll("on");
			}
		},  
		error : function(xhr,status,error) {
			alert("출퇴근 변경에 실패하였습니다. 다시 시도해 주세요.");
		}  
	});
}

<? /*
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(confirm("선택한 카운슬러정보를 삭제하시겠습니까?\n삭제된 자료는 복구되지 않습니다.")) {
			alert('준비중입니다.');
            return false;
        }
    }

    return true;
}
*/ ?>
</script>

<?php
include_once ('./admin.tail.php');
?>
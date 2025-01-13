<?php
include_once('./_common.php');
include_once('./_head.php');
if($ss[sc]){
	$where = " and mb_2 like '%$ss[sc]%'";
}

$sql = "select count(*) as cnt from g5_member where mb_level=2 $where";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$list_sql = "select * from g5_member where mb_level='2' $where and mb_2 <> '' order by mb_2 asc limit {$from_record}, {$rows} ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);

?>
<link rel="stylesheet" href="<?=G5_THEME_URL?>/skin/content/myorder/style.css?ver=<?=strtotime(date('Y-m-d H:i:s'))?>">

<!-- 본문 시작 -->
<div id="category_container">
	<h2 id="category_title">마일리지 발급/차감</h2>
	<div style="margin-top:30px; padding-bottom:10px;">
        <div style="display: inline-block">
            <? if($member['mb_level'] > 2) { ?>
                <button type="button" class="btn btn-primary btn-sm" id="btn_down" style="position: relative;top:0">엑셀다운</button>
            <? } ?>
            <? if($member['mb_level'] > 9) { ?>
                <button type="button" class="btn btn-primary btn-sm" onclick="upload_excel()" style="position: relative;top:0">엑셀업로드</button>
                <div id="div_upload"></div>
            <? } ?>
        </div>
		<div id="sch_box">

			<!-- 검색 폼 시작 -->
			<?php if($member['mb_level'] >= 3){ ?>
			<form method="get" name="order_sch_frm" action="">
				지점명
				<input type="text" name="ss[sc]" value="<?=$ss[sc]?>" id="sch_mb_2">
				<input type="submit" value="검색" id="sch_submit">
			</form>
			<?php } ?>
			<!-- 검색 폼 끝 -->
		</div>
	</div>
	<!--
	<form method="post" name="ca_frm" action="<?php echo G5_BBS_URL ?>/category_list_update.php" style="clear:both;">
	<input type="hidden" name="mode" id="mode" value="">
	-->
	<form method="post" name="ca_frm" style="clear:both;">
		<table class="list_tbl">
			<colgroup>
				<col width="30%">
				<col width="20%">
				<col width="25%">
				<col width="25%">
			</colgroup>
			<thead>
			<tr>
				<th class="list_th">지점명</th>
				<th class="list_th">보유마일리지</th>
				<th class="list_th">마일리지관리</th>
				<th class="list_th">마일리지이력</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if($list_num > 0){
				$list_num2 = $total_count - ($page - 1) * $rows;
				for($l = 0; $l < $list_num; $l++){
					$list_row = sql_fetch_array($list_qry);
					$td_bg = '';
					if($l%2 == 0) $td_bg = 'td_bg';
					$sql = "select sum(po_point) as total from g5_point where mb_id='$list_row[mb_id]' ";
					$result2 = sql_query($sql);
					$row2 = sql_fetch_array($result2);
			?>
			<tr>
				<td class="list_td talgin_c <?php echo $td_bg ?>"><?php echo $list_row[mb_2] ?></td>
				<td class="list_td talgin_r <?php echo $td_bg ?>"><?=number_format($row2[total])?>점</td>
				<td class="list_td <?php echo $td_bg ?>"><a href="javascript:;" onclick="addPoint('<?=$list_row[mb_id]?>','<?=$list_row[mb_2]?>')">발급</a> / <a href="javascript:;" onclick="removePoint('<?=$list_row[mb_id]?>','<?=$list_row[mb_2]?>')">차감</a></td>
				<td class="list_td <?php echo $td_bg ?>"><a href="./pstore.point.list.php?mb_id=<?=$list_row[mb_id]?>">마일리지이력</a></td>
			</tr>
			<?php
				}
			}
			?>
			</tbody>
		</table>
	</form>
	<?php echo get_paging(10, $page, $total_page, '?ss[sc]='.$ss[sc]); ?>

	<!-- 마일리지 발급 폼 시작 -->
	<div id="point-form" style="background-color:#fff;border:1px solid #ccc;margin-top:30px;padding:10px;">
		<form name="point-form" method="get" action="./pstore.list.update.php" onsubmit="return fpoint_submit(this);">
		<input type="hidden" name="mb_id" id="mb-id" value="">
		<input type="hidden" name="page" value="<?=$page?>">
		<input type="hidden" name="ss[sc]" value="<?=$ss[sc]?>">
		<table width="100%" cellpadding="0" cellspacing="0" class="form_tbl">
			<tbody>
				<tr>
					<th>지점명</th>
					<td id="company"></td>
					<th>마일리지 발급여부</th>
					<td>
						<input type="radio" name="point_st" id="point-st1" value="+" checked><label for="point-st1">발급</label>
						<input type="radio" name="point_st" id="point-st2" value="-"><label for="point-st2">차감</label>
					</td>
				</tr>
				<tr>
					<th>마일리지 내용</th>
					<td><input type="text" name="po_content" value="" required></td>
					<th>마일리지</th>
					<td><input type="text" name="po_point" value="" required></td>
                    <th>비고</th>
                    <td><input type="text" name="po_etc" value="" ></td>
				</tr>
			</tbody>
		</table>
        <div style="text-align:center;">
		   <button type="submit" class="btn" style="margin-top:10px; font-size:1.2em; padding:10px 40px;">확  인</button>
        </div>

	</div>
	<!-- 마일리지 발급 폼 끝 -->

	
</div>
<!-- 본문 끝 -->


<script>
$(function(){
	$("[name=po_point]").on("keyup", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});

    $("#btn_down").on("click", function(){
        var params = "s_date=" + $("#s_date").val() + "&e_date=" + $("#e_date").val();
        var curUrl = window.location.pathname;
        curUrl = curUrl.replace("list.php", "list.excel.php");
        window.open(curUrl + "?mb_id=<?=$mb_id?>&" + params, "_blank");
    });
});
function addPoint(mb_id,store){
	$("#point-st1").prop("checked",true);
	$("#mb-id").val(mb_id);
	$("#company").html(store);
	$("#point-form").css("display","");
	$("html").scrollTop($(document).height());
	
}
function removePoint(mb_id,store){
	$("#point-st2").prop("checked",true);
	$("#mb-id").val(mb_id);
	$("#company").html(store);
	$("#point-form").css("display","");
	$("html").scrollTop($(document).height());
}

function fpoint_submit(f){
	var company = $("#company").text();
	if(company == ""){
		alert("지점을 선택하세요.");
		return false;
	}
}

function upload_excel() {
    upload = $('<input type="file" name="bf_file" class="frm_file el_hidden" id="bf_file" accept=".xls,.xlsx" style="display:none" >');
    $("#div_upload").after(upload);
    upload.trigger('click');
}

$(document).on("change", "#bf_file", function(e) {
    fnFileUpload(e, this);
});

function fnFileUpload(e, el) {
    let formData = new FormData();
    let excelfile = e.target.files[0];
    if (excelfile == null) {
        alert("등록된 파일이 없습니다.");
        return;
    }
    formData.append("excel_file", excelfile);
    upload.val('');

    alert("잠시만 기다려주세요. 업로드 중입니다.");
    setTimeout(function() {
        $.ajax({
            type: 'POST',
            url: "./pstore.list.upload.php",
            processData: false,
            contentType: false,
            data: formData,
            success: function(data) {
                if (data == "") {
                    alert("완료 되었습니다. 2초 후 자동으로 새로고침 합니다.");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    alert(data);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    }, 1000);
}
</script>

<?
include_once('./_tail.php');
?>

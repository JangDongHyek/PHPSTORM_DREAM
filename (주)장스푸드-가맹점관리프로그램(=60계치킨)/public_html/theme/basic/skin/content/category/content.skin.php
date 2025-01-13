<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);


$len = strlen($ca_id);
if ($len == 10)
	alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

$len2 = $len + 1;

$sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from g5_category
		  where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
$row = sql_fetch($sql);

$subid = base_convert($row['max_subid'], 36, 10);
$subid += 36;
if ($subid >= 36 * 36)
{
	//alert("분류를 더 이상 추가할 수 없습니다.");
	// 빈상태로
	$subid = "  ";
}
$subid = base_convert($subid, 10, 36);
$subid = substr("00" . $subid, -2);
$subid = $ca_id . $subid;

$list_sql = " select * from g5_category order by ca_order desc, ca_idx asc ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);
?>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<div id="category_add_box">
		<label style="display:inline; margin:0;">상품분류 추가(분류명) : </label>
		<input type="hidden" name="ca_id" id="ca_id" value="<?php echo $subid ?>">
		<input type="text" name="ca_name" id="ca_name" class="add_text" value="">
		<input class="btn_submit" type="button" value="분류 추가">
	</div>

	<form method="post" name="ca_frm" action="<?php echo G5_BBS_URL ?>/category_list_update.php">
	<input type="hidden" name="mode" id="mode" value="">
		<table class="list_tbl">
		<thead>
		<tr>
			<th class="list_th x130">선택</th>
			<th class="list_th">상품 분류명</th>
			<th class="list_th x200">등록 상품수</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if($list_num > 0){
			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);

				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';
		?>
		<tr>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<input type="hidden" name="ca_idx[]" value="<?php echo $list_row['ca_idx'] ?>">
				<input type="checkbox" name="ca_chk[]" class="ca_chk" value="<?php echo $l ?>">
			</td>
			<td class="list_td <?php echo $td_bg ?>">
				<div style="padding-left:15px; padding-right:15px;">
					<input type="text" name="ca_name[]" class="list_text" value="<?php echo $list_row['ca_name'] ?>">
				</div>
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
			<?php
			$it_cnt_sql = " select count(*) as cnt from g5_write_item where wr_10='{$list_row['ca_idx']}' ";
			$it_cnt_row = sql_fetch($it_cnt_sql);
			echo $it_cnt_row['cnt'].' 개';
			?>
			</td>
		</tr>
		<?php
			}
		}
		?>
		</tbody>
		</table>
	</form>

	<div style="padding:15px 0px;">
		<input type="button" id="edit_btn" value="선택수정">
		<input type="button" id="del_btn" value="선택삭제">
	</div>
</div>

<script>
$(function(){
	$("#ca_name").keydown(function (key) {
		if(key.keyCode == 13){	//키가 13이면 실행 (엔터는 13)
			$(".btn_submit").click();
		}
	});


	$(".btn_submit").on('click', function(){
		if($("#ca_name").val() == ''){
			alert('분류명을 입력해주세요');
			$("#ca_name").focus();
			return false;
		}

		var ca_id_val = $("#ca_id").val();
		var ca_name_val = $("#ca_name").val();

		$(".btn_submit").css('display','none');

		$.ajax({
			type: "POST",
			url: "<?php echo G5_BBS_URL ?>/category_add.php",
			data: { ca_id: ca_id_val, ca_name: ca_name_val },
			success:function( datas ) {
				if(datas == 'success'){
					alert('상품분류가 추가되었습니다!');
				}else if(datas == 'fail'){
					alert('상품분류 추가에 실패하였습니다.');
				}else if(datas == 'used_fail'){
					alert('중복된 상품분류입니다.');
				}else if(datas == 'name_fail'){
					alert('분류명을 입력해주세요.');
				}else{
					alert('실패하였습니다!');
				}
				location.reload();
			}
		});
	});


	$("#del_btn").on('click', function(){
		if($(".ca_chk").is(":checked") == false){
			alert('삭제할 분류를 선택(체크)해주세요');
			return false;
		}

		if(confirm("정말 삭제하시겠습니까?")){
			$("#mode").val('del');
			document.ca_frm.submit();
		}
	});

	$("#edit_btn").on('click', function(){
		if($(".ca_chk").is(":checked") == false){
			alert('수정할 분류를 선택(체크)해주세요');
			return false;
		}

		$("#mode").val('edit');
		document.ca_frm.submit();
	});
});
</script>


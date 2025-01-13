<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);

$list_sql = " select * from g5_delivery order by de_order desc, de_idx asc ";
$list_qry = sql_query($list_sql);
$list_num = sql_num_rows($list_qry);
?>

<div id="category_container">
	<h2 id="category_title"><?php echo $g5['title']; ?></h2>

	<form method="post" name="delivery_frm" action="<?php echo G5_BBS_URL ?>/delivery_write_update.php">
	<input type="hidden" name="mode" id="mode" value="">

		<table class="list_tbl">
		<thead>
		<tr>
			<th class="list_th x180">택배사명</th>
			<th class="list_th">배송조회 URL</th>
			<th class="list_th x120">삭제</th>
		</tr>
		</thead>
		<tbody id="delivery_tbody">
		<?php
		if($list_num > 0){
			for($l=0; $l<$list_num; $l++){
				$list_row = sql_fetch_array($list_qry);

				$td_bg = '';
				if($l%2 == 0) $td_bg = 'td_bg';
		?>
		<tr>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<input type="hidden" name="de_idx[]" class="de_idx" value="<?php echo $list_row['de_idx'] ?>">
				<input type="text" name="de_name[]" class="de_name list_text" value="<?php echo $list_row['de_name'] ?>">
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<input type="text" name="de_url[]" class="de_url list_text" value="<?php echo $list_row['de_url'] ?>">
			</td>
			<td class="list_td talgin_c <?php echo $td_bg ?>">
				<input type="button" class="del_btn" value="선택삭제" onclick="del_act(this)">
			</td>
		</tr>
		<?php
			}
		}
		?>
		</tbody>
		</table>
		
		<div>
			<a id="add_form">추가</a>
		</div>

		<div style="padding:15px 0px; text-align:center;">
			<input type="button" id="edit_btn" value="저장하기">
		</div>

	</form>
</div>

<script>
$(function(){
	$("#add_form").on('click', function(){
		var cnt = $("#delivery_tbody tr").size();
		var td_bg = '';
		if(cnt%2 == 0) td_bg = 'td_bg';
		var datas = '';
		datas += '<tr>';
		datas += '<td class="list_td talgin_c '+td_bg+'">';
		datas += '<input type="hidden" name="de_idx[]" class="de_idx" value="">';
		datas += '<input type="text" name="de_name[]" class="list_text de_name" value="">';
		datas += '</td>';
		datas += '<td class="list_td talgin_c '+td_bg+'">';
		datas += '<input type="text" name="de_url[]" class="list_text de_url" value="http://">';
		datas += '</td>';
		datas += '<td class="list_td talgin_c '+td_bg+'">';
		datas += '<input type="button" class="del_btn" value="선택삭제" onclick="del_act(this)">';
		datas += '</td>';
		datas += '</tr>';

		$("#delivery_tbody").append(datas);
	});


	$("#edit_btn").on('click', function(){
		var $de_name = $(".de_name");
		if($de_name.length > 0){
			for(var i=0; i<$de_name.length; i++){
				if($de_name.eq(i).val() == ''){
					alert('택배사명을 입력해주세요');
					return false;
				}

				document.delivery_frm.submit();
			}
		}else{
			alert('배송업체를 추가해주세요!');
			return false;
		}
	});
});


function del_act(obj){
	var _idx = $(".del_btn").index(obj);
	$("#delivery_tbody tr").eq(_idx).remove();
}
</script>


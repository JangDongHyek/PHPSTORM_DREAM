<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta http-equiv="imagetoolbar" content="no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_URL ?>/js/jquery-1.12.4.min.js"></script>
</head>
<body>

<div style="margin:0; padding:0 0; width:100%;">
	<h2 style="margin:0; padding:15px 15px; font-size:18px;"><?php echo $g5['title'] ?></h2>

	<div style="margin:0; padding:15px 15px;">
		<table style="margin:0; padding:0 0; width:100%; border-collapse:collapse;">
		<thead>
		<tr>
			<th style="margin:0; padding: 5px 5px; border:1px solid #d2d2d2; background:#f7f7f7; font-size:12px; width:130px;">아이디</th>
			<th style="margin:0; padding: 5px 5px; border:1px solid #d2d2d2; background:#f7f7f7; font-size:12px; width:130px;">이름</th>
			<th style="margin:0; padding: 5px 5px; border:1px solid #d2d2d2; background:#f7f7f7; font-size:12px;"></th>
		</tr>
		</thead>
		<tbody>
		<?php
		$mem_sql = " select * from g5_member where mb_level='3' order by mb_name asc ";
		$mem_qry = sql_query($mem_sql);
		$mem_num = sql_num_rows($mem_qry);
		if($mem_num > 0){
			for($i=0; $i<$mem_num; $i++){
				$mem_row = sql_fetch_array($mem_qry);
		?>
		<tr>
			<td style="margin:0; padding:5px 5px; border:1px solid #d2d2d2;"><span style="font-size:13px;"><?php echo $mem_row['mb_id'] ?></span></td>
			<td style="margin:0; padding:5px 5px; border:1px solid #d2d2d2;"><span style="font-size:13px;"><?php echo $mem_row['mb_name'] ?></span></td>
			<td style="margin:0; padding:5px 5px; border:1px solid #d2d2d2; text-align:center;">
				<input type="hidden" class="mb_id" value="<?php echo $mem_row['mb_id'] ?>">
				<input type="hidden" class="mb_name" value="<?php echo $mem_row['mb_name'] ?>">
				<a class="add_btn" style="display:inline-block; margin:0; padding:4px 6px; background:#000; color:#fff; font-size:12px; border:1px solid #000; border-radius:3px; cursor:pointer;">선택</a>
			</td>
		</tr>
		<?php
			}
		}
		?>
		<tr>
		</tr>
		</tbody>
		</table>
	</div>
</div>

<script>
$(function(){
	$(".add_btn").on('click', function(){
		var _idx = $(".add_btn").index(this);
		var mb_id = $(".mb_id").eq(_idx).val();
		var mb_name = $(".mb_name").eq(_idx).val();

		$("#ic_mb_id",opener.document).val(mb_id);
		$("#ic_span",opener.document).html(mb_id+' [담당자명 : '+mb_name+']');

		window.close();
	});
});
</script>

</body>
</html>
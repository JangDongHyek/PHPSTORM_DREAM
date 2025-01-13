<?php
$od_sql = " select * from g5_order where od_idx='{$od_idx}' ";
$od_row = sql_fetch($od_sql);

$od_tel_arr = explode('-', $od_row['od_tel']);
$od_hp_arr = explode('-', $od_row['od_hp']);

$ct_sql = " select * from g5_cart where od_idx='{$od_idx}' and it_bo_table='item' and ct_status!='대기' order by ct_idx desc ";
$ct_qry = sql_query($ct_sql);
$ct_num = sql_num_rows($ct_qry);
if($ct_num > 0){
?>
<table class="od_tbl">
<thead>
<tr>
	<th class="od_head_th x180">이미지</th>
	<th class="od_head_th">주문상품</th>
	<th class="od_head_th x160">판매가격</th>
	<th class="od_head_th x110">배송비</th>
</tr>
</thead>
<tbody>
<?php
for($ct=0; $ct<$ct_num; $ct++){
	$ct_row = sql_fetch_array($ct_qry);
?>
<tr>
	<td class="od_body_td talgin_c">
		<?php if($ct_row['it_img'] != ''){ ?><img src="<?php echo $ct_row['it_img'] ?>" border="0" width="160" /><?php } ?>
	</td>
	<td class="od_body_td">
		<div class="opt_name_text"><?php echo $ct_row['it_name'] ?></div>

		<?php
		if($ct_row['opt_cnt'] > 0){
			$opt_sql = " select * from g5_cart_opt where ct_idx='{$ct_row['ct_idx']}' order by opt_sort asc ";
			$opt_qry = sql_query($opt_sql);
			$opt_num = sql_num_rows($opt_qry);

			for($o=0; $o<$opt_num; $o++){
				$opt_row = sql_fetch_array($opt_qry);
		?>
		<div class="opt_container">
			<table>
			<tbody>
			<tr>
				<td style="width:420px;">
				<?php
				if($opt_row['opt1_value'] != ''){
					$opt1_value_arr = explode('|',$opt_row['opt1_value']);
					echo '<div>';
					if($opt1_value_arr[3] != '') echo $opt1_value_arr[3].' : ';
					if($opt1_value_arr[1] != '') echo $opt1_value_arr[1];
					echo '</div>';
				}
				
				if($opt_row['opt2_value'] != ''){
					$opt1_value_arr = explode('|',$opt_row['opt1_value']);
					echo '<div>';
					if($opt2_value_arr[3] != '') echo $opt2_value_arr[3].' : ';
					if($opt2_value_arr[1] != '') echo $opt2_value_arr[1];
					echo '</div>';
				}

				if($opt_row['opt3_value'] != ''){
					$opt1_value_arr = explode('|',$opt_row['opt1_value']);
					echo '<div>';
					if($opt3_value_arr[3] != '') echo $opt3_value_arr[3].' : ';
					if($opt3_value_arr[1] != '') echo $opt3_value_arr[1];
					echo '</div>';
				}
				?>
				</td>
				<td><span class="quantity_text"><?php echo $opt_row['opt_quantity'] ?>개</span></td>
			</tr>
			</tbody>
			</table>
		</div>
		<?php
			}
		}
		?>
	</td>
	<td class="od_body_td talgin_r"><span class="opt_tot_price_text"><?php echo number_format($ct_row['it_tot_price']) ?>원</span></td>
	<td class="od_body_td talgin_r"><span class="fee_text"><?php echo number_format($ct_row['it_fee']) ?>원</span></td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
}
?>

<div class="design_title">자세히 보시려면 이미지를 클릭하세요.</div>
<div class="design_img_box">
	<?php
	if($od_row['design_file'] != ''){
	?>
	<a onclick="window.open('<?php echo G5_BBS_URL ?>/view_image2.php?fn=<?php echo urlencode($od_row['design_file']) ?>','design_file','width=400,height=400')"><img src="<?php echo G5_DATA_URL ?>/design_file/<?php echo $od_row['design_file'] ?>" style="width:200px; cursor:pointer;"></a>
	<?php
	}
	?>
</div>

<? if ($od_row['design_ok'] != '검토완료') { ?>
<div class="design_title">수정요청 : 1회만 가능하며, 지정된 부분 회 수정은 불가능합니다.</div>
<div id="review_container">
	<div style="margin:0; padding:0px 0px 15px 0px;">
	* 글자 오타 또는 중요변경사항만 수정 반영 가능하며, 전반적인 디자인 수정은 불가능합니다.<br>
	* 수정내용이 없으시면 검토완료 버튼을 클릭해주세요.
	</div>
	<div>
		<form method="post" name="edit_frm" action="<?php echo G5_BBS_URL ?>/design_update.php">
		<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
		<input type="hidden" name="od_idx" value="<?php echo $od_idx ?>">
		<input type="hidden" name="mode" value="<?php echo $mode ?>">
			<textarea name="edit_post" style="margin:0; padding:5px 5px; width:100%; height:200px; border:1px solid #ccc;" <?php if($member['mb_level'] > 2) echo 'readonly'; ?>><?php echo $od_row['edit_post'] ?></textarea>
		</form>
	</div>
</div>

<div style="margin:40px auto; text-align:center;">
	<?php if($member['mb_level'] < 3){ ?>
		<?php if($od_row['design_check_cnt'] < 1){ ?><input type="submit" id="edit_btn" value="수정요청"><?php } ?>
		<?php if($od_row['design_ok'] != '검토완료' && $od_row['edit_check'] != '수정요청'){ ?><input type="button" id="success_btn" value="검토완료"><?php } ?>
	<?php } ?>
</div>

<form method="post" name="success_frm" action="<?php echo G5_BBS_URL ?>/design_success.php">
<input type="hidden" name="co_id" value="<?php echo $co_id ?>">
<input type="hidden" name="od_idx" value="<?php echo $od_idx ?>">
<input type="hidden" name="mode" value="<?php echo $mode ?>">
</form>

<? } else { ?>
<div class="design_title">검토완료 된 시안입니다.</div>

<? } ?>

<script>
$(function(){
	$("#edit_btn").on('click', function(){
		if(document.edit_frm.edit_post.value == ''){
			alert('수정내용을 입력해주세요');
			document.edit_frm.edit_post.focus();
			return false;
		}

		document.edit_frm.submit();
	});

	$("#success_btn").on('click', function(){
		if(confirm('검토완료를 하시겠습니까?')){
			document.success_frm.submit();
		}else{
			return false;
		}
	});
});
</script>
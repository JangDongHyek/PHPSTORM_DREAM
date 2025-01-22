<?php
$sub_menu = '400400';
include_once('./_common.php');

$cart_title3 = '주문번호';
$cart_title4 = '배송완료';

auth_check($auth[$sub_menu], "w");

$g5['title'] = "주문 내역 수정";
include_once(G5_PATH.'/head.sub.php');
// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
?>
<form method="post" action="./popup_apartment_update.php" name="form" enctype="multipart/form-data">
<table class="table">
	<thead>
		<tr>
			<th align="center">번호</th>
			<th align="center">아파트단지명</th>
			<th align="center">사진</th>
			<th align="center">
				<button onclick="addApartment()" type="button" class="btn btn-primary">추가</button>
			</th>
		</tr>
	</thead>
	<tbody id="apartment-list">
		<?php
			$sql="select * from apartment ";
			$result=sql_query($sql);
			for($i=0;$row=sql_fetch_array($result);$i++){
		?>
		<input type="hidden" name="idx[]" value="<?php echo $row[idx]?>">
		<tr>
			<td align="center"><?php echo $i+1?></td>
			<td align="center"><input type="text" name="apartment_name[]" value="<?php echo $row[apartment_name]?>" class="form-control" required></td>
			<td align="center">
				<?php
					if($row[apartment_photo]){
				?>
				<input type="hidden" name="old_apartment_photo[<?php echo $i?>]" value="<?php echo $row[apartment_photo]?>">
				<img src="<?php echo G5_DATA_URL?>/apartment/<?php echo $row[apartment_photo]?>" width="100">
				<input type="checkbox" name="photo_remove[<?php echo $i?>]" value="1" id="photo_remove<?php echo $i?>"><label for="photo_remove<?php echo $i?>">삭제</label>
				<br/>
				<?php }?>
				<input type="file" name="apartment_photo[]">
			</td>
			<td align="center">
				<?php echo $row[is_view]=="N"?"삭제됨":"";?>
				<button type="button" onclick="apartmentRemove('<?php echo $row[idx]?>','<?php echo $row[apartment_name]?>',this)"><?php echo $row[is_view]=="Y"?"삭제하기":"복구하기"?></button>
			</td>
		</tr>
		<?php }?>
		<tr>
			<td align="center"><?php echo $i+1?></td>
			<td align="center">
				<input type="text" name="apartment_name[]" value="" class="form-control">
			</td>
			<td align="center">
				<input type="file" name="apartment_photo[]" value="" class="form-control">
			</td>
			<td align="center"></td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="3" align="center"><button>확인</button></td>
		</tr>
	</tbody>
</table>
</form>


<script type="text/javascript">
	function addApartment(){
		let no = $("#apartment-list").find("tr").length+1;
		let strHtml='<tr>'+
			'<td align="center">'+no+'</td>'+
			'<td align="center"><input type="text" name="apartment_name[]" value="" class="form-control"></td>'+
			'<td align="center">'+
				'<input type="file" name="apartment_photo[]" value="" class="form-control">'+
			'</td>'+
			'<td align="center"></td>'+
		'</tr>';
		$("#apartment-list").append(strHtml);
	}
	function apartmentRemove(idx,name,t){
		let msg = t.innerHTML=="삭제하기"?"삭제하시겠습니까?":"복구하시겠습니까?";
		let is_view = t.innerHTML=="삭제하기"?"N":"Y";
		if(confirm(`${name}을 ${msg}`)){
			location.href=`./popup_apartment_remove.php?idx=${idx}&is_view=${is_view}`;
		}
	}
</script>
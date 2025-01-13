<?php
include_once('./_common.php');

$result = sql_query(" select * from g5_shop_item_option_save order by is_no asc; ");
?>
<html>
<head>
<link rel="stylesheet" href="<?php echo G5_ADMIN_URL?>/css/admin.css">
</head>
<body>

<?php if($it_id){ ?>
<div class="sit_option tbl_frm01" style="padding-bottom:10px;">
<form name="fitemform" action="./itemoptionsaveformupdate.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">
	<input type="hidden" name="w" value=""> 
	<input type="hidden" name="it_id" value="<?php echo $it_id?>">
	<input type="text" name="is_name" class="frm_input" value="" placeholder="옵션명" required >
	<input type="submit" value="옵션 추가" class="btn_frmline">
</form>
</div>
<?php } ?>
<form name="fitemform" action="./itemoptionsaveformupdate.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">
	<input type="hidden" name="w" value="u"> 
	<div class="sit_option tbl_frm01" style="padding-bottom:10px;">
	<table>
		<caption>상품옵션</caption>
		<colgroup>
			<col class="grid_2"></col>
			<col class="grid_8"></col>
			<col class="grid_2"></col>
		</colgroup>
		<thead>
			<tr>
				<th scope="row" style="background:#D6DDE1; padding:10px; text-align:center;">번호</th>
				<th scope="row" style="background:#D6DDE1; padding:10px; text-align:center;">옵션명</th>
				<th scope="row" style="background:#D6DDE1; padding:10px; text-align:center;">상태</th>
			</tr>
		</thead>
		<tbody>
			<?php for($i=0; $i<$opt=sql_fetch_array($result); $i++){ ?>
			<tr>
				<td style="padding:5px; text-align:center;">
					<?php echo ($i+1)?>
					<input type="hidden" name="it_id[]" value="<?php echo $opt['it_id']; ?>">
					<input type="hidden" name="is_no[]" value="<?php echo $opt['is_no']; ?>">
				</td>
				<td style="padding:5px; text-align:center;"><input type="text" name="is_name[]" value="<?php echo $opt['is_name']; ?>" class="frm_input" style="width:100%;"></td>
				<td style="padding:5px; text-align:center;"><input type="button" value="삭제" onclick="delCheck('<?php echo $opt['is_no']?>')" class="btn_frmline"></td>
			</tr>
			<?php } ?>

			<?php if($i==0){ ?><tr><td colspan="3" style="padding:5px; text-align:center;"> 저장된 옵션이 없습니다. </td></tr><?php } ?>
		</tbody>
	</table>
	<input type="submit" value="수정" class="btn_frmline" style="margin-top:5px;">
	</div>
</form>

<script>
function fitemformcheck(f){
	if(f.it_id.value==""){
		alert("저장할 옵션 ID 정보가 없습니다.");
		return false;
	}

	if(f.is_name.value==""){
		alert("저장할 옵션 명을 입력해주세요.");
		return false;
	}

	return true;
}

function delCheck(is_no){
	if(confirm('정말 삭제하시겠습니까?')==false){
		return false;
	}else{
		location.href="./itemoptionsaveformupdate.php?w=d&is_no="+is_no;
	}
}

</script>
</body>
</html>
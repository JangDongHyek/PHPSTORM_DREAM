<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

include( '../../market/include/getmartinfo.php' );
	
//회원정보를 호출
if($UnameSess){
	$mem_sql = "select * from $Mart_Member_NewTable where username='$UnameSess' and mart_id='$mart_id'";
	$mem_res = mysql_query($mem_sql, $dbconn);
	$mem_tot = mysql_num_rows($mem_res);

	$mem_row = mysql_fetch_array($mem_res);
	$name = $mem_row[name];
	$email = $mem_row[email];
	$passport1 = $mem_row[passport1];
	$passport2 = $mem_row[passport2];
	$buyer_tel = $mem_row[tel];
	$buyer_tel1 = $mem_row[tel1];
	$buyer_zip = $mem_row[zip];
	$buyer_address = $mem_row[address];
	$buyer_address_d = $mem_row[address_d];
	$date = $mem_row[date];
	$partner = $mem_row[partner];
}

$sql=" select * from send_name where mb_id = '$UnameSess' order by mb_datetime desc ";
$result = mysql_query($sql);

?>
<meta charset="euc-kr" />
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=no;">
<link rel="stylesheet" type="text/css" href="../css/m_style.css" />
<style>
.tbl table{border-top:1px solid #ccc;}
.tbl tr th, .tbl tr td{padding:5px 3px;}
.tbl tr th{border-bottom:1px solid #CCC; background:#EFEFEF; font-weight:bold;}
.tbl tr td{ text-align:center;}
.tbl tr td .btn{display:inline-block; font-size:11px; padding:2px 3px; background:#fff; color:#333; border:1px solid #ccc; border-radius:3px;}
.btn_submit{background: linear-gradient(#fff, #E3E3E3); padding:4px 10px; box-sizing:border-box; border:1px solid #ccc; border-radius:5px;}
</style>
<div class="tbl">
<table cellpadding="0" cellspacing="0" style="width:100%;">
	<tr>
		<th colspan="3" class="tit">
			보내는분 이름
		</th>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center;padding:10px;">
			<form name="matching" id="matching" action="./pop_name_update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="mb_id" id="mb_id" value="<?=$_GET['mb_id']?>">
				<input type="hidden" name="mode" id="mode" value="insert">
				<div class="tbl_frm_mb tbl_wrap">
					<input type="text" name="mb_name" id="mb_name_add" value="" class="frm_input required" style="width:65%;"  required>	
					<input type="submit" value="등록하기" class="btn_submit" style="width:30%;">
				</div>
			</form>
		</td>
	</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" style="width:100%;">
	<tr>
		<th>번호</th>
		<th>이름</th>
		<th>관리</th>
	</tr>
	<?for ($i=0; $row=mysql_fetch_array($result); $i++) {?>
	<tr>
		<td><?=$i +1?></td>
		<td>			
			<input type="text" name="send_name<?=$row['idx']?>" id="send_name<?=$row['idx']?>" value="<?=$row['mb_name']?>" style="width:90%;"> 
		</td>
		<td>
			<a href="javascript:void(0);" onclick="name_select(<?=$row['idx']?>);" class="btn">선택</a>
			<a href="javascript:void(0);" onclick="name_update(<?=$row['idx']?>);" class="btn">수정</a>
			<a href="javascript:void(0);" onclick="name_delete(<?=$row['idx']?>);" class="btn">삭제</a>			
		</td>
	</tr>
	<?}//for문 끝?>
</table>

</div>
<br /><br />

<div style="width:100%;text-align:center;">
	<input type="button" name="btn_close" class="btn_submit" value="닫기" onclick="javascript:window.close();">
</div>

<script>
function name_select(wr_id){
	var mb_name = document.getElementById("send_name" + wr_id).value;

	opener.document.getElementById("send_name").value = mb_name;
	window.close();
}

function name_update(wr_id){
	if (!confirm("수정하시겠습니까?")){
		return false;
	}
	
	var mb_name = document.getElementById("send_name" + wr_id).value;

	location.href = "./pop_name_update.php?mode=update&idx="+wr_id+"&mb_id=<?=$UnameSess?>&mb_name="+mb_name+"";	
}

function name_delete(wr_id){
	if (!confirm("삭제하시겠습니까?")){
		return false;
	}

	location.href = "./pop_name_update.php?mode=delete&idx="+wr_id+"&mb_id=<?=$UnameSess?>";
}
</script>
<?
mysql_close($dbconn);
?>

<?php
include_once("../../../common.php");
?>
<meta content="application/vnd.ms-excel; charset=UTF-8" name="Content-type">
<?php
$sql = " SELECT * FROM `g5_write_counsel_book` WHERE b_wr_id='{$b_wr_id}' ORDER BY b_idx DESC ";
$result = sql_query($sql);
$numb = sql_num_rows($result);

$sql2 = " SELECT * FROM `g5_write_counsel` WHERE wr_id='{$b_wr_id}' LIMIT 1 ";
$result2 = sql_query($sql2);
$row2 = sql_fetch_array($result2);

$wr_6 = $row2['wr_6'];
$wr_7 = $row2['wr_7'];
$wr_8 = $row2['wr_8'];
$wr_9 = $row2['wr_9'];

if($wr_6 < 10) $wr_6 = '0'.$wr_6;
if($wr_7 < 10) $wr_7 = '0'.$wr_7;
if($wr_8 < 10) $wr_8 = '0'.$wr_8;
if($wr_9 < 10) $wr_9 = '0'.$wr_9;

$excel_file_name = iconv('utf-8','euc-kr',$row2['wr_5'].'_'.$row2['wr_subject'].'.xls');

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = {$excel_file_name}" );
header( "Content-Description: PHP4 Generated Data" );

if($numb <= 0){
?>

<table style="margin:0; padding:0px 0px;">
<tbody>
<tr>
	<td colspan="5" width="500" align="center" style="padding:5px 5px;">해당 정보에는 예약된 상담이 없습니다.</td>
</tr>
</tbody>
</table>

<?php
}else{
?>
<table style="margin:0; padding:0px 0px;">
<thead>
<tr>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">프로그램명</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">예약날짜</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">예약자명</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">대상</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">학교</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">학년</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">휴대폰번호</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center; font-weight:bold; background-color:#dbdbdb;">이메일</td>
</tr>
</thead>
<tbody>
<?php
	for($i=0; $i<$numb; $i++){
		$row = sql_fetch_array($result);
?>
<tr>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row2['wr_subject']; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;">
	<?php echo $row2['wr_5'].'&nbsp;&nbsp;'.$wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9; ?>
	</td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row['b_name']; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row2['wr_content']; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row['b_school']; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row['b_class'].'학년'; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row['b_tel']; ?></td>
	<td style="margin:0; padding:5px 5px; border:1px solid #000; text-align:center;"><?php echo $row['b_email']; ?></td>
</tr>
<?php
	}
}
?>
</tbody>
</table>
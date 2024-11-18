<?php
include_once('./_common.php');

$th = array("번호","이벤트명","휴대폰번호","신청일시");
$excel_title = iconv("utf-8","euc-kr","60계치킨 이벤트참여 리스트");

$excel_title_file = $excel_title."_".G5_TIME_YMD;

$bo_table = " g5_write_event_join ";

//글갯수
$sql = " select count(*) as cnt from {$bo_table} ";
$res_cnt = sql_fetch($sql);

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename={$excel_title_file}.xls");
header( "Content-Description: PHP4 Generated Data" );
print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body> 
<table cellspacing='0' cellpadding='2' border='0' bordercolor='black'>
	<tr>
		<td colspan="<?php echo count($th); ?>" style="font-weight:bolder;font-size:18pt; text-align:center;">
			<?=iconv("euc-kr","utf-8",$excel_title)?>(<?=G5_TIME_YMD?>)
		</td>
	</tr>
</table>

<br />

<table cellspacing='0' cellpadding='2' border='1' bordercolor='black'>
	<tr>
		<td colspan="<?php echo count($th); ?>" style="font-size:10pt; text-align:left;">
			총 신청수 <?=$res_cnt['cnt']?> 건
		</td>
	</tr>
	<tr> 
		<?php for($i=0; $i<count($th); $i++){ ?>
		<th style="background:#E5ECEF;color:#383838;font-weight:bolder;font-size:10pt;"><?php echo $th[$i]; ?></th>
		<?php } ?>
	</tr>

	<!-- 테이블 g5_write_event_join 시작 -->
	<?								
		$sql = " select * from {$bo_table} order by wr_datetime desc";
		$res = sql_query($sql);		

		for($i=0; $i<$row=sql_fetch_array($res); $i++){	
	?>
	<tr>
		<td style="text-align:center;"><?=$res_cnt['cnt']--;?></td><!-- 번호 -->
		<td style="text-align:center;"><?=$row['wr_1']?></td><!-- 이벤트명 -->
		<td style="text-align:center;mso-number-format:\@;"><?=$row['wr_2']?></td><!-- 휴대폰번호 -->
		<td style="text-align:center;"><?=$row['wr_datetime']?></td><!-- 신청일시 -->
	</tr>
	<?php 
		}
	?><!-- for문 끝 --> 

	<!-- 테이블 g5_write_event_join 끝 -->	
</table>
</body>
</html>


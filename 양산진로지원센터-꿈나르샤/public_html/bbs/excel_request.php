<?php
include_once('./_common.php');

$th = array("번호","부스명","이름","성별","연락처","이메일","학교","학년","비고","신청일시","오전/오후");
$excel_title = iconv("utf-8","euc-kr","박람회 신청리스트");

$excel_title_file = $excel_title."_".G5_TIME_YMD;

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
			총 <?=number_format($cnt)?>건 중, 다중지능검사관 <?=number_format($cnt1)?>건 | 홀랜드검사관 <?=number_format($cnt2)?>건 | 성격카드탐색관 <?=number_format($cnt3)?>건 | 취업대비상담관 <?=number_format($cnt4)?>건 | 모의면접관 <?=number_format($cnt5)?>건 | 학종상담관 <?=number_format($cnt6)?>건 | 자원봉사자 <?=number_format($cnt7)?>건
		</td>
	</tr>
	<tr> 
		<?php for($i=0; $i<count($th); $i++){ ?>
		<th style="background:#E5ECEF;color:#383838;font-weight:bolder;font-size:10pt;"><?php echo $th[$i]; ?></th>
		<?php } ?>
	</tr>

	<!-- 신청내역 시작 -->
	<?				
		//아이디 폰번호 검색
		if($sfl && $stx){
			$sql_search .= " and ( ";
			
			if($sfl == "wr_name"){//성명
				$sql_search .= " wr_name like '%{$stx}%' ";
			}else if($sfl == "wr_email"){//이메일
				$sql_search .= " wr_email like '%{$stx}%' ";
			}
			$sql_search .= " ) ";
		}

		//부스명 검색
		if($wr_cate){
			$sql_search .= " and ( ";
			$sql_search .= " wr_1 like '%{$wr_cate}%' ";
			$sql_search .= " ) ";
		}

		$bo_table = " g5_write_request ";
		$bo_table .= " where (1) {$sql_search} ";

		$sql = " select * from {$bo_table} order by wr_datetime desc";	
		$res = sql_query($sql);

		//글갯수
		$sql = " select count(*) as cnt from {$bo_table} ";
		$res_cnt = sql_fetch($sql);

		for($i=0; $i<$row = sql_fetch_array($res); $i++){

	?>
	<tr>
		<td style="font-size:10pt; text-align:center;"><?=$res_cnt['cnt']--;?></td><!-- 번호 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_1']?></td><!-- 부스명 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_name']?></td><!-- 이름 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_2']?></td><!-- 성별 -->
		<td style="font-size:10pt; text-align:center; mso-number-format:'\@';"><?=$row['wr_3']?></td><!-- 연락처 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_email']?></td><!-- 이메일 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_4']?></td><!-- 학교 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_5']?></td><!-- 학년 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_content']?></td><!-- 비고 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_datetime']?></td><!-- 신청일시 -->
		<td style="font-size:10pt; text-align:center;"><?=$row['wr_6']?></td><!-- 오전/오후 -->
	</tr>
	<?php }?><!-- for문 끝 --> 
</table>
</body>
</html>


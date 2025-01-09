<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($mode == 'book'){
	include_once("$board_skin_path/book.php");
}else if($mode == 'identify'){
	include_once("$board_skin_path/identify.php");
}else if($mode == 'identify_adm'){
	include_once("$board_skin_path/identify_adm.php");
}else{

include_once("$board_skin_path/moonday.php"); // 석봉운님의 음력날짜 함수

if (eregi('%', $width)) {
  $col_width = "14%"; //표의 가로 폭이 100보다 크면 픽셀값입력
} else{
  $col_width = round($width/7); //표의 가로 폭이 100보다 작거나 같으면 백분율 값을 입력
}
$col_height= 80 ;//내용 들어갈 사각공간의 세로길이를 가로 폭과 같도록
$today = getdate(); 
$b_mon = $today['mon']; 
$b_day = $today['mday']; 
$b_year = $today['year']; 
if ($year < 1) { // 오늘의 달력 일때
  $month = $b_mon;
  $mday = $b_day;
  $year = $b_year;
}

if(!$year) 	$year = date("Y");
$file_index = $board_skin_path."/day"; ### 기념일 폴더 위치 지정

### 양력 기념일 파일 지정 : 해당년도 파일이 없으면 기본파일(solar.txt)을 불러온다
if(file_exists($file_index."/".$year.".txt")) {
	$dayfile = file($file_index."/".$year.".txt");
} else { 
	$dayfile = file($file_index."/solar.txt");
}

$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
if ($year%4 == 0) $lastday[2] = 29;
$dayoftheweek = date("w", mktime (0,0,0,$month,1,$year));
?>
<style>
/*카운셀링*/
#programText{letter-spacing:-1px;}
#programText .counselimg{ width:100%; height:auto;}
#programText h2{ background:url(../img/subicon.jpg) no-repeat 1px top; font-weight:bold; color:#000; font-size:20px; overflow:hidden; padding-top:10px; line-height:30px;}
#programText .subtext{ font-size:15px; color:#333; display:block; font-weight:500; line-height:24px; letter-spacing:-1px;}
#programText .subtext span{color:#de3d18;}
.style1 {color: #de3d18}
</style>
<div id="programText">
<div class="counselimg"><img src="<?php echo G5_URL; ?>/img/counselimg.jpg" border=0 /></div><br>
        <h2>아래 상담일정표에서 센터방문상담을 선택하세요.</h2>
        <p class="subtext">
            - 청소년에게 진로 상담을 제공하며 학부모 동반도 가능합니다. <br>
            - 대상은 <span>양산시 소재 초(5학년이상),중,고</span> 학생입니다.<br>
            <!--- 상담은 아래의 사전 예약을 통해서만 가능합니다.--><br />
	   </p>
            <br />
			<p class="subtext">
           <strong>※ 상담예약시 유의사항</strong><br />
		   - 상담예약신청은 <span class="style1">상담희망일로부터 2주일 전까지 예약가능</span>하며, 그 이후 예약된 상담은 상담이 불가하오니 이점 양해 부탁드립니다.<br />
          - 상담예약 후 상담이 어려운 경우 <span class="style1">예약일 1주일 전 꼭 취소요청</span>을 하여 다른 학생에게 상담기회를 주시기 바랍니다.<br />
          - 사전취소요청 없이 무단으로 상담 <span class="style1">불참시 향후 센터 프로그램 참여시 불이익</span>을 당할 수 있습니다.
		  </p>
          <br>
          <br>
</div>
<link rel="stylesheet" href="<?php echo $board_skin_url ?>/style.css">
<?/*
<?php
$sel_mon = sprintf("%02d",$month);
$query = "SELECT * FROM $write_table WHERE wr_5 like '{$year}-{$sel_mon}%' and wr_1 ='1' ORDER BY wr_id ASC";
$result = sql_query($query);
?>

<section id="today_schedule">
<h3>이달의 공지</h3>
<div class="notice">
<?php for($i=0; $i<$row = sql_fetch_array($result); $i++){ ?>
	<dl>
		<?php if($is_admin){ ?>
		<a href="<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id'] ?>">
		<?php } ?>
		<?php if($is_admin){ ?>
			<?php echo $row['wr_subject']; ?>
		</a>
		<?php } ?>
	</dl>
<?php } ?>
<?php if($i==0){ ?>
	<dl>이달의 공지가 없습니다.</dl>
<?php } ?>
</div>
</section>
*/?>


<table width="<?=$width?>" border=0 cellpadding="0" cellspacing="0">
  <tr>
       <td width="20%" class="fg_title">&nbsp;</td>
       <td width="60%" height="30" align="center">
		<table border="0" cellspacing="5" cellpadding="0">
		<tr>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table."&"; ?><?if ($month == 1) { $year_pre=$year-1; $month_pre=$month; } else {$year_pre=$year-1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/y_prev.gif" border="0" alt="<?=$year_pre?>년"></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table."&"; ?><?if ($month == 1) { $year_pre=$year-1; $month_pre=12; } else {$year_pre=$year; $month_pre=$month-1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/m_prev.gif" border="0" alt="<?=$month_pre?>월"></a></td>
			<td style="padding:0 10px;font-size:18px;font-weight:bold;"><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table; ?>" title="오늘로" onfocus="this.blur()"><? echo ("$year".년."&nbsp;$month".월); ?></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table."&"; ?><?if ($month == 12) { $year_pre=$year+1; $month_pre=1; } else {$year_pre=$year; $month_pre=$month+1;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/m_next.gif" border="0" alt="<?=$month_pre?>월"></a></td>
			<td><a href="<?php echo $_SERVER[PHP_SELF]."?bo_table=".$bo_table."&"; ?><?if ($month == 12) { $year_pre=$year+1; $month_pre=$month; } else {$year_pre=$year+1; $month_pre=$month;} echo ("year=$year_pre&month=$month_pre&sc_no=$sc_no");?>"><img src="<?=$board_skin_url?>/img/y_next.gif" border="0" alt="<?=$year_pre?>년"></a></td>
		</tr>
		</table>			
	</td>
	<td width="20%" align="right">
        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin"><font color="#ffffff">관리자</font></a></li><?php } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02"><font color="#ffffff">일정추가</font></a></li><?php } ?>
        </ul>
        <?php } ?>
</td>
  </tr>
</table>

<div id="bo_list">
<table width="<?=$width?>" bgcolor="#cfcfcf" border="0" cellspacing="1" cellpadding="5">
<thead>
  <tr bgcolor="#fdfac2" align="center">     
	<th style="color:red">SUN</th>
	<th>MON</th>
	<th>TUE</th>
	<th>WED</th>
	<th>THU</th>
	<th>FRI</th>
	<th style="color:blue">SAT</th>
  </tr>
</thead>
<tbody>
<?
$cday = 1;
$sel_mon = sprintf("%02d",$month);
$j=0; // layer id

// 달력의 틀을 보여주는 부분
$temp = 7- (($lastday[$month]+$dayoftheweek)%7);

if ($temp == 7) $temp = 0;
	$lastcount = $lastday[$month]+$dayoftheweek + $temp;

$query = "SELECT * FROM $write_table WHERE wr_5 like '{$year}-{$sel_mon}%' and wr_1 !='1' ORDER BY wr_6 ASC";
$result = sql_query($query);

for($i=0; $i<$row=sql_fetch_array($result); $i++){
	$arr = (int)substr($row['wr_5'],8,2);
	
	$schedule[$arr][] = $row;
}

for ($iz = 1; $iz <= $lastcount; $iz++) { // 42번을 칠하게 된다.

	$bgcolor = "#ffffff";  // 쭉 흰색으로 칠하고
	if ($b_year==$year && $b_mon==$month && $b_day==$cday) $bgcolor = "#DEFADE";      //  "#DFFDDF"; // 오늘날짜 연두색으로 표기
	if (($iz%7) == 1) echo ("<tr>"); // 주당 7개씩 한쎌씩을 쌓는다.

	if ($dayoftheweek < $iz  &&  $iz <= $lastday[$month]+$dayoftheweek)	{
	// 전체 루프안에서 숫자가 들어가는 셀들만 해당됨
	// 즉 11월 달에서 1일부터 30 일까지만 해당

	$daytext = "$cday";   // $cday 는 숫자 예> 11월달은 1~ 30일 까지

	//$daytext 은 셀에 써질 날짜 숫자 넣을 공간
	$daycontcolor = "" ; 
	$daycolor = ""; 

	if ($iz%7 == 1) $daycolor = "red"; // 일요일
	if ($iz%7 == 0) $daycolor = "blue"; // 토요일

	// 여기까지 숫자와 들어갈 내용에 대한 변수들의 세팅이 끝나고 
	// 이제 여기 부터 직접 셀이 그려지면서 그 안에 내용이 들어 간다.
	echo ("<td width=$col_width height=$col_height bgcolor=$bgcolor valign=top>");

	$f_date = $year."-".sprintf("%02d",$month)."-".sprintf("%02d",$cday);

	// 기념일 파일 내용 비교위한 변수 선언, 월과 일을 두자리 포맷으로 고정
	if (strlen($month) == 1)	$monthp = "0".$month ;
	else						$monthp = $month ; 

	if (strlen($cday) == 1)		$cdayp = "0".$cday ;
	else						$cdayp = $cday ; 

	$memday = $year.$monthp.$cdayp;
	$daycont = "" ;

	// 기념일(양력) 표시
	for($i=0 ; $i < sizeof($dayfile) ; $i++) {  // 파일 첫 행부터 끝행까지 루프
		$arrDay = explode("|", $dayfile[$i]);
		if($memday == $year.$arrDay[0]) {
			$daycont = $arrDay[1]; 
			$daycontcolor = $arrDay[2];
			if(substr($arrDay[2],0,3)=="red") $daycolor = "red"; // 공휴일은 날짜를 빨간색으로 표시
		}
	}

	// 석봉운님의 음력날짜 변수선언
	$myarray = soltolun($year,$month,$cday);
	if ($myarray[day]==1 || $myarray[day]==11 || $myarray[day]==21) {
	  //$moonday ="<font color='gray'>&nbsp;(음)$myarray[month].$myarray[day]$myarray[leap]</font>";
	  $moonday="";
	} else {
	  $moonday="";
	}

	$blank="<br />";

	if ($write_href) echo "<a href='$write_href&f_date=$f_date'>";
	echo "<font color='$daycolor'>$daytext</font>";
	if ($write_href) echo "</a>";
	echo "$moonday <font color='$daycontcolor'>$daycont</font> $blank";

?>
	<div class="calender">
		<? 
		for($i=0; $i<count($schedule[$cday]); $i++){ 
			if($i==10) break;
		?>
		<dl>
			<?php if($is_admin){ ?>
			<a href="<?php echo G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$schedule[$cday][$i]['wr_id'] ?>">
			<?php } ?>

			<span title="<?php echo $schedule[$cday][$i]['wr_subject']; ?>">
			<?php echo cut_str($schedule[$cday][$i]['wr_subject'],7).'<br>'; ?>
			<?php
			$wr_2 = $schedule[$cday][$i]['wr_2'];
			$wr_6 = $schedule[$cday][$i]['wr_6'];
			$wr_7 = $schedule[$cday][$i]['wr_7'];
			$wr_8 = $schedule[$cday][$i]['wr_8'];
			$wr_9 = $schedule[$cday][$i]['wr_9'];

			if($wr_6 < 10) $wr_6 = '0'.$wr_6;
			if($wr_7 < 10) $wr_7 = '0'.$wr_7;
			if($wr_8 < 10) $wr_8 = '0'.$wr_8;
			if($wr_9 < 10) $wr_9 = '0'.$wr_9;
			echo $wr_6.':'.$wr_7.'&nbsp;~&nbsp;'.$wr_8.':'.$wr_9.'<br>';
			?>
			<?php echo $schedule[$cday][$i]['wr_content']; ?>
			</span>

			<?php if($is_admin){ ?>
			</a>
			<?php } ?>
			<?php
			if(!$is_admin){
				if($f_date < date('Y-m-d')){
			?>
			<div><a style="position:relative; margin:0px; padding:2px 8px; height:28px; line-height:28px; background-color:#000; color:#fff; border:1px solid #000;">종료</a></div>
			<?
				}else if($schedule[$cday][$i]['wr_10'] == '예약완료'){
			?>
			<div><a style="position:relative; margin:0px; padding:2px 8px; height:28px; line-height:28px; background-color:#e4e4e4; color:#616161; border:1px solid #797979;">예약완료</a></div>
			<?php
				}else{
			?>
			<div><a style="position:relative; margin:0px; padding:2px 8px; height:28px; line-height:28px; background-color:#eb4b3e; color:#fff; border:1px solid #eb4b3e;" href="./board.php?bo_table=<?php echo $bo_table; ?>&b_wr_id=<?php echo $schedule[$cday][$i]['wr_id']; ?>&mode=book">예약하기</a></div>
			<?php
				}
			}

			if($is_admin){
			?>
			<div><a style="position:relative; margin:0px; padding:2px 8px; height:28px; line-height:28px; background-color:#4386f4; color:#fff; border:1px solid #4386f4;" href="./board.php?bo_table=<?php echo $bo_table; ?>&b_wr_id=<?php echo $schedule[$cday][$i]['wr_id']; ?>&mode=identify_adm">예약현황</a></div>
			<?php
			}
			?>
			<?
					if(!$wr_2){$wr_2 = 1;}

					$sql_count = " select count(*) as cnt from `g5_write_counsel_book` where b_wr_id = '".$schedule[$cday][$i]['wr_id']."' ";
					
					$row2 = sql_fetch($sql_count);
					$total_count = $row2['cnt'];
					if($f_date < date('Y-m-d')){
					}else{
				?>
                <?=$wr_2?> 명 (<?=$total_count?>/<?=$wr_2?>)
				<?}?>
		</dl>
		<? } ?>
	</div>

<?php

	echo $html_day[$cday];
	echo ("</td>");  // 한칸을 마무리
	$cday++; // 날짜를 카운팅
} 
// 유효날짜가 아니면 그냥 회색을 칠한다.
else { echo ("     <td width=$col_width height=$col_height bgcolor=f9fafe valign=top>&nbsp;</td>"); }
if (($iz%7) == 0) echo ("  </tr>");

} // 반복구문이 끝남
?>
</tbody>
</table>
</div>
<?php
}
?>
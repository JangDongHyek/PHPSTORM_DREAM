<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>
<link rel="stylesheet" href="<?php echo $board_skin_url?>/style.css">

<!-- 합쳐지고 최소화된 최신 Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- 합쳐지고 최소화된 최신 Jquery UI-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> 

<script>
$("#pickdate").datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	showMonthAfterYear: true,
	dayNamesShort: [ "일", "월", "화", "수", "목", "금", "토" ] ,
	monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
	monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ]
});

$(function(){ // 날짜 입력
	$("#pickdate").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yymmdd", showButtonPanel: true }); 
});
</script>

<!-- 회원가입, 로그인 등 -->
<?php echo outlogin('bootstrap'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
<!-- 회원가입, 로그인 끝 -->

<div >
<!-- 폼시작  -->
<form name="form1" style="border:1px solid; padding:10px; text-align:left;" action="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$lookdateurl?>" method="post">

<!-- 프로그램팀 체크박스 -->
<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$pr_url?><?=$lookdateurl?>"> 프로그램 </a> :
<?
for($j=0; $j<count($pr_member); $j++){ ?>
	<input type="checkbox" name="chk_where[]"
	<?	for($k=0; $k<=count($chk_where); $k++){
			if($pr_member[$j]['mb_name'] == $chk_where[$k]) {?> 
				checked="checked" 
			<?}?> 
	<?}?> value="<?echo $pr_member[$j]['mb_name'];?>"><?echo $pr_member[$j]['mb_name'] ;
}?>

<!-- 디자인팀 체크박스 -->
<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$de_url?><?=$lookdateurl?>"> 디자인 </a> :
<?
for($j=0; $j<count($de_member); $j++){ ?>
	<input type="checkbox" name="chk_where[]"
	<?	for($k=0; $k<=count($chk_where); $k++){
			if($de_member[$j]['mb_name'] == $chk_where[$k]) {?> 
				checked="checked" 
			<?}?> 
	<?}?> value="<?echo $de_member[$j]['mb_name'];?>"><?echo $de_member[$j]['mb_name'] ;
}?>
<br/>
<br/>

<!-- 관리팀 체크박스 -->
<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$ma_url?><?=$lookdateurl?>"> 관리 </a> :
<?
for($j=0; $j<count($ma_member); $j++){ ?>
	<input type="checkbox" name="chk_where[]"
	<?	for($k=0; $k<=count($chk_where); $k++){
			if($ma_member[$j]['mb_name'] == $chk_where[$k]) {?> 
				checked="checked" 
			<?}?> 
	<?}?> value="<?echo $ma_member[$j]['mb_name'];?>"><?echo $ma_member[$j]['mb_name'] ;
}?>
<br/>
<br/>

<!-- 영업팀 체크박스 -->
영업 : 
<?
for($j=0; $j<count($yy_member); $j++){ ?>
	<input type="checkbox" name="chk_where2[]"
	<?	for($k=0; $k<=count($chk_where2); $k++){
			if($yy_member[$j]['mb_name'] == $chk_where2[$k]) {?> 
				checked="checked" 
			<?}?> 
	<?}?> value="<?echo $yy_member[$j]['mb_name'];?>"><?echo $yy_member[$j]['mb_name'] ;
}?>
<br/>
<br/>

<!-- 작업검색  -->
작업검색 : <input type="text" name="stx" id="sch_stx" value="<?if($stx) echo $stx?>" maxlength="20">
<br />
<br />

<!-- 달력바로가기 -->
날짜선택 : 
<input type="text" name="pickdate" id="pickdate" placeholder="<?echo $year."년 ".$month."월 ".$day."일 "?>" onChange="form1.submit()" class="frm_input readonly" readonly>
<br />
<br />

<!-- 달력범위  -->
달력범위 : <select name="lookdate" id="lookdate" onChange="form1.submit()">>
	<? for($j=1; $j<53; $j++) {?>
		<option value="<?echo ($j*7)-1?>" <?if(($j*7)-1 == $lookdate){ ?> selected="selected"<?}?>><?echo $j?>주차<?if($j==2) echo " (기본)"?></option>
	<? } ?>
</select>
<br />
<br />
<input type="submit" value="확인" />
<a href="./board.php?bo_table=<?=$bo_table?>"> 초기화 </a>
</form>
<!-- 폼 끝  -->
</div>
<br />
<br />

<!-- 표시하는 날짜  -->
	<div align="center">
	<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?><?=$lookdateurl?>"></a>
	    <span class="day4"><?=sprintf("%d",substr($week_first,0,4))?>.<?=sprintf("%d",substr($week_first,4,2))?>.<?=sprintf("%d",substr($week_first,6,2))?>. ~ <?=sprintf("%d",substr($week_last,0,4))?>.<?=sprintf("%d",substr($week_last,4,2))?>.<?=sprintf("%d",substr($week_last,6,2))?>.</span><br/><br/>

<!-- 달력 주차 이동  -->
	<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?><?=$chk_member_url?><?=$lookdateurl?>">
	저번주</a>  
	<a href="./board.php?bo_table=<?=$bo_table?><?=$chk_member_url?><?=$lookdateurl?>">
	이번주</a>  
	<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$nextyear?>&month=<?=$nextmonth?>&day=<?=$nextday?><?=$chk_member_url?><?=$lookdateurl?>">
	다음주</a>
	</div>
<br />
<br />

<?
// 체크된 인원 조건문에 넣기
if($chk_where){
	for($j=0; $j<count($chk_where); $j++){
		if($j == 0) $where .= " `mb_name` = '$chk_where[$j]' ";
		else $where .= " or `mb_name` = '$chk_where[$j]' ";
	}
}

// 체크된 인원이 없을경우 기본 조건문
if($where == ''){
	$where = " mb_id <> 'admin' and mb_level <> '4' and mb_level <> '5'";
}

// 달력에 표시할 쿼리문
$query = "SELECT * FROM `g5_member` WHERE $where ORDER BY CASE `mb_level`  WHEN 3 THEN 1 WHEN 2 THEN 2 WHEN 9 THEN 3 WHEN 8 THEN 4 END, mb_level ASC , mb_1 ASC";
$result = sql_query($query);

$h_member = array(); // 달력에 표시할 인원
for ($j=0; $row=sql_fetch_array($result); $j++) {
	$h_member[] = $row['mb_name'];
}
?>

<!-- 달력 시작  -->
<table <?if(!$chk_where){?>style="table-layout:fixed" <?}?>width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">
<tr height="30">
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="3%">요일</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="3%">날짜</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="94%"colspan="11">일정</td>
</tr>
<?
// 선택한 달력범위 만큼 For 돌림
for($i=0; $i<=$lookdate; $i++) {

	$year1 = date("Y",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
	$month1 = date("n",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
	$day1 = date("j",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));

    $tyear1 = date("Y",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $tmonth1 = date("m",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $tday1 = date("d",mktime(0, 0, 0, $month, $day-$cur_day+$i, $year));
    $daydate = $tyear1.$tmonth1.$tday1;

	//일반날짜면 흰색,회색 교차배경색
	if($i%2==1)	$bgcolor = "#ffffff"; 
	else $bgcolor = "#FAFAFA";

	//숫자 요일
	$n_yoil = $i % 7;

	// 요일 표시하기
	switch($i) {
		case(0):
			$yoil = "<font color=#E75A53 style='font-family:NanumGothicBoldWeb;'>이름</font>"; // 첫번째 일욜일은 이름 출력하고 빨강색 배경
			$bgcolor = "#FEFAFF";
			break;
		case($i%7==1):
			$yoil = "<span style='font-family:NanumGothicBoldWeb;'>월</span>"; // 월요일
			break;
		case($i%7==2):
			$yoil = "<span style='font-family:NanumGothicBoldWeb;'>화</span>"; // 화요일
			break;
		case($i%7==3):
			$yoil = "<span style='font-family:NanumGothicBoldWeb;'>수</span>"; // 수요일
			break;
		case($i%7==4):
			$yoil = "<span style='font-family:NanumGothicBoldWeb;'>목</span>"; // 목요일
			break;
		case($i%7==5):
			$yoil = "<span style='font-family:NanumGothicBoldWeb;'>금</span>"; // 금요일
			break;
		case($i/$lookdate==1):
			$yoil = "<font color=#6c91c3 style='font-family:NanumGothicBoldWeb;'>대기</font>"; // 마지막 토요일은 대기로 출력하고 파란색 배경
			$bgcolor = "#F0F8FF";
			break;
    }
	// 첫번째 일요일은 제외한 일요일은 출력 안 함
	if($i!=0 && $i%7==0) continue;

	// 마지막 토요일을 제외한 토요일은 출력 안 함
	if($i/$lookdate != 1 && $i%7==6) continue;

	//오늘날짜면 노랑색배경
	if ($b_year==$year1 && $b_month==$month1 && $b_day==$day1) $bgcolor = "#FFFFC0"; 

	
?>

<!-- 요일 및 날짜 출력 시작 -->
<tr height="<?=$col_height?>">
	<!-- 첫번째 일요일이면 2칸잡고 "이름" 출력 -->
	<? if($i == 0) { ?>
		<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>" colspan="2"><?echo $yoil?></td>

	<!-- 마지막 토요일이면 2칸잡고 "대기" 출력하고 글쓰기 권한이있으면 글자에 글쓰기 링크 -->
	<? } else if($i==$lookdate) { ?>
		<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>" colspan="2">
	<?
		if ($write_href) {
			$f_date = $year1.sprintf("%02d",$month1).sprintf("%02d",$day1);
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:NanumGothicBoldWeb;'>{$yoil}</a>\n";
		}
		else {
			echo "대기\n";
		}
	?>
	</td>

	<!-- 첫번째 일요일, 마지막 토요일이 아니라면 요일을 출력하고 글쓰기 권한이 있을경우 글쓰기 링크  -->
	<? } else { ?>
	<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>">
		<?
		if ($write_href) {
			$f_date = $year1.sprintf("%02d",$month1).sprintf("%02d",$day1);
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:NanumGothicBoldWeb;'>{$yoil}</a>\n";
		}
		else {
			echo "{$yoil}\n";
		}
		?>
	</td>

	<!-- 첫번째 일요일, 마지막 토요일이 아니라면 날짜를 출력하고 글쓰기 권한이 있을경우 글쓰기 링크  -->
	<td class="tbline2" align="center" bgcolor="<?=$bgcolor?>">
		<?
		if ($write_href) {
			$f_date = $year1.sprintf("%02d",$month1).sprintf("%02d",$day1);
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:NanumGothicBoldWeb;'>{$month1}. {$day1}</a>\n";
		}
		else {
			echo "{$month1}. {$day1}\n";
		}
		?>
	</td>
<!-- 요일 및 날짜 출력 끝 -->
<? } ?>

<!-- 내용출력 쿼리문 시작, 선택된 멤버수만큼 For문 돌림 -->
<?php for($l=0; $l<count($h_member); $l++){ ?>

<!-- 체크된 영업사원 있을경우 해당 인원 조건문 추가 -->
<? if($chk_where2){
	for($j=0; $j<count($chk_where2); $j++){
		if($j == 0) $where2 .= " and (`wr_4` = '$chk_where2[$j]' ";
		else $where2 .= " or `wr_4` = '$chk_where2[$j]' ";

	}
	$where2 .= ")";
}

// 작업검색을 했을경우 해당 문구 조건문 추가
if($stx){
	$where2 .= " and wr_subject like '%$stx%'";
}

// 출력할 내용 쿼리문
$query = "SELECT * FROM $write_table WHERE (((wr_1 between '$week_first' and '$week_last' or  wr_2 between '$week_first' and '$week_last') or (wr_1 < '$week_first' and wr_2 > '$week_last')) AND `wr_name` = '$h_member[$l]' OR (`wr_name` = '$h_member[$l]' AND `wr_3`%7 = $lookdate%7)) $where2 ORDER BY wr_id ASC";
$result = sql_query($query);
$list = array();
?>
<!-- 내용출력 쿼리문 끝 -->

<? for ($j=0; $row=sql_fetch_array($result); $j++) {

	// $row[wr_4] -> 해당 작업 영업사원 이름
	// $row[wr_5] -> 작업기한

	// 제목
	if($stx) { // 작업검색을 했을경우 영업팀 아이디를 제목에 추가
		if($row[wr_5]){ // 마감일이 있을경우 제목에 추가
			$list[$j][wr_subject] = "- ".$row[wr_subject]."<br/>(".$row[wr_4]."_".substr($row[wr_5],4,4).")"; 
		} else {
			$list[$j][wr_subject] = "- ".$row[wr_subject]."<br/>(".$row[wr_4].")";
		}
	} else {
		if($row[wr_5]){ // 마감일이 있을경우 제목에 추가
			$list[$j][wr_subject] = "- ".$row[wr_subject]."_".substr($row[wr_5],4,4); 
		} else {
			$list[$j][wr_subject] = "- ".$row[wr_subject];
		}
	}

	$list[$j][wr_1]   = $row[wr_1]; // 작업 시작일
	$list[$j][wr_2]   = $row[wr_2]; // 작업 종료일
	$list[$j][wr_3]   = $row[wr_3]; // 요일숫자 :: 일=0, 월=1, 화=2, 수=3, 목=4, 금=5, 토=6
	$list[$j][wr_id]  = $row[wr_id]; // 글쓴이 아이디
	
	
}
?>

<!-- 이름 및 내용 출력 시작 -->
	<td class="tbline2" width="<? echo 90 /count($h_member)?>%" bgcolor="<?=$bgcolor?>">
		<div id='box_list2' >
		<? if($i==0) { ?> <!-- 첫번째 일요일이면 이름출력 -->
			<div id='box01' style="width:calc(100% - 20px);" align="center"><?=$h_member[$l]?></div>
		<? } else if($i%7==$lookdate%7) { ?> <!-- 마지막 토요일이면 대기출력 -->
		<? for ($k=0; $k<$j; $k++) {
			if ($list[$k][wr_3]%7 == $lookdate%7){ ?>
			<div id='box01' style="width:calc(100% - 20px);"><a href='./board.php?bo_table=<?=$bo_table?>&mode=w&wr_id=<?=$list[$k][wr_id]?>' style='font-family:NanumGothicBoldWeb;'><?=$list[$k][wr_subject]?></a></div>
		<? }
			} ?>
		<? } else { ?> <!-- 첫번째 일요일, 마지막 토요일이 아니면 내용출력 -->
		<? for ($k=0; $k<$j; $k++) {
			if (($daydate >= $list[$k][wr_1]) && ($daydate <= $list[$k][wr_2])) {
		?>
			<div id='box01' style="width:calc(100% - 20px);"><a href='./board.php?bo_table=<?=$bo_table?>&mode=w&wr_id=<?=$list[$k][wr_id]?>' style='font-family:NanumGothicBoldWeb;'><?=$list[$k][wr_subject]?></a></div>
		<?	}
			}}?>
		</div>
	</td>
	<?php } ?>
</tr>
<? } ?>
<!-- 이름 및 내용 출력 끝 -->
</table>
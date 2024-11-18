<?php 

// 오늘날짜 생성
$today = getdate(); 
$b_month = $today['mon'];
$b_day = $today['mday']; 
$b_year = $today['year']; 

// 데이트피커로 날짜 선택시 값 넣기
if($pickdate){
	$month = substr($pickdate,4,2);
	$day = substr($pickdate,6,2);
	$year = substr($pickdate,0,4);
}
// 아무것도 넘어온 값이 없을때 오늘날짜 넣기
if ($year < 1) { 
  $month = $b_month;
  $day = $b_day;
  $year = $b_year;
}

// 체크한 인원 및 검색조건을 유지할수있도록 값을 저장함
// 작업검색, 데이트피커, 달력범위, 확인버튼, 저번주, 이번주, 다음주 상황일때 사용함
// 초기화, 팀별선택 상황에서는 사용안함
for($j=0; $j<count($chk_where); $j++){
	$chk_member_url .= "&chk_where[".$j."]=".$chk_where[$j];
}
for(; $j<count($chk_where2); $j++){
	$chk_member_url .= "&chk_where2[".$j."]=".$chk_where2[$j];
}
if($stx) $chk_member_url .= "&stx=".$stx;
// 저장 끝

// 달력범위, 넘어온값이 없을때 2주차 기본
if($lookdate == "") $lookdate = "13"; 

// 달력범위 저장
$lookdateurl = "&lookdate=".$lookdate;


// 달력생성관련 기본 날짜 값들...............
$f_day = date("Ymd",mktime(0, 0, 0, $month, $day-7, $year));
$prevyear  = substr($f_day,0,4);
$prevmonth = sprintf("%d",substr($f_day,4,2));
$prevday   = sprintf("%d",substr($f_day,6,2));

$l_day = date("Ymd",mktime(0, 0, 0, $month, $day+7, $year));
$nextyear  = substr($l_day,0,4);
$nextmonth = sprintf("%d",substr($l_day,4,2));
$nextday   = sprintf("%d",substr($l_day,6,2));

$offset  = date("w", mktime(0, 0, 0, $month, 1, $year));

$cur_day = date("w",mktime(0, 0, 0, $month, $day, $year));
$minus_day = $lookdate - $cur_day;

$week_first = date("Ymd", mktime(0, 0, 0, $month, $day-$cur_day, $year));
$week_last  = date("Ymd", mktime(0, 0, 0, $month, $day+$minus_day, $year));

//세로 폭 지정
$col_height= 60 ; 


$query = "SELECT * FROM `g5_member` Where `mb_level` <> 10 and `mb_level` > 1  ORDER BY mb_1 ASC";
$result = sql_query($query);
$all_member = array(); // 운영자와 1레벨을 제외한 모든 멤버
for($j=0; $row=sql_fetch_array($result); $j++) {
	$all_member[] = $row;
}

$de_member = array(); // 프로그램 멤버
$pr_member = array(); // 디자인 멤버
$ma_member = array(); // 관리부 멤버
$yy_member = array(); // 영업 멤버

for($j=0; $j<count($all_member); $j++){
	if($all_member[$j]['mb_level'] == 2){
		$pr_member[] = $all_member[$j]; // 레벨2은 프로그램
	} else if($all_member[$j]['mb_level'] == 3){
		$de_member[] = $all_member[$j]; // 레벨3은 디자인
	} else if($all_member[$j]['mb_level'] == 4){
										// 레벨4은 원래 관리부였음 초기기획하고 다르게 왜 8,9 레벨로 바꿨는지 기억이 안 남
	} else if($all_member[$j]['mb_level'] == 5){
		$yy_member[] = $all_member[$j]; // 레벨5은 영업팀
	} else if($all_member[$j]['mb_level'] == 8){
		$ma_member[] = $all_member[$j]; // 레벨8은 류형선팀장
	} else if($all_member[$j]['mb_level'] == 9){
		$ma_member[] = $all_member[$j]; // 레벨9은 정재진팀장
	}
}

for($j=0; $j<count($pr_member); $j++){
	$pr_url .= "&chk_where[".$j."]=".$pr_member[$j]['mb_name']; // 프로그램팀 전체선택
}

if($pr_url) $pr_url .= "&chk_where[".$j."]=".$ma_member[1]['mb_name']; // 프로그램팀 전체선택에 정재진팀장 추가

for($j=0; $j<count($de_member); $j++){
	$de_url .= "&chk_where[".$j."]=".$de_member[$j]['mb_name']; // 디자인팀 전체선택
} 

if($de_url) $de_url .= "&chk_where[".$j."]=".$ma_member[0]['mb_name']; // 디자인팀에 전체선택에 류형선팀장 추가

for($j=0; $j<count($ma_member); $j++){
	$ma_url .= "&chk_where[".$j."]=".$ma_member[$j]['mb_name']; // 관리부 전체선택
}


?>
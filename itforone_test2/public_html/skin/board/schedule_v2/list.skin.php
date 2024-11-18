<?
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
	set_session("ss_delete_token", $token = uniqid(time()));

    // php 5.3이하 json한글인코딩 깨짐
    function han ($s) { return reset(json_decode('{"s":"'.$s.'"}')); }
    function to_han($str) { return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',$str); }

    if (!$is_member) goto_url(G5_BBS_URL."/login.php");
?>
<link rel="stylesheet" href="<?php echo $board_skin_url?>/style.css">

<!-- 합쳐지고 최소화된 최신 Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?echo G5_CSS_URL?>/font-awesome.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- 합쳐지고 최소화된 최신 Jquery UI-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script> 

<style type="text/css">
	.layer {display:none; position:fixed; _position:absolute; top:0; left:0; width:100%; height:100%; z-index:100;}
		.layer .bg {position:absolute; top:0; left:0; width:100%; height:100%; background:#000; opacity:.5; filter:alpha(opacity=50);}
		.layer .pop-layer {display:block;}

	.pop-layer {display:none; position: absolute; top: 50%; left: 50%; width: 900px; height:auto;  background-color:#fff; border: 5px solid #3571B5; z-index: 10;
	margin-left:-450px !important;}	
	.pop-layer .pop-container {padding: 20px;}
	.pop-layer p.ctxt {color: #666; line-height: 25px;}
	.pop-layer .btn-r {width: 100%; margin:10px 0 20px; padding-top: 10px; border-top: 1px solid #DDD; text-align:right;}
	.pop-layer .btn-l {width: 100%; margin:10px 0 20px; padding-top: 10px; border-top: 1px solid #DDD; text-align:left;}
    .body_content_area p {margin: 0; padding: 0;}

	a.cbtn {display:inline-block; height:25px; padding:0 14px 0; border:1px solid #304a8a; background-color:#3f5a9d; font-size:13px; color:#fff; line-height:25px;}	
	a.cbtn:hover {border: 1px solid #091940; background-color:#1f326a; color:#fff;}
</style>
<!-- 폼시작  -->

<div class="float_sidebar" style="width:80%;">
	<div class="menu" style="width:100%;">
		<div id="sidebar" class="btn btn-danger" style="margin-left:0%; text-align:center; width:3%; float: left;">여<br>기<br>를<br>클<br>릭<br>하<br>면<br>메<br>뉴<br>가<br>나<br>타<br>납<br>니<br>다</div>
		
		<div id="topmenu" style="border:1px solid #ccd5df; margin-left:3%; width:60%; display:none; background:#fff; position: absolute; z-index: 1; float: right;">
			<form name="form1" bgcolor="#ffff" style="padding:10px; text-align:left;" action="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$lookdateurl?>" method="post">
				<div>
					<div style="width:65%; padding:10px; text-align:left; float: left;">
						<!-- 프로그램팀 체크박스 -->
						<div style="padding:10px;">
						<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$pr_url?><?=$lookdateurl?>"> ▶ 프로그램 </a> :
						<?
						for($j=0; $j<count($pr_member); $j++){ ?>
							<input type="checkbox" name="chk_where[]"
							<?	for($k=0; $k<=count($chk_where); $k++){
									if($pr_member[$j]['mb_name'] == $chk_where[$k]) {?> 
										checked="checked" 
									<?}?> 
							<?}?> value="<?echo $pr_member[$j]['mb_name'];?>"><?echo $pr_member[$j]['mb_name'] ;
						}?>
						</div>

						<!-- 디자인팀 체크박스 -->
						<div style="padding:10px;">
						<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$de_url?><?=$lookdateurl?>"> ▶ 디자인 </a> :
						<?
						for($j=0; $j<count($de_member); $j++){ ?>
							<input type="checkbox" name="chk_where[]"
							<?	for($k=0; $k<=count($chk_where); $k++){
									if($de_member[$j]['mb_name'] == $chk_where[$k]) {?> 
										checked="checked" 
									<?}?> 
							<?}?> value="<?echo $de_member[$j]['mb_name'];?>"><?echo $de_member[$j]['mb_name'] ;
						}?>
						</div>

						<!-- 관리팀 체크박스 -->
						<div style="padding:10px;">
						<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$year?>&month=<?=$month?>&day=<?=$day?><?=$ma_url?><?=$lookdateurl?>"> ▶ 관리 </a> :
						<?
						for($j=0; $j<count($ma_member); $j++){ ?>
							<input type="checkbox" name="chk_where[]"
							<?	for($k=0; $k<=count($chk_where); $k++){
									if($ma_member[$j]['mb_name'] == $chk_where[$k]) {?> 
										checked="checked" 
									<?}?> 
							<?}?> value="<?echo $ma_member[$j]['mb_name'];?>"><?echo $ma_member[$j]['mb_name'] ;
						}?>
						</div>

						<!-- 영업팀 체크박스 -->
						<div style="padding:10px;">
							 ▶ 영업 : 
							<?
							for($j=0; $j<count($yy_member); $j++){ ?>
								<input type="checkbox" name="chk_where2[]"
								<?	for($k=0; $k<=count($chk_where2); $k++){
										if($yy_member[$j]['mb_name'] == $chk_where2[$k]) {?> 
											checked="checked" 
										<?}?> 
								<?}?> value="<?echo $yy_member[$j]['mb_name'];?>"><?echo $yy_member[$j]['mb_name'] ;
							}?>
						</div>


					</div>

					<div style="width:30%; padding:10px; text-align:left; float: right;">
						<!-- 작업검색  -->
						<div style="padding:10px;">
							작업검색 : <input type="text"  class="form-control" name="stx" id="sch_stx" value="<?if($stx) echo $stx?>" maxlength="20">
						</div>

						<!-- 달력바로가기 -->
						<div style="padding:10px;">
							날짜선택 : 
							<input class="form-control" type="text" readonly name="pickdate" id="pickdate"  placeholder="<?echo $year."년 ".$month."월 ".$day."일 "?>">
						</div>

						<!-- 달력범위  -->
						<div style="padding:10px;">
							달력범위 : <select name="lookdate" class="form-control" id="lookdate" onChange="form1.submit()">
								<? for($j=1; $j<53; $j++) {?>
									<option value="<?echo ($j*7)-1?>" <?if(($j*7)-1 == $lookdate){ ?> selected="selected"<?}?>><?echo $j?>주차<?if($j==3) echo " (기본)"?></option>
								<? } ?>
							</select>
						</div>
						<div style="padding:10px; clear:both;">
							<input type="submit" class="btn btn-info"  value="확인">
							<a href="./board.php?bo_table=<?=$bo_table?>" class="btn btn-default"> 초기화 </a>
						</div>
					</div><div style="clear:both;"?></div>
				</div>		
			</form>
		</div>
	</div>
</div>
<!-- 폼 끝  -->

<div style="padding:10px 0px 0px 0px; margin:0 auto; width:93%;">
	<div align="center">
		<span class="day4"><?=sprintf("%d",substr($week_first,0,4))?>.<?=sprintf("%d",substr($week_first,4,2))?>.<?=sprintf("%d",substr($week_first,6,2))?>. ~ <?=sprintf("%d",substr($week_last,0,4))?>.<?=sprintf("%d",substr($week_last,4,2))?>.<?=sprintf("%d",substr($week_last,6,2))?>.</span>
	</div>
					

<div style="padding:5px 0px 5px 0px; text-align:center">
	<!-- 회원가입, 로그인 등 -->
	<div  style="float: right; min-width:150px;" align="right" >
		<?if ($is_member) { ?>
            <a href="../qna/list.php" style="color:#ffffff" class="btn btn-success">수정관리</a>
			<?if ($is_admin) { ?>
				<a href="<?php echo G5_ADMIN_URL ?>"  style="color:#ffffff" class="btn btn-danger">관리자</a>
			<?}?>
			<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" style="color:#ffffff" class="btn btn-info">회원정보수정</a>
			<a href="<?php echo G5_BBS_URL ?>/logout.php"  style="color:#ffffff" class="btn btn-warning" >로그아웃</a>
		<?} else { ?>
			<a href="<?php echo G5_BBS_URL ?>/login.php" style="color:#ffffff" class="btn btn-info" >로그인</a>
			<a href="<?php echo G5_BBS_URL ?>/register.php" class="btn btn-default">회원가입</a>
		<?}?>
		
	</div>
	<!-- 회원가입, 로그인 끝 -->
	<div style="margin:0px 0px 0px 150px; display:inline-block">
	<!-- 달력 주차 이동  -->
		<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$prevyear?>&month=<?=$prevmonth?>&day=<?=$prevday?><?=$chk_member_url?><?=$lookdateurl?>" class="btn btn-default">
		저번주</a>  
		<a href="./board.php?bo_table=<?=$bo_table?><?=$chk_member_url?><?=$lookdateurl?>" style="color:#ffffff" class="btn btn-success" >
		오늘</a>  
		<a href="./board.php?bo_table=<?=$bo_table?>&mode=w&year=<?=$nextyear?>&month=<?=$nextmonth?>&day=<?=$nextday?><?=$chk_member_url?><?=$lookdateurl?>"class="btn btn-default">
		다음주</a>
	</div>
</div>


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
	$where = " mb_id <> 'admin' and mb_level <> '4' and mb_name != '창원' and mb_name != '김완준' and mb_name != '개인일정' and mb_name != '동아TG' and mb_level > 1 and mb_id != 'test'";
}

// 달력에 표시할 쿼리문
//$query = "SELECT * FROM `g5_member` WHERE $where ORDER BY CASE `mb_level`  WHEN 3 THEN 1 WHEN 2 THEN 2 WHEN 9 THEN 3 WHEN 8 THEN 4 END, mb_level ASC , mb_1 ASC";
$query = "SELECT * FROM `g5_member` WHERE $where ORDER BY `mb_1` DESC";

$result = sql_query($query);

$h_member = array(); // 달력에 표시할 인원
$m_member = array(array());
for ($j=0; $row=sql_fetch_array($result); $j++) {
	$h_member[] = $row['mb_name'];
	$m_member[$j]['name']=$row['mb_name'];
	$m_member[$j]['nick']=$row['mb_nick'];
}
?>

<!-- 달력 시작  -->
<table <?if(!$chk_where){?>style="table-layout:fixed" <?}?>width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">
<tr height="30">
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="3%">요일</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="3%">날짜</td>
	<td class="tbline2 bbs_head bbs_fhead" align="center" width="94%"colspan="<?=count($h_member)?>">일정
		
		
		<div style="float:right; padding-right:12px;">
		<?php
			$sql="select * from g5_person";
			$mRow=sql_fetch($sql);

		?>
		전체 <?=intval($mRow[total])?>명 <span style="color:#7d7d7d;"> (대표 <?=intval($mRow[ceo])?>명, 디자이너 <?=intval($mRow[disign])?>명, 프로그램 <?=intval($mRow[developer])?>명, 영업 <?=intval($mRow[sales])?>명, 관리부 <?=intval($mRow[manager])?>명)</span>
		<?php if($member[mb_id]=="company"){?>
		<button class="btn" onclick="winPersonnel()" style="height:24px; line-height:5px">설정</button>
		<script type="text/javascript">
			function winPersonnel(){
				window.open("<?=G5_BBS_URL?>/personnel.php","person","width=500,height=500");
			}
		</script>
		</div>
		<?php }?>
		
	</td>
</tr>
<?
// 선택한 달력범위 만큼 For 돌림
for($i=0; $i<=$lookdate; $i++) {

	if(!$modify_day){
		$modify_day = $week_first;
	} else {
		$modify_day = date("Ymd", strtotime($modify_day."+1day"));
	}

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


	//오늘날짜면 노랑색배경
	if ($b_year==$year1 && $b_month==$month1 && $b_day==$day1 && $i!=0 && $i%7!=0 && $i%7!=6) $bgcolor = "#FFFFC0"; 

	for($ho=0; $ho<count($hollday); $ho++){
		if($hollday[$ho]['h_3'] == $day1 && $hollday[$ho]['h_2'] == $month1 && $hollday[$ho]['h_1'] == $year1){
			$bgcolor = "#FFEAEA";
		}
	}

	// 요일 표시하기
	switch($i) {
		case(0):
			$yoil = "<font color=#E75A53 style='font-family:Nanum Gothic;'>이름</font>"; // 첫번째 일욜일은 이름 출력하고 빨강색 배경
			$bgcolor = "#FEFAFF";
			break;
		case($i%7==1):
			$yoil = "<span style='font-family:Nanum Gothic;'>월</span>"; // 월요일
			break;
		case($i%7==2):
			$yoil = "<span style='font-family:Nanum Gothic;'>화</span>"; // 화요일
			break;
		case($i%7==3):
			$yoil = "<span style='font-family:Nanum Gothic;'>수</span>"; // 수요일
			break;
		case($i%7==4):
			$yoil = "<span style='font-family:Nanum Gothic;'>목</span>"; // 목요일
			break;
		case($i%7==5):
			$yoil = "<span style='font-family:Nanum Gothic;'>금</span>"; // 금요일
			break;
		case($i/$lookdate==1):
			$yoil = "<font color=#6c91c3 style='font-family:Nanum Gothic;'>대기</font>"; // 마지막 토요일은 대기로 출력하고 파란색 배경
			$bgcolor = "#F0F8FF";
			break;
    }
	// 첫번째 일요일은 제외한 일요일은 출력 안 함
	if($i!=0 && $i%7==0) continue;
	
	// 마지막 토요일을 제외한 토요일은 출력 안 함
	if($i/$lookdate != 1 && $i%7==6) continue;

	



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
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:Nanum Gothic;'>{$yoil}</a>\n";
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
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:Nanum Gothic;'>{$yoil}</a>\n";
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
			echo " <a href='$write_href&f_date=$f_date&t_date=$f_date&wr_3=$n_yoil' style='font-family:Nanum Gothic;'>{$month1}. {$day1}</a>\n";
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
$query = "SELECT * FROM $write_table WHERE (((wr_1 between '$modify_day' and '$modify_day' or  wr_2 between '$modify_day' and '$modify_day') or (wr_1 < '$modify_day' and wr_2 > '$modify_day')) AND `wr_name` = '$h_member[$l]' OR (`wr_name` = '$h_member[$l]' AND `wr_3`%7 = $lookdate%7)) $where2 ORDER BY wr_6 DESC, wr_id ASC";

//$query = "SELECT * FROM $write_table WHERE (((wr_1 between '$week_first' and '$week_last' or  wr_2 between '$week_first' and '$week_last') or (wr_1 < '$week_first' and wr_2 > '$week_last')) AND `wr_name` = '$h_member[$l]' OR (`wr_name` = '$h_member[$l]' AND `wr_3`%7 = $lookdate%7)) $where2 ORDER BY wr_id ASC";

$result = sql_query($query);
$list = array();

?>
<!-- 내용출력 쿼리문 끝 -->

<? for ($j=0; $row=sql_fetch_array($result); $j++) {

	// $row[wr_4] -> 해당 작업 영업사원 이름
	// $row[wr_5] -> 작업기한


	$title = "제목 : ".$row['wr_subject']." (".substr($row['wr_1'],4,2)."/".substr($row['wr_1'],6,2)." ~ ".substr($row['wr_2'],4,2)."/".substr($row['wr_2'],6,2).")";
	$name = $row['wr_name'];
	$body = "내용<br>". nl2br($row['wr_content']);
	$mb_id = $row['mb_id'];

	$list[$j][wr_subject] .= "· ";
	// 제목
	if($stx) { // 작업검색을 했을경우 영업팀 아이디를 제목에 추가
		if($row[wr_5]){ // 마감일이 있을경우 제목에 추가
			$list[$j][wr_subject] .= $row[wr_subject]."<br>(".$row[wr_4]."_"."<font color=#FF0000>".substr($row[wr_5],4,4)."</font>)"; 
		} else {
			$list[$j][wr_subject] .= $row[wr_subject]."<br>(".$row[wr_4].")";
		}
	} else {
		if($row[wr_5]){ // 마감일이 있을경우 제목에 추가
			$list[$j][wr_subject] .= $row[wr_subject]."_"."<font color=#FF0000>".substr($row[wr_5],4,4)."</font>"; 
		} else {
			$list[$j][wr_subject] .= $row[wr_subject];
		}
	}
	
	$list[$j][wr_1]   = $row[wr_1]; // 작업 시작일
	$list[$j][wr_2]   = $row[wr_2]; // 작업 종료일
	$list[$j][wr_3]   = $row[wr_3]; // 요일숫자 :: 일=0, 월=1, 화=2, 수=3, 목=4, 금=5, 토=6
	$list[$j][wr_id]  = $row[wr_id]; // 글쓴이 아이디


	$temp_subject = urlencode(mb_substr($row[wr_subject],0,2,'utf-8')); // 검색제목
	$list[$j][subject] = "<a href='./board.php?bo_table=$bo_table&mode=w&year=$year&month=$month&day=$day$lookdateurl&stx=$temp_subject'><i style='font-size:7pt; line-height:11pt; vertical-align:middle' class='fa fa-search' aria-hidden='true'></i></a>";
	if($row[wr_9]) {
		$list[$j][linkhome] = "<a href='$row[wr_9]'><i class='fa fa-home' style='font-size:7pt; line-height:11pt; vertical-align:middle'></i></a>";
	}

	$date1 = strtotime($row[wr_datetime]);
	$date2 = strtotime("-1 day", time());
	if($date2 - $date1 < 0){
		$list[$j][new_icon]   = "<img src=http://letsit.kr/~itforone_test2/skin/board/basic/img/icon_new.gif>";
		$list[$j][wr_subject] .= $list[$j][new_icon];
	}

	if(!$list[$j][new_icon]){
		$date1 = strtotime($row[wr_last]);
		$date2 = strtotime("-1 day", time());
		
		if($date2 - $date1 < 0){
			$list[$j][last_icon]   = "<img src=http://letsit.kr/~itforone_test2/skin/board/basic/img/icon_e.gif>";
		}

		$list[$j][wr_subject] .= $list[$j][last_icon];
	}

	
	if ($row['wr_file'] >= 1) {
		$list[$j][wr_subject] .= "<img src=http://letsit.kr/~itforone_test2/skin/board/basic/img/icon_file.gif>";

		$file_row = sql_fetch("select * from `g5_board_file` where bo_table = '$bo_table' and `wr_id` = '$row[wr_id]'");
		$list[$j]['bf_no'] = $file_row[bf_no];
	}

    $body_content[$list[$j][wr_id]] = $body;

?>
	<input type="hidden" id="title_<?=$list[$j][wr_id]?>" value="<?=$title?>">
	<input type="hidden" id="name_<?=$list[$j][wr_id]?>" value="<?=$name?>">
<!--	<input type="hidden" id="body_--><?//=$list[$j][wr_id]?><!--" value="--><?//=$body?><!--">--> <!-- json으로 호출 -->
	<input type="hidden" id="mbid_<?=$list[$j][wr_id]?>" value="<?=$mb_id?>">
<?
}
?>

<!-- 이름 및 내용 출력 시작 -->
<? if($hollday != null && $i != 0) {
	for($ho=0; $ho<count($hollday); $ho++) { 
		$ho_print = false;
		if($hollday[$ho]['date'] == $daydate) {
			if($l == 0 ) {
				if($i%7 !=$lookdate%7){
					$ho_print = "1";
				}
				
			}
			break;
		} else {
			$ho_print = "2";
		}
	}
} else {
	$ho_print = "2";
}

?>
		<? if($ho_print == "1") { ?>
			<td class="tbline2" width="<? echo 90 /count($h_member)?>%" bgcolor="<?=$bgcolor?>" colspan ="<?=count($h_member)?>" align="center">
				<div id='box01' style="width:calc(100% - 20px);" ><?=$hollday[$ho]['name']?></div>
			</td>
		<? } else if($ho_print == "2") { ?>
			<td class="tbline2" width="<? echo 90 /count($h_member)?>%" bgcolor="<?=$bgcolor?>">
				<div id='box_list2' >
				<? if($i==0) { ?> <!-- 첫번째 일요일이면 이름출력 -->
					<div id='box01' style="width:calc(100% - 20px);" align="center">
						<?=$h_member[$l]?><br>
						(<?=$m_member[$l]['nick']?>)
					
					</div>
				<? } else if($i%7==$lookdate%7) { ?> <!-- 마지막 토요일이면 대기출력 -->
				<? for ($k=0; $k<$j; $k++) {
					if ($list[$k][wr_3]%7 == $lookdate%7){ ?>
					<div id='box01' style="width:calc(100% - 20px);" ><a onclick="layer_open('layer2', '<?=$list[$k][wr_id];?>', '<?=$list[$k][bf_no];?>');return false;" href="#" style='font-family:Nanum Gothic;'><?=$list[$k][wr_subject]?></a><?echo$list[$k][subject]?><?echo$list[$k][linkhome]?><?echo$list[$j][linkhome]?></div>
				<? }
					} ?>
				<? } else { ?> <!-- 첫번째 일요일, 마지막 토요일이 아니면 내용출력 -->
				<? for ($k=0; $k<$j; $k++) {
					if($list[$k]['wr_3']==6) continue;
					if (($daydate >= $list[$k][wr_1]) && ($daydate <= $list[$k][wr_2])) {
				?>
					<div id='box01' style="width:calc(100% - 20px);" ><a onclick="layer_open('layer2', '<?=$list[$k][wr_id];?>', '<?=$list[$k][bf_no];?>');return false;" href="#" style='font-family:Nanum Gothic;'><?=$list[$k][wr_subject]?></a><?echo$list[$k][subject]?><?echo$list[$k][linkhome]?><?echo$list[$j][linkhome]?></div>
				<?	}
					}
				}?>
				</div>
			</td>
		<? } ?>
<?php } ?>
</tr>
<? } ?>
<!-- 이름 및 내용 출력 끝 -->
</table><br />

<div class="layer">
	<div class="bg"></div>
	<div class="pop-layer" id="layer2">
		<div class="pop-container">
			<div id="pop-conts" class="pop-conts">
				<input type="hidden" id="token_del" value="<?php echo $token; ?>">
				<input type="hidden" id="wr_id_del" value="">
				<input type="hidden" id="mb_id" value="<?php echo $member['mb_id']?>">
				<input type="hidden" id="admin" value="<?php echo $is_admin?>">
				<!--content //-->
				<div style="text-align:center;" id="title"></div>
				
				<div class="btn-l">
					<div class="body_content_area" id="body" style="overflow-y:scroll; overflow-x:hidden; height:400px;"></div>
				</div>
				<div class="btn-r">
					<a id="file_down" style="color:#ffffff" class="btn btn-warning" href="#">파일다운</a>
					<a id="del" style="color:#ffffff" class="btn btn-danger" onclick="del()" href="#">삭제</a>
					<a id="edit" style="color:#ffffff"  class="btn btn-info" href="#">수정</a>
					<a id="close" class="btn btn-default" href="#">닫기</a>
				</div>
				<!--// content-->
			</div>
		</div>
	</div>
</div>
</div>
<script>
    function del(){
        if(confirm('정말 삭제하시겠습니까?')){
            location.replace('./delete.php?bo_table=<?php echo $bo_table ?>&wr_id='+$('#wr_id_del').val()+'&token='+$('#token_del').val());
        }
    }

    var json_body = <?=to_han(json_encode($body_content))?>;

    $(function(){ // 날짜 입력
        $("#pickdate").datepicker({
            dateFormat: "yymmdd",
            changeMonth: true,
            changeYear: true,
            showMonthAfterYear: true,
            dayNamesShort: [ "일", "월", "화", "수", "목", "금", "토" ] ,
            monthNames :  [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ],
            monthNamesShort: [ "1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월" ]
        });
    });

    // html dom 이 다 로딩된 후 실행된다.
    var mouse = false;


    $(document).ready(function(){
        $(document).mouseup(function (e){

            var container = $("#topmenu");
            if(container.css("display") === "none"){
                mouse = false;
            } else {
                if( container.has(e.target).length === 0) {
                    var pickdate = $("#pickdate");
                    if(pickdate.is(":visible")){

                    } else {
                        container.hide();
                        mouse = true;
                    }
                }
            }
        });
        $("#sidebar").on("click", function() {
            if($("#topmenu").css("display") === "none"){
                if(mouse == false) {
                    $("#topmenu").show();
                }
            }else{

                $("#topmenu").hide();
            }
            mouse = false;
        });
    });

    // 스크롤시 메뉴가 따라다님
    $(function(){
        $("#topmenu").hide();
        var $win = $(window);
        var top = $(window).scrollTop(); // 현재 스크롤바의 위치값을 반환합니다.
        var yPosition;
        /*사용자 설정 값 시작*/
        var speed          = 'slow';     // 따라다닐 속도 : "slow", "normal", or "fast" or numeric(단위:msec)
        var easing         = 'swing'; // 따라다니는 방법 기본 두가지 linear, swing
        var $layer         = $('.float_sidebar'); // 레이어 셀렉팅
        var layerTopOffset = 0;   // 레이어 높이 상한선, 단위:px
        $layer.css('position', 'relative').css('z-index', '1');
        /*사용자 설정 값 끝*/

        // 스크롤 바를 내린 상태에서 리프레시 했을 경우를 위해
        if (top > 0 )
            $win.scrollTop(layerTopOffset+top);
        else
            $win.scrollTop(0);

        yPosition = $win.scrollTop() + 80;
        $layer.animate({"top":yPosition }, {duration:speed, easing:easing, queue:false});

        //스크롤이벤트가 발생하면
        $(window).scroll(function(){
            yPosition = $win.scrollTop() + 81;
            if (yPosition < 0)
            {
                yPosition = 0;
            }

            if(yPosition <= 80 ){
                //$("#topmenu").show(); //최상단이면 보여줌 ::: 난잡해보여서 사용 안하고 사용할려면 숫자변경 필요함
                $layer.animate({"top":yPosition }, {duration:speed, easing:easing, queue:false});
            }

            if(yPosition > 80 ) {
                var filter = "win16|win32|win64|mac";
                if(navigator.platform){
                    if(0 <= filter.indexOf(navigator.platform.toLowerCase())){ // 모바일이 아니면 스크롤닫힘 사용 안 함
                        $("#topmenu").hide(); // 스크롤하면 닫힘
                    }
                }
                $layer.animate({"top":yPosition }, {duration:speed, easing:easing, queue:false});
            }
        });
    });

    function layer_open(el, wr_id, bf_no){

        var temp = $('#' + el);
        var bg = temp.prev().hasClass('bg');	//dimmed 레이어를 감지하기 위한 boolean 변수

        if(bg){
            $('.layer').fadeIn();	//'bg' 클래스가 존재하면 레이어가 나타나고 배경은 dimmed 된다.
        }else{
            temp.fadeIn();
        }

        // 화면의 중앙에 레이어를 띄운다.
        if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
        else temp.css('top', '0px');
        if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
        else temp.css('left', '0px');

        $('#close').click(function(e){
            if(bg){
                $('.layer').fadeOut(); //'bg' 클래스가 존재하면 레이어를 사라지게 한다.
            }else{
                temp.fadeOut();
            }
            e.preventDefault();
        });

        $('.layer .bg').click(function(e){	//배경을 클릭하면 레이어를 사라지게 하는 이벤트 핸들러
            $('.layer').fadeOut();
            e.preventDefault();
        });

        $('#wr_id_del').val(wr_id);
        $('#title').html($('#title_'+wr_id).val());
        $('#body').html(json_body[wr_id]); //$('#body').html($('#body_'+wr_id).val());
        $('#edit').hide();
        $('#del').hide();
        $('#file_down').hide();

        if(bf_no != ''){
            $('#file_down').show();
            $('#file_down').attr('href','./download.php?bo_table=<?php echo $bo_table ?>&wr_id='+wr_id+'&no='+bf_no);
        }

        if($('#mb_id').val() == $('#mbid_'+wr_id).val() || $('#admin').val()){
            $('#edit').show();
            $('#edit').attr('href','./write.php?w=u&bo_table=<?php echo $bo_table ?>&wr_id='+wr_id);
            $('#del').show();
        }

    }

</script>

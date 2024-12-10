<?
// 버전에 따라 테이블 명이 다름
// 직접 sql문을 쓰므로 테이블명 통일이 필요
//$_table_name = "".$bbs_id;		// 이전 버전 rg_ 없어야 됨
$_table_name = "rg_".$bbs_id;		// 새 버전 rg_ 있어야 됨

$suncor="FFF0FD"; //일요일 배경색
$sunfcor="FF3000"; //일요일 글자색
$satcor="ECF5FF"; //토요일 배경색
$satfcor="3262B1"; //토요일 글자색
$daycor="F5F8F8"; // 평일 배경색
$dayfcor=""; // 평일 글자색

$height="70";//셀의 높이
$width1=round($width/7)."%"; //셀의 폭=표의 폭/7
$table_color="C0C0C0"; //요일구분의 배경색
$table_line="9F9D9D"; //표의 라인색

//오늘 날짜
$thisyear  = date('Y');  
$thismonth = date('n');  
$today     = date('j');  

//$year, $month 값이 없으면 현재 날짜
if (!$year) { $year = $thisyear;}
if (!$month) { $month = $thismonth;}

$datelike=date('Y-m-',mktime(0,0,0,$month,1,$year));
$start_where=mktime(0,0,0,$month,1,$year);
$end_where=mktime(0,0,0,$month,31,$year);

$_SQL="select * from ".$_table_name."_body where rg_ext5>=$start_where and rg_ext5<=$end_where";

	if (!get_magic_quotes_gpc()) {
		$ss[kw] = addslashes($ss[kw]);
	}

	if(!empty($ss[kw]) && count($ss) > 0 ){
		$find=array();
		reset($ss);
		while (list ($ss_key, $ss_val) = each ($ss)) {
			if($ss_val=='1') {
				switch($ss_key) {
					case 'sn' : 
						$find[]=" (rg_name Like '%{$ss[kw]}%') ";
						break;
					case 'st' : 
						$find[]=" (rg_title Like '%{$ss[kw]}%') ";
						break;
					case 'sc' :
						$find[]=" (rg_content Like '%{$ss[kw]}%') ";
						break;
				}
			}
		}		
		if(count($find) > 0) {
			if($ss[sf] == 'and') {
				$where_str.=" AND (".implode("AND",$find).")";
			} else {
				$where_str.=" AND (".implode("OR",$find).")";
			}
		}
		unset($find);
		unset($key);
		unset($val);
	}
	
	if($ss[fc]) $where_str.=" AND (rg_cat_num = '{$ss[fc]}') ";

	$_SQL .= $where_str;

	$_SQL .= " order by rg_ext1 ASC ";

$sql=mysql_query($_SQL);


for($n=0;$seong_data[$n]=mysql_fetch_array($sql);$n++);


//날짜의 범위 체크
if ( $year > 9999 || $year < 0 ){
	 rg_href('',"연도는 0~9999년만 가능합니다.",'','back'); 
}

if ( $month > 12|| $month < 0 ){
     rg_href('',"달은 1~12만 가능합니다.",'','back'); 
}

if ( $day > 31|| $day < 0 ){
     rg_href('',"일은 1~31만 가능합니다.",'','back'); 
}

$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));

//전월, 차월 이동링크
$pmonth = $month;
$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $year ;
$nextyear = $year ;
$prevyeary = $year - 1;
$nextyeary = $year + 1;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year -1;
} 
elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year +1;
}
$currentToday=mktime(0,0,0,date("m"),date("d"),date("Y"));

//1일의 요일
$fors = date('w',mktime(0,0,0,$month,1,$year));
$fore = date('w',mktime(0,0,0,$month,$maxdate,$year));
?>
	<div class="cal_title">
		<span><a href="mobile_list.php?bbs_id=<?=$bbs_id?>&year=<?=$prevyear?>&month=<?=$prevmonth?>">◀</a></span>
		<span><?=$year?>-<?=$month?></span>
		<span><a href="mobile_list.php?bbs_id=<?=$bbs_id?>&year=<?=$nextyear?>&month=<?=$nextmonth?>">▶</a></span>
	</div>
<?
	for($day=1;$day <= $maxdate;$day++) {
		$book=mktime(0, 0, 0, $month, $day, $year);
		
?>
<div class="bbs_cal_list">
	<ul>
		<li class="bbs_cal_day"><?=$day?></li>
		<li>
		<span class="bbs_cal_title" style="padding-top:9px">
		<?
							$sql="select * from $bbs_table where rg_ext5='$book'";
										$result=mysql_query($sql);
										$g_num=mysql_num_rows($result);
										$sql="select * from rg_".$bbs_id."_category";
										$result2=mysql_query($sql);
										$c_num=mysql_num_rows($result2);
										if($c_num==$g_num){?>
										<img src="<?=$skin_board_path?>images/not.gif" alt=예약불가>
										<?}else{
											if($book<=$currentToday){
											?>
											<img src="<?=$skin_board_path?>images/not.gif" alt=예약불가>
											<? }else{?>
										<? if($book == "1379516400"){ ?><div><B>< 휴 장 ></B></div>
										<? }else{ ?>
										<a href="mobile_time_list.php?bbs_id=<?=$bbs_id?>&year=<?=$year?>&month=<?=$month?>&day=<?=$day?>&book=<?=$book?>"><img src="<?=$skin_board_path?>images/yes.gif" alt=예약가능 border=0></a>
										<? } ?>
										<?}}?>
		</span>
		<span class="bbs_cal_title">
		<?
			for($s=0;$s<sizeof($seong_data);$s++)	{
				if($seong_data[$s][rg_ext5]==$book)	{
					$doc_num2=$seong_data[$s][rg_doc_num];
					$cmt_count=$seong_data[$s][rg_cmt_count];
					$rg_title=$seong_data[$s][rg_title];
					$rg_name=$seong_data[$s][rg_name];
					$rg_content= $seong_data[$s][rg_content];
					$rg_content=strip_tags($rg_content);//미니에디터적용으로 수정
					$rg_content= rg_cut_string($rg_content, 50, $suffix="...");
					$rg_notice=$seong_data[$s][rg_notice];
					$rg_ext1=$seong_data[$s][rg_ext1];
					//$rg_ext2=$seong_data[$s][rg_ext2];
					$complete=$seong_data[$s][complete];
					if($complete == "y") {
					$img="";
					$rg_name="<font color=blue><b>".$rg_name."</b>";
					} else {
					$img="";
					}?>
					
					<?
					/*if($rg_ext1){
					echo("<a href='mobile_view.php?$p_str&bbs_id=$bbs_id&doc_num=$doc_num2&year=$year&month=$month&day=$day&' title='$rg_content'>{$img}");
					
						echo("".$rg_ext1."시&nbsp;".$rg_name."</a> ");
					}*/
					
				}
			}
			?>
			</span>
			
		</li>
	</ul>
</div>
</a>
<? }?>
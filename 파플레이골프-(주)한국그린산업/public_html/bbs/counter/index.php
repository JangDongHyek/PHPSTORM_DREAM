<?
	$site_path='../';
	$site_url='../';
	require_once($site_path.'include/lib.inc.php');
	require_once($site_path.'counter/counter.cfg.php');
	
	function open_url($url){
		if(strpos($url,'%')>0) {
		  return urlencode($url);
		} else {
		  return $url;
		}
	}
	
	// 접속가능 체크
	if(!$access_guest && (!$access_guest && !$auth[site_admin])) {
		rg_href("","관리자만 접속 가능합니다.",'',"close");
	}
	
	// 최대 최소 년도
	$dbqry="
			SELECT min(yyyy),max(yyyy)
			FROM `rg_counter_log`
	";
	$rs=query($dbqry,$dbcon);
	$tmp=mysql_fetch_array($rs);
	$min_year=$tmp[0];
	$max_year=$tmp[1];
	$min_year=($min_year)?$min_year:date('Y');
	$max_year=($max_year)?$max_year:date('Y');
	
	$dbqry="
			SELECT min(mm)
			FROM `rg_counter_log`
			WHERE yyyy='$min_year'
	";
	$rs=query($dbqry,$dbcon);
	$tmp=mysql_fetch_array($rs);
	$min_year_month=$tmp[0];
	$min_year_month=($min_year_month)?$min_year_month:date('m');

	$dbqry="
			SELECT max(mm)
			FROM `rg_counter_log`
			WHERE yyyy='$max_year'
	";
	$rs=query($dbqry,$dbcon);
	$tmp=mysql_fetch_array($rs);
	$max_year_month=$tmp[0];
	$max_year_month=($max_year_month)?$max_year_month:date('m');
	
	$max_year_month_day=date("t", mktime(0, 0, 0, $max_year_month, 1, $max_year));

	$type_list=array('hour','day','month','year','browser','ip','ref','page','list_ref','week');
	if(!in_array($type,$type_list)) $type='hour';
	if('list_ref'==$type && $kw!='') $cal_str="&sel=$sel&kw=$kw";
	$time_start=($time_start)?$time_start:date('Y-m-d');
	$time_end=($time_end)?$time_end:date('Y-m-d');
	
	list($year,$month)=explode("-",$time_end);
	
	$month=($month!='')?$month:date('m');
	$year=($year!='')?$year:date('Y');	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Let's080 ver
<?=$C_RGBOARD_VERSION?>
- 접속통계</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_site_url?>style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.btn1 {
	border: 1px solid;
}

td.title {
  text-align: center;
  padding-top: 2pt;
  padding-bottom: 2pt;
  background-color = rgb(245,245,255);
}

th.sunday {
  text-align: center;
  background-color: rgb(255,220,224);
  border-style: none;
}

th.saturday {
  text-align: center;
  background-color: rgb(224,220,255);
  border-style: none;
}

th.weekday {
  text-align: center;
  background-color: rgb(221,221,221);
  border-style: none;
}

td.invalid {
  text-align: center;
}

td.valid {
  text-align: center;
  background-color: #c8F8F8;
}

td.today {
  text-align: center;
  background-color: rgb(248,255,240);
}

td.omonth {
  text-align: center;
  background-color: rgb(248,245,240);
}

tr.omonth {
  text-align: center;
  background-color: #f8f8c8;
}

p.title {
  font-weight:bold
}

p.sunday {
  color: #D00000;
}

p.saturday {
  color: #0000D0;
}

p.weekday {
  color: #000000;
}

.smaller {
}

a.2			{ text-decoration:none; }
a.2:link		{color: #ff0000;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:active	{color: #ccffff;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:visited	{color: #ff0000;font-family: 굴림;font-size: 9pt;text-decoration: none}
a.2:hover		{color: #3078a8;font-family: 굴림;font-size: 9pt;text-decoration: none}

-->
</style>
</head>
<script src="calendar.js"></script>
<body>
<table width="700" border="0" cellpadding="0" cellspacing="0">
  <tr align="center">
    <td width="70"><a href="?type=hour&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='hour')?'<b>':'')?>
      시간별</a></td>
    <td width="70"><a href="?type=day&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='day')?'<b>':'')?>
      일별</a></td>
    <td width="70"><a href="?type=week&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='week')?'<b>':'')?>
      요일별</a></td>
    <td width="70"><a href="?type=month&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='month')?'<b>':'')?>
      월별</a></td>
    <td width="70"><a href="?type=year&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='year')?'<b>':'')?>
      년별</a></td>
    <td width="70"><a href="?type=browser&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='browser')?'<b>':'')?>
      브라우저별</a></td>
    <td width="70"><a href="?type=ip&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='ip')?'<b>':'')?>
      아이피별</a></td>
    <td width="70"><a href="?type=ref&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='ref')?'<b>':'')?>
      접속경로별</a></td>
    <td width="70"><a href="?type=page&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='page')?'<b>':'')?>
      페이지별</a></td>
    <td width="70"><a href="?type=list_ref&time_start=<?=$time_start?>&time_end=<?=$time_end?>">
      <?=(($type=='list_ref')?'<b>':'')?>
      접속로그</a></td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>조회기간선택</td>
          </tr>
          <tr>
            <td>ㆍ<a href="?type=<?=$type?>&time_start=<?=$min_year?>-<?=$min_year_month?>-1&time_end=<?=$max_year?>-<?=$max_year_month?>-<?=$max_year_month_day?><?=$cal_str?>">전체</a></td>
          </tr>
          <tr>
            <td>ㆍ기간지정 </td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
				        <form name="form1" method="get" action="">
<?
	if($cal_str!='') {
?>
								<input type="hidden" name="sel" value="<?=$sel?>">
								<input type="hidden" name="kw" value="<?=$kw?>">
<?
	}
?>
								<input type="hidden" name="type" value="<?=$type?>">
                <tr>
                  <td align="right"><input name="time_start" type="text" class="btn1" id="time_start" value="<?=$time_start?>" size="9" maxlength="10" onClick="changeCal2(time_start.value);ret_name = time_start;showXY(document.all.time_start);"></td>
                  <td align="center">~</td>
                  <td align="right"><input name="time_end" type="text" class="btn1" id="time_end" value="<?=$time_end?>" size="9" maxlength="10" onClick="changeCal2(time_end.value);ret_name = time_end;showXY(document.all.time_end);"></td>
                  <td></td>
                  <td><input type="submit" class="btn1" value="Go"></td>
                </tr>
							</form>
              </table></td>
          </tr>
          <tr>
            <td>ㆍ주/일 선택 </td>
          </tr>
          <tr>
            <td>
<!-- 달력시작 -->
<?
	$maxdate = date("t", mktime(0, 0, 0, $month, 1, $year));   // 해당월의 일수
	
	$prevmonth = $month - 1;
	$nextmonth = $month + 1;
	$prevyear = $year;
	$nextyear = $year;
	if ($month == 1) {
		$prevmonth = 12;
		$prevyear = $year - 1;
	} elseif ($month == 12) {
		$nextmonth = 1;
		$nextyear = $year + 1;
	}
?>
              <TABLE cellSpacing=0 cellPadding=0 width=100% border=1 bordercolorlight=#CCCCCC bordercolordark=white bgcolor=white>
                <TR>
                  <!-- 월 표시 및 이동 -->
                  <TD width=100% align=center><!--<a href=<?=$PHP_SELF?>?tmode=edit&year=<?=$prevyear?>&month=<?=$prevmonth?>><span class=smaller>◀</span></a>-->
                    <?=$year?>
                    년
                    <?=$month?>
                    월<!-- <a href=<?=$PHP_SELF?>?tmode=edit&year=<?=$nextyear?>&month=<?=$nextmonth?>><span class=smaller>▶</span></a> --></TD>
                  <!-- 월 표시 및 이동 끝 -->
                </TR>
							</table>
							<TABLE cellSpacing=0 cellPadding=0 width=100% border=1 bordercolorlight=#CCCCCC bordercolordark=white bgcolor=white>
                <TR>
                  <!-- 요일 헤더 -->
                  <td class="title">주</td>
                  <td class="title">일</td>
                  <td class="title">월</td>
                  <td class="title">화</td>
                  <td class="title">수</td>
                  <td class="title">목</td>
                  <td class="title">금</td>
                  <td class="title">토</td>
                    <!-- 요일 헤더 끝 -->
                </TR>
                <!-- 날짜 테이블 -->
                  <?
	$date = 1;
	$week = 1;
	
	// 마지막 날자의 요일구하기
	$offlast = date('w', mktime(0, 0, 0, $month+1, 0, $year)); // 일요일~토요일(0~6)
	if(6!=$offlast) // 토요일이 아니면
		$maxdate += 6-$offlast;  // 화면에 표시될 날수 계산 (토요일까지 표시)
	
	// 시작 날자의 요일구하기
	$offset = date('w', mktime(0, 0, 0, $month, $date, $year)); // 일요일~토요일(0~6)

	$date += -$offset; // 달력의 시작일 수 계산

	while ($date <= $maxdate) {
	
		list($tdate,$tmonth,$offset)=
		     explode(' ',date('j m w',mktime(0,0,0,$month,$date,$year))); // 일 월 주
		$cdate=date('Y-m-d',mktime(0,0,0,$month,$date,$year)); // 일 월 주

//		if(0==$offset) $offset=7;
		
		if($tmonth == $month)
			$cstyle = 'valid';
		else {
			$cstyle = 'omonth';
		}
	
		if ( $tdate == $today  &&  $tyear == $thisyear &&  $tmonth == $thismonth) {
			$cstyle = 'today';
		}
	
	
		switch ($offset) {            // 요일에 따라 날짜의 색깔 결정
			case 0: $dstyle = 'class=sunday'; break;
			case 6: $dstyle = 'class=saturday'; break;
			default: $dstyle = 'class=weekday'; break;
		}
		if ($offset == 0) {
			$cdate1=date('Y-m-d',mktime(0,0,0,$month,$date+6,$year));
?>
			<TR><td class="omonth"><a href="?type=<?=$type?>&time_start=<?=$cdate?>&time_end=<?=$cdate1?><?=$cal_str?>">▶</a></td>
<?
		}
?>
<TD class="<?=$cstyle?>"><a href="?type=<?=$type?>&time_start=<?=$cdate?>&time_end=<?=$cdate?><?=$cal_str?>"><p <?=$dstyle?>><?=$tdate?></p></a></TD>
<?
		$date++;
	
		if ($offset == 6) {
			echo "</TR>\n";
//			if ($date <= $maxdate) {
//				echo "<TR><td class=\"omonth\">▶</td>";
//				$week++;
//			}
		}
	
	} // end of while
/*
	if ($offset != 1) {
	  SkipOffset($cellh, $cellw, (9-$offset));
		echo "</TR> \n";
	}
*/
?>
                  <!-- 날짜 테이블 끝 -->
              </TABLE>
              <!-- 달력여기까지 -->
            </td>
          </tr>
          <tr>
            <td>ㆍ월</td>
          </tr>
	        <form name="form2" method="get" action="">
          <tr>
            <td><select name="ym" onChange="location.href='?type=<?=$type?>&'+form2.ym.value+'<?=$cal_str?>'">
<?
for($i=$min_year;$i<=$max_year;$i++) {
	if($i==$min_year)
		$min_month=$min_year_month;
	else
		$min_month=1;

	if($i==$max_year)
		$max_month=$max_year_month;
	else
		$max_month=12;

	for($j=$max_month;$j>=$min_month;$j--) {
		if($year==$i && $month==$j)
			$selected=" selected";
		else
			$selected="";
		$max_day=date("t", mktime(0, 0, 0, $j, 1, $i));	
?>
<option <?=$selected?> value="time_start=<?=$i?>-<?=$j?>-1&time_end=<?=$i?>-<?=$j?>-<?=$max_day?>"><?=$i?> 년 <?=$j?> 월</option>
<?
	}
}
?>
		</select>
              <input type="button" class="btn1" value="Go" onClick="location.href='?type=<?=$type?>&'+form2.ym.value+'<?=$cal_str?>'">
						</td>
          </tr>
          <tr>
            <td>ㆍ년</td>
          </tr>
          <tr>
            <td><select name="yy" onChange="location.href='?type=<?=$type?>&'+form2.yy.value+'<?=$cal_str?>'">
<?
for($i=$min_year;$i<=$max_year;$i++) {
	if($i==$min_year)
		$min_month=$min_year_month;
	else
		$min_month=1;

	if($i==$max_year)
		$max_month=$max_year_month;
	else
		$max_month=12;
		
	if($year==$i)
		$selected=" selected";
	else
		$selected="";
?>
<option <?=$selected?> value="time_start=<?=$i?>-<?=$min_month?>-1&time_end=<?=$i?>-<?=$max_month?>-31"><?=$i?> 년</option>
<?
}
?>
		</select>
            <input type="button" class="btn1" value="Go" onClick="location.href='?type=<?=$type?>&'+form2.yy.value+'<?=$cal_str?>'"></td>
          </tr>
        </form>
    </table></td>
    <td valign="top">
<?
	list($start_year,$start_month,$start_day)=explode('-',$time_start);
	list($end_year,$end_month,$end_day)=explode('-',$time_end);	
	$SQL_WHERE="
		AND yyyy*10000+mm*100+dd>=$start_year*10000+$start_month*100+$start_day
		AND yyyy*10000+mm*100+dd<=$end_year*10000+$end_month*100+$end_day
	";
/*	$SQL_WHERE="
		AND yyyy>=$start_year AND yyyy<=$end_year
		AND mm>=$start_month AND mm<=$end_month
		AND dd>=$start_day AND dd<=$end_day
	"; */
	$data=array();
	include($type.'.inc.php');
?></td>
  </tr>
</table>
<br>
</body>
</html>
<script language=javascript>
	createLayer('Calendar');
//	changeCal(<?=$c_month?>,<?=$c_year?>)	
	hide();
</script>

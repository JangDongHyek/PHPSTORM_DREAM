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

$sql=mysql_query($_SQL);

//echo $_SQL;

for($n=0;$seong_data[$n]=mysql_fetch_array($sql);$n++);

function skipoffset($sno,$eno) {
  for ($i=$sno; $i <= $eno; $i++) {
   ?>
	   <td align="center" valign="top">
					    <table cellpadding="0" cellspacing="0" border="0" width="99%">
						  <tr>
						    <td>&nbsp;</td>
							<td width="14" bgcolor="<?=f5f8f8?>" align="center">&nbsp;</td>
						  </tr>
						</table>
					  </td>
	   <?
  }
}

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

//1일의 요일
$fors = date('w',mktime(0,0,0,$month,1,$year));
$fore = date('w',mktime(0,0,0,$month,$maxdate,$year));
?>
<TABLE cellspacing=0 cellpadding=0 border=0 width=<?=$width?>>
	<tr>
		<td width=30% align=center valign=bottom>
<? include ($skin_board_path."prev_schedule.php"); ?>
</TD>
<TD valign=bottom>
		<? include ($skin_board_path."today_schedule.php"); ?>
</TD>
<TD width=30% align=center valign=bottom>
<? include ($skin_board_path."next_schedule.php"); ?>
</TD>
</TR>
</TABLE>
<br>
<TABLE cellspacing=0 cellpadding=0 border=0  width=100%>
	<tr>
		<td height="26" valign="top" align="center">
			<table cellpadding="0" cellspacing="0" border="0" width=100%>
				<tr>
					<?=$show_category_begin?>
					<td width="33%">
					<IMG src="<?=$skin_board_url?>images/category.gif" border=0> <select name=ca_id onchange="location='<?=$u_category?>'+this.value;" class=select><option value=''>전체</option><?=$category_list_option?></select><a href="admin/board_category.php?bbs_id=<?=$bbs_id?>" target="category" onclick="open('','category','scrollbars=yes,width=400,height=500')">[분류수정]</a>
					</td>
				    <?=$show_category_end?>
					<td align="left" style="font-weight:bold; font-size:12px;">
					<img src=<?=$skin_board_url?>images/arrow_1.gif border=0 align=absmiddle> <?=$year?>년 <?=$month?>월 업무 일정
					</td>
					<td width="50%" align=right>
			        <a href="list.php?bbs_id=<?=$bbs_id?>&year=<?=$prevyeary?>&month=<?=$pmonth?>"><img src=<?=$skin_board_url?>images/prev_year.gif border=0 align=absmiddle alt="<?=$prevyeary?>년 <?=$pmonth?>월 보기"></a>
					<a href="list.php?bbs_id=<?=$bbs_id?>&year=<?=$prevyear?>&month=<?=$prevmonth?>"><img src=<?=$skin_board_url?>images/prev_month.gif border=0 align=absmiddle alt="<?=$prevyear?>년 <?=$prevmonth?>월 보기"></a>
					<a href="list.php?bbs_id=<?=$bbs_id?>&year=<?=$thisyear?>&month=<?=$thismonth?>"><img src=<?=$skin_board_url?>images/this_month.gif border=0 align=absmiddle alt="<?=$thisyear?>년 <?=$thismonth?>월 보기"></a>
					<a href="list.php?bbs_id=<?=$bbs_id?>&year=<?=$nextyear?>&month=<?=$nextmonth?>"><img src=<?=$skin_board_url?>images/next_month.gif border=0 align=absmiddle alt="<?=$nextyear?>년 <?=$nextmonth?>월 보기"></a>
					<a href="list.php?bbs_id=<?=$bbs_id?>&year=<?=$nextyeary?>&month=<?=$pmonth?>"><img src=<?=$skin_board_url?>images/next_year.gif border=0 align=absmiddle alt="<?=$nextyeary?>년 <?=$pmonth?>월 보기"></a>
					
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top">
				  <table cellpadding="0" cellspacing="1" border="0" bgcolor=<?=$table_line?> width=100%>
				    <tr bgcolor="#FFFFFF">
					  <td height="20" width="14%">
					    <table height="20" cellpadding="0" cellspacing="0" border="0" width="99%" bgcolor="#ffffff">
						  <tr>
						    <td align="center" bgcolor=<?=$table_color?> style="color:<?=$suncor?>;font-weight:bold;font-family:tahoma;">SUN</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:FFFFFF;font-weight:bold;font-family:tahoma;">MON</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:FFFFFF;font-weight:bold;font-family:tahoma;">THU</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:FFFFFF;font-weight:bold;font-family:tahoma;">WED</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:FFFFFF;font-weight:bold;font-family:tahoma;">THU</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:FFFFFF;font-weight:bold;font-family:tahoma;">FRI</td>
						  </tr>
						</table>
					  </td>
					  <td width="14%">
					    <table cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" width="99%" height="20">
						  <tr>
						    <td bgcolor=<?=$table_color?> align="center" style="color:<?=$satcor?>;font-weight:bold;font-family:tahoma;">SAT</td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr bgcolor=ffffff>
<?
	skipoffset(1,$fors); 
	for($day=1;$day <= $maxdate;$day++) {
	$day_no=$day+0;
	$book=mktime(0, 0, 0, $month, $day, $year);
    $offset = date('w',$book);

	if($offset == 0)	 {
		$bgcolor=$suncor;
		$fontcolor=$sunfcor;
	} 
	elseif($offset == 6) {
		$bgcolor=$satcor;
		$fontcolor=$satfcor;
	} else {
		$bgcolor=$daycor;
		$fontcolor=$dayfcor;
	}

//오늘일 경우 셀 디자인 표시
if($day==$today && $month==$thismonth && $year==$thisyear){
$today_bg='bgcolor=#FFFDD';
} else { 
$today_bg='';
}
?>
					<td valign="top" height=<?=$height?> width='<?=$width1?>' <?=$today_bg?>>
						<table cellpadding="0" cellspacing="0" border="0" width=99% style="table-layout:fixed;">
						  <tr>
						    <td width=<?=$width1-14?>></td>
							<td width="14" bgcolor="<?=$bgcolor?>" align="center">
							<?=$show_write_begin?>
							<a href="write.php?bbs_id=<?=$bbs_id?>&book=<?=$book?>">							<?=$show_write_end?>
							<font face="tahoma" color="<?=$fontcolor?>"><?=$day?><font>
							<?=$show_write_begin?>
							</a>
							<?=$show_write_end?>
							</td>
						  </tr>
								<?
								for($s=0;$s<sizeof($seong_data);$s++)	{
									if($seong_data[$s][rg_ext5]==$book)	{
										$doc_num2=$seong_data[$s][rg_doc_num];
										$cmt_count=$seong_data[$s][rg_cmt_count];
										$rg_title=$seong_data[$s][rg_title];
										$rg_content= $seong_data[$s][rg_content];
										$rg_content=strip_tags($rg_content);//미니에디터적용으로 수정
										$rg_content= rg_cut_string($rg_content, 50, $suffix="...");
										$rg_notice=$seong_data[$s][rg_notice];
										if($rg_notice>0) {
										$img="<img src={$skin_board_url}images/notice.gif border=0 align=absmiddle>";
										$rg_title="<b>".$rg_title."</b>";
										} else {
										$img="<img src={$skin_board_url}images/dot.gif border=0 align=absmiddle>";
										}
								
										echo("<tr><td width=100% colspan=2 style=\"padding:2;color:666666;font-size:8pt;\"><a href='view.php?$p_str&bbs_id=$bbs_id&doc_num=$doc_num2&year=$year&month=$month&day=$day&' title='$rg_content'>{$img}");
										echo($rg_title."</a> ");
										if($cmt_count!=0)
										echo("<span style=font-family:tahoma;color:990000;font-size:7pt;font-weight:bold;>[$cmt_count]</span></a>");
										echo("</td></tr>");
									}
								}
								?>
						</table>
					</td>
<?
  if ($offset == 6 && $day!=$maxdate) {
    echo "				</TR> \n";
    echo "				<TR bgcolor=#FFFFFF> \n";
    }
}

if ($offset != 6) {
  skipoffset($fore,5);
  echo "				</TR> \n";
}
echo "				  </TABLE>
			    </TD>
		      </TR>
	        </TABLE><br>";
?>

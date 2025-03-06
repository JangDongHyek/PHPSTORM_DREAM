<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

global $member;

// 글자 색상
$weekday_color = ""; // 평일
$saturday_color = "blue"; // 토요일
$sunday_color = "red"; // 일요일 (공휴일)
$select_color = "#CC0000"; // 선택일 배경색
$select_color2 = "#FFFFFF"; //선택일 글자색
// 배경 색상
$title_bgcolor = "#f4f4f4"; // 타이틀
$today_bgcolor = "#FEEDB4"; // 오늘 

// 요일
$yoil = array ("일", "월", "화", "수", "목", "금", "토");

// mktime() 함수는 1970 ~ 2038년까지만 계산되므로 사용하지 않음
// 참고 : http://phpschool.com/bbs2/inc_view.html?id=3924&code=tnt2&start=0&mode=search&s_que=mktime&field=title&operator=and&period=all
function spacer($year, $month)
{
    $day = 1;
    $spacer = array(0, 3, 2, 5, 0, 3, 5, 1, 4, 6, 2, 4);
    $year = $year - ($month < 3);
    $result = ($year + (int) ($year/4) - (int) ($year/100) + (int) ($year/400) + $spacer[$month-1] + $day) % 7;
    return $result;
}

$mm = $_REQUEST[month];
$yyyy = $_REQUEST[year];
if(!$yyyy){
	$yyyy=date("Y");
}
if(!$mm){
	$mm=date("m");
}
// 오늘
$today = getdate($g4[server_time]);
$mon  = substr("0".$today[mon],-2);
$mday = substr("0".$today[mday],-2);

if (!$yyyy) $yyyy = $today['year'];
if (!$mm) $mm = $today['mon'];

$yyyy = (int)$yyyy;
$mm = (int)$mm;

$f = @file("$g4[path]/bbs/calendar/$yyyy.txt");
if ($f) {
    while ($line = each($f)) {
        $tmp = explode("|", $line[value]);
        $nal[$tmp[0]] = $tmp;
        //print_r2($nal);
    }
}

$spacer = spacer($yyyy, $mm);

$endday = array(1=>31, 28, 31, 30 , 31, 30, 31, 31, 30 ,31 ,30, 31);
// 윤년 계산 부분이다. 4년에 한번꼴로 2월이 28일이 아닌 29일이 있다.
if( $yyyy%4 == 0 && $yyyy%100 != 0 || $yyyy%400 == 0 )
    $endday[2] = 29; // 조건에 적합할 경우 28을 29로 변경

// 해당월의 1일
$mktime = mktime(0,0,0,$mm,1,$yyyy);
$dt = getdate(strtotime(date("Y-m-1", $mktime)));

$dt[wday] = $spacer;

// 해당월의 마지막 날짜,
//$last_day = date("t", $mktime);
$last_day = $endday[$mm];

$yyyy_before = $yyyy;
$mm_before = $mm - 1;
if ($mm_before < 1)
{
    $yyyy_before--;
    $mm_before = 12;
}

$yyyy_after = $yyyy;
$mm_after = $mm + 1;
if ($mm_after > 12)
{
    $yyyy_after++;
    $mm_after = 1;
}

if (strstr($_SERVER[PHP_SELF],"board.php") == "board.php" || strstr($_SERVER[PHP_SELF],"write.php") == "write.php")
	$bo_link="bo_table=$bo_table";

$yyyy_before_href = "$_SERVER[PHP_SELF]?$bo_link&year=".($yyyy-1)."&month={$mm}";
$yyyy_after_href = "$_SERVER[PHP_SELF]?$bo_link&year=".($yyyy+1)."&month={$mm}";
$mm_after_href = "$_SERVER[PHP_SELF]?$bo_link&year={$yyyy_after}&month={$mm_after}";
$mm_before_href = "$_SERVER[PHP_SELF]?$bo_link&&year={$yyyy_before}&month={$mm_before}";

//if ($member[mb_id] && $member[mb_level] >= 5)
//{ // 정회원이상일때 출력
//$s_subject = "<tr><td class='menu_t' align=center><b><a href='$g4[bbs_path]/board.php?bo_table=$bo_table'>".$config['cf_title']." 일정안내</a></b></td></tr>";

$mm0 = sprintf("%02d",$mm);
$query = " select * from $write_table where left(wr_link1,6) <= '$yyyy$mm0' and left(wr_link2,6) >= '$yyyy$mm0' order by wr_id asc";
$rst = sql_query($query);
while ( $row = sql_fetch_array($rst) )
{
	if(	$row[wr_link1]===$row[wr_link2])	{
		$is_day = substr($row[wr_link1],6,2);
		settype($is_day,integer);
		$pr_day[$is_day] = "Y";
	} else	{
		for ($i = $row[wr_link1]; $i<=$row[wr_link2]; $i++)
		{	$is_day = substr($i,6,2);
			settype($is_day,integer);
			$pr_day[$is_day] = "Y" ;
		}
	}
}
//}
?>
<style>
.lt_cal{position:relative;}
.lt_cal .lt_title {display:block;padding:0px 0 8px 0; font-size:1.3em; color:#333; font-weight:normal;}
.lt_cal .lt_title .fa{font-size:0.8em;}
.lt_cal .lt_more {position:absolute;top:0px;right:0px; }
.lt_cal .lt_more a{color:#999;}
.tbl_t{ border-top:1px solid #444; border-bottom:0; font-size:15px;}
.tbl_cal{ border:1px solid #ccc;}

</style>

<div class="lt_cal">
  <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><i class="fal fa-calendar-alt"></i> <?php echo $bo_subject; ?></a><span><?php echo $config['cf_title']; ?></span></strong>
  <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>자세히 <i class="far fa-plus"></i></a></div>
        <!-- Title start -->
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbl_t">
            <?=$s_subject?>
            <tr height="28">
                <td align="center" height=35>
                    <a href='<?=$yyyy_before_href?>'><i class="fa fa-angle-double-left"></i></a>&nbsp;
                    <a href='<?=$mm_before_href?>'><i class="fa fa-angle-left"></i></a>&nbsp;&nbsp;&nbsp;<?=$yyyy?>년 <?=$mm?>월&nbsp;&nbsp;&nbsp;
                    <a href='<?=$mm_after_href?>'><i class="fa fa-angle-right"></i></a>&nbsp;
                    <a href='<?=$yyyy_after_href?>'><i class="fa fa-angle-double-right"></i></a>
                </td>
          </tr>
        </table>
  <!-- Title end -->
        <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="tbl_cal">
            <tr>
                <td valign="top">
                    <table width=100% cellpadding=0 cellspacing=0 border=0 bgcolor="#E9E9E9">
                        <tr height="30" bgcolor="<?=$title_bgcolor?>" align="center">
                            <td width=14% style="color:<?=$sunday_color?>"><?=$yoil[0];?></td>
                            <td width=14% style="color:<?=$weekday_color?>"><?=$yoil[1];?></td>
                            <td width=14% style="color:<?=$weekday_color?>"><?=$yoil[2];?></td>
                            <td width=14% style="color:<?=$weekday_color?>"><?=$yoil[3];?></td>
                            <td width=14% style="color:<?=$weekday_color?>"><?=$yoil[4];?></td>
                            <td width=14% style="color:<?=$weekday_color?>"><?=$yoil[5];?></td>
                            <td width=14% style="color:<?=$saturday_color?>"><?=$yoil[6];?></td>
                        </tr>
                    <?
                    $cnt = $day = 0;
                    for ($i=0; $i<6; $i++)
                    {
                        echo "<tr>";
                        for ($k=0; $k<7; $k++)
                        {
                            $cnt++;
                            echo "<td style='background:#FFFFFF;' align=center>";
                            if ($cnt > $dt[wday])
                            {
                                $day++;
                                if ($day <= $last_day)
                                {
                                    $mm2 = substr("0".$mm,-2);
                                    $day2 =  substr("0".$day,-2);
                                    
                                    if ($pr_day[$day] == "Y")
                                    {
                                        $background = "background-image:url('$g4[path]/skin/latest/$skin_dir/img/RedC.jpg');";
                                        $pr_link = "<a href=\"javascript:win_open('$g4[path]/pop_schedule.php?bo_table=$bo_table&year=$yyyy&month=$mm2&day=$day2','schedule','left=50, top=50, width=300, height=400, scrollbars=1');\"><b>{$day}</b></a>";
                                    } else { 
                                        $background = "";
                                        $pr_link="{$day}"; 
                                    }
                                    echo "<table width=100% height=100% cellpadding=0 cellspacing=0><tr><td style=\"padding:4px;font-size:8pt;{$background}\" id=\"id$i$k\" align=center style=\"cursor:crosshair;\">{$pr_link}</td></tr></table>";
                                    if ($k==0)
                                        echo "<script language='JavaScript'>document.getElementById('id$i$k').style.color='$sunday_color';</script>";
                                    else if ($k==6)
                                        echo "<script language='JavaScript'>document.getElementById('id$i$k').style.color='$saturday_color';</script>";
                                    else
                                        echo "<script language='JavaScript'>document.getElementById('id$i$k').style.color='$weekday_color';</script>";
                                    $tmp_date = $yyyy.substr("0".$mm,-2).substr("0".$day,-2);
                                    $tmp = $mm2."-".$day2;
                                    if ($nal[$tmp])
                                    {
                                        $title = trim($nal[$tmp][1]);
                                        //echo $title;
                                        echo "<script language='JavaScript'>document.getElementById('id$i$k').title='{$title}';</script>";
                                        if (trim($nal[$tmp][2]) == "*") 
                                            echo "<script language='JavaScript'>document.getElementById('id$i$k').style.color='$sunday_color';</script>";
                                        }
                                        // 오늘이라면
                                        if ($today[year] == $yyyy && $today[mon] == $mm && $today[mday] == $day)
                                        {
                                            echo "<script language='JavaScript'>document.getElementById('id$i$k').style.backgroundColor='$today_bgcolor';</script>";
                                            echo "<script language='JavaScript'>document.getElementById('id$i$k').title+='[오늘]';</script>";
                                        }
                                        
                                    } else
                                        echo "&nbsp;";
                            } else
                                echo "&nbsp;";
                                echo "</td>";
                        }
                            echo "</tr>\n";
                            if ($day >= $last_day)
                                break;
                    }
                    ?>
                    </table>
                </td>
            </tr>
            <tr><td height="5"></td></tr>
        </table>
</div>
<?
$szHolyday = array("", "신정", "", "3.1절", "식목일", "어린이날",
				"현충일", "제헌절", "광복절", "개천절", "크리스마스",
				"", "민속의날", "", "석가탄신일", "", "추석", "");
				
$ls_ltbl = array( array(""),
/* 1881 */
	array(1,2,1,2,1,2,2,3,2,2,1,2,1), array(1,2,1,2,1,2,1,2,2,1,2,2,0), array(1,1,2,1,1,2,1,2,2,2,1,2,0), array(2,1,1,2,1,3,2,1,2,2,1,2,2),
	array(2,1,1,2,1,1,2,1,2,1,2,2,0), array(2,1,2,1,2,1,1,2,1,2,1,2,0), array(2,2,1,2,3,2,1,1,2,1,2,1,2), array(2,1,2,2,1,2,1,1,2,1,2,1,0),
	array(2,1,2,2,1,2,1,2,1,2,1,2,0), array(1,2,3,2,1,2,2,1,2,1,2,1,2),
/*1891*/
	array(1,2,1,2,1,2,1,2,2,1,2,2,0), array(1,1,2,1,1,2,3,2,2,1,2,2,2), array(1,1,2,1,1,2,1,2,1,2,2,2,0), array(1,2,1,2,1,1,2,1,2,1,2,2,0),
	array(2,1,2,1,2,3,1,2,1,2,1,2,1), array(2,2,2,1,2,1,1,2,1,2,1,2,0), array(1,2,2,1,2,1,2,1,2,1,2,1,0), array(2,1,2,3,2,2,1,2,1,2,1,2,1),
	array(2,1,2,1,2,1,2,2,1,2,1,2,0), array(1,2,1,1,2,1,2,2,3,2,2,1,2),
/*1901*/
	array(1,2,1,1,2,1,2,1,2,2,2,1,0), array(2,1,2,1,1,2,1,2,1,2,2,2,0), array(1,2,1,2,1,3,2,1,1,2,2,1,2), array(2,2,1,2,1,1,2,1,1,2,2,1,0),
	array(2,2,1,2,2,1,1,2,1,2,1,2,0), array(1,2,2,1,4,1,2,1,2,1,2,1,2), array(1,2,1,2,1,2,2,1,2,1,2,1,0), array(2,1,1,2,2,1,2,1,2,2,1,2,0),
	array(1,2,3,1,2,1,2,1,2,2,2,1,2), array(1,2,1,1,2,1,2,1,2,2,2,1,0),
/*1911*/
	array(2,1,2,1,1,2,3,1,2,2,1,2,2), array(2,1,2,1,1,2,1,1,2,2,1,2,0), array(2,2,1,2,1,1,2,1,1,2,1,2,0), array(2,2,1,2,2,3,1,2,1,2,1,1,2),
	array(2,1,2,2,1,2,1,2,1,2,1,2,0), array(1,2,1,2,1,2,2,1,2,1,2,1,0), array(2,1,3,2,1,2,2,1,2,2,1,2,1), array(2,1,1,2,1,2,1,2,2,2,1,2,0),
	array(1,2,1,1,2,1,2,3,2,2,1,2,2), array(1,2,1,1,2,1,1,2,2,1,2,2,0),
/*1921*/
	array(2,1,2,1,1,2,1,1,2,1,2,2,0), array(2,1,2,2,1,3,2,1,1,2,1,2,2), array(1,2,2,1,2,1,2,1,2,1,1,2,0), array(2,1,2,1,2,2,1,2,1,2,1,1,0),
	array(2,1,2,2,3,2,1,2,2,1,2,1,2), array(1,1,2,1,2,1,2,2,1,2,2,1,0), array(2,1,1,2,1,2,1,2,2,1,2,2,0), array(1,2,3,1,2,1,1,2,2,1,2,2,2),
	array(1,2,1,1,2,1,1,2,1,2,2,2,0), array(1,2,2,1,1,2,3,1,2,1,2,2,1),
/*1931*/
	array(2,2,2,1,1,2,1,1,2,1,2,1,0), array(2,2,2,1,2,1,2,1,1,2,1,2,0), array(1,2,2,1,2,4,1,2,1,2,1,1,2), array(1,2,1,2,2,1,2,2,1,2,1,2,0),
	array(1,1,2,1,2,1,2,2,1,2,2,1,0), array(2,1,1,4,1,2,1,2,1,2,2,2,1), array(2,1,1,2,1,1,2,1,2,2,2,1,0), array(2,2,1,1,2,1,1,4,1,2,2,1,2),
	array(2,2,1,1,2,1,1,2,1,2,1,2,0), array(2,2,1,2,1,2,1,1,2,1,2,1,0),
/*1941*/
	array(2,2,1,2,2,1,4,1,1,2,1,2,1), array(2,1,2,2,1,2,2,1,2,1,1,2,0), array(1,2,1,2,1,2,2,1,2,2,1,2,0), array(1,1,2,1,4,1,2,1,2,2,1,2,2),
	array(1,1,2,1,1,2,1,2,2,2,1,2,0), array(2,1,1,2,1,1,2,1,2,2,1,2,0), array(2,2,3,1,2,1,1,2,1,2,1,2,2), array(2,1,2,1,2,1,1,2,1,2,1,2,0),
	array(2,2,1,2,1,2,1,3,2,1,2,1,2), array(2,1,2,2,1,2,1,1,2,1,2,1,0),
/*1951*/
	array(2,1,2,2,1,2,1,2,1,2,1,2,0), array(1,2,1,2,1,4,2,1,2,1,2,1,2), array(1,2,1,1,2,2,1,2,2,1,2,2,0), array(1,1,2,1,1,2,1,2,2,1,2,2,0),
	array(2,1,1,4,1,1,2,1,2,1,2,2,2), array(1,2,1,2,1,1,2,1,2,1,2,2,0), array(2,1,2,1,2,1,1,2,3,2,1,2,2), array(1,2,2,1,2,1,1,2,1,2,1,2,0),
	array(1,2,2,1,2,1,2,1,2,1,2,1,0), array(2,1,2,1,2,2,3,2,1,2,1,2,1),
/*1961*/
	array(2,1,2,1,2,1,2,2,1,2,1,2,0), array(1,2,1,1,2,1,2,2,1,2,2,1,0), array(2,1,2,1,3,2,1,2,1,2,2,2,1), array(2,1,2,1,1,2,1,2,1,2,2,2,0),
	array(1,2,1,2,1,1,2,1,1,2,2,1,0), array(2,2,2,3,2,1,1,2,1,1,2,2,1), array(2,2,1,2,2,1,1,2,1,2,1,2,0), array(1,2,2,1,2,1,2,3,2,1,2,1,2),
	array(1,2,1,2,1,2,2,1,2,1,2,1,0), array(2,1,1,2,2,1,2,1,2,2,1,2,0),
/*1971*/
	array(1,2,1,1,2,3,2,1,2,2,2,1,2), array(1,2,1,1,2,1,2,1,2,2,2,1,0), array(2,1,2,1,1,2,1,1,2,2,2,1,0), array(2,2,1,2,3,1,2,1,1,2,2,1,2),
	array(2,2,1,2,1,1,2,1,1,2,1,2,0), array(2,2,1,2,1,2,1,2,3,2,1,1,2), array(2,1,2,2,1,2,1,2,1,2,1,1,0), array(2,2,1,2,1,2,2,1,2,1,2,1,0),
	array(2,1,1,2,1,2,4,1,2,2,1,2,1), array(2,1,1,2,1,2,1,2,2,1,2,2,0),
/*1981*/
	array(1,2,1,1,2,1,1,2,2,1,2,2,0), array(2,1,2,1,3,2,1,1,2,2,1,2,2), array(2,1,2,1,1,2,1,1,2,1,2,2,0), array(2,1,2,2,1,1,2,1,1,2,3,2,2),
	array(1,2,2,1,2,1,2,1,1,2,1,2,0), array(1,2,2,1,2,2,1,2,1,2,1,1,0), array(2,1,2,2,1,2,3,2,2,1,2,1,2), array(1,1,2,1,2,1,2,2,1,2,2,1,0),
	array(2,1,1,2,1,2,1,2,2,1,2,2,0), array(1,2,1,1,2,3,1,2,1,2,2,2,2), 
/*1991*/ 
	array(1,2,1,1,2,1,1,2,1,2,2,2,0), array(1,2,2,1,1,2,1,1,2,1,2,2,0), array(1,2,2,3,2,1,2,1,1,2,1,2,1), array(2,2,2,1,2,1,2,1,1,2,1,2,0),
	array(1,2,2,1,2,2,1,2,3,2,1,1,2), array(1,2,1,2,2,1,2,1,2,2,1,2,0), array(1,1,2,1,2,1,2,2,1,2,2,1,0), array(2,1,1,2,1,3,2,2,1,2,2,2,1),
	array(2,1,1,2,1,1,2,1,2,2,2,1,0), array(2,2,1,1,2,1,1,2,1,2,2,1,0),
/*2001*/
	array(2,2,2,1,3,2,1,1,2,1,2,1,2), array(2,2,1,2,1,2,1,1,2,1,2,1,0), array(2,2,1,2,2,1,2,1,1,2,1,2,0), array(1,2,3,2,2,1,2,1,2,2,1,1,2),
	array(1,2,1,2,1,2,2,1,2,2,1,2,0), array(1,1,2,1,2,1,2,3,2,2,1,2,2), array(1,1,2,1,1,2,1,2,2,2,1,2,0), array(2,1,1,2,1,1,2,1,2,2,1,2,0),
	array(2,2,1,1,2,3,1,2,1,2,1,2,2,0), array(2,1,2,1,2,1,1,2,1,2,1,2,0),
/*2011*/
	array(2,1,2,2,1,2,1,1,2,1,2,1,0), array(2,1,2,4,2,1,2,1,1,2,1,2,1), array(2,1,2,2,1,2,1,2,1,2,1,2,0), array(1,2,1,2,1,2,1,2,2,3,2,1,2),
	array(1,2,1,1,2,1,2,2,2,1,2,2,0), array(1,1,2,1,1,2,1,2,2,1,2,2,0), array(2,1,1,2,1,3,2,1,2,1,2,2,2), array(1,2,1,2,1,1,2,1,2,1,2,2,0),
	array(2,1,2,1,2,1,1,2,1,2,1,2,0), array(2,1,2,2,3,2,1,1,2,1,2,1,2),
/*2021*/
	array(1,2,2,1,2,1,2,1,2,1,2,1,0), array(2,1,2,1,2,2,1,2,1,2,1,2,0), array(1,2,3,2,1,2,1,2,2,1,2,1,2), array(1,2,1,1,2,1,2,2,1,2,2,1,0),
	array(2,1,2,1,1,2,3,2,1,2,2,2,1), array(2,1,2,1,1,2,1,2,1,2,2,2,0), array(1,2,1,2,1,1,2,1,1,2,2,2,0), array(1,2,2,1,2,3,1,2,1,1,2,2,1),
	array(2,2,1,2,2,1,1,2,1,1,2,2,0), array(1,2,1,2,2,1,2,1,2,1,2,1,0),
/*2031*/
	array(2,1,2,3,2,1,2,2,1,2,1,2,1), array(2,1,1,2,1,2,2,1,2,2,1,2,0), array(1,2,1,1,2,1,2,3,2,2,2,1,2), array(1,2,1,1,2,1,2,1,2,2,2,1,0),
	array(2,1,2,1,1,2,1,1,2,2,1,2,0), array(2,2,1,2,1,1,4,1,1,2,1,2,2), array(2,2,1,2,1,1,2,1,1,2,1,2,0), array(2,2,1,2,1,2,1,2,1,1,2,1,0),
	array(2,2,1,2,2,3,2,1,2,1,2,1,1), array(2,1,2,2,1,2,2,1,2,1,2,1,0),
/*2041*/
	array(2,1,1,2,1,2,2,1,2,2,1,2,0), array(1,2,3,1,2,1,2,1,2,2,2,1,2), array(1,2,1,1,2,1,1,2,2,1,2,2,0) 
);

function which_day_of_week($year, $month, $day)
{
	$days=0;
	$i;

	for ($i = 1; $i < $year; $i++)
	{
		if (is_yun_year($i)) $days += 366;
		else $days += 365;

		$days = $days % 7;
	}

	for ($i = 1; $i < $month; $i++)
	{
		$days += how_many_days($year, $i);
		$days = $days % 7;
	}

	$days += $day;
	$days = $days % 7;

	return $days;
}

function is_yun_year($year)
{
	if ($year % 4 != 0) return 0;	/* not yun year */
	if ($year % 100 != 0) return 1;	/* yun year */
	if ($year % 400 != 0) return 0;  /* not yun year */
	return 1;						/* yun year */
}

function how_many_days($year, $month)
{
	switch($month)
	{
	case 1: case 3: case 5: case 7: case 8: case 10: case 12:
		return 31;
	case 4: case 6: case 9: case 11:
		return 30;
	case 2:
		if (is_yun_year($year)) return 29;
		else return 28;
	}
}

function is_double_day($row, $col, $day, $days)
{
	if ($row != 4) return 0;
	if ($col > 1) return 0;
	if ($day <= $days ) return 1;
	return 0;
}

function is_holyday($year, $month, $day, $ll_dt)
{
	$is_yun_month;
	if ($month == 1 && $day == 1) return 1;
	if ($month == 1 && $day == 2) return 2;
	if ($month == 3 && $day == 1) return 3;
	if ($month == 4 && $day == 5) return 4;
	if ($month == 5 && $day == 5) return 5;
	if ($month == 6 && $day == 6) return 6;
	if ($month == 7 && $day == 17) return 7;
	if ($month == 8 && $day == 15) return 8;
	if ($month == 10 && $day == 3) return 9;
	if ($month == 12 && $day == 25) return 10;

	/* check traditional holyday */
	if ($year < 1881 || $year > 2043) return 0;

	$is_yun_month = solar_to_lunar(&$year, &$month, &$day, $ll_dt);
	if ($is_yun_month && $month != 12) return 0;
	if ($month == 12 && end_day_of_lunar_month(year, month) == day) return 11;
	if ($month == 1 && $day == 1) return 12;
	if ($month == 1 && $day == 2) return 13;
	if ($month == 4 && $day == 8) return 14;
	if ($month == 8 && $day == 14) return 15;
	if ($month == 8 && $day == 15) return 16;
	if ($month == 8 && $day == 16) return 17;

	return 0;
}

function end_day_of_lunar_month($year, $month)
{
	$i;
	$flag;
	for ($i = 0; $i < $month; $i++)
	{
		$flag = $ls_ltbl[$year-1880][$i];
		if ($flag == '3' || $flag == '4') break;
	}
	if ($i != $month)
		$flag = $ls_ltbl[$year-1880][$month];
	else $flag = $ls_ltbl[$year-1880][$month-1];

	if ($flag == '1') return 29;
	else return 30;
}

function solar_to_lunar($year, $month, $day, $ll_dt)
{
	global $ls_ltbl;
	global $szHolyday;
	$is_yun_month = 0;

	$ll_total_day = 0;

	if ($year < 1881 || $year > 2043) return -1;
//	for ($ll_i = 1; $ll_i <= 163; $ll_i++)
//	{
//		$ll_dt[$ll_i] = 0;
//		for ($ll_j = 1; $ll_j <= 12; $ll_j++)
//		{	
//			switch($ls_ltbl[$ll_i][$ll_j-1])
//			{
//			case '1': case '3':
//				$ll_dt[$ll_i] = $ll_dt[$ll_i] + 29;
//				break;
//			case '2': case '4':
//				$ll_dt[$ll_i] = $ll_dt[$ll_i] + 30;
//				break;
//			}
//		}
//		switch($ls_ltbl[$ll_i][12])
//		{
//		case '0':
//			break;
//		case '1': case '3':
//			$ll_dt[$ll_i] = $ll_dt[$ll_i] + 29;
//			break;
//		case '2': case '4':
//			$ll_dt[$ll_i] = $ll_dt[$ll_i] + 30;
//			break;
//		}
//	}

	/* sum of days to 1880-1-30 */
	$ll_total_day1 = 1880*365 + floor(1880/4) - floor(1880/100) + floor(1880/400) + 30;
	$ll_k11 = $year - 1;

	/* sum of days to input day */
	$ll_total_day2 = $ll_k11*365 + floor($ll_k11/4) - floor($ll_k11/100) + floor($ll_k11/400);
	
	for($ll_i = 1; $ll_i <= $month - 1; $ll_i++)
	{
		$ll_total_day2 = $ll_total_day2 + how_many_days($year, $ll_i);
	}

	$ll_total_day2 = $ll_total_day2 + $day;
	$ll_total_day  = $ll_total_day2 - $ll_total_day1 +1;
	
	$ll_total_day0 = $ll_dt[1];
	
	for($ll_i = 1; $ll_i <= 163; $ll_i++)
	{
		if ($ll_total_day <= $ll_total_day0) break;
		$ll_total_day0 = $ll_total_day0 + $ll_dt[$ll_i + 1];
	}
	
	$ll_lun_year = $ll_i + 1880;
	$ll_total_day0 = $ll_total_day0 - $ll_dt[$ll_i];
	
	$ll_total_day  = $ll_total_day - $ll_total_day0;
	
	if ($ls_ltbl[$ll_i][12] == '0') $ll_count = 12;
	else $ll_count = 13;

	$ll_m2 = 0;
		
	for ($ll_j = 1; $ll_j <= $ll_count; $ll_j++)
	{
		if ($ls_ltbl[$ll_i][$ll_j-1] <= '2')
		{
			$ll_m2++;
			$ll_m1 = ($ls_ltbl[$ll_i][$ll_j-1]-'0') + 28;
			$is_yun_month = 0;
		}
		else
		{
			$ll_m1 = ($ls_ltbl[$ll_i][$ll_j-1]-'0') + 26;
			$is_yun_month = 1;
		}
		$ll_total_day= floor($ll_total_day);
		if ($ll_total_day <= $ll_m1) {
			break;
		}
		$ll_total_day = $ll_total_day - $ll_m1;
	}
	
	$year = $ll_lun_year;
	$month = $ll_m2;
	$day = $ll_total_day;
	return $is_yun_month;
}

//실제 달력출력 루틴
//$year, $month, $cur_day 는 현재 선택된 날짜
//$how 는 일정표 종류
function print_cal($year, $month, $start, $days, $cur_day, $how)
{

	$SUN_COLOR ="#ff0000";
	$SAT_COLOR="#0000ff";
	$NOR_COLOR="#000000";
	$LUN_COLOR="#008000";
	$HDR_WIDTH=	40;
	$HDR_BGCOLOR= "#C2ADE9";
	$HDR_ALIGN= "center";
	$WIDTH="HDR_WIDTH";
	$BGCOLOR="#F1E9FE";
	$CURBGCOLOR="red";
	$ALIGN="left";

	$x=0;
	$lunar[8];
	global $szHolyday;
	print_head();
	$ll_dt = Calcull_dt();
	for ($row = 0; $row < 5; $row++)
	{
		printf("<tr bgcolor=\"#f9ffe0\">\n");
		for ($i = 0; $i < 7; $i++) {
			$holyday = $holyday2 = 0;
			$lunar[0] = '\0';
			printf("<td align=\"center\" bgcolor=\"#FFFFF2\">\n");
			$x++;
			
			if ($x > $start && $x <= $start+$days) {
				$holyday = is_holyday($year, $month, $x-$start, $ll_dt);
				if ($i == 0 || $holyday) $color = $SUN_COLOR;
				else if ($i == 6) $color = $SAT_COLOR;
				else $color = $NOR_COLOR;
				printf("<font color=%s size=1>", $color);
				
				if (is_double_day($row, $i, $x-$start+7, $days)) {
					if ($how == "") $how = "day";
					$day=$x-$start;
					if ($how == "day") {	//일간 일정표
						echo ("<a href=s-day.php?year=$year&mon=$month&day=$day&how=$how OnClick=''javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\"> ");
					} elseif ($how == "week") {
						echo ("<a href=s-week.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\">");
					} elseif ($how == "mon") {
						echo ("<a href=s-month.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\">");
					}
					printf("%d</a></font>", ($x-$start));
					printf("/");
					$holyday2 = is_holyday($year, $month, $x-$start+7, $ll_dt);
					if ($holyday2) $color = $SUN_COLOR;
					printf("<font color=%s size=1>", $color);
					$day=$x-$start+7;
					if ($how == "day") {	//일간 일정표
						echo ("<a href=s-day.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\">");
					} elseif ($how == "week") {
						echo ("<a href=s-week.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\">");
					} elseif ($how == "mon") {
						echo ("<a href=s-month.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:5.5pt;\" target=\"right\">");
					}
					printf("%d", $x-$start+7);
				}
				else {
					$day = $x - $start;
					if ($day == $cur_day) {
						echo ("<font color=\"blue\"><b>$day</b></font>");;
					}
					else {
						if ($how == "") $how = "day";
						if ($how == "day") {	//일간 일정표
							echo ("<a href=s-day.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:7.5pt;\" target=\"right\">$day</a>");
						} elseif ($how == "week") {
							echo ("<a href=s-week.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:7.5pt;\" target=\"right\">$day</a>");
						} elseif ($how == "mon") {
							echo ("<a href=s-month.php?year=$year&mon=$month&day=$day&how=$how OnClick='javascript:ClickDay($year, $month, $day, \"$how\")' style=\"color:#414440;font-size:7.5pt;\" target=\"right\">$day</a>");
						}
					}
				}

				printf("</font>");
	
				if (($year > 1881 && $year <= 2043) ||
					($year == 1881 && $month > 1)) 
				
				{
					$l_year = $year; $l_month = $month; $l_day = $x-$start;
					solar_to_lunar(&$l_year, &$l_month, &$l_day, $ll_dt);
					$lunar = sprintf( "%d.%d", $l_month, $l_day);
				}
				
				//printf("&nbsp;<br>\n");
				
				if ($holyday2) printf("<font face=굴림체 size=1 color=%s>%s</font>", 
					$SUN_COLOR, $szHolyday[$holyday2]);
				printf("</td>\n");
			
			}
		}
		printf("</tr>\n");
	}

	print_tail();

	return 0;
}

function print_head()
{
	$SUN_COLOR ="#800080";
	$SAT_COLOR="black";
	$NOR_COLOR="black";
	$LUN_COLOR="#008000";
	$HDR_WIDTH=20;
	$HDR_HEIGHT=20;
	$HDR_BGCOLOR= "#E8DDF0";
	$HDR_ALIGN= "center";
	$WIDTH="HDR_WIDTH";
	$BGCOLOR="#F2ECFB";
	$ALIGN="center";
	$day = array("S", "M", "T", "W", 
					"T", "F", "S");
	$i;

	echo("<tr bgcolor=\"#f9ffe0\">");
	for ($i = 0; $i < 7; $i++)
	{
		if ($i == 0)
			printf("<td align=\"middle\" bgcolor=\"#FFFFF2\"><font color=%s size=2><b>%s</b></font></td>", $SUN_COLOR, $day[$i]);
		else if ($i == 6)
			printf("<td align=\"middle\" bgcolor=\"#FFFFF2\"><font color=%s size=2><b>%s</b></font></td>", $SAT_COLOR, $day[$i]);
		else
			printf("<td align=\"middle\" bgcolor=\"#FFFFF2\"><font color=%s size=2><b>%s</b></fonr></td>", $NOR_COLOR, $day[$i]);
		printf("</td>\n");
	}
	printf("</tr>\n");
	return 0;
}

function print_tail()
{
	echo ("
	<tr bgcolor=\"#f9ffe0\">
    	<td colspan=\"7\" bgcolor=\"#FFFFF2\"></td>
   	</tr>
    <tr>
    	<td colspan=\"7\" height=\"5\" bgcolor=\"#9176AB\"></td>
    </tr>
	</table>
	");
	return 0;
}

// 달력출력, $name, $value, $day 는 현재 선택된 날짜
// $how 는 일정표 종류(week 주간...)
function ShowCalendar($nNameValueCount, $name, $value, $day, $how)
{
	$i;
	$year; 
	$month;
	$start; 
	$days;

	$year = $name;
	$month=$value;
	
	$start = which_day_of_week($year, $month, 1);
	$days = how_many_days($year, $month);
	print_cal($year, $month, $start, $days, $day, $how);

	return 0;
}
function Calcull_dt()
{	
	global $ls_ltbl;
	
	for ($ll_i = 1; $ll_i <= 163; $ll_i++)
	{
		$ll_dt[$ll_i] = 0;
		for ($ll_j = 1; $ll_j <= 12; $ll_j++)
		{	
			switch($ls_ltbl[$ll_i][$ll_j-1])
			{
			case '1': case '3':
				$ll_dt[$ll_i] = $ll_dt[$ll_i] + 29;
				break;
			case '2': case '4':
				$ll_dt[$ll_i] = $ll_dt[$ll_i] + 30;
				break;
			}
		}
		switch($ls_ltbl[$ll_i][12])
		{
		case '0':
			break;
		case '1': case '3':
			$ll_dt[$ll_i] = $ll_dt[$ll_i] + 29;
			break;
		case '2': case '4':
			$ll_dt[$ll_i] = $ll_dt[$ll_i] + 30;
			break;
		}
	}
	return $ll_dt;
}	
?>

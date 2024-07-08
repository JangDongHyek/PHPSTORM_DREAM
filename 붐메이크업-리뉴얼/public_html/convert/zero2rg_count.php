<?
  include "dbconn.php" ;

  if(!$year) $year=date("Y");
  if(!$month) $month=date("m");
  if(!$day) $day=date("d");
  $today_date = date("Y-m-d");

    // 오늘의 날자 구함
  $today=mktime(0,0,0,$month,$day,$year);
  $yesterday=mktime(0,0,0,$month,$day,$year)-3600*24;

  $result=mysql_fetch_array(mysql_query("select unique_counter from counter_main where no=1"));  
  $total_hit = $result[0] ;

  $result=mysql_fetch_array(mysql_query("select unique_counter from counter_main where date='$today'"));  
  $today_hit = $result[0] ;

  $result=mysql_fetch_array(mysql_query("select unique_counter from counter_main where date='$yesterday'"));  
  $yesterday_hit = $result[0] ;

  $result=mysql_fetch_array(mysql_query("select max(unique_counter) from counter_main where no>1"));  
  $max_hit = $result[0] ;

	$dbqry="
		UPDATE `rg_count_stat` SET
			total_count='$total_hit',
			today_count='$today_hit',
			yesterday_count='$yesterday_hit',
			max_count='$max_hit',
			today_date = '$today_date'
	";
	mysql_query($dbqry);

?>
<table border=0 cellspacing=0 cellpadding=0 width=100%>
<tr><td align=center>
<a href=javascript:void(history.back()) onfocus=blur()>back</a></td>
</tr>
</table>

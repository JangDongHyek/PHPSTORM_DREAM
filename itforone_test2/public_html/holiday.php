<?
include "./_common.php";

/*
기념일 종류
법정공휴일 : h
법정기념일 : a
24절기 : s
그외 절기 : t
대중기념일 : p
대체 공휴일 : i
기타 : e 
*/

$today = getdate(); 
$year = $today['year'];
$type = "i"; // 공휴일
$url = 'https://apis.sktelecom.com/v1/eventday/days?year='.$year.'&type='.$type; 

$opts = array('http' =>
        array(
            'method'  => 'GET',
            'header' => 'TDCProjectKey: be3b9a6d-52ae-4d5a-93f8-1ca91572be0e'
        )
    );

$context  = stream_context_create($opts);
$fp = fopen($url, 'r', false, $context);
//echo stream_get_contents($fp);
$print = stream_get_contents($fp);

//var_dump($print['results']);

$print = (json_decode($print, true));
for($i=0; $i<$print['totalResult']; $i++){
	$arr = $print['results'][$i];
	
	$h_1 = $arr['year'];
	$h_2 = $arr['month'];
	$h_3 = $arr['day'];

	echo $date = $arr['year'].$arr['month'].$arr['day']."  ";
	echo $name = $arr['name'];
	echo "<br>";

	sql_query("insert into `hollyday` set `date` = '$date', `name` = '$name', `h_1` = '$h_1', `h_2` = '$h_2', `h_3` = '$h_3'");
}

?>
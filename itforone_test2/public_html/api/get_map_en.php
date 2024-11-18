<?php
include_once('./_common.php');


$si_arr = array();
$gu_arr = array();
$dong_arr = array();

$si_temp = array();
$gu_temp = array();
$dong_temp = array();

$print = array();

$si = trim($_GET['si']);
$gu = trim($_GET['gu']);

/*
// 인천 남구->미추홀구 변경 (시간되면 DB변경하기..)
if ($si == "인천" && $gu == "미추홀구") $gu = "남구";

if($si == '충남') $si = '충청남도';
if($si == '충북') $si = '충청북도';
if($si == '경남') $si = '경상남도';
if($si == '경북') $si = '경상북도';
if($si == '전남') $si = '전라남도';
if($si == '전북') $si = '전라북도';
if($si == '세종') $si = 'Sejong-si';
*/

$select = " `si` ";
$groutby = " `si` ";
$having = " having 1  ";
$orderby = " gu asc, idx ";

if($si) {
	$select .= " , `gu` ";
	$groutby .= " , `gu` ";
	$having .= " and `si` like '$si%' and `gu` <> '' ";
}

if($gu) {
	$select .= " , `dong` ";
	$groutby .= " , `dong` ";
	$having .= " and `gu` = '$gu' and `dong` <> '' ";
}

// 190312 추가 (세종시는 구가 없음)
if($si == 'Sejong-si') {
	$select = " si, dong ";
	$groutby = " dong ";
	$having = " having `si` = '$si' ";
	$orderby = " dong asc, idx ";
}

$sql = "SELECT $select FROM new_map_code_en group by $groutby  $having order by $orderby";
$result = sql_query($sql);

while($rows = sql_fetch_array($result)){
	
	//하위로 내려가도 상위값 보여줌
	//$print[] = $rows;


	//필요한 값만 보여줌
	if($si != ""){
		if($gu){
			$print[] = $rows['dong'];
		} else if ($si == 'Sejong-si'){
			$print[] = $rows['dong'];
		} else {
			/*
			if ($si == "인천" && $rows['gu'] == "남구") {
				$rows['gu'] = "미추홀구";
			}
			*/
			$print[] = $rows['gu'];
		}
	} else {
		$print[] = $rows['si'];
	}

	
	// 모든 지역을 한번에 중복없이 보여주는데 렉존나 걸림...
	/*
	if($si == "") $si = $rows['si'];
	if($gu == "") $gu = $rows['gu'];
	if($dong == "") $dong = $rows['dong'];
	

	$dong_temp['dong'] = $rows['dong'];
	$dong_temp['code'] = $rows['code'];
	$dong_arr[] = $dong_temp;

	if($gu != $rows['gu']){
		$gu_temp['gu'] = $gu;
		$gu_temp['dong'] = $dong_arr;
		$gu_arr[] = $gu_temp;

		$gu = $rows['gu'];
	}

	if($si != $rows['si']){
		$si_temp['si'] = $si;
		$si_temp['gu'] = $gu_arr;
		$print[] = $si_temp;

		$si = $rows['si'];
	}
	*/
}

$printarr = $print;
echo json_encode($printarr);

?>
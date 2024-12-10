<?php
/************************************************
주소검색시 북마크&히스토리 html
************************************************/
include_once('./_common.php');

if (!$is_member) exit;

$bm_type = substr(strtoupper($page_mode), 0, 1);

$sql = "SELECT * FROM g5_bookmark WHERE mb_id = '{$member['mb_id']}' AND bm_type = '{$bm_type}' 
		ORDER BY bm_favorites DESC, bm_regdate DESC"; //LIMIT 0, 15";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);

// 페이지 파라미터
$tmp1 = explode("&", $params);
$query_str = array();
foreach ($tmp1 as $key=>$val) {
	$tmp2 = explode("=", $val);
	if ($tmp2[0] == "?mode") $tmp2[0] = "mode";
	$query_str[$tmp2[0]] = $tmp2[1];
}

if ((int)$result_cnt > 0) {
?>
<ul>
	<? 
	for ($i = 0; $row = sql_fetch_array($result); $i++) {
		$btn_name = "즐겨찾기";
		$btn_class = "";
		$list_class = "";

		// 즐겨찾기 항목이면
		if ($row['bm_favorites'] == "1") {
			$btn_name = "삭제하기";
			$btn_class = "active";
			$list_class = "on";
		}

		// 링크
		$href = G5_URL."/index.php?";
		$start_href = "start_place={$query_str['start_place']}&start_lat={$query_str['start_lat']}&start_lng={$query_str['start_lng']}";
		$pass_href = "&pass_place={$query_str['pass_place']}&pass_lat={$query_str['pass_lat']}&pass_lng={$query_str['pass_lng']}";

		switch ($page_mode) {
			case "start" : 
				$href .= "start_place={$row['bm_place']}&start_lat={$row['bm_lat']}&start_lng={$row['bm_lng']}";
				if ($query_str['pass_place'] != "") $href .= $pass_href;
				break;
			case "pass" : 
				$href .= $start_href;
				$href .= "&pass_place={$row['bm_place']}&pass_lat={$row['bm_lat']}&pass_lng={$row['bm_lng']}";
				break;
			case "end" : 
				$href = G5_BBS_URL."/call.php?".$start_href.$pass_href;
				$href .= "&end_place={$row['bm_place']}&end_lat={$row['bm_lat']}&end_lng={$row['bm_lng']}";
				break;
		}
	?>
	<li class="map-list <?=$list_class?>">
		<div>
			<a href="<?=$href?>"><p><?=$row['bm_place']?></p></a>
			<a href="javascript:void(0);" onclick="setBookmark(<?=$row['idx']?>, '<?=$row['bm_favorites']?>');" class="btn <?=$btn_class?>"><?=$btn_name?></a>
		</div>
	</li>
	<? } // end for ?>
</ul>
<? 
} 
exit;
?>
<!--
<ul>
<li class="map-list on">
	<div>
		<a href=""><p>부산광역시 해운대구 우동 145</p></a>
		<a href="javascript:;" onclick="mapBookMark('6','0')" class="btn active">삭제하기</a>
	</div>
</li>
<li class="map-list">
	<div>
		<a href="http://www.xn--t-iv8ey4o.com/index.php?start_place=장산&amp;start_lat=129.144796117874&amp;start_lng=35.1941336900761&amp;start=true"><p>장산</p></a>
		<a href="javascript:;" onclick="mapBookMark('465','1')" class="btn">즐겨찾기</a>
	</div>
</li>
<li class="map-list"></li>
</ul>
-->
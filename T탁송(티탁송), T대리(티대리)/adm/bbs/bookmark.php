<?php
/*************************************************
즐겨찾기
: 등록된 여정중 즐겨찾기된 장소가 있는 여정 노출
**************************************************/
include_once('./_common.php');

if (!$is_member) {
	goto_url(G5_BBS_URL."/login.php?url=".urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']));
}

// 즐겨찾기 조회
/*
$sql = "SELECT bm_regdateTS FROM g5_bookmark 
		GROUP BY bm_regdateTS, mb_id HAVING mb_id = '{$member['mb_id']}'
		ORDER BY bm_regdateTS DESC";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);
*/
$sql = "SELECT * FROM g5_call WHERE mb_id = '{$member['mb_id']}' ORDER BY idx DESC LIMIT 0, 15";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


$g5['title'] = '즐겨찾기';
include_once(G5_THEME_PATH.'/head.php');
?>

<div id="sch_result" style="padding:0% 2%">
	<ul>
		<? if ($result_cnt == 0) { ?>
		<li>등록된 내용이 없습니다.</li>
		<? 
		} else { 
			for ($i = 0; $row = sql_fetch_array($result); $i++) {
				$bookmark_flag = false;
				$sql_common = "SELECT COUNT(*) AS cnt FROM g5_bookmark WHERE bm_favorites = '1' ";

				// 1) 출발지 즐겨찾기 체크
				$rs = sql_fetch($sql_common." AND bm_type = 'S' AND bm_lat = '{$row['start_lat']}' AND bm_lng = '{$row['start_lng']}'");
				$bm_cnt = $rs['cnt'];
				if ($bm_cnt > 0)	$bookmark_flag = true;

				// 2) 경유지 즐겨찾기 체크
				if (!$bookmark_flag && $row['pass_place'] != "") {
					$rs = sql_fetch($sql_common." AND bm_type = 'P' AND bm_lat = '{$row['pass_lat']}' AND bm_lng = '{$row['pass_lng']}'");
					$bm_cnt = $rs['cnt'];
					if ($bm_cnt > 0)	$bookmark_flag = true;
				}

				// 3) 도착지 즐겨찾기 체크
				if (!$bookmark_flag) {
					$rs = sql_fetch($sql_common." AND bm_type = 'E' AND bm_lat = '{$row['end_lat']}' AND bm_lng = '{$row['end_lng']}'");
					$bm_cnt = $rs['cnt'];
					if ($bm_cnt > 0)	$bookmark_flag = true;
				}

				if ($bookmark_flag) {
					$path_href = G5_BBS_URL."/call.php?start_place={$row['start_place']}&start_lat={$row['start_lat']}&start_lng={$row['start_lng']}";
					$path_href .= "&pass_place={$row['pass_place']}&pass_lat={$row['pass_lat']}&pass_lng={$row['pass_lng']}";
					$path_href .= "&end_place={$row['end_place']}&end_lat={$row['end_lat']}&end_lng={$row['end_lng']}";
		?>
		<li>
			<div class="addr">
				<a href="<?=$path_href?>"><p>
					<!-- 출발지 -->
					<?=$row['start_place']?>
					<i class="fas fa-arrow-right"></i>
					<? if ($row['pass_place'] != "") { ?>
					<!-- 경유지 -->
					<?=$row['pass_place']?>
					<i class="fas fa-arrow-right"></i>
					<? } ?>
					<!-- 도착지 -->
					<?=$row['end_place']?>
				</p></a>
			</div>
        </li>
		<?
				} // end $bookmark_flag
			} // end for
		} // end if 
		?>
    </ul>
</div>


<?php
include_once('./_tail.sub.php');
?>
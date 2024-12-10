<?php
/*************************************
드라이버 콜접수내역
 * 1. 기사
 * - 인덱스
 * - 콜접수내역 (내콜만)
 * 2. 고객
 * - 운행내역
 *************************************/
include_once('./_common.php');

//print_r($_POST);
$mode = $_POST['mode'];
$sort = $_POST['sort'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$sql_common = "FROM g5_call A WHERE A.is_public = 'Y'";
$sql_order = "";

// 조건추가
if ($is_driver) { // 1)기사
    if ($mode == "my") { // 콜접수내역(내콜만)
        $sql_common .= " AND A.driver_id = '{$member['mb_id']}'";
    } else { // 인덱스
        $sql_common .= " AND (A.call_status = '0' OR (A.call_status = '1' AND A.driver_id = '{$member['mb_id']}') )"; //A.call_status IN ('0', 'R') 211215 상태 접수인건 뺌
    }

    // 정렬&거리추가
    $sql_order = "HAVING distance <= {$member['mb_distance']} ";
    if ($sort == "1") {
        //$sql_order .= "ORDER BY (CASE A.call_status WHEN '2' THEN 2 ELSE 1 END) ASC, idx DESC";
        // 관리자 '신청'상태가 먼저 노출
        $sql_order .= "ORDER BY call_req_dateTS DESC, (CASE A.call_status WHEN '2' THEN 2 ELSE 1 END) ASC, idx DESC";
    } else {
        $sql_order .= "ORDER BY (CASE A.call_status WHEN '2' THEN 2 ELSE 1 END) ASC, distance ASC";
    }

} else {    // 2)고객
    $sql_common .= " AND A.mb_id = '{$member['mb_id']}'";
    $sql_order = "ORDER BY idx DESC";
}

// 범위 쿼리 추가
// $sql_common .= "";

// 리스트
$sql = "SELECT A.*,
    (6371*acos(cos(radians({$lat}))*cos(radians(A.start_lat))*cos(radians(A.start_lng)
    -radians({$lng}))+sin(radians({$lat}))*sin(radians(A.start_lat)))) AS distance
    {$sql_common} {$sql_order}";
$result = sql_query($sql);
$result_cnt = sql_num_rows($result);


if ($result_cnt == 0) {
?>
<li>
    <div style="<?if($is_driver){?>color:#FFF;<?}?>padding: 20px; font-size: 1.15em;">내역이 없습니다.</div>
</li>

<?php
} else {
    while($row = sql_fetch_array($result)) {
        $idx = $row['idx'];

        // 거리
        $km = sprintf('%0.1f', $row['distance']);

        // 출발일시
        /*$start_time = "즉시";
        if ($row['call_req_today'] == "1") {
            $start_time = date("m/d", strtotime("+1 days", strtotime($row['call_regdate'])));
            if ($row['call_req_time'] != "") $start_time .= "<br>".$row['call_req_time'];
        } else {
            if ($row['call_req_time'] != "") {
                $start_time = date("m/d", strtotime($row['call_regdate']));
                $start_time .= "<br>".$row['call_req_time'];
            }
        }*/
        $start_time = callStartTime($row['call_req_today'], $row['call_regdate'], $row['call_req_time']);

        // 총금액
        $amt = floor((int)$row['call_total_price'] / 1000); //(int)$row['call_total_price'] / 1000;

        // 드라이버면 요금계산
        if ($is_driver) {
            $calc_fee = calculateFree($row['call_total_price'], $row['call_kind'], $row['call_payment']);
            $amt = floor((int)$calc_fee['driv_price'] / 1000);
        }

?>
<li onclick="getCallView(<?=$idx?>)" id="box<?=$idx?>">
    <?if ($is_driver) {?>
    <!-- 기사면 출발지까지 거리계산 -->
    <div class="km" style="font-size:0.9em;"><p><?=$km?><br>km</p></div>
    <?}?>

    <div class="info">
        <div class="d1">
            <p><?if(!$is_driver){?><span>출발</span><?}?> <strong><?=$row['start_place']?></strong></p>
            <? if ($row['pass_place'] != "") { ?><p><?if(!$is_driver){?><span>경유</span><?}?> <strong><?=$row['pass_place']?></strong></p><? } ?>
            <p><?if(!$is_driver){?><span>도착</span><?}?> <strong><?=$row['end_place']?></strong></p>
        </div>
    </div>

    <div class="info3">
        <div><?=$start_time?></div>
    </div>

    <div class="info2">
        <div class="consign">
            <span class="<?=$calltype_class[$row['call_type']]?>"><?=$calltype_name[$row['call_type']]?></span>
            <? if ((int)$row['call_5t_price'] > 0) { ?><span>2.5톤이상</span><? } ?>
        </div>
        <div class="d2">
            <? if (!$is_driver) { ?>
                <!-- 고객이면 거리 노출 -->
                <span><?=$row['call_dist']?>km</span>
            <? } ?>
            <span class="price"><?=$amt?></span>
        </div>
    </div>

    <?
    $_state = array();
    switch ($row['call_status']) {
        case "-1" : $_state['cls'] = "off"; $_state['name'] = "취소"; break;
        case "R" :
            if (!$is_driver) { // 고객이면 접수표시
                $_state['cls'] = "ready";
                $_state['name'] = "접수";
            }
            break;
        case "1" : $_state['cls'] = "on"; $_state['name'] = "진행중"; break;
        case "2" : $_state['cls'] = "off"; $_state['name'] = "진행완료"; break;
    }
    $is_show = (count($_state) > 0)? "" : "hide";
    ?>
    <input type="hidden" name="idx[]" value="<?=$idx?>">
    <div class="state <?=$_state['cls']?> <?=$is_show?>"><?=$_state['name']?></div>

    <? /*if ($_SERVER['REMOTE_ADDR'] == "183.103.22.103") { ?>
    <div style="height: auto; color: gray;" class="test_area">
        <?=$idx?>. 아이티포원 테스트<br>
        <? echo ($row['call_payment'] == "C")? "현금콜" : "포인트콜"; ?><br>
        <?=number_format($row['call_total_price'])?> / 시간 : <?=$row['call_regdate']?>
    </div>
    <? } */ ?>

</li>
<?php }} ?>
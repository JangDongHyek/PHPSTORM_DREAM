<?php
include_once("./_common.php");

/** 프로 - 레슨예약 - 시간 설정 모달 데이터 (ajax) **/
/** 속도가 문제가 될 경우 이 파일 사용 **/

$pro_mb_no = $_POST['pro_mb_no'];
$reser_date = $_POST['reser_date'];

$sql = " select tset.idx, tset.set_time, pro.time_set_idx, pro.use_yn ";
$sql .= " from g5_lesson_time_set as tset ";
$sql .= " left join g5_lesson_time_set_pro as pro on tset.idx = pro.time_set_idx and pro.mb_no = {$pro_mb_no} ";
//$sql .= " left join g5_lesson_time_set_pro_not as pron on tset.idx = pron.time_set_idx and pron.mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ";
$sql .= " order by tset.set_time ";
//if($private) {
//    echo $sql;
//}
$result = sql_query($sql);

$tmp_time = array();
// 프로 예약 불가능 시간 (날짜 지정한 시간)
$rlt = sql_query(" select * from g5_lesson_time_set_pro_not where mb.no = '{$pro_mb_no}' and set_date = '{$reser_date}' ");
while($rs = sql_fetch_array($rlt)) {
    array_push($tmp_time, $rs['time_set_idx']);
}

$count = sql_fetch(" select count(*) as count from g5_lesson_time_set_pro_not where mb_no = {$pro_mb_no} and set_date = '{$reser_date}' ")['count']; // 프로가 특정 일자의 예약 가능한 시간을 설정한 기록이 있으면

$set_date = '';
$chkall = 'Y';
for($i=1; $row=sql_fetch_array($result); $i++) {
    $checked = '';
    if($count > 0) {
        $set_date = str_replace('.','-',$reser_date);
        if(!in_array($row['idx'], $tmp_time)) { // 지정한 시간이 아니면
            $checked = 'checked';
        } else {
            $chkall = 'N';
        }
    }
    else {
        if($row['use_yn'] == 'Y') {
            $checked = 'checked';
        } else {
            $chkall = 'N';
        }
    }

    /*if($row['use_yn'] == 'Y' && empty($row['pron_idx'])) {
        $checked = 'checked';
    }*/
?>
<input type=checkbox name="ck_set_time" id="set_time<?=$i?>" value="<?=$row['idx']?>" <?=$checked?>><label for="set_time<?=$i?>"><div style="font-size: 20px; margin-top:-4px;"><?=$row['set_time']?></div></label>
<?php
}
?>
<input type="hidden" id="hide_set_date" name="hide_set_date" value="<?=$set_date?>">
<input type="hidden" id="hide_chkall" name="hide_chkall" value="<?=$chkall?>">

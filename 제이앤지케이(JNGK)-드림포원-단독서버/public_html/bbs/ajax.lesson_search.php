<?php
include_once("./_common.php");


$sql_search = '';
if(!empty($_POST['name'])) {
    $sql_search .= " and (le.lesson_name like '%{$_POST['name']}%' or mb.mb_charge_pro like '%{$_POST['name']}%') ";
}
if(!empty($_POST['st_date'])) {
    $start_date = str_replace('-','.',$_POST['st_date']);
    $sql_search .= " and (re.reser_date >= '{$start_date}') ";
}
if(!empty($_POST['ed_date'])) {
    $end_date = str_replace('-','.',$_POST['ed_date']);
    $sql_search .= " and (re.reser_date <= '{$end_date}') ";
}
if(!empty($_POST['state'])) {
    $sql_search .= " and re.reser_state = '{$_POST['state']}' ";
}

$sql = " select count(*) as cnt 
         from g5_lesson_reser as re 
         left join g5_member as mb on mb.mb_no = re.mb_no 
         where re.mb_no = {$member['mb_no']} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

//$rows = $config['cf_page_rows'];
$rows = 8;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select re.*, mb.mb_charge_pro, lesson_name, lesson_count
        from g5_lesson_reser as re
        left join g5_member mb on mb.mb_no = re.mb_no
        left join g5_lesson le on le.idx = mb.lesson_idx
        where re.mb_no = '{$member['mb_no']}' {$sql_search} ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $state_class = "";
    if($row['reser_state'] == '예약완료') { $state_class = "btn_less_ok"; }
    else if($row['reser_state'] == '예약대기') { $state_class = "btn_less_wait"; }
    else if($row['reser_state'] == '예약취소') { $state_class = "btn_less_no"; }
    else { $state_class = "btn_less_no"; }
    ?>
    <div class="less_lbox">
        <div class="less_tit"><?=$row['lesson_name']?> <?=$row['lesson_count']?>
            <div class="less_pro"><?=$row['mb_charge_pro']?> 프로</div>
        </div>
        <div class="less_info">
            <p>예약일 <span><?=$row['reser_date']?></span></p>
            <p>예약시간 <span><?=$row['reser_time']?></span></p>
        </div><!--.less_info-->
        <div class="btn_less <?=$state_class?>"><?=$row['reser_state']?></div>
    </div><!--.less_lbox-->
<?php
}
?>
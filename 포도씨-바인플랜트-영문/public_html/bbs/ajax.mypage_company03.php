<?php
include_once('./_common.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 받은 의뢰 (ajax) **/

$noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_inquiry where find_in_set('{$member['mb_id']}', noshow) ")['noshow']; // 삭제자료
$sql_search = " and find_in_set('{$member['mb_no']}', target_mb_no) and del_yn is null ";
if(!empty($noshow)) {
    $sql_search .= " and idx not in ({$noshow}) ";
}
if($mode == 'a') { // 전체
    $sql_search .= "";
} else if($mode == "wait") { // 접수대기
    $sql_search .= " and ci_state = 'Processing Submission' ";
} else if($mode == "check") { // 견적검토중
    $sql_search .= " and ci_state = 'Quotation Under Review' ";
} else if($mode == "select") { // 거래완료
    $sql_search .= " and ci_state = 'Transaction Complete' ";
} else if($mode == "no") { // 미체결
    $sql_search .= " and ci_state = 'Agreement Incomplete' ";
} else if($mode == "finish") { // 마감
    $sql_search .= " and ci_state = 'Deadline' ";
}

// 검색
if(!empty($search)) {
    $sql_search .= " and (ci_subject like '%{$search}%') ";
}

// 정렬
if(empty($orderby) || $orderby == 'By Deadline') { // default 마감순
    $sql_orderby = " order by ci_deadline_date asc, idx asc ";
}
else if($orderby == 'By Latest') {
    $sql_orderby = " order by idx desc ";
}
else if($orderby == 'By Total Payment') {
    $sql_orderby = " order by ci_budget desc ";
}

// 페이징
$sql = " select count(*) as cnt from g5_company_inquiry where 1=1 {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 받은의뢰 리스트
$sql = " select * from g5_company_inquiry where 1=1 {$sql_search} order by idx desc ";
//echo $sql;
$rlt = sql_query($sql);

for($i=0; $row=sql_fetch_array($rlt); $i++) {
    // 견적기한 D-DAY
    $date = $row['ci_deadline_date'];
    $todate = date("Y-m-d", time());
    $dday = ( strtotime($date) - strtotime($todate) ) / 86400;

    // 견적 수
    $cnt2 = selectCount('g5_company_estimate', 'company_inquiry_idx', $row['idx'], 'mb_id', $member['mb_id']);

    $class = '';
    if($cnt2 == 0) {
        $class = 'wait';
        $state = 'Wating';
    } else {
        $class = 'select';
        $state = 'Completion of quotation proposal';
    }

    if($dday >= 0) {
        $link = G5_BBS_URL.'/company_view.php?idx='.$row['idx'];
    } else {
        $link = "javascript:swal('Order has ended.');";
    }
?>
<li class="company">
    <a href="<?=$link?>">
        <div class="title">
            <input type="checkbox" name="noshow_chk" value="<?=$row['idx']?>">

            <i class="<?=$class?>"><?=$state?></i>
            <em><?=$row['ci_category']?></em><!-- 카테고리 -->
            <h3><?=$row['ci_subject']?></h3> <!-- 제목 -->
        </div>
        <div class="cont">
            <ul class="list_text">
                <li><em>Maker</em><span><?=$row['ci_maker']?></span></li><!-- 제조사 -->
                <li><em>Model</em><span><?=$row['ci_model']?></span></li><!-- 모델 -->
                <li><em>Deadline</em><span><?=str_replace('-','.',$row['ci_deadline_date'])?></span></li>
                <li class="period"><span><?php echo $dday >= 0 ? $dday.'days left' : 'Deadline'; ?></span></li><!-- 견적남은기간 -->
            </ul>
            <div class="list_info">
                <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span> <!-- 의뢰올린날자 -->
            </div>
        </div>
    </a>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata_inquiry">
    <p>There is no registered contents.</p>
</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>

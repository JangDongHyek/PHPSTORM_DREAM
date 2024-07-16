<?php
include_once('./_common.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 보낸 견적 (ajax) **/

$noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_estimate where find_in_set('{$member['mb_id']}', noshow) ")['noshow']; // 삭제자료
$sql_search = " and ce.mb_id = '{$member['mb_id']}' and del_yn is null ";
if(!empty($noshow)) {
    $sql_search .= " and ce.idx not in ({$noshow}) ";
}
if($mode == 'a') { // 전체
    $sql_search .= "";
} else if($mode == "wait") { // 접수대기
    $sql_search .= " and ce_state = 'Processing Submission' ";
} else if($mode == "check") { // 견적검토중
    $sql_search .= " and ce_state = 'Quotation Under Review' ";
} else if($mode == "select") { // 거래완료
    $sql_search .= " and ce_state = 'Transaction Complete' ";
} else if($mode == "no") { // 미체결
    $sql_search .= " and ce_state = 'Agreement Incomplete' ";
} else if($mode == "finish") { // 마감
    $sql_search .= " and ce_state = 'Deadline' ";
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
$sql = " select count(*) as cnt from g5_company_estimate as ce left join g5_company_inquiry as ci on ce.company_inquiry_idx = ci.idx where 1=1 {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 보낸 견적 리스트
$sql = " select ce.*, ci.ci_deadline_date from g5_company_estimate as ce left join g5_company_inquiry as ci on ce.company_inquiry_idx = ci.idx where 1=1 {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
//echo $sql;
$rlt = sql_query($sql);

for($i=0; $row=sql_fetch_array($rlt); $i++) {
    // 견적기한 D-DAY
    $date = $row['ci_deadline_date'];
    $todate = date("Y-m-d", time());
    $dday = ( strtotime($date) - strtotime($todate) ) / 86400;

    // 견적 수
    $cnt2 = selectCount('g5_company_estimate', 'company_inquiry_idx', $row['idx']);
    // 선택된 견적이 있는지 확인
    $selection = selectCount('g5_company_estimate', 'company_inquiry_idx', $row['idx'], 'ce_selection', 'Y');

    $class = '';
    $modal = true;
    if($row['ce_state'] == 'Processing Submission') { // 상태 : 접수대기 ==> 견적이 있으면 상태변경 모달창 O / 견적이 없으면 상태변경 모달창 X
        $class = 'wait';
        if($cnt2 > 0) { $modal = true; }
        else { $modal = false; }
    }
    else if($row['ce_state'] == 'Quotation Under Review') { $class = 'check'; }
    else if($row['ce_state'] == 'Transaction Complete') { $class = 'select'; }
    else if($row['ce_state'] == 'Agreement Incomplete') { $class = 'no'; }
    else if($row['ce_state'] == 'Deadline') { $class = 'finish'; }
?>
<li>
    <a href="<?php echo G5_BBS_URL ?>/mypage_company_detail02.php?idx=<?=$row['idx']?>">
        <div class="top">
            <input type="checkbox" name="noshow_chk" value="<?=$row['idx']?>">

            <i class="<?=$class?>"><?=$row['ce_state']?></i>
            <span class="data"><?=str_replace('-','.', substr($row['wr_datetime'],0,10))?></span>

            <!-- 견적보내기 페이지 고객님께 드릴 말씀 -->
            <h3><?=nl2br($row['ce_contents'])?></h3>

            <!--<span class="date">마감일 : <?/*=str_replace('-','.',$row['ci_deadline_date'])*/?></span>-->
        </div>
        <div class="price">
            <label>Quotation proposal price</label>
            <span><?=number_format($row['total_cost']).' '.$row['ce_unit']?></span>
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

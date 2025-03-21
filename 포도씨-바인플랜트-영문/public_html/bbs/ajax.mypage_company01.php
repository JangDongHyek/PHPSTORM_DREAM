<?php
include_once('./_common.php');

/**  기업 - 마이페이지 - 기업의뢰 - 내가 요청한 의뢰 (ajax) **/
/**
 * 참고 : 기업 미니홈피에서 바로의뢰로 진행하거나 포도씨가 타기업에 의뢰를 전달해줬을 경우 의뢰가 전달된 기업을 확인하기 위해서는 기능 작업이 필요
 * 방법 :
 * 1. 바로의뢰 건은 바로의뢰 버튼 추가
 * 2. 버튼 클릭 시 모달로 바로의뢰 기업의 로고를 나열하고 (현재 받은 견적 기업의 로고를 나열하는 것처럼)
 * 3. 로고 클릭 시 선택 기업의 미니홈피로 이동할 수 있도록 링크 걸기
 */

$noshow = sql_fetch(" select group_concat(idx separator ',') as noshow from g5_company_inquiry where find_in_set('{$member['mb_id']}', noshow) ")['noshow']; // 삭제자료
$sql_search = " and mb_id = '{$member['mb_id']}' and del_yn is null ";
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

// 요청의뢰 리스트
$sql = " select * from g5_company_inquiry where 1=1 {$sql_search} {$sql_orderby} ";
$rlt = sql_query($sql);

for($i=0; $row=sql_fetch_array($rlt); $i++) {
    $podosea = false;
    if(!empty($row['podosea']) && empty($row['pass_yn'])) { $podosea = true; } // 포도씨에 의뢰했고 && 포도씨에서 타기업에 의뢰를 전달하지 않았을 경우 (mypage_company.php 동일 소스 존재)

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
    if($row['ci_state'] == 'Processing Submission') { // 상태 : 접수대기 ==> 견적이 있으면 상태변경 모달창 O / 견적이 없으면 상태변경 모달창 X
        $class = 'wait';
        if($cnt2 > 0) { $modal = true; }
        else { $modal = false; }
    }
    else if($row['ci_state'] == 'Quotation Under Review') { $class = 'check'; }
    else if($row['ci_state'] == 'Transaction Complete') { $class = 'select'; }
    else if($row['ci_state'] == 'Agreement Incomplete') { $class = 'no'; }
    else if($row['ci_state'] == 'Deadline') { $class = 'finish'; }
?>
<li>
    <i class="<?=$class?>" onclick="state_modal('<?=$row['idx']?>', '<?=$row['ci_state']?>', '<?=$cnt2?>', '<?=$selection?>');"><em></em><?=$row['ci_state']?></i> <!-- 상태:마감이면 모달창 띄우지 않음 (상태 변경 불가) -->
    <div class="top">
        <input type="checkbox" name="noshow_chk" value="<?=$row['idx']?>">

		<span class="data"><?=str_replace('-','.', substr($row['wr_datetime'],0,10))?></span>
        <?php if($dday == 0 && $row['ci_state'] == 'Processing Submission') { // 금일이 의뢰마감일 && 접수대기 상태 ?>
        <span class="dday on" onclick="state_modal('<?=$row['idx']?>', 'dday', '<?=$cnt2?>', '<?=$selection?>');"><em class="blink">D-day</em></span>
        <?php } else if($dday > 0) { ?>
        <span class="dday">D - <?=$dday?></span>
        <?php } ?>
    </div>
    <a href="<?php echo G5_BBS_URL ?>/mypage_company_detail01.php?idx=<?=$row['idx']?>">
        <!--의뢰제목-->
        <h3><?=$row['ci_subject']?></h3>

        <!--견적보낸사람들 프로필-->
        <ul class="list_profile">
            <?php if($podosea) { ?>
            <li class="nodata podo">This is the request for podosea.</li>
            <?php } else { // 견적 리스트
                $rlt2 = sql_query(" select ce.*, mb.mb_category from g5_company_estimate as ce left join g5_member as mb on mb.mb_id = ce.mb_id where company_inquiry_idx = '{$row['idx']}' order by idx limit 6 ");
                $j = 0;
                while ($row2 = sql_fetch_array($rlt2)) {
                $j++;
            ?>
            <li>
                <div class="area_profile basic">
                <?php if($cnt2 > 6 && $j == 6) { ?>
                    <div class="area_add">
                        <span>+<?=$cnt2 - 6?></span>
                    </div>
                <?php } ?>
                <?php echo getProfileImg($row2['mb_id'], $row2['mb_category']); ?>
                </div>
            </li>
            <?php
                }
                if($j == 0) {
                ?>
                <li class="nodata">There is no Quotation Received.</li>
                <?php
                }
            }
            ?>
        </ul>
        <span class="date">Deadline : <?=str_replace('-','.',$row['ci_deadline_date'])?></span>
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

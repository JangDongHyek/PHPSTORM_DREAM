<?php
include_once('./_common.php');

/** 기업의뢰 메인 (ajax) **/

// 정렬
$sql_orderby = " order by wr_datetime desc "; // default 등록순
if($orderby == '등록순') { // 등록순
    $sql_orderby = " order by wr_datetime desc ";
}
else if($orderby == '마감순') { // 마감순
    $sql_orderby = " order by ci_deadline_date asc ";
}

$sql_search = " and podosea != 'Y' and ci_deadline_date >= date_format(now(), '%Y-%m-%d') and ci_state = '접수대기' and target_mb_no = 0 and del_yn is null "; // 접수대기 상태의 의뢰만 표시 / 기업 미니홈피에서 의뢰 시 해당 기업만 의뢰 조회 가능 해야 함

if(!$private) {
    $sql_search .= " and mb_id != 'com01' ";
}

// 검색 (검색어 입력)
if(!empty(trim($search))) {
    $sql_search .= " and (ci_subject like '%{$search}%' or ci_contents like '%{$search}%' or ci_category like '%{$search}%' or ci_maker like '%{$search}%' or ci_model like '%{$search}%' or ci_serial_no like '%{$search}%') ";
}

// 검색 (의뢰유형)
if(!empty($type) && $type != '전체') {
    $sql_search .= " and ci_type = '{$type}' ";
}

// 검색 (카테고리)
if(!empty($category) && $category != '전체') {
    $sql_search .= " and ci_category = '{$category}' ";
}

// 검색 (기간검색)
if(!empty($date)) {
    if($date == '1일') { // 1일전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 DAY)";
    }
    else if($date == '1주일') { // 1주일전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 7 DAY)";
    }
    else if($date == '1개월') { // 1개월전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 MONTH)";
    }
}

// 페이징
$sql = " select count(*) as cnt from g5_company_inquiry where 1=1 {$sql_search} {$sql_orderby} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 기업의뢰 리스트 (포도씨에 직업 의뢰 건과 삭제 건은 리스트에서 제외)
$sql = " select * from g5_company_inquiry where 1=1 {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    $date = $row['ci_deadline_date'];
    $todate = date("Y-m-d", time());
    $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
    /*if($dday >= 0) {
        $dday = $dday . '일 남음';
    } else {
        $dday = abs($dday) . '일 지남';
    }*/

?>
<li class="company">
    <?php if($member['mb_level'] == 3 || $member['mb_level'] == 10) { ?>
    <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$row['idx']?>">
    <?php } else { ?>
    <a onclick="memberCheck('<?=$member['mb_category']?>');">
    <?php } ?>
        <div class="title">
            <em><?=$row['ci_category']?></em><!-- 카테고리 -->
            <h3><?=$row['ci_subject']?></h3> <!-- 제목 -->
        </div>
        <div class="cont">
            <ul class="list_text">
                <li><em>Maker</em><span><?=$row['ci_maker']?></span></li><!-- 제조사 -->
                <li><em>Model</em><span><?=$row['ci_model']?></span></li><!-- 모델 -->
                <li class="period"><span><?=$dday?>일 남음</span></li><!-- 견적남은기간 -->
            </ul>
            <div class="list_info">
                <span class="data"><?=replaceDateFormat($row['wr_datetime'])?></span> <!-- 의뢰올린날자 -->
            </div>
        </div>
    </a>
</li>
<?php
}
if($i==0) {
?>
<div style="text-align: center;">등록된 의뢰가 없습니다.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
<?php
include_once('./_common.php');

/** 매물리스트 메인 (ajax) **/

// 정렬
$sql_orderby = " order by wr_datetime desc "; // default 등록순
if($orderby == '등록순') { // 등록순
    $sql_orderby = " order by wr_datetime desc ";
}
else if($orderby == '마감순') { // 마감순
    $sql_orderby = " order by ci_deadline_date asc ";
}

$sql_search = " and del_yn is null "; // 접수대기 상태의 의뢰만 표시 / 기업 미니홈피에서 의뢰 시 해당 기업만 의뢰 조회 가능 해야 함

// 검색 (검색어 입력)
if(!empty(trim($search))) {
    $sql_search .= " and (ci_subject like '%{$search}%' or ci_contents like '%{$search}%' or sale_category like '%{$search}%' or ci_maker like '%{$search}%' or ci_model like '%{$search}%' or ci_serial_no like '%{$search}%') ";
}

// 검색 (의뢰유형)
if(!empty($type) && $type != 'All') {
    $sql_search .= " and lower(sale_type) = '{$type}' ";
}

// 검색 (카테고리)
if(!empty($category) && $category != 'All') {
    $sql_search .= " and sale_category = '{$category}' ";
}

// 검색 (기간검색)
if(!empty($date)) {
    if($date == '1 day') { // 1일전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 DAY)";
    }
    else if($date == '1 week') { // 1주일전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 7 DAY)";
    }
    else if($date == '1 month') { // 1개월전~지금
        $sql_search .= " and date_format(wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 MONTH)";
    }
}

// 페이징
$sql = " select count(*) as cnt from g5_for_sale where 1=1 {$sql_search} {$sql_orderby} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 기업의뢰 리스트 (포도씨에 직업 의뢰 건과 삭제 건은 리스트에서 제외)
$sql = " select * from g5_for_sale where 1=1 {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    if($row['sale_type'] == 'ship') { // 선박
?>
    <!-- 선박매물 -->
    <li class="company">
        <a href="<?php echo G5_BBS_URL ?>/product_view.php?idx=<?=$row['idx']?>">
            <div class="title">
                <em><?=$row['sale_category']?></em><!-- 카테고리 -->
                <h3><?=$row['sale_subject']?></h3> <!-- 매물 제품명 -->
            </div>
            <div class="cont">
                <div class="left">
                    <ul class="list_text">
                        <li><em>Ref. No.</em><span><?=$row['ref_no']?></span></li><!-- Ref.No. -->
                        <li><em>Ship Type</em><span><?=$row['ship_type']?></span></li><!-- Ship Type -->
                        <li><em>Capacity</em><span><?=$row['main_capacity']?></span></li><!-- Capacity -->
                        <li><em>LOA (Meter)</em><span><?=$row['loa']?></span></li><!-- LOA (Meter) -->
                        <li><em>Built (Year)</em><span><?=$row['built_year']?></span></li><!-- Built (Year) -->
                    </ul>
                    <div class="list_info">
                        <span class="data"><?=str_replace('-', '.', substr($row['wr_datetime'], 0, 10))?></span> <!-- 의뢰올린날자 -->
                    </div>
                </div>
            </div>
        </a>
    </li>
    <!-- //선박매물 -->
<?php
    }
    else if($row['sale_type'] == 'machinery') { // 기계장비
    ?>
    <!-- 기계장비 -->
    <li class="company">
        <a href="<?php echo G5_BBS_URL ?>/product_view.php?idx=<?=$row['idx']?>">
            <div class="title">
                <em><?=$row['sale_category']?></em><!-- 카테고리 -->
                <h3><?=$row['sale_subject']?></h3> <!-- 매물 제품명 -->
            </div>
            <div class="cont">
                <div class="left">
                    <ul class="list_text">
                        <li><em>Ref. No.</em><span><?=$row['ref_no']?></span></li><!-- Ref.No. -->
                        <li><em>Product Name</em><span><?=$row['product_name']?></span></li><!-- Product Name -->
                        <li><em>Maker</em><span><?=$row['maker']?></span></li><!-- Maker -->
                        <li><em>Model/type</em><span><?=$row['model']?></span></li><!-- Model/type -->
                        <li><em>YOM</em><span><?=$row['yom']?></span></li><!-- YOM -->
                    </ul>
                    <div class="list_info">
                        <span class="data"><?=str_replace('-', '.', substr($row['wr_datetime'], 0, 10))?></span> <!-- 의뢰올린날자 -->
                    </div>
                </div>
            </div>
        </a>
    </li>
    <!-- //기계장비 -->
    <?php
    }
    else if($row['sale_type'] == 'parts/articles') {
    ?>
    <!-- 부품/물품 -->
    <li class="company">
        <a href="<?php echo G5_BBS_URL ?>/product_view.php?idx=<?=$row['idx']?>">
            <div class="title">
                <em><?=$row['sale_category']?></em><!-- 카테고리 -->
                <h3><?=$row['sale_subject']?></h3> <!-- 매물 제품명 -->
            </div>
            <div class="cont">
                <div class="left">
                    <ul class="list_text">
                        <li><em>Ref. No.</em><span><?=$row['ref_no']?></span></li><!-- Ref.No. -->
                        <li><em>Maker</em><span><?=$row['maker']?></span></li><!-- Maker -->
                        <li><em>Model/type</em><span><?=$row['model']?></span></li><!-- Model/type -->
                    </ul>
                    <div class="list_info">
                        <span class="data"><?=str_replace('-', '.', substr($row['wr_datetime'], 0, 10))?></span> <!-- 의뢰올린날자 -->
                    </div>
                </div>
            </div>
        </a>
    </li>
    <!-- //부품/물품 -->
    <?php
    }
}
if($i==0) {
?>
<div style="text-align: center;">There are no For Sale.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
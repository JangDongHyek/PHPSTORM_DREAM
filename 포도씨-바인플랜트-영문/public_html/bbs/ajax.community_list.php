<?php
include_once('./_common.php');

// 카테고리
if(empty($op) || $op == 'tab1') {
    $co_category = 'Tips';
} else if($op == 'tab2') {
    $co_category = 'Casual talk';
} else if($op == 'tab3') {
    $co_category = 'Company/on-site stories';
} else if($op == 'tab4') {
    $co_category = 'Maritime industry news';
}

// 쿼리 조건 및 정렬
$sql_search = " and co_category = '{$co_category}' and del_yn is null ";
if($gubun == 'main') { // 게시판별 인기글
    $sql_orderby = " order by co_good desc, wr_datetime "; // default 인기순
} else { // 각 카테고리별 게시글
    $sql_orderby = " order by wr_datetime desc "; // default 최신순
}
if($orderby == '최신순') { // 최신순
    $sql_orderby = " order by wr_datetime desc ";
}
else if($orderby == '인기순') { // 인기순 (좋아요 순)
    $sql_orderby = " order by co_good desc, wr_datetime ";
}

// 검색 (검색어 입력)
if(!empty(trim($search))) {
    $sql_search .= " and (co_subject like '%{$search}%' or co_contents like '%{$search}%' or co_hashtag like '%{$search}%') ";
}

// 검색 (태그)
if(!empty($sch_tag)) {
    $sql_search .= " and co_hashtag like '%{$sch_tag}%' ";
}

// 페이징
$sql = " select count(*) as cnt from g5_community as co left join g5_member as mb on mb.mb_id = co.mb_id where 1=1 {$sql_search} {$sql_orderby} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 커뮤니티 리스트
$sql = " select co.*, mb.mb_nick from g5_community as co left join g5_member as mb on mb.mb_id = co.mb_id where 1=1 {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 답변수
    $a_count = sql_fetch(" select count(*) as count from g5_community_answer where community_idx = '{$row['idx']}' and del_yn is null; ")['count'];
    // 조회수
    $v_count = selectCount('g5_community_action', 'community_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터
?>
<li class="left">
    <a href="<?=G5_BBS_URL?>/community_view.php?idx=<?=$row['idx']?>">
        <div class="subject"><h3><?=$row['co_subject']?></h3><em class="reply"><i><?=number_format($a_count)?></i></em></div>
        <span class="contents"><?=strip_tags($row['co_contents'])?></span>
        <div class="list_info">
            <span class="id">
                <?php
                if($row['co_open'] == 'private') { echo '익명'; }
                else { echo getNickOrId($row['mb_id']); }
                ?>
            </span>
            <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
            <span class="view">조회수 <em><?=number_format($v_count)?></em></span>
        </div>
    </a>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata">There are no registered post.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
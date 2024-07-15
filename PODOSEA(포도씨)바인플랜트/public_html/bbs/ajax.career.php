<?php
include_once('./_common.php');

// 프로필 업데이트 체크
$profile_flag = profileUpdateCheck($member['mb_id'], $member['mb_level']);

// 정렬
$sql_orderby = " order by wr_datetime desc ";
if($orderby == '최신순') { // 최신순
    $sql_orderby = " order by wr_datetime desc ";
}
else if($orderby == '마감순') { // 마감순
    $sql_orderby = " order by field(cr_always, 'Y') asc, cr_eddate asc, wr_datetime desc ";
}

// 검색 (검색어 입력)
$sql_search = " where 1=1 and (date_format(now(), '%Y-%m-%d') <= cr.cr_eddate or cr_always = 'Y') and cr_state is null ";
if(!empty($search)) { // 제목, 회사명, 해시태그
    $sql_search .= " and (cr_subject like '%{$search}%' or mb_company_name like '%{$search}%' or cr_hashtag like '%{$search}%') ";
}

// 페이징
$sql = " select count(*) as cnt from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 16;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select cr.*, mb.mb_category, mb.mb_company_name from g5_career_recruit as cr left join g5_member as mb on mb.mb_id = cr.mb_id {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 채용공고 D-DAY
    $date = $row['cr_eddate'];
    $todate = date("Y-m-d", time());
    $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
?>
<li>
    <a onclick="profileCheck('<?=$row['idx']?>', 'career', '<?=$profile_flag?>', '<?=$member['mb_id']?>');">
        <div class="top">
            <div class="company_logo"><?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?></div>
            <span><?=$row['mb_company_name']?></span>
            <h3><?=$row['cr_subject']?></h3>
        </div>
        <div class="bottom">
            <span><?=$recruit_salary[$row['cr_work_salary']]?></span><!-- 연봉 -->
            <em><?=!empty($row['cr_always']) ? '상시채용' : 'D - '.$dday; ?></em><!-- 남은기간 -->
        </div>
    </a>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata">등록된 채용공고가 없습니다.</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
<input type="hidden" id="total_count" value="<?=$total_count?>">
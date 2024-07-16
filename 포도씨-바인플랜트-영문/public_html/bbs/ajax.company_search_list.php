<?php
include_once('./_common.php');

// 프로필 업데이트 체크
$profile_flag = profileUpdateCheck($member['mb_id'], $member['mb_level']);

// 정렬
$sql_orderby = " order by sort is not null asc, field(mb_grade, 'Premium') desc, mb_hashtag is null asc "; // default 리뷰순 (바인플랜트는 마지막에, 프리미엄 회원은 최상위, 프로필업데이트 완료한 회원 중에서 리뷰순)
if(!empty(trim($search))) $sql_orderby = "order by sort is not null asc "; // 검색어 있을 시
// select 컬럼
$sql_add = ", (select count(*) from g5_company_inquiry_result where inquiry_mb_id = mb.mb_id and type = '거래후기') as review_cnt ";

if($orderby == 'By Review') { // 리뷰순 (리뷰 많은 순, 리뷰수 동일하면 최신순)
    $sql_add = ", (select count(*) from g5_company_inquiry_result where inquiry_mb_id = mb.mb_id and type = '거래후기') as review_cnt ";
    $sql_orderby .= ", review_cnt desc ";
}
else if($orderby == 'By Rating') { // 평점순 (평점 높은 순, 평점 동일하면 최신순)
    $sql_add = ", (select avg(star_score) from g5_company_inquiry_result where estimate_mb_id = mb.mb_id and type = '거래후기') as avg ";
    $sql_orderby .= ", avg desc ";
}
else if($orderby == 'By Transaction') { // 거래순 (거래 많은 순, 거래수 동일하면 최신순)
    $sql_add = ", ((select count(*) from g5_company_inquiry where mb_id = mb.mb_id and ci_state = '거래완료') + (select count(*) from g5_company_estimate where mb_id = mb.mb_id and ce_selection = 'Y')) as deal_cnt";
    $sql_orderby .= ", deal_cnt desc ";
}

// 테스트완료 후 com01 삭제
$sql_search = " and mb_category = '기업' and mb_level != 1 and mb_intercept_date = '' and mb_id not in ('test01', 'test02', 'test03') ";

// 검색 (검색어 입력)
if(!empty(trim($search))) {
    $sql_search .= " and (mb_company_name like '%{$search}%' or mb_company_introduce like '%{$search}%' or mb_hashtag like '%{$search}%' or FIND_IN_SET('{$search}', mb_hashtag)) ";
    $sql_orderby .= ", CASE WHEN mb_hashtag LIKE '%{$search}%' THEN 0 ELSE 1 END, mb_company_introduce LIKE '%{$search}%' DESC, mb_company_name LIKE '%{$search}%' DESC ";
}
$sql_orderby .= ", mb_no desc ";

// 검색 (분야(업종))
if(!empty($filter1) && $filter1 != '전체') {
    $secter = array_keys($company_sectors, $filter1)[0];
    $sql_search .= " and mb_company_sector = '{$secter}' ";
}

// 검색 (country)
if(!empty($filter2) && $filter2 != '전체') {
    $tmpArr = explode(',', $filter2);
    $searchFilter = '';
    foreach ($tmpArr as $tmpData) {
        $searchFilter .= "'".$tmpData."',";
    }
    $searchFilter = substr($searchFilter, 0, -1);

    $sql_search .= " and mb_company_si in ({$searchFilter}) ";
}

// 페이징
$sql = " select count(*) as cnt from g5_member where 1=1 {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 관심기업 확인
$com_rlt = sql_query(" select * from g5_like_company where mb_id = '{$member['mb_id']}'; "); // 나의 관심기업 리스트
$com_arr = array();
while($com = sql_fetch_array($com_rlt)) {
    array_push($com_arr, $com['company_mb_id']);
}

// 기업 리스트 (탈퇴 또는 이용정지 기업 제외)
// * 쿼리 수정 시 index.php 쿼리도 같이 수정해야하는지 확인! *
$sql = " select * {$sql_add}
         from g5_member as mb where 1=1 {$sql_search} {$sql_orderby} limit {$from_record}, {$rows} ";
// if($private) echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    //해시태그
    $hashtag = '';
    if(!empty($row['mb_hashtag'])) {
        $tag = explode(',',$row['mb_hashtag']);
        for($j=0; $j<count($tag); $j++) {
            $sch_class = '';
            if($sch_tag == $tag[$j] || $search == $tag[$j]) {
                $sch_class = " class='sch_word' ";
            }
            $hashtag .= '<li '.$sch_class.' onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
        }
    }
?>
<li class="company">
        <div class="title">
			<a onclick="javascript:profileCheck('<?=$row['mb_no']?>', 'company', '<?=$profile_flag?>', '<?=$member['mb_id']?>');">
            <div class="company_logo"><?=getProfileImg($row['mb_id'], $row['mb_category'])?></div>
            <div class="company_info">
                <h3><?=$row['mb_company_name']?><?php if($row['podosea_certify'] == 'Y') { ?><span class="certified"><i class="fad fa-badge-check"></i> Certified</span><?php } ?></h3><!-- 회사이름 -->
                <div class="area_star">
                    <div class="img_star v<?=companyScore($row['mb_id'])?>">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
			<!-- 관심기업버튼 클릭하면 class="on" 추가-->
            <?php
            $com_class = '';
            $mode = 'add';
            if(in_array($row['mb_id'], $com_arr)) { // 관심기업에 있음
                $com_class = 'on';
                $mode = 'del';
            }
            ?>
            <?php if($member['mb_category'] == '기업' && $row['mb_id'] != $member['mb_id']) { ?>
			<div class="interest_corp <?=$com_class?>" onclick="event.preventDefault();likeCompany('<?=$row['mb_id']?>', '<?=$mode?>')"></div>
            <?php } ?>
			</a>
        </div>
        <div class="cont">
			<a href="<?php echo G5_BBS_URL ?>/company.php?mb_no=<?=$row['mb_no']?>">
				<span class="intro">
                    <?php if(empty($row['mb_company_introduce'])) { ?>
                    There is no registered contents.
                    <?php } else { ?>
                    <?=$row['mb_company_introduce']?>
                    <?php } ?>
				</span>
			</a>
            <ul class="tag">
                <?=$hashtag?>
            </ul>
            <div class="list_info">
                <span class="reply">Total Transactions <em><?=completeCount($row['mb_id'])?></em></span>
                <span>number of reviews <em><?=reviewCount($row['mb_id'])?></em></span>
            </div>
        </div>

</li>
<?php
}
if($i==0) {
?>
<div style="text-align: center;">There are no registered companies.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>

<?php
include_once('./_common.php');

// 정렬
$sql_orderby = " order by he_good desc, he.wr_datetime "; // default 인기순
if($orderby == '인기순') { // 인기순 (좋아요 순)
    $sql_orderby = " order by he_good desc, he.wr_datetime ";
}
else if($orderby == '최신순') { // 최신순
    $sql_orderby = " order by he.wr_datetime desc ";
}
else if($orderby == '벙커순') { // 벙커순
    $sql_orderby = " order by he_bunker desc, idx ";
}

// 검색 (답변대기/답변완료)
$sql_search = " and he_answer_state = '답변대기' ";
if($state == '답변대기') {
    $sql_search = " and he_answer_state = '답변대기' ";
}
else if($state == '답변완료') {
    $sql_search = " and he_answer_state = '답변완료' ";
}

// 검색 (검색어 입력)
if(!empty(trim($search))) {
    $sql_search .= " and (he_subject like '%{$search}%' or strip_tags(he_contents) like '%{$search}%' or FIND_IN_SET('{$search}', he_hashtag) or FIND_IN_SET('{$search}', an_hashtag)) ";
}

// 검색 (카테고리)
if(!empty($category) && $category != '전체') {
    $sql_search .= " and he_category = '{$category}' ";
}

// 검색 (기간검색)
if(!empty($date)) {
    if($date == '1일') { // 1일전~지금
        $sql_search .= " and date_format(he.wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 DAY)";
    }
    else if($date == '1주일') { // 1주일전~지금
        $sql_search .= " and date_format(he.wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 7 DAY)";
    }
    else if($date == '1개월') { // 1개월전~지금
        $sql_search .= " and date_format(he.wr_datetime, '%Y-%m-%d') > date_sub(date_format(now(), '%Y-%m-%d'), INTERVAL 1 MONTH)";
    }
}

// 검색 (태그)
if(!empty($sch_tag)) {
    $sql_search .= " and (he_hashtag like '%{$sch_tag}%' or an_hashtag like '%{$sch_tag}%') ";
}

// 페이징
$sql = " select count(*) as cnt from (select count(*) from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx and an.del_yn is null where 1=1 and he.del_yn is null {$sql_search} group by he.idx {$sql_orderby}) as a ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 헬프미 리스트
$sql = " select he.* from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx and an.del_yn is null where 1=1 and he.del_yn is null {$sql_search} group by he.idx {$sql_orderby} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    //해시태그
    $hashtag = '';
    if(!empty($row['he_hashtag'])) {
        $tag = explode(',',$row['he_hashtag']);
        for($j=0; $j<count($tag); $j++) {
            $sch_class = '';
            if($sch_tag == $tag[$j] || $search == $tag[$j]) {
                $sch_class = " class='sch_word' ";
            }
            $hashtag .= '<li '.$sch_class.' onclick="tag_search(\''.$tag[$j].'\');">'.$tag[$j].'</li>';
        }
    }

    // 답변수 (공개설정이 전체공개)
    $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}' and del_yn is null; ")['count'];
    /*// 답변수 (공개설정이 전체공개)
    $a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}' and an_open = 'open' and del_yn is null; ")['count'];
    // 답변수 (공개설정이 질문자에게만 공개)
    $a_count_q = sql_fetch(" select count(*) as count from g5_helpme_answer as an left join g5_helpme as he on he.idx = an.helpme_idx where helpme_idx = '{$row['idx']}' and an_open = 'questioner' and (an.mb_id = '{$member['mb_id']}' or he.mb_id = '{$member['mb_id']}'); ")['count'];
    if(!empty($a_count_q)) { $a_count = $a_count + $a_count_q; } // 질문자이거나 해당 답변자가 로그인 시 답변수 +
    // 답변수 (공개설정이 비공개)
    $a_count_p = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = '{$row['idx']}' and an_open = 'private' and an_open = 'private' and mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
    if(!empty($a_count_p)) { $a_count = $a_count + $a_count_p; } // 해당 답변자가 로그인 시 답변수 +*/

    // 조회수
    $v_count = selectCount('g5_helpme_action', 'helpme_idx', $row['idx'], 'mode', 'view'); // 카운트 조회할 테이블명, 컬럼명, 데이터

    // 에디터에 이미지가 있을 경우
    $img_flag = false;
    if(strpos($row['he_contents'], '<img ') !== false) {
        $img_flag = true;
    }
?>
<!-- 이미지 없을 때 left에 noimg 클래스 추가 -->
<li>
    <div class="left <?php echo $img_flag ? '' : 'noimg'; ?>">
        <a href="<?php echo G5_BBS_URL ?>/help_view.php?idx=<?=$row['idx']?>"> <!--상세화면-->
            <h3><?php if(!empty($row['he_bunker'])) { ?><i><?=number_format($row['he_bunker'])?></i><?php } ?><?=$row['he_subject']?></h3> <!--적립 BUNKER / 제목-->
            <span class="contents"><?=strip_tags($row['he_contents'])?></span> <!--내용-->
        </a>
        <ul class="tag"> <!--해시태그-->
            <?=$hashtag?>
        </ul>
        <div class="list_info">
            <span class="reply">Answers <em><?=number_format($a_count)?></em></span>
            <span class="view">Views <em><?=number_format($v_count)?></em></span>
            <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span>
        </div>
    </div>
    <?php
    if($img_flag) {
        $img = explode('"', explode('src="', $row['he_contents'])[1])[0];
    ?>
    <!--<div class="right">
        <img src="<?/*=$img*/?>">
    </div>-->
    <?php
    }
    ?>
</li>
<?php
}
if($i==0) {
?>
<div style="text-align: center;">There are no registered questions.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
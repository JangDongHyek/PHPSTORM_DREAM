<?php
include_once('./_common.php');

/** 마이페이지 - 헬프미 (ajax) **/

// 페이징
if($mode == 'q') { // 질문
    $sql = " select count(*) as cnt from g5_helpme where 1=1 and del_yn is null and mb_id = '{$member['mb_id']}' ";
} else { // 답변
    $sql = " select count(*) as cnt from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx and an.del_yn is null where an.mb_id = '{$member['mb_id']}' and he.del_yn is null ";
}
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 헬프미 리스트
if($mode == 'q') { // 질문
    $sql = " select * from g5_helpme where 1=1 and del_yn is null and mb_id = '{$member['mb_id']}' order by idx desc limit {$from_record}, {$rows} ";
} else { // 답변
    $sql = " select he.*, an.an_selection, an.mb_id as an_mb_id, an.an_best, an.an_great from g5_helpme as he left join g5_helpme_answer as an on an.helpme_idx = he.idx and an.del_yn is null where an.mb_id = '{$member['mb_id']}' and he.del_yn is null order by an.helpme_idx desc limit {$from_record}, {$rows} ";
}
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 답변수
    $an_count = sql_fetch(" select count(*) as count from g5_helpme_answer where helpme_idx = {$row['idx']} and del_yn is null")['count'];

    // 나의질문 - 채택정보
    $best_flag = '미채택';
    $great_flag = '미채택';
    if(!empty($row['he_best'])) { $best_flag = '채택'; }
    if(!empty($row['he_great'])) { $great_flag = '채택'; }
    if(!empty($row['he_selection'])) {// 마감됐을 때 - 우수답변 선택 안하고 마감했다면
        if(empty($row['he_great'])) { $great_flag = '-'; }
    }

    // 나의답변 - 채택여부확인
    if(!empty($row['an_best'])) { $best_flag = '채택';  }
    if(!empty($row['an_great'])) { $great_flag = '채택'; }
?>
<a href="<?php echo G5_BBS_URL ?>/help_view.php?idx=<?=$row['idx']?>">
    <ul class="tbl_list tbl">
        <li class="type w2"><?=$row['he_category']?></li>
        <li class="subject w35"><?=$row['he_subject']?></li>
        <li class="select w1"><div class="reply">베스트답변</div><?=$best_flag?></li>
        <li class="select w1"><div class="reply">우수답변</div><?=$great_flag?></li>
        <li class="reply w1"><div class="reply">답변수</div><?=number_format($an_count)?></li>
        <li class="data w15"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></li>
    </ul>
</a>
<?php
}
if($i==0) {
?>
<ul class="tbl_list tbl">
    <li class="nodata" style="text-align: center;">등록된 내용이 없습니다.</li>
</ul>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
<?php
include_once('./_common.php');

/** 마이페이지 - 커뮤니티 (ajax) **/

// 페이징
if($mode == 'q') { // 나의작성글
    $sql = " select count(*) as cnt from g5_community where 1=1 and del_yn is null and mb_id = '{$member['mb_id']}' ";
} else { // 나의댓글
    $sql = " select count(*) as cnt from g5_community as co left join g5_community_answer as an on an.community_idx = co.idx and an.del_yn is null where an.mb_id = '{$member['mb_id']}' and co.del_yn is null ";
}
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 커뮤니티 리스트
if($mode == 'q') { // 나의작성글
    $sql = " select * from g5_community where 1=1 and del_yn is null and mb_id = '{$member['mb_id']}' order by idx desc limit {$from_record}, {$rows} ";
} else { // 나의댓글
    $sql = " select co.* from g5_community as co left join g5_community_answer as an on an.community_idx = co.idx and an.del_yn is null where an.mb_id = '{$member['mb_id']}' and co.del_yn is null order by an.community_idx desc limit {$from_record}, {$rows} ";
}
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
    // 답변수
    $an_count = sql_fetch(" select count(*) as count from g5_community_answer where community_idx = {$row['idx']} and del_yn is null")['count'];
?>
<a href="<?php echo G5_BBS_URL ?>/community_view.php?idx=<?=$row['idx']?>">
    <ul class="tbl_list tbl">
        <li class="type w25"><?=$row['co_category']?></li>
        <li class="subject w5"><?=$row['co_subject']?></li>
        <li class="reply w1"><div class="reply">답변</div><?=$an_count?></li>
        <li class="data w15"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></li>
    </ul>
</a>
<?php
}
if($i==0) {
?>
<li class="tbl_cont">
    <ul class="tbl_list tbl">
        <li class="nodata" style="text-align: center;">등록된 내용이 없습니다.</li>
    </ul>
</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
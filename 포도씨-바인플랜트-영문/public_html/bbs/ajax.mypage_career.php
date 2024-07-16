<?php
include_once('./_common.php');

/** 마이페이지 - 커리어 (ajax) */

// 페이징
$sql = " select count(*) as cnt from g5_resume where mb_id = '{$member['mb_id']}' ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$rlt = sql_query(" select * from g5_resume where mb_id = '{$member['mb_id']}' order by idx desc limit {$from_record}, {$rows} ");
$i = 0;
while($row = sql_fetch_array($rlt)) {
    $i++;
?>
<li class="company">
    <div class="title">
		<h3><?=$row['company_name']?></h3><!-- 지원한회사 -->
		<?php if($row['read_yn'] == 'Y') { ?><div class="read_ck"><span>이력서 읽음</span></div><?php } ?>
	</div>
    <div class="cont">
        <!-- 제목 -->
        <span class="subject"><?=$row['re_subject']?></span>
        <ul class="list_cinfo">
            <li>이름 : <?=$row['re_name']?></li>
            <li>연락처 : <?=$row['re_hp']?></li>
            <li>이메일 : <?=$row['re_email']?></li>
        </ul>
        <ul class="list_file">
            <?php
            $file_rlt = sql_query(" select * from g5_resume_file where resume_idx = '{$row['idx']}' order by idx ");
            while($file = sql_fetch_array($file_rlt)) {
            ?>
            <li><a href="javascript:fileDownload('resume', '<?=$file['img_file']?>', '<?=$file['img_source']?>')"><?=$file['img_source']?></a></li>
            <?php
            }
            ?>
        </ul>
        <div class="list_info">
        <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span><!--등록일-->
        </div>
    </div>
</li>
<?php
}
if($i==0) {
?>
<li class="nodata full">
    <p>등록된 내용이 없습니다.</p>
</li>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
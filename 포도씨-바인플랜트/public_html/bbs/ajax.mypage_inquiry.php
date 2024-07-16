<?php
include_once('./_common.php');

/** 기업 - 마이페이지 - 문의내역 (ajax) **/

// 페이징
$sql_search = " and cq.mb_no = '{$member['mb_no']}' ";
if($mode == 'ing') { // 처리중
    $sql_search .= " and cq.state = '처리중' ";
} else if($mode == 'com') { // 처리완료
    $sql_search .= " and cq.state = '처리완료' ";
}
$sql = " select count(*) as cnt from g5_company_question as cq left join g5_member as mb on mb.mb_id = cq.mb_id where 1=1 {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 문의내역 리스트
$sql = " select cq.*, mb.mb_no, mb.mb_id, mb.mb_category, mb.mb_company_name, mb.mb_category, mb.mb_level from g5_company_question as cq left join g5_member as mb on mb.mb_id = cq.mb_id where 1=1 {$sql_search} order by idx desc limit {$from_record}, {$rows} ";
//echo $sql;
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {
?>

<li class="company">
    <div class="title">
        <h3><?=$row['subject']?></h3> <!-- 제목 -->
    </div>
    <div class="cont">
        <div class="content_box">
            <span>
            <?=$row['contents']?>
			</span>
        </div>

        <div class="list_info">
            <span class="id toggle" onclick="userToggle('list_<?=$row['idx']?>');">
                <div class="profile toggle">
                <?php echo getProfileImg($row['mb_id'], $row['mb_category']); ?>
                </div><?=$row['mb_id']?>
            </span><!--아이디-->
            <span class="data"><?=str_replace('-','.',substr($row['wr_datetime'],0,10))?></span><!--등록일-->
			<div class="msort_list">
				<em onclick="listModal('<?=$row['idx']?>', '<?=$row['state']?>');"><?=$row['state']?></em>
			</div>

            <!-- 토글메뉴 -->
            <ul class="list_<?=$row['idx']?> user_list answer01 sm">
                <?php if($row['mb_level'] == '2') { // 작성자일반회원?>
                <li onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['mb_id']?>')">프로필보기</li>
                <li onclick="chatting('<?=$row['mb_id']?>');">채팅하기</li>
                <?php } ?>
                <?php if($row['mb_level'] == '3') { // 작성자기업회원?>
                <li><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$row['mb_no']?>">기업홈피로 이동</a></li>
                <li>의뢰건수 <em class="blue"><?=inquiryCount($row['mb_id'])?></em>건</li>
                <li>거래건수 <em class="blue"><?=completeCount($row['mb_id'])?></em>건</li>
                <?php } ?>
                <?php if(!$self) { // 내가쓴글아님?>
                <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_company_question', '<?=$row['idx']?>')">신고하기</li>
                <?php } ?>
            </ul>
            <!-- //토글메뉴 -->
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
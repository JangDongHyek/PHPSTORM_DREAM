<?php
include_once('./_common.php');
include_once('./oceanship_eng_db.php'); // 포도씨 영문버전 DB
/**
 * 글로벌의뢰 (ajax) - 포도씨 영문버전 기업의뢰 표시
 */

// 목록
$list = $db->getList($page, $orderby, $search, $type, $category, $date);
// 의뢰 수
$total_count = $list['cnt'];
$total_page = $list['page']; // 전체 페이지 계산

if(!empty($total_count)) {
    foreach ($list['list'] AS $key=>$val) {
        $date = $val['ci_deadline_date'];
        $todate = date("Y-m-d", time());
        $dday = ( strtotime($date) - strtotime($todate) ) / 86400;
    ?>
    <li class="company">
        <?php if($member['mb_level'] == 3 || $member['mb_level'] == 10) { ?>
        <a href="<?php echo G5_BBS_URL ?>/company_view.php?idx=<?=$val['idx']?>&v=eng">
        <?php } else { ?>
        <a onclick="memberCheck('<?=$member['mb_category']?>');">
        <?php } ?>
            <div class="title">
                <em><?=$val['ci_category']?></em><!-- 카테고리 -->
                <h3><?=$val['ci_subject']?></h3> <!-- 제목 -->
            </div>
            <div class="cont">
                <ul class="list_text">
                    <li><em>Maker</em><span><?=$val['ci_maker']?></span></li><!-- 제조사 -->
                    <li><em>Model</em><span><?=$val['ci_model']?></span></li><!-- 모델 -->
                    <li class="period"><span><?=$dday?>days left</span></li><!-- 견적남은기간 -->
                </ul>
                <div class="list_info">
                    <span class="data"><?=replaceDateFormat($val['wr_datetime'])?></span> <!-- 의뢰올린날자 -->
                </div>
            </div>
        </a>
    </li>
<?php
    }
}
else {
?>
<div style="text-align: center;">등록된 의뢰가 없습니다.</div>
<?php
}
?>
<span id="temp_total_page" name="temp_total_page" style="display: none;"><?=$total_page?></span>
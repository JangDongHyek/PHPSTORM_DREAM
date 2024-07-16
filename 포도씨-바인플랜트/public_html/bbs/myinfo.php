<?php
// 질문수
$q_count = sql_fetch(" select count(*) as count from g5_helpme where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
// 답변수
$a_count = sql_fetch(" select count(*) as count from g5_helpme_answer where mb_id = '{$member['mb_id']}' and del_yn is null; ")['count'];
?>

<style>
    .my_qna > li em {
        position: relative;
        bottom: 3px;
    }
</style>

<div id="area_my">
	<div class="myinfo">
		<div class="myinfo_wrap">
			<div class="area_photo">
            <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
            </div>
		</div>
		<div class="id">
			<i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><span><?=getNickOrId($member['mb_id'])?></span><!--<a class="btn_arrow" href=""></a>-->
		</div>
		<div class="area_nm">
			<em>나의 포도씨 항해 거리</em> <span class="blue"><?=number_format($member['mb_grade_point'])?>NM</span>
		</div>
		<ul class="my_qna">
			<li><a href="<?=G5_BBS_URL?>/mypage_help.php"><em>질문</em><?=number_format($q_count)?></a></li>
			<li><a href="<?=G5_BBS_URL?>/mypage_help.php"><em>답변</em><?=number_format($a_count)?></a></li>
		</ul>
	</div>
	<div class="area_bunker">
		<h3>Bunker</h3>
		<span><?=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])?></span>
	</div>
    <?php if(strpos($_SERVER['PHP_SELF'], 'company_list.php') !== false) { ?>
    <!-- 기업의뢰에만 나오게-->
    <?php if($member['mb_category'] == '기업') { ?>
    <div class="area_write company_write">
        <a href="<?php echo G5_BBS_URL ?>/company_write.php"><span>의뢰하기</span></a>
    </div>
    <?php } ?>
    <div class="area_write v2 company_write">
        <a href="" data-toggle="modal" data-target="#podoCS"><span>포도씨에 직접 의뢰하기!</span></a>
    </div>
    <!-- //기업의뢰에만 나오게-->
    <?php } else { ?>
    <div class="area_write">
        <a href="<?php echo G5_BBS_URL ?>/help_write.php"><span>질문하기</span></a>
    </div>
    <?php } ?>
</div>

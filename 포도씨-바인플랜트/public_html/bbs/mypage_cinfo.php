<div id="area_my" class="company">
	<div class="myinfo">
        <?php if($member['mb_grade'] == 'Premium') { ?>
        <div class="lv_label lv<?=array_search($member['mb_grade'], $member_grade)?>">
            <div class="txt">
                <h3>프리<br>미엄</h3>
            </div>
        </div>
        <?php } ?>
		<div class="myinfo_wrap">
			<div class="area_photo">
            <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
			</div>
		</div>
		<div class="id">
            <?php if(!$is_admin) { ?><i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><?php } ?><span><?=getNickOrId($member['mb_id'])?></span><a class="btn_arrow" href=""></a>
		</div>
		<div class="area_star">
			<span>기업평점 <i><?=companyScore($member['mb_id'], 'Y')?>점</i></span>

			<!-- v1 별점 1 -->
			<!-- v2 별점 2 -->
			<!-- v3 별점 3 -->
			<!-- v4 별점 4 -->
			<!-- v5 별점 5 -->

			<div class="img_star v<?=companyScore($member['mb_id'])?>">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="homepage"><a href="<?=G5_BBS_URL?>/company.php?mb_no=<?=$member['mb_no']?>"><em>마이홈페이지</em></a></div>
	</div>					
	<ul class="my_qna">
        <?php
        // 받은 견적 수
        $receive_count = sql_fetch(" select count(*) as cnt from g5_company_estimate as ce left join g5_company_inquiry as ci on ci.idx = ce.company_inquiry_idx where ci.mb_id = '{$member['mb_id']}' and ci.del_yn is null ")['cnt'];
        // 보내 견적 수
        $send_count = selectCount('g5_company_estimate', 'mb_id', $member['mb_id']);
        ?>
		<li><a href="javascript:void(0);"><?=inquiryCount($member['mb_id'])?></a><em>나의 의뢰</em></li> <!--나의 견적의뢰 수-->
		<li><a href="javascript:void(0);"><?=number_format($send_count)?></a><em>보낸 견적</em></li>
		<li><a href="javascript:void(0);"><?=completeCount($member['mb_id'])?></a><em>체결된 의뢰</em></li> <!--체결 의뢰 수-->
	</ul>
	<div class="area_bunker">
		<h3>Bunker</h3>
		<span><?=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])?></span>
	</div>
    <?php if($member['mb_grade'] == 'Basic') { ?>
	<div class="bn_premium">
        <a href="<?=G5_BBS_URL?>/premium.php">
			<h3>프리미엄 회원가입</h3>
		</a>
	</div>
    <?php } ?>
</div>
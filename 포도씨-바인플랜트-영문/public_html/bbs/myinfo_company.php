<div id="area_my" class="company">
	<div class="myinfo">
        <?php if($member['mb_grade'] == 'Premium') { ?>
		<div class="lv_label lv<?=array_search($member['mb_grade'], $member_grade)?>">
			<div class="txt">
				<h3>PRE<br>MIUM</h3>
			</div>
		</div>
        <?php } ?>
		<div class="myinfo_wrap">
			<div class="area_photo">
            <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
            </div>
		</div>
		<div class="id">
            <?php if(!$is_admin) { ?><i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><?php } ?><span><?=getNickOrId($member['mb_id'])?></span><!--<a class="btn_arrow" href=""></a>-->
		</div>
        <?php if(!$is_admin) { ?>
		<div class="area_star">
			<span>company rating <i><?=companyScore($member['mb_id'], 'Y')?></i></span>

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
		<ul class="my_qna">
			<li class="full"><em>Transactions</em><a href="javascript:void(0);"><?=completeCount($member['mb_id'])?></a></li>
		</ul>
        <?php } ?>
	</div>
    <?php if(!$is_admin) { ?>
	<!--<div class="area_bunker">
		<h3>Bunker</h3>
		<span><?/*=number_format($member['mb_bunker']+$member['mb_bunker_bonus'])*/?></span>
	</div>-->
    <?php } ?>

    <?php if(strpos($_SERVER['PHP_SELF'], 'company_list.php') !== false) { ?>
	<!-- 기업의뢰에만 나오게-->
    <?php if($member['mb_category'] == '기업') { ?>
	<div class="area_write company_write">
		<a href="<?php echo G5_BBS_URL ?>/company_write.php"><span>RFQ</span></a>
	</div>
    <?php } ?>

	<div class="area_write v2 company_write">
		<a href="" data-toggle="modal" data-target="#podoCS"><span>Podosea Direct RFQ!</span></a>
	</div>
	<!-- //기업의뢰에만 나오게-->

	<!-- 매물리스트에만 나오게 -->
	<div class="area_write v3 product_write" style="display: none;">
		<a href="<?php echo G5_BBS_URL ?>/product_write.php"><span>For Sale</span></a>
	</div>
   <!-- 매물리스트에만 나오게-->
    <?php } else { ?>
    <div class="area_write">
        <a href="<?php echo G5_BBS_URL ?>/help_write.php"><span>Ask a question</span></a>
    </div>
    <?php } ?>
</div>

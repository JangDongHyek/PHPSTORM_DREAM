<div id="area_my" class="company">
	<div class="myinfo">
		<div class="myinfo_wrap">
			<div class="area_photo">
				
				<img class="basic" src="<?php echo G5_IMG_URL ?>/img_smile.svg">
			</div>
		</div>
		<div class="id">
			<i class="lv3">기업회원</i><span><?php echo !empty($member['mb_nick']) ? $member['mb_nick'] : $member['mb_id']; ?></span><a class="btn_arrow" href=""></a>
		</div>
		<div class="area_star">
			<span>기업평점 <i><?=$member['mb_grade_score']?>점</i></span>

			<!-- v1 별점 1 -->
			<!-- v2 별점 2 -->
			<!-- v3 별점 3 -->
			<!-- v4 별점 4 -->
			<!-- v5 별점 5 -->

			<div class="img_star v5">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="homepage"><a href=""><em>마이홈페이지</em></a></div>						
	</div>					
	<ul class="my_qna">
		<li><a href="javascript:void(0);"><?=number_format($q_count)?></a><em>받은견적</em></li>
		<li><a href="javascript:void(0);"><?=number_format($a_count)?></a><em>보낸견적</em></li>
		<li><a href="javascript:void(0);"><?=number_format($a_count)?></a><em>체결된 의뢰</em></li>
	</ul>

</div>
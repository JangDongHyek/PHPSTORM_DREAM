
<div id="area_left">
	<div class="box_sch">
		<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/help_list.php">
		  <input type="text" id="search" placeholder="검색어를 입력해주세요." name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>">
		  <button type="submit"></button>
		</form>
	</div>
	<div class="box_filter">
		<h3>기간검색</h3>
		<div class="select_box v1">
			<div class="box">
				<div class="select">기간전체</div>
				<ul class="list date">
					<li class="selected">기간전체</li>
					<li>1일</li>
					<li>1주일</li>
					<li>1개월</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="box_cate">
		<h3>카테고리</h3>
		<ul>
			<li class="active">전체</li>
			<li>선박 운항, 항해</li>
			<li>선박 기관, 정비</li>
			<li>조선</li>
			<li>플랜트</li>
			<li>수산</li>
			<li>해운</li>
			<li>항만,물류</li>
			<li>기타</li>
			<li>고민 Q&A</li>
		</ul>
	</div>
</div>
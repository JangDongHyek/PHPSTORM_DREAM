
<div id="area_left">
	<div class="box_sch">
		<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/company_search.php">
		  <input type="text" id="search" placeholder="검색어를 입력해주세요." name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>">
		  <button type="submit"></button>
		</form>
	</div>
	<!--
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
	-->
	<div class="box_cate first filter1">
		<h3>분야</h3>		
		<ul>
			<li class="active">전체</li>
			<li>조선소</li>
			<li>플랜트, 오프쇼어</li>
			<li>해운, 항만, 물류</li>
			<li>선주, 선사</li>
			<li>선급, 유관기관 및 단체</li>
			<li>조선 해양 기자재</li>
			<li>선박관리, 선박수리</li>
			<li>수산 (Fishery)</li>
			<li>요트, 해양 레저</li>
			<li>선용품</li>
			<li>기타 관련 업체</li>
		</ul>	
	</div>
	<div class="box_cate filter2">
		<h3>지역</h3>		
		<ul>
			<li class="active">전체</li>
			<li>서울</li>
            <li>인천</li>
            <li>부산</li>
            <li>울산</li>
            <li>대구</li>
            <li>대전</li>
            <li>광주</li>
            <li>세종</li>
            <li>경기(평택)</li>
            <li>경남(거제,창원)</li>
            <li>경북(포항)</li>
            <li>전남(목포,여수)</li>
            <li>전북(군산,부안)</li>
            <li>충남(당진,서산)</li>
            <li>충북</li>
            <li>강원</li>
            <li>제주</li>
		</ul>
	</div>
</div>
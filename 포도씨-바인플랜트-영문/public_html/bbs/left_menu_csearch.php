
<div id="area_left">
	<div class="box_sch">
		<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/company_search.php">
		  <input type="text" id="search" placeholder="Search" name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>">
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
		<h3>Field</h3>
		<ul>
			<li class="active">All</li>
			<li>Shipyard</li>
			<li>Plant & Offshore</li>
			<li>Shipping, Habors and Logistics</li>
			<li>Shipowner & Shipper</li>
			<li>Ship Classification, Related Organization and/or Group</li>
			<li>Marine Equipment</li>
			<li>Ship Management & Ship Repair</li>
			<li>Fishery</li>
			<li>Yacht & Maritime Leisure</li>
			<li>Ship Supplies</li>
			<li>Other Business</li>
		</ul>
	</div>
	<div class="box_cate filter2 country">
		<h3>Country</h3>
		<div class="box_sch country">
			<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/company_search.php">
			  <input type="text" id="search" placeholder="Search more countries." name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>" onkeyup="searchCountry(this.value);">
			</form>
		</div>
		<ul class="area_filter">

		</ul>
	</div>
</div>

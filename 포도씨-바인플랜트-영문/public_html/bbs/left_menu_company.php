
<div id="area_left">
	<div class="box_sch">
		<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/company_list.php">
		  <input type="text" id="search" placeholder="Enter the Items" name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>">
		  <button type="submit"></button>
		</form>
	</div>
	<div class="box_filter">
		<h3>Search by Date</h3>
		<div class="select_box v1">
			<div class="box">
				<div class="select">All</div>
				<ul class="list date">
					<li class="selected">All</li>
                    <li>1 DAY</li>
                    <li>1 WEEK</li>
                    <li>1 MONTH</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- 기업의뢰 의뢰유형-->
	<div class="box_cate ci_type">
		<h3>RFQ Type</h3>
		<ul>
			<li class="active">All</li>
			<li>Service</li>
			<li>Parts</li>
			<li>Ship Supplies</li>
			<li>Others</li>
		</ul>
	</div>
	<!-- //기업의뢰 의뢰유형-->

	<!-- 기업의뢰 카테고리-->
	<div class="box_cate v2 ci_category">
		<h3>Category</h3>
		<ul>
			<li class="active"><span>All</span></li>
			<li><span>Engine</span></li>
			<li><span>Auxiliary Machinery</span></li>
			<li><span>Valve, Filter/Strainer, Pipe Fittings</span></li>
			<li><span>Propulsion System And Rudder System</span></li>
			<li><span>HVAC, Refrigeration System</span></li>
			<li><span>Electrical Equipment and Automation</span></li>
			<li><span>Communication and Navigation Equipment</span></li>
			<li><span>Deck Machinery & Cargo Hold Hatch Cover</span></li>
			<li><span>Fire Fighting/Life-Saving and Personal Safety/Protection</span></li>
			<li><span>Measuring Meter/Instrument/Special Tool</span></li>
			<li><span>Galley Equipment/Laundry Equipment/Sanitory Unit</span></li>
			<li><span>Ship Chandler</span></li>
			<li><span>New Building & Conversion</span></li>
			<li><span>Maintenance & Repair Services</span></li>
			<li><span>Other Service & Products</span></li>
		</ul>
	</div>
	<!-- //기업의뢰 카테고리-->

	<!-- 매물리스트 카테고리-->
	<div class="box_cate v2 pr_type pr_cate" style="display: none;">
		<h3>For Sale Type</h3>
		<ul>
			<li class="active"><span>All</span></li>
			<li>Ship</li>
			<li>Machinery</li>
			<li>Parts/Articles</li>
		</ul>
	</div>
	<!-- //매물리스트 카테고리-->

	<!-- 매물리스트 선박 카테고리-->
	<div class="box_cate v2 pr_category pr_cate1" style="display: none;">
		<h3>Category</h3>
		<ul>
            <li class="active"><span>All</span></li>
			<li>Bulk Carriers</li>
			<li>Oil/Gas Carriers</li>
			<li>Tugs/Barges</li>
			<li>FD/FC/Work Vessels</li>
			<li>Special/Offshore</li>
			<li>Passenger Ships</li>
			<li>Fishing Vessels</li>
			<li>Yachat/Boat</li>
		</ul>
	</div>
	<!-- //매물리스트 선박 카테고리-->

	<!-- 매물리스트 기계장비 카테고리-->
	<div class="box_cate v2 pr_category pr_cate2" style="display: none;">
		<h3>Category</h3>
		<ul>
            <li class="active"><span>All</span></li>
			<li>Engine</li>
			<li>Generator</li>
			<li>Crane</li>
			<li>Heavy equipment</li>
			<li>Transpoter</li>
			<li>Machines</li>
			<li>Tools</li>
			<li>Others</li>
		</ul>
	</div>
	<!-- //매물리스트 기계장비 카테고리-->

	<!-- 매물리스트 부품/물품 카테고리-->
	<div class="box_cate v2 pr_category pr_cate3" style="display: none;">
		<h3>Category</h3>
		<ul>
            <li class="active"><span>All</span></li>
			<li>Auxiliary Machinery</li>
			<li>Valve, Filter/Strainer, Pipe Fittings</li>
			<li>Propulsion System And Rudder System</li>
			<li>HVAC, Refrigeration System</li>
			<li>Electrical Equipment and Automation</li>
			<li>Communication and Navigation Equipment</li>
			<li>Deck Machinery & Cargo Hold Hatch Cover</li>
			<li>Deck/Accommodation Outfitting</li>
			<li>Fire Fighting/Life-Saving and Personal Safety</li>
			<li>Measuring Meter/Instrument/Special Tool</li>
			<li>Galley Equipment/Laundry Equipment/Sanitory</li>
			<li>Ship Chandler</li>
			<li>Non-Marine Product</li>
		</ul>
	</div>
	<!-- //매물리스트 부품/물품 카테고리-->
</div>

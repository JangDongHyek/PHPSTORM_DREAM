
<div id="area_left">
	<div class="box_sch">
		<form name="fsearchbox" method="get" action="<?=G5_BBS_URL?>/help_list.php">
		  <input type="text" id="search" placeholder="Enter search terms." name="search" value="<?php echo empty($search) ? (empty($sch_txt) ? '' : $sch_txt) : $search; ?>">
		  <button type="submit"></button>
		</form>
	</div>
	<div class="box_filter">
		<h3>Search by date</h3>
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
	<div class="box_cate">
		<h3>Category</h3>
		<ul>
			<li class="active">All</li>
			<li>Sailing, navigation</li>
			<li>Marine engineering</li>
			<li>Shipbuilding & Repair</li>
			<li>Offshore, plant</li>
			<li>Fishery</li>
			<li>Shipping, Transport</li>
			<li>Harbors, logistics</li>
			<li>Others</li>
			<li>Q&A</li>
		</ul>
	</div>
</div>

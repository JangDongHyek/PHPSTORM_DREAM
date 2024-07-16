<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade long" id="cateModal03" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">Filter</h4>
                </div>
                <div class="modal-body">
					<ul class="list">
						<li>
							<a href="javascript:void(0);">
								<span>For Sale Type</span>
								<em class="em_pr_type">All</em><!-- 선택한 카테고리 표시-->
							</a>
							<ul id="sort_list" class="cate_list m_pr_type">
								<?php
								if(strpos($_SERVER['PHP_SELF'], 'product_write.php') !== false) {}
								else {
								?>
								<li class="active">All</li>
								<?php } ?>
                                <li>Ship</li>
                                <li>Machinery</li>
                                <li>Parts/Articles</li>
							</ul>
						</li>
						<li class="m_pr_category m_pr_cate1" style="display: none;">
							<a href="javascript:void(0);">
								<span>Category</span>
								<em class="em_pr_category">All</em><!-- 선택한 카테고리 표시-->
							</a>
							<ul id="sort_list" class="cate_list">
								<?php
								if(strpos($_SERVER['PHP_SELF'], 'product_write.php') !== false) {}
								else {
								?>
								<li class="active">All</li>
								<?php } ?>
                                <li>Bulk Carriers</li>
                                <li>Oil/Gas Carriers</li>
                                <li>Tugs/Barges</li>
                                <li>FD/FC/Work Vessels</li>
                                <li>Special/Offshore</li>
                                <li>Passenger Ships</li>
                                <li>Fishing Vessels</li>
                                <li>Yachat/Boat</li>
							</ul>
						</li>
                        <li class="m_pr_category m_pr_cate2" style="display: none;">
                            <a href="javascript:void(0);">
                                <span>Category</span>
                                <em class="em_pr_category">All</em><!-- 선택한 카테고리 표시-->
                            </a>
                            <ul id="sort_list" class="cate_list">
                                <?php
                                if(strpos($_SERVER['PHP_SELF'], 'product_write.php') !== false) {}
                                else {
                                ?>
                                <li class="active">All</li>
                            <?php } ?>
                                <li>Engine</li>
                                <li>Generator</li>
                                <li>Crane</li>
                                <li>Heavy equipment</li>
                                <li>Transpoter</li>
                                <li>Machines</li>
                                <li>Tools</li>
                                <li>Others</li>
                            </ul>
                        </li>
                        <li class="m_pr_category m_pr_cate3" style="display: none;">
                            <a href="javascript:void(0);">
                                <span>Category</span>
                                <em class="em_pr_category">All</em><!-- 선택한 카테고리 표시-->
                            </a>
                            <ul id="sort_list" class="cate_list">
                                <?php
                                if(strpos($_SERVER['PHP_SELF'], 'product_write.php') !== false) {}
                                else {
                                ?>
                                <li class="active">All</li>
                                <?php } ?>
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
                        </li>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->

<script>
	$(function(){
		var gnbArea = $(".list > li");
		var gnbLink =  gnbArea.children("a");
		$('#cateModal03 .list li').off('mouseenter mouseleave');
		$('#cateModal03 .list li').each(function(){
			var gnbLink = $(this).children('a');
			if($(this).children('ul').length > 0){
				gnbLink.on('click',function(e){
					e.preventDefault();
					$('#cateModal03 .list li a').removeClass('active');
					gnbArea.children('ul').stop().slideUp();
					$(this).addClass('active');
					$(this).siblings('a').addClass('active');
					$(this).parent().children('ul').stop().slideDown();
					return false;
				});
			}
		});
	});
</script>
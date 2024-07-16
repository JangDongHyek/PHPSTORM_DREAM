<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="cateModal02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">필터</h4>
                </div>
                <div class="modal-body">
					<ul class="list">
						<li>
							<a href="javascript:void(0);">
								<span>RFQ Type</span>
								<em class="em_ci_type">All</em><!-- 선택한 카테고리 표시-->
							</a>
							<ul id="sort_list" class="cate_list m_ci_type">
								<?php
								if(strpos($_SERVER['PHP_SELF'], 'company_write.php') !== false) {}
								else {
								?>
								<li class="active">All</li>
								<?php } ?>
                                <li>Service</li>
                                <li>Parts</li>
                                <li>Ship supplies</li>
                                <li>Others</li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0);">
								<span>Category</span>
								<em class="em_ci_category">All</em><!-- 선택한 카테고리 표시-->
							</a>
							<ul id="sort_list" class="cate_list m_ci_category">
								<?php
								if(strpos($_SERVER['PHP_SELF'], 'company_write.php') !== false) {}
								else {
								?>
								<li class="active">All</li>
								<?php } ?>
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
		$('#cateModal02 .list li').off('mouseenter mouseleave');
		$('#cateModal02 .list li').each(function(){
			var gnbLink = $(this).children('a');
			if($(this).children('ul').length > 0){
				gnbLink.on('click',function(e){
					e.preventDefault();
					$('#cateModal02 .list li a').removeClass('active');
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
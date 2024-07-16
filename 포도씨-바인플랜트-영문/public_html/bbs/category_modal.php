<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="cateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="cate_list">
                        <?php
                        if(strpos($_SERVER['PHP_SELF'], 'help_write.php') !== false) {}
                        else {
                        ?>
						<li class="active">All</li>
                        <?php } ?>
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
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->
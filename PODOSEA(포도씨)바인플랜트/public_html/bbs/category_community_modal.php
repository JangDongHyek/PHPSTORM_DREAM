<!-- 카테고리 모달팝업 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade" id="cateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
					<ul id="sort_list" class="cate_list">
                        <?php
                        if(strpos($_SERVER['PHP_SELF'], 'community_write.php') !== false) {}
                        else {
                        ?>
						<li class="active">전체</li>
                        <?php } ?>
						<li>꿀팁</li>
						<li>일상 이런저런</li>
						<li>회사/현장 이야기</li>
						<li>해양뉴스</li>
                        <li>긴급구인</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->
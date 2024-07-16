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
						<li class="active">전체</li>
                        <?php } ?>
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
        </div>
    </div>
</div><!--basic_modal-->
<!-- 카테고리 모달팝업 -->
<div class="lnb">
	<ul>
		<? $boardUrl = PROJECT_URL . '/board'; ?>
		<li><a href="<?=$boardUrl?>" <?if($category=='notice'){?>class="active"<?}?>>공지사항</a></li>
		<li><a href="<?=$boardUrl?>?cate=qna" <?if($category=='qna'){?>class="active"<?}?>>고객문의 게시판</a></li>
		<li><a href="<?=$boardUrl?>?cate=faq" <?if($category=='faq'){?>class="active"<?}?>>FAQ 자주 묻는 질문</a></li>
        <li><a href="<?=$boardUrl?>?cate=group_order" <?if($category=='group_order'){?>class="active"<?}?>>단체주문문의 게시판</a></li>
	</ul>
</div>

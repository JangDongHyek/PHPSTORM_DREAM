<div class="lnb">
	<ul>
		<? $boardUrl = PROJECT_URL . '/board'; ?>
		<li><a href="<?=$boardUrl?>" <?if($category=='notice'){?>class="active"<?}?>>공지사항</a></li>
		<li><a href="<?=$boardUrl?>?cate=review" <?if($category=='review'){?>class="active"<?}?>>구매후기</a></li>
	</ul>
</div>

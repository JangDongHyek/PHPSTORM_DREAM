<div id="board">
    <div class="area_top">
        <? include_once VIEWPATH . '_common/navigator.php'; // 상단메뉴 ?>
		<? include_once VIEWPATH . '_common/lnb_cs.php'; // 고객센터 LNB ?>
    </div>

	<?
	// 관리자여부?
	$isAdminAccount = isAdminCheck($member['mb_level']);
	if ($category == 'qna' || $category == 'group_order' || ($isAdminAccount && $category != 'qna' && $category != 'group_order')) { // 작성권한
	?>
    <div class="btn_wrap">
        <a class="btn btn_small btn_green" href="<?=PROJECT_URL?>/boardForm?cate=<?=$category?>">등록</a>
    </div>
	<? } ?>

    <div class="board_list">
        <p>총 <strong class="txt_green"><?=number_format($paging['totalCount'])?></strong>개 </p>
        <ul>
			<?php
			foreach($listData as $list) {
				// 상세보기 링크
				$defaultLink = PROJECT_URL . "/board/{$list['idx']}?cate={$category}";
				$alertLink = "javascript:showAlert('본인이 작성한 글만 열람이 가능합니다.')";
				$allowedToView = $isAdminAccount || $list['mb_id'] == $member['mb_id']; // 관리자 & 본인글 여부
				$viewLink = ($list['secret_yn'] == 'Y' && !$allowedToView)? $alertLink : $defaultLink; // 비밀글 체크

				// 새글여부 (24시간 이전)
				$hoursPassed = getPassedHours($list['reg_date']);
			?>
            <li>
                <p class="p_num"><?=$paging['listNo']?></p>
				<p class="p_title">
					<?if ($list['secret_yn'] == 'Y') {?><i class="fa-solid fa-lock-keyhole"></i><?}?>
					<a href="<?=$viewLink?>"><?=$list['title']?></a>
					<?if ($hoursPassed < 24){?><span class="new">N</span><?}?>

					<?if($list['commentCnt'] > 0) { ?><span class="icon">답변완료</span><?}?>
				</p>
                <p class="p_user"><?=$list['mb_name']?></p>
                <p class="p_date"><?=replaceDateFormat($list['reg_date'])?></p>
            </li>
			<?php
				$paging['listNo']--;
			}
			if ($paging['totalCount'] == 0) {
			?>
			<li>등록된 게시글이 없습니다.</li>
			<?php } ?>
        </ul>

        <? include_once VIEWPATH. 'component/pagination.php'; // 페이징?>

    </div>
</div>

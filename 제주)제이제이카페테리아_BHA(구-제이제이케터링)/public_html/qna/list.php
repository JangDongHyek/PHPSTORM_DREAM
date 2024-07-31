<?php
include_once('./_head.php');

$page = (int)$page>1? (int)$page : 1;

// 목록
$list = $db->getList($mid, $page);
$list_no = $list['cnt'] - ($db->list_rows * ($page - 1));		// 글번호(내림차순)

// 공지사항
$notice = $db->getList(1,1,'notice');

// 상태 클래스
$status_cls = array("접수완료"=>"btn01", "처리완료"=>"btn02", "담당자연락"=>"btn03");
?>

<div class="inr">

<h1>문의하기</h1>


<div class="list_tbl">
	<span class="total">총 <?=number_format($list['cnt'])?>건</span>
	<button type="button" class="btn btn_01" onclick="location.href='./write.php'">문의등록</button>
	<dl>
		<dt>
			<div class="col10">No.</div>
			<div class="col60">제목</div>
			<div class="col15">처리상태</div>
			<div class="col15">등록일</div>
		</dt>

		<!-- 공지사항 -->
		<? foreach ($notice['list'] AS $key=>$val) { ?>
		<dd class="notice">
			<div class="num col10">공지</div>
			<div class="title col60"><a href="./view.php?idx=<?=$val['idx']?>&noti=y"><?=$val['qa_subject']?></a></div>
			<div class="state col15"></div>
			<div class="data col15"><?=substr($val['qa_regdate'], 0, 10)?></div>
		</dd>
		<? } ?>

		<!-- 글목록 -->
		<?php if (count($list['list']) == 0) { ?>
		<dd><div>등록된 게시물이 없습니다.</div></dd>
		<?php
		} else {
			foreach ($list['list'] AS $key=>$val) { 
				$is_file = (empty($val['qa_files_json']))? false : true;
		?>
		<dd>
			<div class="num col10"><?=$list_no?></div>
			<div class="title col60">
				<a href="./view.php?idx=<?=$val['idx']?>"><?=$val['qa_subject']?> <? if ($is_file) {?><img src="./img/icon_file.gif"><?}?></a>
			</div>
			<div class="state col15 <?=$status_cls[$val['qa_status']]?>"><span><?=$val['qa_status']?></span></div>
			<div class="data col15"><?=substr($val['qa_regdate'], 0, 10)?></div>
		</dd>
		<? $list_no--; }} ?>
	</dl>

	<!-- 페이징 -->
	<nav class="pg_wrap">
		<span class="pg">
			<?php
			$list_rows = $db->list_rows;					// 한페이지 개수
			$list_page_rows = $db->list_page_rows;			// 한블럭 페이지 개수
			$total_count = (int)$list['cnt'];

			$page_num = ceil($total_count / $list_rows);	// 총페이지
			$block_num = ceil($page_num / $list_page_rows);	// 총블럭
			$now_block = ceil($page / $list_page_rows);

			$s_page = ($now_block * $list_page_rows) - ($list_page_rows - 1);	// 시작블록
			if ($s_page <= 1) $s_page = 1;
			$e_page = ($now_block * $list_page_rows);
			if ($page_num <= $e_page) $e_page = $page_num;						// 끝블록
			?>
			<? if ($now_block > 1) { ?>
			<a href="?page=1" class="pg_page pg_start">처음</a>
			<? } ?>
			<? 
			for ($p=$s_page; $p<=$e_page; $p++) { 
				if ($page != $p) echo '<a href="?page='.$p.'" class="pg_page">'.$p.'</a>';
				else echo '<span class="sound_only"></span><strong class="pg_current">'.$p.'</strong>';
			} 
			?>
			<? if ($block_num > 1 && $block_num != $now_block) { ?>
			<a href="?page=<?=$e_page+1?>" class="pg_page pg_end">맨끝</a>
			<? } ?>
		</span>
	</nav>
</div>



<!-- 광고영역 -->
<iframe src="http://letsit.kr/~itforone_test2/qna/ad_list.php?iframe=y" class="adFrame" scrolling="no" onload="resizeIframe(this)"></iframe>

</div>
<?php
include_once('./_tail.php');
?>
<?php
include_once('./_head.php');

if (!empty($idx)) {
	// 문의내용
	if ($noti == "y") {	// 공지
		$row = $db->getDbRows('notice', $mid, $idx);
	} else {			// 문의글
		$row = $db->getDbRows('view', $mid, $idx);
	}
	
	if (!$row) alert("잘못된 정보입니다.");

	$file_de = json_decode($row['qa_files_json'], true);

	// 답변
	$reply = $db->getDbArray('reply', $idx);
}
?>
<div class="inr">
<h1>문의상세</h1>

<div class="view_tbl">
	<? if ($row['is_notice'] == "Y") { // 1) 공지사항 ?>
	<!-- 공지사항 -->
	<ul>
		<li>
			<em>제목</em>
			<span><?=get_text($row['qa_subject'])?></span>
		</li>
		<li>
			<em>등록일</em>
			<span><?=$row['qa_regdate']?></span>
		</li>
		<li class="notice_cont">
			<div><?=nl2br($row['qa_content'])?></div>
		</li>
		<? if (!empty($file_de) && count($file_de) > 0) { ?>
		<li class="file2">
			<em>첨부파일</em>
			<span>
				<? foreach ($file_de AS $key=>$val) { ?>
				<input type="hidden" name="files[]" value="<?=$val['file']?>">
				<div><a href="<?=$val['src']?>" target="_blank"><?=$key+1?>. <?=$val['name']?></a></div>
				<? } ?>
			</span>
		</li>
		<? } ?>
	</ul>

	<? } else { 						// 2) 일반문의글 ?>
	<!-- 문의내용 -->
	<ul>
		<li>
			<em>제목</em>
			<span><?=get_text($row['qa_subject'])?></span>
		</li>
		<li class="half">
			<em>처리상태</em>
			<span><?=$row['qa_status']?></span>
		</li>
		<li class="half">
			<em>등록일</em>
			<span><?=$row['qa_regdate']?></span>
		</li>
		<li class="half">
			<em>담당자명</em>
			<span><?=$row['qa_name']?></span>
		</li>
		<li class="half">
			<em>연락처</em>
			<span><?=$row['qa_tel']?></span>
		</li>		
	</ul>

	<div class="file">
	<h3>첨부파일</h3>
		<ul>
			<li>
				<span>
					<? if (empty($file_de)) { ?>
					<div class="empty">등록된 파일이 없습니다.</div>
					<? } else { ?>
					<? foreach ($file_de AS $key=>$val) { ?>
					<input type="hidden" name="files[]" value="<?=$val['file']?>">
					<div><a href="<?=$val['src']?>" target="_blank"><?=$key+1?>. <?=$val['name']?></a></div>
					<? }} ?>
				</span>
			</li>
		</ul>
	</div>
		<div class="cont">
			<h3>문의내용</h3>
			<div><?=nl2br($row['qa_content'])?></div>
		</div>

	<!-- 답변 -->
	<dl class="reply_area">
		<dt>답변</dt>
		<dd>
			<? if (count($reply) == 0) { ?>
			<div class="empty">등록된 답변이 없습니다.</div>
			<?
			} else {
				foreach ($reply As $key=>$val) {
			?>
			<div class="box">
				<span><?=$val['regdate']?></span><!-- 등록시간 -->
				<p><?=nl2br($val['reply'])?></p><!-- 내용 -->
			</div>
			<? }} ?>
		</dd>
	</dl>
	<? } ?>

	<div class="btn_confirm">
		<? if ($row['is_notice'] == "N" && $row['qa_status'] == "접수완료") { ?>
		<ul class="area_btn">
			<li><button type="button" class="btn_submit" onclick="location.href='./write.php?idx=<?=$idx?>'">수정</button></li>
			<li><button type="button" class="btn_list delete" onclick="deleteQst(<?=$idx?>)">삭제</button></li>
		</ul>
		<?}?>
		<button type="button" class="btn_list" onclick="history.back();">목록</button>
	</div>

</div>


<!-- 광고영역 -->
<iframe src="http://letsit.kr/~itforone_test2/qna/ad_view.php?iframe=y" class="adFrame" scrolling="no" onload="resizeIframe(this)"></iframe>
</div>
<?php
include_once('./_tail.php');
?>
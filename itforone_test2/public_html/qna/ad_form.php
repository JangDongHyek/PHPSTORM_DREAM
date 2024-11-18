<?php
$tab_hide = true;
include_once("../common.php");
include_once("./_head.php");

// 광고 업데이트
if (!empty($_POST['ad_page'])) {
	sql_query("DELETE FROM project_qna_ad WHERE ad_page = '{$ad_page}'");
	sql_query("INSERT INTO project_qna_ad SET ad_html = '{$_POST['ad_html']}', ad_page = '{$ad_page}', ad_datets = '".time()."'");

	die("<script>adPopClose();</script>");
}

$row = sql_fetch("SELECT * FROM project_qna_ad WHERE ad_page = '{$ad_page}' ORDER BY ad_datets DESC LIMIT 0, 1");

?>
<div class="reply_area">
	<p>- 광고영역에 보여질 html을 등록하세요. <br>- 링크 추가시 "target=_blnak" 속성을 입력해야 합니다.</p>

	<form name="afrm" onsubmit="return adFrmSubmit(this);" action="?ad_page=<?=$ad_page?>" method="post">
		<input type="hidden" name="ad_page" value="<?=$ad_page?>">
		<textarea name="ad_html"><?=$row['ad_html']?></textarea>
		<button type="submit">광고등록</button>
	</form>
</div>

<?php
include_once("./_tail.php");
?>
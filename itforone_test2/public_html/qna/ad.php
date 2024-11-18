<?php 
include_once("./_head.php");
?>
<h1>광고관리</h1>

<div id="ad_list">
	<dl>
		<dt>목록 하단</dt>
		<dd>
			<button type="button" onclick="adRegiter('list')">등록</button>
			<div class="box2"><iframe src="./ad_list.php" id="listFrame" class="adFrame" scrolling="no" onload="resizeIframe(this)"></iframe></div>
		</dd>
	</dl>
	<dl>
		<dt>상세 하단</dt>
		<dd>
			<button type="button" onclick="adRegiter('view')">등록</button>
			<div class="box2"><iframe src="./ad_view.php" id="listFrame" class="adFrame" scrolling="no" onload="resizeIframe(this)"></iframe></div>
		</dd>
	</dl>
	<dl>
		<dt>글쓰기 하단</dt>
		<dd>
			<button type="button" onclick="adRegiter('write')">등록</button>
			<div class="box2"><iframe src="./ad_write.php" id="listFrame" class="adFrame" scrolling="no" onload="resizeIframe(this)"></iframe></div>
		</dd>
	</dl>
</div>

<script>
var ad_popup = "";
</script>

<?php
include_once("./_tail.php");
?>
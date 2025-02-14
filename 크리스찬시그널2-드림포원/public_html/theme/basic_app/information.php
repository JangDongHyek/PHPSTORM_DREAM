<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/information.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
?>

<div id="main_up_info">
	<p class="lo"><img src="" alt="크리스찬시그널"></p>
	<p class="tit"><span>업그레이드</span>중입니다.</p>
	<div class="txtBox">
		<p>현재 크리스찬시그널의 사이트를<br>업그레이드 하고있습니다.<br>더나은 모습으로 업그레이드 후 만나 뵙겠습니다. <br>감사합니다.</p>
	</div>
</div>


<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
?>
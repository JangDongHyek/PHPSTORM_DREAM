<?php
// 목록 하단광고
$tab_hide = true;
include_once("./_head.php");

$row = sql_fetch("SELECT ad_html FROM project_qna_ad WHERE ad_page = 'list'");

?>
<script type="text/javascript" src="./js/iframeResizer.contentWindow.min.js"></script><!-- iframe resizer -->
<style>
.inr {margin: 0;}
</style>

<div class="adlist"><?=$row['ad_html']?></div>

<?php
include_once("./_tail.php");
?>
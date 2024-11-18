<?php
include_once("../common.php");
include_once("../head.sub.php");
include_once("./db.php");
$g5['title'] = "CS관리";

if (empty($_GET['iframe'])) {
	if (!$is_member) goto_url(G5_BBS_URL . "/login.php?url=".urlencode('http://letsit.kr/~itforone_test2/qna/list.php'));
}

// 매니저업체명호출
$mid_list = $manager = array();
$result = sql_query("SELECT mid FROM project_qna GROUP BY mid HAVING mid > 0 ORDER BY mid ASC");
$result_cnt = sql_num_rows($result);
if ($result_cnt > 0) {
	while($row = sql_fetch_array($result)) {
		$mid_list[] = $row['mid'];
	}
	$mdb = new ManagerDB();
	$manager = $mdb->getInfo($mid_list);


}

// 답변상태
$qa_status_list = array("접수완료", "처리중", "처리완료", "담당자연락");
// 작업자 프로그래머, 디자이너
$programmer_list = array("제이","케이", "박완열", "조우철","장동혁", "직접입력");
$designer_list = array("젠", "본", "직접입력");

// echo floatval(phpversion());
// echo floatval(phpversion()) < 5.3;

$cur_page = basename($_SERVER["PHP_SELF"]);

?>
<link href="./css/style.css?v=<?=date('his')?>" rel="stylesheet" type="text/css">
<script src="<?=G5_JS_URL?>/jquery-1.12.4.min.js"></script>
<script src="./js/qna.js"></script>
<script src="./js/all.min.js"></script>
<style>
.el_hide {position: absolute; width: 0; height: 0; top: -9999px;}
.inr > h1 {font-weight: 700;}
input+.file_area {margin-top: -10px; margin-bottom: 15px;}
.file_area input, .file_area label {margin: 0 !important;}
</style>

<div id="qna_wrap">
	<div class="inr">

	<? if (empty($tab_hide)) { ?>
		<!-- 상단탭 -->
		<ul class="tabs">
			<li <?php if($cur_page=="list.php" || $cur_page=="view.php" || $cur_page=="write.php") {?>class="active"<?php }?>><a href="./list.php">수정접수내역</a></li>
            <li <?php if($pid=="bs") {?>class="active"<?php }?>><a href="./bs_list.php">수정접수(부산)</a></li>
			<li <?php if($cur_page=="ad.php") {?>class="active"<?php }?>><a href="./ad.php">광고관리</a></li>
			<li <?php if($cur_page=="store_list.php"  || $cur_page=="store_read.php" || $cur_page=="store_write.php") {?>class="active"<?php }?>><a href="./store_list.php">스토어 등록현황</a></li>
		</ul>
	<? } ?>

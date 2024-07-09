<?php
// 공통 레이아웃
if ($isAdminPage) {
	$headerFile = VIEWPATH . "_common/header.adm.php"; // 관리자 헤더
	$footerFile = VIEWPATH . "_common/footer.adm.php"; // 관리자 푸터
} else {
	$headerFile = VIEWPATH . "_common/header.php"; // 헤더
	$footerFile = VIEWPATH . "_common/footer.php"; // 푸터
}

include_once $headerFile; // 헤더
echo $content; // 뷰
include_once $footerFile; // 푸터

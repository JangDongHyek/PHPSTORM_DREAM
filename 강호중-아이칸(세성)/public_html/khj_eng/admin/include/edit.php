<?
$url = "$home_dir"; //도메인 주소
$edit_url = "/admin/cab/"; //GsWebEdit.cab 화일이 있는 경로
$style_url = "$home_dir/admin/cab/"; //style.css 화일이 있는 경로
$upload_php = "/admin/cab/gsupload.php"; //gsupload.php 파일이 있는 경로
$upload = "$home_dir/up/"; //파일 업로드 경로
$homeup_url = "$root_dir/up/"; // 업로드 디렉토리의 절대경로

$urlx = str_replace("http://", "", $url); // http:// 를 제외한 도메인 주소
$urlx = str_replace("/", "", $urlx);
$port="80";
?>
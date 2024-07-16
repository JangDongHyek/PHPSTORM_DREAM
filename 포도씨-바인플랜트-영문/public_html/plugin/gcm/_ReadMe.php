<?
include "./_common.php";

$post_no = "1";									// 숫자		-	필수			:	동일해도 상관없으나 게시판별로 수신여부 설정하고싶으면 게시판별로 다르게하면 좋다.
$post_title = "제목";							// 문자		-	필수			:	제목
$post_content = "내용";							// 문자		-	필수			:	내용

$post_url = "http://www.naver.com";				// 문자		-					:	상단알림을 클릭시 앱이 실행하면서 이동할 주소 보통 해당글로 이동

//$post_user = "lets080";							// 문자		-					:	아이디 입력시 해당 아이디에게 보냄 (빈값일경우 모든회원에게 보냄)
// $post_user = array("lets080", "admin");		// 배열문자	-					:	배열에 아이디 담아서 보낼수있음

$post_save = "true";							// 불		-	TRUE(기본값)	:	보낸내용을 DB (`gcm_write_msg`) 에 저장한다.
// $post_save = "false";						// 불		-					:	보낸내용을 저장 안 한다.

include(G5_PLUGIN_PATH."/gcm/send_msg.php");
?>


<?

/*

<?
include "./_common.php";

$post_no = "1";									
$post_title = "제목";							
$post_content = "내용";							
$post_url = $post_url = G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$wr_id;				
$post_user = "lets080";							
$post_save = "false";						
include(G5_PLUGIN_PATH."/gcm/send.php");

?>


*/

?>
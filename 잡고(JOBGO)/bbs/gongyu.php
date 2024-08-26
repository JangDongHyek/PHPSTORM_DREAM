<?php
$sub_id = "item_view";
include_once('./_common.php');

$g5['title'] = '테스트';
include_once('./_head.php');
?>

               <a href="javascript:;" onclick="goShare()">공유하기</a>
				<script type="text/javascript">
					function goShare(){

						webkit.messageHandlers.scriptHandler.postMessage("잡고\n앱공유하기:('http://www.jobgo.ac')");
					}
				</script>

<?
include_once('./_tail.php');
?>
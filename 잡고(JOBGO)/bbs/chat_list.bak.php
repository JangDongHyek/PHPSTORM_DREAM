<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');

$sql="select * from chat_room_user where user_id='$member[mb_id]' order by msgdate desc";
$result=sql_query($sql);
?>

<!--<a href="<?/*=G5_BBS_URL*/?>/chat_user.php" class="btn btn-success">친구목록</a>-->
<link rel="stylesheet" href="<?=G5_CSS_URL?>/chat.css?version=1"/>

<script src = "<?=G5_JS_URL?>/socket.io.js"> </script>
<script src = "<?=G5_JS_URL?>/chat.js"></script>
<div id="chat-lists">

</div>
<script type="text/javascript">
	chatLogin('<?=$member['mb_id']?>');
	chatList('<?=$member['mb_id']?>');
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
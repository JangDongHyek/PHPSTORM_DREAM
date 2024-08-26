<?php
include_once('./_common.php');
include_once(G5_PATH.'/head.php');
$sql="select * from g5_member where mb_id!='$member[mb_id]' and mb_id like '%test%' and mb_level!='10'";
$result=sql_query($sql);
?>
<!--<a href="<?=G5_BBS_URL?>/chat_list.php" class="btn btn-success">채팅목록</a>-->
<script  src = "<?=G5_JS_URL?>/socket.io.js"> </script>
<script  src = "<?=G5_JS_URL?>/chat.js"> </script>
<table class="table">
	<thead>
	<tr>
		<th>번호</th>
		<th>이름</th>
		<th>초대하기</th>
	</tr>
	</thead>
	<tbody>
	<?php
		$i=1;
		while($row=sql_fetch_array($result)){
	?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row[mb_name]?> / <?=$row[mb_id]?></td>
		<td><a href="javascript:;" onclick="invite('<?=$member[mb_id]?>','<?=$member[mb_name]?>','<?=$row[mb_id]?>','<?=$row[mb_name]?>')">초대하기</a></td>
	</tr>
	<? $i++;}?>
	</tbody>
</table>
<script type="text/javascript">
	chatLogin('<?=$member[mb_id]?>');
</script>
<?php
include_once(G5_PATH.'/tail.php');
?>

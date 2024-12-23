<?php
include_once('./_common.php');
$sql="select * from g5_product_latest order by idx desc limit 0,5";
$result=sql_query($sql);
?>
<ul>
<?
while($row=sql_fetch_array($result)){		
?>
<li style="font-size:15px;line-height:25px; list-style-type:disc;margin-left:10px;">
<a href="<?=G5_BBS_URL?>/board.php?bo_table=<?=$row[bo_table]?>&wr_id=<?=$row[wr_id]?>"><b><?=$row[wr_subject]?></b></a>
</li>
<? }?>
</ul>
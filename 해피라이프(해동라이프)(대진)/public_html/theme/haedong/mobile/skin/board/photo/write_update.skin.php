<?php
$url = G5_ADMIN_URL."/bbs/board.php?bo_table=".$bo_table;
if ($qstr != "") $url .= "&".$qstr;

goto_url($url);
?>
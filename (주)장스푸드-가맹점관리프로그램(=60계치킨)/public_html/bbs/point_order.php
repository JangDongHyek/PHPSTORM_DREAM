<?php
include_once('./_common.php');

$g5['title'] = '주문하기';
include_once('./_head.php');

require_once(G5_BBS_PATH.'/libs/INIStdPayUtil.php');
require_once(G5_BBS_PATH.'/libs/sha256.inc.php');

include_once($member_skin_path.'/point_order.skin.php');

include_once('./_tail.php');
?>

<?php
include_once('./_common.php');

/*
- 왼쪽메뉴 ON, OFF
/theme/basic/shop/shop.head.php
*/

$_SESSION['leftMenu'] = $display;

echo $_SESSION['leftMenu'];
?>
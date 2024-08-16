<?php
$pid = "benepia";
//include_once(G5_PATH.'/head.sub.php');
//include_once(G5_LIB_PATH.'/latest.lib.php');
//include_once(G5_LIB_PATH.'/outlogin.lib.php');
//include_once(G5_LIB_PATH.'/poll.lib.php');
//include_once(G5_LIB_PATH.'/visit.lib.php');
//include_once(G5_LIB_PATH.'/connect.lib.php');
//include_once(G5_LIB_PATH.'/popular.lib.php');

include_once('./_common.php');
//include_once(G5_SHOP_PATH.'/shop.head.php');

//include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');

?>


<!--/theme/mobile/shop/benepia 연결-->
<?php
$type = "베네피아";
include_once(G5_THEME_MSHOP_PATH.'/bene.php');
?>

<?php
//include_once(G5_THEME_PATH."/tail.sub.php");
//include_once(G5_SHOP_PATH.'/shop.tail.php');
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
//include_once(G5_PATH.'/tail.sub.php');
?>
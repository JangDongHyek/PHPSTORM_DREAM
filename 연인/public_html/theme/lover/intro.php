<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/intro.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_container">


</div><!-- #idx_container -->

<?php
include_once(G5_PATH.'/tail.php');
?>
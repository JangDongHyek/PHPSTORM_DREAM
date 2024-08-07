<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($is_member) {
    goto_url(G5_URL."/app");
} else {
    goto_url(G5_BBS_URL."/login.php");
}

include_once(G5_THEME_PATH.'/head.php');
?>



<?php
include_once(G5_PATH.'/tail.sub.php');
?>

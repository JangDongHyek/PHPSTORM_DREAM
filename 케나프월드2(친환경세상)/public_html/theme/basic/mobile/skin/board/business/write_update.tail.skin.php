<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

delete_cache_latest($bo_table);

if(!$is_adm)
	goto_url(G5_BBS_URL."/category.php?bo_table=business&sca=".$ca_id);
?>
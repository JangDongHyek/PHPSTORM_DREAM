<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>

<div id="location">
HOME<i class="fa-light fa-chevron-right"></i><?php echo $title['sm_name'] ?><i class="fa-light fa-chevron-right"></i><strong><?php if($bo_table) {?><?php echo $board['bo_subject']; ?><?php }else { ?><?php echo $g5['title'] ?><?php } ?></strong>
</div>
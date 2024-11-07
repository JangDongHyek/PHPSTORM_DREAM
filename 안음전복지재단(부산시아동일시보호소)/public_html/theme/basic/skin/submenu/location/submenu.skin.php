<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>

<div id="location">
    <div id="loc">
    <i class="fad fa-h-square"></i> 처음으로&nbsp; <i class="far fa-chevron-right"></i> &nbsp;  
    <?php echo $title['sm_name'] ?> &nbsp; <i class="far fa-chevron-right"></i> &nbsp;  
     <strong>
     <?php if($bo_table) {?>
            <?php echo $board['bo_subject']; ?>
     <?php }else { ?>
            <?php echo $g5['title'] ?>
     <?php } ?>
     </strong>
    </div>
</div>
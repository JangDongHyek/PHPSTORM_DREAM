<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>



					   <option value="0"> 

 <?php if($bo_table) {?>
		<?php echo $board['bo_subject']; ?>
 <?php }else { ?>
        <?php echo $g5['title'] ?>
 <?php } ?>
</option>
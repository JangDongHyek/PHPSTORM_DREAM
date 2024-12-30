<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);

if($bo_table == "product"){
    $board['bo_subject'] = $sca;

}

?>

<div id="location">
    <ul>
        <li><?php echo $title['sm_name'] ?></li>
        <li>
         <?php if($bo_table) {?>
                <?php echo $board['bo_subject']; ?>
         <?php }else { ?>
                <?php echo $g5['title'] ?>
         <?php } ?>
        </li>
        <!--3차 있을때만-->
        <li><?php echo $swr2==""?"전체":$swr2?></li>
        <!--//3차 있을때만-->
    </ul>
</div>
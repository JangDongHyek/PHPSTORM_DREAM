<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);
?>

<div id="location">
홈  &nbsp; > &nbsp;  
<?php echo $sm['me_name'] ?> &nbsp; > &nbsp;  
 <strong>
 <?php if($bo_table) {?>
		<?php echo $board['bo_subject']; ?>
 <?php }else { ?>
        <?php echo $g5['title'] ?>
 <?php } ?>
 </strong>
</div>
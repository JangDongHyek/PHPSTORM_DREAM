<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section style="/*display:table-cell;*/text-align:center;">
<!--서브메뉴 100%-->
  <div id="depth_menu" class="wow fadeInUp hidden-xs hidden-sm" data-wow-delay="1.5">
       <dl>
       <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
         <dd><a href="<?php echo G5_URL.$sub['sm_link']?>"<?php if($sm_tid == $sub['sm_tid']){ echo "class='current'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
       <?php } ?>  
       </dl>
  </div>
</section>
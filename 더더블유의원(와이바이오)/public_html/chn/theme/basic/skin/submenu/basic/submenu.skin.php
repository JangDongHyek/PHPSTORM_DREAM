<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section class="submenu">
<div id="left">
		<dl>
        	<div class="dt_bar"></div>
			<dt><p><?php echo $config['cf_title']; ?></p><?php echo $title['sm_name'] ?></dt>
            <div class="dd">
                <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
            <dd><a href="<?php echo 0<strpos($sub['sm_link'],"ttp")?"":G5_URL;?><?php echo $sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?> target="<?php echo 0<strpos($sub['sm_link'],"ttp")?"_blank":"";?>"><?php echo $sub['sm_name'];?></a></dd>
        	<?php } ?>
            </div>
		</dl>
</div><!--#left-->  
</section>




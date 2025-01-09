<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<!--서브 왼쪽메뉴 및 고객센터-->

<!--Product 페이지 왼쪽메뉴-->
<? if($sm_tid == "pro01" || $sm_tid == "pro02" || $sm_tid == "pro03"){ ?>


<div id="left2" class="hidden-sm">
	<div>
		<dl>
			<dt><?php echo $title['sm_name'] ?></dt>
			<?php 
			for($i=0; $i<$sub=sql_fetch_array($result); $i++){ 
				if($sub['sm_course'])
						$sub['href'] = G5_URL.$sub['sm_link'];
					else 
						$sub['href'] = $sub['sm_link']
			?>
			 <dd><a href="<?php echo G5_URL.$sub['sm_link']?>"<?php if($sm_tid == $sub['sm_tid']){ echo "class='current'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
		</dl>
	</div>
    
    <div class="left_call">
    	<h3>Customer Center</h3>
        <ul>
        	<li>T. +82-2-866-3514</li>
        	<li>F. +82-2-6919-1346</li>
        </ul>
    </div><!--.left_call-->
    
 </div> <!--#left2-->
 
  
<? } else { ?>
<div id="left" class="hidden-sm">
	<div>
		<dl>
			<dt><?php echo $title['sm_name'] ?></dt>
			<?php 
			for($i=0; $i<$sub=sql_fetch_array($result); $i++){ 
				if($sub['sm_course'])
						$sub['href'] = G5_URL.$sub['sm_link'];
					else 
						$sub['href'] = $sub['sm_link']
			?>
			 <dd><a href="<?php echo G5_URL.$sub['sm_link']?>"<?php if($sm_tid == $sub['sm_tid']){ echo "class='current'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
		</dl>
	</div>
    
    <div class="left_call">
    	<h3>Customer Center</h3>
        <ul>
        	<li>T. +82-2-866-3514</li>
        	<li>F. +82-2-6919-1346</li>
        </ul>
    </div><!--.left_call-->
    
 </div> <!--#left-->  
<? } ?> 
</section>

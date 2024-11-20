<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<!--서브메뉴 100%-->
<div id="left">
	<div>
		<dl>
			<dt style="background:url(<?php echo G5_THEME_IMG_URL;?>/sub_menu_title_bg.gif) no-repeat center top; "><?php echo $title['sm_name'] ?></dt>
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<dd <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?> style="background:url(<?php echo G5_THEME_IMG_URL;?>/sub_menu_dot.gif) no-repeat 170px center;">
				<a href="<?php echo $sub['sm_link']?>"><?php echo $sub['sm_name'];?></a>
			</dd>
			<?php } ?>
		</dl>
	</div>
</div><!--#left-->  

</section>

<section>
  <div id="cate_menu">
       <ul>
         <li><a href="<?php echo $sub['sm_link']?>" <?if($bo_table == "g_port_apt03"){?>class="current"<?}?>><?php echo $sub['sm_name'];?></a></li>
       </ul>
  </div>
</section>
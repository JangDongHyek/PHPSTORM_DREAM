<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<!--서브 왼쪽메뉴 및 고객센터-->
<div id="lnb">
		<dl>
			<dt><?php echo $title['sm_name'] ?>
       		<p><?php echo $config['cf_title']; ?></p></dt>
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<dd><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
		</dl>
</div><!--#left-->  

</section>

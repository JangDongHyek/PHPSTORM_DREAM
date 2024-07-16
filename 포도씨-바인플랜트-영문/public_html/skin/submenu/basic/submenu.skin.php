<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section id="submenu">
<div class="submenu">
	<dt><?php echo $title['sm_name'] ?><p>gnuskin submenu</p></dt>
	<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
	<dd <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>>
		
		<a href="<?php echo $sub['sm_link']?>"  target="<?php echo $sub['sm_target']?>"><?php echo $sub['sm_name'];?></a>
	</dd>
	<?php } ?>
</div>
</section>


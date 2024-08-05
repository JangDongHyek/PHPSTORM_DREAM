<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>

<h2 class="elice"><?php echo $title['sm_name'] ?></h2>
<div class="subTopBox">
	<div class="sub_top_tab">
		<p><a href="#" class="btn_tit "><?php echo $g5['title'] ?></a></p>
		<ul>
			<?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<li <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><a href="<?php echo G5_URL.$sub['sm_link']?>"><?php echo $sub['sm_name'];?></a></li>
			<?php } ?>
		</ul>
	</div>



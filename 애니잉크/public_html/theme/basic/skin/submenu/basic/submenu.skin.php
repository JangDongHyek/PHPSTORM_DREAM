<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<!--서브 왼쪽메뉴 및 고객센터-->
<div id="left">
	<div>
		<dl>
			<dt style="background:url(<?php echo G5_THEME_IMG_URL;?>/sub_menu_title_bg.gif) no-repeat center top; "><?php echo $title['sm_name'] ?></dt>
			<?php 
			for($i=0; $i<$sub=sql_fetch_array($result); $i++){ 
				if($sub['sm_course'])
						$sub['href'] = G5_URL.$sub['sm_link'];
					else 
						$sub['href'] = $sub['sm_link']
			?>
			<dd <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?> style="background:url(<?php echo G5_THEME_IMG_URL;?>/sub_menu_dot.gif) no-repeat 170px center;">
				<a href="<?php echo $sub['href']?>" target="_<?php echo $sub['sm_target']?>"><?php echo $sub['sm_name'];?></a>
			</dd>
			<?php } ?>
		</dl>
	</div>
	<div class="left_call">
		고객센터<br />
		<span>친절한 상담과 답변을 약속드립니다.</span><br />
		<strong>051-203-8810</strong>
		<p>fax 051-203-8880<br />
		H.P 010-3558-9830</p>
	</div><!--.left_call-->
</div><!--#left-->  

</section>

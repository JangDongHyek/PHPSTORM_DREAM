<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<div id="left" class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.5s">
		<dl>
        	<div class="dt_bar"></div>
					<dt><?php echo $title['sm_name'] ?>
       		        <p>부산형 사회연대기금</p></dt>
            <div class="dd">
                <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
                <dd><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
            </div>
		</dl>
</div><!--#left-->  
</section>

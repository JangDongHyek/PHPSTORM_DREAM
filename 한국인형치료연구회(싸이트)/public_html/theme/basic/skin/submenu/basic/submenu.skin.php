<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>


<section>
<div id="left">
		<dl>
        	<div class="dt_bar"></div>
					<dt><h3><?php echo $title['sm_name'] ?></h3></dt>
            <div class="dd">
                <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){
							if($sub['sm_id']==913){
								continue;
							}
							if($sub['sm_course']==0){
                                $sub_move_link = $sub['sm_link'];
                            }else{
                                $sub_move_link = G5_URL.$sub['sm_link'];
                            }
?>
                <dd><a href="<?php echo $sub_move_link;?>" target="_<?=$sub['sm_target']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></dd>
			<?php } ?>
            </div>
		</dl>
</div><!--#left-->  
</section>

<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$imgwidth = 280; //표시할 이미지의 가로사이즈
$imgheight = 240; //표시할 이미지의 세로사이즈
?>

<div class="lt">
    <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong>
    <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div>
</div>
<div id="oneshot_2_7">
	<!--
	<div class="la_title">
		<?php echo $bo_subject ?>
	</div>
	-->
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li>



            <div style="position:relative">

  <div id="quick" style="position: absolute; z-index: 2; top: -5px; left: 5px; width: 50px; ">
    <?php
                if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
             ?>
  </div>

</div>



		<!--/////////////////이미지에 테두리/////////////-->
<div id="border">
			<div class="img_set">
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php                
					$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            
					if($thumb['src']) {
					$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" width="'.$imgwidth.'" height="'.$imgheight.'">';
					} else {
					$img_content = 'NO IMAGE';
					}                
					echo $img_content;												               
					?>
				</a>
                <div class="subject_set">
                    <div class="sub_title">			
                    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=case"><?php echo cut_str($list[$i]['subject'], 36, "..") ?></a>
                    </div>
    
                    <?php /*?><div class="dotted"></div>
                    <div class="sub_datetime"><?=$list[$i]['wr_name']?>
                    <font color="#CFCFCF">|</font>
                    <?=$list[$i]['datetime2']?></div><?php */?>
                </div>
			</div>
		

</div>
				
		</li>
	<?php } ?>
	</ul>
</div>
		<!--/////////////////이미지에 테두리/////////////-->
<div style="clear:both;"></div>

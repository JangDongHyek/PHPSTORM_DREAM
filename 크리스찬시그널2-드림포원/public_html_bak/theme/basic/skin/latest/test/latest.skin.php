<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$imgwidth = 275; //표시할 이미지의 가로사이즈
$imgheight = 300; //표시할 이미지의 세로사이즈
?>

<style>
#container {position:relative; margin:0 auto; padding:0 0; width:100%; background:#1b1b1b;}
#cont_ul {list-style:none; clear:both; margin:0; padding:0 0;}
#cont_ul li {list-style:none; float:left; margin:0; padding:0 0; text-decoration:none; width:20%;}

@media (max-width: 991px) {
	#cont_ul li {list-style:none; float:left; margin:0; padding:0 0; text-decoration:none; width:50%;}
	#cont_ul li img{ width:100%;}
}

.hover {position:absolute; margin:0; width:100%; height:100%; background:rgba(0,0,0,0.7); transition:all 0.5s; opacity:0;}
.bo_gall {position:relative;}
.bo_gall:hover .hover {opacity:1;}

.hover_tbl {margin:0; padding:0; width:100%; height:100%; border-collapse:collapse;}
.title_p {font-weight:bold; font-size:17px; color:#fff;}
.cate_p {font-size:12px; color:#777;}
</style>

<div id="container">
	<ul id="cont_ul">
		<?php for ($i=0; $i<count($list); $i++) { ?>
		<li>
			<div class="bo_gall">
				<div class="hover">
					<table class="hover_tbl">
					<tbody>
					<tr>
						<td align="center" valign="middle">
							<p class="title_p"><a href="<?php echo $list[$i]['href'] ?>" style="color:#fff;"><?php echo $list[$i]['wr_subject'] ?></a></p>
							<p class="cate_p"><?php echo $list[$i]['ca_name'] ?></p>
						</td>
					</tr>
					</tbody>
					</table>
				</div>
				
				<?php                
				$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            
				if($thumb['src']) {
					//$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" width="'.$imgwidth.'" height="'.$imgheight.'">';
					$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" style="width:100%;">';
				} else {
					$img_content = 'NO IMAGE';
				}                
				echo $img_content;												               
				?>
			</div>
		</li>
		<?php } ?>
	</ul>
</div>
<div style="clear:both;"></div>

<?/*
<div id="oneshot_2_7">
	
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
			</div>
		

			<div class="subject_set">
				<div class="sub_title">	
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=case"><?php echo cut_str($list[$i]['subject'], 36, "..") ?></a>
                </div>
		    </div>
</div>
				
		</li>
	<?php } ?>
	</ul>
</div>
		<!--/////////////////이미지에 테두리/////////////-->
<div style="clear:both;"></div>
*/?>
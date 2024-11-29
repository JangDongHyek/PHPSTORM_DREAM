<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$imgwidth = 200; //표시할 이미지의 가로사이즈
$imgheight = 180; //표시할 이미지의 세로사이즈
?>

<?php /*?><div class="lt">
    <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong>
    <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div>
</div><?php */?>
<div id="latest_gall2">
	<!--
	<div class="la_title"><?php echo $bo_subject ?></div>
	-->
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li>
        	<!--new 아이콘-->
          <div id="quick">
		  <?php
            if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
           ?>
           </div><!--#quick-->

			<div class="img_set">
				<a href="<?php echo $list[$i]['href'] ?>">
                <div class="img_set_bg"></div>
					<?php
                        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            

                        if($thumb['src']) {
                              $img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" width="'.$imgwidth.'" height="'.$imgheight.'">';
                        } else {
                            $youtube_key = substr($list[$i]['link'][1],-11,11);

                            if($youtube_key){
                                $img_content = '<img src="https://img.youtube.com/vi/'.$youtube_key.'/mqdefault.jpg" alt="'.$thumb['alt'].'" width="'.$imgwidth.'" height="'.$imgheight.'"">';
                            }else{
                                $img_content = '<span class="noimg"><img src="'.$latest_skin_url.'/img/noimg.gif" alt="noimage"/></span>';
                            }
                        }						

                        echo $img_content;
                     ?>                     
                    
				</a>
			</div><!--.img_set-->

			<div class="subject_set"><a href="<?php echo $list[$i]['href'] ?>">
				<div class="sub_title">			
				<?php echo cut_str($list[$i]['subject'], 36, "..") ?>
                </div><!--.sub_title-->
			
				<?php /*?><div class="sub_datetime">
				<?=$list[$i]['wr_name']?>
                <?=$list[$i]['datetime2']?>
                </div><?php */?>
	
	        </a></div><!--.subject_set-->
		</li>
	<?php } ?>
	</ul>
</div><!--#latest_gall2-->

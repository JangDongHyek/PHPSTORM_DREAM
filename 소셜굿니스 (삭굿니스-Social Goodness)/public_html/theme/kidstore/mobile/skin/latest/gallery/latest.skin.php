<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$imgwidth = '500'; //표시할 이미지의 가로사이즈
$imgheight = '500'; //표시할 이미지의 세로사이즈
?>

<?php /*?><div class="lt">
    <strong class="lt_title"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo $bo_subject; ?></a></strong>
    <div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기</a></div>
</div><?php */?>
<div id="latest_gall">
	<!--
	<div class="la_title"><?php echo $bo_subject ?></div>
	-->
	<ul>
	<?php for ($i=0; $i<count($list); $i++) { ?>	
		<li>
        	<!--new 아이콘-->
          <div id="quick2">
          	<span>
		  <?php
            //if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
			if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];

           ?>
           </span>
           </div><!--#quick2-->
			<div class="img_set">
				<a href="<?php echo $list[$i]['href'] ?>">
					<?php                
					$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    					            
					if($thumb['src']) {
					$img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" >';
					} else {
					$img_content = '<span class="noimg"><img src="'.$latest_skin_url.'/img/noimg.gif" alt="noimage"/></span>';
					}                
					echo $img_content;												               
					?>
				</a>
			</div><!--.img_set-->

			<div class="subject_set"><a href="<?php echo $list[$i]['href'] ?>">
				<div class="sub_title">			
				<?php echo cut_str($list[$i]['subject'], 36, "..") ?>
                </div><!--.sub_title-->
				
                <div class="sub_content"><?=$list[$i]['wr_content']?></div>
                
				<div class="sub_datetime">
				<?php /*?><?=$list[$i]['wr_name']?><?php */?>
                <?=$list[$i]['datetime2']?>
                </div><!--.sub_datetime-->
	
	        </a></div><!--.subject_set-->
		</li>
	<?php } ?>
	</ul>
</div><!--#latest_gall-->

<div class="lt_more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span>더보기 <i class="fal fa-plus"></i></a></div>


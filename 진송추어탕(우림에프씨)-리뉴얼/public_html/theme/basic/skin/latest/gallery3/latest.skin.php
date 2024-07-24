<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$imgwidth = 400; //표시할 이미지의 가로사이즈
$imgheight = 300; //표시할 이미지의 세로사이즈
  //모바일 이미지 사이즈는 style.css에서 조정함
?>




<div id="oneshot_2_7">
	<!--게시판제목-->
	<div class="la_title">
		<?php echo $bo_subject ?>
	</div>
	
    <!--더보기버튼-->
	<div class="lt_more">
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><span class="sound_only"><?php echo $bo_subject ?></span> 더보기</a>
    </div><!--.lt_more-->
	
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>

	<div class="swiper-container">
    <!--추출이미지부분-->
    <div class="swiper-wrapper">
	<?php for ($i=0; $i<count($list); $i++) { ?>	
	<div class="swiper-slide">
             <div style="position:relative">
                 <div id="quick">
                    <?php if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];  ?>
                 </div><!--#quick-->
             </div>
        
            <!--/////////////////이미지에 테두리/////////////-->
            <div id="border">
               <div class="over">
               <a href="<?php echo $list[$i]['href'] ?>">
			   <?php echo cut_str($list[$i]['subject'], 36, "..") ?>
               <p>자세히보기</p>
               </a>
              
               </div>
               <div class="img_set">
                    <!--<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>">-->
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
                </div><!--.img_set-->
                <div class="subject_set">
                    <div class="sub_title">	
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><?php echo cut_str($list[$i]['subject'], 36, "..") ?></a>
                    </div>
                    
                    <div class="sub_content">
                        <?php /*?><p style="margin-top:1px; margin-bottom:3px;">
                            <!--조회수-->	
                            <span style="font-size:12px;"><font color="#ADACAC">view</font></span>&nbsp;
                            <span style="font-size:12px;"><font color="#01B5EC"><?=$list[$i][wr_hit]?></font></span>
                            <font color="#E7E7E7"> | </font>
                            <!--댓글-->	
                            <span style="font-size:12px;"><font color="#ADACAC">댓글</font></span>&nbsp;
                            <span style="font-size:12px;font-weight:bold;"><font color="#01B5EC"><?=$list[$i][wr_comment]?></font></span>
                            <font color="#E7E7E7"> | </font>
                            <!--공감-->	
                            <span style="font-size:12px;"><font color="#ADACAC">공감</font></span>
                            <span style="font-size:12px;font-weight:bold;"><font color="#CC6633"><?=$list[$i]["good"]?></font></span>
                        </p><?php */?>
                        <!--내용부분-->
                        <?=cut_str(strip_tags($list[$i]['wr_content']), 17, '..')?>
                        <?php /*?><div class="sub_datetime">
                            <?=$list[$i]['wr_name']?><!--글쓴이-->
                            <font color="#CFCFCF">|</font>
                            <?=$list[$i]['datetime2']?><!--올린날짜-->
                        </div><?php */?>
                        </div><!--.sub_content-->
                </div><!--.subject_set-->
            </div><!--#border-->
            <!--/////////////////이미지에 테두리/////////////-->
       </div>
     <?php } ?>
     </div>
     </div>
</div><!--#oneshot_2_7-->

<div style="clear:both;"></div>

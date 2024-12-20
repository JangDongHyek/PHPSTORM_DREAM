<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>


<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="Nb_slt">
	
	 <table cellspacing=0 cellpadding=0 width='100%'  border=0  class="Nb_slt_content">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
      <tr>
		  <td>
<div class="grz_lt">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
    
        <div><a href="<?=$list[$i]['href']?>" <?php if ($list[$i]['is_notice']){?>class="fbold"<?}?>>
				<?=$list[$i]['subject']?><? if($list[$i]['wr_comment']){?><span class="cnt_cmt">+<?=$list[$i]['wr_comment'];?></span><?}?><? if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new']?>
            </a>
		</div>
        <div style="position:relative; margin:0; padding:10px 0; color:#8f96a1; font-size: 0.85em; line-height: 1.4em;" class="cont"><?=cut_str($list[$i]['wr_content'],100)?>&nbsp;<?php echo $list[$i]['datetime'] ?></div>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li>게시물이 없습니다.</li>
    <?php }  ?>
</div>
			 </td>
		 </tr>
   <?php }  ?>

 </table>
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
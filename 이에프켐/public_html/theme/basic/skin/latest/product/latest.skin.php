<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$imgwidth = 176; //표시할 이미지의 가로사이즈
$imgheight = 176; //표시할 이미지의 세로사이즈
  //모바일 이미지 사이즈는 style.css에서 조정함
?>

	<?php for ($i=0; $i<count($list); $i++) { ?>	
<div class="swiper-slide">
						<?php    
						echo "<a href=\"".$list[$i]['href']."\">";
                        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $imgwidth, $imgheight);    	
                        if($thumb['src']) {
                        $img_content = '<img class="img_left" src="'.$thumb['src'].'" alt="'.$list[$i]['subject'].'" width="'.$imgwidth.'" height="'.$imgheight.'" style="border:1px solid #e5e5e5">';
                        } else {
                        $img_content = 'NO IMAGE';
                        }                
                        echo $img_content;												               
												echo "</a>";
                        ?>
</div>
<? }?>




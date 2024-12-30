<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$board['bo_gallery_width'] = 230;
$board['bo_gallery_height'] = 120;
?>

<!-- <?php echo $bo_subject; ?> 웹진형 최신글 시작 { -->
<div class="thumb_wzine">
    <ul class="wzine_list">
    <?php for ($i=0; $i<count($list); $i++) {  ?>
        <li>
            <?php
			$content = cut_str(preg_replace("@<.*?>@","", $list[$i]['wr_content']),350); // 내용 자르기
	
			$thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
			} else {
				$img_content = '';
			}
			?>
                <div class="txt">
                    <a href="<?=$list[$i]['href']?>" class="cont">
                        <h3 class="shot"><?php echo $list[$i]['subject']; ?></h3>
                        <p class="shot"><?php echo $content?></p>
                        <span class="text-right"><?php echo $list[$i]['wr_datetime']?></span>
                    </a>
                </div>
                <div class="thumb">
                    <a href="<?=$list[$i]['href']?>"><?=$img_content?></a>
                </div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
        <li>게시물이 없습니다.</li>
    <?php }  ?>
	</ul>
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$board['bo_gallery_width'] = 212;
$board['bo_gallery_height'] = 123;
?>

<!-- <?php echo $bo_subject; ?> 웹진형 최신글 시작 { -->

<div class="d-flex align-items-center justify-content-center">
    <div class="me-2 side-news-width">
        <i class="fs-1 bi bi-chevron-left text-secondary"></i>
    </div>
    <?php for ($i=0; $i<count($list); $i++) {  ?>
    <div class="me-2 w-100">
        <div class="card mb-2 w-100 product-box-border updown-slide" style="border-radius: 0; overflow: hidden;">
            <a class="" href="<?=$list[$i]['href']?>" target="_self">
                <div class="img">
                <?php
                $content = cut_str(preg_replace("@<.*?>@", "", $list[$i]['wr_content']), 350); // 내용 자르기

                $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

                if ($thumb['src']) {
                    $img_content = '<img src="' . $thumb['ori'] . '" alt="' . $thumb['alt'] . '">';
                } else {
                    $img_content = '<img src="' . G5_THEME_IMG_URL . '/noimg.jpg" alt="No Image">';
                }
                ?>
                <?=$img_content?>
                </div>
                <div class="text-start p-3 bg-white">
                    <div class="text-break-1 mb-2 "><?php echo $list[$i]['subject']; ?></div>
                    <div class="fs-7">
                        <div class="text-break-1">
                            <?php echo strip_tags($list[$i]['wr_content']); ?>
                        </div>
                        <div><?php echo date('Y-m-d', strtotime($list[$i]['wr_datetime'])); ?></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
        <img alt="" src="<?php echo $latest_skin_url ?>/img/no_img.jpg">
        게시물이 없습니다. 게시물이 없습니다.
    <?php }  ?>

    <div class="ms-2 side-news-width">
        <i class="fs-1 bi bi bi-chevron-right text-secondary"></i>
    </div>
</div>





<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->
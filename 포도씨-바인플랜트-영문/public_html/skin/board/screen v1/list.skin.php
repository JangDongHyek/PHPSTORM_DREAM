<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($galType){
	include $board_skin_path."/gal.list.skin.php";
	exit;
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
if(!$list_href) $list_href = G5_BBS_URL."/board.php?bo_table={$bo_table}&page={$page}&galType=1";
?>

<link rel="stylesheet" href="<?php echo G5_CSS_URL;?>/jquery.ad-gallery.css">
<script src="<?php echo G5_JS_URL;?>/jquery.ad-gallery.js"></script>

<style type="text/css">
#gallery {
	padding: 30px;
	background: #e1eef5;
}

#descriptions {
	position: relative;
	height: 50px;
	background: #EEE;
	margin-top: 10px;
	width: 100%;
	padding: 10px;
	overflow: hidden;
}

#descriptions .ad-image-description {
	position: absolute;
}

#descriptions .ad-image-description .ad-description-title {
	display: block;
}
</style>


<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">

    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <div class="bo_fx">

        <?php if ($rss_href || $write_href) { ?>
        <ul class="btn_bo_user">
            <?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
            <?php if ($_SESSION['ss_mb_id']=="lets080") { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
			<?php if ($is_admin) { ?><li><a href="<?php echo $list_href ?>&gal=1" class="btn_admin">시설소개 관리</a></li><? } ?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php } ?>
    </div>

    <form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">


	<div id="gallery" class="ad-gallery">
		<div class="ad-image-wrapper">
		</div>
		<div class="ad-controls">
		</div>
		<div class="ad-nav">
			<div class="ad-thumbs">
				<ul class="ad-thumb-list">

					<?php for ($i=0; $i<count($list); $i++) { ?>
					<li>
					<?php 

						$gallery = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 600, 400);
						$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

						if($gallery['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" class="image'.$i.'">';
						} else {
							$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
						}
						
					?>
					<a href="<?php echo $gallery['src'];?>">
					<?php
						echo $img_content;
					?>
					</a>

					</li>
					<?php } ?>

				</ul>
			</div>
		</div>
	</div>


    <?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>

    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages;  ?>
<!-- } 게시판 목록 끝 -->

<script type="text/javascript">
$(function() {
	var galleries = $('.ad-gallery').adGallery();

	$('#switch-effect').change(
		function() {
			galleries[0].settings.effect = $(this).val();
			return false;
		}
	);

	$('#toggle-slideshow').click(
		function() {
			galleries[0].slideshow.toggle();
			return false;
		}
	);

	$('#toggle-description').click(
		function() {
			if(!galleries[0].settings.description_wrapper) {
				galleries[0].settings.description_wrapper = $('#descriptions');
			} else {
				galleries[0].settings.description_wrapper = false;
			}
			return false;
		}
	);
});
</script>

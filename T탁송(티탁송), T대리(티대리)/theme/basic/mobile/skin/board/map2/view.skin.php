<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (defined('G5_IS_ADMIN')) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/all.min.css">', 0);//폰트어썸
    add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/admin.css">', 0);
} else {
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
}
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<article id="bo_v" style="width:<?php echo $width; ?>">
	<?php
    // 파일 출력
    $v_img_count = count($view['file']);
	$file_ext = false;
    if($v_img_count) {
        echo "<div id=\"bo_v_img\">\n";
    
        for ($i=0; $i<=count($view['file']); $i++) {
            if ($view['file'][$i]['view']) {
                //echo $view['file'][$i]['view'];
                echo get_view_thumbnail($view['file'][$i]['view']);
				$file_ext = true;
            }
        }

		// 사진없으면 기본이미지
		if (!$file_ext) {
			echo '<a href="javascript:void(0)" class="view_image"><img src="'.$board_skin_url.'/img/noimg.gif"></a>';
		}
    
        echo "</div>\n";
    } 
	?>

    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>
        <section id="bo_v_info">
            <h2>페이지 정보</h2>
            <div class="addr"><i class="fas fa-map-marker-alt"></i><?=$view['wr_2']?><? if (in_array($view['wr_2'], $depth_local_list) && $view['wr_3'] != "") {?> > <?=$view['wr_3']?><?}?></div>
            <div class="tel"><i class="fas fa-phone-alt"></i><?=$view['wr_content']?> <? if(!defined('G5_IS_ADMIN')) { ?><a href="tel:<?=$view['wr_content']?>">전화걸기</a><? } ?></div>
        </section>
    </header>

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>
        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?=nl2br($view['wr_1'])?></div>
        <!-- } 본문 내용 끝 -->
    </section>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
		$list_href = "./board.php?bo_table=".$bo_table;
		if ($qstr != "") $list_href .= $qstr;
        ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
			<? if (defined('G5_IS_ADMIN')) { ?>
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
			<? } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
        ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->


<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});
</script>
<!-- } 게시글 읽기 끝 -->
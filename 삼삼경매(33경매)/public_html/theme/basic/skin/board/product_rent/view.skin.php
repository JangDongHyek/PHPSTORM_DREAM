<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 이미지 슬라이더 -->
<link rel="stylesheet" href="<?=$board_skin_url?>/fotorama/fotorama.css">
<script src="<?=$board_skin_url?>/fotorama/fotorama.js"></script>

<!--<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>-->

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div> -->

<article id="bo_v" style="width:<?php echo $width; ?>">

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
     ?>

    <?php if($cnt) { ?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
         ?>
            <li>
                <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
                    <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부">
                    <strong><?php echo $view['file'][$i]['source'] ?></strong>
                    <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
                </a>
                <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 첨부파일 끝 -->
    <?php } ?>

    <?php
    if ($view['link']) {
     ?>
     <!-- 관련링크 시작 { -->
    <section id="bo_v_link">
        <h2>관련링크</h2>
        <ul>
        <?php
        // 링크
        $cnt = 0;
        for ($i=1; $i<=count($view['link']); $i++) {
            if ($view['link'][$i]) {
                $cnt++;
                $link = cut_str($view['link'][$i], 70);
         ?>
            <li>
                <a href="<?php echo $view['link_href'][$i] ?>" target="_blank">
                    <img src="<?php echo $board_skin_url ?>/img/icon_link.gif" alt="관련링크">
                    <strong><?php echo $link ?></strong>
                </a>
                <span class="bo_v_link_cnt"><?php echo $view['link_hit'][$i] ?>회 연결</span>
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
    <!-- } 관련링크 끝 -->
    <?php } ?>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전제품</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음제품</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <!--<?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>-->
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">검색</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php /*?><?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?><?php */?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>
		
        <div class="clearfix header">
            <div class="col-md-5 text-center wow bounceIn r_padding60">
				<div id="foto" class="fotorama" data-width="100%" data-nav="thumbs" data-loop="true" data-autoplay="true">
				<?php
				// 파일 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					for ($i=0; $i<=count($view['file']); $i++) {
						if ($view['file'][$i]['view']) {
							$view['file'][$i]['href'] = '';
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
				}
				?>
				</div>
            </div>
            <div class="col-md-1 hidden-sm hjdden-xs"></div>
            <div class="col-md-6">
                    <p class="t1"><?=$view['wr_subject']?></p> <!-- 제품명 -->
                    <p class="t5 t_margin40"><?=$view['wr_1']?></p> <!-- 제품코드 -->
                    <!--<p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #b6c3cb; margin:0px auto">&nbsp;</p>-->
                    <div class="pt_20"></div>
                    <? if( $bo_table =="pro_aircon01"||$bo_table =="pro_aircon02"||$bo_table =="pro_aircon03"||$bo_table =="pro_aircon04"||$bo_table =="pro_aircon05"||$bo_table =="pro_aircon06") { //에어컨 일때 ?>
					<p class="t4">냉/난방면적<span><?=$view['wr_2']?></span></p>
                    <? } else if( $bo_table =="pro_conditioner01"||$bo_table =="pro_conditioner02"||$bo_table =="pro_conditioner03"||$bo_table =="pro_conditioner04"||$bo_table =="pro_conditioner05"||$bo_table =="pro_conditioner06") { //전문가전 일때 ?>
                    <p class="t4">냉/난방면적<span><?=$view['wr_2']?></span></p>
                    <p class="t4">냉/난방능력<span><?=$view['wr_5']?></span></p>
                    <p class="t4">소비전력<span><?=$view['wr_6']?></span></p>
                    <? } else if( $bo_table =="pro_expert01"||$bo_table =="pro_expert02"||$bo_table =="pro_expert03"||$bo_table =="pro_expert04"||$bo_table =="pro_expert05"||$bo_table =="pro_expert06"||$bo_table =="pro_expert07") { //전문가전 일때 ?>
                    <p class="t4">소비전력<span><?=$view['wr_6']?></span></p>
                    <p class="t4">공기청정능력<span><?=$view['wr_7']?></span></p>
                    <p class="t4">크기<span><?=$view['wr_8']?></span></p>
                    <p class="t4">중량<span><?=$view['wr_9']?></span></p>
                    <?php } else { //그 외 ?>
                    <p class="t4">월 렌탈료<span><?=$view['wr_2']?></span></p>
                    <? } ?>
                    
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid rgba(0,0,0,.1); margin:0px auto">&nbsp;</p>
					<div class="t_margin20"></div>
                    <p class="t7"><?=$view['wr_4']?></p> <!-- 간략설명 -->
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid rgba(0,0,0,.1); margin:0px auto">&nbsp;</p>
					<!--<p class="t9 pt_20"><?=$view['wr_3']?><span>원</span></p>  제품가격 -->
                    <!--견적신청버튼-->
                    <div><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_counsel" class="counsel"><i class="fal fa-keyboard"></i>&nbsp;상담신청</a></div>
                    <!--//견적신청버튼-->
            </div>
        </div>



        <!-- 본문 내용 시작 { -->
        <div class="wrapper">
	    <div class="tabs cf">
		<input type="radio" name="tabs" id="tab1" checked>
		<label for="tab1">
        제품설명
        </label>
		<input type="radio" name="tabs" id="tab2">
		<label for="tab2">
        스펙
        </label>

		<div id="tab-content1" class="tab-content"><div class="thumb_img"><?php echo get_view_thumbnail($view['content']); ?></div></div>
		<div id="tab-content2" class="tab-content"><?php echo get_view_thumbnail($view['wr_text2']); ?></div>
	    </div>
        </div>


        
        <!--<h3 class="tit">제품설명</h3>
		<div><?php echo get_view_thumbnail($view['content']); ?></div>-->
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

        <?php /*?><!-- 스크랩 추천 비추천 시작 { -->
        <?php if ($scrap_href || $good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($scrap_href) { ?><a href="<?php echo $scrap_href;  ?>" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a><?php } ?>
            <?php if ($good_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn_b01">추천 <strong><?php echo number_format($view['wr_good']) ?></strong></a>
                <b id="bo_v_act_good"></b>
            </span>
            <?php } ?>
            <?php if ($nogood_href) { ?>
            <span class="bo_v_act_gng">
                <a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn_b01">비추천  <strong><?php echo number_format($view['wr_nogood']) ?></strong></a>
                <b id="bo_v_act_nogood"></b>
            </span>
            <?php } ?>
        </div>
        <?php } else {
            if($board['bo_use_good'] || $board['bo_use_nogood']) {
        ?>
        <div id="bo_v_act">
            <?php if($board['bo_use_good']) { ?><span>추천 <strong><?php echo number_format($view['wr_good']) ?></strong></span><?php } ?>
            <?php if($board['bo_use_nogood']) { ?><span>비추천 <strong><?php echo number_format($view['wr_nogood']) ?></strong></span><?php } ?>
        </div>
        <?php
            }
        }
        ?>
        <!-- } 스크랩 추천 비추천 끝 --><?php */?>
    </section>

    <?php
    //include_once(G5_SNS_PATH."/view.sns.skin.php");
    ?>

    <?php
    // 코멘트 입출력
    //include_once(G5_BBS_PATH.'/view_comment.php');
     ?>

    <!-- 링크 버튼 시작 { -->
    <div id="bo_v_bot">
        <?php echo $link_buttons ?>
    </div>
    <!-- } 링크 버튼 끝 -->

</article>
<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->
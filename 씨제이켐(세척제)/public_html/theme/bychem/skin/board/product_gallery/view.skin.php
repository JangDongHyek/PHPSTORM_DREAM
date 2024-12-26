<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


//$spec_text = array("모델명","상선식","전압","전류","주파수","정밀도","계기정수");
$spec_text = array("모델명","상선식","전압","전류","주파수","정밀도");
$spec_file = array("사용설명서","조건표","도면치수");
$f_class = array("fa fa-file-text", "fa fa-table", "fa fa-picture-o");
for($j=0; $j<count($spec_text); $j++) {
	$k = $j+1;
	$view['wr_'.$k] = explode('|', $view['wr_'.$k]);
	
}

for($i=0;$i<count($view[wr_1]);$i++){
	if($view[wr_1][$i] != "") $option_count++;
}
$file_r = sql_query("select * from `g5_board_file` where `wr_id` = '$view[wr_id]' and `bo_table` = '$bo_table' and `bf_no` >= '$file_count'");
while($file_row = sql_fetch_array($file_r)) {
	$k = floor($file_row[bf_no]/3)-1;
	${'file_'.$k}[] = $file_row;
}



?>
<!-- 이미지 슬라이더 -->
<link rel="stylesheet" href="<?=$board_skin_url?>/fotorama/fotorama.css">
<script src="<?=$board_skin_url?>/fotorama/fotorama.js"></script>

<!--<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>-->

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div> -->

<article id="bo_v" style="width:<?php echo $width; ?>">
    <header>
        <h1 id="bo_v_title">
            <?php
            if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝
            echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력
            ?>
        </h1>

<!--
    <section id="bo_v_info">
        <h2>페이지 정보</h2>
        작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
        조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
        <!--댓글<strong><?php echo number_format($view['wr_comment']) ?>건</strong> 
    </section>
-->
    </header>

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
		
        <div class="clearfix" style="background:#fff; padding:0; border:0px">
            <div class="col-md-7">
               		<p class="t5 t_margin40"><span class="model">MODEL</span><? for($i=0; $i<$option_count; $i++ ) {
						echo $view['wr_1'][$i];
						if($i != $option_count-1) echo " / ";
					}?></p> <!-- 모델명 -->
                    <p class="t1 t_margin10"><?=$view['wr_subject']?></p> <!-- 제품명 -->
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #eaeaea; margin:0px auto">&nbsp;</p>
					<p class="t3 t_margin20"><?=$view['wr_8']?></p> <!-- 서브 제품명 -->
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #eaeaea; margin:0px auto">&nbsp;</p>
					<p class="t5 t_margin20"><?=$view['wr_text1']?></p> <!-- 간략설명 -->
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #eaeaea; margin:0px auto">&nbsp;</p>
                    <p class="t_margin20 wow fadeInDown"><span class="model">FEATURE</span></p>
                    <p class="t_margin20 wow fadeInDown"><? echo $view['content']; ?> <!-- 특징 --></p>
					<!-- <p class="t9 t_margin20"><?=$view['wr_3']?><span>원</span></p> <!-- 제품가격 -->
            </div>
            <div class="col-md-5 text-right wow bounceIn">
				<div id="foto" class="fotorama" data-width="100%" data-nav="thumbs" data-loop="true" data-autoplay="true">
				<?php
				// 파일 출력
				$v_img_count = count($view['file']);
				if($v_img_count) {
					for ($i=0; $i<$file_count; $i++) {
						if ($view['file'][$i]['view']) {
							$view['file'][$i]['href'] = '';
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
				}
				?>
				</div>
            </div>
        </div>


        <p class="t3 t_margin40 b_margin20"><i class="fa fa-bars"></i>제품사양</p>
		<!-- 제품스펙 표 -->
		<div class="tbl_left">
		<table>
		<colgroup>
		  <col style="width: 18%;">
		  <col style="width: auto;">
		</colgroup>
		  <tbody>
		    <? $td_width = floor(82/$option_count); ?>
			<? for($i=0; $i<count($spec_text); $i++) { 
				$k = $i+1;
			?>
				<tr>
				  <th><?=$spec_text[$i]?></th>
				  <? for($j=0; $j<$option_count; $j++) { ?>
					<td style="width: <?=$td_width?>%"><?=$view['wr_'.$k][$j]?></td>
				  <?}?>
				</tr>
			<?}?>

			<? for($i=0; $i<count($spec_file); $i++) { ?>
				<tr>
				  <th><?=$spec_file[$i]?></th>
				  <?
				  $colspan = 1;
				  for($j=$option_count; $j>=1; $j--){
					if(${'file_'.$j}[$i][bf_source] != ""){
						${'td_'.$j} = '<td style="width:'.$td_width.'%" class="text-center" colspan="'.$colspan.'"><a href="'.G5_BBS_URL.'/download.php?bo_table='.$bo_table.'&wr_id='.$view[wr_id].'&no='.${'file_'.$j}[$i][bf_no].'" class="btn'.($i+1).'"><i class="'.$f_class[$i].'"></i>'.$spec_file[$i].' <i class="fa fa-download"></i></a></td>';
						$colspan = "1";
					} else $colspan++;
				  }

				  for($j=1; $j<=$option_count; $j++){
					$tdtd .= ${'td_'.$j};
				  }

				  if($tdtd == "") {
					$tdtd = '<td style="82%" class="text-center" colspan="'.$colspan.'">'.$spec_file[$i].'가 없습니다</td>';
				  }
				  echo $tdtd;
			      
				  for($j=1; $j<=$option_count; $j++){
					${'td_'.$j} = "";
					$tdtd = "";
				  }
				  ?>
				</tr>
			<?}?>
		  </tbody>
		</table>
		</div>


		<div>

		</div>
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
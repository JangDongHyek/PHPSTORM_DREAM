<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if(!$member[mb_id]){
        $good_href = './good.php?bo_table='.$bo_table.'&wr_id='.$wr_id.'&good=good';
        $nogood_href = './good.php?bo_table='.$bo_table.'&wr_id='.$wr_id.'&good=nogood';
}


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<!-- 이미지 슬라이더 -->
<link rel="stylesheet" href="<?=$board_skin_url?>/fotorama/fotorama.css">
<script src="<?=$board_skin_url?>/fotorama/fotorama.js"></script>
				
<!--<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>-->

<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div> -->

<article id="bo_v" style="width:<?php echo $width; ?>"> <!--<header> <h1 id="bo_v_title"> <?php if ($category_name) echo $view['ca_name'].' | '; // 분류 출력 끝 echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?> </h1>

    <section id="bo_v_info">
        <h2>페이지 정보</h2>
        작성자 <strong><?php echo $view['name'] ?><?php if ($is_ip_view) { echo "&nbsp;($ip)"; } ?></strong>
        <span class="sound_only">작성일</span><strong><?php echo date("y-m-d H:i", strtotime($view['wr_datetime'])) ?></strong>
        조회<strong><?php echo number_format($view['wr_hit']) ?>회</strong>
       <?php echo number_format($view['wr_comment']) ?>건</strong>
    </section>
    </header>-->

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
<!--   첨부파일 시작  -->
    

    
	<!-- 첨부파일 끝 -->
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
  <div id="bo_v_top" class="col-md-12">
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
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">복사</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">이동</a></li><?php } ?>
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
		
        <div class="detail clearfix col-md-12">
            <div class="col-md-6 text-center">
				<div id="foto" class="fotorama" data-width="100%" data-nav="thumbs" data-loop="true" data-autoplay="true">
				<?php
				// 파일 출력
				$v_img_count = count($view['file']);

					for ($i=0; $i<=2; $i++) {
					if($v_img_count > $i){
						if ($view['file'][$i]['view']) {
							$view['file'][$i]['href'] = '';
							echo get_view_thumbnail($view['file'][$i]['view']);
						}
					}
				}
				?>
				</div>
            </div>			
            <div class="col-md-6 l_padding40">

               	
                    <p class="t1 wow fadeInUp" data-wow-delay="0.2s"><?=$view['wr_subject']?></p> <!-- 제품명 -->
				<ul class ="sub_ul">
				
				<?php

				$file = get_file($bo_table,$view['wr_id']);


				// 파일 출력
				$v_img_count = count($view['file']);
					

					for ($i=3; $i<=7; $i++) {
						if($file[$i]['size'] != '0byte'){
						?>
				<img src="<?=$file[$i]['href']?>" width="100" height="100"/>					
					<?
						}
					}
				
				?>
				
				</ul>

			
				</div>
					<p class="t5 t_margin40 wow fadeInUp" data-wow-delay="0.1s"><?=$view['wr_content']?></p> <!-- 제품코드 -->
						<p class="t5 t_margin40 wow fadeInUp" data-wow-delay="0.1s"><input type="button" value="온라인문의" onclick ="go_faq()"/></p> <!-- 제품코드 -->
					<!--구매버튼-->
              
<!--                     <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #e3e3e3; margin:0px auto">&nbsp;</p>
                    					<p class="t19 t_margin20 wow fadeInUp" data-wow-delay="0.5s"><?=$view['wr_4']?></p> 간략설명
                    <p class="wow bounceIn" data-wow-delay="1s" style="width:100%; border-bottom:1px solid #e3e3e3; margin:0px auto">&nbsp;</p> -->
                 <!--    <div class="t_margin20 wow fadeInUp" data-wow-delay="0.7s">
                       <a href="javascript:alert('구매하기 준비중입니다.')" class="btn btn-info" role="button" style="color:#fff; background:#00a666; border:1px solid #00a666"><i class="fas fa-cart-plus"></i>&nbsp;구매하기</a>&nbsp;
                       <a href="javascript:alert('위시리스트 준비중입니다.')" class="btn btn-primary" role="button" style="color:#fff; background:#434343; border:1px solid #434343"><i class="fas fa-shopping-basket"></i>&nbsp;위시리스트</a>
                    </div> -->
                    
					<!--좋아요-->
					<!-- <?php if ($good_href || $nogood_href) { ?>	
					<div id="bo_v_act" class="t_margin20">				
						<?php if($good_href) { ?>
						<span class="bo_v_act_gng" style="font-size:0.85em; font-weight:400">
						<a href="<?php echo $good_href.'&amp;'.$qstr ?>" id="good_button" class="btn btn-default" role="button" style="opacity:0.6"><i class="far fa-thumbs-up"></i><strong>&nbsp;<?php echo number_format($view['wr_good']) ?></strong></a>
						<b id="bo_v_act_good"></b>
						</span>
						<?php  } ?>		
						<?php if($nogood_href) { ?>
						<span class="bo_v_act_gng" style="font-size:0.85em; font-weight:400">
						&nbsp;<a href="<?php echo $nogood_href.'&amp;'.$qstr ?>" id="nogood_button" class="btn btn-default" role="button" style="opacity:0.6"><i class="far fa-thumbs-down"></i>&nbsp;<strong><?php echo number_format($view['wr_nogood']) ?></strong></a></span>
						<b id="bo_v_act_nogood"></b>
						<?php } ?>
					</div>
					<?php } ?>					 -->
					<!--//좋아요-->

					<!-- <p class="t6 t_margin15 wow fadeInUp" data-wow-delay="0.9s"><i class="fab fa-google-plus-square"></i>&nbsp;본 제품을 공유해주세요</p>제품가격
					                    sns
					                       <div class="t_margin15 wow fadeInUp" data-wow-delay="1.1s">
					                           
							<div class="SNS_Share_Top">																			
							
					                            Share on Facebook
							<a href="#" onclick="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u='
							+encodeURIComponent(document.URL)+'&amp;t='+encodeURIComponent(document.title), 'facebooksharedialog',
							 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Facebook">
							<img src="../sns_images/Facebook.png" width=30 height=30 alt="페이스북"></a>
					                            
					                            Share on Twitter
							<a href="#" onclick="javascript:window.open('https://twitter.com/intent/tweet?text=[%EA%B3%B5%EC%9C%A0]%20'
							+encodeURIComponent(document.URL)+'%20-%20'+encodeURIComponent(document.title), 'twittersharedialog',
							 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" alt="Share on Twitter"><img src="../sns_images/Twitter.png" width=30 height=30 alt="트위터"></a>
					                             					
							Share on Google+
							<a href="#" onclick="javascript:window.open('https://plus.google.com/share?url='+encodeURIComponent(document.URL), 'googleplussharedialog','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=600');return false;" target="_blank" alt="Share on Google+">
							<img src="../sns_images/Google_Plus.png" width=30 height=30 alt="구글"></a>
					
					                            Share on Kakaotalk
					                            <a id="kakao-link-btn" href="javascript:void(0);"><img src="../sns_images/Kakao_Talk.png" width=30 height=30 alt="카카오톡"></a>
					
							Share on Kakaostory
							<a href="#" onclick="javascript:window.open('https://story.kakao.com/s/share?url='+encodeURIComponent(document.URL), 'kakaostorysharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;" target="_blank" alt="Share on kakaostory">
							<img src="../sns_images/Kakao_Story.png" width=30 height=30 alt="카카오스토리"></a>
					
							Share on Naver
							<a href="#" onclick="javascript:window.open('http://share.naver.com/web/shareView.nhn?url='
							+encodeURIComponent(document.URL)+'&amp;title='+encodeURIComponent(document.title),
							 'naversharedialog', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank" alt="Share on Naver">
							<img src="../sns_images/Naver.png" width=30 height=30 alt="네이버"></a>
							</div>			   
						    -->
						   <!--
						   <span><a href="https://www.facebook.com/" class="icon_round" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="https://www.twitter.com/" class="icon_round02" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="https://www.tumblr.com/" class="icon_round03" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="https://www.pinterest.co.kr" class="icon_round04" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="https://www.instagram.com/" class="icon_round05" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="https://www.instagram.com/" class="icon_round06" target="_blank" /></a></span>&nbsp;&nbsp;
                           <span><a href="" class="icon_round07" target="_blank" title="문자"></a></span>
						   -->

                       </div> 
                    <!--//sns-->
            </div>
        </div>
        <div class="b_margin50" style="border-top:1px solid #e3e3e3; clear:both"></div>
        <!-- 본문 내용 시작 { -->
      <!--   <div class="t_margin50">
             <div class="clearfix">
                  <div class="col-md-5">
        				       <h3>제품설명</h3>
        				       <?php echo get_view_thumbnail($view['wr_5']); ?>
                       
                  </div>
               <div class="col-md-7 l_padding30">
                       <h3>제품사양</h3> 
                  				       <?php echo get_view_thumbnail($view['wr_6']); ?>
                       <h3 class="t_margin40">제품 지침(주의사항) 및 가이드(안내)</h3>
                       <h4><i class="fas fa-exclamation-triangle"></i><?$i=10;?>
                  					   주의사항 보기&nbsp;&nbsp;<a href="<?php echo $view['file'][$i]['href'];  ?>" class="btn btn-default btn-xs">보기</a></h4>
                       <h4><i class="fas fa-cloud-download-alt"></i> <?$i=11;?>가이드 보기 또는 다운로드&nbsp;&nbsp;<a href="<?php echo $view['file'][$i]['href'];  ?>" class="btn btn-default btn-xs">다운로드</a></h4>
                  </div>
             </div>
        <div class="wow fadeInDown t_margin30 b_margin30">
        <? if($bo_table == "pro01"){ ?>
            <img src="<?php echo $board_skin_url ?>/img/pro_detail01.jpg" alt="상세이미지" class="imgWidth" />
        <? } else if($bo_table == "pro02"){ ?>
            <img src="<?php echo $board_skin_url ?>/img/pro_detail02.jpg" alt="상세이미지" class="imgWidth" />
        <? } else if($bo_table == "pro04"){ ?>
            <img src="<?php echo $board_skin_url ?>/img/pro_detail04.jpg" alt="상세이미지" class="imgWidth" />  
        <? } ?>
        </div> -->
		<div id="tab-content3" class="t_margin30">
              <h3>내용</h3>


        <?php/*
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                if ($view['file'][$i]['view']) {
                    //echo $view['file'][$i]['view'];
                    echo get_view_thumbnail($view['file'][$i]['view']);
								?>
								<!-- 파일 설명 시작 -->
								<div>
										<?=$view['file'][$i]['bf_content']?>
								</div>
								<!-- 파일 설명 끝 -->
								<?
									
                }
            }

            echo "</div>\n";
        }*/
	
         ?>



				
			
		      <?php 
			$bar_scroll = '<table><tr>';
			for($i=1; $i <=5; $i++){
					
				if($view['wr_'.$i]){
					$bar_scroll .=  '<td><input type="button" value="content#'.$i.'" onclick="scrollMove('.$i.')"/></td>';
				}
				
			}
			$bar_scroll .= '</tr></table>';
		

			  for($i =1; $i <= 5; $i++){

				 

				if($view['wr_'.$i]){
							 echo $bar_scroll;
							  echo '<div id = "'.$i.'">';
							  echo get_view_thumbnail($view['wr_'.$i]); 
			   				  echo '</div>';
				}		  
			  }
			  ?>

        </div>
		    <section id="bo_v_file">
        <h2>첨부파일</h2>
        <ul>
        <?php
        // 가변 파일
		$doc_cnt =0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
				$doc_cnt ++;
         ?>			
            <li>
                <input type="button" value= "첨부파일<?=$doc_cnt?>" onclick="down_doc('<?php echo $view['file'][$i]['href'] ?>')" class="view_file_download">
<!--                     <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부"> -->
<!--                     <strong><?php echo $view['file'][$i]['source'] ?></strong> -->
<!--                     <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>) -->
                </input>
<!--                 <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span> -->
            </li>
        <?php
            }
        }
         ?>
        </ul>
    </section>
	    </div>
            <!-- 링크 버튼 시작 { -->
        <!--     <div id="bo_v_bot" class="t_margin50">
                <?php echo $link_buttons ?>
            </div> -->
            <!-- } 링크 버튼 끝 -->
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

</article>
<!-- } 게시판 읽기 끝 -->

<script>

function go_faq(){
	
	location.href ='./board.php?bo_table=faq_eng';

}

function down_doc(href){
	location.href = href;
}

  function scrollMove(seq){
        var offset = $("#" + seq).offset();
        $('html, body').animate({scrollTop : offset.top-115}, 400);
    }




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
                    $tx.text("비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>

<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
var sharedUrl = window.location.href;
var sharedImg = $(".view_image").eq(0).find('img').attr('src');

Kakao.init('a9732845830f8f1ed19b0e29aaddd042');
Kakao.Link.createDefaultButton({
	container: '#kakao-link-btn',
	objectType: 'feed',
	content: {
		title: "<?=$view['wr_subject']?>",
		description: "<?=substr($view['wr_4'], 0, 100)?>",
		imageUrl: sharedImg,
		link: {
			mobileWebUrl: sharedUrl,
			webUrl: sharedUrl
		}
	},
	buttons: [
		{
			title: '웹으로 보기',
			link: {
				mobileWebUrl: sharedUrl,
				webUrl: sharedUrl
			}
		}
	]
});

</script>
<!-- } 게시글 읽기 끝 -->
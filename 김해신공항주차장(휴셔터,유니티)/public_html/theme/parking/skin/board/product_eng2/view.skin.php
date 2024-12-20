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
    <div id="bo_v_link">
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
    </div><!--#bo_v_link-->
    <!-- } 관련링크 끝 -->
    <?php } ?>

    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top" class="col-md-12">
        <?php
        ob_start();
         ?>
        <?php /*?><?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">Prev</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">Next</a></li><?php } ?>
        </ul>
        <?php } ?><?php */?>
    
        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">Modify</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">Delete</a></li><?php } ?>
            <?php if ($copy_href) { ?><li><a href="<?php echo $copy_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">Copy</a></li><?php } ?>
            <?php if ($move_href) { ?><li><a href="<?php echo $move_href ?>" class="btn_admin" onclick="board_move(this.href); return false;">Move</a></li><?php } ?>
            <?php if ($search_href) { ?><li><a href="<?php echo $search_href ?>" class="btn_b01">Search</a></li><?php } ?>
            <?php /*?><li><a href="<?php echo $list_href ?>" class="btn_b01">List</a></li><?php */?>
            <?php /*?><?php if ($reply_href) { ?><li><a href="<?php echo $reply_href ?>" class="btn_b01">답변</a></li><?php } ?><?php */?>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">Register</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div> <!--#bo_v_top-->
    <!-- } 게시물 상단 버튼 끝 -->
   
    <!-- 본문 내용 시작 { -->
    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>
        
        <!-- 본문 상단 부분 시작 { -->
        <div class="detail clearfix">
            <div class="col-md-6 col-xs-12 text-center prov_mimg">
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
            </div><!--.prov_mimg-->	
            		
            <div class="col-md-6 col-xs-12">
                <div class="wow fadeInUp prov_tt" data-wow-delay="0.2s"><?=$view['wr_subject']?></div> <!-- 제품명 -->
				<ul class ="sub_ul">
				
				<?php

				$file = get_file($bo_table,$view['wr_id']);


				// 파일 출력
				$v_img_count = count($view['file']);
					

					for ($i=3; $i<=7; $i++) {
						if($file[$i]['size'] != '0byte'){
						?>
				    <div class="prov_vimg"><img src="<?=$file[$i]['href']?>" /></div>	
					<?
						}
					}
				
				?>
				
				</ul>
                
                <div class="wow fadeInUp prov_st" data-wow-delay="0.1s"><?=$view['wr_content']?></div> <!-- 컨셉 텍스트 -->
                <?php /*?><div class="wow fadeInUp prov_obtn" data-wow-delay="0.1s"><input type="button" value="Online inquiry" onclick ="go_faq()"/></div><?php */?> <!--온라인문의-->
            </div><!--.col-md-6 col-xs-12-->
        </div> <!--.detail-->
        <!-- 본문 상단 부분 끝 { -->

        <!-- 내용컨텐츠 시작 { -->
		<div id="tab-content3">
             <!-- <h3>내용</h3>-->

    
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
			//$bar_scroll = '<table class="prov_table"><tr>';
			//for($i=1; $i <=5; $i++){
					
				//if($view['wr_'.$i]){
					//$bar_scroll .=  '<td><input type="button" value="content#'.$i.'" onclick="scrollMove('.$i.')" class="prov_cbtn"/></td>';
				//}
				
			//}
			//$bar_scroll .= '</tr></table>';
		

			  for($i =1; $i <= 5; $i++){

				 

				if($view['wr_'.$i]){
							 echo $bar_scroll;
							  echo '<div class="prov_info" id = "'.$i.'">';
							 echo get_view_thumbnail($view['wr_'.$i]); 
			   				  echo '</div>';
				}		  
			  }
			  ?>

        </div><!--#tab-content3-->
		<?php /*?><div id="bo_v_file">
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
                    <input type="button" value= "Attachments<?=$doc_cnt?>" onclick="down_doc('<?php echo $view['file'][$i]['href'] ?>')" class="view_file_download">
                    
<!--                     <img src="<?php echo $board_skin_url ?>/img/icon_file.gif" alt="첨부"> -->
<!--                     <strong><?php echo $view['file'][$i]['source'] ?></strong> -->
<!--                     <?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>) -->
<!--                 <span class="bo_v_file_cnt"><?php echo $view['file'][$i]['download'] ?>회 다운로드</span>
                <span>DATE : <?php echo $view['file'][$i]['datetime'] ?></span> -->
                </li>
            <?php
                }
            }
             ?>
            </ul>
         </div><?php */?><!--#bo_v_file-->
        <!-- } 내용컨텐츠 끝 -->
       
        <?php//echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
    
        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>

    </section><!--#bo_v_atc-->
    <!--}  본문 내용 끝 -->

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
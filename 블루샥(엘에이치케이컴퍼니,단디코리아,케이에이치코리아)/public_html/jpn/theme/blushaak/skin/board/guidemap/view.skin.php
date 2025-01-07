<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<? /*
<link  href="<?php echo G5_CSS_URL; ?>/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="<?php echo G5_JS_URL; ?>/fotorama.js"></script> <!-- 16 KB -->
<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=963c68772d5dcf8ed4b4619896dc8142&libraries=services"></script>
*/ 
?>
<!-- 구글지도 api 가져오기 -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_3E7V5dT7IL5jUK4GmKOIBGnyKcUFLlg&callback=initMap&v=weekly" defer></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script><!--슬라이드-->

<!-- 게시물 읽기 시작 { -->
<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>

<article id="bo_v" style="width:<?php echo $width; ?>">



    <!-- 게시물 상단 버튼 시작 { -->
    <div id="bo_v_top">
        <?php
        ob_start();
         ?>
        <?php if ($prev_href || $next_href) { ?>
        <ul class="bo_v_nb">
            <?php if ($prev_href) { ?><li><a href="<?php echo $prev_href ?>" class="btn_b01">이전글</a></li><?php } ?>
            <?php if ($next_href) { ?><li><a href="<?php echo $next_href ?>" class="btn_b01">다음글</a></li><?php } ?>
        </ul>
        <?php } ?>

        <ul class="bo_v_com">
            <?php if ($update_href) { ?><li><a href="<?php echo $update_href ?>" class="btn_b01">수정</a></li><?php } ?>
            <?php if ($delete_href) { ?><li><a href="<?php echo $delete_href ?>" class="btn_b01" onclick="del(this.href); return false;">삭제</a></li><?php } ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01">목록</a></li>
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>
        <?php
        $link_buttons = ob_get_contents();
        ob_end_flush();
         ?>
    </div>
    <!-- } 게시물 상단 버튼 끝 -->

    <?php
    if ($view['file']['count']) {
        $cnt = 0;
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                $cnt++;
        }
    }
    ?>
	<div id="list_store">

        <div class="list_store">
            <dl>
                <?php
                $v_img_count = count($view['file']);
    
                if($v_img_count >= 2){?>
                <dt id="bo_slide">	
                    <div class="fotorama" data-nav="thumbs" data-width="500" data-height="300">
                        <ul class="sliderbx">
                            <?php
                            // 파일 출력					
                            if($v_img_count) {
                                for ($i=0; $i<=count($view['file']); $i++) {
                                    if ($view['file'][$i]['view']) {								
                                        echo '<li>'.get_view_thumbnail($view['file'][$i]['view']).'</li>';
                                        //echo $view['file'][$i]['view'];
                                    }
                                }
                            }			
                            ?>
                        </ul>
                    </div>
                </dt>
                <?}else{//파일 출력이 없을때?>
                <!--<dt style="width:100%; height: 370px;">						
                    <img src='../img/sub/cover.jpg'>
                </dt>-->
                <?}?>
            </dl>	
            
            <dl class="info_box">
		        <dt><h4><?php echo $view['subject'] ?></h4></dt>
                <dd>
					<ul class="fa-ul info">
                        <li><i class="fa-li fa fa-map-marker" aria-hidden="true"></i><strong>Addresss</strong> <span><? /*php echo $view['wr_1']; */?> <?php echo $view['wr_2']; ?></span></li>
                        <li><i class="fa-li fa fa-phone" aria-hidden="true"></i><strong>Telephone</strong> <span><?php echo $view['wr_4']; ?></span></li>
                        <li><i class="fa-li fa fa-car" aria-hidden="true"></i><strong>Parking</strong> <span><?php echo $view['wr_6']; ?></span></li>
					</ul>
                </dd>
            </dl>
            
            
            <dl>	    							
                <dt>Store Introduce</dt>
                <dd><?php echo get_view_thumbnail($view['content']); ?></dd>
    
                <dt>Direction</dt>
                <dd>
                    <div id="map" style="width:100%;height:400px; border: 1px solid #dddddd; margin:0 auto;"></div
                ></dd>
            </dl>
        </div>
	</div>
    
    <section id="bo_v_atc">
	
        <h2 id="bo_v_atc_title">본문</h2>

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
    </section>

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
var wr_lat = <?=$view['wr_7']?>;
var wr_lng = <?=$view['wr_8']?>;
let map;
	// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: wr_lat, lng: wr_lng };
  var latlng = new google.maps.LatLng(wr_lat, wr_lng);
  // The map, centered at Uluru
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 17,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
}

window.initMap = initMap;
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

//이미지롤링
$(document).ready(function(){
  $('#bo_slide .sliderbx').bxSlider({
	  responsive : true,            // 반응형
	  mode : 'horizontal',           		// 'horizontal', 'vertical', 'fade'
	  pager : false,                 // 페이지버튼 사용유무
	  Controls : true,              // 좌우버튼 사용유무
	  auto : true,                  // 자동재생
	  pause : 5000,                  // 자동재생간격
	  speed : 1000,                  // 이미지전환속도
	  autoControls : false,          // 재생버튼 사용
	  //autoControlsCombine : true,   // 플레이, 스탑버튼 교차
	  });

});

</script>
<!-- } 게시글 읽기 끝 -->
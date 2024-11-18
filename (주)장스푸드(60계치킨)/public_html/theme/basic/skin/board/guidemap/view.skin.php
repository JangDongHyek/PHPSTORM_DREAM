<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<link  href="<?php echo G5_CSS_URL; ?>/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="<?php echo G5_JS_URL; ?>/fotorama.js"></script> <!-- 16 KB -->
<?/*
181227 카카오API 신규발급 받음
<script type="text/javascript" src="//apis.daum.net/maps/maps3.js?apikey=963c68772d5dcf8ed4b4619896dc8142&libraries=services"></script>
*/ ?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=41982c9bef00b4da7a700cd6f86deef4&libraries=services"></script>

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

	<style>
		.list_store img{width:100%;}
	</style>

	<div class="list_store" style="width:calc(100% - 10px); padding:20px 10px;">
		<dl>
			<?php
			$v_img_count = count($view['file']);

			if($v_img_count >= 2){?>
			<dt style="width:100%;">	
				<div class="fotorama" data-nav="thumbs" data-width="500" data-height="300">
					<?php
					// 파일 출력					
					if($v_img_count) {
						for ($i=0; $i<=count($view['file']); $i++) {
							if ($view['file'][$i]['view']) {								
								echo get_view_thumbnail($view['file'][$i]['view']);
								//echo $view['file'][$i]['view'];
							}
						}
					}			
					?>					
				</div>
			</dt>
			<?}else{//파일 출력이 없을때?>
			<!--<dt style="width:100%; height: 370px;">						
				<img src='../img/sub/cover.jpg'>
			</dt>-->
			<?}?>
		</dl>	
		<dl>
			<dd>				
				<span><?php echo $view['subject'] ?></span>
				<br /><br />
				<div class="small">
				<strong>주소 :</strong> <?php echo $view['wr_1']; ?> <?php echo $view['wr_2']; ?> <br/>
				<strong>전화번호 :</strong> <?php echo $view['wr_3']; ?><br/>
				<strong>주차여부 :</strong> <?php echo $view['wr_4']; ?><br/>
				</div>
			</dd>
		</dl>
		
		
		<dl style="">	    							
			<div class="title">지점소개</div>
			<?php echo get_view_thumbnail($view['content']); ?>

			<p class="title">상세약도안내</p>
			<div id="daum_map" style="width:100%;height:400px; border: 1px solid #dddddd; margin:0 auto;"></div>
		</dl>
	</div>
    </section>

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
var mapContainer = document.getElementById('daum_map'), // 지도를 표시할 div 
    mapOption = { 
        center: new daum.maps.LatLng(wr_lat, wr_lng), // 지도의 중심좌표
        draggable: true, // 지도를 생성할때 지도 이동 및 확대/축소를 막으려면 draggable: false 옵션을 추가하세요
        level: 2, // 지도의 확대 레벨
    };

var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
// 마커가 표시될 위치입니다 
var markerPosition  = new daum.maps.LatLng(wr_lat, wr_lng); 
// 마커를 생성합니다
var marker = new daum.maps.Marker({
    position: markerPosition
});
// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

// 버튼 클릭에 따라 지도 이동 기능을 막거나 풀고 싶은 경우에는 map.setDraggable 함수를 사용합니다
function setDraggable(draggable) {
    // 마우스 드래그로 지도 이동 가능여부를 설정합니다
    map.setDraggable(draggable);    
}

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
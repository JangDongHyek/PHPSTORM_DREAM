<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<style>
img { height:auto; }
.group::after, .tabBlock-tabs::after {
  clear: both;
  content: "";
  display: table;
}

*, ::before, ::after {
  box-sizing: border-box;
}

.unstyledList, .tabBlock-tabs {
  list-style: none;
  margin: 0;
  padding: 0;
}

.tabBlock {
  margin: 0 0 2.5rem;
}

.tabBlock-tab {
  background-color: #fff;
  border-color: #d8d8d8;
  /*border-left-style: solid;
  border-top: solid;
  border-width: 2px*/;
  color: #b5a8c5;
  cursor: pointer;
  display: inline-block;
  float: left;
  padding: 0.625rem ;
  position: relative;
  -webkit-transition: 0.1s ease-in-out;
          transition: 0.1s ease-in-out;
}
.tabBlock-tab:last-of-type {
  /*border-right-style: solid;*/
}
.tabBlock-tab::before, .tabBlock-tab::after {
  content: "";
  display: block;
  -webkit-transition: 0.1s ease-in-out;
          transition: 0.1s ease-in-out;
}
.tabBlock-tab::before {
  background-color: #b5a8c5;
  left: -2px;
  right: -2px;
  top: -2px;
}
.tabBlock-tab::after {
  background-color: transparent;
  bottom: -2px;
  left: 0;
  right: 0;
}
.tabBlock-tab.is-active {
  position: relative;;
  z-index: 1;
}
.tabBlock-tab.is-active::before {
  background-color: #975997;
}
.tabBlock-tab.is-active::after {
  background-color: #fff;
}

.tabBlock-content {
  background-color: #fff;
  /*border: 2px solid #d8d8d8;*/
  padding:10px;
  border-radius:0 0 5px 5px;
}

.tabBlock-pane > :last-child {
  margin-bottom: 0;
}

.tabBlock-tabs li{ width:20%; text-align: center;background: #fff; font-size: 1.20em; color:#a09fed; background:#d9d9f7; font-weight:500; border-right:1px solid #eaeafb}
.tabBlock-tabs li:last-child{ border-right:0px}
.tabBlock-tabs li.is-active{ width:20%; text-align: center;background: #fff; font-size: 1.20em; color:#a09fed; color:#a09fed; background:#fff; font-weight:bold; border-right:0px}
</style>

<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script src="<?php echo G5_THEME_JS_URL; ?>/swiper.min.js"></script>
<script type="text/javascript" src="http://apis.daum.net/maps/maps3.js?apikey=<?php echo $config['cf_10']; ?>&libraries=services"></script>
<!-- 게시물 읽기 시작 { -->
<!--<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>-->
<?php if($is_admin){ ?>

<!-- 게시판 페이지 정보 및 버튼 시작 { -->
<div class="bo_fx">
	<ul class="btn_bo_user">
		<li><a href="<?php echo $update_href ?>" class="btn_b02"><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp;&nbsp;수정</a></li>
		<li><a href="<?php echo $delete_href ?>" class="btn_b02" onclick="del(this.href); return false;"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp;삭제</a></li>
	</ul>
</div>
<!-- } 게시판 페이지 정보 및 버튼 끝 -->
<?php } ?>

<div class="v_view_wrap">
<div id="view_wrap" class="view_wrap">
	
	    <!-- } 첨부파일 끝 -->
    <div class="view_info row">	
		<div class="boxin col-xs-12">
        	<div class="left_t col-xs-12">
                <h2 style="color: #a0a0ed; font-weight: bold; font-size: 1.8em;"><?php echo $view['subject']; ?></h2>
				<br/><br/><?php echo $com['cnt']?>
				불맛이 일품인 숯불고기짜장
				</div>
            </div>
            <!--<div class="r_info col-xs-12">
            	<div class="info">
                    <h2 class="location">
						<?php if($view['wr_19']) { ?>
						<i class="fa fa-map-marker"></i> 
						<?php echo $view['wr_2']." ".$view['wr_3']; ?>
						<?php } ?>
					</h2>
                    <div class="hours"><span class="st">운영시간</span> <?php echo $view['wr_17']; ?></div>
                    <div class="tel"><span class="st">전화번호</span> <?php echo $view['wr_18']; ?></div>
                </div>
            </div>-->
        </div>
	
	
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php 
			// 파일 출력
			$v_img_count = count($view['file']);
			if($v_img_count) {
				for ($i=0; $i<count($view['file']); $i++) {
					if ($view['file'][$i]['view']) {
						//echo $view['file'][$i]['view'];
						$thumb = get_view_thumbnail($view['file'][$i]['view'], 500);
			?>
			<div class="swiper-slide" style="text-align:center;"><?php echo $thumb; ?></div>
			<?php
					}
				}

				if(!$thumb){
			?>
				<div class="swiper-slide"><img src="<?php echo $board_skin_url;?>/img/noimg.jpg" style="width:100%;"></div>
				<?php } ?>
			<?php }else{ ?>
			<div class="swiper-slide"><img src="<?php echo $board_skin_url;?>/img/none.jpg" style="width:100%;"></div>
			<?php } ?>
		</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>

	
    <!--탭-->
    <figure class="tabBlock">
       <ul class="tabBlock-tabs">
          <li class="tabBlock-tab is-active">지도보기</li>
          <li class="tabBlock-tab">정보</li>
          <li class="tabBlock-tab">가격</li>
          <li class="tabBlock-tab">블로그</li>
          <li class="tabBlock-tab">리뷰</li>
       </ul>
    <div class="tabBlock-content">
       <!--지도-->
       <div class="tabBlock-pane">
          <div id="daum_map" style="width:100%;height:200px; margin-bottom:10px;"></div>
       </div>
       <!--//지도-->
       <!--정보-->
       <div class="tabBlock-pane"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_info.jpg" style=" width:100%"></div>
       <!--//정보-->
       <!--가격-->
       <div class="tabBlock-pane"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_menu.jpg" style=" width:100%">
		                          <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_menu2.jpg" style=" width:100%"></div>
       <!--//가격-->
       <!--블로그-->
       <div class="tabBlock-pane"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_blog.jpg" style=" width:100%"></div>
       <!--//블로그-->
       <!--리뷰-->
       <div class="tabBlock-pane"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_review1.jpg" style=" width:100%">
		                          <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/info_review2.jpg" style=" width:100%"></div>
       <!--//리뷰-->
    </figure>
    <!--//탭-->

<!-- 탭 JS -->
<script>
var TabBlock = {
  s: {
    animLen: 200
  },
  
  init: function() {
    TabBlock.bindUIActions();
    TabBlock.hideInactive();
  },
  
  bindUIActions: function() {
    $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
      TabBlock.switchTab($(this));
    });
  },
  
  hideInactive: function() {
    var $tabBlocks = $('.tabBlock');
    
    $tabBlocks.each(function(i) {
      var 
        $tabBlock = $($tabBlocks[i]),
        $panes = $tabBlock.find('.tabBlock-pane'),
        $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
      
      $panes.hide();
      $($panes[$activeTab.index()]).show();
    });
  },
  
  switchTab: function($tab) {
    var $context = $tab.closest('.tabBlock');
    
    if (!$tab.hasClass('is-active')) {
      $tab.siblings().removeClass('is-active');
      $tab.addClass('is-active');
   
      TabBlock.showPane($tab.index(), $context);
    }
   },
  
  showPane: function(i, $context) {
    var $panes = $context.find('.tabBlock-pane');
   
    // Normally I'd frown at using jQuery over CSS animations, but we can't transition between unspecified variable heights, right? If you know a better way, I'd love a read it in the comments or on Twitter @johndjameson
    $panes.slideUp(TabBlock.s.animLen);
    $($panes[i]).slideDown(TabBlock.s.animLen);
  }
};

$(function() {
  TabBlock.init();
});
</script>
<!-- //탭 JS -->
    
    
    
    <!-- } 첨부파일 끝 -->
    <!--<div class="view_info row">	
            <div class="r_info col-xs-12">
            	<div class="info">
                    <h2 class="location">
						<?php if($view['wr_19']) { ?>
						<i class="fa fa-map-marker"></i> 
						<?php echo $view['wr_2']." ".$view['wr_3']; ?>
						<?php } ?>
					</h2>
                    <div class="hours"><span class="st">운영시간</span> <?php echo $view['wr_17']; ?></div>
                    <div class="tel"><span class="st">전화번호</span> <?php echo $view['wr_18']; ?></div>
                </div>
            </div>
        </div>--><!--boxin-->
        <!--<div class="boxin col-xs-12">
        	<h2 class="strapline">
				소개
			</h2>
			<div class="con">
				<?php echo $view['content']; ?>
			</div>
        </div>--><!--boxin-->
        <!--<div class="boxin col-xs-12">
        	<h2 class="strapline">
				정보
			</h2>
			<div class="con">
				<?php echo $view['wr_17']; ?>
			</div>
			<div class="con">
				<?php echo $view['wr_18']; ?>
			</div>
        </div>--><!--boxin-->
		<?php 
		  //include_once(G5_BBS_PATH.'/view_comment.php'); 
		?>
    </div><!--view_info-->
	</div>
		
<!--view_wrap-->



	<!--탭메뉴시험-->
	

	
		<!--탭메뉴시험끝 -->



<!-- } 게시판 읽기 끝 -->
<?php if(!$is_adm){ ?>
<div class="ap_bottom"> 
	<ul class="row">
		
    	<li class="col-xs-6">
			<a href="<?php if($view['wr_18']) echo "sms:".$view['wr_18']; else echo "javascript:alert('등록된 전화번호가 없습니다.')";?>">
				<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_share.png" style="width: 25px">&nbsp;&nbsp;공유하기
			</a>
		</li>
		
    	<li class="col-xs-6">
            <a href="<?php if($view['wr_18']) echo "tel:".$view['wr_18']; else echo "javascript:alert('등록된 전화번호가 없습니다.')";?>">
				<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_call.png" style="width: 25px">&nbsp;&nbsp;전화하기
			</a>
		</li>
    </ul>
</div>
<?php } ?>
<script>
$(function (){
	var swiper = new Swiper('.swiper-container', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		pagination: '.swiper-pagination',
		paginationType: 'fraction',
		autoplay: 5000,
		loop:true,
	});
});

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

var wr_lat = <?=$view['wr_lat']?>;
var wr_lng = <?=$view['wr_lng']?>;
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

</script>
<!-- } 게시글 읽기 끝 -->
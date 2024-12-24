<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<script src="http://apis.daum.net/maps/maps3.js?apikey=<?php echo $config['cf_10']; ?>&libraries=services"></script> <!-- daum -->
<input type="hidden" name="bo_table" id="bo_table" value="">

<input type="hidden" name="wr_tel" id="wr_tel" value="">

<input type="hidden" name="kakao_title" id="kakao_title" value="">
<input type="hidden" name="kakao_description" id="kakao_description" value="">
<input type="hidden" name="kakao_imageUrl" id="kakao_imageUrl" value="">
<input type="hidden" name="kakao_link" id="kakao_link" value="">

<!--상단 메뉴부분 시작-->
<div class="pjax-header">
    <h1 class="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/logo.png" alt="로고"/></a></h1>
    <div class="btnMenu">
		<a style="color:#FFF; padding-top:7px;" onclick="history.back();">
			<i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
		</a>
    </div>
</div><!--header-->

<!--상단 메뉴부분 끝-->
<div id="pjax_container" class="sub">
	<div id="view_wrap" class="view_wrap">
		<article id="v_content">
			<div class="rows">	
				<h2 id="wr_subject"></h2>
				<dl id="wr_4" class="box-txt"></dl>
				<dl id="wr_event" style="display:none">
					<dd class="box-title01">응답하라 어플혜택 <i class="fa fa-heart" style="color:#d9534f;"></i></dd>
					<dd id="wr_5"></dd>
				</dl>
			</div>

			<div id="swiper_img" class="swiper-container rows">
				<div class="swiper-wrapper">
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
				<!-- Add Arrows -->
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
			
			<!-- 스크랩 추천 비추천 시작 { -->
			<div style="position:relative; width:100%;">
				<dl style="position:absolute; top:-55px; right:5px; z-index:100; ">
					<a href="" id="good_button" style="display:inline-block; background:#FFF; border:1px solid #DBDBDB; padding:0 12px; color:#193366; font-size:1.5em; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;">
					<i class="fa fa-heart"></i>
					</a>
				</dl>
			</div>

			<div id="swiper_vtab" class="swiper-container">
				<dl class="swiper-wrapper">
					<dd class="swiper-slide">업체정보</dd>
					<dd class="swiper-slide">가격</dd>
					<dd class="swiper-slide">블로그</dd>
					<dd class="swiper-slide">리뷰</dd>
				</dl>
			</div>

			<div id="swiper_vcontent" class="swiper-container">
				<dl class="swiper-wrapper">
					<dd class="swiper-slide">
						<div class="box-info">
							<dl>
								<table>
									<tbody>
										<tr>
											<th><p>주소</p></th>
											<td id="wr_addr"><?php echo $view['wr_addr1']?> <?php echo $view['wr_addr2']?></td>
										</tr>
										<tr>
											<th><p>영업시간</p></th>
											<td id="wr_1v"><?php echo $view['wr_1'];?></td>
										</tr>
										<tr>
											<th><p>휴무일</p></th>
											<td id="wr_2"><?php echo $view['wr_2'];?></td>
										</tr>
										<tr>
											<th><p>주차시설</p></th>
											<td id="wr_3"><?php echo $view['wr_3'];?></td>
										</tr>
										<tr>
											<th><p>소개</p></th>
											<td id="vwr_content"><?php echo $view['content'];?></td>
										</tr>
										<tr>
											<th colspan="2">
												<input type="hidden" name="wr_lat" id="wr_lat" value="0">
												<input type="hidden" name="wr_lng" id="wr_lng" value="0">
												<p id="daum_view" onclick="setDaumMap()">지도보기</p>
											</th>
										</tr>
										<tr>
											<td colspan="2"><div id="daum_map" style="display:none;"></div></td>
										</tr>
									</tbody>
								</table>
							<dl>
						</div>
					</dd>
					<dd class="swiper-slide">
						<div id="wr_price" >
							<div class="row box-price">
								
							</div>
						</div>
					</dd>
					<dd id="pjax_frame" class="swiper-slide">

					</dd>
					<dd id="review_slide" class="swiper-slide">
						
					</dd>
				</dl>
			</div>

			<!-- } 게시판 읽기 끝 -->
			<div id="ap_bottom" class="ap_bottom"> 
				<ul class="row">
				
					<li class="col-xs-6">
						<a id="kakao-link-btn" href="javascript:sendLink();">
							<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_share.png" style="width: 25px">&nbsp;&nbsp;공유하기
						</a>
					</li>
				
					<li class="col-xs-6">
						<a href="javascript:telCall();">
							<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/b_call.png" style="width: 25px">&nbsp;&nbsp;전화하기
						</a>
					</li>
				</ul>
			</div>
		</article>
	</div>
</div>

<script>
var swiperVcontent, swiperImg, swiperVtab;

var view_on = function (result){
	$("#bo_table").html(result.bo_table);
	$("#wr_subject").html(result.wr_subject);
	$("#vwr_content").html(result.wr_content);
	
	/*
	if(result.wr_5)
		$("#wr_event").css("display", "");
	*/

	$("#wr_1v").html(result.wr_1);
	$("#wr_2").html(result.wr_2);
	$("#wr_3").html(result.wr_3);
	$("#wr_4").html(result.wr_4 + "&nbsp;");
	$("#wr_5").html(result.wr_5);
	$("#wr_addr").html(result.wr_addr1 + " " + result.wr_addr2);

	var viewImg;
	for(var i=0; i<result.thumb.length; i++){
		if(result.thumb[i]){
			viewImg = $("<div/>", {
						class: "swiper-slide swiper-img text-center"
					});
			viewImg.html('<img src="'+result.thumb[i]+'">');
			$("#swiper_img .swiper-wrapper").append(viewImg);
		}
	}
	
	$("#wr_lat").val(result.wr_lat);
	$("#wr_lng").val(result.wr_lng);

	$("#kakao_title").val(result.wr_subject);
	$("#kakao_description").val(result.wr_content);
	$("#kakao_imageUrl").val(result.kakao_thumb);
	$("#kakao_link").val("<?php echo G5_BBS_URL?>/board.php?bo_table="+result.bo_table+"&wr_id="+result.wr_id);
	
	$("#wr_tel").val(result.wr_tel);
	
	$("#good_button").attr("src", '<?php echo G5_BBS_URL?>/good.php?bo_table='+result.bo_table+'&wr_id='+result.wr_id+'&good=good');
	
	var iframe = $("<iframe/>", {
					style : "display:none; width:100%; height:300px;",
					src : "http://m.blog.naver.com/SectionPostSearch.nhn?searchValue="+result.wr_subject
	});
	$("#pjax_frame").html(iframe);
	
	iframe.load(function(e){
		iframe.css("display", "");
	});

	swiperImg = new Swiper('#swiper_img', {
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		pagination: '.swiper-pagination',
		paginationType: 'fraction',
		autoplay: 8000,
		autoHeight: true,
		loop:true,
		lazy:true
	});
		
	swiperVtab = new Swiper('#swiper_vtab', {
		slidesPerView: 4,
		autoHeight: "auto"
	});	      
	
	swiperVcontent = new Swiper('#swiper_vcontent', {
		autoHeight: "auto"
	});
	
	setTimeout(function (){
		$.get("<?php echo G5_BBS_URL;?>/pjax.price.php?bo_table="+result.bo_table+"&wr_id="+result.wr_id, function (e){
			$("#wr_price").html(e);
			swiperVcontent.update();
		});

		$.get("<?php echo G5_BBS_URL;?>/pjax.review.php?bo_table="+result.bo_table+"&wr_id="+result.wr_id, function (e){
			$("#review_slide").html(e);
			setTimeout(function (){
				swiperVcontent.update();
			}, 2000);
		});
	}, 1000);

	swiperVcontent.on('transitionStart', function (e) {
		var idx = parseInt(e.activeIndex);
		var i = idx - 1;
		tabsOn(swiperVtab, idx, i, 300);
	});

	$("#swiper_vtab dd").click(function (){
		var idx = parseInt($("#swiper_vtab dd").index(this));
		var i = idx;
		tabsOn(swiperVcontent, idx, i, 300);
	});
	
	// Tabs move
	function tabsOn(tab, idx, i, speed){
		$("#swiper_vtab dd").removeClass("on");
		$("#swiper_vtab dd").eq(idx).addClass("on");
		$("#swiper_vcontent").css("height", "auto");
		tab.slideTo(i, speed);
	}

	tabsOn(swiperVtab, 0, 0, 0); // 시작시 타겟으로가게
	swiperVcontent.slideTo(0, 0);
	
	$("#view_wrap").css("min-height", $(window).height() - 60);

	$("#pjax_contanier").scroll(function (e){
		var h = $(this).scrollTop() * (-1);
		$("#ap_bottom").css("bottom", h);
	});
	
	$("#ap_bottom").css("bottom", 0);

	setTimeout(function (){
		swiperVcontent.update();
	}, 5000);

	setTimeout(function (){
		swiperVcontent.update();
	}, 10000);
}

function setDaumMap(){
	var wr_lat = $("#wr_lat").val();
	var wr_lng = $("#wr_lng").val();

	if($("#daum_map").css("display") == "none"){
		$("#daum_map").css("display", "");
		$("#daum_view").html("지도닫기");
	}else{
		$("#daum_map").css("display", "none");
		$("#daum_view").html("지도보기");
	}

	swiperVcontent.update();

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
}

// // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
function sendLink() {
	var title = $("#kakao_title").val();
	var description = $("#kakao_imageUrl").val();
	var imageUrl = $("#kakao_imageUrl").val();
	var link = $("#kakao_link").val();

  Kakao.Link.sendDefault({
	objectType: 'feed',
	content: {
	  title: title,
	  description: description,
	  imageUrl: imageUrl,
	  link: {
		mobileWebUrl: link,
		webUrl: link
	  }
	},
	buttons: [
	  {
		title: '앱으로 보기',
		link: {
		  mobileWebUrl: link,
		  webUrl: link
		}
	  }
	]
  });
}

function telCall(){
	var num = $("#wr_tel").val();
	location.href= "tel:"+num;
}

$("#pjax_view").scroll(function (){
	var h = $(this).scrollTop() * -1;
	$("#ap_bottom").css("bottom", h);
});
</script>
<!-- } 게시글 읽기 끝 -->
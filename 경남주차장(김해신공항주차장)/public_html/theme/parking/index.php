<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" href="<?=G5_CSS_URL?>/datepicker.css"/>

<script>
	

    $(function() {
        $("#wr_1,#wr_2").datepicker({
			dateFormat: 'yy-mm-dd',
			buttonImage:"./theme/parking/img/common/icon_calendar.png",
			buttonImageOnly:true,
			showOn:'both',
			prevText: '이전 달',
			nextText: '다음 달',
			monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
			dayNames: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
			dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
			showMonthAfterYear: true,
			yearSuffix: '년'
		});
		//주차장 선택할 때...
		$(".parkname input[type=radio]").click(function(){
			
			var parkname=$(this).val();
			$.ajax({
				url:"<?=G5_BBS_URL?>/ajax.full.check.php",
				type: 'POST',
				data: {"parkname":$(this).val()},
				dataType:"html",
				success: function(data) { 
					if(data=="1"){
						/*
						$("#modal-parkcheck").html(parkname+" 주차가 가능합니다.");
						
						isParkcheck=true;
						$(".mailform input").attr("disabled",false);
						$(".mailform textarea").attr("disabled",false);*/
						isParkcheck=true;
						alert(parkname+" 주차가 가능합니다.");
					}else{
						alert(parkname+" 주차가 불가능합니다.");
						isParkcheck=false;
						/*$("#modal-parkcheck").html(parkname+" 주차가 <font style='color:red;font-weight'>불가능</font>합니다.");
						
						isParkcheck=false;
						$(".mailform input").attr("disabled",true);
						$(".mailform textarea").attr("disabled",true);*/
					}
				},
				error: function(jqXHR, textStatus, errorThrown) { alert(textStatus);/* Handle error */ },
			});
		});
    });
	
</script>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>

    <h2 class="hidden">메인롤링</h2>
    <div id="rolling_tab" class="swiper-container">
        <!--shape-->
        <div class="shape wow fadeInRight" data-wow-delay='0.5s'><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_visual_shape.png" alt=""></div>
        <!--//shape-->
        <div class="m_text">
                <h3 class="wow fadeInDown" data-wow-delay="0.1s">김해국제공항 - 경남주차장<br />최고의 주차설비를 자랑합니다.</h3>
                <p class="wow fadeInDown" data-wow-delay="0.3s">김해국제공항 인근 세차 및 타이어 경정비 그리고<br class="hidden-lg hidden-sm" /> 주차대행 서비스를 최고로 자랑합니다.</p>
                <!--<p class="t_margin20 wow fadeIn"  data-wow-delay="0.7s"><span>환자의 생활이 불편함이 없도록 모든 부분에 섬세하게 배려하는 엘 앤더슨입니다.</span></p>-->
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide m01"></div>
            <div class="swiper-slide m02"></div>
            <div class="swiper-slide m03"></div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
        <!-- Add Arrows -->
        <!--<div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>-->
    </div>



    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper('#rolling_tab', {
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
		loop:true,
		effect: 'fade'
    });
	function formCheck(){
		if(isParkcheck==false){
			alert("주차가 불가능한 주차장을 체크하셨습니다. 다른 주차장을 체크하신 후에 예약을 하실 수 있습니다.");
			return false;
		}
	}
    </script>


    <h2 class="hidden">메인컨텐츠</h2>
       <div id="m_con">
           <div class="m_content_area">
               <div class="m_content00">
                  <div class="clearfix">
                      <div class="col-md-6 col-xs-12 m_box">
                          <h3 class="text-left t wow fadeInDown" data-wow-delay='0.1s'>최저가 주차요금</h3>
                          <!--<p class="text-left c wow fadeInDown" data-wow-delay='0.1s'>※ 입차 첫 날 <span> 7,000원</span>입니다.<p>-->
                          <p class="text-left c wow fadeInDown" data-wow-delay='0.1s'>평일기준<span> 10,000원</span>
                          <br class="hidden-sm hidden-xs" />주말요금(금,토,일,공휴일) 15,000원 / 단 1일만 주차시 20,000원
                          <br class="hidden-sm hidden-xs" />최상의 친절, 신속, 정확한 서비스로 보답하겠습니다.</p>
                          <div class="clearfix t_margin40 c wow bounceIn" data-wow-delay='0.5s'><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=info02" class="m_btn00">주차비 요금 확인하기</a></div>
                      </div>
                      <div class="col-md-6 col-xs-12">
                            <div class="box02 wow fadeInDown" data-wow-delay='0.5s'>
                                <h3 class="text-left t">카카오톡 채널</h3>
                                <p class="text-left c">카카오채널 친구 맺고<br class="hidden-sm hidden-xs" />다양한 정보와 혜택을 <br class="hidden-sm hidden-xs" /> 받으세요.</p></a>
                                <a href="javascript:alert('준비중입니다.');" onfocus="this.blur() style="cursor: pointer" title="김해신공항주차장 카카오톡 채널 바로가기"><p class="more"></p></a>
                            </div>
                            <div class="box01 wow fadeInDown" data-wow-delay='0.3s'></div>
                      </div>
                    </div><!--//clearfix--> 
                  </div><!--//m_content00-->
            </div>


            <div class="blue_area" style="background-color:#fff">
                <h3 class="wow fadeInUp" data-wow-delay='0.1s'>예약하기</h3>
                <p class="wow fadeInUp" data-wow-delay='0.3s'>원하시는 날짜를 선택하시고, 예약하기를 눌러주세요.</p>
                <form name="form" method="get" action="<?=G5_BBS_URL?>/write.php" onsubmit="return formCheck()">
				<input type="hidden" name="bo_table" value="b_reserv">
				
				
                <!--예약필드-->
                <div class="reserv_wrap wow fadeInUp" data-wow-delay='0.5s'>
				
<!--<div class="radio_group parkname" style="padding:10px">
        <span><input type="radio" name="" id="01" value="명성주차장" required="">
        <label for="01">명성주차장</label></span>
        <span><input type="radio" name="" id="02" value="유니티주차장" required="">
        <label for="02">유니티주차장</label></span>
        <br class="hidden-lg hidden-md hidden-sm" />
        <span><input type="radio" name="" id="03" value="유카주차장" required="">
        <label for="03">유카주차장</label></span>
        <span><input type="radio" name="" id="04" value="신공항주차장" required="">
        <label for="04">신공항주차장</label></span>
</div>
-->
                     <ul>
                          <li><input name="wr_1[0]" id="wr_1" type="text" placeholder="이용예정일시"><!--<a class="btn_pin" href="#none" title="이용예정일시 캘린더 열림">날짜 선택</a>-->
                          </li>
                          <li>
                              <select name="wr_1[1]" class="select" id="" style="">
                                    <? for($i=6;$i<21;$i++){
										$hour=$i<10?"0".$i:$i;
										if($i!=0&&$i<6){
										}else{
									?>
									<option value="<?=$hour?>:"><?=$hour?>시</option>
									<? }}?>
							  </select>
                          </li>
                          <li>
                              <select name="wr_1[2]" class="select" id="" style="">
                                     <? for($i=0;$i<60;$i++){
											$min=$i<10?"0".$i:$i;
									 ?>
									 <option value="<?=$min?>"><?=$min?>분</option>
									 <? }?>
							  </select>
                          </li>
                          <li><input name="wr_2[0]" id="wr_2" type="text" placeholder="도착예정일시"><!--<a class="btn_pin" href="#none" title="도착예정일시 캘린더 열림">날짜 선택</a>--></li>
                          <li>
                              <select name="wr_2[1]" class="select" id="" style="">
                                    <? for($i=6;$i<21;$i++){
										$hour=$i<10?"0".$i:$i;
									?>
									<option value="<?=$hour?>:"><?=$hour?>시</option>
									<? }?>
							  </select>
                          </li>
                          <li>
                              <select name="wr_2[2]" class="select" id="" style="">
                                     <? for($i=0;$i<60;$i++){
											$min=$i<10?"0".$i:$i;
									 ?>
									 <option value="<?=$min?>"><?=$min?>분</option>
									 <? }?>
							  </select>
                          </li>
                          <input type="submit" value="예약하기" class="btn_reserv">
                     </ul> 
                </div>
				</form>
                <!--//예약필드-->
                <div class="cl"></div>
                <div class="t_margin40 wow bounceIn" data-wow-delay='0.7s'><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_reserv" class="m_btn01">예약확인</a></div>
            </div><!--m_blue_area-->
    
    
            <div class="gray_area">
                <h3 class="wow fadeInUp" data-wow-delay='0.1s'>COMPORTABLE OF CUSTOMER</h3>
                <p class="wow fadeInUp" data-wow-delay='0.2s'>고객님의 편안한 여행과 비즈니스를 위해 최선을 다하겠습니다.</p>
                <ul class="b_dong">
                    <a href="javascript:alert('준비중입니다.')"><li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay='0.1s'>
                        <div class="img_area"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_busi01.jpg" alt="" /></div>
                        <h4>발렛 서비스</h4>
                        <div>고객님들의 편의를 위해<br class="hidden-xs" />발렛서비스를 실시하고 있습니다.</div>
                    </li></a>
                    <a href="javascript:alert('준비중입니다.')"><li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay='0.2s'>
                        <div class="img_area"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_busi02.jpg" alt="" /></div>
                        <h4>대리운전</h4>
                        <div>고객님들의 편의를 위해<br class="hidden-xs" />발렛서비스를 실시하고 있습니다.</div>
                    </li></a>
                    <a href="javascript:alert('준비중입니다.')"><li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay='0.3s'>
                        <div class="img_area"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_busi03.jpg" alt="" /></div>
                        <h4>타이어/경정비</h4>
                        <div>고객님들의 편의를 위해<br class="hidden-xs" />발렛서비스를 실시하고 있습니다.</div>
                    </li></a>
                </ul>
            </div><!--gray_area-->

    </div>

<?php
include_once(G5_PATH.'/tail.php');
?>
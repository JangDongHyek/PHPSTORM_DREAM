<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div id="idx_wrapper">
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0s" data-wow-duration="1.5s">
          <div class="swiper-container-v">
            <div class="swiper-wrapper">
              <div class="swiper-slide v1"></div>
              <div class="swiper-slide v2"></div>
              <div class="swiper-slide v3"></div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <script>
		   var swiper = new Swiper('.swiper-container-v', {
			  spaceBetween: 0,
			  loop: true,
			  centeredSlides: true,
			  autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			  },
			  pagination: {
				el: '.swiper-pagination',
				clickable: true,
			  },
			  navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			  },
			});
          </script>

        <div class="slogan">
            <p class="wow fadeInUp animated" data-wow-delay="2s" data-wow-duration="2s">
                Make your trip, silla Tour
            </p>
            <h2 class="wow fadeInDown animated" data-wow-delay="2s" data-wow-duration="2s">
            	<strong>신라투어와 함께</strong><br class="visible-xs"><span>더 편안하고 쾌적한 여행을!</span>
            </h2>
        </div>
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="idx_container">
	<div id="middle">
    <div class="container">
        <div class="title">
       		<img src="<?php echo G5_THEME_IMG_URL ?>/main/mdl_logomark.png" alt="">
            <h3><strong>SILLA</strong> TOUR</h3>
            <span>여러분의 삶에 행복을 전하는 (주)신라투어입니다.</span>
        </div>
        <div class="bn">
        	<ul>
            	<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=car01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mdl_ico01.png" alt=""><p>차량소개</p></a></li>
            	<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=travel01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mdl_ico02.png" alt=""><p>해외여행</p></a></li>
            	<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=city01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mdl_ico03.png" alt=""><p>부산시티투어</p></a></li>
            	<li><a href="#inqry"><img src="<?php echo G5_THEME_IMG_URL ?>/main/mdl_ico04.png" alt=""><p>견적의뢰</p></a></li>
            </ul>
        </div>
    </div>
    </div>
    <!--//middle -->
    <div id="middle2">
    <div class="container">
    	<ul>
    	<li class="col-sm-6 col-xs-12 tour_bn">
        	<h3>해외여행의 <strong>다양한 정보</strong>를 알고 싶다면?</h3>
            <p>신라투어 여행정보에서 지금바로 확인해보세요!</p>
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=travel01">여행정보 바로가기 <i class="fas fa-plus"></i></a>
        </li>
        <li class="col-sm-6 col-xs-12 idx_cus">
        	<h3>신라투어 예약센터</h3>
            <div class="tel">051.<strong>553.1133</strong></div>
            <p>평일 09:00 ~ 18:00&nbsp;&nbsp;|&nbsp;&nbsp;토일공휴일 휴무</p>
            <span>견적확인 후 예약하시면 더 편리하게 이용할 수 있습니다.</span>
        </li>
        </ul>
	</div>    
    </div>
    
    <div id="about_bn">
    <div class="container">
    	<div class="title">
    	<h3>행복을 전하는 <strong>(주)신라투어</strong></h3>
        <span>Make your trip with silla Tour</span>
        </div>
        
        <div class="txt">
        여러분의 행복한 여행에 저희 신라투어가 함께합니다.<br>
        기업체 수송, 학교 단체여행, 부산에서 열리는 각종 국제행사 /컨벤션 수송을  담당하고있습니다. <br>
        다양한 행사를 편안하고 안전하게 마칠 수 있도록 언제나 최선을 다하겠습니다.
        </div>
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=about01">신라투어 소개 바로가기 <i class="fas fa-arrow-right"></i></a>
    </div>
    </div>
    
    
</div><!-- #idx_container -->


<?php

$board = sql_fetch(" select * from g5_board where bo_table = 'inquiry' ");
$categoryArr = get_category_option("inquiry");

$carTypeArr = array("차량1", "차량2");
$driveArr = array("운행1", "운행2");
$costArr = array("부대비용1", "부대비용2");

?>

<!-- 견적문의등록 -->
<div id="inqry">
<div class="container">
<div class="title">
	<h3>신라투어 <strong>견적문의</strong></h3>
    <span>신라투어에서 이용하고 싶은 서비스를 온라인으로 문의하 실 수있습니다. </span>
</div>
<div id="inqryArea">
	<div class="text-right"><i class="fas fa-asterisk"></i>필수입력사항입니다</div>
	<form name="regFrm" action="<?=G5_BBS_URL?>/write_update.php" method="post">
		<input type="hidden" name="bo_table" value="inquiry">
		<input type="hidden" name="wr_subject" value="견적문의">
		<input type="hidden" name="wr_password" value="0000">
		<input type="hidden" name="wr_id" value="비회원">
		<input type="hidden" name="wr_email" value="">
		<table>
			<tr>
				<th><i class="fas fa-asterisk"></i>이름</th>
				<td><input type="text" name="wr_name" maxlength="20"></td>
				<th><i class="fas fa-asterisk"></i>연락처</th>
				<td><input type="text" name="wr_content" maxlength="13"></td>
			</tr>
			<tr>
				<th><i class="fas fa-asterisk"></i>여행구분</th>
				<td colspan="3">
					<select name="ca_name">
						<option value="">선택하세요</option>
						<?=$categoryArr?>
					</select>
				</td>
			</tr>
			<tr>
				<th><i class="fas fa-asterisk"></i>출발일~회차일</th>
				<td colspan="3"><input type="text" name="wr_1" placeholder="출발일" readonly style="width:45%;"> ~ <input type="text" name="wr_2" placeholder="회차일" readonly style="width:45%;"></td>
			</tr>
			<tr>
				<th><i class="fas fa-asterisk"></i>출발시간/장소</th>
				<td colspan="3">
					<select name="wr_3">
						<option value="">선택</option>
						<? for ($i = 0; $i < 24; $i++) { ?>
						<option value="<?=sprintf('%02d', $i)?>"><?=sprintf('%02d', $i)?></option>
						<? } ?>
					</select>시 
					<select name="wr_4">
						<option value="">선택</option>
						<? for ($i = 0; $i < 60; $i++) { ?>
						<option value="<?=sprintf('%02d', $i)?>"><?=sprintf('%02d', $i)?></option>
						<? } ?>
					</select>분
					<input type="text" name="wr_5" placeholder="출발장소" maxlength="50">
				</td>
			</tr>
			<tr>
				<th>경유지</th>
				<td><input type="text" name="wr_6" maxlength="50"></td>
				<th><i class="fas fa-asterisk"></i>목적지</th>
				<td><input type="text" name="wr_7" maxlength="50"></td>
			</tr>
			<tr>
				<th><i class="fas fa-asterisk"></i>차량종류/대수</th>
				<td>
					<select name="wr_8">
						<option value="">차량종류</option>
						<? for ($i = 0; $i < count($carTypeArr); $i++) { ?>
						<option value="<?=$carTypeArr[$i]?>"><?=$carTypeArr[$i]?></option>
						<? } ?>
					</select>
					<select name="wr_9">
						<option value="">차량대수</option>
						<? for ($i = 1; $i < 11; $i++) { ?>
						<option value="<?=$i?>"><?=$i?></option>
						<? } ?>
					</select>
				</td>
				<th><i class="fas fa-asterisk"></i>운행구분</th>
				<td>
					<select name="wr_10">
						<option value="">선택하세요</option>
						<? for ($i = 0; $i < count($driveArr); $i++) { ?>
						<option value="<?=$driveArr[$i]?>"><?=$driveArr[$i]?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th><i class="fas fa-asterisk"></i>부대비용</th>
				<td colspan="3">
					<select name="wr_11">
						<option value="">선택하세요</option>
						<? for ($i = 0; $i < count($costArr); $i++) { ?>
						<option value="<?=$costArr[$i]?>"><?=$costArr[$i]?></option>
						<? } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>단체명</th>
				<td colspan="3"><input type="text" name="wr_12" maxlength="50"></td>
			</tr>
			<tr>
				<th>요청사항</th>
				<td colspan="3"><textarea name="wr_13"></textarea></td>
			</tr>
		</table>
        <div class="submit_btn">
        <input type="button" class="btn" id="btnSubmit" value="견적요청">
        <?php if ($is_admin) {  ?><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=inquiry" class="btn">견적문의리스트</a><?php }  ?>
        </div>
	</form>
</div>
</div>
</div>
<!-- // 견적문의등록 -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
$(function(){
	var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
	var day_arr = ['일', '월', '화', '수', '목', '금', '토'];

	$("input[name=wr_1], input[name=wr_2]").datepicker({ 
		changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, monthNames: month_arr, monthNamesShort: month_arr, dayNames : day_arr, dayNamesShort : day_arr, dayNamesMin : day_arr
	}); 

	$("input[name=wr_content]").on("keyup", function(e) {
		var _val = $.trim($(this).val());
		$(this).val(validatePhone(_val));
	});

	$("#btnSubmit").on("click", function() {
		var f = document.regFrm;

		// 필수항목 체크
		if (f.wr_name.value == "") {
			alert("이름을 입력하세요.");
			f.wr_name.focus();
			return false;
		}

		if (f.wr_content.value == "") {
			alert("연락처를 입력하세요.");
			f.wr_content.focus();
			return false;
		}

		if (f.ca_name.value == "") {
			alert("여행구분을 선택하세요.");
			f.ca_name.focus();
			return false;
		}

		if (f.wr_1.value == "") {
			alert("출발일을 선택하세요.");
			f.wr_1.focus();
			return false;
		}

		if (f.wr_2.value == "") {
			alert("회차일을 선택하세요.");
			f.wr_2.focus();
			return false;
		}

		if (f.wr_3.value == "") {
			alert("출발시간을 선택하세요.");
			f.wr_3.focus();
			return false;
		}

		if (f.wr_4.value == "") {
			alert("출발시간(분)을 선택하세요.");
			f.wr_4.focus();
			return false;
		}

		if (f.wr_5.value == "") {
			alert("출발장소를 입력하세요.");
			f.wr_5.focus();
			return false;
		}

		if (f.wr_7.value == "") {
			alert("목적지를 입력하세요.");
			f.wr_7.focus();
			return false;
		}

		if (f.wr_8.value == "" || f.wr_9.value == "") {
			alert("차량종류/대수를 선택하세요.");
			f.wr_8.focus();
			return false;
		}

		if (f.wr_10.value == "") {
			alert("운행구분을 선택하세요.");
			f.wr_10.focus();
			return false;
		}

		if (f.wr_11.value == "") {
			alert("부대비용을 선택하세요.");
			f.wr_11.focus();
			return false;
		}

		f.submit();

		/*
		//queryString = $("form[name=regFrm]").serialize();
		var queryString = serialize(f);

		$.ajax({
			type : "get",  
			url : g5_bbs_url + "/write_update.php?" + queryString,
			//data : queryString,
			dataType : "text",  
			success : function(result){  
				console.log(result);
				var msg = "견적요청이 완료되었습니다.";
				if (result == "0")
					msg = "견적요청에 실패하였습니다. 다시 시도해 주세요.";
				alert(msg);
			}, 
			error : function(xhr,status,error) {
				console.log(error);
			}
		});
		*/
	});

});
</script>


<?php
include_once(G5_PATH.'/tail.php');
?>
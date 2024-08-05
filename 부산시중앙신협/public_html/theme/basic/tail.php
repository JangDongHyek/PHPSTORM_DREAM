<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
		<? if($bo_table){ ?>

		</div>
		<!-- /bdpd -->
			<? } ?>
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<? if($pid=="qr_span"){ ?>
	<div id="ft_qr">
		<a onclick="atw_qrscan(1)" class="btn_gold">전면 스캔하기</a>
		<a onclick="atw_qrscan(2)" class="btn_brown">후면 스캔하기</a>
	</div>

<? }else if($pid=="use_point"){ ?>
<div id="ft_qr" class="btn_gradi">
	<a id="btn_use_point" onclick="use_point()">포인트 사용하기</a>
</div>

<? }else if($pid=="use_point_com"){ ?>
<div id="ft_qr" class="btn_gray">
	<a href="./qr_span.php">스캔화면 돌아가기</a>
</div>

<? }else { ?>

<div id="ft_menu">
	<ul>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/mypage.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu01.png" alt="">MY멤버십
			</a>
		</li>
		<li>
            <a href="<?php echo G5_BBS_URL ?>/coupon_list.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu06.png" alt="">쿠폰
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/golf_order_form.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_02<?php if($co_id == "golf_center"){ echo ""; } ?>.png" alt="">골프예약
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=cucenter">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_03<?php if($co_id == "cu_center"){ echo ""; } ?>.png" alt="">문화센터
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu05.png" alt="">이벤트
			</a>
		</li>
	</ul>
</div>

	<? if(defined('_INDEX_')) {?>

	<? }else if($co_id=="provision"){ ?>	
	</div></div>
	</section>

    <? }else { ?>

 
   	<? } ?> 
<? } ?> 


<!-- 하단 시작 { -->
	<div id="footer">
		<div class="inr">
			<h1 class="f_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/f_logo.png" alt="부산시중앙신협"></h1>

				<ul class="footbox">
					<li>
						<p class="tit">Contact</p>
						<p class="txt">
							<span><?php echo $config['cf_1']; ?></span>
							<span><?php echo $config['cf_2_subj']; ?><em><?php echo $config['cf_2']; ?></em></span>
							<span><?php echo $config['cf_3_subj']; ?><em><?php echo $config['cf_3']; ?></em></span>
							<span><?php echo $config['cf_4_subj']; ?><em><?php echo $config['cf_4']; ?></em></span>
							<span><?php echo $config['cf_5_subj']; ?><em><?php echo $config['cf_5']; ?></em></span>
						</p>
					</li>
					<li>
						<p class="tit">Follow us</p>
						<p class="txt">
							<a href="#Link" class="ico_kakao">카카오채널</a>
							<a href="#Link" class="ico_insta">인스타그램</a>
							<a href="#Link" class="ico_band">카카오채널</a>
							<a href="#Link" class="ico_youtube">유튜브</a>
							<a href="#Link" class="ico_blog">블로그</a>
						</p>
					</li>

					<li>
						<p class="tit">Family site</p>
						<div class="selecBox">
							<a href="#" class="selBtn">패밀리사이트 바로가기</a>
							<ul class="selList" style="display:none">
								<li><a href="#" target="_blank">부산시신협</a></li>
								<li><a href="#" target="_blank">부산시신협</a></li>
								<li><a href="#" target="_blank">부산시신협</a></li>
							</ul>
						</div>
					</li>
				</ul>
            </div>

		<div class="fot_btm">
			<div class="inr">
				<p class="copy">COPYRIGHT(C) 2021 <strong><?php echo $config['cf_title']; ?>. </strong> ALL RIGHTS RESERVED.</p>
				<p class="f_btn"><a href="#">고객센터</a><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a><a href="#">개인정보처리방침</a><a href="/adm">관리자</a></p>
			</div>
		</div>
        </div><!-- inr -->
	</div><!--#footer--> 
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd.subVer" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});

function smsSubmit(f){
	if(f.sms_name.value == ""){
		alert("이름을 작성해주시길 바랍니다.");
		f.sms_name.focus();
		return false;
	}

	if(f.sms_tel.value == ""){
		alert("전화번호를 작성해주시길 바랍니다.");
		f.sms_tel.focus();
		return false;
	}

	if(f.sms_tel.value.length < 10){
		alert("전화번호가 너무 짧습니다. 확인 후 다시 문의해주시길 바랍니다.");
		f.sms_tel.focus();
		return false;
	}

	if(f.sms_content.value == ""){
		alert("문의내용을 작성해주시길 바랍니다.");
		f.sms_content.focus();
		return false;
	}
}

function number_only(num) {
	num = num.replace(/[^0-9]/gi, ""); 
	return num ;
}

function atw_qrscan(mode){

	try {
		window.dreamforone.qrSacn(mode);
	} catch (error) {
		window.dreamforone.qrSacn();
	}

	
}

// 문자 68바이트 이상 입력 방지
function fnChkByte(obj) {
	var maxByte = 68; //최대 입력 바이트 수
	var str = obj.value;
	var str_len = str.length;
 
	var rbyte = 0;
	var rlen = 0;
	var one_char = "";
	var str2 = "";
 
	for (var i = 0; i < str_len; i++) {
		one_char = str.charAt(i);
 
		if (escape(one_char).length > 4) {
			rbyte += 2; //한글2Byte
		} else {
			rbyte++; //영문 등 나머지 1Byte
		}
 
		if (rbyte <= maxByte) {
			rlen = i + 1; //return할 문자열 갯수
		}
	}
 
	if (rbyte > maxByte) {
		alert("한글 " + (maxByte / 2) + "자 / 영문 " + maxByte + "자를 초과 입력할 수 없습니다.");
		str2 = str.substr(0, rlen); //문자열 자르기
		obj.value = str2;
		fnChkByte(obj, maxByte);
	} else {
		document.getElementById('byteInfo').innerText = rbyte;
	}


}
  //상단고정
        if( $("#hd.subVer").length ){
            var jbOffset = $("#hd.subVer").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '#hd.subVer' ).addClass( 'fixed' );
                }
                else {
                    $( '#hd.subVer' ).removeClass( 'fixed' );
                }
            });
        }

</script>


<script>
	var myAOS = function() {
		AOS.init({
		   easing: 'ease-out-back',
		   duration: 1500
		});
	}

	myAOS();
</script>


	<script type="text/javascript">
	skrollr.init({
		smoothScrolling: true,
		mobileDeceleration: 0.003,
		forceHeight: false
	});



	</script>



<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->


<!-- 하단 시작 { -->
<div id="footer">
	<div class="area_ft">
		<div class="inr">
			<div class="ft_cs">
				<span>고객센터 이용안내</span>
				<h2><a href="tel:031-457-2960">031.457.2960</a></h2>
				<h2 class="last" style="padding:0 0 10px;"><a href="tel:010-5715-2960">010.5715.2960</a></h2>
				<em>월요일 ~ 목요일 10 : 00 ~ 16 : 00</em>
				<em>kaft1@naver.com</em>
			</div>
			<ul class="foot_menu">
				 <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=policy01">이용약관</a></li>  
				 <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=policy02">개인정보처리방침</a></li>
				 <?php if ($is_member) {  ?>
				 <?php if ($is_admin) {  ?>
				 <?php }  ?>
				 <li><a href="<?php echo G5_URL ?>/adm">관리자</a></li>
				 <?php } else {  ?>
				 <li><a href="<?php echo G5_BBS_URL ?>/login.php">관리자</a></li>	
				 <?php }  ?>
			</ul>
			<address>
				<div class="ft_left">
					<span>(사)한국인형치료학회</span><Br>
					<span>(06121) 서울특별시 강남구 봉은사로 129-1, 7층 702-LS24호</span><Br>
					<span><strong>고유번호</strong>222-82-09738</span>
					<span><strong>대표</strong>선우현</span>
					<span><strong>TEL</strong>010.5715.2960</span>
					<span><strong>EMAIL</strong>kaft1@naver.com</span>
					<span><strong>개인정보책임관리자</strong>최재일</span>
				</div>
				<div class="ft_right">
					<span>한국인형치료연구회</span><Br>
					<span>(15828)경기도 군포시 번영로557번길 18, 3층(금정동)</span><Br>
					<span><strong>사업자등록번호</strong>422-96-00130</span>
					<span><strong>대표</strong>최재일</span>
					<span><strong>TEL</strong>031.457.2960</span>
					<span><strong>EMAIL</strong>kaft1@naver.com</span>
					<span><strong>개인정보책임관리자</strong>최재일</span>
				</div>
			</address>	
			<p class="co">COPYRIGHT(c) 2020 <strong><?php echo $config['cf_title']; ?>. </strong> ALL RIGHTS RESERVED.</p>
			<div id="btn_top">
				<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
				<!--<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>-->
			</div>
		</div>
	</div>
</div><!--#footer--> 
 

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
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

<hr>



<!-- 하단 시작 { -->
	<div id="footer">
		<div class="foot_menu_bg">
			<ul class="foot_menu cf">
				<li class="col-xs-6 col-sm-6"><a href="<?php echo G5_THEME_URL ?>/catalog/greenysystem.pdf" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/catalog.png" alt="top"> &nbsp;Download Catalog</a></li>
				<li class="col-xs-6 col-sm-5"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=ceri"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ceri.png" alt="top"> &nbsp;Certificate/patent status</a></li>
				<li class="last hidden-xs col-sm-1"><a href="#hd"><img src="<?php echo G5_THEME_IMG_URL ?>/main/top_icon.png" alt="top"></a></li>
			</ul>
		</div><!--.foot_menu-->
    	<div class="footer_in">
			<address class="col-xs-12 col-sm-8">
            	<h1>GreemySystem Co.,Ltd.</h1>
				<p><span><strong>Address</strong>&nbsp;&nbsp; (617-25 Yulsaeng-ri) 283-101 Daegotseo-ro, Daegot-myeon, Gimpo-si, Gyeonggi-do</span>
                <!--<span><strong><?php echo $config['cf_2_subj']; ?></strong>&nbsp;&nbsp; <?php echo $config['cf_2']; ?></span>-->
                <span><strong>CEO</strong>&nbsp;&nbsp; Choi Back-Nam</span>
                <span><strong>Tel</strong>&nbsp;&nbsp; +82-70-8683-0599 / +82-31-997-8387</span>
                <span><strong>Fax</strong>&nbsp;&nbsp;82-31-991-8358</span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong>&nbsp;&nbsp; <?php echo $config['cf_6']; ?></span>
                </p>
            <p class="co">COPYRIGHT(c) 2018 <strong>Greeny system</strong> ALL RIGHTS RESERVED.</p>
			</address>	
			<div class="col-xs-12 col-sm-4 footer_logo"><img src="<?php echo G5_THEME_IMG_URL ?>/common/f_logo.gif" alt="<?php echo $config['cf_title']; ?>"></div>
        </div><!--.footer_in-->
	</div><!--#footer--> 
    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
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
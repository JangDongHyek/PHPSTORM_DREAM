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
    	<div class="container">
        	<div class="foot_logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a></div>
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1>
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
                <p>
                <span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
			</address>	
            <div class="r_banner">
            	<ul>
                	<li><a href="http://ncis.nier.go.kr/main.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_logo.gif" alt="화학물질정보시스템"></a><li>
                	<li><a href="http://www.kcma.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/main/ft_logo2.gif" alt="한국화학물질관리협회"></a><li>
                    <li class="yout"><a href="https://www.youtube.com/channel/UCvgTR3vN9VphvpKqsE-qt-Q" target="_blank">Youtube 바로가기</a></li>
                </ul>
            </div><!--r_banner-->         
        </div><!--.footer_in-->
	</div><!--#footer--> 
 	<div id="copy">
    	<div class="container">
            <ul>
                <li><a href="<?php echo G5_URL ?>">HOME</a></li>
                <li><a href="#">SITEMAP</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">LOCATION</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">CONTACT US</a></li>
                <?php if ($is_member) {  ?>
				<?php if ($is_admin) {  ?>
                <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">LOGOUT</a></li>
                <?php } else {  ?>
                <?php /*?><li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li><?php */?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">ADMIN</a></li>
                <?php }  ?>
            </ul>
            <div class="co">COPYRIGHT(c) 2018 <strong><?php echo $config['cf_title']; ?></strong> ALL RIGHTS RESERVED.</div>
        </div>
    </div><!--copy-->
   
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
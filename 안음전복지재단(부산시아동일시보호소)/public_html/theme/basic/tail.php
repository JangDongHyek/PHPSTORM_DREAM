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
        <ul class="foot_menu">
<!--
        	<div class="fm">
                <li><a href="http://cafe.daum.net/bswomen" target="_blank" class="sn1"><strong>다함께 성·가정상담센터</strong> 다음카페</a></li>  
                <li><a class="sn2" onclick="alert('준비 중입니다');return false;"><i class="fab fa-facebook"></i> <strong>다함께 성·가정상담센터</strong> 페이스북</a></li>  
            </div>
-->
       
           <div class="foot_container">
                <li><a href="<?php echo G5_URL ?>">홈으로</a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=pro01">프로그램 안내</a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice">공지사항</a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=done01">후원안내</a></li>
                <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet06">오시는길</a></li>
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b style="color:#aaa;">로그인</b></a></li>
                <?php }  ?>
           </div>
        </ul>
    	<div class="footer_in">
			<address>
				<p class="fp"><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
                <p><span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                 <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span>
                </p>
                
                <p class="co">COPYRIGHT(c) 2021 <?php echo $config['cf_title']; ?>. </strong> ALL RIGHTS RESERVED. <b>&nbsp;<?php echo $config['cf_8_subj']; ?></b></p>
			</address>	
        </div><!--.footer_in-->
	</div><!--#footer--> 
 
   
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><i class="far fa-long-arrow-up"></i><span>브라우저 최상단으로 이동합니다</span></a>
	<!--<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>-->
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
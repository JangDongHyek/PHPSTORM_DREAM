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


<a class="blog_banner" href="https://blog.naver.com/setarmis" target="_blank">블로그 바로가기</a>

<div id="quick">
	<div class="in cf">
    	<div class="line txt">빠른 상담신청<span>이름과 휴대폰번호를 입력해 주세요.</span></div>
        <div class="line frm cf">
            <form name="b_form_write" action="<?=G5_BBS_URL?>/sms_quickconsult.php" method="post" onSubmit="return b_checkvalue();">
            <input type="hidden" name="b_send_sms" value="ok">
            <div class="nm"><input name="b_name" type="text" class="form" placeholder="이름"></div>
            <div class="tel cf">
                <span><input name="b_tel1" type="text" class="form" onKeyUp="b_auto_next();" placeholder="휴대폰번호"></span>
                <span><input name="b_tel2" type="text" class="form" onKeyUp="b_auto_next2();"></span>
                <span><input name="b_tel3" type="text" class="form"></span>
            </div>
            <div class="sumit"><a onclick=""><input type="submit" value="상담신청하기" ></a></div>
            <div class="agree_a">개인정보수집동의 <input type="checkbox" name="quick_checkbox" id="quick_checkbox" ></div>
            </form>
        </div><!--frm-->
        <div class="line call"><strong>무료상담전화</strong><span><i class="fas fa-phone-alt"></i> <?php echo $config['cf_5']; ?></span></div>
    </div><!--in-->
</div><!--quick-->

 
<!--퀵상담-->     
<script>
function b_checkvalue(){

var form=document.b_form_write;
if(!form.b_name.value){
	alert('성함을 입력해주세요.');
	form.b_name.focus();
	return false;
}
if(!form.b_tel1.value){
	alert('휴대폰번호를 입력해주세요.');
	form.b_tel1.focus();
	return false;
}
if(!form.b_tel2.value){
	alert('휴대폰번호를 입력해주세요.');
	form.b_tel2.focus();
	return false;
}
if(!form.b_tel3.value){
	alert('휴대폰번호를 입력해주세요.');
	form.b_tel3.focus();
	return false;
}

if(!$("#quick_checkbox").is(":checked")){
	alert("개인정보수집동의 체크 해주세요.");
	return false;
}	
return true;
}

function b_auto_next(){
var form=document.b_form_write;
if(form.b_tel1.value.length == 3){
	form.b_tel2.focus();
}
}
function b_auto_next2(){
var form=document.b_form_write;
if(form.b_tel2.value.length == 4){
	form.b_tel3.focus();
}
}

</script>   
    
	<div id="footer">
        <div class="foot_menu">
        	<ul class="fm">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">유니코리아 소개</a></li> 
                <!--li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem01">회원안내</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01">성혼갤러리</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna">온라인상담</a></li-->
				
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></li> 
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy2">회원약관</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=in_data&wr_id=1">손해배상청구</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=in_data&wr_id=2">인허가자료</a></li>    
						
				
				
				          
            </ul>
            <ul class="sns">
            	<li><a href="https://blog.naver.com/setarmis/221564128318" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_naver.png" border="0" /></a></li>
                <li><a href="javascript:;" onclick="alert('준비중입니다')"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_insta.png" /></a></li>
                <li><a href="javascript:;" onclick="alert('준비중입니다')"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_kakao2.png" /></a></li>
                <li><a href="javascript:;" onclick="alert('준비중입니다')"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_line.png" /></a></li>
            </ul>
        </div>
    	<div class="footer_in cf">
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1> 
				<p>
                <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
				</p>
               
			    <p>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>
				<span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span>
                </p>
                <p>
                <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span>
                <span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span>
                </p>
                <p class="co">COPYRIGHT(c) 2020 <strong><?php echo $config['cf_title']; ?></strong> ALL RIGHTS RESERVED.</p>
			</address>
        </div><!--.footer_in-->
	</div><!--#footer--> 

    

    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_top.png" alt="상단으로"></a>
	<a href="#footer" class="goFt"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_bt.png" alt="하단으로"></a>
</div>


<!-- AceCounter Mobile WebSite Gathering Script V.8.0.2019080601 -->
<script language='javascript'>
	var _AceGID=(function(){var Inf=['xn--9i1bs4koyklzbb2r.kr','www.유니코리아.kr,www.xn--9i1bs4koyklzbb2r.kr,유니코리아.kr,xn--9i1bs4koyklzbb2r.kr','AX2A97919','AM','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;if(_CI.join('.').indexOf(Inf[3])<0){ _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
	var _AceCounter=(function(){var G=_AceGID;var _sc=document.createElement('script');var _sm=document.getElementsByTagName('script')[0];if(G.o!=0){var _A=G.val[G.o-1];var _G=(_A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];var _U=(_A[5]).replace(/\,/g,'_');_sc.src='https:'+'//cr.acecounter.com/Mobile/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime());_sm.parentNode.insertBefore(_sc,_sm);return _sc.src;}})();
</script>
<!-- AceCounter Mobile Gathering Script End -->


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
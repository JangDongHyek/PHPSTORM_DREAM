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




<div id="quick">
	<div class="in">
        <form name="b_form_write" action="<?=G5_BBS_URL?>/sms_quickconsult.php" method="post" onSubmit="return b_checkvalue();">
        <input type="hidden" name="b_send_sms" value="ok">
            <div class="title">
                <h3>빠른 상담신청</h3>
                <div class="agree_a"><label>개인정보수집동의 <input type="checkbox" name="quick_checkbox" id="quick_checkbox" ></label></div>
            </div>
            <div class="from_wrap">
                <div class="nm"><input name="b_name" type="text" class="form" placeholder="이름"></div>
                <div class="tel cf">
                    <span><input name="b_tel1" type="text" class="form" onKeyUp="b_auto_next();" placeholder="휴대폰번호"></span>
                    <span><input name="b_tel2" type="text" class="form" onKeyUp="b_auto_next2();"></span>
                    <span><input name="b_tel3" type="text" class="form"></span>
                </div>
                <div class="sumit"><a onclick=""><input type="submit" value="상담신청하기" ></a></div>
            </div>
        </form>
        <div class="cus">
            <div class="line call"><strong>무료상담전화</strong><span><i class="fas fa-phone-alt"></i> <?php echo $config['cf_5']; ?></span></div>
            <div class="sns">
                <a class="blog_banner" href="https://blog.naver.com/setarmis" target="_blank"><img src="<?=G5_THEME_IMG_URL?>/common/naver_blog.svg"><span>블로그 바로가기</span></a>
            </div>
        </div>
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
                <!--<li><a href="<?php /*echo G5_BBS_URL */?>/content.php?co_id=company"><?php /*echo $config['cf_title']; */?> 소개</a></li>-->
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=procedure">손해배상 청구절차</a></li>
                <li><a href="javascript:alert('051) 703- 0250으로 문의 주세요.')">제휴문의</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=recruit">채용공고</a></li>
                <!--<li><a href="<?php /*echo G5_BBS_URL */?>/board.php?bo_table=privacy&wr_id=2">결혼중개업 회원약관</a></li>
                <li><a href="<?php /*echo G5_BBS_URL */?>/board.php?bo_table=privacy&wr_id=4">이메일정보수집거부</a></li>-->
            </ul>
            <ul class="sns">
            	<li><a href="javascript:;" onclick="alert('준비중입니다')" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_naver.png" border="0" /></a></li>
                <li><a href="javascript:;" onclick="alert('준비중입니다')" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_insta.png" /></a></li>
                <li><a href="https://pf.kakao.com/_jcbeG/chat" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_kakao2.png" /></a></li>
            </ul>
        </div>
    	<div class="footer_in cf">
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1> 
				<p>
                <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?> / 051-703-0250</span>
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
                <span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span>
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


<!-- 이용약관 동의(필수) -->
<div class="modal fade" id="agreeModal" tabindex="-1" aria-labelledby="agreeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agreeModalLabel">이용약관 동의(필수)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-xmark-large"></i></button>
            </div>
            <div class="modal-body"><?php echo get_text($config['cf_stipulation']) ?></div>
        </div>
    </div>
</div>

<!-- 개인정보수집 및 이용 동의(필수) -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">개인정보수집 및 이용 동의(필수)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-xmark-large"></i></button>
            </div>
            <div class="modal-body"><?php echo get_text($config['cf_privacy']) ?></div>
        </div>
    </div>
</div>

<!-- 마케팅 활용에 동의(선택) -->
<div class="modal fade" id="marketingModal" tabindex="-1" aria-labelledby="marketingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="marketingModalLabel">마케팅 활용에 동의(선택)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-light fa-xmark-large"></i></button>
            </div>
            <div class="modal-body"><? include_once(G5_BBS_PATH.'/agree_detail02.php'); ?></div>
        </div>
    </div>
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
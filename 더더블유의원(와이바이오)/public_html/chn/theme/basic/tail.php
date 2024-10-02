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


	<div id="f_ph"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/main_ph.jpg" /></div>
	<div id="footer" class="cf">
    	<p class="ces"><i class="fal fa-map-marker-exclamation"></i>  手术后根据个人情况可能会出现出血,感染,炎症等并发症,主观满意度因人而异.</p>
    	<div class="left">
        	<ul class="fm">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">THE W 介绍</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="point">个人信息处理方针</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision" class="point">使用条款</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">公告事项</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07">来访路线</a></li>            
            </ul>
            <div class="foot_sns">
                <ul>
                    <li class="wechat"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/icon_wechat.png" /></li>					
                    <li><a href="https://www.instagram.com/thewclinicw/" target="_blank" title="인스타그램"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_insta.png" /></a></li>
                    <li><a href="https://www.facebook.com/thewclinicw/" target="_blank" title="페이스북"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_face.png" /></a></li>
					<li><a href="https://weibo.com/kimjaehong" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/ft_weibo.png" /></a></li>	
                </ul>
            </div>
        </div><!--left-->
        <div class="right cf">
			<div class="scs mp">
                <h2>来访路线<span>为您介绍德W整形外科来访路线.</span></h2>
                <div class="map"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/map.png" /></div>
            </div>
			<div class="scs">
                <h2>诊疗时间 指南<span>为您介绍德W整形外科诊疗时间.</span></h2>
                <div class="cus_txt cf">
                    <span>星期一~星期五</span><strong>上午 10:00 ~ 下午7:00</strong><br />
                    <span>星期六 </span><strong>上午 10:00 ~ 下午5:00</strong><br />
                    <span>星期日  休诊</span>
                </div>
            </div>
			<div class="scs">
                <h2>电话咨询及预约<span>欢迎致电咨询 我们将诚心诚意为您服务 .</span></h2>
                <div class="tel">82-10-9556-7617</div>
                <div class="cus_txt wechat">
					<div class="area_img"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/wechat_qr.jpg"></div>
                	<em>通过扫微信二维码 <br>在线咨询</em>
                </div>
            </div>
        </div>
        <address>
            <h1><?php echo $config['cf_title']; ?></h1> 
            <p>
            <span><strong>医院名称:德W整形外科</span>
             <span><strong>地址:</strong> 首尔市 江南区 江南大路 596  极东大厦 9楼 (论岘洞 17-5 极东大厦 9楼)</span>
            </p>
            <p>
            <span><strong>代表 :</strong> 金宰弘</span>
            <span><strong>营业执照号 :</strong> 533-57-00294</span>
            <span><strong>TEL :</strong> 02.517.7617</span>
            <span><strong>FAX :</strong> 02.518.7617</span>
            </p>
            <p class="co">COPYRIGHT(c) 2021 <strong>德W整形外科 Co.,Ltd.</strong> ALL RIGHTS RESERVED.</p>
        </address>
<!-----Comodo SEAL Start---------->
<div class="cmd">
<img src="https://www.ucert.co.kr/image/trustlogo/comodo_secure_113x59_white.png" width="113" height="59" align="absmiddle" border="0" style="cursor:pointer;" Onclick="javascript:window.open('https://www.ucert.co.kr/trustlogo/sseal_comodo.html?sealnum=52b4968f9652b6d3&sealid=6ae438d732d97336d7e1d64f94454efb', 'mark', 'scrollbars=no, resizable=no, width=400, height=500');">
</div>
<!-----Comodo SEAL End---------->
	</div><!--#footer--> 


<!-- 카톡상담 모달팝업 -->
<div id="kaka_modal">
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">카카오톡 상담하기</h4>
      </div>
      <div class="modal-body">
            <div class="kaka_form">
                <h1>정보를 입력해 주시면 카톡으로 친절히 상담해드립니다.</h1>
                    <form action="http://itforone.co.kr/~thewdoctor/bbs/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="uid" value="21032519483832">
                    <input type="hidden" name="bo_table" value="consult">
                    <div class="formbox">  
                        <strong class="title">이름</strong>
                        <div class="form"><input type="text" name="wr_name"></div>
                    </div>
                    
                    <div class="formbox">  
                        <strong class="title">전화번호</strong>
                        <div class="form tel">
                            <select class="select" id="phone1" name="phone[]">
                                <option value="010">010</option>
                                <option value="011">011</option>
                                <option value="016">016</option>
                                <option value="017">017</option>
                                <option value="018">018</option>
                                <option value="019">019</option>        
                            </select>
                            <span class="unit">-</span>
                            <input type="text" id="phone2" name="phone[]" class="text" maxlength="4">
                            <span class="unit">-</span>
                            <input type="text" id="phone3" name="phone[]" class="text" maxlength="4">
                        </div>
                    </div>
    
                    <div class="formbox">  
                        <strong class="title">진료내용</strong>
                        <div class="form hw">
                            <select class="select" id="favor" name="data[]">
                                <option value="">진료내용을 선택하세요</option>
								<option>보형물특수검진</option>
                                <option>유방초음파</option>
                                <option>보형물재건</option>
                                <option>가슴성형</option>
                                <option>여유증</option>
                                <option>유방재건</option>
                                <option>맘모톰</option>
                            </select>
                       </div>
                   </div>
                   
                    <div class="formbox">  
                        <strong class="title">성별</strong>
                        <div class="form hw">
                            <select class="select" id="gender" name="data[]">
                                <option value="">성별을 선택해주세요</option>
                                <option value="여성">여성</option>
                                <option value="남성">남성</option>
                            </select>
                       </div>
                   </div>
                   
                    <div class="formbox">  
                        <strong class="title">연령</strong>
                        <div class="form hw">
                            <select class="select" id="age" name="data[]">
                                <option value="">연령을 선택해주세요</option>
                                <option value="10대">10대</option>
                                <option value="20대">20대</option>
                                <option value="30대">30대</option>
                                <option value="40대">40대</option>
                                <option value="50대">50대</option>
                                <option value="60대 이상">60대 이상</option>
                            </select>
                       </div>
                   </div>
                   
                   <div class="agree">
                   	  <p>
                        <label>
                            <input type="checkbox" name="agree" class="" id="" value="1">
                            <em></em><span>개인정보수집이용에 동의합니다.</span>
                        </label>
                      </p>	
                      <p> 
                        <label>
                            <input type="checkbox" name="agree" class="" id="" value="1">
                            <em></em><span>SMS수신 및 카톡상담에 동의합니다.</span>
                        </label>
                      </p>		 										
                   </div>
                   </form>
            </div><!--kaka_form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">카카오톡 상담신청</button>
      </div>
    </div>
  </div>
</div>
</div><!--kaka_modal-->
<!-- 카톡상담 모달팝업 -->

    
<ul id="fquick">
   <li class="call"><a href="tel:02-517-7617"><img src="<?php echo G5_THEME_IMG_URL; ?>/sub/icon_call.svg" title=""><p>전화상담</p></a></li>
   <li class="online"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick2.png" title=""><p>在线咨询</p></a></li>
   <li class="wechat"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/icon_wechat.png" title=""><p>微信</p></li>
   <li class="ckakao"><a href="http://pf.kakao.com/_LgtPxl" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/sub/icon_ckakao.svg" title=""><p>카톡채널상담</p></a></li>
   <li class="info"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet05"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick3.png" title=""><p>诊疗时间</p></a></li>
   <li class="location"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick4.png" title=""><p>来访路线</p></a></li>
   <li class="blog"><a href="https://blog.naver.com/stenka" target="_blank" title="네이버블로그"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/icon_weibo.png" title=""><p>院长微博</p></a></li>
   <li><a href="#" class="go-top">TOP</a></li>
</ul>        
<a href="tel:02-517-7617" class="quick_call"><i class="fas fa-phone-alt"></i></a>
    
<div class="area_wechat">
	<div class="btn_close"><span></span><span></span></div>
	<div class="area_img">
		<div class="btn_close"><span></span><span></span></div>	
		<img src="<?php echo G5_THEME_IMG_URL; ?>/main/img_wechat.jpg">
	</div>
</div>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>


<script>
$(function(){
	$('li.wechat, .area_wechat .btn_close').on('click',function(){
		$('.area_wechat').toggleClass('active');
		return false;
	});
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
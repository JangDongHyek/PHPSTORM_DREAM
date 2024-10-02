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
    	<p class="ces"><i class="fal fa-map-marker-exclamation"></i> 수술 후 개인에 따라 출혈, 염증 등의 합병증이 있을 수 있으며, 주관적인 만족도는 개인마다 차이가 있을 수 있습니다.</p>
    	<div class="left">
        	<ul class="fm">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">THE W 소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="point">개인정보처리방침</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision" class="point">이용약관</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07">오시는 길</a></li>            
            </ul>
            <div class="foot_sns">
                <ul>
                    <li><a href="https://blog.naver.com/stenka" target="_blank" title="네이버블로그"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_naver.png" /></a></li>
                    <li><a href="https://www.facebook.com/thewclinicw/" target="_blank" title="페이스북"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_face.png" /></a></li>
                    <li><a href="http://pf.kakao.com/_LgtPxl" target="_blank" title="카카오톡"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_kakao.png" /></a></li>
                    <li><a href="https://www.instagram.com/thewclinicw/" target="_blank" title="인스타그램"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/sns_insta.png" /></a></li>
                </ul>
            </div>
        </div><!--left-->
        <div class="right cf">
			<div class="scs mp">
                <h2>찾아오시는 길<span><?php echo $config['cf_title']; ?> 진료 오시는 길을 안내해 드립니다.</span></h2>
                <div class="map"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/map.png" /></div>
            </div>
			<div class="scs">
                <h2>진료시간 안내<span><?php echo $config['cf_title']; ?> 진료시간을 안내해 드립니다.</span></h2>
                <div class="cus_txt cf">
                    <span>월~금요일</span><strong>오전 10:00 ~ 오후 7:00</strong><br />
                    <span>토요일</span><strong>오전 10:00 ~ 오후 5:00</strong><br />
                    <span>일요일 휴진</span>
                </div>
            </div>
			<div class="scs">
                <h2>전화상담 및 예약<span>전화 주시면 언제나 성심껏 상담해드리겠습니다.</span></h2>
                <div class="tel"><?php echo $config['cf_4']; ?></div>
                <div class="cus_txt kaka">
                	<span>kakao Talk<br />Yellow ID</span><strong>@더더블유클리닉</strong>
                </div>
            </div>
        </div>
        <address>
            <h1><?php echo $config['cf_title']; ?></h1> 
            <p>
            <span><strong>상호명 : </strong> <?php echo $config['cf_title']; ?></span>
            <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
            </p>
            <p>
            <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
            <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>
            <span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
            <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
            </p>
            <p class="co">COPYRIGHT(c) 2021 <strong><?php echo $config['cf_title']; ?></strong> ALL RIGHTS RESERVED.</p>
        </address>
<!-----Comodo SEAL Start---------->
<!--div class="cmd">
<img src="https://www.ucert.co.kr/image/trustlogo/comodo_secure_113x59_white.png" width="113" height="59" align="absmiddle" border="0" style="cursor:pointer;" Onclick="javascript:window.open('https://www.ucert.co.kr/trustlogo/sseal_comodo.html?sealnum=52b4968f9652b6d3&sealid=6ae438d732d97336d7e1d64f94454efb', 'mark', 'scrollbars=no, resizable=no, width=400, height=500');">
</div-->
<!-----Comodo SEAL End---------->
	</div><!--#footer--> 


<!-- 카톡상담 모달팝업 -->
<div id="kaka_modal">
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form action="<?php echo G5_URL ?>/sms_send.php" id="form_kakao" method="post">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
        <h4 class="modal-title" id="myModalLabel">카카오톡 상담하기</h4>
      </div>
      <div class="modal-body">
            <div class="kaka_form">
                <h1>정보를 입력해 주시면 카톡으로 친절히 상담해드립니다.</h1>
                    
                    <input type="hidden" name="uid" value="21032519483832">
                    <input type="hidden" name="bo_table" value="consult">
					<input type="hidden" name="data[]" value="[카톡상담] ">
                    <div class="formbox">  
                        <strong class="title">이름</strong>
                        <div class="form"><input type="text" title="이름" id="name" name="data[]"></div>
                    </div>
                    
                    <div class="formbox">  
                        <strong class="title">전화번호</strong>
                        <div class="form tel">
                            <select class="select" id="phone1" name="phone[0]">
                                <option value="010">010</option>
                                <option value="011">011</option>
                                <option value="016">016</option>
                                <option value="017">017</option>
                                <option value="018">018</option>
                                <option value="019">019</option>        
                            </select>
                            <span class="unit">-</span>
                            <input type="text" id="phone2" name="phone[1]" class="text" maxlength="4">
                            <span class="unit">-</span>
                            <input type="text" id="phone3" name="phone[2]" class="text" maxlength="4">
                        </div>
                    </div>
    
                    <div class="formbox">  
                        <strong class="title">진료내용</strong>
                        <div class="form hw">
                            <select class="select" title="관심부위" id="favor" name="data[]">
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
                            <select class="select" id="gender" name="data[]" title="성별">
                                <option value="">성별을 선택해주세요</option>
                                <option value="여성">여성</option>
                                <option value="남성">남성</option>
                            </select>
                       </div>
                   </div>
                   
                    <div class="formbox">  
                        <strong class="title">연령</strong>
                        <div class="form hw">
                            <select class="select" id="age" name="data[]" title="연령">
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
                            <input type="checkbox" name="privacy" class="" id="" value="1">
                            <em></em><span>개인정보수집이용에 동의합니다.</span>
                        </label>
                      </p>	
                      <p> 
                        <label>
                            <input type="checkbox" name="sms" class="" id="" value="1">
                            <em></em><span>SMS수신 및 카톡상담에 동의합니다.</span>
                        </label>
                      </p>		 										
                   </div>
				   <script>
					$("#form_kakao").submit(function(e) {

						if($("#form_kakao input[title='이름']").val() == '') {
							alert('이름을 입력해 주세요.');
							$("#form_kakao input[title='이름']").focus();
							return false;
						}
						if($("#form_kakao select[id=phone1]").val() == '') {
							alert('핸드폰 번호를 선택해 주세요.');
							$("#form_kakao select[id=phone1]").focus();
							return false;
						}
						if($("#form_kakao input[id=phone2]").val() == '' || $("#form_kakao input[id=phone2]").val().length < 3) {
							alert('핸드폰 번호를 입력해 주세요.');
							$("#form_kakao input[id=phone2]").focus();
							return false;
						}
						if($("#form_kakao input[id=phone3]").val() == '' || $("#form_kakao input[id=phone3]").val().length < 4) {
							alert('핸드폰 번호를 입력해 주세요.');
							$("#form_kakao input[id=phone3]").focus();
							return false;
						}
						 if($("#form_kakao input[name=sms]").is(":checked") == false) {
							 alert('SMS 수신 동의해 주세요.');
							 $("#form_kakao input[name=sms]").focus();
							 return false;
						 }
						 if($("#form_kakao input[name=privacy]").is(":checked") == false) {
							 alert('개인정보 수집 및 이용에 동의해 주세요.');
							 $("#form_kakao input[name=privacy]").focus();
							 return false;
						 }
					});

					</script>
                   
            </div><!--kaka_form-->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">카카오톡 상담신청</button>
      </div>
	  
    </div>
  </div>
  </form>
</div>
</div><!--kaka_modal-->
<!-- 카톡상담 모달팝업 -->

    
<ul id="fquick">
   <li class="call"><a href="tel:02-517-7617"><img src="<?php echo G5_THEME_IMG_URL; ?>/sub/icon_call.svg" title=""><p>전화상담</p></a></li>
   <li class="online"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick2.png" title=""><p>온라인상담</p></a></li>
   <li class="kakao"><a data-toggle="modal" data-target="#myModal2"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/icon_kakao.svg" title=""><p>카톡상담</p></a></li>
   <li class="ckakao"><a href="http://pf.kakao.com/_LgtPxl" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/sub/icon_ckakao.svg" title=""><p>카톡채널상담</p></a></li>
   <li class="info"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet05"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick3.png" title=""><p>진료시간</p></a></li>
   <li class="location"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/quick4.png" title=""><p>오시는 길</p></a></li>
   <li class="blog"><a href="https://blog.naver.com/stenka" target="_blank" title="네이버블로그"><img src="<?php echo G5_THEME_IMG_URL; ?>/main/icon_blog.svg" title=""><p>원장님블로그</p></a></li>
   <li><a href="#" class="go-top">TOP</a></li>
</ul>        
<a href="tel:02-517-7617" class="quick_call"><i class="fas fa-phone-alt"></i></a>
    
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
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
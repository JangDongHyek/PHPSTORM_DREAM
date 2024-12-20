<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>


            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<footer id="Footer" class="clearfix">
       
        <div class="copyarea">
              <div class="copyright">
                    <nav class="fmenu_area">
                        <ul>
                            <!--<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=important">주요정보고시사항</a></li> -->
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="privacy">개인정보 처리방침</a></li>
                            <!--<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=standard">공정거래위원회표준약관</a></li> -->
                            <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=introduce01">회사소개</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">고객센터</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=b_reserv">온라인예약</a></li>
                        </ul>
                    </nav><!--#fmenu_area-->
                    
                    <div class="sns">
                            <div class="sns_micon">
                                 <ul>
                                      <li><a href="https://blog.naver.com/h-3promise" target="_blank"></a></li>
                                      <li><a href="https://www.facebook.com/3promise" target="_blank"></a></li>
                                      <li><a href="http://pf.kakao.com/_nhxjwT" target="_blank"></a></li>
                                      <li><a href="https://youtu.be/FXYsS6gm-IM" target="_blank"></a></li>
                                 </ul>
                            </div>
                    </div> 
        
                    <address class="ft_copy">
                        <!--상호-->
                        <h1 class="cn"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_logo.png" alt="<?php echo $config['cf_title']; ?>"></h1>
                        <!--상호-->
                        <!--기본정보-->
                        
                        <?php echo $config['cf_1_subj']; ?> <?php echo $config['cf_1']; ?>&nbsp;&nbsp;&nbsp;<br class="hidden-lg hidden-md hidden-sm" />
                        <?php echo $config['cf_2_subj']; ?> <?php echo $config['cf_2']; ?>&nbsp;&nbsp;&nbsp;
                        <?php echo $config['cf_3_subj']; ?> <?php echo $config['cf_3']; ?>&nbsp;&nbsp;&nbsp;<br />
                        <?php echo $config['cf_4_subj']; ?> <?php echo $config['cf_4']; ?>&nbsp;&nbsp;&nbsp;<br class="hidden-lg hidden-md hidden-sm" />
						<?php echo $config['cf_10_subj']; ?> <?php echo $config['cf_10']; ?>&nbsp;&nbsp;&nbsp;
                        <?php echo $config['cf_5_subj']; ?> <?php echo $config['cf_5']; ?>&nbsp;&nbsp;&nbsp;<br class="hidden-lg hidden-md hidden-sm" />
                        <?php echo $config['cf_6_subj']; ?> <?php echo $config['cf_6']; ?>&nbsp;&nbsp;&nbsp;<br class="hidden-lg hidden-md hidden-sm" />
                        <!--<p class="fmenu t_margin15">사이트이용약관&nbsp;&nbsp;<span>|</span>&<strong>nbsp</strong>;&nbsp;개인정보처리방침</p>-->
                        <!--기본정보-->
                        <br /><br />
                        <p class="copyt">COPYRIGHT(c)2020 <?php echo $config['cf_title']; ?>&nbsp;. ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
                        <?php if ($is_admin) {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>&nbsp;&nbsp;<a href="<?php echo G5_URL ?>/adm" target="_blank">통합예약 관리자 접속</a>
                        <?php } else {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
                        <?php }  ?>
                        </p>
                   </address>
             </div>
        </div>

      </div>
  </footer>
<!--footer--> 

<!--팝업창-->
<?php 
    $sql = "select *, count(idx) as count from g5_popup;";
    $row = sql_fetch($sql);

	if($row["hide"] == 1){  //hide가 1이면 팝업을 보여주고 0이면 보여주지 않는다
		$display = 1;
		$check = "checked";
	}else{
		$display = 0;
		$check = "";
	}

	if($row["count"] == 1){ //이미 등록된 글이 있으면 게시글 수정
		$btn_text = "수정하기";
	}else{
		$btn_text = "등록하기";
	}
?>
<script>
	var display = '<?php echo $display; ?>';
	var btn_text =  '<?php echo $btn_text; ?>';
	var ajax_url = '<?php echo G5_URL; ?>';
</script>
<div class="modal_popup-on" id="popup" style="display: none;">
	<div class="modal-container">
		<div class="modal-inner">
			<span class="modal-close" onclick="close_popup();">CLOSE</span>
			<div class="modal-img">
				<img src="<?php echo G5_URL; ?>/theme/incore/upload/<?php echo $row["image_name"] ?>">
				<div class="modal-readmore">
					<button onclick='location.href="<?php echo $row["link"] ?>"'>READ MORE</button>
				</div>
			</div>
			<div class="mod-check_container modal-close-today">
				<label class="mod-check_label">오늘 하루 보지 않기
					<input type="checkbox" id="today_close">
					<span class="mod-checkmark"></span>
				</label>
			</div>
		</div>
	</div>
</div>

<!-- 팝업관리창 모달창 -->
<div class="modal_popup-adm" style="display:none;" id="popup_modal">
	<div class="modal_wrap">
		<h3>팝업창 관리자</h3>
		<!--on-off버튼-->
		<span class="switch-button">
			<label class="switch">
				<input type="checkbox" onchange="show_popup(this);" <?php echo $check; ?>>
				<span class="slide_switch round_mo"></span>
			</label>
		</span>
		<div class="modal-body">
			<section class="modal-sec">
				<form class="modal-form" name="register_form" action="<?php echo G5_URL; ?>/theme/incore/popup_process.php" method="post" enctype="multipart/form-data">					
					<dl>
						<dt><p>이미지</p></dt>
						<dd>
							<input placeholder="이미지를 추가하세요" disabled="" class="file_view" id="image_view" value="<?php echo $row["real_image_name"] ?>">
							<input type="hidden" class="hidden_file" name="hidden_file" value="<?php echo $row["image_name"] ?>">
							<input type="hidden" name="type" value="<?php echo $row["count"] ?>">
							<input type="file" id="img_file" style="display:none" name="image_file" onchange='file_view(this)'>
							<label class="file-button" for="img_file">파일추가</label>
						</dd>
					</dl>
					<dl>
						<dt><p>링크</p></dt>
						<dd>
							<div class="input-text-box">
								<input type="text" class="mark" id="link" name="link" placeholder="링크 주소를 입력하세요" style="margin-bottom: 10px;" 
								value="<?php echo $row["link"] ?>">
							</div>
						</dd>
					</dl>
				</form>
			</section>
			<div class="modal-button">
				<button onclick="register_popup();"><?php echo $btn_text; ?></button>
				<button onclick="close_modal();">닫기</button>
		
			</div>
		</div>
	</div>    
	<span class="close-button"></span>
</div>


    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#Footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>


<!--//애니메이션 js-->
<script src="<?php echo G5_THEME_JS_URL; ?>/wow.min.js"></script>
<script>


 
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});

/* IE8 이하 브라우저는 애니메이션 스크립트 실행 막아야함 */
var IE = -1;
if (navigator.appName == 'Microsoft Internet Explorer') {
    var ua = navigator.userAgent;
    var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
    if (re.exec(ua) != null) {
        IE = parseFloat(RegExp.$1);
    }
}
if(IE > 9 || IE == -1) new WOW().init();
</script>
<!--//애니메이션 js-->

<!--// 팝업 js -->
<script src="<?php echo G5_THEME_JS_URL; ?>/popup.js"></script>


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>


<?php
include_once(G5_PATH."/tail.sub.php");
?>
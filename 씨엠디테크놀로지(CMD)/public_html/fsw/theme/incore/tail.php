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

<!--롤링배너-->
<div id="roll_banner" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
         <li data-target="#roll_banner" data-slide-to="0" class="active"></li>
         <li data-target="#roll_banner" data-slide-to="1"></li>
      </ol>			
      <!-- Wrapper for slides -->
   <div class="carousel-inner" role="listbox">
             <div class="item active">
                <div class="row">
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner01.jpg" alt="사이트1"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner02.jpg" alt="사이트2"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner03.jpg" alt="사이트3"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner04.jpg" alt="사이트4"></a></div>
                </div>
             </div>
             <div class="item">
                <div class="row">
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner01.jpg" alt="사이트1"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner02.jpg" alt="사이트2"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner03.jpg" alt="사이트3"></a></div>
                    <div class="col-md-3 col-xs-3"><a href="#"><img src="<?php echo G5_THEME_IMG_URL ?>/main/roll_banner04.jpg" alt="사이트4"></a></div>
                </div>
             </div>
   </div>    
    <!-- Controls -->
    <a class="left carousel-control" href="#roll_banner" role="button" data-slide="prev">
    ◀
    <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#roll_banner" role="button" data-slide="next">
    ▶
    <span class="sr-only">Next</span>
    </a>
</div>
<!--롤링배너-->



<!-- 하단 시작 { -->
<div id="ft" class="clearfix">
  <div class="ft_area clearfix">
    <div class="flogo col-md-7"><img src="<?php echo G5_THEME_IMG_URL ?>/common/f_logo.png" alt="로고"/>
    	<div id="ft_copy" class="hidden-sm">
        <!--상호-->
        <p class="ct"><?php echo $config['cf_title']; ?>&nbsp;&nbsp;&nbsp;<span><?php echo $config['cf_1_subj']; ?><?php echo $config['cf_1']; ?></span></p>
        <!--상호-->
        <!--기본정보-->
        
        <?php echo $config['cf_2_subj']; ?> <?php echo $config['cf_2']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_3_subj']; ?> <?php echo $config['cf_3']; ?><br />
        <?php echo $config['cf_4_subj']; ?> <?php echo $config['cf_4']; ?><br />
        <?php echo $config['cf_5_subj']; ?> <?php echo $config['cf_5']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_6_subj']; ?> <?php echo $config['cf_6']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_7_subj']; ?> <?php echo $config['cf_7']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_8_subj']; ?> <?php echo $config['cf_8']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_9_subj']; ?> <?php echo $config['cf_9']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_10_subj']; ?> <?php echo $config['cf_10']; ?>
        <!--<p class="fmenu t_margin15">사이트이용약관&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;개인정보처리방침</p>-->
        <!--기본정보-->
        <br /><br /><span>COPYRIGHT(c) <?php echo $config['cf_title']; ?> 2018 ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
        <?php if ($is_admin) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>
        <?php } else {  ?>
        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
        <?php }  ?></span>
    </div>
    
    </div>

    <div id="ft_copy" class="hidden-md hidden-lg hidden-xs">
        <!--상호-->
        <p class="ct"><?php echo $config['cf_title']; ?></p>
        <!--상호-->
        <!--기본정보-->
        <?php echo $config['cf_1_subj']; ?> <?php echo $config['cf_1']; ?><br />
        <?php echo $config['cf_2_subj']; ?> <?php echo $config['cf_2']; ?><br />
        <?php echo $config['cf_3_subj']; ?> <?php echo $config['cf_3']; ?><br />
        <?php echo $config['cf_4_subj']; ?> <?php echo $config['cf_4']; ?><br />
        <?php echo $config['cf_5_subj']; ?> <?php echo $config['cf_5']; ?><br />
        <?php echo $config['cf_6_subj']; ?> <?php echo $config['cf_6']; ?><br />
        <?php echo $config['cf_7_subj']; ?> <?php echo $config['cf_7']; ?><br>
        <?php echo $config['cf_8_subj']; ?> <?php echo $config['cf_8']; ?><br />
        <?php echo $config['cf_9_subj']; ?> <?php echo $config['cf_9']; ?><br />
        <?php echo $config['cf_10_subj']; ?> <?php echo $config['cf_10']; ?><br />
        <!--<p class="fmenu t_margin15">사이트이용약관&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;개인정보처리방침</p>-->
        <div class="hidden-lg hidden-md hidden-xs b_margin20"></div>
        <!--기본정보-->
        <br /><br /><span>COPYRIGHT(c) INCORE Co.,Ltd. 2018 ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
        <?php if ($is_admin) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>
        <?php } else {  ?>
        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
        <?php }  ?></span>
    </div><!--ft_copy-->

    <div class="col-md-3 bottom_pro hidden-sm hidden-xs t_margin40">
        <dl class="">
            <dt>PRODUCTS</dt>
            <dd>Medical Consumables<br /><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro01_eng"> - Disposable Endoscopic Instruments</a></dd>
            <dd>SSurgical Consumables<br /><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro02_eng"> - Hemostatic Supplies

HOME</a></dd>
        </dl>
        <p class="tel"><?php echo $config['cf_2']; ?></p> 
        <p class="fax">FAX : <?php echo $config['cf_3']; ?><br />E-mail : <?php echo $config['cf_5']; ?></p>
    </div>
    
    <div class="hidden-lg hidden-md hidden-xs b_margin20"></div>
    <div class="col-md-2 hidden-sm hidden-xs t_margin40">
      <div class="clearfix">
          <a href="javascript:alert('Preparing to Catalog.')">
          <div class="col-md-12 col-xs-12 t_margin10" style="position:relative">
              <div class="ft_circle03">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_bottom03.png" alt="" />
              </div>
              <div class="ft_banner_t"><span>INCORE</span><br />Catalog / Brochure</div>
          </div></a>
      </div>
      <div class="bottom_sns clearfix t_margin28">
         <div><a class="nblog" style="color:#fff" href="#" target="_blank">Naver Blog</a></div>
         <div class="t_margin5"><a class="facebook" style="color:#fff" href="#" target="_blank">facebook</a></div>
      </div>
    </div>
    
  </div>
</div>
<!--footer--> 

    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#ft" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
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

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>


<?php
include_once(G5_PATH."/tail.sub.php");
?>
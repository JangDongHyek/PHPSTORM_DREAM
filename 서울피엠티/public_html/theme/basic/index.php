<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css">
    <div id="visual">
    	
    </div>

<div class="m_content05 clearfix">

<!--<div id="main_ban" class="container wow fadeInUp" data-wow-delay="0.5">

	<div class="main_ban_in">
    	<h2 class="wow bounceIn" data-wow-delay="0.1">쾌적하고 풍요로운 도시와 주거환경을 만들어갑니다.</h2>
        <p class="wow bounceIn" data-wow-delay="0.5s" style="width:100px; border-bottom:1px solid #afafaf; margin:0px auto"></p>
        <p class="t_margin20 con wow fadeInDown" data-wow-delay="0.3s"></p>
    </div>
</div> -->

  <div class="container minus">
  <div class="row">
  
<div class="m3_list">
  <ul class="clearfix">
  
      <li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.1s">
         <div class="box">
            <!--<div class="photo"><img class="imgWidth" alt="" src="<?php echo G5_THEME_IMG_URL ?>/main/m3_photo01.jpg"></div> -->
            <div class="content" style="background:#414141">
               <p class="title" style="color:#fff !important">VISION +</p>
               <p style="color:rgb(255,255,255,0.85) !important; color:rgba(255,255,255,0.85) !important">TO BE THE PREMIER STRATEGY<br class="hidden-xs" />DEVELOPER AND SOLUTION PROVIDER<br class="hidden-xs" />FORCONSULTING OVERSEAS.
</p>
            </div>
         </div>
      </li>
      
      <li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
         <div class="box">
            <!--<div class="photo"><img class="imgWidth" alt="" src="<?php echo G5_THEME_IMG_URL ?>/main/m3_photo02.jpg"></div> -->
            <div class="content" style="background:#1ca0cb">
               <p class="title" style="color:#fff !important">MISSION +</p>
               <p style="color:rgb(255,255,255,0.85) !important; color:rgba(255,255,255,0.85) !important">TO GET THE MOST PROFIT<br class="hidden-xs" />BYEXPANDING YOUR BUISINESS<br class="hidden-xs" />GLOBALLY
</p>
            </div>
         </div>
      </li>
      
      <li class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
         <div class="box">
            <!--<div class="photo"><img class="imgWidth" alt="" src="<?php echo G5_THEME_IMG_URL ?>/main/m3_photo03.jpg"></div> -->
            <div class="content"  style="background:#2877dc">
               <p class="title" style="color:#fff !important">GOAL +</p>
               <p style="color:rgb(255,255,255,0.85) !important; color:rgba(255,255,255,0.85) !important">TO PRIORITIZEAND OPTIMIZEYOUR<br class="hidden-xs" />BUSINESS FORPROFITABLE SALES<br class="hidden-xs" />THROUGH OVERSEAS MARKETING
</p>
            </div>
         </div>
      </li>
      
  </ul>
</div>
     
  </div><!--//row--> 
  </div><!--//container--> 
  </div>


<?php /*?><div class="m_content06 clearfix"><!--고객센터area-->
  <div class="container">
  <div class="row">
  
<div class="clearfix" style="padding:30px 0 0">
           <!--전화번호-->
           <div class="col-md-5 text-left hidden-sm hidden-xs">
              <div style="font-family: 'Titillium Web', Arial, sans-serif;font-size: 3.5em;color: #3f3f3f; line-height:0.8; font-weight:bold"><?php echo $config['cf_5']; ?></div>
              <div class="t_margin15"><span style="background:#8db135; border:0px; padding:0px 6px; font-size:1.0em; color:#fff; margin-right:10px">E-mail</span></span><span style="font-size:1.15em; font-weight:600"><?php echo $config['cf_6']; ?></span></div>
           </div>
           <div class="col-md-5 text-center hidden-lg hidden-md">
              <div style="font-family: 'Titillium Web', Arial, sans-serif;font-size: 3.5em;color: #3f3f3f; line-height:1.0em"><?php echo $config['cf_5']; ?></div>
              <div><span style="background:#8db135; border:0px; padding:0px 6px; font-size:0.80em; color:#fff; margin-right:10px">E-mail</span><span style="font-size:1.15em; font-weight:600"><?php echo $config['cf_6']; ?></span></div>
           </div>
           <!--일과시간-->
           <div class="col-md-4 text-left clearfix">
              <div class="col-md-7 hidden-sm hidden-xs">
                 <div class="clearfix">
                     <div class="col-md-3"><span style="font-size:1.15em; font-weight:600"> · 평일</span></div> <div class="col-md-9 text-right"><span style="font-size:1.15em; font-weight:600">09:00 ~ 24:00</span></div>
                     <div class="col-md-3"><span style="font-size:1.15em; font-weight:600">· 토요일</span></div> <div class="col-md-9 text-right"><span style="font-size:1.15em; font-weight:600">09:00 ~ 24:00</span></div>
                 </div>
                 <div class="t_margin10" style="background:#595959; width:100%; padding:3px 10px; color:#fff; text-align:center; font-size:1.15em; font-weight:600">상담은 연중무휴</div>
              </div>
              <div class="col-md-7 hidden-lg hidden-md r_padding50 l_padding50 t_margin30">
                 <div class="clearfix">
                     <div class="col-md-3 col-xs-3">· 평일</div> <div class="col-md-9 col-xs-9 text-right">09:00 ~ 24:00</div>
                     <div class="col-md-3 col-xs-3">· 토요일</div> <div class="col-md-9 col-xs-9 text-right">09:00 ~ 24:00</div>
                 </div>
                 <div class="t_margin10" style="background:#6d717c; width:100%; padding:3px 10px; color:#fff; text-align:center">상담은 연중무휴</div>
              </div>
              <div class="col-md-5 text-center hidden-sm hidden-xs"><img src="<?php echo G5_THEME_IMG_URL;?>/main/icon_clock.png" ></div>
           </div>
        </div>
  
  </div><!--//row--> 
  </div><!--//container--> 
</div><?php */?>



<?php
include_once(G5_PATH.'/tail.php');
?>
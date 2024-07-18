<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <div id="visual">
    	<div class="slogan">
        	<img src="<?php echo G5_THEME_IMG_URL ?>/main/m_text.png" alt="<?php echo $config['cf_title']; ?>">
        </div>
		<div class="slogan_m">
        	<img src="<?php echo G5_THEME_IMG_URL ?>/main/m_text.png" alt="<?php echo $config['cf_title']; ?>">
        </div>
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->
	<div class="m_contents col-xs-12">
		<img src="<?php echo G5_THEME_IMG_URL ?>/main/m_text.png" alt="부산 마리나 셰프 챌린지 2022 참가요강">
	</div>

<div id="idx_container">
    <div class="main_bn container">

		<ul class="box_list col-sm-12">
				<p><?php echo $config['cf_title']; ?></p>
				<h1>신청하기</h1>
			
                <div class="row">
                    <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=live01"><h2>라이브 단체경연 신청</h2></a>
                    </li>
					
                   
                    <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=live02"><h2>라이브 2인 경연 신청</h2></a>
                    </li>
					
					
                   <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=live05"><h2>라이브 1인 경연 신청</h2></a>
                    </li>
					
					
				    <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=live03"><h2>전시경연 신청</h2></a>
                    </li>
						
										
                    <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table==live04"><h2>라이브 카빙경연 신청</h2></a>
                    </li>
					
                    <li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table==live06"><h2>카빙 단체 전시 경연 신청</h2></a>
                    </li>	

                    <!--li class="circle">
							<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=contest"><h2>대회 요강</h2></a>
                    </li-->
                   
                </div>
            </ul>
		
         </div>
         
	<div class="container-fluid play_bg *hidden-xs">

		<div class="play">
        <div style="font-size:24px; padding:10px 0;"> 2023년 부산 마리나 <span style="font-weight:700">셰프 챌린지</span></div>
  <!-- Skitter Styles -->
  <link href="../theme/basic/css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
  
  <!-- Skitter JS -->
  <script type="text/javascript" language="javascript" src="../theme/basic/js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" language="javascript" src="../theme/basic/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" language="javascript" src="../theme/basic/js/jquery.skitter.min.js"></script>
  
  <!-- Init Skitter -->
  <script type="text/javascript" language="javascript">
    $(document).ready(function() {
      $('.box_skitter_large').skitter({
        theme: 'clean',
        numbers_align: 'center',
        progressbar: true, 
        dots: true, 
        preview: true
      });
    });
  </script>




      <div class="border_box">
        <div class="box_skitter box_skitter_large" style="margin-bottom:0px;">
          <ul>
		  
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_01.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_02.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_03.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_04.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_05.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_06.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_07.jpg" class="fade" /></li>		 
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_08.jpg" class="fade" /></li>	
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_09.jpg" class="fade" /></li>  
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_10.jpg" class="fade" /></li>  
		 
		 <!--li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_11.jpg" class="fade" /></li>
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_12.jpg" class="fade" /></li>
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_13.jpg" class="fade" /></li>
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_14.jpg" class="fade" /></li>
         <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_15.jpg" class="fade" /></li>
		 
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_16.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_17.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_18.jpg" class="fade" /></li>		 
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_19.jpg" class="fade" /></li>
		 <li><img src="<?php echo G5_THEME_IMG_URL ?>/slide/img_20.jpg" class="fade" /></li-->
		 
          </ul>
        </div>



  </div>









		
		<!--div style="font-size:24px; padding:10px 0;"> 2018년 부산마리나셰프 발대식 영상 </div-->
		
		<!--div style="position:relative;height:0;padding-bottom:56.25%"><iframe src="https://www.youtube.com/embed/LJsQ8ZV_WZI?ecver=2" width="100%" height="300" frameborder="0" allow="autoplay; encrypted-media" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div-->
		
		
		
		</div>
	</div>
    </div><!--//main_sev-->

</div><!-- #idx_container -->
<div class="container-fluid cus">
<div class="row">
            <div class="customer">
				<div class="col-xs-12 cs_banner">
                    <div class="hotel">
                    선수 숙박지정호텔 : 센텀 프리미엄 호텔(051-755-9000), 해운대 블루스토리 호텔(051-731-9900)
                    </div>
					<h2><img src="<?php echo G5_THEME_IMG_URL ?>/main/cscenter.png" alt="cscenter"> CUSTOMER CENTER</h2>
					<p class="add_ex">문의사항이 있으시면 연락주세요</p>
					<h3><span></span> <b><?php echo $config['cf_4']; ?></b></h3>
					<div class="fax">
					   <i class="fas fa-fax"></i> Fax : <?php echo $config['cf_5']; ?>&nbsp;<br>
					   <i class="fas fa-envelope"></i> E-mail : <?php echo $config['cf_6']; ?>
					 <p style="font-size:1.2em; color:#fff">대회비 입금계좌 : 101-2037-2266-05 부산은행 (사)한국조리사협회중앙회부산광역시지회</p>
					</div>
				</div>
            </div>
</div>
</div>
<?php
include_once(G5_PATH.'/tail.php');
?>
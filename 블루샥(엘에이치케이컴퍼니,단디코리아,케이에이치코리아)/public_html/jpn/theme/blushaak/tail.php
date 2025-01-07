<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

<? if(defined('_INDEX_')) {?>
<? }else if($bo_table == "" || $co_id == ""){ ?>
            </div><!--#scont-->
        </div><!--#scont_wrap-->
      </div><!--#container-->
<? } ?>   
</div><!--#wrapper-->


<!-- } 콘텐츠 끝 -->

<hr>

<div class="clearfix"></div>

<? if(defined('_INDEX_')) {?>
<? }else{ ?>

<!-- Footer -->
<div id="ft" class="clearfix">
  <div class="ft_area clearfix">
    <div class="flogo col-md-7">
        <div id="ft_copy" class="hidden-sm hidden-xs">
        <!--상호-->
        <p class="ct">株式会社ダンディコリア－ブルーシャーク </p>
        <!--상호-->
        <!--기본정보-->
        
        代表者 : Gye Taeung&nbsp;&nbsp;
        <!--<?php echo $config['cf_5_subj']; ?> <?php echo $config['cf_5']; ?>&nbsp;&nbsp;-->
        メール : sales@dandikorea.com<?php /*echo $config['cf_6']; */?><br />
        事業者登録番号 <?php echo $config['cf_3']; ?><br />
        <?php echo $config['cf_7_subj']; ?> ソウル特別市広津区陵洞246-14 2階<br />
        <?php echo $config['cf_1_subj']; ?>
        <?php echo $config['cf_10_subj']; ?>釜山広域市海雲台区センタム北大路60、ISタワー1907号&nbsp;&nbsp;
        <?php echo $config['cf_9_subj']; ?> <?php echo $config['cf_9']; ?>&nbsp;&nbsp;
        <?php echo $config['cf_8_subj']; ?> <?php echo $config['cf_8']; ?>
        <!--<p class="fmenu t_margin15">사이트이용약관&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;개인정보처리방침</p>-->
        <!--기본정보-->
        <br /><br /><span>COPYRIGHT(c)2020  Blu Shaak. ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
        <?php if ($is_admin) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a> <a href="<?php echo G5_URL ?>/adm/member_list.php" target="_blank" style="color:#fff;">관리자 접속</a>
        <?php } else if ($is_member) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a> 
        <?php } else {  ?>
        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
        <?php }  ?></span>
    </div>
    
    </div>

    <div id="ft_copy" class="hidden-md hidden-lg">
        <!--상호-->
        <!--<p class="ct">Dandi Korea Co., Ltd. – Blu Shaak </p>-->
        <!--상호-->
        <!--기본정보-->
        <?php echo $config['cf_2_subj']; ?>株式会社ダンディコリア－ブルーシャーク <br />
        <!--<?php echo $config['cf_5_subj']; ?> <?php echo $config['cf_5']; ?><br />-->
        メール : sales@dandikorea.com<?php /*echo $config['cf_6']; */?><br />
        事業者登録番号 <?php echo $config['cf_3']; ?><br />
        <?php echo $config['cf_7_subj']; ?> ソウル特別市広津区陵洞246-14 2階<br />
        <?php echo $config['cf_1_subj']; ?> 釜山広域市海雲台区センタム北大路60、ISタワー1907号<br />
        <!--<p class="fmenu t_margin15">사이트이용약관&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;개인정보처리방침</p>-->
        <div class="hidden-lg hidden-md b_margin20"></div>
        <!--기본정보-->
        <br /><br /><span>COPYRIGHT(c)2020 Blu Shaak. ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
        <?php if ($is_admin) {  ?>
        <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>  &nbsp; 관리자 접속
        <?php } else {  ?>
        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
        <?php }  ?></span>
    </div>

    <div class="col-md-3 bottom_pro hidden-sm hidden-xs t_margin40">
        <p class="tel"><span>フランチャイズ専用相談窓口</span><br />+82 10-6555-0662</p>
        <p class="fax">メール : sales@dandikorea.com<?php /*echo $config['cf_6']; */?><!--<br />E-mail : <?php echo $config['cf_7']; ?>--></p>
    </div>
    
    <div class="hidden-lg hidden-md b_margin20"></div>
    <div class="col-md-2 t_margin40">
      <div class="clearfix">
          <!--<a href="javascript:alert('Preparing to Catalog.')">
          <div class="col-md-12 col-xs-12 t_margin10" style="position:relative">
              <div class="ft_circle03">
                 <img src="<?php echo G5_THEME_IMG_URL ?>/common/icon_bottom03.png" alt="" />
              </div>
              <div class="ft_banner_t"><span>ILJINNTS</span><br />Catalog / Brochure</div>
          </div></a>-->
      </div>
      <div class="bottom_sns clearfix">
         <div><a class="twitter" style="color:#fff" href="<?php echo G5_BBS_URL; ?>/content.php?co_id=contact_jpn"><i class="fal fa-pen"></i>フランチャイズ専用相談窓口</a></div>
         <div class="t_margin5"><a class="facebook" style="color:#fff" href="<?php echo G5_BBS_URL; ?>/content.php?co_id=franchise01_jpn"><i class="fal fa-building"></i>トレーニングシステムの紹介</a></div>
      </div>
    </div>
    
  </div>
</div>
<!-- //Footer -->   
<? } ?> 


<!--top버튼-->
<div class="btm_menu"><a href="#"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_top.png"></a></div>

<script type="text/javascript">

$(".btm_menu").hide();
 
// fade in #back-top
$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.btm_menu').fadeIn();
        } else {
            $('.btm_menu').fadeOut();
        }
    });
});

   $('.btm_menu').click(function($e){
   $('html, body').animate({scrollTop:0}); return false
 });
</script>


<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<!--<a href="<?php echo get_device_change_url(); ?>" id="device_change">모바일 버전으로 보기</a> -->
<?php
}
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<?php
include_once(G5_PATH."/tail.sub.php");
?>
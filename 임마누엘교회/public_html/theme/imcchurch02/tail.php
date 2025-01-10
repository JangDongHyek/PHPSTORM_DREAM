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
	 <? }else if($co_id == "sub01"){ ?>	
   
   <div class="subfooter">
       <div class="inr footer_text">
           <h1>LET’S DO SOME IMC!</h1>
           <p>오십시오! 초청합니다!
당신도 우리와 함께 축복의 주인공이 될 수 있습니다.
예수님의 이름 안에 환영합니다!</p>
       </div>
       <div class="footer_slider">
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide01.png" alt=""></div>
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide02.png" alt=""></div>
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide03.png" alt=""></div>
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide04.png" alt=""></div>
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide05.png" alt=""></div>
           <div><img src="<?php echo G5_THEME_IMG_URL ?>/sub/footer_slide06.png" alt=""></div>
       </div>
   </div>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
    </div>
    </div>
    </div>
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
    </div>
    </div>
    </div>
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<div id="footer">    
    <div class="inr">			
        <div class="ft_info">
            <div class="wrap">
             <div id="f_logo">
                <a class="white" href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_korean_white.svg" alt="<?php echo $config['cf_title']; ?>"></a>
            </div><!--#logo-->
                <div class="sitemap">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision" class="color_blue">이용약관</a>
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="color_blue">개인정보처리방침</a>
                    
                    <?php
                    $sql = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '2'
                                order by me_order, me_id ";
                    $result = sql_query($sql, false);
                    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

                    for ($i=0; $row=sql_fetch_array($result); $i++) {
                    ?>
                    <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>">
                        <?php echo $row['me_name'] ?>
                    </a>
                    <?php } ?>
                </div>
            </div>

           <div class="wrap">
            <address>
<!--                <h1><?php echo $config['cf_title']; ?></h1> <br>-->
                <div>
                    <p><?php echo $config['cf_1_subj']; ?></p> 
                    <span><?php echo $config['cf_1']; ?></span>
                </div>
                <div>
                    <p><?php echo $config['cf_2_subj']; ?></p> 
                    <span><?php echo $config['cf_2']; ?></span>
                </div>
                <div>
                    <p><?php echo $config['cf_3_subj']; ?></p> 
                    <span><?php echo $config['cf_3']; ?></span>
                </div>
				<br class="hidden-xs">
                <div>
                    <p><?php echo $config['cf_4_subj']; ?></p> 
                    <span><?php echo $config['cf_4']; ?></span>
                </div>
      
                <div class="first">
                    <p><?php echo $config['cf_5_subj']; ?></p> 
                    <span><?php echo $config['cf_5']; ?></span>
                </div>
                <div>
                    <p><?php echo $config['cf_6_subj']; ?></p> 
                    <span><?php echo $config['cf_6']; ?></span>
                </div>

                <div>
                    <p><?php echo $config['cf_8_subj']; ?></p> 
                    <span><?php echo $config['cf_8']; ?></span>
                </div>
                <div class="copy">
                    <p>COPYRIGHT ⓒ 2024 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.</p>
                </div>
            </address>
            <div class="sns_wrap">
                <a href="https://blog.naver.com/letsdoimc" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/blog.svg" alt=""></a>
                <a href="https://www.instagram.com/imc_worship_official/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/insta.svg" alt=""></a>
                <a href="https://www.youtube.com/channel/UC8XsX2FEj61FL20MlTDjV8g" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/youtube.svg" alt=""></a>
                <a href="https://www.facebook.com/IMCworship/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/facebook.svg" alt=""></a>
            </div>
            </div>
        </div>
    </div>	
</div><!--#footer--> 

    

    




<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});



</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
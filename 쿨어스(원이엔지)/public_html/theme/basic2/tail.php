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

<div id="footer">    
    <div class="inr v2">			
        <div class="ft_info">
             <div id="f_logo">
                <a class="white" href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            </div><!--#logo-->

            <address>
<!--                <h1><?php echo $config['cf_title']; ?></h1> <br>-->
                <div>
                    <p><?php echo $config['cf_1_subj']; ?></p> 
                    <span><?php echo $config['cf_1']; ?></span>
                </div>
			    <div>
                    <p><?php echo $config['cf_7_subj']; ?></p> 
                    <span><?php echo $config['cf_7']; ?></span>
                </div>
				<br class="hidden-xs">
                <div>
                    <p><?php echo $config['cf_2_subj']; ?></p> 
                    <span><?php echo $config['cf_2']; ?></span>
                </div>
                <div>
                    <p><?php echo $config['cf_3_subj']; ?></p> 
                    <span><?php echo $config['cf_3']; ?></span>
                </div>
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
                    <p>COPYRIGHT(c) 2024 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.</p>
                </div>
            </address>
        </div>
    </div>	
            <div class="scrolltop">
                <a href="#hd" class="goHd">
                    <i class="icon"></i>
                    <i class="txt">TOP</i>
                </a>			
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
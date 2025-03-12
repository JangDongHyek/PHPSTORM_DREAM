<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
            
            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
		 <? if($bo_table){ ?>
        </div> <!--#inner-->
		<?}?>
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
		<div class="inr">
			<div class="ft_info v2">
                <h1><?php echo $config['cf_title']; ?></h1>
                <address>
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
                    <div>
                        <p><?php echo $config['cf_4_subj']; ?></p>
                        <span><?php echo $config['cf_4']; ?></span>
                    </div>
                    <div>
						<p><?php echo $config['cf_5_subj']; ?></p> 
						<span><?php echo $config['cf_5']; ?></span>
					</div>
                    <div>
                        <p><?php echo $config['cf_6_subj']; ?></p>
                        <span><?php echo $config['cf_6']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_7_subj']; ?></p>
                        <span><?php echo $config['cf_7']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_8_subj']; ?></p>
                        <span><?php echo $config['cf_8']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_9_subj']; ?></p>
                        <span><?php echo $config['cf_9']; ?></span>
                    </div>
                    <div>
                        <p><?php echo $config['cf_10_subj']; ?></p>
                        <span><?php echo $config['cf_10']; ?></span>
                    </div>
				</address>
                <div class="copy">
                    <p>COPYRIGHT(c) 2023 <strong><?php echo $config['cf_title']; ?>.</strong> ALL RIGHTS RESERVED.&nbsp;&nbsp;&nbsp;
                        <?php if ($is_admin) {  ?>
                            <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a> &nbsp; <a href="<?php echo G5_URL ?>/adm/config_form.php#anc_cf_extra" target="_blank" style="color: #fff !important">관리자페이지 접속</a>
                        <?php } else {  ?>
                        <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
                        <?php }  ?></span></p>
                </div>
			</div>
			<div class="ft_info v3">
				<div class="scrolltop">
					<a href="#hd" class="goHd">SCROLL UP <i class="fa-light fa-angle-up"></i></a>
					
				</div>
                <ul class="sns flex">
                    <li><a><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png"></a></li>
					<li><a><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_band.png"></a></li>
                </ul>
<!--				<ul class="area_cs flex">
                    <div>
                        <h2>Customer Center</h2>
                        <em>문의있으시면 연락주세요</em>
                        <ul class="call">
                            <li><i class="fa-solid fa-phone"></i> <?php /*echo $config['cf_4']; */?></li>
                        </ul>
                    </div>
				</ul>-->
			</div>

			<div class="line">
				<i></i>
				<i></i>
			</div>
		</div>	
	</div><!--#footer--> 



<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>
<script src="<?php echo G5_THEME_JS_URL ?>/jquery.bxslider.min.js"></script><!--메인슬라이더에 필요한 js-->

<script src="<?php echo G5_THEME_JS_URL ?>/mainslider.js"></script><!--메인슬라이더에 필요한 js-->

<?php
include_once(G5_PATH."/tail.sub.php");
?>
<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

        </div> <!--#inner-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>



<!-- } 콘텐츠 끝 -->

	<div id="footer">       
		<div class="inr">
            <div>
                <div class="ft_info v1">
                    <h1><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.svg" alt="<?php echo $config['cf_title']; ?>"></h1>
                    <ul class="ft_menu">
                        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">삼삼경매 소개</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">사이트 이용약관</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy" class="color">개인정보처리방침</a></li>
                        <!--<li><a href="<?php /*echo G5_BBS_URL */?>/content.php?co_id=map">찾아오시는 길</a></li>-->
                    </ul>

                    <!--<div class="btn_mfoot">
                        <a href="<?php /*echo G5_BBS_URL */?>/content.php?co_id=info03" class="btn_foot02">비급여항목 안내</a>
                        <a href="javascript:alert('준비중입니다.');" class="btn_foot02 kakao"><img src="<?php /*echo G5_THEME_IMG_URL */?>/common/ic_kakaoch.png">카카오 채널톡</a>
                    </div>-->


                </div>
                <div class="ft_info v2">
                    <address>
                        <div>
                            <p><?php echo $config['cf_1_subj']; ?></p>
                            <span><?php echo $config['cf_1']; ?></span>
                        </div>
                        <div>
                            <p><?php echo $config['cf_2_subj']; ?></p>
                            <span><?php echo $config['cf_2']; ?></span>
                        </div>
                        <br>
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
                        <br>
                        <div>
                            <p>MON-FRI 09:00 ~ 18:00 / SAT 10:00 ~ 15:00 SUNDAY, HOLIDAY OFF</p>
                        </div>
                    </address>
                    <div class="copy">
                        <p>COPYRIGHT(c) 2024 <strong>samsam auction.</strong> ALL RIGHTS RESERVED..&nbsp;&nbsp;&nbsp;
                            <?php if ($is_admin) {  ?>
                            <a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>
                            <?php } else {  ?>
                            <a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
                            <?php }  ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="ft_info v3">
                <div class="sns_wrap">
                    <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                </div>
                <div class="area_cs">
                    <div class="call">
                        대표전화 <strong><?php echo $config['cf_9']; ?></strong>
                    </div>
                    <div class="scrolltop">
                        <a href="#hd" class="goHd"><i class="fa-regular fa-chevron-up"></i><p>TOP</p></a>
                    </div>
                </div>
                <div class="select">
                    <select>
                        <option>Family Site</option>
                    </select>
                </div>
			</div>
        </div>
	</div>
	<!--#footer-->


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>
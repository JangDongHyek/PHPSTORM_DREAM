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

	<!--롤링배너-->
	<div id="fav_area" class="wow fadeInUp animated" data-wow-delay="0.5s">
		<div class="fav inr">
			<div class="slide-wrap">
				
				<div class="arr">
					<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_partner.png" alt="">
					관련사이트
					<a class="btn-prev" href="javascript:;"><i class="fa-regular fa-angle-left"></i></a>
					<a class="btn-next" href="javascript:;"><i class="fa-regular fa-angle-right"></i></a>
				</div>

				<div class="slide-box">
					<div class="thm"><a href="https://www.mohw.go.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner01.png" alt="보건복지부"></a></div>
					<div class="thm"><a href="http://ansim.org/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner02.png" alt="안심생활"></a></div>
					<div class="thm"><a href="http://www.ansimcenter.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner03.png" alt="안심노인종합복지센터"></a></div>
					<div class="thm"><a href="http://안심요양원.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner04.png" alt="안심노인요양시설"></a></div>
					<div class="thm"><a href="https://www.pnuh.or.kr/pnuh/intro.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner07.png" alt="부산대학교병원"></a></div>
					<div class="thm"><a href="https://www.paik.ac.kr/haeundae/user/main/view.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner08.png" alt="인제대학교해운대백병원"></a></div>
					<div class="thm"><a href="https://www.damc.or.kr/main/main_2017.php" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner09.png" alt="동아대학교병원"></a></div>
					<div class="thm"><a href="https://www.demc.kr/intro/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner10.png" alt="동의의료원"></a></div>
					<div class="thm"><a href="https://www.bumin.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner11.png" alt="부민병원"></a></div>
					<div class="thm"><a href="https://www.daedong.ac.kr/main.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner12.png" alt="대동대학교"></a></div>
					<div class="thm"><a href="http://hyrmd.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner05.png" alt="한양류마디병원"></a></div>
					<div class="thm"><a href="http://www.aekwang.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner06.png" alt="애광원"></a></div>
					
					<div class="thm"><a href="https://www.mohw.go.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner01.png" alt="보건복지부"></a></div>
					<div class="thm"><a href="http://ansim.org/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner02.png" alt="안심생활"></a></div>
					<div class="thm"><a href="http://www.ansimcenter.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner03.png" alt="안심노인종합복지센터"></a></div>
					<div class="thm"><a href="http://안심요양원.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner04.png" alt="안심노인요양시설"></a></div>
					<div class="thm"><a href="https://www.pnuh.or.kr/pnuh/intro.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner07.png" alt="부산대학교병원"></a></div>
					<div class="thm"><a href="https://www.paik.ac.kr/haeundae/user/main/view.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner08.png" alt="인제대학교해운대백병원"></a></div>
					<div class="thm"><a href="https://www.damc.or.kr/main/main_2017.php" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner09.png" alt="동아대학교병원"></a></div>
					<div class="thm"><a href="https://www.demc.kr/intro/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner10.png" alt="동의의료원"></a></div>
					<div class="thm"><a href="https://www.bumin.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner11.png" alt="부민병원"></a></div>
					<div class="thm"><a href="https://www.daedong.ac.kr/main.do" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner12.png" alt="대동대학교"></a></div>
					<div class="thm"><a href="http://hyrmd.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner05.png" alt="한양류마디병원"></a></div>
					<div class="thm"><a href="http://www.aekwang.or.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/partner06.png" alt="애광원"></a></div>
				</div>      
			</div>
		</div>
	</div>

	<!--롤링배너-->
<script>

	//롤링배너
	$('.slide-box').each(function(){
		$(this).slick({
			slidesToShow:4,
			slidesToScroll: 1,
			speed: 1000,
			autoplay:true,
			autoplaySpeed: 2000,
			infinite: true,
			dots: false,
			accessibility: true,
			arrows: true,
			prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
			nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
			responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절할 수 있음.
				{
					breakpoint: 990,
					settings: {
						slidesToShow: 3,
					}
				}
			] 

		})
	})
</script>

<!-- } 콘텐츠 끝 -->

<hr>

	<div id="footer">       
		<div class="inr">			
			<div class="ft_info v1">
				<h1>안심요양병원</h1> 
				<ul class="ft_menu">
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">병원소개</a></li> 
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">이용안내</a></li>  
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></li>  
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03">찾아오시는 길</a></li>  
				</ul>
				<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info03" class="btn_foot">비급여항목 안내</a>
				<a href="javascript:alert('준비중입니다.');" class="btn_foot kakao"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_kakaoch.png">카카오 채널톡</a>
                
                <div class="btn_mfoot">
                    <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info03" class="btn_foot02">비급여항목 안내</a>
                    <a href="javascript:alert('준비중입니다.');" class="btn_foot02 kakao"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_kakaoch.png">카카오 채널톡</a>
                </div>
                
                
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
				</address>
				<div class="copy">
					<p>COPYRIGHT(c) 2022 <strong>ansim geriatric hospital.</strong> ALL RIGHTS RESERVED..&nbsp;&nbsp;&nbsp;
						<?php if ($is_admin) {  ?>
						<a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-unlock"></i></a>
						<?php } else {  ?>
						<a href="<?php echo G5_BBS_URL ?>/login.php"><i class="fa fa-lock"></i></a>
						<?php }  ?></span>
					</p>
				</div>
			
			</div>
			<div class="ft_info v3">
<!--
				<div class="scrolltop">
					<a href="#hd" class="goHd"><i>SCROLL UP</i></a>					
				</div>
-->
				<!--<div class="sns_wrap">
					<a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
					<a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
				</div>-->
			</div>

		</div>	
	</div>
	<!--#footer--> 

<!--우측 고정 배너-->
<div class="fix_right">
    <ul>
        <li><a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="far fa-bars"></i></a></li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=intro01">
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/common/fix_icon00.png" alt=""></div>
            <p>진료 안내</p>
            </a>
        </li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info01">
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/common/fix_icon01.png" alt=""></div>
            <p>입퇴원 안내</p>
            </a>
        </li>
        <li>
            <a href="tel:"><p class="tel"><span>051.</span><br />865.<br />0300</a>
        </li>
        <li><a href="#hd" class="topHd"><i class="far fa-chevron-up"></i></a></li>
    </ul>
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
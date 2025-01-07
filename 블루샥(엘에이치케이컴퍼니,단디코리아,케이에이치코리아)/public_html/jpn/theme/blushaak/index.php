<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/main.css"> <!-- Resource style -->
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL; ?>/swiper.min.css"><!-- Rolling css -->
<!--메인페이지-->

<section id="section1" class="cd-section wow fadeInUp">
	<div class="content-wrapper">
        
        <!--<canvas id="canvas" class="" style="width:100%; height:100%"></canvas>//dot animation-->
        
		<h2 class="hidden">INTRO</h2>
        <div class="slogan">
           <p class="t0 text-left wow fadeInDown" data-wow-delay="0.1s">Blu Shaak COFFEE</p>
           <!--<p class="t1 text-center wow fadeInUp" data-wow-delay="0.3s">아이티포원이 고객님께 드리는 믿음과 의지입니다.</p>-->
           <p class="t2 text-left wow fadeInDown" data-wow-delay="0.5s"><span>Blu Shaakが譲らないバリュー。それは、確かな品質と美味しさ。</span></p>
           <!--<p class="bar wow bounceIn"  data-wow-delay="1.3s"></p>-->
        </div>
        
        <!--공지추출-->
        <div class="m_latest wow fadeInUp" data-wow-delay=".2s">
            <?php echo latest("theme/basic", "b_news_jpn", "1", "30");?>
        </div>
        
        <a href="#section2" class="cd-scroll-down wow fadeInUp" data-wow-delay=".4s">
            <div class="mouse hidden-sm hidden-xs"></div>
            <p class="t_padding10 hidden-sm hidden-xs" style="font-size:1.0em; font-weight:400; line-height:1.0em; color:#fff">Scroll</p>
        </a>
	</div>
    
    

    <div id="idx_wrapper">
        <!--메인슬라이더 시작-->
        <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
            <ul class="sliderbx">
                <li class="mv01"></li>
                <li class="mv02"></li>
            </ul><!--.sliderbx-->
        </div><!-- //visual -->
    </div><!--  #idx_wrapper -->
    
</section><!-- cd-section -->

<article>
   <div class="m_call wow fadeInUp" data-wow-delay="0.4s">
           <p class="t1 text-center"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="" style="color:#fff !important" data-transition="slide">フランチャイズ専用相談窓口&nbsp;<i class="fa fa-phone-square"></i></a></p>
           <p class="t0 text-center">+82 10-6555-0662</p>
           <!--<div class="menu_roll">
                 <img src="<?php echo G5_THEME_IMG_URL;?>/main/symbol.png" alt="">
           </div>-->
        </div>
</article>

<!-- 배너 -->
<section id="section2" class="cd-section wow fadeInUp" data-wow-delay="0.1s">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Business Partnership</h2>
        <p class="ht wow fadeInDown t_padding20" data-wow-delay="0.5s">“勝てる”ブランド力を手に入れよう。</p>
		<p class="wow fadeInUp">オーナーのニーズに合わせた満足度の高いコンサルティング＆サービス</p>
    
        <div class="m_content02 clearfix t_margin50 b_margin50">
                        <div class="mbanner_list">
                            <ul>
                                <li class="wow fadeInDown" data-wow-delay="0.6s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">CREATIVE IDEAS</p>
                                     <p class="cont text-center">個性と競争力のあるブランドデザイン・マーケティング手法を丁寧にレクチャーします。</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.7s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">BLU SHAAK</p>
                                     <p class="cont text-center">常に研究開発を行い、より美味しく、<br />より新しいBLU SHAAKを追求し続けます。</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.8s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">COOPERATION</p>
                                     <p class="cont text-center">オーナー様との良好なパートナーシップを大切にしています。</p>
                                </li>
                                <li class="wow fadeInDown" data-wow-delay="0.9s">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth" alt=""></div>
                                     <p class="tit text-center t_margin20">BLENDING</p>
                                     <p class="cont text-center">オリジナルのスペシャルコーヒー<br />深い味わいの”ナイト”<br />柔らかい酸味を感じる”サンセット”<br />”デカフェ”の3つのスタイルをご提供します。</p>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Swiper -->
                        <div class="swiper-container mbanner_list02">
                            <ul class="swiper-wrapper">
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img01.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">CREATIVE IDEAS</p>
                                     <p class="cont text-center">店主に競争力のある<br />ブランドデザインとマーケティングを統合サービスいたします。</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img02.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">BLU SHAAK</p>
                                     <p class="cont text-center">より良いBLU SHAAKのために<br />絶え間ない研究開発を進めています。</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img03.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">COOPERATION</p>
                                     <p class="cont text-center">オーナー様との共生協力を<br />何よりも大切にしております。</p>
                                </li>
                                <li class="swiper-slide">
                                     <div class="img"><img src="<?php echo G5_THEME_IMG_URL;?>/main/mbanner_img04.png" class="imgWidth"></div>
                                     <p class="tit text-center t_margin20">BLENDING</p>
                                     <p class="cont text-center"> 深みのある味わい"ナイト"<br />柔らかくて酸味が感じられる"サンセット"<br />"デカフェ"の3つのスタイルの<br />高品質のスペシャルコーヒー豆を使用しています。</p>
                                </li>
                            </ul>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>                                  
          </div>
    
	</div>
</section>
<!-- //배너 -->

<!-- 포트포리오 -->
<section id="section3" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Blu Shaak メニュー</h2>
        <!--<p class="ht wow fadeInDown t_padding20" data-wow-delay="0.5s">Tea/Beverage/Dessert</p>-->
		<p class="wow fadeInUp">Tea / Beverage / Dessert</p>
        <div class="port">
            <ul>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">シャークラテ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port01.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>シャークラテ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu01_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">アイスアメリカーノ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port02.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>アイスアメリカーノ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu01_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">カフェラテ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port03.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Coffee</h4>
                        <h2>カフェラテ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu01_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">ブルーベリーヨーグルト</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port04.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Beverage</h4>
                        <h2>ブルーベリーヨーグルト</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu02_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">ヴァローナミントチョコフラッペ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port05.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Tea</h4>
                        <h2>ヴァローナミントチョコフラッペ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu02_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">マンゴーバナナフラッペ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port06.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Tea</h4>
                        <h2>マンゴーバナナフラッペ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu02_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">ヘーゼルナッツフィナンシェ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port07.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Dessert</h4>
                        <h2>ヘーゼルナッツフィナンシェ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu04_jpn"></a>
                    </figure>
                </li>
                <li>
                    <figure class="snip1425">
                      <div class="gradi"></div>
                      <h2 class="tit">カヌレ</h2>
                      <img src="<?php echo G5_THEME_IMG_URL;?>/main/port08.jpg" alt="" />
                      <figcaption><i class="fal fa-plus"></i>
                        <h4>Dessert</h4>
                        <h2>カヌレ</h2>
                      </figcaption>
                      <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu04_jpn"></a>
                    </figure>
                </li>
            </ul>
        </div>
        <div class="t_margin30"><p class="more"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=menu01_jpn">+ もっと見る</a></p></div>
	</div>
</section>
<!-- //포트포리오 -->

<!-- 파트너사 
<section id="section4" class="cd-section">
	<div class="content-wrapper">
		<h2 class="hidden">BUSINESS FAMILY</h2>
		<h2 class="wow bounceIn" data-wow-delay="0.3s">FAMILY PARTNER BRAND</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">행복한 삶을 추구합니다.</p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">(주)엘에이치케이컴퍼니와 함께 하는 브랜드 입니다.</p>
        <div class="partnerLink">
             <ul>
                  <li class="wow fadeInDown" data-wow-delay="0.1s"><a href="http://www.chunjabeer.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/01.png" alt="오춘자비어" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.2s"><a href="http://www.sumbisori.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/02.png" alt="숨비소리" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.3s"><a href="http://www.pighouse.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/03.png" alt="뚱보집" /></a></li>
                  <li class="wow fadeInDown" data-wow-delay="0.4s"><a href="http://www.xn--o39a0so33dnmo.com/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/link/04.png" alt="원가회관" /></a></li>
             </ul>
        </div>
	</div>
</section>-->


<!--회사정보-->
<section id="section5" class="cd-section">
	<div class="content-wrapper">
		<h2 class="wow bounceIn" data-wow-delay="0.3s">Customer</h2>
        <p class="ht_g wow fadeInDown t_padding20" data-wow-delay="0.5s">Blu Shaak ならではの味をお届けするために</p>
		<p class="wow fadeInUp hc" data-wow-delay="0.8s">今も多くの研究開発を進めています。</p>
        
            <div class="container">
                <div class="pt_150">    
                    <div class="direct_wrap02">
                        <div class="map_box02 wow fadeInRight" data-wow-delay="0.2s">
                            <!-- * Daum 지도 - 지도퍼가기 -->
                            <!-- 1. 지도 노드 -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.0280196384633!2d127.0825908155882!3d37.554403632580055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca52ac45df0a5%3A0x743f2170999d2d19!2z7ISc7Jq47Yq567OE7IucIOq0keynhOq1rCDriqXrj5kgMjQ2LTE0IDLsuLU!5e0!3m2!1sko!2skr!4v1675839793081!5m2!1sko!2skr" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
                            <!--
                                2. 설치 스크립트
                                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                            -->
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://spi.maps.daum.net/imap/map_js_init/roughmapLoader.js"></script>
        
                            <!-- 3. 실행 스크립트 -->
							<script charset="UTF-8">
								new daum.roughmap.Lander({
									"timestamp" : "1636938981483",
									"key" : "282mx",
									"mapWidth" : "100%",
									"mapHeight" : "500"
								}).render();
							</script>
                        </div>
                        
                        <div class="direct_box02 wow fadeInLeft" data-wow-delay="0.3s">
                            <ul class="direct_ul02">
                                <li><i class="fal fa-home-lg"></i><strong>ブルーシャーク 株式会社ダンディコリア - [SEOUL]</strong></li>
                                <li><i class="fal fa-user-check"></i>代表取締役 : Gye Taeung</li>
                                <li><i class="fal fa-phone-square"></i>事業者登録番号 : <?php echo $config['cf_3']; ?></li>
                                <li><i class="fal fa-phone-square"></i>+82 10-6555-0662 (フランチャイズ専用相談窓口) </li>
                                <li><i class="fal fa-envelope-open"></i>gye@dandikorea.com<?php /*echo $config['cf_6']; */?></li>
                                <li><i class="fal fa-map-marker-alt"></i>
                                    ソウル特別市広津区陵洞246-14 2階<br><br>
                                    <!--span class="bg1" style="background:#10aa18">2호선 역삼역 </span> 8번출구 도보 3분거리 -->
                                </li>
                                <li><i class="fab fa-weixin"></i> blushaakkorea</li>
                                <li><i class="fab fa-line"></i> blushaak</li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
            
            
        
            <div class="container">
                <div class="">    
                    <div class="direct_wrap">
                        <div class="map_box wow fadeInLeft" data-wow-delay="0.2s">
                            <!-- * Daum 지도 - 지도퍼가기 -->
                            <!-- 1. 지도 노드 -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1153.018952740765!2d129.12527255392084!3d35.175817570429224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x356893aca0f96447%3A0xb15ef62e4f9964d8!2z7IS87YWASVPtg4Dsm4w!5e0!3m2!1sko!2skr!4v1675839077196!5m2!1sko!2skr" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>>
        
                            <!--
                                2. 설치 스크립트
                                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
                            -->
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://spi.maps.daum.net/imap/map_js_init/roughmapLoader.js"></script>
        
                            <!-- 3. 실행 스크립트 -->
                            <script charset="UTF-8">
                                new daum.roughmap.Lander({
		                            "timestamp" : "1636939086601",
		                            "key" : "282n2",
                                    "mapWidth" : "100%",
                                    "mapHeight" : "500"
                                }).render();
                            </script>
                        </div>
                        
                        <div class="direct_box wow fadeInRight" data-wow-delay="0.3s">
                            <ul class="direct_ul">
                                <li><i class="fal fa-home-lg"></i><strong>ブルーシャーク - [BUSAN]</strong></li>
                                <!--<li><i class="fal fa-user-check"></i><?php echo $config['cf_2_subj']; ?><?php echo $config['cf_2']; ?></li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_3_subj']; ?><?php echo $config['cf_3']; ?></li>
                                <li><i class="fal fa-phone-square"></i><?php echo $config['cf_4']; ?> (프랜차이즈 창업 전문상담) </li>	-->
                                <li><i class="fal fa-phone-square"></i>+82 51-752-2888</li>
                                <li><i class="fal fa-envelope-open"></i>gye@dandikorea.com<?php /*echo $config['cf_6']; */?></li>
                                <li><i class="fal fa-map-marker-alt"></i>
                                     釜山広域市海雲台区センタム北大路60、ISタワー1907号<br><br>
                                    <!--span class="bg1">2호선 금련산역 </span> 5번출구 도보 10분거리 -->
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
        
	</div>
</section>
<!--//회사정보-->

<!--//section-->

<!--//메인페이지-->
<!-- Swiper JS -->
<script src="<?php echo G5_THEME_JS_URL ?>/swiper.min.js"></script>
<script>
var swiper = new Swiper('.swiper-container', { //롤링배너
	pagination: '.swiper-pagination',
	paginationClickable: true,
	slidesPerView: 4,
	spaceBetween: 20,
	loop:true,
	autoplay: 2500,
	breakpoints: {
		1024: {
			slidesPerView: 3,
			spaceBetween: 0
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 0
		},
		640: {
			slidesPerView: 2,
			spaceBetween: 0
		},
		380: {
			slidesPerView: 1,
			spaceBetween: 0
		}
	}
});

$(".hover").mouseleave( //포트폴리오
  function () {
    $(this).removeClass("hover");
  }
);
</script>
<script src="<?php echo G5_THEME_JS_URL ?>/main.js"></script> <!-- Resource jQuery -->
<?php
include_once(G5_PATH.'/tail.php');
?>
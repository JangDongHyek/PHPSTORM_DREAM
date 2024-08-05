<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
$sql = "select * from g5_write_event where wr_view_yn = 'Y' order by wr_id desc";
$event_result = sql_query($sql);

$sql = "select * from g5_write_news where wr_view_yn = 'Y' order by wr_id desc";
$news_result = sql_query($sql);


?>

<link href="<?php echo G5_THEME_CSS_URL; ?>/ani/fullpage.css" rel="stylesheet" type="text/css"><!--메인컨텐츠-->
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />


	<div id="fullpage" class="mainfull "> 
		<!-- mobile ver -->
		<section class="section " id="section0" >
			<div class="mainVisualWrap mobVer">
				<div class="scroll_box"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_scroll.png" alt="" class="scroll_ico"></div>
				<div class="mainVisual swiper-container ">
					<div class="swiper-pagination"></div>
					<div class="swiper-wrapper">  
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">Experience the lifestyle<br>부산시중앙신협 멤버스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_m_visual01.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">여행은 멀리있지 않습니다</p>
								<p class="txt">품격있는 여행을 위한 엘시티 프라이빗뷰 레지던스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_m_visual02.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">품격있는 새로운 도전을<br>제안합니다</p>
								<p class="txt">KLPGA프로 원포인트 레슨과 체계적인 골프프로그램을 운영하고 있습니다.</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_m_visual03.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">문화가 향유하는 다채로운<br>라이프스타일을 누리세요</p>
								<p class="txt">다채로운 문화 컨텐츠가 매일 열리고 있습니다.</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_m_visual04.jpg">
						</div>
					</div>
				</div>
			</div>
		<!-- /main slide -->

		<!-- pc ver -->
			<div class="mainVisualWrap pcVer">
				<div class="scroll_box"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_scroll.png" alt="" class="scroll_ico"></div>
				<div class="mainVisual swiper-container">
					<div class="swiper-pagination"></div>
					<div class="swiper-wrapper">  
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">Experience the lifestyle<br>부산시중앙신협 MEMBERS, 시작합니다.</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual01.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">여행은 멀리있지 않습니다</p>
								<p class="txt">품격있는 여행을 위한 엘시티 프라이빗뷰 레지던스</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual02.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">품격있는 새로운 도전을 제안합니다</p>
								<p class="txt">KLPGA프로 원포인트 레슨과 체계적인 골프프로그램을 운영하고 있습니다.</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual03.jpg">
						</div>
						<div class="swiper-slide">
							<div class="Box">
								<p class="tit elice">문화가 향유하는 다채로운 라이프스타일을 누리세요</p>
								<p class="txt">다채로운 문화 컨텐츠가 매일 열리고 있습니다.</p>
								<p><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">VIEW MORE</a></p>
							</div>
							<img src="<?php echo G5_THEME_IMG_URL ?>/main/main_visual04.jpg">
						</div>
					</div>
				</div>
			</div>


		</section>
		<!-- /main slide -->

		<section class="section" id="section4">
			<div class="newsBox" >
				<h2 class="inr"><span class="sebang">EVENT</span>부산시 중앙신협 멤버스만의 특별한 이벤트</h2>
				<div class="swiper-container noti_slide inr">
				<!-- <div class="swiper-button-next">next</div>
				<div class="swiper-button-prev">prev</div> -->
					<ul class="swiper-wrapper">
                        <?php for ($i = 0; $row = sql_fetch_array($event_result); $i++){
                            $sql = "select bf_file from g5_board_file where wr_id = '{$row["wr_id"]}' and bo_table = 'event' order by bf_no asc limit 1 ";
                            $file = sql_fetch($sql)["bf_file"];

                            if (file_exists(G5_DATA_PATH."/file/event/".$file) && $file != ""){
                                $file_url = G5_DATA_URL."/file/event/".$file;
                            }else{
                                $file_url = G5_THEME_IMG_URL."/common/noimg.jpg";
                            }

                            ?>
                            <li class="swiper-slide">
                                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event&wr_id=<?=$row['wr_id']?>">
                                    <span class="img"><img src="<?php echo $file_url ?>" alt=""></span>
<!--                                    <span class="cate">#골프센터</span>-->
                                    <p class="tit"><?=$row["wr_subject"]?></p>
                                    <p class="txt"><?=$row["wr_2"]?> ~ <?=$row["wr_4"]?></p>
                                </a>
                            </li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>
		<!-- / main news -->

		<section class="section" id="section6">

            <div class="inr">
				<h2>
					News
                    <?php if ($member["mb_level"] > 9){ ?>
            		<a class="btn_write" href="<?=G5_BBS_URL.'/write.php?bo_table=news'?>">글쓰기</a>
            		<?php } ?>
				</h2>
					<div class="box_wrap">
                        <?php for ($i=0; $row = sql_fetch_array($news_result); $i++){
                            $tag_arr = explode(",",$row["wr_5"]);
                            $sql = "select bf_file from g5_board_file where wr_id = '{$row['wr_id']}' and bo_table = 'news' order by bf_no asc limit 1";
                            $file = sql_fetch($sql)["bf_file"];

                            if (file_exists(G5_DATA_PATH."/file/news/".$file) && $file != ""){
                                $file_url = G5_DATA_URL."/file/news/".$file;
                            }else{
                                $file_url = G5_THEME_IMG_URL."/common/noimg.jpg";
                            }

                            ?>
						<div class="box">
						<a href="<?=$row['wr_8']?>">
							<div class="thumb_img">
								<img src="<?php echo $file_url ?>">
							</div>
						</a>
						<a class="" href="<?=$row['wr_8']?>">
							<h4>
								<p class="channel"><?=$row["wr_7"]?></p>
                                <?=$row["wr_subject"]?>
							</h4>
							<p>
                                <?=$row["wr_content"]?>
                            </p>
							<ul class="hash_wrap">
                                <?php for ($a = 0; $a < count($tag_arr); $a++){ ?>
								<li><?=$tag_arr[$a]?></li>
                                <?php } ?>
                            </ul>
						</a>
                      </div>
                       <?php }?>
					</div>
			</div>
		</section>

		<section class="section " id="section2" data-anchor="solution">
				<h2 class="autoW">SERVICE</h2>
			<ul class="mainSurvice autoW">
				<li class="cate01">
					<h2><p>프라이빗 센터</p><span>PRIVATE </span> CENTER</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=priv_center">프라이빗센터 예약 <span class="mobVer">똑똑 바로가기</span></a>
					</p>
				</li>
				<li class="cate02 animate__delay-_3s" >
					<h2><p>골프센터</p><span>the screen </span> golf</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=golf_center_res">더스크린골프 예약 <span class="mobVer"> 바로가기</span></a>
					</p>
				</li>
				<li class="cate03 animate__delay-_6s">
					<h2><p>CU문화센터</p><span>cu culture </span> CENTER</h2>
					<p class="LinkBox">
						<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=cu_center">CU문화센터 접수<span class="mobVer">바로가기</span></a>
					</p>
				</li>
				<li class="cate04 animate__delay-_9s">
					<h2><p>제휴서비스</p><span>MEMBERS</span> ONLY</h2>
					<p class="LinkBox">
						<a href="javascript:alert('준비중입니다')">제휴서비스 <span class="mobVer">바로가기</span></a>
					</p>
				</li>
			</ul>
			
		</section>
		<!-- / main button -->

<!--
		<section class="section" id="section3">
			<h2><span class="sebang">MEMBERS</span> <p>VIP·VVIP 만을 위한 부산시중앙신협 멤버스의  다양한 혜택과 프리미엄 서비스를 확인 해보세요.</p></h2>
			<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info" class="newBtn">MORE</a>
			
			<div class="main_memBox">
				<div class="img">
					
				</div>
			</div>
		</section>
-->
		<!-- / main video -->
<!--
		<section class="section" id="section5">
			<div class="loction inr">
				<p class="tit white">부산시중앙신협은 고객님을 위해 언제나 최선을 다하겠습니다.</p>
				<p class="txt">TEL <span>051. 611.1255</span></p>
				<p class="txt2">부산광역시 남구 용호로 162 본점 부산시중앙신협</p>
			</div>
			<div class="mapbox inr">
				<div id="daumRoughmapContainer1640227095979" class="root_daum_roughmap root_daum_roughmap_landing"></div>
				<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
				<script charset="UTF-8">
					new daum.roughmap.Lander({
						"timestamp" : "1640227095979",
						"key" : "28jz5",
						"mapWidth" : "100%",
						"mapHeight" : "360"
					}).render();
				</script>
			</div>
		</section>
		<section class="section tc  fp-auto-height" id="section6">
			<div class="footerWrap">
				<? include_once("inc/footer.php") ?>				
			</div>
		</section>

	</div>
-->
	<!-- /mainFull -->
<div id="ft_menu">
	<ul>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/mypage.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu01.png" alt="">MY멤버십
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/coupon_list.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu06.png" alt="">쿠폰
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/golf_order_form.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_02<?php if($co_id == "golf_center"){ echo ""; } ?>.png" alt="">골프예약
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=cucenter">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_03<?php if($co_id == "cu_center"){ echo ""; } ?>.png" alt="">문화센터
			</a>
		</li>
		<li>
			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_menu05.png" alt="">이벤트
			</a>
		</li>
	</ul>
</div>


<script>
	
	        if( $("#hd.mainVer").length ){
            var jbOffset = $("#hd.mainVer").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '#hd.mainVer' ).addClass( 'fixed' );
                }
                else {
                    $( '#hd.mainVer' ).removeClass( 'fixed' );
                }
            });
        }
</script>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>
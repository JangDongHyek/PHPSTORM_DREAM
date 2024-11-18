<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head2.php');

include_once(G5_LIB_PATH.'/latest.tabs.lib.php'); //최근글
?>
    <style>

        /*지점별 탭메뉴*/
        #tab_store{width:100%; margin:0 auto;}
        #tab_store .tabs:after {display:block;visibility:hidden;clear:both;content:""}
        #tab_store .tabs{padding-left:1px;zoom:1; text-align:center; border-bottom:1px solid #fff;}
        #tab_store .tabs li{ float:left; text-align:center; margin-left:-1px; margin-bottom:-1px;}
        #tab_store .tabs li a{display:inline-block;position:relative; padding:15px 20px; width:auto; border:1px solid #1f1b14; border-bottom:0;
            background:#2e2920; color:#fff;text-align:center;letter-spacing:-0.1em;line-height:1.2em; font-size:1.1em; cursor:pointer}
        #tab_store .tabs li.active a{border-bottom:none; background:none; border:1px solid #fff; border-bottom:1px solid #4E4332;; color:#fff; font-weight:bold; z-index:3; margin:0;}

        #tab_store .tab_container{clear:both; width:100%; padding-top:30px; box-shadow:none; background:none; z-index:1}
        #tab_store .tab_container .tab_content{padding:0px; min-height:100px;}

        #tab_store .list:after{content:""; display:block; clear:both;}
        #tab_store .list{padding:0px;}
        #tab_store .list li{margin:0 3px 3px 0; border:1px solid rgba(255,255,255,0.5); color:#fff; text-align:center;
            padding:15px 10px; border-radius:3px; box-sizing:border-box;}
        #tab_store .list li dd{display: grid; grid-template-columns: auto 51px 67px; gap: 6px; }
        #tab_store .list li p{display: flex;}
        #tab_store .list li p i{margin-right: 4px;}
        #tab_store .list li a{color: #fff;}
        #tab_store .list li:nth-child(3n+3){margin-right:0;}
        /*#tab_store dl dd:hover{transition:all 0.5s; border:1px solid #FFCF4D; color:#F9E457;}*/
        #tab_store .list p{ font-size:1em; text-align:left;display:inline-block; display: flex; align-items: center; white-space: nowrap;overflow: hidden; text-overflow: ellipsis; vertical-align:middle;}
        #tab_store .list p a{ color:#fff; display:inline-block; width:calc(100% - 18px); white-space: nowrap;overflow: hidden; text-overflow: ellipsis; vertical-align:middle;}
        #tab_store .list .btn{background:#2e2920; color:#fff; width:100%; font-size:12px; padding:6px; text-align: center;}
        #tab_store .list .btn:hover{ background:none; color:#F9E457; border:1px solid #F9E457;}

        @media (max-width: 991px) {
            #tab_store .tabs{border:0;}
            #tab_store .tabs li{width:33.3333%; padding:1px; margin-bottom:0; margin-left:0;}
            #tab_store .tabs li a{padding:10px 0; width:100%; font-size:1em; border-bottom:1px solid #1f1b14;}
            #tab_store .tabs li.active a{border-bottom:1px solid #fff;}

            #tab_store .list{padding:0;}
            #tab_store .list li{width:90%; margin:0 5% 3px 5%; padding:10px 15px;}
            #tab_store .list li p{}
            #tab_store .list li p a > span{
                font-size: .85em;
            }
            #tab_store .list li .btn{font-size:0.85em;}
        }



    </style>

    <div id="idx_wrapper">
        <div class="container">

            <div id="idx_ad">

                <div id="movieSlide">
                    <ul class="movie">

                        <!--크랑이치킨-->
                        <li>
                            <div class="movie_box">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_kraangi_top_pc.png" class="hidden-xs" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_kraangi_top_m.png" class="visible-xs" style="width:100%" alt="">
                            </div>
                        </li>
                        <!--크랑이치킨-->

                        <!--크크크치킨
                        <li>
                            <div class="movie_box">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_kkk_top_pc.jpg" class="hidden-xs" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_kkk_left_pc.jpg" class="hidden-xs" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_kkk_top_m.jpg" class="visible-xs" style="width:100%" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_kkk_left_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/i0nU7eTXEjk?si=u0f6smwCM2iDRaTb" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_kkk_right_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_kkk_bottom_m.jpg" class="visible-xs" style="width:100%" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_kkk_right_pc.jpg" class="hidden-xs" alt="">
                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_kkk_bottom_pc.jpg" class="hidden-xs" alt="">
                            </div>
                        </li>
                        크크크치킨-->


                        <?php /*?>
			<!--육육치킨-->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img66_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img66_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_img66_m_1.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_img66_m_2.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/whgKlhBgwx8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_img66_m_3.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_img66_m_4.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img66_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img66_4.jpg" class="hidden-xs" alt="">
                </div>
              </li>
           <!--육육치킨-->





			 <!--장스콤보-->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_jang_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_jang_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_jang_m_1.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_jang_m_2.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/NOlnS3RNWdA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_jang_m_3.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_jang_m_4.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_jang_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_jang_4.jpg" class="hidden-xs" alt="">
                </div>
              </li>
               <!--장스콤보-->






			  <!-- 호랑이치킨-->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ho_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ho_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_ho_1_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_ho_2_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/m7Qugn3NoLA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_ho_3_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_ho_4_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ho_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_ho_4.jpg" class="hidden-xs" alt="">
                </div>
              </li>
               <!-- 호랑이치킨-->






               <!--고추콤보-->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_1_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_2_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/Ok4dVcLVKs8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_3_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_4_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_4.jpg" class="hidden-xs" alt="">
                </div>
              </li>
               <!--고추콤보-->






			 <!--짜파치킨-->
              <!--li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_zapa_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_zapa_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_zapa_m_1.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_zapa_m_2.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/NBkjhGRRvFw" frameborder="0" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_zapa_m_3.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_zapa_m_4.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_zapa_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_zapa_4.jpg" class="hidden-xs" alt="">
                </div>
              </li-->
            <!--짜파치킨 -->







              <!--간지순살 -->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_2.png" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/qc3S6bX_kaA" frameborder="0" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_3.png" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_gam_m_4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_gan_4.png" class="hidden-xs" alt="">
                </div>
              </li>
              <!--//간지순살 -->



               <!--고추윙봉 -->
              <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_1.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_2.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_1_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_2_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <iframe id="yt3" width="636" height="358" src="https://www.youtube.com/embed/olhgFwae8LI" frameborder="0" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_3_m.jpg" class="visible-xs" style="width:35px; height:147px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_go_4_m.jpg" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_3.jpg" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_go_4.jpg" class="hidden-xs" alt="">
                </div>
              </li>





              <li>
              	<div class="movie_box">
                	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event02&wr_id=18">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event01_190123_PC.JPG" alt="" class="hidden-xs">
					 <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/idx_menu_event01_190123m.jpg" alt="" class="visible-xs">

                    </a>
                </div>
              </li>

			  <li>
              	<div class="movie_box">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-1.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-2.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-1.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-2.png" class="visible-xs" style="width:35px" alt="">
                <iframe id="yt1" width="636" height="358" src="https://www.youtube.com/embed/gUVMHjZNOYw" frameborder="0" allowfullscreen></iframe>
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-3.png" class="visible-xs" style="width:35px" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile1-4.png" class="visible-xs" style="width:100%" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-3.png" class="hidden-xs" alt="">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc1-4.png" class="hidden-xs" alt="">
                </div>
              </li>

              <!--li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc2.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile2.png" alt="" class="visible-xs">
                </div>
              </li-->





              <li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-1.png" alt="" style="width:100%" class="visible-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-2.png" alt="" style="width:68px" class="visible-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-1.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-2.png" alt="" class="hidden-xs">
                    <iframe id="yt2" width="520" height="295" src="https://www.youtube.com/embed/ACHHS86Vahs?enablejsapi=1" frameborder="0" allowfullscreen></iframe>
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-3.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-3.png" alt="" style="width:68px" class="visible-xs">
                    <a href="https://play.google.com/store/apps/details?id=com.jangs.sixtychicken&rdid=com.jangs.sixtychicken&pli=1" target="_blank">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc3-4.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile3-4.png" alt="" style="width:100%" class="visible-xs">
                    </a>
                </div>

              </li>

              <li>
              	<div class="movie_box">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc4.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile4.png" alt="" class="visible-xs">
                </div>
              </li>

              <li>
              	<div class="movie_box">
				    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=share">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/main_pc5.png" alt="" class="hidden-xs">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/main_mobile5.png" alt="" class="visible-xs">
					</a>
                </div>
              </li>
			  <?php */?>


                    </ul>
                    <script type="text/javascript">
                        $(function(){
                            var slider =  $('.movie').bxSlider({
                                autoControls: true,
                                stopAutoOnClick: true,
                                pager: true,
                                slideWidth:1130,
                                onSlideNext:function($e,p,n){
                                    if(tgs[p]){
                                        tgs[p].stopVideo();
                                    }
                                },
                                onSlidePrev:function($e,p,n){
                                    if(tgs[p]){
                                        tgs[p].stopVideo();
                                    }
                                }
                            });
                        });
                        // 유투브 스크립트
                        var ids = ["yt1","yt2","yt3","yt4"];  // 각 iframe의 아이디
                        var tgs = []; // 로딩된 iframe의 값을 저장
                        var tag;
                        var firstScriptTag;
                        tag = document.createElement('script');
                        tag.src = "https://www.youtube.com/iframe_api";
                        firstScriptTag = document.getElementsByTagName('script')[0];
                        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                        function onYouTubeIframeAPIReady(){
                            for(var i = 0 ; i < ids.length ; i++){ //
                                var player = new YT.Player(ids[i], {
                                    events: {'onReady':onPlayerReady}
                                });
                            }

                        }

                        function onPlayerReady(event) {
                            tgs.push(event.target);
                            if(tgs.length == ids.length){
                                tgs.sort(function(a,b){return a.g-b.g});
                                tgs[0].playVideo();
                            }
                        }
                    </script>
                </div><!-- //visual -->

            </div>

            <div id="idx_container">

                <div class="main_banner">
                    <a href="https://m.map.naver.com/search2/search.nhn?query=60%EA%B3%84%EC%B9%98%ED%82%A8" target="_blank">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/search_mobile.png" alt="" style="width:100%; margin-bottom:10px;">
                    </a>
                </div>


                <div id="idx_tab">
                    <!-- 탭타이틀 { -->
                    <ul class="idx_tab">
                        <li style="width:100%;"><a class="selected" href="#idx_tab1"><p>60계치킨</p><span>Menu&amp;Event</span></a></li>
                        <!--                    <li><a href="#idx_tab2"><p>60계치킨</p><span>Brand Story</span></a></li>-->
                    </ul>
                    <!-- } 탭타이틀-->
                    <!-- 탭컨텐츠패널 { -->
                    <ul class="idx_panel">
                        <li id="idx_tab1">
                            <!-- 메뉴&이벤트 { -->
                            <div id="tab_menu">

                                <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_event01.jpg" alt="">
                            </div>
                            <!-- } 메뉴&이벤트 -->

                            <!--<img src="<?php /*echo G5_THEME_IMG_URL */?>/main/open_img.jpg" alt="오픈안내">-->
                            <!-- 지점별 주문 및 CCTV { -->

                            <div id="tab_store">
                                <div class="tab_store_title">
                                    <a href="http://map.naver.com/index.nhn?query=NjDqs4Q&enc=b64&tab=1"><i class="fa fa-search"></i> 내 주변의 60계치킨 매장찾기</a>
                                    <!--<p style="color:#fff">※<strong>위치정보 수집을 허용</strong>하셔야<br> 내 주변의 60계 치킨 매장을 확인 가능합니다.</p>-->
                                </div>
                                <?php /*latest_tabs('latest_cate', "cctv", 200, 50); */?>

                                <div class="tab_container">
                                    <div id="tab1" class="tab_content">
                                        <ul class="list" id="cctv_list">
                                            <!-- 여기수정하면 맨 하단의 내용도 수정필요 -->
                                            <li>위치권한을 허용해주세요.<br>설정 -> 사이트 설정 -> 위치 정보에서 권한을 변경해주세요. </li>
                                            <!--<li>
                                                <dl>
                                                    <dd>
                                                        <p><i class="fa fa-map-marker"></i><a href="https://www.60chicken.com:443/bbs/board.php?bo_table=cctv&amp;wr_id=723">서울이대역점</a></p>
                                                        <a href="tel:02-364-6066" class="btn order"><i class="fa fa-phone"></i> 주문</a>
                                                        <a href="#" onclick="checkLoginAndRedirect('http://live.toastcam.com/live/AAAINDW.stream/playlist.m3u8')" class="btn cctv"><i class="fa fa-video-camera"></i> CCTV</a>
                                                    </dd>
                                                </dl>
                                            </li>-->
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- } 지점별 주문 및 CCTV -->
                        </li>
                        <li id="idx_tab2" style="display:none;">

                            <div id="tab_story">

                                <div class="story_title">
                                    <h3 class="row">
                                        <p class="col-sm-5 col-xs-12">
                                            <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>" class="logo">
                                        </p>
                                        <p class="col-sm-7 col-xs-12">
                                            매일 새 기름(18L)으로!<br>
                                            깨끗하고 맛있는 60계치킨!
                                        </p>
                                    </h3>
                                    <div class="video embed-container">
                                        <iframe width="1280" height="720" src="https://www.youtube.com/embed/qy0Y_Vz1jCY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        <!--<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_video.jpg" alt="">-->
                                    </div>
                                    <span>

                                <strong>60계치킨은</strong> 그날 사용한 기름은 모두 폐기하고, 매일 깨끗한 새 기름(18L) 으로 60마리만(뼈닭+순살 1마리 기준) 조리하고 있습니다.
                                </span>
                                </div>

                                <div class="news_img">
                                    <dd class="contents">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/singo_img.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/1.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/2.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/3.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/4.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/5.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/6.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/7.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/8.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/9.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/10.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/11.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/12.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/13.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/14.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/15.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/16.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/17.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/18.jpg" alt="">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/main/19.jpg" alt="">
                                    </dd>
                                </div>

                                <div class="story">
                                    <h4>왜? 기름을 매일 교체해야 하나요?</h4>
                                    <dl>
                                        <dt>1. 기름이 오랫동안 '열' 받으면 몸에 해로운 '발암' 물질이 생긴다!</dt>
                                        <dd>치킨을 60마리를 넘게 튀긴 기름은 산패도가 높아지면서 인체 유해물질을 생성합니다.<br>
                                            때문에! 60계치킨은 무조건 새 기름으로 교체하고 있습니다!</dd>
                                        <dd class="img"><img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story01.jpg" alt=""></dd>
                                    </dl>
                                    <dl>
                                        <dt>2. 사용한 기름을 '버리지 않으면' 밤 사이 기름에 '벌레'가 빠진다!</dt>
                                        <dd>그날 사용한 기름을 버리지 않으면 밤 사이 벌레들이 기름 통으로 빠지게 됩니다.<br>
                                            그래서! 60계치킨은 60마리를 튀기지 못 해도 그 날 사용한 기름은 그날 폐기합니다!<br>
                                            (본사에서 기름 1통을 매일 제공하기 때문에 치킨 가격에 영향을 주지 않습니다.)</dd>
                                        <dd class="cartoon">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_01.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_02.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_03.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_04.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_05.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_06.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_07.jpg" alt="">
                                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story02_08.jpg" alt="">
                                        </dd>
                                    </dl>

                                    <h4>왜? 주방 CCTV를 공개하고 있나요?</h4>
                                    <dl>
                                        <dt>1. 고객을 위해! 우리 스스로를 감시하자!</dt>
                                        <dd>고객님께서 매 순간마다 지켜보고 있다는 마음을 스스로 가지고<br class="hidden-xs">
                                            항상 깨끗하고 건강한 치킨을 고객님께 전달 드리고 있습니다!</dd>
                                        <dd class="video embed-container">
                                            <iframe width="1280" height="720" src="https://www.youtube.com/embed/ACHHS86Vahs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                            <!--<img src="<?php echo G5_THEME_IMG_URL ?>/main/idx_menu_story03.jpg" alt=""> -->
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>2. 천번 말하기 보다 한번 보여드리자!</dt>
                                        <dd>하루가 멀다 하고 터지는 먹거리 위생 문제! 말로만 깨끗하게 만든다고 하면 안심되시나요?<br>
                                            그래서! 60계치킨은 고객님께서 주문하신 치킨의 조리과정을 직접 보실 수 있도록 국내 최초로 주방 내부 CCTV를 24시간 공개하고 있습니다!
                                            직접 확인해 보세요!</dd>
                                    </dl>
                                    <a href="https://play.google.com/store/apps/details?id=com.jangs.sixtychicken&rdid=com.jangs.sixtychicken&pli=1
" target="_blank" class="btn btn-default btn-lg"> 60계치킨 CCTV 어플 <i class="fa fa-download" aria-hidden="true"></i></a>
                                </div>

                            </div>
                            <!--//tab_story-->

                        </li>
                    </ul>
                    <!-- } 탭컨텐츠패널 -->
                </div>


            </div>
            <!-- #idx_container -->

        </div>

    </div><!--  #idx_wrapper -->


    <script>

        $(document).ready(function(){
            getPosition();
        });

        function getPosition() {
            if (!navigator.geolocation) {
                console.log("Geolocation is not supported by your browser");
                return;
            }

            navigator.geolocation.getCurrentPosition(success, error);
        }

        function success(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            $.post("<?=G5_URL?>/ajax/get_cctv_list.php",{"lat":latitude, "lon":longitude},function (data) {
                if(data.code == "200"){
                    $("#cctv_list").html(data.html);
                }
            },"json");
        }

        function error(err) {
            $("#cctv_list").html("<li>위치권한을 허용해주세요.<br>설정 -> 사이트 설정 -> 위치 정보에서 권한을 변경해주세요. </li>");
        }

        function checkLoginAndRedirect(cctvUrl) {
            var isLoggedIn = <?= $GLOBALS['is_member'] ? 'true' : 'false' ?>;
            //var targetUrl = isLoggedIn ? cctvUrl : "<?= G5_URL ?>/bbs/login.php";

            window.location.href = cctvUrl;

            /*if(!isLoggedIn){
                let b = confirm('CCTV를 보기위해선 로그인하셔야합니다. 로그인페이지로 이동하시겠습니까?');
                if(b){
                    window.location.href = targetUrl;
                }
            }else{
                window.location.href = targetUrl;
            }*/

        }

    </script>



<?php
include_once(G5_PATH.'/tail.php');
?>
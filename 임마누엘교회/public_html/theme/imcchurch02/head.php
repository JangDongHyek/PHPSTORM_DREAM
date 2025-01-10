<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
?>


<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
        <div id="logo">
            <a class="white" href="<?php echo G5_URL ?>/index2.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.svg" alt="임마누엘 교회"></a>
            <a class="color" href="<?php echo G5_URL ?>/index2.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.svg" alt="임마누엘 교회"></a>
        </div>
        <!--#logo-->

        <nav id="gnb">
            <h2>메인메뉴</h2>
            <ul id="gnb_1dul">
                <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
    
                for ($i=0; $row=sql_fetch_array($result); $i++) {

					if($row['me_course'] == "1"){
						$link = G5_URL.$row['me_link'];
					} else {
						$link = $row['me_link'];
					}

                ?>
                <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo $link; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
                    <?php
                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);
    
                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul class="gnb_2dul">'.PHP_EOL;

						if($row2['me_course'] == "1"){
							$link2 = G5_URL.$row2['me_link'];
						} else {
							$link2 = $row2['me_link'];
						}
                    ?>
                <li class="gnb_2dli"><a href="<?php echo $link2; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                <?php
                    }
    
                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
                <?php
                }
    
                if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
        </nav>
        <div class="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                <div>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </div>
        <!--모바일메뉴버튼-->

    </div>
    <!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    <div id="container_index">
        <!--서브컨테이너 부분-->
        <? }else if($co_id == "sub01"){ ?>
        <div id="svisual" class="sv1"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub02"){ ?>
        <div id="svisual" class="sub02"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1>참 잘 오셨습니다!</h1>
                <!--서브타이틀-->

                <p>마치 임마누엘교회를 오래전부터 다녔던 것처럼
                    편안하게 정착할 수 있도록
                    IMC 새가족부가 도와드리겠습니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub03"){ ?>
        <div id="svisual" class="sv3"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub04"){ ?>
        <div id="svisual" class="sv4"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub05"){ ?>
        <div id="svisual" class="sv5"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub06"){ ?>
        <div id="svisual" class="sv6"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>
        
        
        <? }else if($co_id == "sub07"){ ?>
        <div id="svisual" class="sv7"></div>
        <div class="inr">
            <div class="header_text">
                <!--서브타이틀-->
                <h1><?php echo $g5['title']; ?></h1>
                <!--서브타이틀-->

                <p>우리 모두가 꿈꿔온 행복한 교회
                    열정, 감동, 회복, 치유, 평강, 화목, 나눔, 기적, 행복, 비전이 있는
                    축복의 통로, 임마누엘교회로 초대합니다</p>

                <a href="" class="btn-mv">
                    자세히보기<i class="fa-solid fa-arrow-up-right"></i>
                </a>
            </div>

        </div>
        <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>



        <? }else if($co_id == "sub01_01"||$co_id == "sub01_01_01"||$co_id == "sub01_01_02"||$co_id == "sub01_01_03"||$co_id == "sub01_01_04"){ ?>
            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                    <div id="location">
                        홈&nbsp;&gt;&nbsp;
                        <strong>교회비전</strong>
                    </div>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub01_01.php'); ?>

        <? }else if($co_id == "sub01_02"||$co_id == "sub01_02_02"||$co_id == "sub01_02_03"){ ?>
            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                    <div id="location">
                        홈&nbsp;&gt;&nbsp;
                        <strong>섬기는사람들</strong>
                    </div>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub01_02.php'); ?>

        <? }else if($co_id == "sub01_05"||$co_id == "sub01_05_02"||$co_id == "sub01_05_03"||$co_id == "sub01_05_04"||$co_id == "sub01_05_05"){ ?>
            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                    <div id="location">
                        홈&nbsp;&gt;&nbsp;
                        <strong>교회안내</strong>
                    </div>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub01_05.php'); ?>

        <? }else if($co_id == "sub01_08"){ ?>
            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                    <div id="location">
                        홈&nbsp;&gt;&nbsp;
                        <strong>교회안내</strong>
                    </div>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub01_08.php'); ?>

        <? }else if($co_id == "sub02_01"){ ?>
            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub.main.php'); ?>

        <? }else if($co_id == "sub02_02"){ ?>

            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                </div>
            </div>

            <?php include_once(G5_THEME_PATH.'/sub02_02.php'); ?>

        <? }else if($co_id == "sub02_03"){ ?>

            <div id="svisual" class="sv1">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                </div>
            </div>

            <?php include_once(G5_THEME_PATH.'/sub02_03.php'); ?>

        <? }else if($co_id == "sub02_04"){ ?>


            <?php include_once(G5_THEME_PATH.'/sub02_04.php'); ?>



        <? }else if($co_id == "sub03_01_main" || $co_id == "sub03_03_01" || $co_id == "sub03_03_02" || $co_id == "sub03_03_03"){ ?>
        
        
        <?php include_once(G5_THEME_PATH.'/sub03_01.php'); ?>
        
        



        <? }else if($co_id == "sub03_02_main" || $co_id == "sub03_04_01"){ ?>
        
        
        <?php include_once(G5_THEME_PATH.'/sub03_02.php'); ?>
        
        


        <? }else if($co_id == "sub04_01_main" || $co_id == "sub04_01_kenya" || $co_id == "sub04_01_tan" || $co_id == "sub04_01_malay" || $co_id == "sub04_01_sai" || $co_id == "sub04_01_cambo"){ ?>
        
        
        <?php include_once(G5_THEME_PATH.'/sub04_01.php'); ?>


        <? }else if($co_id == "sub04_01_01"){ ?>
            <div id="svisual" class="sv8">
                <div class="s_text">
                    <h3><?php echo $g5['title']; ?></h3>
                    <div id="location">
                        홈&nbsp;&gt;&nbsp;해외선교&nbsp;&gt;&nbsp;
                        <strong>1인1구좌</strong>
                    </div>
                </div>
            </div>
            <?php include_once(G5_THEME_PATH.'/sub04_01_01.php'); ?>

        <? }else if($co_id == "sub04_02"){ ?>


        <?php include_once(G5_THEME_PATH.'/sub04_02.php'); ?>


        
        <? }else if($bo_table == "" || $co_id == ""){ ?>

        <!--서브상단비주얼-->
        <? if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03" || $co_id == "greet04" || $co_id == "greet05") {  ?>
        <? } else if ($bo_table == "product") { ?>
        <? } else if ($bo_table == "facilties") { ?>
        <? } else if ($bo_table == "product_view") { ?>
        <? } else if ($bo_table == "qna" || $bo_table == "data") { ?>
        <? } else if ($bo_table == "contact") { ?>
        <? } else  { ?>
        <div id="svisual" class="sv1">

            <div class="s_text">

                <h3><?php echo $g5['title']; ?></h3>
                <!--메뉴로케이션-->
                <?php 

                if(!$is_register || $w){ 
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid)		
                    echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                }
                ?>
            </div>
        </div>
        <? } ?>


        <div class="sub_margin">
            <div class="sub_nav">
                <!--서브메뉴-->
                <?php 

                        if(!$sm_tid)	$sm_tid = $co_id;
                        if(!$sm_tid)	$sm_tid = $bo_table;

                        if($sm_tid)		
                        echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
                    ?>
            </div>
            <span class="line"></span>
            <div class="inr v2">
                <div class="sub_layout">
                    <div id="container" class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.8s">
                        <? if($bo_table || $co_id){ ?>
                        <!-- 서브 게시판 및 내용관리 부분 -->
                        <div id="scont_wrap">
                            <? }else { ?>
                            <!-- 그외 검사결과창 및 회원가입 -->
                            <div id="scont_wrap2">
                                <? } ?>

                                <div id="scont">
                                    <!--서브타이틀-->
                                    <div id="sub_title">
                                        <?php echo $g5['title']; ?>
                                    </div>
                                    <!--#sub_title-->
                                    <!--서브타이틀-->
                                    <? } ?>

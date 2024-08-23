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
    <div class="hd_top">
        <div class="inner">
        <div class="sns">
            <a href="https://youtube.com/watch?v=TcayYymz4jw&amp;si=3papAjfl3bmmpUo3" target="_blank">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_youtube.svg"></a>
            <a href="javascript:alert('준비중입니다.')"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_Instagram.svg"></a>
            <a href="https://www.linkedin.com/in/kme-co-ltd-763784319" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_linkedin.svg"></a>
        </div>
        <a class="contact_link" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=customer">Contact us</a>
        <select aria-label="Default select example" onchange="window.open(value,'_blank');">
            <option value="#">-- SHIPYARD --</option>
            <option value="http://www.samsungshi.com/kor/default.aspx">Samsung Heavy Industries</option>
            <option value="https://www.hanwha.co.kr/business/manufacture/hanwhaocean.do">Hanwha Ocean</option>
            <option value="https://www.hhi.co.kr/">HD Heavy Industries (Ulsan)</option>
            <option value="https://www.hshi.co.kr/">HD Samho Heavy Industries</option>
            <option value="https://www.hd-hmd.com/main/main.jsp">HD Mipo Dockyard</option>
            <option value="https://www.hjsc.co.kr/main/">HJ Shipbuilding &amp; Construction</option>
            <option value="http://www.hsgsd.co.kr/kor/main/main.jsp">Sungdong Shipbuilding</option>
            <option value="http://www.daesunship.co.kr/">Dae Sun Shipbuilding &amp; engineering</option>
            <option value="http://www.kangnamship.co.kr/">Kangnam Corporation</option>
            <option value="http://www.asiashipbuilding.co.kr/">Asia Shipbuilding</option>
            <option value="http://yuilship.co.kr/">Yuil</option>
            <option value="http://hankookmade.com/">Hankookmade</option>
            <option value="https://www.seatrium.com/">Seatrium</option>
            <option value="https://sskzvezda.ru/">ZVEZDA</option>
            <option value="https://www.modec.com/">MODEC</option>
        </select>
        </div>
    </div>
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>">
            </a>
        </div><!--#logo-->
        <div class="gnb_wrap">
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
                        ?>
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
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
                            ?>
                            <li class="gnb_2dli"><a href="<?php echo  G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
        </div>
        <div class="mobile_open">
            <span></span><span></span><span></span>
        </div>
    </div><!--#hd_wrapper-->

</div>

<!--모바일 메뉴버튼-->
<div onclick="history.back();" class="page_cover"></div>
<div id="mobile_menu">
    <div class="hd_top">
        <div class="inner">
            <div class="sns">
                <a href="https://youtube.com/watch?v=TcayYymz4jw&amp;si=3papAjfl3bmmpUo3" target="_blank">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_youtube.svg"></a>
                <a href="javascript:alert('준비중입니다.')"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_Instagram.svg"></a>
                <a href="https://www.linkedin.com/in/kme-co-ltd-763784319" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_linkedin.svg"></a>
            </div>
        </div>
    </div>
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>">
            </a>
        </div><!--#logo-->
        <div onclick="history.back();" class="mobile_close"><span></span><span></span></div>
    </div><!--#hd_wrapper-->



        <div class="hash_scroll">
            <div id="gnb2" class="hd_div">
                <ul id="mgnb_1dul">
                <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_mobile_use = '1'
                                and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);

                for($i=0; $row=sql_fetch_array($result); $i++) {
                ?>
                    <li class="mgnb_1dli">
                        <a class="mgnb_1da"><?php echo $row['me_name'] ?><i class="fa-solid fa-angle-down"></i></a>
                        <!--1차메뉴-->
                        <?php
                        $sql2 = " select *
                                    from {$g5['menu_table']}
                                    where me_mobile_use = '1'
                                        and length(me_code) = '4'
                                        and substring(me_code, 1, 2) = '{$row['me_code']}'
                                    order by me_order, me_id ";
                        $result2 = sql_query($sql2);

                        for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                            if($k == 0)
                                echo '<ul class="mgnb_2dul">'.PHP_EOL;
                        ?>
                            <li class="mgnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                        <?php
                        }

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                <?php
                }

                if ($i == 0) {  ?>
                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
                <?php } ?>
                </ul>
            </div><!--#gnb2-->
        </div><!--.hash_scroll-->
</div>

<!-- } 상단 끝 -->

<hr>


<!-- 콘텐츠 시작 { -->
    <div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>

	<div id="container" class="subp-h">
        <!--서브비쥬얼-->
        <? if($co_id == "greetings" || $co_id == "history" || $co_id == "organization" || $co_id == "patent" || $co_id == "partnership"){ ?>
        <div class="w-100 sub-page-main sub1-main-img">
        <? }else if($co_id == "marine" || $co_id == "offshore" || $co_id == "cruise" || $co_id == "special"){ ?>
        <div class="w-100 sub-page-main sub2-main-img">
        <? }else if($bo_table == "reference"){ ?>
        <div class="w-100 sub-page-main sub4-main-img">
        <? }else if($bo_table == "customer" || $bo_table == "news" || $bo_table == "catalog" ){ ?>
        <div class="w-100 sub-page-main sub5-main-img">
        <? }else { ?>
        <div class="w-100 sub-page-main sub3-main-img">
        <?php } ?>
            <div class="d-flex flex-column justify-content-center align-items-center container-lg h-100 text-light">
                <div class="d-flex justify-content-center align-items-center fs-0_5">
                    <span id="selected-menu-name">
                        <?php

                        if(!$sm_tid) {
                            $sm_tid = $co_id;
                        }
                        if(!$sm_tid) {
                            $sm_tid = $bo_table;
                        }

                        if($sm_tid) {
                            // submenu 함수의 반환 값을 변수에 저장
                            $sub_title = submenu($sm_tid, 'sub_title', G5_THEME_PATH);

                            // 반환 값이 있으면 그 값을 출력하고, 없으면 "PRODUCTS"를 출력
                            echo $sub_title ? $sub_title : 'PRODUCTS';
                        } else {
                            // sm_tid가 아예 설정되지 않은 경우에도 "PRODUCTS" 출력
                            echo 'PRODUCTS';
                        }
                        ?>

                    </span>
                </div>
                <div class="d-flex">
                    <div class="mx-2">·</div>
                    <div class="text-yellow-05" style="text-transform:uppercase;">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                    </div>
                    <div class="mx-2">·</div>
                </div>
            </div>
        </div>
        <?/* include_once(G5_THEME_PATH.'/sub_menu.php') */?>
        <!--서브메뉴-->
        <?php

        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)
            echo submenu($sm_tid, 'basic', G5_THEME_PATH);
        ?>
    </div>
        <div class="container-lg py-5">
            <!--서브메뉴-->


	<? } ?>


<!--AOS애니메이션-->
<script>
  AOS.init({
    easing: 'linear',//애니메이션 효과
    duration: 500,//애니메이션 재생시간 0부터 3000까지 가능, 50단위로 설정가능
    once:1,//스크롤 할때마다 재생되는 횟수설정

    //768px 이하에서는 애니메이션 효과가 안나타남 -> css에도 추가로 넣어줘야 적용됨
    disable: function() {
    var maxWidth = 768;
    return window.innerWidth < maxWidth;
  }
  });
</script>

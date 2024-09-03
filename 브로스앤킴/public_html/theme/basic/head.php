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
        <div id="tnb_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 hidden-xs"><p><?php echo $config['cf_title']; ?>는 앞서가는 기술력과 노하우로  미래를 이끌어 가겠습니다. </p></div>
                    <div class="col-sm-5">
                        <ul id="tnb" class="list-inline">
                            <li><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i> 메인</a></li>
                            <?php if ($is_member) {  ?>
                            <?php if ($is_admin) {  ?>
                            <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                            <?php }  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                            <?php } else {  ?>
                            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                            <?php }  ?>
                            <li><a href="mailto:<?php echo $config['cf_7']; ?>">고객센터</a></li>
                        </ul>
                    </div>
                </div>
            </div>    
        </div><!--//tnb_wrapper-->
    
        <div class="container">
            <div class="row">
    
                <div id="logo" class="col-md-3 col-xs-9">
                    <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.jpg" alt="로고"></a>
                </div><!--//logo-->
                <div class="col-xs-3 nav_open">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">열기</span>
                    </a>
                </div><!--모바일메뉴버튼-->
                <nav id="gnb" class="col-md-9">
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
                            <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                                <li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
            
            <!--mobile menu-->
            <div id="mask" style="display:none"></div>
            
            <nav id="navtoggle">
                <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/icon_close.png" /></div>
                <ul>
                    <li>
                    <div id="left_menu">
                    <div class="title"><i class="fa fa-th-large"></i>&nbsp;전체메뉴 안내</div>
                        <!--좌측메뉴리스트-->
                        <div id="accordion-example" data-collapse="accordion">
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
                                        <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="mgnb_1da"><?php echo $row['me_name'] ?></a>
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
                            </div><!--//gnb2-->
                        </div>
                        <!--//좌측메뉴리스트-->
                    </div><!--//left_menu-->
                    </li>
                </ul>
            </nav>
            <!--//mobile menu-->
    
		</div>
    </div><!--//hd_wrapper-->
    
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
	
	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->
    
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <!-- 서브 내용페이지 { -->
    <div id="subvisual">
    <div class="wave"></div>
        <div class="slogan">
            <p>에어컨 크리닝 전문 <?php echo $config['cf_title']; ?></p>
            <span>공간을 꺠끗하게 만드는 기업이라는 이념을 가진 <?php echo $config['cf_title']; ?>은<br>
            언제나 고객사의 청결과 건강을 위해서 노력합니다.</span>
        </div>
    </div>
	<div id="wrapper">
        <div class="container">
        	<div class="row">
            <div id="aside" class="col-sm-3">
            <?php 
    
                if(!$is_register || $w){ 
                    //서브메뉴 추가
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid)		
                    echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
                }
            ?>
            </div>
            <div id="container" class="col-sm-9">
                <div id="container_title">
                 <?php if($bo_table) {?>
                        <?php echo $board['bo_subject']; ?>
                 <?php }else { ?>
                        <?php echo $g5['title'] ?>
                 <?php } ?>
                    <!--메뉴로케이션 시작 {-->
                    <?php 
            
                        if(!$is_register || $w){ 
                            //서브메뉴 추가
                            if(!$sm_tid)	$sm_tid = $co_id;
                            if(!$sm_tid)	$sm_tid = $bo_table;
                            if($sm_tid)		
                            echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                        }
                    ?>
                    <!--} 메뉴로케이션 끝-->
                </div><!--//container_title"-->
    <!-- } 서브 내용페이지 -->
    <? } ?> 

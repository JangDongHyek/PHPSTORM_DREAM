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

<!--sitemap-->
<div class="modal fade" id="sitemap" role="dialog">
<div class="modal-dialog modal-lg" style="z-index: 100;">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h3><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>">&nbsp;SITEMAP</h3>
    </div>
    <div class="modal-body" style="background:url(/kor/theme/chunil/img/sub/icon_sitemap.png) no-repeat right">
<div id="sitemap">
<ul id="stm_1dul">
    <?php
    $sql = " select *
                from {$g5['menu_table']}
                where me_mobile_use = '1'
                  and length(me_code) = '2'
                order by me_order, me_id ";
    $result = sql_query($sql, false);

    for($i=0; $row=sql_fetch_array($result); $i++) {
    ?>
        <li class="stm_1dli">
            <a class="stm_1da"><?php echo $row['me_name'] ?></a>
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
                    echo '<ul class="stm_2dul">'.PHP_EOL;
            ?>
                <li class="stm_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="stm_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
            <?php
            }

            if($k > 0)
                echo '</ul>'.PHP_EOL;
            ?>
        </li>
    <?php
    }

    if ($i == 0) {  ?>
        <li id="stm_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
    <?php } ?>
    </ul>
</div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
  
</div>
</div>
<!--//sitemap-->


<!-- 상단 시작 { -->
<div id="wrap">
<div id="hd" class="<?php if(!defined('_INDEX_')){ echo 'sub'; } ?> <?php if(defined('_INDEX_')){ echo 'wow fadeInDownBig animated'; } ?>" data-wow-delay="0s" data-wow-duration="1.5s">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
            <div class="row">
    
                <div id="logo" class="col-md-2 col-xs-6">
                    <a href="<?php echo G5_URL ?>">
                    <img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>">
                    </a>
                </div><!--//logo-->
                
                <nav id="gnb" class="col-md-8 col-xs-3">
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
                            <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                                <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
                        <a data-toggle="modal" data-target="#sitemap" class="sitemap_btn"><i class="fas fa-bars"></i></a>
                    </ul>
                </nav>
                
                <div id="tnb_wrapper" class="col-md-2 hidden-xs">
                    <ul id="tnb">
                        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=review">이용후기</a></li>
                        <?php if ($is_member) {  ?>
                        <?php if ($is_admin) {  ?>
                        <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                        <?php }  ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                        <?php } else {  ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/login.php" class="admin"><i class="fas fa-power-off"></i> 관리자로그인</a></li>
                        <?php }  ?>
                    </ul>
                </div><!--//tnb_wrapper-->
        
            

                <div class="col-xs-3 nav_open">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                        <i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">열기</span>
                    </a>
                </div><!--모바일메뉴버튼-->
            </div>
                
    </div><!--//hd_wrapper-->
    
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
	
	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->
    
	<? }else { ?>
    <!-- 서브 상단 { -->
    <div id="subvisual">
    	<div class="visual_img">
            <div class="slogan">
                <p class="wow fadeInUp animated" data-wow-delay="2s" data-wow-duration="2s">
                    Make your trip, Shilla Tour
                </p>
                <h2 class="wow fadeInDown animated" data-wow-delay="2s" data-wow-duration="2s">
                    <strong>신라투어와 함께</strong><br class="visible-xs"><span>더 편안하고 쾌적한 여행을!</span>
                </h2>
            </div>
        </div>
    </div>
    <!-- } 서브 상단 -->
		<? if($bo_table || $co_id){ ?>
	    <!-- 서브 내용페이지 { -->
        <div id="wrapper">
            <div class="container">
                <div class="row">
                <div id="aside">
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
                <div id="container">
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
		<? } else { ?>
	    <!-- 서브 기타페이지 { -->
        <div id="wrapper">
            <div class="container">
                <div class="row">
                <div id="container">
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
        <!-- } 서브 기타페이지 -->
	    <? } ?> 
    <? } ?> 

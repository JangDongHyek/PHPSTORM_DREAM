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

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

<div id="fixed">
    <a class="kakao_ch" href="https://pf.kakao.com/_jcbeG" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/kakao_ch.svg"></a>
</div>
<div id="hd" <? if(!defined('_INDEX_')){ echo "class='sub'"; }?>>

    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>


    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->
        <ul id="tnb">
            <li><a href="<?php echo G5_URL ?>" class="home" title="홈"><i class="far fa-home"></i></a></li>
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>/member_list.php" class="admin" title="관리자"><i class="fas fa-cog"></i></a></li>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" title="정보수정"><i class="fas fa-pen-alt"></i></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/register_form.php" title="회원가입"><i class="fas fa-heart"></i></a></li>
            <?php }  ?>
            <li><a class="kakao_ch" href="https://pf.kakao.com/_jcbeG" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/kakao_ch.svg"></a></li>
        </ul>
            
    	<div id="gnb_wrap">
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
        
                    for ($i=0; $row=sql_fetch_array($result); $i++){
                    ?>
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span><i class="fas fa-heart"></i></span></a>
                        <?php
                        $sql2 = " select *
                                    from {$g5['menu_table']}
                                    where me_use = '1'
                                      and length(me_code) = '4'
                                      and substring(me_code, 1, 2) = '{$row['me_code']}'
                                    order by me_order, me_id ";
                        $result2 = sql_query($sql2);
        
                        for ($k=0; $row2=sql_fetch_array($result2); $k++){
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
                </ul>
            </nav><!--gnb-->
        <div class="hd_bg"></div>
     </div><!--#gnb_wrap-->
    <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>
    <!--<div class="mb_call"><a href="tel:16889706"><i class="fas fa-phone-alt"></i></a></div>-->
    <div class="nav_open">
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
            <span></span><span></span><span></span>
        </a>
    </div><!--nav_open 모바일메뉴버튼-->
    <div class="top_call">
        <span>상담문의</span>
        <p><?php echo $config['cf_2']; ?></p>
    </div>
    <ul class="mb_ptmenu cf">
    	<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">마리엔 소개</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=prog01">성혼프로그램</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem01">회원안내</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=consult">무료상담신청</a></li>
    </ul>
    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->

       

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')){?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
        
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼-->
     <? if($co_id == "company" || $co_id == "history" || $co_id == "location") {  ?>
     <div id="svisual" class="a wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s">Wedding Story</h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s">마리엔 소개</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($bo_table == "qna" || $co_id == "process") { ?>
     <div id="svisual" class="b wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s">Wedding Service</h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s">가입안내</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <?/* } else if ($co_id== "" || $co_id == "") { */?><!--
     <div id="svisual" class="c wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s"></h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s"></span>
        </div>
     </div>-->
     <? } else if ($bo_table == "qna02" || $co_id == "service01" || $co_id == "service02") { ?>
     <div id="svisual" class="d wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s">Customer</h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s">고객문의</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($bo_table == "notice") { ?>
     <div id="svisual" class="e wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s">Notice/Event</h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s">공지/이벤트</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else  { ?>
     <div id="svisual" class="c wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="0.8s">Wedding Story</h3>
        	<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="0.8s"><?php echo $config['cf_title']; ?></span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } ?>
    
        <!--서브메뉴-->
        <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
    
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
        ?>
    
	<div id="container">
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
                    <div class="container_title">
                      <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?> 
                    </div>
                    <!--메뉴로케이션-->
                    <?php 
            
                        if(!$is_register || $w){ 
                            if(!$sm_tid)	$sm_tid = $co_id;
                            if(!$sm_tid)	$sm_tid = $bo_table;
                            if($sm_tid)		
                            echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                        }
                    ?>
				</div><!--#sub_title-->
				<!--서브타이틀-->
	<? } ?> 

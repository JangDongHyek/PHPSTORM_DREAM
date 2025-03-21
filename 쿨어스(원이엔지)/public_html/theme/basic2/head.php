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
            <a class="white" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            <a class="color" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->
		<ul id="tnb">
		<!-- <li><a href="<?php echo G5_URL ?>/eng/">ENG</a></li>
		<li><a href="<?php echo G5_URL ?>/jpn/">JPN</a></li> -->
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i></a></li>
            <?php }  ?>
    	</ul>

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
                            
                            if($row['me_course'])
                                $menu['href'] = G5_URL.$row['me_link'];
                            else 
                                $menu['href'] = $row['me_link']
                        ?>
                        <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                            <a href="<?php echo $menu['href']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                        </li>
                        <?php
                        }
            
                        if ($i == 0) {  ?>
                            <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
                    </ul>
					<div id="sub">
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
                        <li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><p><?php echo $row2['me_name'] ?></p></a></li>
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
                </div><!--sub-->
                </nav>


    
    <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>
    <div class="nav_open">
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
			<div> 
				<span></span>
				<span></span>
				<span></span>
			</div>
        </a>
    </div><!--모바일메뉴버튼-->
    
    </div>
</div>
<!-- } 상단 끝 -->


<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">       
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>	
	 <!--서브상단비주얼-->
     <? if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03" || $co_id == "greet04" || $co_id == "greet00" || $co_id == "greet05") {  ?>
	 <div id="svisual" class="sv1">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">회사소개</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro01_01" || $co_id == "pro01_02" || $co_id == "pro01_03") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">2050 탄소중립</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro02_01" || $co_id == "pro05_01") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">Marine CCS(MCCS)</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro03_01") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">MCCS 장비</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro04_01") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">기술의 차별성</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro05_01") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">산업용 HVAC&R</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "pro06_01" || $co_id == "pro06_02" || $co_id == "pro06_03" || $co_id == "pro06_04") {  ?>
     <div id="svisual"  class="sv2">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">해운회사 현황</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($bo_table == "performance") { ?>
     <div id="svisual"  class="sv3">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">주요 수행실적</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "contact01" || $co_id == "contact02" || $co_id == "contact03" || $bo_table == "faq" || $bo_table == "notice" || $bo_table == "contact") { ?>
     <div id="svisual"  class="sv4">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">고객서비스</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else  { ?>
     <div id="svisual"  class="sv1">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">주식회사 쿨어스</h3>
            <div class="container_title wow fadeInRight animated" data-wow-delay="0.4s" data-wow-duration="1.2s">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?> 
            </div>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } ?>
     <div class="sub_nav">
        <!--서브메뉴-->
        <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
    
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
        ?>
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
                    
				</div><!--#sub_title-->
				<!--서브타이틀-->
	<? } ?> 

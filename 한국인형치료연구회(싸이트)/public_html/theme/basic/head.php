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
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.jpg" alt="로고"></a>
        </div><!--#logo-->
		<ul class="utill">
			<?php if ($is_member) {  ?>
			<?php if ($is_admin) {  ?>
			<?php }  ?>
				<li><a href="<?php echo G5_BBS_URL ?>/logout.php"><span>로그아웃</span></a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/mypage.php"><span>마이페이지</span></a></li>
			<?php } else {  ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php"><span>로그인</span></a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/register.php"><span>회원가입</span></a></li>
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
    </nav>
    
    <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>
    <div class="nav_open">
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
            <span></span><span></span><span></span>
        </a>
    </div><!--모바일메뉴버튼-->
    
    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
	<a href="<?php echo G5_BBS_URL ?>/register.php" class="quick_bn">
		<i>회</i>
		<i>원</i>
		<i>가</i>
		<i>입</i>
	</a>
    <div id="container_index">
        
	<!--서브컨테이너 부분-->
	<? }else if($bo_table == "" || $co_id == "" || $fm_id == ""){ ?>
	 <!--서브상단비주얼-->
     <? if($bo_table == "notice" || $co_id == "intro" || $co_id == "location" || $co_id == "location2") {  ?>
	  <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">공지사항</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->
	<? } else if ($co_id == "academy01" || $co_id == "academy06" || $co_id == "academy02" || $co_id == "academy03" || $co_id == "academy04" || $co_id == "academy05" || $bo_table == "faq" || $bo_table == "academy" ) { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">사단법인 한국인형치료학회</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->	
	 <? } else if ($co_id == "research01" || $co_id == "research02" || $co_id == "supervisor" || $bo_table == "store" || $bo_table =='edu' || $bo_table =='certify') { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">한국인형치료연구회</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->	
	 <? } else if ($co_id == "aspt01" || $co_id == "aspt02") { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">동물상징 성격유형검사(ASPT) 연구소</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->
	  <? } else if ($bo_table == "board01") { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">한국인형치료학회지</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->
	  <? } else if ($bo_table == "gallery" || $bo_table == "media") { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">자료실</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->
	 <? } else if ($co_id == "policy01" || $co_id == "policy02") { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
		<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">사단법인 한국인형치료학회</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
     </div><!--svisual-->
	

	<? } else  { ?>
	 <!--서브상단비주얼-->
     <div id="svisual" class="wow">
    	<div class="s_text wow fadeInDown">
            <h3 class="wow fadeInRight">사단법인 한국인형치료학회</h3>
            <em>Korean Association of Figure Therapy</em>
        </div><!--.s_text-->
    </div><!--svisual-->
	<? } ?>   
    
	<div id="container">
		<? if($bo_table || $co_id || $fm_id ){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
			
		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
        <!--서브메뉴-->
        <?php 

            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;

            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
        ?>
			
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

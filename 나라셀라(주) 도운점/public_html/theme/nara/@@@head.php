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
            <a class="white" href="<?php echo G5_URL ?>"><?php echo $config['cf_title']; ?></a>
            <a class="color" href="<?php echo G5_URL ?>"><?php echo $config['cf_title']; ?></a>
        </div><!--#logo-->
		
		<ul id="tnb">
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="far fa-sign-out"></i></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="far fa-sign-in"></i></a></li>
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
    
    </div><!--#hd_wrapper-->
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
     <? if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03") {  ?>
     <div id="svisual" class="sub01">
		<div class="s_text">
           	<h6>Company</h6>
            <h1>회사소개</h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($co_id == "pro01" || $co_id == "pro02" || $co_id == "pro03" || $co_id == "pro04" || $co_id == "pro05" || $co_id == "pro06" || $co_id == "pro07" || $co_id == "pro08" || $co_id == "pro09" || $co_id == "pro10" || $co_id == "pro11" || $co_id == "pro12" || $co_id == "pro13" || $co_id == "pro14") { ?>
     <div id="svisual" class="sub02">
		<div class="s_text">
           	<h6>Product</h6>
            <h1>사업소개</h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($bo_table == "certi01") { ?>
     <div id="svisual" class="sub03">
		<div class="s_text">
           	<h6>Certificate</h6>
            <h1>등록증</h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($bo_table == "certi02_01" || $bo_table == "certi02_02" || $bo_table == "certi02_03") { ?>
     <div id="svisual" class="sub04">
		<div class="s_text">
           	<h6>Technology</h6>
            <h1>기술인력</h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($bo_table == "gall" || $bo_table == "video") { ?>
     <div id="svisual" class="sub05">
		<div class="s_text">
           	<h6>Community</h6>
            <h1>사업실적</h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else  { ?>
     <div id="svisual" class="sub01">
		<div class="s_text">
           	<h6>GLOBAL COMPANY CROUP GROWING WITH SOCIETY</h6>
            <h1><?php echo $config['cf_title']; ?></h1>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic02', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } ?>
     

	<? if($bo_table || $co_id){ ?>
	<div id="container">
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
	<? }else { ?>
	<div id="container">
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

				</div><!--#sub_title-->
				<!--서브타이틀-->
				
	<? } ?> 

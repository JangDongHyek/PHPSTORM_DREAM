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

<!--우측 고정 배너-->
<div class="fix_right">
    <ul>
        <li><a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="far fa-bars"></i></a></li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=intro01">
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/common/fix_icon00.png" alt=""></div>
            <p>진료 안내</p>
            </a>
        </li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info01">
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/common/fix_icon01.png" alt=""></div>
            <p>입퇴원 안내</p>
            </a>
        </li>
        <li>
            <a href="tel:"><p class="tel"><span>051.</span><br />865.<br />0300</a>
        </li>
        <li><a href="#hd" class="topHd"><i class="far fa-chevron-up"></i></a></li>
    </ul>
</div>


<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>


    <div id="hd_top">
        <div class="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
        
        <div class="menu_wrap_r">
			<div id="hd_wrapper">
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

			</div><!--#hd_wrapper-->
			<div class="tmenu">
				<ul>
					<li><a href="javascript:alert('준비중입니다.');" class="btn_qna"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_computer.png" alt="">상담예약</a></li> 
					<li>
						<a href="javascript:alert('준비중입니다.');" class="ic_sns kakao"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_kakao.png" alt=""></a>
					</li>
					<li>
						<a href="https://blog.naver.com/ansimcure/" class="ic_sns blog" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_blog.png" alt=""></a>
					</li>
					<li>
						<a href="javascript:alert('준비중입니다.');" class="ic_sns insta"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_insta.png" alt=""></a>
					</li>
				</ul>
			</div>
        </div>
    </div>
</div>
<!-- } 상단 끝 -->


    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>


<div>
	
</div>
	
<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) { ?>
	<!--메인컨테이너 부분-->
    <div id="container_index">      
 <!--서브컨테이너 부분-->
 
	 <? }else if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03" ){ ?>	
	 <!--서브상단비주얼-->
         
        <div id="svisual">
         <!--서브메뉴-->
         <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
			
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
         ?>
        
		<div class="s_text">
					
            <h2 class="wow fadeInLeft">
				
			 <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			 <?php }else { ?>
					<?php echo $g5['title'] ?>
			 <?php } ?>
			</h2>
            <h6 class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	the best of ansim hospital
			</h6>
            <p class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	안심요양병원은 가족처럼 진심어린 정성으로 보살핍니다.
			</p>
        </div><!--.s_text-->
     </div><!--svisual-->
	<? }else if($co_id == "info01" || $co_id == "info02" || $co_id == "info03" || $co_id == "info04" || $co_id == "info05" ){ ?>	
	 <!--서브상단비주얼-->
         
        <div id="svisual">
         <!--서브메뉴-->
         <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
			
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
         ?>
        
		<div class="s_text">
					
            <h2 class="wow fadeInLeft">
				
			 <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			 <?php }else { ?>
					<?php echo $g5['title'] ?>
			 <?php } ?>
			</h2>
            <h6 class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	the best of ansim hospital
			</h6>
            <p class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	안심요양병원은 가족처럼 진심어린 정성으로 보살핍니다.
			</p>
        </div><!--.s_text-->
     </div><!--svisual-->
	<? }else if($co_id == "intro01" || $co_id == "intro02" ){ ?>	
	 <!--서브상단비주얼-->
         
        <div id="svisual">
         <!--서브메뉴-->
         <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
			
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
         ?>
        
		<div class="s_text">
					
            <h2 class="wow fadeInLeft">
				
			 <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			 <?php }else { ?>
					<?php echo $g5['title'] ?>
			 <?php } ?>
			</h2>
            <h6 class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	the best of ansim hospital
			</h6>
            <p class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	안심요양병원은 가족처럼 진심어린 정성으로 보살핍니다.
			</p>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? }else { ?>
	 <!--서브상단비주얼-->
         
        <div id="svisual">
			 <!--서브메뉴-->
			 <?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
			 ?>

			<div class="s_text">

				<h2 class="wow fadeInLeft">
					
			 <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			 <?php }else { ?>
					<?php echo $g5['title'] ?>
			 <?php } ?>
				</h2>
            <h6 class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
            	the best of ansim hospital
			</h6>
				<p class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
					안심요양병원은 가족처럼 진심어린 정성으로 보살핍니다.
				</p>
			</div><!--.s_text-->
     	</div><!--svisual-->
	<? } ?> 

    

    
    <? if(defined('_INDEX_')) { ?>
	<? }else if($bo_table || $co_id){ ?>
		<div id="container">
			<!-- 서브 게시판 및 내용관리 부분 -->
			<div id="scont_wrap">

				<div id="scont">
					<!--서브타이틀-->
					<div id="sub_title">
						<h2 class="container_title">
						  <?php if($bo_table) {?>
								<?php echo $board['bo_subject']; ?>
							<?php }else { ?>
								<?php echo $g5['title'] ?>
							<?php } ?> 
						</h2>
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
	<? }else { ?>
	<!-- 그외 검사결과창 및 회원가입 -->
	<div id="scont_wrap2">
	<? } ?>


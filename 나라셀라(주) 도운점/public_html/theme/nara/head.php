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
	
    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
	
	
    <div id="hd_wrapper">
		
		<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" class="mlogo" onClick="location.href='<?php echo G5_URL ?>/index2.php'">
		<div class="nav_open">
			<?/*a class="active">KO</a>
			<a>EN</a*/?>
			<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
				<div> 
					<span></span>
					<span></span>
					<span></span>
				</div>
					<p>전체메뉴</p>
			</a>
		</div><!--모바일메뉴버튼-->
    
    </div><!--#hd_wrapper-->
	
	<div class="primary-nav <?php if(defined('_INDEX_')) {  echo "index"; } ?>">

	<button href="#" class="hamburger open-panel nav-toggle active">
		<img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg">
	</button>

		<nav role="navigation" class="menu">


			<div class="overflow-container">

				<ul class="menu-dropdown">
					
			<?php if ($is_member) {  ?>
					<li class="first"><a href="<?php echo G5_BBS_URL ?>/logout.php">LOG OUT</a><span class="icon"><i class="fas fa-user"></i></span></li>					    
					<li class="second"><a href="<?php echo G5_URL ?>/mypage.php">MY PAGE</a><span class="icon"><i class="fas fa-list"></i></span></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u">MY INFO</a><span class="icon"><i class="fas fa-user"></i></span></li>
            <?php } else {  ?>
					<li class="first"><a href="<?php echo G5_BBS_URL ?>/login.php">LOG IN</a><span class="icon"><i class="fas fa-user"></i></span></li>
            <?php }  ?>
					<li><a href="<?php echo G5_URL ?>">HOME </a><span class="icon"><i class="fas fa-home"></i></span></li>
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">도운 소개 </a><span class="icon"><i class="fas fa-building"></i></span></li>
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=floorb2">층별 안내</a><span class="icon"><i class="fas fa-shoe-prints"></i></span></li>

					<li class="menu-hasdropdown">
						<a href="<?php echo G5_URL ?>/rent2.php">대관</a><span class="icon"><i class="fas fa-game-board-alt"></i></span>

						<label title="toggle menu" for="RENT">
							<span class="downarrow"><i class="fa fa-caret-down"></i></span>
						  </label>
						<input type="checkbox" class="sub-menu-checkbox" id="RENT" checked />

						<ul class="sub-menu-dropdown">
							<!--li><a href="<?php echo G5_URL ?>/rent1.php">1F Dowoon Lounge</a></li-->
							<li><a href="<?php echo G5_URL ?>/rent2.php">2F Dowoon Hall</a></li>
							<li><a href="<?php echo G5_URL ?>/rent6.php">6F Dowoon Space</a></li>
						</ul>
					</li>
					<li class="menu-hasdropdown">
						<a href="<?php echo G5_URL ?>/event2.php">클래스</a><span class="icon"><i class="fas fa-users-class"></i></span>

						<label title="toggle menu" for="EVENT">
							<span class="downarrow"><i class="fa fa-caret-down"></i></span>
						  </label>
						<input type="checkbox" class="sub-menu-checkbox" id="EVENT" checked />

						<ul class="sub-menu-dropdown">
							<li><a href="<?php echo G5_URL ?>/event2.php">2F Dowoon Hall</a></li>
							<li><a href="<?php echo G5_URL ?>/event6.php">6F Dowoon Space</a></li>
						</ul>
					</li>
					
					
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a><span class="icon"><i class="fas fa-megaphone"></i></span>
						
						<label title="toggle menu" for="NOTICE">
							<span class="downarrow"><i class="fa fa-caret-down"></i></span>
						  </label>
						<input type="checkbox" class="sub-menu-checkbox" id="NOTICE" checked />

						<ul class="sub-menu-dropdown">
							<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">Dowoon 소식</a></li>
							<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=fna&sca=공지">Q&A</a></li>
						</ul>
					
					
					</li>

				</ul>

			</div>

		</nav>

	</div>

	<div class="new-wrapper">

		<div id="main">

			<div id="main-contents">

			</div>

		</div>

	</div>

</div>
<!-- } 상단 끝 -->
<script>

$('.nav-toggle').click(function(e) {
  
  e.preventDefault();
  $("html").toggleClass("openNav");
  $("#wrapper").toggleClass("openNav");
  $(".index #content .inr").toggleClass("openNav");
  $("#footer").toggleClass("openNav");
  $(".nav-toggle").toggleClass("active");

});
</script>

<!-- 콘텐츠 시작 { -->
<div id="wrapper" class="openNav <?php if(defined('_INDEX_')) {  echo "index"; } ?>">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">       
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>	
	 <!--서브상단비주얼-->
     <? if($co_id == "company") {  ?>
     <div id="svisual" class="sub01">
		<div class="s_text">
            <h1>도운소개</h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($co_id == "floorb1" || $co_id == "floorb2"  ||$co_id == "floor1" || $co_id == "floor2"  || $co_id == "floor3" || $co_id == "floor4" || $co_id == "floor5" || $co_id == "floor6" || $co_id == "floor7") { ?>
     <div id="svisual" class="sub02">
		<div class="s_text">
            <h1>층별안내</h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ( $co_id == "event2" || $co_id == "event6" || $pid == "event6"  || $pid == "event2"  || $pid == "eventview" || $co_id == "event7" || $bo_table == "2fphoto" || $bo_table == "6fphoto") { ?>
     <div id="svisual" class="sub03">
		<div class="s_text">
           	<h1>클래스안내</h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;
				if(!$sm_tid)	$sm_tid = $pid;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($pid == "rent1" ||$pid == "rent2" || $pid == "rent6"  ) { ?>
     <div id="svisual" class="sub05">
		<div class="s_text">
           	<h1>대관안내</h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;
				if(!$sm_tid)	$sm_tid = $pid;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else if ($bo_table == "notice" || $bo_table == "qna") { ?>
     <div id="svisual" class="sub04">
		<div class="s_text">
            <h1>공지사항</h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;
				if(!$sm_tid)	$sm_tid = $pid;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
			?>
		</div>
     </div><!--svisual-->
     <? } else  { ?>
     <div id="svisual" class="sub01">
		<div class="s_text">
            <h1><?php echo $config['cf_title']; ?></h1>
           	<h6>萄韻, 취향에 온전히 집중할 수 있는 공간</h6>
        </div><!--.s_text-->
     
		 <div class="sub_nav">
			<!--서브메뉴-->
			<?php 

				if(!$sm_tid)	$sm_tid = $co_id;
				if(!$sm_tid)	$sm_tid = $bo_table;

				if($sm_tid)		
				echo submenu($sm_tid, 'location', G5_THEME_PATH); 
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

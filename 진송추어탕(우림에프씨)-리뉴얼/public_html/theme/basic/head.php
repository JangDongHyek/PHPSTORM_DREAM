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

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
	

<!-- 상단 시작 { -->
<div id="hd">
	<div class="inr">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>


   <!--
	<div id="topm">
        <div id="topm_in">
        
            <ul id="tnb">
                <li><a href="<?php echo G5_URL ?>" class="home"><i class="fas fa-h-square"></i> 처음으로</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">커뮤니티</a></li>
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">관리자로그인</a></li>
                <?php }  ?>
            </ul>
       </div>    
    </div>#topm-->
    
    <div id="hd_wrapper">
        <div id="logo">
            <a class="white" href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.png" alt="로고"></a>
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
        </div><!--#logo-->
       

		<nav class="gnb">
			<div>
			 <ul>
				<li><a href="#about">진송소개</a></li>
				<li><a href="#interior">인테리어</a></li>
				<li><a href="#menu">메뉴소개</a></li>
				<li><a href="#store">가맹안내</a></li>
				<!--li><a href="#sns">SNS</a></li-->
				<li><a href="#media">언론보도</a></li>
				<li><a href="#inquiry">상담신청</a></li>
			 </ul>
			</div>
		</nav>

    </div><!--#hd_wrapper-->
	</div>
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
	 <!--서브상단비주얼
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <strong>지역혁신·사회연대 및 지역경제 활성화를 위한</strong>
            재단법인부산형 사회연대기금
        	<span></span>
        </div><!--.s_text-->
    <!--</div><!--svisual-->
    
    
	<div id="container">
		<? if($bo_table || $co_id){ ?>
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

<script>
  (function(d) {
    var config = {
      kitId: 'pbo3cho',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
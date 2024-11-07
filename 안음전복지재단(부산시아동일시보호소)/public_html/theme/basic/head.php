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
<div id="header_wrap">
        <div id="top_menu">
            <div id="top_menu_in">
                <ul class="t_menu">
                    <li><a href="<?php echo G5_URL ?>">홈으로</a></li>
                    <?php if ($is_member) {  ?>
					<?php if ($is_admin) {  ?>
                    <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
                    <?php }  ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                    <?php } else {  ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b>로그인</b></a></li>
                    <?php }  ?>
                </ul>
            </div><!--top_menu_in-->
        </div><!--top_menu-->
        <div id="Main_header_wrap">
            <div id="Main_header">
                <h3 class="logo">
                <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
               </h3>
                <div id="Main_menu">
                    <ul>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet01">일시보호소 소개</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=pro01">프로그램 안내</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice">참여마당</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=done01">후원&middot;자원봉사 안내</a></li>
                        <li class="last"><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qna">상담하고 싶어요</a></li><br />

                    </ul>
                </div>
            </div>
        </div>
        <div id="Main_dropdown_wrap">
            <div id="Main_dropdown_div">
                <div id="Main_dropdown">
                    <ul>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet01">인사말</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet02">연 혁</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet03">시설개요</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet04">시설현황</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=greet05">시설전경사진</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet06">오시는 길</a></li>
                    </ul>
                    <ul style="margin-left:65px;">
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=pro01">프로그램 안내</a></li>
                    </ul>
                    <ul style="margin-left:85px;">
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=notice">공지사항</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=gallery">앨범</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=free">자유게시판</a></li>
                    </ul>
                    <ul style="margin-left:60px;">
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=done01">후원안내</a></li>
                        <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=done02">자원봉사안내</a></li>
                    </ul>
                    <ul style="margin-left:120px; margin-right:20px;">
                        <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=qna">상담하고 싶어요</a></li>
                    </ul>
                </div>
            </div>
        </div>
</div><!--header_wrap-->
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
        
	<!--서브컨테이너 부분-->
	<? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼-->
     <div id="svisual">
        
        <!--메뉴로케이션-->
        <?php 

            if(!$is_register || $w){ 
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
                if($sm_tid)		
                echo submenu($sm_tid, 'location', G5_THEME_PATH); 
            }
        ?>    
    	<div class="s_text wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.8s">
            <div class="img02">행복 가득 사랑 가득</div>
            <div class="mt"><i class="fas fa-heart"></i></div>
            <div class="img01">아이들을 향한 따뜻한 마음이 세상을 움직입니다.</div>
        </div>
     </div><!--svisual-->
      
      
    
	<div id="container">
    <!--서브메뉴-->
    <?php 
                    
        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)		
        echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
    ?>
            
            
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
                    <?php if($bo_table == "qna") {?>
                        <div class="qna container_title">
                            <div class="mid03">
                                <?php echo $board['bo_subject']; ?>
                                <p>이곳은 직원 및 아이들이 가지고 있는 다양한 고민과 문제, 걱정들을 이야기하고 해결방법을 찾는 곳입니다.
                                <br class="hidden-xs">
                                상담내용은 <span class="point">비밀보장</span>되오니 많은 이용바랍니다.</p>
                            </div><!--.mid03-->
                        </div>
                    <?php }else { ?>
                       <div class="container_title">
                            <?php echo $g5['title'] ?>
                       </div>
                    <?php } ?>
                    
				</div><!--#sub_title-->
				<!--서브타이틀-->
	<? } ?> 

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
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
        </div>
        <div id="r_area">
            <!--검색영역-->
            <div id="tnb_sch">
                <h3>검색</h3>
                <form name="frmsearch1" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="stx" value="<?php echo stripslashes(get_text(get_search_string($stx))); ?>" id="sch_str" placeholder="어떤 재능이 필요한가요?" required>
                <button type="submit" id="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sch_btn.png" alt="검색"><span class="sound_only">검색</span></button>
                </form>
                <script>
                function search_submit(f) {
                if (f.stx.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }
                
                return true;
                }
                </script>
            </div><!--#tnb_sch-->
            <!--로그인영역-->
            <ul id="tnb">
                <li><a href="<?php echo G5_URL ?>" title="전문인등록">전문인 등록</a></li>
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>" title="관리자" class="line"><i class="fas fa-cog"></i> 관리자</a></li>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" title="정보수정" class="line">내정보</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃" class="line">로그아웃</a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인" class="line">로그인</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php" title="회원가입" class="join">잡고 회원가입</a></li>                    
                <?php }  ?>
            </ul>
        </div><!--r_area-->

        <div class="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                <span></span><span></span><span></span>
            </a>
        </div>
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
     <? if($co_id == "greet01" || $co_id == "greet02") {  ?>
     <div id="svisual">
    	<div class="s_text">
            <h3>test</h3>
        	<span><?php echo $config['cf_title']; ?></span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "prog01" || $co_id == "prog02" || $co_id == "prog03") { ?>
     <div id="svisual">
    	<div class="s_text">
            <h3>test</h3>
        	<span><?php echo $config['cf_title']; ?></span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id== "viet01" || $co_id == "viet02") { ?>
     <div id="svisual">
    	<div class="s_text">
            <h3>test</h3>
        	<span><?php echo $config['cf_title']; ?></span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id == "mem01" || $co_id == "mem02" || $bo_table == "mem03") { ?>
     <div id="svisual">
    	<div class="s_text">
            <h3>test</h3>
        	<span><?php echo $config['cf_title']; ?></span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else  { ?>
     <div id="svisual" class="hide">
    	<div class="s_text">
            <h3>test</h3>
        	<span><?php echo $config['cf_title']; ?></span>
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

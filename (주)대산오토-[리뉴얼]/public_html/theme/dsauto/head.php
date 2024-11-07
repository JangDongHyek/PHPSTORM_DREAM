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
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?> 로고"></a>
        </div><!--#logo-->
		<!--
		<ul id="tnb">
            <li><a href="<?php echo G5_URL ?>" class="home" title="홈"><i class="far fa-home"></i></a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro_01" title="제품소개"><i class="fas fa-cog"></i></a></li>
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i></a></li>
            <?php }  ?>
    	</ul>
		-->

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
                    <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da">
					<span><?php echo $row['me_name'] ?></span>
                    </a>
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

						if($row2[me_code]=="5020"&&$member[mb_level]=="10"){
							$row2['me_link']=str_replace("write.php","board.php",$row2['me_link']);
						}else if($row2[me_code]=="5030"&&$member[mb_level]=="10"){
							$row2['me_link']=str_replace("write.php","board.php",$row2['me_link']);
						}
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
			<i>MENU</i>
        </a>
    </div><!--모바일메뉴버튼-->
    
    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <article id="container_index">      
	<!--서브컨테이너 부분-->
	<? }else if($bo_table == "" || $co_id == ""){ ?>	
        <!--서브상단비주얼-->
        <? if($sub_id == "search") {  ?>
        <div id="svisual" style="display:none;"></div>
        <? } else  { ?>
        <div id="svisual">
        
            <!--서브메뉴-->
            <?php 
                            
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
        
                if($sm_tid)		
                echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
            ?>
            <!--서브드롭메뉴-->
            <?php 
                            
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
        
                if($sm_tid)		
                echo submenu($sm_tid, 'basic_drop', G5_THEME_PATH); 
            ?> 
            
            <div class="line">
                <i class="left"></i>
                <i class="right"></i>
             </div> 
            <div class="s_text">
                <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">DAESAN AUTO</h3>
                <span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="1.2s">(주)대산오토</span>
            </div><!--.s_text-->
         </div><!--svisual--> 
         <? } ?> 
 
	<article id="container">
        <!--검색-->
        <div id="page_sch">
                <h3>검색</h3>
                <form name="fsearchbox" id="form2" action="<?php echo G5_BBS_URL ?>/search2.php" onsubmit="return search_submit(this);" autocomplete="off">
                    <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <select name="sfl">
                        <option value="wr_subject||wr_content||wr_1||wr_2||wr_3">전체</option>
                        <option value="wr_1">품번</option>
                        <option value="wr_subject||wr_2">품명</option>
                        <option value="wr_3">차종</option>
                    </select>
                    <!--<input type="hidden" name="sfl" value="wr_subject||wr_content">-->
                    <input type="hidden" name="sop" value="and">
                    <input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요.">
                    <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                </form>
        </div><!--#tnb_sch-->
        <!--//검색-->
		<!--<div class="line gray">
			<i></i>
			<i></i>
			<i></i>
		</div>-->
		<? if($bo_table || $co_id){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
        
			<div id="scont">
				<!--서브타이틀-->
				<? if($sub_id == "search") {  ?>
				<div id="sub_title" style="margin:100px 0 50px">
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
                
                <? } else  { ?>
                
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
                
	<? } ?> 

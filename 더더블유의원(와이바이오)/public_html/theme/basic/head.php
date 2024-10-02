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

<!--sitemap 시작-->
<div class="modal fade" id="sitemap" role="dialog">
    <div class="modal-dialog modal-lg" style="z-index: 10000;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><i class="fal fa-times-circle"></i></button>
          <h3 class="title02"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo2.png" alt="로고"></h3>
        </div>
        <div class="modal-body">
            <div id="sitemap">
                <ul id="stm_1dul">
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
                        <li class="stm_1dli">
                            <a class="stm_1da"><?php echo $row['me_name'] ?></a>
                            <!--1차메뉴-->
                            <?php
                            $sql2 = " select *
                                        from {$g5['menu_table']}
                                        where me_mobile_use = '1'
                                          and length(me_code) = '4'
                                          and substring(me_code, 1, 2) = '{$row['me_code']}'
                                        order by me_order, me_id ";
                            $result2 = sql_query($sql2);
            
                            for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                                if($k == 0)
                                    echo '<ul class="stm_2dul">'.PHP_EOL;
                            ?>
                                <li class="stm_2dli"><a href="<?php echo 0<strpos($row2['me_link'],"ttp")?"":G5_URL;?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="stm_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴--> 
                            <?php
                            }
            
                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                    <?php
                    }
            
                    if ($i == 0) {  ?>
                        <li id="stm_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
                    <?php } ?>
                    </ul>
            </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
                    </div>
                  </div>
                  
                </div>
            </div>
<!--sitemap 끝-->


<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<!-- 상단 시작 { -->
<div id="hd" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

   
    
    
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
        </div><!--#logo-->
        <ul id="tnb">
            <!--<li><a href="<?php echo G5_URL ?>" class="home" title="홈"><i class="fas fa-home-alt"></i></a></li>-->
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>" class="admin" title="관리자"><i class="fas fa-cog"></i> 관리자</a></li>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i> 로그아웃</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u" title="정보수정"><i class="fas fa-pen-alt"></i> 내정보</a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i> 로그인</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/register.php" title="회원가입"><i class="fas fa-pen-alt"></i> 회원가입</a></li>                   
            <?php }  ?>
            <li><a data-toggle="modal" data-target="#sitemap" style="cursor:pointer" title="전체메뉴"><i class="fas fa-th-list"></i> 사이트맵</a></li>
        </ul>
        <div id="lang">
        	<a href="javascript:alert('준비중입니다')" title="중문홈페이지"><img src="<?php echo G5_THEME_IMG_URL ?>/common/lang_chn.png"></a>
            <a href="<?php echo G5_URL ?>" title="한국홈페이지"><img src="<?php echo G5_THEME_IMG_URL ?>/common/lang_kor.png"></a>
        </div>
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
                    <a href="<?php echo 0<strpos($row['me_link'],"ttp")?"":G5_URL;?><?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
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
                        <li class="gnb_2dli"><a href="<?php echo 0<strpos($row2['me_link'],"ttp")?"":G5_URL;?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
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
    <div id="container_index">
        
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼-->
     <? if($co_id == "greet01" || $co_id == "greet02" || $bo_table=="greet03" || $bo_table=="greet04" || $bo_table=="greet05" || $bo_table=="greet06" || $co_id=="greet06" || $co_id=="greet07" || $co_id=="greet08" || $bo_table =="aca" || $bo_table =="media" || $bo_table =="writing" || $co_id=="greet11") {  ?>
		
			<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="greet">
		
	<!--
	 <div id="svisual" class="sb1 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">더더블유의원 소개</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">더더블유의원은 15년 이상의 경험을 바탕으로<br />가슴에 관련된 모든 진단과 치료, 수술이 가능한 병원입니다.</span>
        </div><!--.s_text
     </div>svisual-->
     <? } else if ($co_id =="s1_01" || $co_id =="s1_02" || $co_id =="s1_03" || $co_id =="s1_04" || $co_id =="s1_05") { ?>
     <div id="svisual" class="sb2 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">맘모톰/유방검진</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">다년간의 검진 및 수술경력의 유방외과 전문의의<br />1:1 맞춤시술을 경험해 보세요.</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s2_01") { ?>
     <div id="svisual" class="sb3 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">보형물 특수검진</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">유방보형물 구별 및 관련 합병증과<br />역형성 대세포림프종 진단을 위한 보형물 특수검진</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s3_01" || $co_id =="s3_02" || $co_id =="s3_03" || $co_id =="s3_04" || $co_id =="s3_05" || $co_id =="s3_06" || $co_id =="s3_07" || $co_id =="s3_08" || $co_id =="s3_09" || $co_id =="s3_10") { ?>
     <div id="svisual" class="sb4 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">가슴성형</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">더 아름답고, 더 건강한 가슴을 위한 가슴성형센터</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s4_01") { ?>
		<? if($co_id =="s4_01") { ?>
			<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="s4_01">
		<?}?>	
	<!--
     <div id="svisual" class="sb5 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">가슴재수술</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">수술 전 정확한 원인분석과 현재 상태 파악 및<br />집도의의 세밀한 수술이 가장 중요합니다.</span>
        </div><!--.s_text
     </div><!--svisual
	 -->
     <? } else if ($co_id =="s5_01") { ?>
		 <? if($co_id =="s5_01") { ?>
			<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="s5_01">
		<?}?>
	<!--	
	 <div id="svisual" class="sb6 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">피막제거술</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">전문적 지식과 경험, 노하우를 바탕으로<br />보다 안전하고 확실하게 시술합니다.<br /></span>
        </div><!--.s_text
     </div><!--svisual-->
     <? } else if ($co_id =="s6_01" || $co_id =="s6_02" || $co_id =="s6_03" || $co_id =="s6_04" || $co_id =="s6_05" || $co_id =="s6_06") { ?>
     <div id="svisual" class="sb7 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">유방재건</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">진정한 ONE STOP 유방재건 시스템<br />보형물 재건부터 자가조직 재건까지</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s7_01") { ?>
     <div id="svisual" class="sb8 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">여유증</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">유선절제술과 지방흡입술을 동시에 진행하여<br />여유증에 대한 확실한 치료를 합니다.</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s8_01" || $co_id =="s8_02") { ?>
     <div id="svisual" class="sb9 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">체형성형</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">무리한 다이어트는 이제 그만!<br />매끈하고 균형잡힌 바디라인</span>
        </div><!--.s_text-->
     </div><!--svisual-->
     <? } else if ($co_id =="s9_01") { ?>
		<? if($co_id =="s9_01") { ?>
			<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="s9_01">
		<?}?>
		 <!--
     <div id="svisual" class="sb10 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">사후관리센터</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">체계적인 1:1 맞춤형 사후관리 시스템을 통해<br />건강한 아름다움을 책임지겠습니다.</span>
        </div><!--.s_text
     </div>-svisual-->
     <? } else if ($bo_table=="after" || $bo_table =="story" || $bo_table =="notice" || $co_id =="qna") { ?>
		<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="community">
	
	<!--
	 <div id="svisual" class="sb11 wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">커뮤니티</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">언제나 친절한 상담과 신속한 안내를 도와드리겠습니다.</span>
        </div><!--.s_text
     </div>svisual-->
     <? } else  { ?>
     <div id="svisual" class="wow fadeIn animated" data-wow-delay="0.1s" data-wow-duration="0.8s">
    	<div class="s_text">
            <h3 class="wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="0.8s">더더블유의원</h3>
        	<span class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">더더블유의원은 15년 이상의 경험을 바탕으로<br />가슴에 관련된 모든 진단과 치료, 수술이 가능한 병원입니다.</span>
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
    <!--서브메뉴-->
    
    
    
	<div id="container">
		<? if($co_id){ ?>
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




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


	<div id="topm">
    	<div id="topm_in">
                <p>에코하이(주)는 앞서가는 기술력과 노하우로  미래를 이끌어 가겠습니다. </p>
                <ul id="tnb">
                    <?php if ($is_member) {  ?>
                    <?php if ($is_admin) {  ?>
                    <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                    <?php }  ?>
                    <li><a href="<?php echo G5_URL ?>" class="home">Home</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">Logout</a></li>
                    <li><a href="mailto:hkz3400@naver.com">Contact Us</a></li>
                    <?php } else {  ?>
                    <li><a href="<?php echo G5_URL ?>" class="home">Home</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/login.php">Login</a></li>
                    <li><a href="mailto:hkz3400@naver.com">Contact Us</a></li>
                    <?php }  ?>
                </ul>
           </div>    
    </div><!--top_m-->
    <div id="hd_wrapper" class="container">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.jpg" alt="로고"></a>
        </div><!--#logo-->
    <hr>

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
                <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
    
    
    <!--mobile메뉴-->
		  <div class="tn nav_open"><span></span><span></span><span></span></div>
          <div id="mask" style="display:none"></div>
        
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/icon_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title"><!--<i class="fa fa-th-large"></i> -->전체메뉴 안내</div>
                      <!--메뉴시작-->
                      <div id="accordion-example" data-collapse="accordion">
                        <div id="gnb2" class="hd_div">
                                <ul id="mgnb_1dul">
                                <?php
                                $sql = " select *
                                            from {$g5['menu_table']}
                                            where me_mobile_use = '1'
                                              and length(me_code) = '2'
                                            order by me_order, me_id ";
                                $result = sql_query($sql, false);
                    
                                for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                    <li class="mgnb_1dli">
                                        <a class="mgnb_1da"><?php echo $row['me_name'] ?></a>
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
                                                echo '<ul class="mgnb_2dul">'.PHP_EOL;
                                        ?>
                                            <li class="mgnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                                        <?php
                                        }
                    
                                        if($k > 0)
                                            echo '</ul>'.PHP_EOL;
                                        ?>
                                    </li>
                                <?php
                                }
                    
                                if ($i == 0) {  ?>
                                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
                                <?php } ?>
                                </ul>
                            </div>
                      </div>
						</div>
                    </li>
		   </ul>
		   </nav>
<!--mobile메뉴 끝-->
    
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
		<!--서브상단비주얼시작-->
     <div id="svisual">
    	<div class="svisual_in">
    		<div class="s_text">
        		<h2>뛰어난 설계와 완벽한 시공</h2>
                <p>보강토옹벽공사 / 석축공사 / 콘크리트옹벽공 / 토공사<br />토목용보강재 / 보강토연결클립 / 보강토블록</p>
        	</div><!--s_text-->
        </div><!--svisual_in-->
    </div><!--svisual-->
    <!--서브상단비주얼끝-->
    
	<div id="container">
		<?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
		?>
		<!--서브내용 부분-->
		<div id="scont_wrap">
			<div id="scont">
				<!--서브타이틀-->
				<div id="sub_title">
					<div class="p_info">
						<ul>
							<li><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon_home.gif" />&nbsp;HOME</a></li>
							<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
							<li class="pt"> 
								<?php if($bo_table) {?>
								<?php echo $board['bo_subject']; ?>
								<?php }else { ?>
								<?php echo $g5['title'] ?>
								<?php } ?>
							</li>
						</ul>
					</div><!--.p_info-->
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

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

<!--sitemap-->
<div class="modal fade" id="sitemap" role="dialog">
    <div class="modal-dialog modal-lg" style="z-index: 10000;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px 30px 10px !important; border-bottom:0px; background: #436fc8;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="title02" style="padding: 15px 0;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sitemap_logo.png" alt="로고" style="vertical-align:bottom">&nbsp;SITEMAP</h3>
        </div>
        <div class="modal-body" style="background:url(/kor/theme/zenfix/img/sub/icon_sitemap.png) no-repeat right bottom">
<div id="sitemap">
    <ul id="stm_1dul">
		<?php
        $sql = " select *
                    from {$g5['menu_table']}
                    where me_mobile_use = '1'
                      and length(me_code) = '2'
                    order by me_order, me_id ";
        $result = sql_query($sql, false);

        for($i=0; $row=sql_fetch_array($result); $i++) {
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
                    <li class="stm_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="stm_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
    </div>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    
    <div id="hd_wrapper" class="container">
    
    <div id="logo_area" class="clearfix">
       <!--로고-->
       <h1 class="col-md-2"><div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></div></h1>
       <!--메인카테고리-->
       <div class="col-md-8">
            <div id="nav_area" class="hidden-sm hidden-xs">
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
                </div>
       </div>
       <!--sns-->
       <div class="col-md-2 tmenu">
                 <? /*<ul>
                      <li><a href="<?php echo G5_URL ?>">HOME</a></li>
                      <?php if ($is_member) {  ?>
                      <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info02">요금안내</a></li>
                      <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_reserv">예약확인</a></li>
                      <?php } else {  ?>
                      <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=info02">요금안내</a></li>
                      <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_reserv">예약확인</a></li>
                      <?php }  ?>
                 </ul>*/ ?>
                 <ul>
                      <li><a href="<?php echo G5_URL ?>">HOME</a></li>
                      <li><a href="<?php echo G5_URL ?>/adm" target="_blank">입출고관리&nbsp;&nbsp;<i class="fas fa-keyboard"></i></a></li>
                 </ul>
       </div>
  
          
          <!--mobile메뉴-->
		  <div class="tn nav_open"><span></span><span></span><span></span></div>
          <div id="mask" style="display:none"></div>
        
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_close.png" /></div>
			 <ul style="margin:0 0 20px">
              <li>
                <div id="left_menu">
                <div class="title" style="text-indent:0 !important; padding:10px 0 10px 15px"><?php echo $config['cf_title']; ?></div>
                      <!--메뉴시작-->
                      <div class="mobile_head">
                          <ul>
                                <li><a href="<?php echo G5_URL ?>">HOME</a></li>
                                <?php if ($is_member) {  ?>
                                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                                <?php } else {  ?>
                                <li><a href="<?php echo G5_BBS_URL ?>/login.php">관리자</a></li>
                                <?php }  ?>
                         </ul>
                      </div>
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
           <!--<div class="text-center t_marign30 b_margin20">
               <img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_facebook.png" alt="페이스북" style="width: 30px;height: 30px;border-radius: 15px;margin: 8px 3px 0;"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sns_twitter.png" alt="트위터" style="width: 30px;height: 30px;border-radius: 15px;margin: 8px 0 0;">
           </div>-->
           <!--<div class="t_margin30 col-md-12">
             <div class="m_cus_tel"><?php echo $config['cf_2']; ?></div>
              <div class="t_margin15">
                  <span class="f_box">FAX</span><span class="f_num"><?php echo $config['cf_3']; ?></span>
              </div>
              <div class="t_margin15">
                  <span class="e_box">E-mail</span><span class="f_num"><?php echo $config['cf_5']; ?></span>
              </div>
           </div>-->
		   </nav>
           <!--mobile메뉴 끝-->
           
    </div><!--.logo_area-->  
    
    </div><!--#hd_wrapper-->
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브상단비주얼시작-->
    
    
            <?php if($co_id == "greet01_eng"||$co_id == "greet02_eng"||$co_id == "greet03_eng"||$co_id == "greet04_eng"||$co_id == "greet05_eng"||$co_id == "greet06_eng"){ //회사소개
			 echo "<div id='svisual' class='wow fadeInDown hidden-sm' data-wow-delay='0.1s'>"; 
			}else if($co_id == "pro01_eng"||$co_id == "pro02_eng"){ //제품소개
			 echo "<div id='svisual' class='a wow fadeInDown hidden-sm' data-wow-delay='0.1s'>"; 
			}else if($bo_table == "faq_eng"||$bo_table == "qna_eng"||$bo_table == "notice_eng"){ //고객지원
			 echo "<div id='svisual' class='b wow fadeInDown hidden-sm' data-wow-delay='0.1s'>";
			}else if($bo_table == "hr_eng"||$co_id == "hr02_eng"||$co_id == "hr03_eng"){ //인재채용
			 echo "<div id='svisual' class='c wow fadeInDown hidden-sm' data-wow-delay='0.1s'>";
			}else{
			 echo "<div id='svisual' class='d wow fadeInDown hidden-sm' data-wow-delay='0.1s'>"; 
			}
            ?>
     
    	    <div class="svisual_in">
            
            <div>
            <?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
	    	?>
            </div> 
    		<div class="s_text">
            
            
            <?php if($co_id == "introduce01"||$co_id == "introduce02"||$co_id == "introduce03"||$bo_table == "g_parking"||$co_id == "greet05_eng"||$co_id == "greet06_eng"){ //회사소개
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>회사소개</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}else if($co_id == "info01"||$co_id == "info02"){ //이용안내
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>이용안내</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}else if($bo_table == "b_reserv"){ //예약하기
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>".$g5['title']."</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}else if($bo_table == "g_tour01"||bo_table == "g_tour02"||$bo_table == "g_tour03"||$bo_table == "g_tour04"){ //인재채용
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>편의시설정보</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}else if($bo_table == "b_notice"||bo_table == "b_faq"||$bo_table == "b_qna"||$bo_table == "b_event"){ //인재채용
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>고객센터</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}else{ //
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>경남주차장</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>김해국제공항 최고의 주차서비스 경남주차장 입니다.</p>";
			}
		?>

                
        	</div>
        	</div></div>
    <!--서브상단비주얼끝-->

    
	<? if($co_id == "introduce01" || $co_id == "info01") {  ?>
	<div id="container_100">
    <? }else if($bo_table == "" || $co_id == ""){ ?>
	<div id="container">
    <? } ?>
		<div id="scont_wrap clearfix">

               <div id="scont" class="col-md-12">
             
				<!--서브타이틀-->
				<div id="sub_title" class="clearfix">
                    <h2 class="container_title col-md-12 col-xs-12">
                        <?php if($bo_table) {?>
                            <?php
								if(0<strpos($_SERVER['PHP_SELF'],"board.php")&&$bo_table=="b_reserv"){
									echo "예약확인";
								}else{
									echo $board['bo_subject'];
								}
							?>
                        <?php }else { ?>
                            <div class="t_margin10"><?php echo $g5['title'] ?></div>
                        <?php } ?>
                    </h2>
			</div><!--#sub_title-->
			<!--서브타이틀-->
		<? } ?> 

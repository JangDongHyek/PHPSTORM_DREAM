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
       <h1 class="col-md-2"><div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="LOGO"></a></div></h1>
       <!--메인카테고리-->
       <div class="col-md-7">
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
       <div class="col-md-3">
            <div class="g_menu fs">
                                <dl>
                                         <dt>ENG</dt>
                                            <dd>
                                              <a href="<?php echo G5_URL2 ?>eng">ENG</a>
                                              <a href="<?php echo G5_URL2 ?>kor">KOR</a>
                                           </dd>
                                </dl>
            </div>
            <!--<div class="t_sns hidden-sm hidden-xs">
                <span><a href="https://www.facebook.com/" class="icon_round" target="_blank" title="페이스북 새창으로 열림"></a></span>&nbsp;&nbsp;
                <span><a href="https://www.twitter.com/" class="icon_round02" target="_blank" title="옐로우카카오 새창으로 열림"></a></span>&nbsp;&nbsp;
                <span><a href="http://blog.naver.com/" class="icon_round03" target="_blank" title="네이버블로그 새창으로 열림"></a></span>
            </div>-->
            <div class="w_menu"><a data-toggle="modal" data-target="#sitemap" style="cursor:pointer"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_all.png" /></a></div>
       </div>
  
          
          <!--mobile메뉴-->
		  <div class="tn nav_open"><span></span><span></span><span></span></div>
          <div id="mask" style="display:none"></div>
        
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_close.png" /></div>
			 <ul style="margin:0 0 20px">
              <li>
                <div id="left_menu">
                <div class="title" style="text-indent:0 !important; padding:10px 0 10px 15px"><i class="fa fa-th-large"></i>ORTHOTHCH Category&nbsp;&nbsp;
                     <?php if ($is_member) {  ?>
                     <a href="<?php echo G5_BBS_URL ?>/logout.php" style="color:#fff"><i class="fa fa-unlock-alt"></i></a>
                     <?php } else {  ?>
                     <a href="<?php echo G5_BBS_URL ?>/login.php" style="color:#fff"><i class="fa fa-lock"></i></a>
                     <?php }  ?></div>
                      <!--메뉴시작-->
                      <div class="mobile_head">
                          <ul>
                            <li><a href="<?php echo G5_URL ?>"><i class="fa fa-home"></i>HOME</a></li>
                            <li class="fs" title="글로벌 웹사이트 링크">
                               <dl>
                                   <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce_eng07"><dt style="font-weight:400"><i class="fa fa-caret-down"></i>CONTACT US</dt></a>
                               </dl>
                           </li>
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
           <div class="t_margin30 col-md-12">
             <div class="m_cus_tel">+82-53-314-7016</div>
              <div class="t_margin15">
                  <span class="f_box">FAX</span><span class="f_num">+82-53-314-7071</span>
              </div>
              <div class="t_margin15">
                  <span class="e_box">E-mail</span><span class="f_num">orthotech@orthotech.co.kr</span>
              </div>
           </div>
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
			 echo "<div id='svisual' class='wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($co_id == "pro01_eng"||$co_id == "pro02_eng"){ //제품소개
			 echo "<div id='svisual' class='a wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($bo_table == "faq_eng"||$bo_table == "qna_eng"||$bo_table == "notice_eng"){ //고객지원
			 echo "<div id='svisual' class='b wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>";
			}else if($bo_table == "hr_eng"||$co_id == "hr02_eng"||$co_id == "hr03_eng"){ //인재채용
			 echo "<div id='svisual' class='c wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>";
			}else{
			 echo "<div id='svisual' class='d wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}
            ?>
     
    	    <div class="svisual_in">
    		<div class="s_text">
            
            
            <?php if($co_id == "greet01_eng"||$co_id == "greet02_eng"||$co_id == "greet03_eng"||$co_id == "greet04_eng"||$co_id == "greet05_eng"||$co_id == "greet06_eng"){ //회사
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>COMPANY</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>Innovative Core Technologles Of Medical Devices</p>";
			}else if($co_id == "pro01_eng"||$co_id == "pro02_eng"){ //제품소개
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>PRODUCTS</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>Innovative Core Technologles Of Medical Devices</p>";
			}else if($bo_table == "faq_eng"||$bo_table == "qna_eng"||$bo_table == "notice_eng"){ //고객지원
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>SUPPORTS</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>Innovative Core Technologles Of Medical Devices</p>"; 
			}else if($bo_table == "hr_eng"||$co_id == "hr02_eng"||$co_id == "hr03_eng"){ //인재채용
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>HR CENTER</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>Innovative Core Technologles Of Medical Devices</p>"; 
			}else{ //
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.2s'>INQUIRY</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>Innovative Core Technologles Of Medical Devices</p>"; 
			}
		?>

                
        	</div>
        	</div></div>
    <!--서브상단비주얼끝-->

    
	<div id="container">
		<div id="scont_wrap clearfix">
        
            <div class="col-md-3">
            <?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
	    	?>
            </div>
			<div id="scont" class="col-md-9">
      
                              
				<!--서브타이틀-->
				<div id="sub_title">
                    <h2 class="container_title col-md-8 col-xs-8">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <div class="t_margin10"><?php echo $g5['title'] ?></div>
                        <?php } ?>
    
                    </h2>
					<div class="col-md-4 col-xs-4">
                            <?php 
                            
                                        if(!$is_register || $w){ 
                                            if(!$sm_tid)	$sm_tid = $co_id;
                                            if(!$sm_tid)	$sm_tid = $bo_table;
                                            if($sm_tid)		
                                            echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                                        }
                                  ?>
                    </div>
			</div><!--#sub_title-->
			<!--서브타이틀-->
		<? } ?> 

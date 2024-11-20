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


    <div id="hd_wrapper" class="container">



          <h1><div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></h1><!--#logo-->
    <hr>

	<div id="topm" class="hidden-sm hidden-xs">
    	<div id="topm_in">
                <p><i class="fa fa-phone-square"></i>Whatsup : <?php echo $config['cf_3']; ?></p>
                <ul id="tnb">
                    <?php if ($is_member) {  ?>
                    <?php if ($is_admin) {  ?>
                    <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                    <?php }  ?>
                    <li><a href="<?php echo G5_URL ?>" class="home">Home</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/logout.php">Logout</a></li>
                    <!--<li><a href="<?php echo G5_ADMIN_URL ?>" target="_blank" title="새창"><i class="fa fa-lock"></i>관리자접속</a></li>-->
                    <?php } else {  ?>
                    <li><a href="<?php echo G5_URL ?>" class="home">Home</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/login.php">Login</a></li>
                    <?php }  ?>
                </ul>
           </div>    
    </div><!--top_m-->

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
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title">전체메뉴 안내<i class="fa fa-th-large"></i>&nbsp;&nbsp;
                     <?php if ($is_member) {  ?>
                     <a href="<?php echo G5_BBS_URL ?>/logout.php" style="color:#fff"><i class="fa fa-unlock-alt"></i></a>
                     <?php } else {  ?>
                     <a href="<?php echo G5_BBS_URL ?>/login.php" style="color:#fff"><i class="fa fa-lock"></i></a>
                     <?php }  ?>
                </div>
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
                                        <a class="mgnb_1da" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>
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
           <div class="t_margin30 col-md-12 text-center">
              <div style="font-family: 'Titillium Web', Arial, sans-serif;font-size:3em;color: #3f3f3f; line-height:0.8; font-weight:bold"><?php echo $config['cf_3']; ?></div>
              <div class="t_margin15"><span style="background:#8db135; border:0px; padding:0px 6px; font-size:1.15em; color:#fff; margin-right:10px">E-mail</span></span><span style="font-size:1.15em; font-weight:600"><?php echo $config['cf_6']; ?> </span></div>
           </div>
		   </nav>
<!--mobile메뉴 끝-->

<script>
$(document).ready(function() {
	// 모바일 트리메뉴 .gnb .d1 h3를 클릭
	$("#navtoggle .mgnb_1dli .mgnb_1da").click(function(){
		var dp = $(this).siblings("ul.mgnb_2dul").css("display");
		if(dp=="none"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$(this).addClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			$(this).siblings("ul.mgnb_2dul").slideDown(500);
			}
		if(dp=="block"){
			$("#navtoggle .mgnb_1dli .mgnb_1da").removeClass("on");
			$("#navtoggle .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			}
		return false;
	});
});
</script>

    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브상단비주얼시작-->
	
    
<!--
            <div id='svisual' class='wow fadeInUp' data-wow-delay='0.1s'>
     		
			<!--?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
	    	?-->
			
    	    <!--div class="svisual_in">
    		<div class="s_text">
            
        	</div>
        </div>
    </div-->

	
	<!--svisual-->
    <!--서브상단비주얼끝-->
    
    
                 <!--모바일2차메뉴-->
                    <div class="visible-xs visible-sm">

                           <? if(defined('_INDEX_')) {?>
                           <div style="display:none"></div>
                           
                           
                           <? } else if($co_id == "introduce01"||$co_id == "introduce02") { //회사소개 ?>
                            <!--2차메뉴-->
                                       <p class="snb_area"><a href="javascript:showMenuList();"></a></p>
                                       <div class="snb_box">   
	                                      <ul class="menu_box" id="menu_list" style="display:none;">
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce01">인사말</a></li>
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce02">찾아오시는 길</a></li>
                                          </ul>
	                                    </div>


                           <script type="text/javascript">
	                           $(function(){
		                           $('.snb_area a').text("회사소개");
		                           $('.snb_area a').append('<span class="btn_img"></span>')
	                           });
                           </script>
                           <!--//2차메뉴-->
                           
                           
                           <? } else if($co_id == "introduce04"||$co_id == "introduce07"||$co_id == "introduce06") { // 이용안내 ?>
                            <!--2차메뉴-->
                                       <p class="snb_area"><a href="javascript:showMenuList();"></a></p>
                                       <div class="snb_box">   
	                                      <ul class="menu_box" id="menu_list" style="display:none;">
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce04">입원안내 </a></li>
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce07">치료범위</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=introduce06">찾아오시는 길</a></li>
                                          </ul>
	                                    </div>


                           <script type="text/javascript">
	                           $(function(){
		                           $('.snb_area a').text("이용안내");
		                           $('.snb_area a').append('<span class="btn_img"></span>')
	                           });
                           </script>
                           <!--//2차메뉴-->
                           
                           
                           <? } else if($co_id == "medi00"||$co_id == "medi01"||$co_id == "medi02"||$co_id == "medi03"||$co_id == "medi04"||$co_id == "medi05"||$co_id == "medi06"||$co_id == "medi07") { // 치료프로그램 ?>
                            <!--2차메뉴-->

                                       <p class="snb_area"><a href="javascript:showMenuList();"></a></p>
                                       <div class="snb_box">   
	                                      <ul class="menu_box" id="menu_list" style="display:none;">
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi00">치료프로그램 안내</a></li>
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi01">숲속 치료 프로그램</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi02">온열암치료 </a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi03">비타민C 메가요법</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi04">면역치료</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi06">심신이완치료</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi05">통증치료</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi08">한방치료</a></li>
                                             <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=medi07">항암식단</a></li>
                                          </ul>
	                                    </div>


                           <script type="text/javascript">
	                           $(function(){
		                           $('.snb_area a').text("통합 암/면역 치료 안내");
		                           $('.snb_area a').append('<span class="btn_img"></span>')
	                           });
                           </script>
                           <!--//2차메뉴-->
                           
                           
                           
                           <? } else if($bo_table == "b_notice"||$bo_table == "b_qna") { // 커뮤니티 ?>
                            <!--2차메뉴-->
                                       <p class="snb_area"><a href="javascript:showMenuList();"></a></p>
                                       <div class="snb_box">   
	                                      <ul class="menu_box" id="menu_list" style="display:none;">
                                             <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_notice">공지사항</a></li>
	                                         <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=b_qna">질문과 답변</a></li>
                                          </ul>
	                                    </div>


                           <script type="text/javascript">
	                           $(function(){
		                           $('.snb_area a').text("커뮤니티");
		                           $('.snb_area a').append('<span class="btn_img"></span>')
	                           });
                           </script>
                           <!--//2차메뉴-->

                          
                           <?php } ?>       
                    
                   </div>
                   
<script>
 //서브메뉴
var isShowMenuList = false;
function showMenuList() {
	if (isShowMenuList) {			
		$("#menu_list").hide();	
		$(".btn_img").removeClass("on")
	} else {
		$("#menu_list").show();
		$(".btn_img").addClass("on");
	}
	isShowMenuList = !isShowMenuList;
}

</script>
                   
                   <!--//모바일2차메뉴-->  
    
	<div id="container">
		<!--서브내용 부분-->
		<div id="scont_wrap">
			<div id="scont">
      
                              
				<!--서브타이틀-->
				<div id="sub_title">
					<!--<div class="p_info">
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
					</div>--><!--.p_info-->
				<h2 class="container_title" style="clear:both">
					<?php if($bo_table) {?>
						<?php echo $board['bo_subject']; ?>
					<?php }else { ?>
						<?php echo $g5['title'] ?>
					<?php } ?>
                    <p class="wow bounceIn" data-wow-delay="0.5s" style="width:100px; border-bottom:1px solid #afafaf; margin:0px auto"></p>
                    <p style='font-size: 0.35em;font-weight: 400;line-height: 2.8em;color: #8a8a8a;'>Consulting &amp; Solution provider for SME</p>

				</h2>
			</div><!--#sub_title-->
			<!--서브타이틀-->
		<? } ?> 

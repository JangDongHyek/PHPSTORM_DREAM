<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/mobile/logo.gif" /></a>
        </div>

		  <div class="tn sch"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/mobile/top_home.gif" /></a></div>
		  <div class="tn nav_open"><span></span><span></span><span></span></div>
          <div id="mask" style="display:none"></div>
          
          
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_IMG_URL ?>/mobile/icon_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title"><!--<i class="fa fa-th-large"></i> -->전체메뉴 안내</div>
                      <!--메뉴시작-->
                      <div id="accordion-example" data-collapse="accordion">
                        <div id="gnb" class="hd_div">
                                <ul id="gnb_1dul">
                                <?php
                                $sql = " select *
                                            from {$g5['menu_table']}
                                            where me_mobile_use = '1'
                                              and length(me_code) = '2'
                                            order by me_order, me_id ";
                                $result = sql_query($sql, false);
                    
                                for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                    <li class="gnb_1dli">
                                        <a class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                                                echo '<ul class="gnb_2dul">'.PHP_EOL;
                                        ?>
                                            <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
          
<script type="text/javascript">
	window.onload = function(){
		var wrapHeight = $('body').height();
		$('#navtoggle').css("height", wrapHeight);
	};
	$(window).resize(function() {
		var wrapHeight = $('body').height();
		$('#navtoggle, #mask').css("height", wrapHeight);
	});
	$('.nav_open').click(function(){
		var maskHeight = $('body').height();
		var maskWidth = $(window).width();
		var nav =  $('#navtoggle');
		$('#mask').css({
			'display'	: 'block',
			'opacity'	: 0.7,
			'height'	: maskHeight,
			'width'		: maskWidth
		})
		nav.css('display','block');
		nav.animate({width:"80%",left:"0" }, 200);
		$('.inner').animate({right:"0"}, 200);
	});
	$('.nav_close, #mask').click(function(){
		var nav =  $('#navtoggle');
		$('#mask').css('display','none');
		$('.inner').animate({right:"0"}, 200);
		nav.animate({
			width		:"0",
		}, 200, function(){nav.css('display','none')});
	});
	
$(document).ready(function(){
			$('#pop_wave').animate({
				height:'135px',
				width:'135px',
				opacity:1,
			     },1500);	
});	


//모바일 트리메뉴
$(function(){
		$("ul.gnb_2dul").css("display","none");
		//$("ul.gnb_2dul:not(:first)").css("display","none");
		//$("a.gnb_1da:first").addClass("selected")
		$("a.gnb_1da").click(function(){
			if($("+ul.gnb_2dul", this).css("display")=="none"){
				$("ul.gnb_2dul").slideUp(300);
				$("+ul.gnb_2dul", this).slideDown(300);
				$("a.gnb_1da").removeClass("selected");
				$(this).addClass("selected");				
				}
			})
})

	
</script>          


  
	</div>          
</header>
<!--//header-->

<div id="wrapper">
<? if(defined('_INDEX_')) {?>  <!--index에 나오지않고-->
   <div style="display:none"></div>
<? }else if($bo_table == "" || $co_id == ""){ ?><!-- 내용/게시판에 나와라-->
    <div id="container">
            <!--페이지경로시작-->
            <div class="page_info">
                     <ul>
                        <li class="home"><a href="<?php echo G5_URL ?>">HOME</a></li>
                        <li>&nbsp; &gt; &nbsp;</li>
                        <li>
                        <? if($co_id == "greet1" || $co_id == "greet2" || $bo_table =="g_greet3" || $co_id == "greet4"){	//센터소개
                            echo ("센터소개"); 
                        }else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program05" || $co_id == "program06" || $co_id == "program07" ){ // 진로검사/상담
                            echo ("진로검사/상담"); 
                        }else if($co_id == "experience01" || $co_id == "experience02" || $co_id == "experience03" || $co_id == "experience04" || $co_id == "experience07"){ // 진로/직업 체험
                            echo ("진로/직업 체험"); 
                        }else if($co_id == "education01" || $co_id == "education02" || $co_id == "education03" || $co_id == "education05" || $co_id == "education06" || $co_id == "education07"){ // 진로교육
                            echo ("진로교육"); 
                        }else if($co_id == "job"){ // 우리지역 직업체험처
                            echo ("우리지역 직업체험처"); 
                        }
                        }else if($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy"){ // 정보마당
                            echo ("정보마당"); 
                        }
                         ?>         
                         </li>
                         
                        <li>&nbsp; &gt; &nbsp;</li>
                        
                        <li>
						  <?php
						  if($bo_table){
							if($mode == '' || $mode == 'book'){
						  ?>
                          <li><span><?php echo $board['bo_subject']; ?></span></li>
                          <?php
							}else if($mode == 'identify' || $mode == 'identify_adm'){
						  ?>
						  <li><span><?php echo $board['bo_subject'].'확인'; ?></span></li>
						  <?php
							}
						  }else{
						  ?>
                          <li><span><?php echo $g5['title'] ?></span></li>
                          <?php
						  }
						  ?>
                      </li>
                     </ul>
           </div><!--.page_info-->
            <!--페이지경로 끝-->
            
            <!--서브 2차메뉴 시작-->
                <p class="snb_area"><a href="javascript:showMenuList();"></a></p>
                <div class="snb_box">   
                   <ul class="menu_box" id="menu_list" style="display:none;">
                        <? if($co_id == "greet1" || $co_id == "greet2" || $bo_table =="g_greet3" || $co_id == "greet4") { // 센터소개 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet1">인사말</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet2">센터안내</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=g_greet3">둘러보기</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4">찾아오시는길</a></li>
                        <? } else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program03" || $co_id == "program04" || $co_id == "program05" || $co_id == "program06" || $co_id == "program07" ) { // 진로검사/상담 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel">상담예약</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify">상담예약확인</a></li>
                          <li><a href="http://www.career.go.kr/cnet/front/main/main.do" target="_blank">진로심리검사</a></li>
                          <li><a href="http://www.work.go.kr/consltJobCarpa/jobPsyExam/jobPsyExamIntro.do" target="_blank">직업심리검사</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program05">특목고 적합도검사</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program06">학과계열 선정검사</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program07">유형별학습법진단검사</a></li>
                        <? } else if ($co_id == "experience01" || $co_id == "experience02" || $co_id == "experience03" || $co_id == "experience04" || $co_id == "experience07"){ // 진로/직업 체험 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience01">체험사업 안내</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience02">자유학기제프로그램</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience03">진로캠프</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience04">초등 토요 창직캠프</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=experience07">진로박람회</a></li>
                        <? } else if ($co_id == "education01" || $co_id == "education02" || $co_id == "education03" || $co_id == "education04" || $co_id == "education05" || $co_id == "education06"){ // 진로교육 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education01">교육사업안내</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education02">진로진학상담교실</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education07">생활기록부 및 자소서 특강</a></li>
                          <!--<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education03">찾아가는 직업인 특강</a></li>-->
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education05">진로코치심화연수</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education06">진로집단상담</a></li>
                         <!-- <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=education04">진로집단상담</a></li>-->
                        <? } else if ($co_id == "job"){ // 우리지역 직업체험처 ?>
                          <li><a href="http://dream.sahayouth.or.kr/p61.php" target="_blank">직업체험처 소개</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=job">직업체험 신청방법</a></li>
                        <? } else if ($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy"){ // 정보마당 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=noticee">공지사항</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=referencee">자료실</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=galleryy">갤러리</a></li>

                        <? } ?>
                   </ul>
                </div>
                 <script type="text/javascript">
                     $(function(){
                      //$('.snb_area a').text("센터소개");
                      $('.snb_area a').append('<span class="btn_img"></span>')
                  });
                 </script>
                 
            <!--서브 2차메뉴 끝-->
    
            <!--서브메뉴 타이틀-->
			<?php if($co_id){?> 
                <div id="container_title"><?php echo $g5['title'] ?></div><!--#container_title-->
            <?php if($bo_table) {?>
            	<div style="display:none"></div>
            <?php } ?>
<?php } ?>
<?php } ?>

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





    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
	
	
	
	
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
                        <? if($co_id == "greet1" || $co_id == "greet2" || $bo_table =="g_greet3" || $co_id == "greet4" || $co_id == "greet5"){	//센터소개
                            echo ("센터안내"); 
                        }else if($co_id == "pro_jung01" || $co_id == "pro_jung02") { 
                            echo ("중점사업"); 
                        }else if($co_id == "pro_jung03" || $co_id == "pro_tuk01" || $co_id == "pro_tuk02" || $co_id == "pro_tuk03" || $co_id == "pro_tuk04" || $co_id == "pro_tuk05" || $co_id == "pro_tuk06" || $co_id == "pro_tuk07"  || $co_id == "pro_tuk08" || $co_id == "pro_tuk09" || $co_id == "pro_tuk10" || $co_id == "pro_tuk11"){ 
                            echo ("특화사업"); 
                        }else if($co_id == "pro_rang01" || $co_id == "pro_rang02" || $co_id == "pro_rang03" || $co_id == "pro_rang04"){ 
                            echo ("교육사업"); 
                        }else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program08" || $bo_table == "program" || $bo_table == "apply"){ // 프로그램예약
                            echo ("프로그램예약"); 
                        }else if($co_id == "job" || $bo_table == "exp" || $co_id == "maching"){ // 꿈길 직업체험처
                            echo ("꿈길 직업체험처"); 
                        }else if($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy" || $bo_table == "calendar" || $bo_table == "push"){ // 정보마당
                            echo ("정보마당"); 
                        }
                         ?>         
                         </li>
                         
                        <li>&nbsp; &gt; &nbsp;</li>
                        
                        <li>
						  <?php
						  if($bo_table){
							if($mode == '' || $mode == 'book'){
								$title=0 < strpos($_SERVER[PHP_SELF],"apply")?"확인":"";
						  ?>
                          <li><span><?php echo $board['bo_subject'].$title; ?></span></li>
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
                        <? if($co_id == "greet1" || $co_id == "greet2" || $bo_table =="g_greet3" || $co_id == "greet4" || $co_id == "greet5") { // 센터소개 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet1">인사말</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet2">센터안내</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet5">연혁</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=g_greet3">둘러보기</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4">찾아오시는길</a></li>
                        <? } else if ($co_id == "pro_jung01" || $co_id == "pro_jung02"){ // 중점사업 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung01">꿈길운영</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung02">진로체험지원 네트워크</a></li>
						  
                    <? } else if ($co_id == "pro_jung03" || $co_id == "pro_tuk01" || $co_id == "pro_tuk02" || $co_id == "pro_tuk03" || $co_id == "pro_tuk04" || $co_id == "pro_tuk05" || $co_id == "pro_tuk06" || $co_id == "pro_tuk07"  || $co_id == "pro_tuk08" || $co_id == "pro_tuk09" || $co_id == "pro_tuk10" || $co_id == "pro_tuk11"){ // 특화사업 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung03">찾아가는 전문직업인 체험 </a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk03">진로캠프</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk04">마을협력 청소년 진로체험</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk05">양산 역사문화탐방 진로체험 『인문학 진로기행』</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk08">양산 사랑 공모전 『꿈꾸다, 양산 愛』</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk07">4차산업 기술 활용 교육 『AI 아는 아이』</a></li>	
						  <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk10">기후위기대응캠프 『I am 그린리더』</a></li>	
						  <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk09">창업체험동아리 『창업 챌린저』</a></li>		
						  <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk11">문화예술 진로교육</a></li>						  
						  <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk01">진로상담 『한걸음』</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk06">진로·진학 멘토링 『수시AllKill』</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk02">양산 진로·진학 체험전 「길」</a></li>
						  
						  
                        <? } else if ($co_id == "pro_rang01" || $co_id == "pro_rang02" || $co_id == "pro_rang03" || $co_id == "pro_rang04" ){ // 교육사업 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang04">학부모 진로코칭 지도사 연수</a></li>
						  <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang01">직로교원연수</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang02">진로체험 멘토단 연수</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang03">직원연수</a></li>
						  
                        <? } else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program08" || $bo_table == "program" || $bo_table == "apply") { // 프로그램 예약?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program08">상담 프로그램 안내</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel">상담예약</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify">상담예약확인</a></li>
						  <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=program">프로그램신청</a></li>
						  <li><a href="<?php echo G5_BBS_URL; ?>/apply.search.php?bo_table=apply">프로그램 신청확인</a></li>
						  
						  
                         <? } else if ($co_id == "job" || $bo_table == "exp" || $co_id == "maching"){ // 꿈길 직업체험처 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=exp&page=">꿈길 체험처</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=maching">진로직업체험</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=job">신청방법 </a></li>
                        <? } else if ($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy" || $bo_table == "calendar" || $bo_table == "push"){ // 정보마당 ?>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=noticee">공지사항</a></li>

						  <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=calendar">월간계획</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=referencee">자료실</a></li>
                          <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=galleryy">포토뉴스</a></li>
						  <li><a href="<?php echo G5_BBS_URL; ?>/write.php?bo_table=push">행사문자알림</a></li>

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





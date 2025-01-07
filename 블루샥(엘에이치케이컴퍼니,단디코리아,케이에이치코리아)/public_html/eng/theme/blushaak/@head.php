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

   <!--토글메뉴-->
   <nav class="menu"> 
      <!-- Menu icon -->
      <div class="menu_header">
         <img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png" style="width:120px" class="hidden-xs">
         <div class="icon-close btn"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_close.png" style="vertical-align:middle; height:27px"></div>
      </div>
      <!-- Menu -->
  
     <!--검색area-->
     <div class="search_field b_margin20">
     <fieldset id="hd_sch">
       <legend>사이트 내 전체검색</legend>
		<form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어<strong class="sound_only">필수</strong></label>
				<input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력해주세요."/>
				<input type="submit" value="" />
		 </form>
         
                    <script>
                    function fsearchbox_submit(f)
                    {
                        if (f.stx.value.length < 2) {
                            alert("검색어는 두글자 이상 입력하십시오.");
                            f.stx.select();
                            f.stx.focus();
                            return false;
                        }
        
                        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                        var cnt = 0;
                        for (var i=0; i<f.stx.value.length; i++) {
                            if (f.stx.value.charAt(i) == ' ')
                                cnt++;
                        }
        
                        if (cnt > 1) {
                            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                            f.stx.select();
                            f.stx.focus();
                            return false;
                        }
        
                        return true;
                    }
                    </script>
        </fieldset>
	 </div>
    <!--//검색area-->
  
  
      <ul>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="icon-close" data-transition="slide">회사소개<span>About company</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="icon-close" data-transition="slide">포트폴리오<span>Portfolio</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=price" class="icon-close" data-transition="slide">제작가격<span>Price</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="icon-close" data-transition="slide">견적문의<span>Online Request</span></a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company" class="icon-close" data-transition="slide">공지&이벤트<span>Notice & Event</span></a></li>
      </ul>
      
   </nav>
   <!--//토글메뉴-->

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
    
    
        <!--pc버전-->
        <div class="t_area clearfix hidden-sm hidden-xs">
           <div class="col-md-6 text-left l_padding50"><a href="<?php echo G5_URL ?>" data-transition="slide"><img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png"></a></div>
           <div class="col-md-6 text-right r_padding50 t_cate">
               <ul>
                  <li class="r_padding5"><span style="font-size:1.45em; font-weight:600; color:#fff; line-height:1.0em">제작전문상담 : 051.891.0087&nbsp;<i class="fa fa-phone-square"></i><br />수정관련상담 : 051-891-0088&nbsp;<i class="fa fa-phone-square "></i></span></li>
                  <li class="icon-menu"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_search.png" style="vertical-align:middle; height:27px; cursor:pointer" alt="검색 버튼"></li>
                  <li class="icon-menu"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_bars.png" style="vertical-align:middle; height:27px; cursor:pointer" alt="카테고리 버튼"></li>
              </ul>
           </div>
        </div>
        <!--//pc버전-->
        
        <!--mobile버전-->
        <div class="t_area clearfix visible-sm visible-xs">
           <div class="col-xs-6 text-left l_padding20"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png"  style="width:100px"></a></div>
           <div class="col-xs-6 text-right r_padding20 t_cate">
               <ul>
                  <li class="icon-menu"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_search.png" style="vertical-align:middle; height:27px; cursor:pointer" alt="검색 버튼"></li>
                  <li class="icon-menu"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_bars.png" style="vertical-align:middle; height:27px; cursor:pointer" alt="카테고리 버튼"></li>
              </ul>
           </div>
        </div>
        <!--//mobile버전-->
   
    
    </div><!--#hd_wrapper-->

    
<script>
var main = function() {
  
$('.icon-menu').click(function() {
   $('.menu').animate({
    right: "0%"
   }, 200);

$('body').animate({
    left: "-50%"
  }, 400);
 });

/* Then push them back */
$('.icon-close').click(function() {
   $('.menu').animate({
    right: "-50%"
   }, 100);

  $('body').animate({
    left: "0px"
  }, 100);
  });
};
$(document).ready(main);
</script>  
    
    
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <div id="svisual" style="background:url(<?php echo G5_THEME_IMG_URL?>/main/main.jpg) no-repeat center top;"></div>
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
		       <? } ?> 

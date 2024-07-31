<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
/*if($member[mb_id]==""){
	goto_url(G5_BBS_URL."/login.php");
}*/
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
            <!--<a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/m_logo.png" alt="<?php echo $config['cf_title']; ?>"></a>-->
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
		<?php /*?><div class="home"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/top_home.png" /></a></div><?php */?>
		<div class="home"><a href="<?=str_replace("/eng","",G5_URL)?><?if($is_member) echo '/index.php?flg_id='.$member['mb_id'].'&flg_no='.$member['mb_no'];?>"><img src="<?php echo G5_THEME_IMG_URL ?>/lang.gif" /><p>KOR</p></a></div>
        <?php if($is_member){ ?><div class="tn nav_open"><span></span><span></span><span></span></div><?php } ?>
          <div id="mask" style="display:none"></div>
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/icon_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></div>
                      <!--메뉴시작-->
                      <div id="accordion-example" data-collapse="accordion">
                        <div id="gnb" class="hd_div">
                                <ul id="gnb_1dul">
                                	<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=carte_eng&is_day=1" class="gnb_1da">Daily Menu</a></li>
                                	<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=carte_eng" class="gnb_1da">Weekly Menu</a></li>
                                	<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL ?>/survey.php" class="gnb_1da">Survey</a></li>
                                	<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna_eng" class="gnb_1da">Leave comments</a></li>
                                	<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice_eng" class="gnb_1da">Cafeteria News</a></li>
                                    <? if($member['mb_level']=="10"){ ?>
                                    <li class="gnb_1dli">
                                        <a href="<?=G5_ADMIN_URL?>/" target="_self" class="gnb_1da">Administrator access</a>
                                    </li>
                                    <? } ?>
                                </ul>

                                <!--관리자로그인 버튼-->
                                <!--<div id="login">
									<?php if ($is_member) { ?>
                                    <?php if ($is_admin) { ?>
                                    <a href="<?php echo G5_ADMIN_URL ?>" class="admin">관리자</a>
                                    <?php } ?>
                                    <a href="<?php echo G5_BBS_URL ?>/logout.php" class="ad_login">로그아웃</a>
                                    <?php } else { ?>
                                    <a href="<?php echo G5_BBS_URL ?>/login.php" class="ad_login">관리자로그인</a>
                                    <?php } ?>
                                </div>--><!--#login-->
                            </div><!--#gnb-->
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
		nav.animate({width:"80%",right:"0" }, 200);
		$('.inner').animate({left:"0"}, 500);
	});
	$('.nav_close, #mask').click(function(){
		var nav =  $('#navtoggle');
		$('#mask').css('display','none');
		$('.inner').animate({left:"0"}, 000);
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

    <!--<p class="top_txt"><img src="<?php echo G5_THEME_IMG_URL ?>/top_txt.png" /></p>-->
</header>

<!--//header-->
<div id="wrapper">
<? if(defined('_INDEX_')) {?>  <!--index에 나오지않고-->
   <div style="display:none"></div>
<? }else if($bo_table == "" || $co_id == ""){ ?><!-- 내용/게시판에 나와라-->
    <div id="container">
        <!--서브타이틀-->
    	<div id="container_title"><?php echo $g5['title'] ?></div>
        <div id="scont">
<?php } ?>


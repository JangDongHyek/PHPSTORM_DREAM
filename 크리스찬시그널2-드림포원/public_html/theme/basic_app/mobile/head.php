<?php
//// PC접근불가
//if (!isMobilePage()) {
//    include_once(G5_THEME_PATH.'/head.sub.php');
//    echo "<div style='padding: 50px 0; font-size: 2em; text-align: center;'>PC접근이 불가능합니다.</div>";
//    include_once(G5_THEME_PATH.'/tail.sub.php');
//    exit;
//}

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
$navMenuArr=array(
					"greet01"=>"cate_list01","greet02"=>"cate_list02","greet03"=>"cate_list03",
					"greet04"=>"cate_list04","greet05"=>"cate_list05","greet06"=>"cate_list06",
					"greet07"=>"cate_list07","greet08"=>"cate_list08","greet09"=>"cate_list09"
				 );


if ($member["mb_popup_chk"] == "N" && $member["mb_approval"] == "Y"){
    $sql = "update g5_member set mb_popup_chk = 'Y' where mb_id = '{$member["mb_id"]}' ";
    sql_query($sql);

    alert("무분별한 정보변경으로 인해 모든정보는 (1~6번까지의 섹션)\\n관리자의 관리하에 변경됨을 안내드립니다.\\n양해부탁드립니다.",G5_URL);

}
?>
<?php
	if(0 < strpos($co_id,"reet")){?>
<script type="text/javascript">
	$(function(){
		$(".cate_list a").removeClass("active");
		$(".cate_list #<?=$navMenuArr[$co_id]?> a").addClass("active");
		$(".amenu").each(function(){
			if($(this).hasClass("active")){
				
				var offset = $(this).offset().left;
				
				$(".cate_list").scrollLeft(offset-($(window).width()/2)+100);
			}
		});
	});
</script>
<? }?>

<script>
    $(function() {
        if(!'<?=$private?>') { // 드림포원 외
            // 개발자도구(f12) 방지
            $(document).bind('keydown',function(e) {
                if ( e.keyCode == 123 /* F12 */) {
                    e.preventDefault(); e.returnValue = false;
                }
            });

            // 우클릭 방지
            $(document).on("contextmenu",function(e) {
                return false;
            });
        }
    });
</script>

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

<?php if(defined('_INDEX_')||0 < strpos($co_id,"reet")) { ?>
    <div id="hd_wrapper" class="main">
        <div id="logo"><a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.png" title="크리스찬시그널"/></a></div>
        <div id="nav_open">
        
<!--        	<a class="cart" href="--><?php //echo G5_BBS_URL ?><!--/user_cart.php"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/app/ic_cart_color.png"></a>-->
<!--        	<a class="bell" onclick="alert('준비중입니다.')"><img src="<?php echo G5_THEME_IMG_URL ?>/app/ic_bell.svg"></a>-->
<!--
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                <span></span><span></span><span></span>
            </a>
-->
        </div><!--#nav_open-->
    </div><!--hd_wrapper-->
    
    
    <!--카테고리메뉴부분-->
    <div id="nav_wrap" class="nav_cate">
        <div class="left-blur"></div>
        <div class="right-blur"></div>
        <div class="cate_list">
            <div id="cate_list01" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01" class="amenu">크리스찬 시그널이어야만 하는 이유</a>
            </div>
            <div id="cate_list02" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02" class="amenu">협력사</a>
            </div>
            <div id="cate_list03" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet03" class="amenu">크리스찬 시그널 가이드</a>
            </div>
            <div id="cate_list04" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet04" class="amenu">크리스찬 시그널의 슬로건</a>
            </div>
            <div id="cate_list05" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet05" class="amenu">크리스찬 시그널 인사말</a>
            </div>
            <div id="cate_list06" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet06" class="amenu">나만의 프로필 작성해보기</a>
            </div>
            <div id="cate_list07" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07" class="amenu">운영목적</a>
            </div>
            <div id="cate_list08" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet08" class="amenu">크리스찬의 특혜</a>
            </div>
            <div id="cate_list09" class="menu">
                <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet09" class="amenu">크리스찬 시그널의 비전</a>
            </div>
        </div>
    </div><!--nav-wrap-->
    <!--카테고리메뉴부분-->
<?php } else { ?>
    <div id="hd_wrapper">
        <div id="hd_back">
            <?php if(basename($_SERVER["PHP_SELF"]) != 'register_result.php' && basename($_SERVER['PHP_SELF']) != 'my_profile_end.php') { ?>
            <a href="javascript:history.back();">
            <i class="far fa-chevron-left"></i><span class="sound_only">뒤로</span>
            </a>
            <?php } ?>
        </div><!--#nav_open-->
        <div id="title"><?php echo $g5['title'] ?></div>
        <?php if(basename($_SERVER["PHP_SELF"]) != 'register.php' && basename($_SERVER["PHP_SELF"]) != 'register_form.php' && basename($_SERVER["PHP_SELF"]) != 'register_result.php'
            && basename($_SERVER["PHP_SELF"]) != 'my_profile01.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile02.php' && basename($_SERVER["PHP_SELF"]) != 'my_profile03.php'
            && basename($_SERVER["PHP_SELF"]) != 'my_profile_end.php') { ?>
<!--            <div id="my_p"><a href="<?php echo G5_BBS_URL ?>/mypage.php"><i class="far fa-user"></i></a></div>-->
        	<a id="cart" href="<?php echo G5_BBS_URL ?>/user_cart.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/ic_cart.png"></a>

        <?php } ?>
    </div><!--hd_wrapper-->
<?php } ?>


</header><!--hd-->

<div id="wrapper">
	<? if(defined('_INDEX_')) {?>
        <div id="idx_container">
	<? }else { ?>
    <!--서브메뉴-->
    <?php 
                    
        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)		
        echo submenu($sm_tid, 'basic', G5_THEME_MOBILE_PATH); 
    ?>
        <div id="container">
    <?php } ?>

<script>
    $(document).ready(function () {
        // str = "무료"
        // if ($(".bold").text() != "관리자") {
        //     $(".bold").text(str);
        // }
        // $($(".point")[1]).text(str);
    });
</script>
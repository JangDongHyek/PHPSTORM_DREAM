<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_pjax){
	include_once(G5_THEME_PATH.'/head.sub.php');
	include_once(G5_LIB_PATH.'/latest.lib.php');
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
	include_once(G5_LIB_PATH.'/poll.lib.php');
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	include_once(G5_LIB_PATH.'/popular.lib.php');

	if(defined('_INDEX_')) { // index에서만 실행
		include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
	}
}

// 현재위치 (테스트로 IS타워)
if(!$_GET['currentLat']){
	$currentLat = "35.17664375415083";
	$currentLng = "129.125410468606";
}

?>
<!--상단 메뉴부분 시작-->
<div id="header">
    <h1 class="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/app/logo-x.jpg" alt="<?php echo $config['cf_title']; ?>"/></a></h1>
	<?php/* if($is_member){ ?>
	<div id="my_csgold">
		<dl>
		  <dd><span style="color:#fba638">S포인트</span><?php echo number_format($member['mb_point'])?>P</dd>
		  <dd>
			<span style="color:#2b8fd5">L포인트</span><?php echo number_format($member['mb_point_l'])?>P
		  </dd>
			<?php		  
				$sql="select sum(point) as point from g5_movie_view_point where mb_id='$member[mb_id]'";
				$mRow=sql_fetch($sql);
			?>
		  <dd>
			<span style="color:#2b8fd5">동영상포인트</span><?php echo number_format($mRow['point'])?>P
		  </dd>
		</dl>
	</div>
	<?php }*/ ?>

        <div id="link_share">
            <a id="btnShare" href="#"><i class="fad fa-clipboard-list"></i>링크공유하기</a>
        </div>

    <?php if(!isRegisterPetition($member['mb_id'])): ?>
        <!--청원서 미등록시, 버튼보이도록-->
        <div id="my_petition">
            <a href="<?php echo G5_BBS_URL ?>/petition.php"><i class="fad fa-clipboard-list"></i> 청원서 등록</a>
        </div>
        <!--//청원서 미등록시, 버튼보이도록-->
    <?php endif; ?>

    <div class="btnMenu">
		<?php if($wr_id){ ?>
		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table;?>" style="color:#FFF; padding-top:7px;">
			<i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
		</a>
		<?php }else if(!$is_member){ ?>
		<a href="<?php echo G5_URL;?>" style="color:#FFF; padding-top:7px;">
			<i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
		</a>
		<?php }else{ ?>
		<a href="<?php echo G5_BBS_URL ?>/logout.php">
			<img src="<?php echo G5_THEME_IMG_URL ?>/app/hd_wing_menu.png" alt="메뉴열기"/><span class="sound_only">열기</span>
		</a>
		<?php } ?>
    </div>
    <div id="gnb2">
        <ul>
            <li><a <?php if(strpos(SCRIPT_NAME, "board.php")) echo 'class="on"';?> href="<?php echo G5_BBS_URL;?>/board.php?bo_table=youtube">동영상</a></li>
			<li><a <?php if(strpos(SCRIPT_NAME, "mypayment.php")) echo 'class="on"';?> href="<?php echo G5_BBS_URL;?>/mypayment.php">결제</a></li>
            <li><a <?php if(strpos(SCRIPT_NAME, "mywallet.php")) echo 'class="on"';?> href="<?php echo G5_BBS_URL;?>/mywallet.php">충전</a></li>
            <li><a <?php if(strpos(SCRIPT_NAME, "mychange.php")) echo 'class="on"';?> href="<?php echo G5_BBS_URL;?>/mychange.php">환전</a></li>
            <li><a <?php if(strpos(SCRIPT_NAME, "stock_change.php")) echo 'class="on"';?> href="<?php echo G5_BBS_URL;?>/stock_change.php">주식</a></li>
            <li><a href="<?php echo G5_URL;?>/shop/">쇼핑몰</a></li>
            <li><a href="<?php echo G5_BBS_URL;?>/lotto.game.php">게임</a></li>
			<li><a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=notice">공지</a></li>
        </ul>
    </div>
</div>
<div id="search_icon">
	<dl>
		<img id="search_icons" src="<?php echo G5_THEME_IMG_URL ?>/mobile/search.png">
	</dl>
</div>
<div id="search_txt">
	<form name="fsearch" method="get" action="<?php echo G5_BBS_URL;?>/board.php?bo_table=<?php echo $bo_table?$bo_table:"business";?>">
	<input type="hidden" name="bo_table" value="<?php echo $bo_table?$bo_table:"business" ?>">
	<input type="hidden" name="sca" value="<?php echo $sca ?>">
	<input type="hidden" name="ca_code" id="ca_code" value="<?php echo $ca_code ?>">
	<input type="hidden" name="sop" value="and">
	<input type="hidden" name="sfl" value="wr_subject">
	<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
	<dl class="row">
		<dd class="col-xs-11" style="padding:0;">
			<input type="text" name="stx" id="stx" value="<?php echo stripslashes($stx) ?>" class="search-btn" maxlength="20">
		</dd>
		<dd class="col-xs-1 text-right" style="padding:0;">
			<img src="<?php echo G5_THEME_IMG_URL ?>/mobile/search.png" onclick="document.fsearch.submit()">
		</dd>
	</dl>
	</form>
</div>
<!--상단 메뉴부분 끝-->
<script>
$("#search_icons").click(function (){
	var hd = $("#search_txt").hasClass("search_on");
	if(!hd){
		$("#search_txt").css("display", "");
		$(this).attr("src", "<?php echo G5_THEME_IMG_URL ?>/mobile/menu_close.png");
		$("#search_txt").addClass("search_on");
	}else{
		$(this).attr("src", "<?php echo G5_THEME_IMG_URL ?>/mobile/search.png");
		$("#search_txt").removeClass("search_on");
	}
});

var btnShare = document.getElementById("btnShare");
btnShare.addEventListener("click", function(){

    var shareTitle = "케나프";
    var shareText = '농업회사법인 친환경세상 주식회사';
    var contentURL = "/~canadaw3/";
    var URLPreFix = "";
    let rcmmid = '<?= $member['mb_id'] ?>'; //현재 로그인해 있는 유저의 아이디를 추천 아이디로

    URLPreFix = URLPreFix + "//" + location.host;

    //var shareURL = URLPreFix + contentURL;
    var shareURL = 'https://itforone.co.kr/~canadaw3/bbs/register_form.php?rcmmid=' + rcmmid;

    if (navigator.share){
        navigator.share({
            title: shareTitle,
            text: shareText,
            url: shareURL,
        })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing', error));
    }else{
        alert("공유하기를 지원하지 않는 환경입니다.");
    }
});
</script>

<? if(defined('_INDEX_')) {?><!--wrapper는 index에서만 실행-->         
<div id="wrapper">
<? } ?> 
	<div id="container" <?php if(!defined('_INDEX_')){ echo "class='sub'"; } ?>> <!--INDEX를 제외한 모든 페이지에는 container.sub 스타일을 실행-->  

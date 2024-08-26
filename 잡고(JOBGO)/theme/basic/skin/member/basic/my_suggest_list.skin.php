<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/epggea.css">', 0);
add_javascript('<script type="text/javascript" src="'.$member_skin_url.'/js/epggea.js"></script>', 100);


?>
<style>
.box-article .box-body .row{ background:#fff}
.tab-content {
	display: none;
	float: left;
	width: 100%;
	padding: 0 0 1em 0;
	background:#fff;
}
.lt_box p.fee,
.lt_box p.date{display:block}
.lt_box p.date span{display:none}
.sugVer header p.tot_price span.account {margin-left:0;background:#8bc34a}
.sugVer header p.tot_price span.account a{background:#8bc34a}
.sugVer header p.tot_price{text-align:right;margin-top:-63px}
</style>


<!--마이페이지-->

<article id="mypage"  class="sugVer">


    <?php include_once($member_skin_path.'/mypage_left_menu.php'); ?>
	<div id="right_view">
		
	     <h3>추천가입 목록<span> 전체 추천인 <?=$cnt?></span></h3>
        <?php if ($mobile){ ?>
		 <header>
			<p class="tot_price"><span class="account"><a href="javascript:callApp_share()">추천링크 공유하기</a></span></p>
		</header>
        <?php } ?>
		<ul class="manage_list">
			<li class="fl tc w10 title t_line ">No.</li>
			<li class="fl tc w30 title t_line">아이디</li>
			<li class="fl tc w30 title t_line">이름</li>
			<li class="fl tc w30 title t_line">가입일</li>
		</ul>
        <?
        if($cnt > 0){
        for ($i = 0; $row = sql_fetch_array($re_result); $i++) {
        ?>
        <ul class="lt_box">
			<li class="fl tc w10 lt lt_line ordernum"><?=$i+1?></li>
			<li class="fl tc w30 lt lt_line"><p class="fee"><?=$row['mb_id']?></p></li>
			<li class="fl tc w30 lt lt_line"><?=$row['mb_name']?></li>
			<li class="fl tc w30 lt lt_line"><p class="date"><span>가입일 </span><?=date('Y.m.d',strtotime($row['mb_datetime']))?></p></li>
		</ul>
        <?php }
        }else{ ?>
        <div class="nonelist">추천 가입인이 없습니다.</div>
        <?php }?>

	</div>


</article>

<script>
    function callApp_share() {

        $.ajax({
            url: g5_bbs_url + "/ajax.controller.php",
            method : 'post',
            data: {mode : 'app_share'},
            success: function(result) {
                if (result) {
                    arg1 = "잡고 공유하기 "
                    arg2 = "회원가입링크: (" + g5_bbs_url + "/register_form.php?r_code="+result+")"
                    arg3 = "공유하기"
                    <?php if(0 < strpos($_SERVER['HTTP_USER_AGENT'],"IOSJobgo")){?>

                    webkit.messageHandlers.shareHandler.postMessage("잡고 공유하기\n회원가입링크:("+g5_bbs_url + "/register_form.php?code="+result+")");
                    <?php }else{?>
                    window.Android.doShare(arg1, arg2, arg3);
                    <? }?>
                }
            }
        });

    }
</script>
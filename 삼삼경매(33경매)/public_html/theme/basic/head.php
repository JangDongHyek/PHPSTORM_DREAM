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

<!--우측 고정 배너-->
<div class="fix_right">
    <ul>
        <li>
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right"><i class="far fa-bars"></i></a>
        </li>
        <li>
            <a href="" class="kakao_ch">
            <img src="<?php echo G5_THEME_IMG_URL ?>/common/kakao_ch.svg" alt="">
            </a>
        </li>
        <li>
            <a href="#hd" class="topHd">
                <i class="far fa-chevron-up"></i>
                <p>TOP</p>
            </a>
        </li>
    </ul>
</div>


<!-- 상단 시작 { -->
<div id="hd" <?php if ($co_id == "class"){ echo "class='hd_class'"; } ?>>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
    <div id="hd_top">
        <div class="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.svg" alt="<?php echo $config['cf_title']; ?>" class="logo_color">
                <img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_white.svg" alt="<?php echo $config['cf_title']; ?>" class="logo_black"></a>
        </div>
        
        <div class="menu_wrap_r">
			<div id="hd_wrapper">
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
							<a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
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
			<div class="tmenu">
				<ul>
                    <?php if ($is_member) { ?>

                        <li><a href="<?php echo G5_BBS_URL ?>/logout.php" class="ic_sns"><i class="fa-regular fa-lock-keyhole-open"></i></a></li>

                        <?php if ($is_admin) { ?>
                            <li><a href="<?php echo G5_ADMIN_URL ?>/request_list.php" target="_blank" class="ic_sns"><i class="fa-light fa-gear"></i></a></li>
                        <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" class="ic_sns"><i class="fa-light fa-user"></i></a></li>
                        <?php } ?>

                    <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/login.php" class="ic_sns"><i class="fa-regular fa-lock-keyhole"></i></a></li>
                        <!--<li><a href="<?php /*echo G5_BBS_URL */?>/register.php" class="ic_sns"><i class="fa-light fa-user"></i></a></li>-->
                    <?php } ?>
					<li>
						<a id="hd_sch_open" class="hd_opener ic_sns"><i class="fa-regular fa-magnifying-glass"></i></a>
                        <div id="hd_sch" class="hd_div">
                            <div class="hd_sch_inr">
                                <h2>사이트 내 전체검색</h2>
                                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                                    <input type="hidden" name="sfl" value="wr_subject||wr_content">
                                    <input type="hidden" name="sop" value="and">
                                    <input type="text" name="stx" id="sch_stx" placeholder="검색어(필수)" required class="required" maxlength="20">
                                    <button type="submit" id="sch_submit"><i class="fa-regular fa-magnifying-glass"></i></button>
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

                                        // Close the search box
                                        document.getElementById('hd_sch').style.display = 'none';
                                        $(".hd_opener").find("span").text("열기");

                                        return true;
                                    }
                                </script>
                            </div>
                            <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색 </span><i class="fa-light fa-xmark"></i></button>
                        </div>
                        <script>
                            $(function () {
                                $(".hd_opener").on("click", function() {
                                    var $this = $(this);
                                    var $hd_layer = $this.next(".hd_div");

                                    if($hd_layer.is(":visible")) {
                                        $hd_layer.hide();
                                        $this.find("span").text("열기");
                                    } else {
                                        var $hd_layer2 = $(".hd_div:visible");
                                        $hd_layer2.prev(".hd_opener").find("span").text("열기");
                                        $hd_layer2.hide();

                                        $hd_layer.show();
                                        $this.find("span").text("닫기");
                                    }
                                });

                                $(".hd_closer").on("click", function() {
                                    var idx = $(".hd_closer").index($(this));
                                    $(".hd_div:visible").hide();
                                    $(".hd_opener:eq("+idx+")").find("span").text("열기");
                                });
                            });
                        </script>
                    </li>
				</ul>
			</div>
        </div>
    </div>
</div>
<!-- } 상단 끝 -->


    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>



<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) { ?>
	<!--메인컨테이너 부분-->
    <div id="container_index">      
    <!--서브컨테이너 부분-->

    <? } else if ($co_id == "class") {  ?>
        <div id="container">
            <div class="inner">
                <!--메뉴로케이션-->
                <?php

                if(!$is_register || $w){
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid)
                        echo submenu($sm_tid, 'location', G5_THEME_PATH);
                }
                ?>

                <!-- 서브 게시판 및 내용관리 부분 -->

	<? } else {  ?>
        <!--서브 상단 비주얼-->
        <div id="svisual" <?php if($co_id == "company" || $co_id == "service" || $co_id == "map" ){ echo "class='s1'"; }
        //else if ($co_id == "class"){ echo "class='s3'"; }
        else if ($bo_table == "qna"){ echo "class='s4'"; }
        else if ($bo_table == "notice" || $bo_table == "news"  || $bo_table == "faq"){ echo "class='s5'"; }
        else if ($co_id == "recruit"){ echo "class='s2'";}?>>
            <div class="s_text">
                <div class="container_title">
                    <h2 class="wow fadeInLeft">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                    </h2>
                </div>
                <h6 class="wow fadeInRight animated slogan" data-wow-delay="0.1s" data-wow-duration="1.2s">
                    담보물채권 / 경매의 새로운 가치 투자 <strong class="color_blue">33경매</strong>
                </h6>
            </div><!--.s_text-->
            <div class="lnb">
                <div>
                </div>
                <!--서브메뉴-->
                <?php

                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;

                if($sm_tid)
                    echo submenu($sm_tid, 'basic', G5_THEME_PATH);
                ?>
            </div>
        </div><!--svisual-->
		<div id="container">
            <div class="inner">
            <!--메뉴로케이션-->
            <?php

            if(!$is_register || $w){
                if(!$sm_tid)	$sm_tid = $co_id;
                if(!$sm_tid)	$sm_tid = $bo_table;
                if($sm_tid)
                    echo submenu($sm_tid, 'location', G5_THEME_PATH);
            }
            ?>

			<!-- 서브 게시판 및 내용관리 부분 -->
	<? } ?>


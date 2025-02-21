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


<!-- 퀵메뉴 -->
<div class="quick">
    <dl class="cus">
        <dd class="tel"><a href="https://join.skype.com/invite/x1YfwtTRdnpy?source=qr-ios" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"    viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-skype"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a9 9 0 0 1 8.603 11.65a4.5 4.5 0 0 1 -5.953 5.953a9 9 0 0 1 -11.253 -11.253a4.5 4.5 0 0 1 5.953 -5.954a8.987 8.987 0 0 1 2.65 -.396z" /><path d="M8 14.5c.5 2 2.358 2.5 4 2.5c2.905 0 4 -1.187 4 -2.5c0 -1.503 -1.927 -2.5 -4 -2.5s-4 -1 -4 -2.5c0 -1.313 1.095 -2.5 4 -2.5c1.642 0 3.5 .5 4 2.5" /></svg><strong>051-505-7477</strong></a></dd>
    </dl>
    <dl class="cus">
        <dd class="tel"><a href="https://u.wechat.com/kJhwsl-jmAv81Tl3H5kxq1w" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"    viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-wechat"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.5 10c3.038 0 5.5 2.015 5.5 4.5c0 1.397 -.778 2.645 -2 3.47l0 2.03l-1.964 -1.178a6.649 6.649 0 0 1 -1.536 .178c-3.038 0 -5.5 -2.015 -5.5 -4.5s2.462 -4.5 5.5 -4.5z" /><path d="M11.197 15.698c-.69 .196 -1.43 .302 -2.197 .302a8.008 8.008 0 0 1 -2.612 -.432l-2.388 1.432v-2.801c-1.237 -1.082 -2 -2.564 -2 -4.199c0 -3.314 3.134 -6 7 -6c3.782 0 6.863 2.57 7 5.785l0 .233" /><path d="M10 8h.01" /><path d="M7 8h.01" /><path d="M15 14h.01" /><path d="M18 14h.01" /></svg><strong>010-7114-8505</strong></a></dd>
    </dl>
    <dl class="cus">
        <dd class="tel"><a href="tel:051-758-9305"><svg xmlns="http://www.w3.org/2000/svg"  width="28"  height="28"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg><strong></strong></a></dd>
    </dl>
    <dl class="kakao_contact">
        <dd>
            <a href="http://qr.kakao.com/talk/ycgiYpa7QVvwnjIwvI3OQJ560WU-" target="_blank">
                <i><img src="https://itforone.com:443/~ljcheol2/theme/basic/img/common/ic_kakao.svg"></i><strong>톡상담</strong>
            </a>
        </dd>
    </dl>
    <!--<dl class="cus">
        <dd class="mail"><a href="mailto:wk7114@naver.com"><i class="fas fa-envelope"></i><strong>wk7114@naver.com　</strong></a></dd>
    </dl>-->
    <dl class="cus">
        <dd><a href="#hd" class="goHd"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 15l6 -6l6 6" /></svg><strong>wk7114@naver.com　</strong></a></dd>
    </dl>
</div>
<!-- 퀵메뉴 끝 -->



<?php/*
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
        <div id="logo">
            <a class="white" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
            <a class="color" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->

		<div class="s_search">
		<a id="hd_sch_open" class="hd_opener" title="제품검색"><i class="far fa-search"></i></a>
                        <div id="hd_sch" class="hd_div">
                            <div class="hd_sch_inr">
                                <h2>빠른 제품 화학 물질 검색</h2>
                                <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                                    <input type="hidden" name="sfl" value="wr_subject||wr_content">
                                    <input type="hidden" name="sop" value="and">
                                    <input type="text" name="stx" id="sch_stx" placeholder="국,영문 화학명,이명,cas no. 를 입력하세요." required class="required" maxlength="20">
                                    <button type="submit" id="sch_submit"><i class="far fa-search"></i></button>
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
                            <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색 </span><i class="far fa-times"></i></button>
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
		</div>
			
        <ul id="tnb">
			<?php if(defined('_INDEX_')) { // index에서만 실행  } ?>
			<?php } else {  ?>
			
			<?php }  ?>
			
            <li><a href="<?php echo G5_URL ?>" class="home" title="홈"><i class="far fa-home"></i></a></li>
<!--            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro_01" title="제품소개"><i class="fas fa-cog"></i></a></li>-->
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <?php }  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i></a></li>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i></a></li>
            <?php }  ?>
            <li>
                <div class="gmenu fs">
                            <dl>
                                 <dt><i class="fal fa-globe"></i> KOR</dt>
                                    <dd>
                                      <a href="">KOR</a>
                                      <a href="javascript:alert('준비중입니다.');" onfocus="this.blur()" style="cursor: pointer">ENG</a>
                                 </dd>
                            </dl>
                     <script>
                      //글로벌 토글 메뉴
                        $(document).ready(function(){
                            $(".fs dt").click(function(){
                                $(".fs dd").slideToggle();
                            });
                            $(".fs dd").click(function(){
                                $(this).hide();
                            });
                        });
                    </script>
                </div>
            </li>
    	</ul>

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
                    <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span class="bar"></span></a>
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
    
    <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php ?>
    <div class="nav_open">
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
            <div>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
    </div>
    <!--모바일메뉴버튼-->
    
    </div><!--#hd_wrapper-->
</div>

*/ ?>
<!-- 상단 시작 { -->
<div id="hd" data-scroll-section>
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
        <div id="logo">
                <a class="color" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_color.png"></a>
                <a class="white" href="<?php echo G5_URL ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png"></a>
        </div><!--#logo-->


        <div class="s_search">
            <a id="hd_sch_open" class="hd_opener" title="제품검색"><i class="far fa-search"></i></a>
            <div id="hd_sch" class="hd_div">
                <div class="hd_sch_inr">
                    <h2>빠른 제품 화학 물질 검색</h2>
                    <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
                        <input type="hidden" name="sfl" value="wr_subject||wr_content">
                        <input type="hidden" name="sop" value="and">
                        <input type="text" name="stx" id="sch_stx" placeholder="국,영문 화학명,이명,cas no. 를 입력하세요." required class="required" maxlength="20">
                        <button type="submit" id="sch_submit"><i class="far fa-search"></i></button>
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
                <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색 </span><i class="fal fa-times"></i></button>
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
        </div><!--//s_search-->


        <ul id="tnb">
            <?php if(defined('_INDEX_')) { // index에서만 실행  } ?>
            <?php } else {  ?>

            <?php }  ?>

            <li><a href="<?php echo G5_URL ?>" class="home" title="홈"><i class="far fa-home"></i></a></li>
            <!--            <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro_01" title="제품소개"><i class="fas fa-cog"></i></a></li>-->
            <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php" title="로그아웃"><i class="fas fa-unlock-alt"></i></a></li>
            <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인"><i class="fas fa-lock-alt"></i></a></li>
            <?php }  ?>
            <li>
                <div class="gmenu fs">
                    <dl>
                        <dt><i class="fal fa-globe"></i> KOR</dt>
                        <dd>
                            <a href="">KOR</a>
                            <a href="javascript:alert('준비중입니다.');" onfocus="this.blur()" style="cursor: pointer">ENG</a>
                        </dd>
                    </dl>
                    <script>
                        //글로벌 토글 메뉴
                        $(document).ready(function(){
                            $(".fs dt").click(function(){
                                $(".fs dd").slideToggle();
                            });
                            $(".fs dd").click(function(){
                                $(this).hide();
                            });
                        });
                    </script>
                </div>
            </li>
        </ul>


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

        <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>
        <div class="icon-menu">
            <div class='toggle'>
                <span></span>
                <span></span>
            </div>
        </div><!--모바일메뉴버튼-->

        <!--토글메뉴-->
        <nav class="menu">
            <!-- Menu icon -->
            <div class="menu_header">
                <div class="icon-close btn"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_close.png" style="vertical-align:middle; height:27px"></div>
            </div>

            <!--카테고리-->
            <div id="accordion-example" data-collapse="accordion">
                <div class="language">
                    <div><a href="https://dreamforone.co.kr/~efchem_re2/">KOR</a></div>
                    <div><a id="lg_en" href="javascript:void(0)">ENG</a></div>
                </div>
                
                <div id="gnb2">
                    <ul id="mgnb_1dul">
                        <?php
                        $sql = " select *
                                    from {$g5['menu_table']}
                                    where me_mobile_use = '1'
                                      and length(me_code) = '2'
                                    order by me_order, me_id ";
                        $result = sql_query($sql, false);

                        for($i=0; $row=sql_fetch_array($result); $i++) {
                            $sql2 = " select *
										from {$g5['menu_table']}
										where me_mobile_use = '1'
										  and length(me_code) = '4'
										  and substring(me_code, 1, 2) = '{$row['me_code']}'
										order by me_order, me_id ";
                            $result2 = sql_query($sql2);
                            $count=sql_num_rows($result2);

                            ?>
                            <li class="mgnb_1dli">
                            <a class="mgnb_1da" onclick="<?php echo $count==0?"location.href='{$row[me_link]}';":"";?>"><?php echo $row['me_name'] ?><i class="fas fa-angle-down"></i></a>

                            <!--1차메뉴-->
                            <?php

                            if(0<$count){
                                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                                    if($k == 0)
                                        echo '<ul class="mgnb_2dul">'.PHP_EOL;
                                    ?>
                                    <li class="mgnb_2dli"><a href="<?php echo 0<strpos($row2['me_link'],"ttp")?"":G5_URL;?><?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                                    <?php
                                }

                                if($k > 0)
                                    echo '</ul>'.PHP_EOL;
                            }
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

            <script>
                $(document).ready(function() {
                    // 모바일 트리메뉴 .gnb .d1 h3를 클릭
                    $(".mgnb_1dli .mgnb_1da").click(function(){
                        var dp = $(this).siblings("ul.mgnb_2dul").css("display");
                        if(dp=="none"){
                            $(".mgnb_1dli .mgnb_1da").removeClass("on");
                            $(this).addClass("on");
                            $(".mgnb_1dli ul.mgnb_2dul").slideUp(500);
                            $(this).siblings("ul.mgnb_2dul").slideDown(500);
                        }
                        if(dp=="block"){
                            $(".mgnb_1dli .mgnb_1da").removeClass("on");
                            $(".mgnb_1dli ul.mgnb_2dul").slideUp(500);
                        }
                        return false;
                    });
                });
            </script>

            <!--카피라이트-->
            <!--<div class="menu_add t_margin30">
                <h3>Add.</h3>
                <?php echo $config['cf_1']; ?>
                <p class="copyright">COPYRIGHTⓒ2018 <?php echo $config['cf_title']; ?>. ALL RIGHTS RESERVED.</p>
            </div>-->

        </nav>
        <!--//토글메뉴-->
    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->

<script>
    $('.icon-menu').click(function() {
        $('.menu').animate({
            right: "0%"
        }, 700);

        $('body').animate({
            left: "-100%"
        }, 700);
    });

    /* Then push them back */
    $('.icon-close').click(function() {
        $('.menu').animate({
            right: "-100%"
        }, 600);

        $('body').animate({
            left: "0px"
        }, 600);
    });



    /* ENG클릭시 준비중 alert */
    $('#lg_en').click(function() {
        alert('준비중입니다.');
    });


</script>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">       
	 <!--서브컨테이너 부분-->
	 <? }else if($bo_table == "" || $co_id == ""){ ?>	
	 <!--서브상단비주얼-->
     <? if($co_id == "greet01" || $co_id == "greet02" || $co_id == "greet03" || $co_id == "greet03" || $co_id == "greet04") {  ?>
	 <div class="svisual sv01">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">COMPANY</h3>
			<div class="container_title wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="1.2s">
			  <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			  <?php }else { ?>
					<?php echo $g5['title'] ?>
			  <?php } ?> 
            </div>
        </div><!--.s_text-->
     <? } else if ($bo_table == "pro01" || $bo_table == "pro02" || $bo_table == "pro03" || $bo_table == "pro04") { ?>
     <div class="svisual sv02">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">PRODUCT</h3>
			<div class="container_title wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="1.2s">
			  <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			  <?php }else { ?>
					<?php echo $g5['title'] ?>
			  <?php } ?> 
            </div>
        </div><!--.s_text-->
     <? } else if ($bo_table == "b_news" || $bo_table == "business02") { ?>
     <div class="svisual sv03">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">NOTICE</h3>
			<div class="container_title wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="1.2s">
			  <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			  <?php }else { ?>
					<?php echo $g5['title'] ?>
			  <?php } ?> 
            </div>
        </div><!--.s_text-->
     <? } else if ($bo_table == "qna") { ?>
     <div class="svisual sv04">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">INQUIRY</h3>
			<div class="container_title wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="1.2s">
			  <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			  <?php }else { ?>
					<?php echo $g5['title'] ?>
			  <?php } ?> 
            </div>
        </div><!--.s_text-->
     <? } else if ($bo_table == "b_news") { ?>
     <div class="svisual">
		<div class="s_text">
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">NEWS</h3>
			<div class="container_title wow fadeInLeft animated" data-wow-delay="0.3s" data-wow-duration="1.2s">
			  <?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
			  <?php }else { ?>
					<?php echo $g5['title'] ?>
			  <?php } ?> 
            </div>
        </div><!--.s_text-->
     <? } else  { ?>
     <div class="svisual">
		<div class="s_text">
        	<!--<span class="wow fadeInLeft animated" data-wow-delay="0.4s" data-wow-duration="1.2s">해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.
</span>-->
            <h3 class="wow fadeInRight animated" data-wow-delay="0.1s" data-wow-duration="1.2s">EF CHEM</h3>
        </div><!--.s_text-->
     <? } ?>
         <!--서브메뉴-->
         <?php

         if(!$sm_tid)	$sm_tid = $co_id;
         if(!$sm_tid)	$sm_tid = $bo_table;

         if($sm_tid)
             echo submenu($sm_tid, 'basic02', G5_THEME_PATH);
         ?>
         <!--//서브메뉴-->
     </div><!--svisual-->


    
	<div id="container">
        <!--서브비쥬얼-->
		
		
		<? if($bo_table || $co_id){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">


		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
			<div id="scont">
				<!--서브타이틀-->
				<div id="sub_title">
                    <!--메뉴로케이션-->
                    <?php 
            
                        if(!$is_register || $w){ 
                            if(!$sm_tid)	$sm_tid = $co_id;
                            if(!$sm_tid)	$sm_tid = $bo_table;
                            if($sm_tid)		
                            echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                        }
                    ?>
				</div><!--#sub_title-->
				<!--서브타이틀-->
        <? } ?>

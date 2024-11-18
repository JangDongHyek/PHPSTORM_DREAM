<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    echo 1;
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
<div id="wrap">
<div id="hd">
   <!-- <div id="hd_cus">
    	<div class="container">
            <ul>
                <li><a href="tel:15663366"><i class="fa fa-phone"></i> 주문전화<strong>1566-3366</strong></a>&nbsp;</li>
                <?php /*?><li><a href="tel:0260117042"><i class="fa fa-phone"></i> 가맹문의<strong>02)6011-7042</strong></a></li><?php */?>
                <li>매일 새 기름(18L)으로 60마리만! 60계치킨!</li>
            </ul>
        </div>
    </div>-->
	<script language="JavaScript">
    <!--
        //쿠키저장 함수
        function setCookie( name, value, expiredays ) {
            var todayDate = new Date();
            todayDate.setDate( todayDate.getDate() + expiredays );
            document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        }

        $(document).ready(function(){
            $("#promotionBanner .btnClose").click(function(){
                //오늘만 보기 체크박스의 체크 여부를 확인 해서 체크되어 있으면 쿠키를 생성한다.
                if($("#chkday").is(':checked')){
                    setCookie( "topPop", "done" , 1 );
                    //alert("쿠키를 생성하였습니다.");
                }
                //팝업창을 위로 애니메이트 시킨다. 혹은 slideUp()
                //$('#promotionBanner').animate({height: 0}, 500);
                $('#promotionBanner').slideUp(500);
            });
        });

    //-->
    </script>

    <!--
	<div id="promotionBanner">
        <div class="popContents">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event02&wr_id=15"><img src="<?php echo G5_THEME_IMG_URL ?>/main/pop.png" alt="영자언니 따라하면 300만원이 팡팡"></a>
            <div class="popClose">
            <input type="checkbox" value="checkbox" name="chkbox" id="chkday"/><label for="chkday">오늘 하루 그만보기 </label>
            <a href="#none" class="btnClose btn">닫기</a></div>
        </div>
    </div>

	<script language="Javascript">
        //저장된 해당 쿠키가 있으면 창을 안 띄운다 없으면 뛰운다.
        cookiedata = document.cookie;
        if ( cookiedata.indexOf("topPop=done") < 0 ){
            document.all['promotionBanner'].style.display = "block";
		} else {
            document.all['promotionBanner'].style.display = "none";
        }
    </script>
	-->


    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">
        <div class="container">
                <div class="col-xs-3 nav_open">
                    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
                        <i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">열기</span>
                    </a>
                </div><!--모바일메뉴버튼-->
				<div class="tel col-sm-3 hidden-xs">
                	<!--i class="fa fa-phone-square"></i> 1566-3366 -->
                </div>
                <div id="logo" class="col-xs-6">
                    <a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
                </div><!--//logo-->

                <ul id="tnb" class="col-xs-3">
                    <li class="hidden-sm hidden-xs"><a href="<?php echo G5_URL ?>/"><i class="fa fa-home" aria-hidden="true"></i>메인으로</a></li>
                    <?php if ($is_member) {  ?>
                        <?php if ($is_admin) {  ?>
                            <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                        <?php }  ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u"><span class="hidden-sm hidden-xs">회원수정</span><span class="visible-sm visible-xs"><i class="fa fa-user"></i></span></a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><span class="hidden-sm hidden-xs">로그아웃</span><span class="visible-sm visible-xs"><i class="far fa-sign-out"></i></span></a></li>
                    <?php } else {  ?>

                        <li><a href="<?php echo G5_BBS_URL ?>/login.php"><span class="hidden-sm hidden-xs">로그인</span><span class="visible-sm visible-xs"><i class="fa fa-user"></i></span></a></li>

                    <?php }  ?>
                    <!--li><a href="tel:15663366"><span class="hidden-sm visible-xs"><i class="fa fa-phone-square"></i></span></a></li-->
                    <!--<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">고객센터</a></li> -->
                </ul>
		</div>
    </div><!--//hd_wrapper-->

    <?php if(0){ ?>
        <nav id="gnb" style="display:">
    <?php }else{ ?>
        <nav id="gnb" style="display:">
    <?php } ?>
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

                if($row['me_course'])
                    $menu['href'] = G5_URL.$row['me_link'];
                else
                    $menu['href'] = $row['me_link'];

				if($row[me_code]=="a0"&& 0 < strpos($_SERVER['HTTP_USER_AGENT'],"Mobile")){
					$display = "none";
				}else{
					$display = "";
				}


            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>;display:<?php echo $display;?>">
				<?if($row['me_name'] == "고객센터" && ($is_admin || $member['mb_id'] == "admin2")){?>
                <!--<a href="<?/*=G5_BBS_URL*/?>/board.php?bo_table=cs" target="_<?php /*echo $row['me_target']; */?>" class="gnb_1da"><?php /*echo $row['me_name'] */?></a>-->
                    <a href="<?=G5_BBS_URL?>/board.php?bo_table=cs" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
				<?}else if($row['me_code'] == "90" && $is_admin){ // 기름 재사용 매장 신고 ?>
				<a href="<?=G5_BBS_URL?>/board.php?bo_table=report" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
				<?}else{?>
				<a href="<?php echo $menu['href']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
				<?}?>
            </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
        </ul>
        <div id="sub">
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

                if($row['me_course'])
                    $menu['href'] = G5_URL.$row['me_link'];
                else
                    $menu['href'] = $row['me_link']
            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                <a href="<?php echo $menu['href']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                    if($row2['me_course'])
                        $menu['href'] = G5_URL.$row2['me_link'];
                    else
                        $menu['href'] = $row2['me_link']
                ?>
              <li class="gnb_2dli"><a href="<?php echo $menu['href']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
    </div><!--sub-->
    </nav>

</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->

	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->

	<? }else { ?>
    <!-- 서브 상단 { -->
    <!--<div id="subvisual">
    	<div class="visual_img">
            <div class="slogan">
                <p class="wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="1s">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/slogan.png" alt="결과가 곧 신뢰, 구치소닷컴">
                </p>
  	            <span class="wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">실제 수임한 사건 대부분을 <u>무죄, 무혐의</u> 결과로 이끌어 낼정도로 높은 승소율을 자랑합니다.</span>
            </div>
        </div>
    </div> -->
    <!-- } 서브 상단 -->
    <!-- 서브 내용페이지 { -->
    <div id="wrapper">
        <div class="container <?php if($co_id == 'fran01' || $co_id == 'fran02' || $bo_table == 'fran03' || $bo_table == 'after'){ echo 'border tab2'; }
									else if ($bo_table == 'event'){ echo 'border tab2'; } ?>">
            <div class="row">
            <div id="aside" class="col-sm-12">
            <?php

                if(!$is_register || $w){
                    //서브메뉴 추가
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid)
                    echo submenu($sm_tid, 'basic', G5_THEME_PATH);
                }
            ?>
            </div>
            <div id="container" class="col-sm-12">
            	<?php if($co_id == 'menu' || $co_id == 'fran01' || $co_id == 'fran02' || $bo_table == 'fran03') {?>

			    <?php } else if($bo_table == "cs" || $bo_table == "faq"){ ?>
                    <div id="container_title">
                     고객센터

			        <? if($bo_table == "cs"){ ?>
<!--                     고객센터 설명-->
                      <div class="customer_font">
                        <u>게시글을</u> 남기실 때 <b>가맹점명, 전화번호, 이메일</b>을 작성하지 않으실 경우,<br />상담이 어려울 수 있사오니 꼭 작성바랍니다.
                      </div>
				    <?php } ?>

			        <? if($bo_table == "faq"){ ?>
<!--                     고객센터 설명-->
                      <div class="customer_font">
                        자주 묻는 질문들입니다. <br>
                        궁금사항은 먼저 검색해 보세요.
                      </div>
				    <?php } ?>

                      <div class="customer_center">
                          <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=cs">고객문의</a>
                          <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">FAQ</a>
                      </div>
                </div>

            	<?php } else { ?>
                    <div id="container_title">
                     <?php if($bo_table) {?>

					<?php echo $board['bo_subject']; ?>

			    <? if($bo_table == "customer"){ ?>
				  <div class="customer_font">
				    <u>게시글을</u> 남기실 때 <b>가맹점명, 전화번호, 이메일</b>을 작성하지 않으실 경우,<br />상담이 어려울 수 있사오니 꼭 작성바랍니다.
				  </div>
				<?php } ?>


			   	<? if($bo_table == "cctv_new"){ ?>
				  <div class="cctv_font">
				    본 게시판은<strong> 식품의약안전처와 함께하는 프랜차이즈 개방형 주방 구축 지원사업용 CCTV</strong>입니다.<br />
					60계 치킨 전 매장 CCTV는 모바일 홈페이지 혹은 앱에서 확인이 가능하십니다.
				  </div>
				<?php } ?>


                     <?php }else { ?>
                            <?php echo $g5['title'] ?>
                     <?php } ?>
                        <!--메뉴로케이션 시작 {-->
                        <?php

                            if(!$is_register || $w){
                                //서브메뉴 추가
                                if(!$sm_tid)	$sm_tid = $co_id;
                                if(!$sm_tid)	$sm_tid = $bo_table;
                                if($sm_tid)
                                echo submenu($sm_tid, 'location', G5_THEME_PATH);
                            }
                        ?>
                        <!--} 메뉴로케이션 끝-->
                    </div><!--//container_title"-->
                 <?php } ?>
    <!-- } 서브 내용페이지 -->
    <? } ?>

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

<script type="text/javascript">
	$(function(){
		$.ajax({
			url:"<?=G5_BBS_URL?>/ajax.product.php",
			data:{"gr_id":"product"},
			dataType:"HTML",
			type:"POST",
			success:function(data){
				$("#product-lastest").html(data);
			},
			error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
	    }
		});
	});
</script>
<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    <div id="topm">
        <div id="topm_in">
            <div id="left_map">
                <div class="home"><a href="<?php echo G5_URL ?>"><i class="fa fa-globe"></i> HOME</a></div>
                <ul>
                    <!--<li><a href="#">SITEMAP</a></li>-->
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">Inquiry</a></li>
                </ul>
            </div><!--left_map-->
            <div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a></div><!--logo-->
            <div id="search">
                <fieldset id="hd_sch">
                <legend>사이트 내 전체검색</legend>
                <form name="fsearchbox" method="get" action="http://efchem.dreamforone.co.kr/bbs/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content||wr_text1">
                <input type="hidden" name="sop" value="and">
                <label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="Enter the content">
                <input type="submit" id="sch_submit" value="검색">
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
            </div><!--search-->
			
           <a href="../theme/basic/down/catalog_eng.pdf" target="_blank"><div id="lang">
                <dl>
                    <dt>language&nbsp;&nbsp;<i class="fa fa-globe"></i></dt>
                    
					<!--dd>
                    <a href="../theme/basic/down/catalog_eng.pdf" target="_blank">English</a>
                    <a href="#">中文</a>
                    </dd-->
					
                </dl>
            </div><!--lang-->
		</a>
		
		
        </div><!--topm_in-->
    </div><!--topm-->
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
    
		<?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>
        <div class="nav_open">
            <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                <span></span><span></span><span></span>
            </a>
        </div><!--모바일메뉴버튼-->   
        <div id="cata">
        	카다로그 다운로드<!--p>Catalogue Download</p-->
			<p><a href="../theme/basic/down/EF CHEM_K.pdf" target="_blank" class="lan"> 국문 </a>  <a href="../theme/basic/down/EF CHEM_E.pdf" target="_blank" class="lan"> 영문</a></p>
            <i class="fas fa-book"></i>
        </div><!--cata-->
        
    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">      
	<!--서브컨테이너 부분-->
	<? }else if($bo_table == "" || $co_id == ""){ ?>
	 <!--서브상단비주얼--> 
    <div class="subTop">
    	<div class="s_text">
        	<span></span>
            <div class="st01">CHEMICAL SOLUTION LEADER</div>
            <div class="st02">해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.</div>
        </div><!--.s_text-->
    	<div class="sm_text">
        	<span></span>
            <strong>CHEMICAL SOLUTION LEADER</strong>
            해외 주요 시장에서 최상의 제품과 서비스를 제공하여 고객의 기대에 부흥하고자 최선을 다하겠습니다.
        </div><!--.sm_text--> 
    <!--서브상단 각각의 이미지 불러오기시작-->
    <? if($co_id == "greet01"||$co_id == "greet02"||$co_id == "greet03"||$co_id == "search") { ?>
    <div class="subTopBg stb1"></div>
    <? }else if ($bo_table  == "pro01"||$bo_table == "pro02"||$bo_table == "pro03"||$bo_table == "pro04"||$bo_table == "pro05"||$bo_table == "pro06"||$bo_table == "pro07"||$bo_table == "pro08"||$bo_table == "pro09"||$bo_table == "pro10"||$bo_table == "pro11"||$bo_table == "pro12"||$bo_table == "pro13"||$bo_table == "pro14"||$bo_table == "pro15"||$bo_table == "pro16"||$bo_table == "pro17") { ?>
    <div class="subTopBg stb2"></div>
    <? }else if ($bo_table  == "notice"||$bo_table == "qna"||$bo_table == "business"||$bo_table == "business02"||$bo_table == "business_en"||$bo_table == "business02_en") { ?>
    <div class="subTopBg stb3"></div>
    <?php }  ?>
    <!--서브상단 각각의 이미지 불러오기끝-->
    </div> <!--.subTop-->
     
    
	<div id="container">
		<? if($bo_table || $co_id){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
        
        
        
        <!--서브메뉴-->
        <?php if($bo_table == "qna" || $bo_table== "business02" || $bo_table== "business") {?>
        <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
    
            if($sm_tid)		
            echo submenu($sm_tid, 'basic2', G5_THEME_PATH); 
        ?>
        <?php }else { ?>
        <?php 
						
            if(!$sm_tid)	$sm_tid = $co_id;
            if(!$sm_tid)	$sm_tid = $bo_table;
    
            if($sm_tid)		
            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
        ?>
        <?php } ?>
        <!--서브메뉴-->
        
        
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
                    <div class="container_title">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                    </div>
                    
			</div><!--#sub_title-->
				<!--서브타이틀-->
	<? } ?> 

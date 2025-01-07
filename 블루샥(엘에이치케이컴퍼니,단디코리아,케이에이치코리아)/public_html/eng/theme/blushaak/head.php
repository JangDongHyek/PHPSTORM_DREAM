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


    <!--sitemap-->
    <div class="modal fade" id="sitemap" role="dialog">
    <div class="modal-dialog modal-lg" style="z-index: 100;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 20px 30px 10px !important;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="text-center"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sitemap_logo.png" alt="로고"></h3>
        </div>
        <div class="modal-body" style="background:url(/kor/theme/chunil/img/sub/icon_sitemap.png) no-repeat right">
<div id="sitemap">
    <ul id="stm_1dul">
		<?php
        $sql = " select *
                    from {$g5['menu_table']}
                    where me_mobile_use = '1'
                      and length(me_code) = '2'
                    order by me_order, me_id ";
        $result = sql_query($sql, false);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
            <li class="stm_1dli">
                <a class="stm_1da"><?php echo $row['me_name'] ?></a>
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
                        echo '<ul class="stm_2dul">'.PHP_EOL;
                ?>
                    <li class="stm_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="stm_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                <?php
                }

                if($k > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
        <?php
        }

        if ($i == 0) {  ?>
            <li id="stm_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
        <?php } ?>
        </ul>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
    </div>
    <!--//sitemap-->


   <!--토글메뉴-->
   <nav class="menu"> 
      <!-- Menu icon -->
      <div class="menu_header">
         <!--<h1><img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png" style="width:120px" alt="<?php echo $config['cf_title']; ?>" class="hidden-xs"></h1>-->
         <div class="m_gmenu"><a href="<?php echo G5_URL2 ?>eng"><span>ENG</span></a><a href="<?php echo G5_URL2 ?>"><span class="noncheck">KOR</span></a><a href="<?php echo G5_URL2 ?>jpn"><span class="noncheck">JPN</span></a></div>
         <div class="icon-close btn"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_close.png" style="vertical-align:middle; height:27px"></div>
      </div>
  
      <!--카테고리-->
                      <div id="accordion-example" data-collapse="accordion">
                        <div id="gnb2" class="hd_div">
                                <ul id="mgnb_1dul">
                                <?php
                                $sql = " select *
                                            from {$g5['menu_table']}
                                            where me_mobile_use = '1'
                                              and length(me_code) = '2'
                                            order by me_order, me_id ";
                                $result = sql_query($sql, false);
                    
                                for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                    <li class="mgnb_1dli">
                                        <a class="mgnb_1da"><?php echo $row['me_name'] ?></a>
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
                                                echo '<ul class="mgnb_2dul">'.PHP_EOL;
                                        ?>
                                            <li class="mgnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
      
      <!--카피라이트-->
      <div class="menu_add t_margin30">
           <h3>Add.</h3>
	       #1907, IS Tower, 60 Centumbuk-daero, Haeundae-gu, Busan
           <p class="copyright">COPYRIGHTⓒ2020 Blu Shaak. ALL RIGHTS RESERVED.</p>
      </div>
      
      
   </nav>
   <!--//토글메뉴-->

<!-- 상단 시작 { -->
<div id="hd">
    <div class="gmenu fs">
                        <dl>
                                 <dt>ENG</dt>
                                    <dd>
                                      <a href="<?php echo G5_URL2 ?>eng">ENG</a>
                                      <a href="<?php echo G5_URL2 ?>">KOR</a>
                                      <a href="<?php echo G5_URL2 ?>jpn">JPN</a>
                                   </dd>
                        </dl>
    </div>
    <script>
      //글로벌 토글 메뉴
        $(document).ready(function(){
            $(".fs dt").click(function(){
                $(".fs dd").toggle();
            });
            $(".fs dd").click(function(){
                $(this).hide();
            });
        });
    </script>
                      
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
		/*if($_SERVER['REMOTE_ADDR']=="183.103.22.103"){
			include G5_BBS_PATH.'/newwin.inc2.php'; // 팝업레이어
		}else{
			include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
		}*/

		//include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어

    }
    ?>

    <div id="hd_wrapper">
    
    
        <!--pc버전-->
        <div class="t_area clearfix hidden-sm hidden-xs">
           <div class="col-md-4 text-left l_padding30">
                 <!--<h1><a href="<?php echo G5_URL ?>" data-transition="slide"><img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></h1>-->
                 <h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL;?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></h1>
           </div>
           <div class="col-md-8 text-right r_padding130 t_cate">
            <div id="nav_area" class="hidden-sm hidden-xs">
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
                            <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                </div>
           </div>
           <div class="w_menu">
           	<a data-toggle="modal" data-target="#sitemap" style="cursor:pointer"><i class="far fa-bars"></i></a>
           	<a href="https://blog.naver.com/blueshaak" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/common/sns_blog.png" /></a>
            <a href="https://www.instagram.com/blushaak/?hl=ko" target="_blank"><img src="<?php echo G5_THEME_IMG_URL;?>/common/sns_instar.png" /></a>
           </div>
        </div>
        <!--//pc버전-->
        
        <!--mobile버전-->
        <div class="t_area clearfix visible-sm visible-xs">
           <div class="col-xs-6 text-left l_padding20"><h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL;?>/common/m_logo.png" alt=""></a></h1></div>
           <div class="col-xs-6 text-right r_padding20 t_cate">
               <ul>
                  <!--<li class="icon-menu"><img src="<?php echo G5_THEME_IMG_URL;?>/common/btn_search.png" style="vertical-align:middle; height:27px; cursor:pointer" alt="검색 버튼"></li>-->
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
    left: "-80%"
  }, 400);
 });

/* Then push them back */
$('.icon-close').click(function() {
   $('.menu').animate({
    right: "-80%"
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
        <div id="svisual">
				<?php 
                    //서브메뉴 추가
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
					if(strval(strpos($sm_tid,"introduce03"))!=""){
						$sm_tid="introduce03_eng";
					}
                    if($sm_tid)		
                    echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
                ?>
                <div class="s_slogan">
                   <h3 class="t0 wow fadeInDown" data-wow-delay="0.1s">
                        <?php if($bo_table) {?>
                            <?php echo $board['bo_subject']; ?>
                        <?php }else { ?>
                            <?php echo $g5['title'] ?>
                        <?php } ?>
                   </h3>
                   <p class="t1 text-left wow fadeInUp t_margin20" data-wow-delay="0.3s" style="line-height:1.6em">
				    <? /* php
					if($bo_table=="b_qna"&& 0 < strpos($_SERVER['PHP_SELF'],"write.php")){
					*/ ?>
				    <?php
					if($bo_table=="b_qna"){
					?>
					가맹문의 시 전화번호를 꼭 남겨주세요! <br />비밀글 이라 전화번호 노출이 되지 않습니다.
					<?php }else{?>
					Carefully brewed from the finest materials with our utmost sincerity 
					<?php }?>
				   </p>
                </div>
        </div>
		<script type="text/javascript">
			$(function(){
				if(990 < window.innerWidth&&"<?php echo $sm_tid?>"=="franchise" ){
					$("#svisual").css("display","none");
					$("#collapseExample").addClass("in");
				}else{
					$("#collapseExample").removeClass("in");
				}
				$(window).resize(function(){
					if(990 < window.innerWidth&&"<?php echo $sm_tid?>"=="franchise" ){
						$("#svisual").css("display","none");
						$("#collapseExample").addClass("in");
					}else{
						$("#svisual").css("display","block");
						$("#collapseExample").removeClass("in");
					}
					
				});
			});
		</script>
		<? if($co_id == "introduce01" || $co_id == "introduce01_test" || $co_id == "introduce02" || $co_id == "introduce03_eng" || $co_id == "introduce03_02_eng" || $co_id == "menu01" || $co_id == "menu02" || $co_id == "menu03" || $co_id == "menu04"  || $co_id == "menu05" ||$co_id == "franchise01" ||$co_id == "franchise02" ||$co_id == "franchise03") {  ?>
        <div id="container100">
        <? }else if($bo_table == "" || $co_id == ""){ 
		?>
			
            <? if($bo_table == "franchise" && $_GET['wr_id']==""&& intval(strpos($_SERVER['PHP_SELF'],"write.php"))==0 ){ ?>
            <div>
            <? } else { ?>
            <div id="container">
            <? } ?>

        <? } ?>
		<!--서브내용 부분-->
		<div id="scont_wrap">

        <div id="scont">
        <? } ?>

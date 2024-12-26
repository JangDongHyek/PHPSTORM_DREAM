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


    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
	
	
	
<!-- 상단 시작 { -->

<div id="hd" data-wow-delay="0.1s">

    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>


    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

     <div class="sns">
	   <div class="sns_icon">
	       <ul>
	          <li><a href="https://www.facebook.com/www.cjchem.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/icon_facebook.png" /></a></li>
	          <li><a href="https://www.instagram.com/cjchem.co.kr/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/icon_insta.png" /></a></li>
	          <li><a href="https://www.youtube.com/channel/UCzpEeyaqea0QwcMxhLUMt9g/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/icon_youtube.png" /></a></li>
	       </ul>	 
	   </div>
	 </div>
	 
	 
    <div id="hd_wrapper" class="container">
          <h1><div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/header_logo.png" alt="로고"></a></div></h1><!--#logo-->
    <hr>

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
                    <li  class="gnb_2dli"<?if($row2['me_name'] == "블로그 (cj_chem)" || $row2['me_name'] == "블로그 (bcsmarket)" || $row2['me_name'] == "포스트" || $row2['me_name'] == "다음 블로그" || $row2['me_name'] == "티스토리" || $row2['me_name'] == "카카오스토리"){if($i>1){?>style="background-color:#e7f3e8"<?}}?>><a href="<?php echo $sub['sm_link']?>" target="_<?php echo $sub['sm_target']; ?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
    
<script type="text/javascript">
//<![CDATA[

//bookmark
$(document).on('click', '#bookmark', function(e){
	e.preventDefault();
	var bUrl = "http://www.cjchem.co.kr";
	var bTitle = "친환경성 산업용 세척제 BCS 판매점 씨제이켐";
	try {
		if (window.sidebar) {
			window.sidebar.addPanel(bTitle, bUrl, "");
		} else if (window.external || document.all) {
			window.external.AddFavorite(bUrl, bTitle);
		} else if (window.opera) {
			$("a#bookmark").attr("rel","sidebar");
		}
	} catch (err) {
		alert("죄송합니다. 현재 브라우저는 스크립트로 즐겨찾기 추가 기능을 지원하지 않습니다.\n즐겨찾기에 추가하시려면,\n Ctrl + D 키를 눌러주십시오.");
	}
});
</script>

    <div class="f_menu">
		<!--<a href="#" onclick="window.external.AddFavorite('http://www.dreamforone.com/~bychem', '씨제이켐')"><img src="<?php echo G5_THEME_IMG_URL ?>/favo.png" /></a>-->
		<a href="JavaScript:window.external.AddFavorite('http://www.dreamforone.com/~bychem','씨제이켐')"  id="bookmark"><img src="<?php echo G5_THEME_IMG_URL ?>/favo.png" /></a>
    </div>
    <div class="m_menu">
		<a href="mailto:cj_chem@naver.com"><img src="<?php echo G5_THEME_IMG_URL ?>/mail.png" /></a>
	</div>

</div><!--#hd_wrapper-->
    

    <!--mobile메뉴-->
		  <div class="tn nav_open"><span></span><span></span><span></span></div>
          <div id="mask" style="display:none"></div>
        
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/common/btn_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title">Category<i class="fa fa-th-large"></i></div>
                      <!--메뉴시작-->
                      <div class="mobile_head">
                          <ul>
                            <li><a href=""><i class="fa fa-home"></i>HOME</a></li>
                            <li class="fs">
                               <dl>
                                 <dt style="font-weight:400"><i class="fa fa-caret-down"></i>1644-9269</dt>
                                    <dd>
                                      <a href="tel:010-7601-4341">P. 010-7601-4341</a>
                                   </dd>
                               </dl>
                           </li>
                         </ul>
                      </div>
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
                                            <li class="mgnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
					</div>
                </li>
		   </ul>
		   </nav>
<!--mobile메뉴 끝-->
    
    
    
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브상단비주얼시작-->

            <?php if($co_id == "company"||$co_id == "location"){ //회사소개
			 echo "<div id='svisual' class='svisual01 wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($co_id == "product"||$co_id == "product01"||$co_id == "product02"||$co_id == "product03"||$co_id == "product04"||$co_id == "product05"||$co_id == "product05_2"||$co_id == "product05_3"||$co_id == "product06"||$co_id == "product07"||$co_id == "product08"||$co_id == "product09"||$co_id == "product10"||$co_id == "pro_bysol"||$co_id =="pro_ut3"){ //제품소개
			 echo "<div id='svisual' class='svisual02 wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($bo_table == "request"){ //신청문
			 echo "<div id='svisual' class='svisual03 wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($bo_table == "data"||$bo_table == "data_2"){ //자료실
			 echo "<div id='svisual' class='svisual04 wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}else if($bo_table == "afterword"){ //사용후기
			 echo "<div id='svisual' class='svisual05 wow fadeInDown hidden-sm hidden-xs' data-wow-delay='0.1s'>"; 
			}
            ?>
    	    <div class="svisual_in">
    		<div class="s_text">
            
            <?php if($co_id == "company"){ //회사소개
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#a4a8bc'>:</span>ABOUT US</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else if($co_id == "location"){ //오시는길
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#a4a8bc'>:</span>LOCATION</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else if($co_id == "product"||$co_id == "product01"||$co_id == "product02"||$co_id == "product03"||$co_id == "product04"||$co_id == "product05"||$co_id == "product05_2"||$co_id == "product05_3"||$co_id == "product06"||$co_id == "product07"||$co_id == "product08"||$co_id == "product09"||$co_id == "product10"||$co_id == "pro_bysol"||$co_id =="pro_ut3"){ //제품소개
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#aebca4'>:</span>PRODUCTS</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else if($bo_table == "request"){ //신청문의
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#a4a8bc'>:</span>REQUEST</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else if($bo_table == "data"||$bo_table == "data_2"){ //자료실
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#a4a8bc'>:</span>INFORMATION</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else if($bo_table == "afterword"){ //사용후기
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#aebca4'>:</span>AFTERWORD</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}else{ //
			 echo "<h2 class='wow fadeInDown' data-wow-delay='0.8s'><span style='color:#aebca4'>:</span>CUSTOMER</h2> 
			       <p class='wow fadeInDown eng' data-wow-delay='0.8s'>bcs series distribution center CJCHEM</p>";
			}
		?>
                
        	</div>
        	</div><!--s_text-->
        </div><!--svisual_in-->
    </div><!--svisual-->
    <!--서브상단비주얼끝-->
    
	<!--페이지경로-->
	<div class="rt_nav wow fadeInDown" data-wow-delay="0.2s">
		<div class="p_info hidden-sm hidden-xs">
			<ul>
				<li><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon_home.gif" />&nbsp;HOME</a></li>
				<li class="bar">&nbsp;&nbsp;＞&nbsp;&nbsp;</li>
				<li class="pt"> 
					<?php if($bo_table) {?>
					<?php echo $board['bo_subject']; ?>
					<?php }else { ?>
					<?php echo $g5['title'] ?>
					<?php } ?>
				</li>
			</ul>
		</div><!--.p_info-->
	</div>


<script type="text/javascript">
$('.select_2depth').on('click','.placeholder',function(){
  var parent = $(this).closest('.select_2depth');
  if ( ! parent.hasClass('is-open')){
    parent.addClass('is-open');
    $('.select_2depth.is-open').not(parent).removeClass('is-open');
  }else{
    parent.removeClass('is-open');
  }
}).on('click','ul>li',function(){
  var parent = $(this).closest('.select_2depth');
  parent.removeClass('is-open').find('.placeholder').text( $(this).text() );
});
</script>

<!-- //페이지경로 -->
    
	<div id="container" class="wow fadeInDown" data-wow-delay="0.3s">
		<!--서브내용 부분-->
		<div id="scont_wrap clearfix">
            <div class="col-md-3">
            <?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
	    	?>
            </div>
			<div id="scont" class="col-md-9">
				<!--서브타이틀-->
				<div id="sub_title">
					<h2 class="container_title" style="clear:both">
						<?php if($bo_table) {?>
							<?php echo $board['bo_subject']; ?>
						<?php }else { ?>
							<?php echo $g5['title'] ?>
						<?php } ?>
					</h2>
				</div><!--#sub_title-->
			<!--서브타이틀-->
		<? } ?> 
			

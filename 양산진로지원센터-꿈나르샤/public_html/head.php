<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
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
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->

        <ul id="tnb">
            <li class="home"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/m_home.gif" alt="home" /></a></li>
            <li class="border01"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=noticee">공지사항</a></li>
            <li class="border01"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=referencee">자료실</a></li>
            <li class="border01"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=galleryy">포토뉴스</a></li>
            <li class="border02"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4">찾아오시는길</a></li>
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li class="login"><a href="/adm/newwinlist.php" target="_blank"><strong>팝업관리</strong></a></li>
            <?php }  ?>
            <li class="login"><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php } else {  ?>
            <li class="login"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>
        </ul>

    <hr>

<!--전체펼침메뉴-->
<nav class="gnb">
    <ul>
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet1" class="m">센터안내</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet1">인사말</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet3">로고설명</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet2">센터안내</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet5">연혁</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=g_greet3">둘러보기</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4">찾아오시는 길</a></li>
            </ul><!--.d2-->
        </li><!--.d1-->
		
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung01" class="m">중점사업</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung01">꿈길운영</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung02">진로체험지원<br /> 네트워크</a></li>
		    </ul><!--.d2-->
        </li><!--.d1-->
		
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung03" class="m">특화사업</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung03">찾아가는<br /> 전문직업인 체험 </a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk03">진로캠프</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk04">마을 협력 청소년<br /> 진로체험</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk05">양산 역사문화탐방<br /> 진로체험<br /> 「인문학 진로기행」</a></li>
			    <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk08">양산 사랑 공모전<br /> 「꿈꾸다, 양산 愛」</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk07">4차산업 기술 활용<br /> 교육 「AI 아는 아이」</a></li>					
				<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk10">기후위기대응캠프<br />「I am 그린리더 / 블루리더」</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk09">세계 시민의식 함양<br />「I am 세계시민」 </a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk01">진로상담 「한걸음」</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk06">진로·진학 멘토링 「수시AllKill」</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk02">양산 진로·진학 체험전 「길」</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk11">꿈길로</a></li>
			</ul><!--.d2-->
        </li><!--.d1-->
		
		
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang04" class="m">교육사업</a>
            <ul class="d2">
			    <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang04">진로지도사 연수</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang01">진로교원연수</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang02">진로체험 멘토단 연수</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang03">직원역량 강화 연수</a></li>
            </ul><!--.d2-->
        </li><!--.d1-->
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program08" class="m">프로그램 예약</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program08">상담 프로그램 안내</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel">상담예약</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify">상담예약확인</a></li>
			    <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=	program">프로그램 신청</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/apply.search.php?bo_table=apply">프로그램 신청확인</a></li>
            </ul><!--.d2-->
        </li><!--.d1-->
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=exp" class="m">꿈길 직업체험처</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=exp">꿈길체험처</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=blog&wr_id=1">진로직업체험</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=job">신청방법</a></li>
            </ul><!--.d2-->
        </li><!--.d1-->
        <li class="d1">
            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=noticee" class="m">정보마당</a>
            <ul class="d2">
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=noticee">공지사항</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=calendar">월간계획</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=referencee">자료실</a></li>
                <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=galleryy">포토뉴스</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/write.php?bo_table=push">행사문자알림</a></li>
            </ul><!--.d2-->
        </li><!--.d1-->
    </ul>
</nav>
<!--전체펼침메뉴-->

    </div><!--#hd_wrapper-->
    <!--전체펼침메뉴-->
    <div class="subBg"></div>
    <!--전체펼침메뉴-->
</div>
<!-- } 상단 끝 -->

<hr>

<!--전체펼침메뉴-->
<script>
$(".gnb").mouseover(function(){
	$(".subBg").stop().animate({height:430},100)
}).mouseout(function(){
	$(".subBg").stop().animate({height:0},100)	
});
</script>
<!--전체펼침메뉴-->

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

		<? if(defined('_INDEX_')) {?>
          <div id="container_index"></div>
        <? }else if($bo_table == "" || $co_id == ""){ ?>
            <!--서브비쥬얼-->
            <div id="svisual"></div>
            
            <div id="container">
                <!--서브 왼쪽메뉴 및 고객센터-->
                <div id="left">
                        <? if($co_id == "greet1" || $co_id == "greet2" || $co_id == "greet3" || $bo_table =="g_greet3" || $co_id == "greet4" || $co_id == "greet5") { // 센터소개 ?>
                           <dl>
                                <dt>센터안내</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet1"><dd>인사말</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet3"><dd>로고설명</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet2"><dd>센터안내</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet5"><dd>연혁</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=g_greet3"><dd>둘러보기</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=greet4"><dd>찾아 오시는 길</dd></a>
                           </dl>
                        <? } else if ($co_id == "pro_jung01" || $co_id == "pro_jung02"){ // 중점프로그램 ?>
                           <dl>
                                <dt>중점사업</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung01"><dd>꿈길운영</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung02"><dd>진로체험지원 네트워크</dd></a>
                           </dl>
                        <? } else if ($co_id == "pro_jung03" || $co_id == "pro_tuk01" || $co_id == "pro_tuk02" || $co_id == "pro_tuk03" || $co_id == "pro_tuk04" || $co_id == "pro_tuk05" || $co_id == "pro_tuk06" || $co_id == "pro_tuk07"  || $co_id == "pro_tuk08" || $co_id == "pro_tuk09" || $co_id == "pro_tuk10" || $co_id == "pro_tuk11" ){ // 특화 프로그램 ?>
                           <dl>
                                <dt>특화사업</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_jung03"><dd>찾아가는 전문직업인 체험</dd> </a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk03"><dd>진로캠프</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk04"><dd>마을 협력 청소년 진로체험</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk05"><dd>양산 역사문화탐방 진로체험..</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk08"><dd>양산 사랑 공모전 「꿈꾸다, 양산 愛」</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk07"><dd>4차산업 기술 활용 교육 「AI 아는..</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk10"><dd>기후위기대응캠프 「I am 그린리더 / 블루리더」</dd></a>
                               <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk09"><dd>세계 시민의식 함양「I am 세계시민」 </dd></a>
                               <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk01"><dd>진로상담 「한걸음」</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk06"><dd>진로·진학 멘토링 「수시AllKill」</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk02"><dd>양산 진로·진학 체험전 「길」</dd></a>

                               <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_tuk11"><dd>꿈길로</dd></a>
                           </dl>
						   
                        <? } else if ($co_id == "pro_rang01" || $co_id == "pro_rang02" || $co_id == "pro_rang03" || $co_id == "pro_rang04"){ // 역량강화 프로그램 ?>
                           <dl>
                                <dt>교육사업</dt>
                                   <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang04"><dd>진로지도사 연수</dd></a>
                                   <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang01"><dd>진로교원연수</dd></a>
                                   <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang02"><dd>진로체험 멘토단 연수</dd></a>
                                   <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=pro_rang03"><dd>직원역량 강화 연수</dd></a>
                           </dl>
                        <? } else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program08" || $bo_table == "program" || $bo_table == "apply") { // 프로그램 예약 ?>
                           <dl>
                                <dt>프로그램 예약</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=program08"><dd>상담 프로그램 안내</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel"><dd>상담 예약</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=counsel&mode=identify"><dd>상담 예약 확인</dd></a>
								
								<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=	program"><dd>프로그램 신청</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/apply.search.php?bo_table=apply"><dd>프로그램 신청확인</dd></a>
								
								
                           </dl>
                        <? } else if ($co_id == "job" || $bo_table == "exp" || $bo_table == "blog"){ // 꿈길 직업체험처 ?>
                           <dl>
                                <dt>꿈길 직업체험처</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=exp"><dd>꿈길 체험처</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=blog&wr_id=1"><dd>진로직업체험</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=job"><dd>신청방법</dd></a>
                           </dl>
                        <? } else if ($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy" || $bo_table == "calendar"  || $bo_table == "push" ){ // 정보마당 ?>
                           <dl>
                                <dt>정보마당</dt>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=noticee"><dd>공지사항</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=calendar"><dd>월간계획</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=referencee"><dd>자료실</dd></a>
                                <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=galleryy"><dd>포토뉴스</dd></a>
								<a href="<?php echo G5_BBS_URL; ?>/write.php?bo_table=push"><dd>행사문자알림</dd></a>
                           </dl>
                        <? } ?>
                    <div class="left_call"><img src="<?php echo G5_IMG_URL ?>/left_call.gif" / alt="이용안내"></div><!--.left_call-->
                    <div class="sub_ban">
			   <a href="https://www.ggoomgil.go.kr" target="_blank"><img src="<?php echo G5_IMG_URL ?>/banner_dream.jpg" / alt="꿈길"></a><a href="http://www.career.go.kr/cnet/front/main/main.do" target="_blank"><img src="<?php echo G5_IMG_URL ?>/sub_ban01.jpg" / alt="진로심리검사"></a>
               <a href="http://www.work.go.kr/consltJobCarpa/jobPsyExam/jobPsyExamIntro.do" target="_blank"><img src="<?php echo G5_IMG_URL ?>/sub_ban02.jpg" / alt="직업심리검사"></a>
                    </div>
                </div><!--#left-->  
                
                <!--서브내용 부분-->
                <div id="scont_wrap">
	
                    <div id="scont">
                        <!--서브타이틀-->
                        <div id="sub_title">
                            <div class="p_info">
                                   <ul>
                                       <li><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL; ?>/icon_home.gif" />&nbsp;HOME</a></li>
                                       <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                                       <li><? if($co_id == "greet1" || $co_id == "greet2" || $bo_table == "g_greet3" || $co_id == "greet4" || $co_id == "greet5"){	//센터소개
                                            echo ("센터안내"); 
                                        }else if($co_id == "education02" || $co_id == "education05" || $co_id == "education07" || $co_id == "education08"){ // 교육프로그램
                                            echo ("교육프로그램");  
										}else if($co_id == "pro_jung01" || $co_id == "pro_jung02" || $co_id == "pro_jung03"){ // 중점프로그램
                                            echo ("중점 프로그램"); 
										}else if($co_id == "pro_tuk01" || $co_id == "pro_tuk02" || $co_id == "pro_tuk03" || $co_id == "pro_tuk04" || $co_id == "pro_tuk05" || $co_id == "pro_tuk06" || $co_id == "pro_tuk07" || $co_id == "pro_tuk08"){ // 중점프로그램
                                            echo ("특색 프로그램"); 
										}else if($co_id == "pro_rang01" || $co_id == "pro_rang02" || $co_id == "pro_rang03"){ // 교육연수세미나
                                            echo ("교육연수·세미나"); 
                                        }else if($co_id == "experience07" || $co_id == "experience08"  || $co_id == "education09" || $co_id == "education10" || $co_id == "education11"){ // 체험프로그램
                                            echo ("체험프로그램");  
                                        }else if($bo_table == "counsel" || $bo_table == "counsel&mode=identify" || $co_id == "program08" || $bo_table == "counsel" || $bo_table == "program" || $bo_table == "apply"){ // 프로그램예약
                                            echo ("프로그램예약");  
                                        }else if($bo_table == "exp" || $co_id == "maching" || $co_id == "job"){ // 꿈길 직업체험처
                                            echo ("꿈길 직업체험처");  
                                        }else if($bo_table == "noticee" || $bo_table == "referencee" || $bo_table == "galleryy" || $bo_table == "calendar"  || $bo_table == "push"){ // 정보마당
                                            echo ("정보마당");  
                                        }
                                        ?>         
                                       </li>
                                       <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                                       <li class="pt"> 
                                        <?php if($bo_table) {?>
										<?php
										if($bo_table == 'counsel' && ($mode == 'identify' || $mode == 'identify_adm')){
											echo $board['bo_subject'].'확인';
										}else{
											echo $board['bo_subject'];
										}
										?>
                                        <?php }else { ?>
                                        <?php echo $g5['title'] ?>
                                        <?php } ?>
                                        </li>
                                   </ul>
                              </div><!--.p_info-->
                              <div class="container_title">
                                <?php if($bo_table) {?>
								<?php
								if($bo_table == 'counsel' && ($mode == 'identify' || $mode == 'identify_adm')){
									echo $board['bo_subject'].'확인';
								}else{
									$title=0 < strpos($_SERVER[PHP_SELF],"apply")?"확인":"";
									echo $board['bo_subject'].$title;
								}
								?>
                                <?php }else { ?>
                                <?php echo $g5['title'] ?>
                                <?php } ?>
                               </div>
                        </div><!--#sub_title-->
                        <!--서브타이틀-->
                    <? } ?> 
                    
                    

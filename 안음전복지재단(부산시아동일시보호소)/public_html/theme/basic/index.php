<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper" >
    <!--메인슬라이더 시작-->
    <div id="visual">
    
       <div id="slogan">
            <div class="img02 wow fadeInDown animated" data-wow-delay="1.3s" data-wow-duration="1s">
               아이들의 <span>꿈</span>이 자라나는 곳
            </div>
           <div class="img01 wow fadeInDown animated" data-wow-delay="1.0s" data-wow-duration="1s">
               부산광역시 <br>
               아동일시보호소</div>
            <?php /*?><div class="mt wow fadeInDown animated" data-wow-delay="1.3s" data-wow-duration="1s">Busan Counseling Center for the Prevention of Women Violence</div><?php */?>
        </div><!--#slogan-->
        
        <ul class="sliderbx" data-wow-delay="0s" data-wow-duration="1s">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
        	<?php /*?><li class="mv01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img01.png" alt="" /></li>
        	<li class="mv02"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img02.png" alt="" /></li>
        	<li class="mv03"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_img03.png" alt="" /></li><?php */?>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->
<div id="program_slogan">사랑의 손길을 전하는 <span>희망의 다리</span>가 되겠습니다.</div>
<div id="program">
   <div class="container">
        <div class="mid02">
            <div class="mb_title">프로그램 안내<span>부산광역시 아동일시보호소</span></div>
            <div class="pro01 pro_con wow fadeInLeft animated" data-wow-delay="0.2s" data-wow-duration="1s">
                <div class="tit">안전양육 프로그램</div>
                <ul class="list">
                    <li>각 방(1방 2~3명 내외), 교사3명(2교대근무) 24시간 거주</li>
                    <li>발달단계별 양육프로그램</li>
                    <li>5대 교육 실시<br>(성폭력 및 아동학대 예방교육, 실종·유괴의 예방·방지 교육)</li>
                </ul>
            </div>
            <div class="pro02 pro_con wow fadeInRight animated" data-wow-delay="0.3s" data-wow-duration="1s">
                <div class="tit">정서지원 프로그램</div>
                <ul class="list">
                    <li>각 발달단계별 사회화 교육 인성교육 예절교육 등</li>
                    <li>아동 백일, 생일기념 파티 등</li>
                </ul>
            </div>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pro01">
                <div class="mb_link">프로그램 자세히보기 &nbsp;&nbsp;<i class="fal fa-plus"></i></div>
            </a>
        </div><!--.mid02-->
    </div>
</div>
<div id="middle">
	<div id="middle_in">
            <div class="mb_left wow fadeInDown animated" data-wow-delay="0.2s" data-wow-duration="1s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=done02">
                    <div class="mb_title">자원봉사 안내<span>부산광역시 아동일시보호소</span></div>
                    <p>아이들은 우리의 소중한 미래입니다.</p>
                    <div class="mb_link">자세히보기 &nbsp;&nbsp;<i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mbanner-->
            
            <div class="mid03 wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="1s">
            	<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">
            	<div class="mb_title">상담문의<span>부산광역시 아동일시보호소</span></div>
                <p>다양한 고민과 문제, 걱정들을 이야기하고 
                <br class="hidden-xs" />
                해결방법을 찾으세요. 상담내용은 비밀보장됩니다.</p>
                <div class="mb_link">자세히보기 &nbsp;&nbsp;<i class="fal fa-plus"></i></div>
                </a>
            </div><!--.mid03-->
            <div class="mb_right wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="1s">
            	<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=done01">
            	<div class="mb_title">후원안내<span>부산광역시 아동일시보호소</span></div>
                <p>
                아이들을 향한 따뜻한 마음이 세상을 움직입니다.<br>
                소중한 가치를 저축해 보십시오.</p>
                <div class="mb_link">자세히보기 &nbsp;&nbsp;<i class="fal fa-plus"></i></div>
                </a>
            </div>
    </div><!--#middle_in-->
            
</div><!--#middle-->
<div id="commu">
    <div class="container">
        <div class="mb_bbs"><?php echo latest('theme/basic', 'notice',4, 35); ?></div>
        <div class="mid01"><?php echo latest('theme/basic', 'free',4, 35); ?></div>
    </div>
</div>

<div id="m_gal">
    <div class="container">
        <h3>앨범 게시판</h3>
        <div><?php echo latest("theme/clean_gallery2_7", "gallery", 6, 15); ?></div>
    </div>
</div>
<?php
include_once(G5_PATH.'/tail.php');
?>
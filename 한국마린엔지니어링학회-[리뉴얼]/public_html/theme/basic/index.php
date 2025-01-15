<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>

<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
        <div id="slogan">
            <div class="title wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">THE KOREAN SOCIETY OF MARINE ENGINEERING</div>
            <div class="stitle wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="0.8s"><?php echo $config['cf_title']; ?></div>
            <div class="con wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>조선해양기자재 및 관련 산업 기술향상</strong>과 <strong>보급</strong>에 최선을 다하겠습니다.</div>
        </div><!--#slogan-->
        <ul class="sliderbx">
        	<li class="mv01"></li>
        	<li class="mv02"></li>
        	<li class="mv03"></li>
            <li class="mv04"></li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->

<div id="m_bg">
    <div id="atc01_wrap">
        <div class="m_01 m01 wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s">
            <a href="https://www.e-jamet.org/" target="_blank">   
                <i class="fal fa-file-search"></i>
                <div class="plus"></div>       
                <div class="txt">
                    <p class="sh_tit">논문검색</p>
                    학회지 및 학술대회 초록집에 게재된 논문을 학술지별 디렉토리 열람 또는 분류별 디렉토리 열람으로 가능합니다.
                    <p class="more">자세히 보기</p>
                </div>
            </a>
        </div>
        <div class="m_01 m02 wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=trea01">
                <i class="fal fa-book"></i>
                <div class="plus"></div>             
                <div class="txt">
                    <p class="sh_tit">논문투고 및 심사</p>
                    논문 원고 작성요령에 따라 작성 후 논문투고 및 심사가 진행되며 자세한 현황 및 진행사항을 확인하실 수 있습니다.
                    <p class="more">자세히 보기</p>
                </div>
            </a>
        </div>  
        <div class="m_01 m03 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.8s">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=webzine"> 
            <div class="plus"></div>    
            <i class="fal fa-book-open"></i>
            <div class="txt">
                <p class="sh_tit">KOSME Webzine</p>
                한국마린엔지니어링학회는 격월 꾸준히 소식지를 발행하고 있으니 많은 이용 바랍니다.
                <p class="more">자세히 보기</p>
            </div>
            </a>
        </div>
    </div>
</div>






<div id="business" class="wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1s">
	<div class="in">
        <h2 class="title">MARINE<strong>INFOMATION</strong>
        <span>한국마린엔지니어링학회는 항상 여러분과 함께하며 더 나은 정보제공을 위해 최선을 다하고 있습니다.<br />선박관련 분야에 부흥하며 보다 신속정확한 정보를 전달하겠습니다.</span></h2>
		<div class="rw cf">
            <ul class="sec03_ul cf">
                <li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.8s"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=trea02"><i class="fal fa-flag-alt"></i><div>논문투고 제규정</div></a></li>
                <li class="wow fadeInDown animated" data-wow-delay="0.6s" data-wow-duration="0.8s"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem01"><i class="fal fa-edit"></i><div>입회안내</div></a></li>
                <li class="wow fadeInUp animated" data-wow-delay="1.0s" data-wow-duration="0.8s"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet07"><i class="fal fa-clipboard-list-check"></i><div>학회제규정</div></a></li>
                <li class="wow fadeInDown animated" data-wow-delay="1.4s" data-wow-duration="0.8s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=mem02"><i class="fal fa-users-class"></i><div>단체회원사</div></a></li>
            </ul>
            <div class="bbs">
            	<?php echo latest("theme/basic", "notice",3, 50); ?>
            </div>
        </div>
    </div>
</div>



<!--롤링배너-->
<div id="fav_area">
	<div class="fav">
        <div class="slide-wrap">
            <div class="arr">
                <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
            </div>
            
            <div class="slide-box">

				<?php
					
					include_once(G5_LIB_PATH.'/thumbnail.lib.php');
					$bo_category_list="Platinum|Diamond|Sapphire|Gold|Silver|공공(도서관)";
					$caName=explode("|",$bo_category_list);
					for($a=0;$a<count($caName);$a++){
						$sql="select * from g5_write_mem02 where ca_name='$caName[$a]' order by wr_id desc";
						$result=sql_query($sql);
						while($row=sql_fetch_array($result)){
							$thumb = get_list_thumbnail("mem02", $row['wr_id'], 150, 50);

							if($thumb['src']) {
								$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="150" height="50" class="img">';
							} else {
								$img_content = '<span style="width:150px;line-height:50px" class="noimg">준비중</span>';
							}
							$href=str_replace("http://","",$row[wr_1]);
							$href=str_replace("https://","",$href);

					
				?>
                <div class="thm"><a href="http://<?=$href?>" target="_blank"><?=$img_content?></a></div>
				<?php }}?>
				<!--
                <div class="thm"><a href="http://www.techwin.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/02.jpg"></a></div>
                <div class="thm"><a href="http://www.komeri.re.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/03.jpg"></a></div>
                <div class="thm"><a href="http://www.doosanengine.com" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/04.jpg"></a></div>
                <div class="thm"><a href="http://www.hhi.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/05.jpg"></a></div>
                <div class="thm"><a href="http://www.shi.samsung.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/06.jpg"></a></div>
                <div class="thm"><a href="http://www.stxengine.co.kr/kor/Default.aspx" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/07.jpg"></a></div>
                <div class="thm"><a href="https://www.komsa.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/08.jpg"></a></div>
                <div class="thm"><a href="http://www.hshi.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/09.jpg"></a></div>
                <div class="thm"><a href="http://www.manbw.com" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/10.jpg"></a></div>
                <div class="thm"><a href="http://www.stxmarine.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/11.jpg"></a></div>
                <div class="thm"><a href="http://www.shindong.com" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/12.jpg"></a></div>
                <div class="thm"><a href="http://www.kpiclub.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/13.jpg"></a></div>
                <div class="thm"><a href="http://www.dsme.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/14.jpg"></a></div>
                <div class="thm"><a href="http://www.seaman.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/15.jpg"></a></div>
                <div class="thm"><a href="http://worldtmc.com" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/16.jpg"></a></div>
                <div class="thm"><a href="http://www.dh.co.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/17.jpg"></a></div>
                <div class="thm"><a href="http://www.shipowners.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/18.jpg"></a></div>
                <div class="thm"><a href="http://www.mariners.or.kr" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/19.jpg"></a></div>
                <div class="thm"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/20.jpg"></div>
                <div class="thm"><a href="http://www.panstartechsolution.com/xe/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/roll_banner/21.jpg"></a></div>-->
            </div>      
        </div>
    </div>
</div>

<!--롤링배너-->

<script>
$('.slide-box').each(function(){
        $(this).slick({
            slidesToShow:7,
            slidesToScroll: 1,
            infinite: true,
            dots: true, 
            accessibility: true,
            arrows: true,
            prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
            nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
            speed: 600,
            autoplay:true,
            autoplaySpeed: 1000,
			responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절할 수 있음.
				{
					breakpoint: 990,
					settings: {
						slidesToShow: 3,
					}
				}
			] 

        })
})
</script>



<?php
include_once(G5_PATH.'/tail.php');
?>
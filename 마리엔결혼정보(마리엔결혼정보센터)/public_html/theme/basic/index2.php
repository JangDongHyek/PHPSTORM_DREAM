<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head2.php');

?>

<div id="idx_wrapper">
    <!--메인슬라이더 시작-->
    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
    	<div class="big_banner">
        	<a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=consult">
            	<h3>무료상담신청</h3>
            	<div class="ov"></div>
            </a>
        </div><!--big_banner-->
        <ul class="sliderbx">
        	<li class="mv01">
                <div id="slogan">
                    <div class="img01 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.8s"><?php echo $config['cf_title']; ?>와 함께..</div>
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>소중한 인연</strong>이</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1.5s" data-wow-duration="0.8s">시작됩니다.</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv02">
                <div id="slogan">
                    <div class="img01 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.8s">좋은 사람과의 만남..</div>
					<div class="img02 wow fadeInLeft animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>그리고 행복</strong>은</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1.5s" data-wow-duration="0.8s">가까이에 있습니다.</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv03">
                <div id="slogan">
                    <div class="img01 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.8s">평생을 함께 할 사람..</div>
					<div class="img02 wow fadeInLeft animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>꿈꾸던 만남</strong>이</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1.5s" data-wow-duration="0.8s">이루어집니다.</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv04">
                <div id="slogan">
                    <div class="img01 wow fadeInDown animated" data-wow-delay="0.5s" data-wow-duration="0.8s">진정한 삶의 동반자,<?php echo $config['cf_title']; ?>가</div>
					<div class="img02 wow fadeInLeft animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>꼭 맞는 인연</strong>을</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1.5s" data-wow-duration="0.8s">찾아드립니다.</div>
                </div><!--#slogan-->
            </li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->


<div class="inr cf wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.4s">
        <ul>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico01.png"></p>
                    <i>매칭부터 만남까지 책임시스템</i>
                    <span class="line"></span>
                    <em>전문매니저의 2:1 맞춤관리<br class="hidden-xs" /> 매칭부터 만남까지 진행</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico02.png"></p>
                    <i>다양한 성혼 프로그램</i>
                    <span class="line"></span>
                    <em>성공률 100%를 향한<br class="hidden-xs" /> 다양한 성혼 프로그램</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico03.png"></p>
                    <i>무제한 매칭서비스</i>
                    <span class="line"></span>
                    <em>인연을 찾을때까지<br class="hidden-xs" /> 매월 1회 이상의 매칭서비스</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico04.png"></p>
                    <i>믿을 수 있는 정회원 제도</i>
                    <span class="line"></span>
                    <em>꼼꼼한 가입심사로<br class="hidden-xs" />
                     확실한 신원인증된 정회원</em>
                </div>
            </li>
        </ul>
</div><!--inr-->

<div class="movie cf">
	<div class="in">
        <h2>아름다운 결혼의 시작은<strong>유니코리아와 함께</strong></h2>
        <h3>회원님의 매칭 상대를 채택하는 과정부터 만남까지 맞춤관리 해드리는 유니코리아는<br />회원님들의 성원에 힘입어 다양한 매스컴에서도 소개가 되었습니다.</h3>
        <div><iframe width="100%" src="https://www.youtube.com/embed/BWvgrcBOYD4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
        <div><iframe width="100%" src="http://vod.jtbc.joins.com/player/embed/vo10224861?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
		
		
 <div><iframe width="100%" src="https://www.youtube.com/embed/2-F9oPHWfLg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div>
       
	   
	    <div><iframe width="100%"  src="https://www.youtube.com/embed/xTnXuJE_S4g" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
</div>
</div>



<div class="banner cf">
    <div class="in left wow fadeInLeft animated" data-wow-delay="0.8s" data-wow-duration="0.8s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/back01.png"></div>
    <div class="in right wow fadeInRight animated" data-wow-delay="0.8s" data-wow-duration="0.8s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/back02.png"></div>
</div><!--banner-->



<article class="area_service wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s">
    <div class="wrap">
        <h1 class="enF wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/txt_eng.png" /></h1>
        <p class="wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1s">새로운 인생을 함께 설계할 배우자와 행복한 결혼을 위해<br />
        회원님의 입장에서 진심어린 마음과 정직한 시스템으로<br />
       한 분 한분의 행복을 위해 최선을 다하겠습니다.
        </p>
        <ul>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main/dong01.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main/dong02.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main/dong03.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main/dong04.jpg" /></li>
        </ul>
    </div>
</article>
<article class="area_quick wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
    <div class="wrap">
        <ul class="cf">
            <li>
            	<div class="ov"></div><strong><i class="fal fa-rings-wedding"></i></strong>정직함<div class="irop">정확한 국제결혼<br />표준계약서를 사용합니다.</div>
                <div class="block_over">
                <span class="drawborder drawborder-top"></span>
                <span class="drawborder drawborder-right"></span>
                <span class="drawborder drawborder-bottom"></span>
                <span class="drawborder drawborder-left"></span>
            	</div><!--.over-->
            </li>
            <li>
            	<div class="ov"></div><strong><i class="fal fa-leaf"></i></strong>진심<div class="irop">행복한 인생설계에<br />진정한 조력자가 되겠습니다.</div>
                <div class="block_over">
                <span class="drawborder drawborder-top"></span>
                <span class="drawborder drawborder-right"></span>
                <span class="drawborder drawborder-bottom"></span>
                <span class="drawborder drawborder-left"></span>
            	</div><!--.over-->
            </li>
            <li>
            	<div class="ov"></div><strong><i class="fal fa-hand-holding-heart"></i></strong>신뢰<div class="irop">엄격한 회원관리로<br />신뢰를 드리겠습니다.</div>
                <div class="block_over">
                <span class="drawborder drawborder-top"></span>
                <span class="drawborder drawborder-right"></span>
                <span class="drawborder drawborder-bottom"></span>
                <span class="drawborder drawborder-left"></span>
            	</div><!--.over-->
            </li>
            <li>
            	<div class="ov"></div><strong><i class="fal fa-hands-heart"></i></strong>약속<div class="irop">고객님의 믿음직한<br />연결다리가 되겠습니다.</div>
                <div class="block_over">
                <span class="drawborder drawborder-top"></span>
                <span class="drawborder drawborder-right"></span>
                <span class="drawborder drawborder-bottom"></span>
                <span class="drawborder drawborder-left"></span>
            	</div><!--.over-->
            </li>
        </ul>
    </div>
</article>



<div id="about">
	<h2 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.6s"><strong>왜?</strong> 유니코리아를 선택할까요?</h2>
    <div class="con wow fadeInDown animated" data-wow-delay="0.8s" data-wow-duration="0.6s">
    	<h3>안정적인 회원수를 바탕으로 <strong>폭 넓은 만남</strong>을 제공합니다.</h3>
        <h4>꼼꼼한 가입심사와 신뢰할 수 있는 결혼정회원을 보유한 유니코리아는<br class="hidden-xs" /> 안정적인 회원 수를 바탕으로 매칭과 만남의 기회를 제공합니다.<br /><br />
매일 새롭게 가입하는 신규회원까지 포함하여<br class="hidden-xs" /> 넓은 범주에서 더 많은 만남의 기회를 가질 수 있습니다.</h4>
    </div>
    <ul class="ico cf">
        <li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m01.png" />
            <p>유니코리아는?</p>
        </a>
        </li>
        <li class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=prog01">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m02.png" />
            <p>회원가입 안내</p>
        </a>
        </li>
        <li class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=prog02">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m03.png" />
            <p>매칭서비스 안내</p>
        </a>
        </li>
        <li class="wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=prog01">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m04.png" />
            <p>가입자격 안내</p>
        </a>
        </li>
        <li class="wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem02">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m05.png" />
            <p>프로그램 소개</p>
        </a>
        </li>
        <li class="wow fadeInUp animated" data-wow-delay="1.2s" data-wow-duration="0.6s">
        <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=mem03">
            <img src="<?php echo G5_THEME_IMG_URL ?>/main/m06.png" />
            <p>여성회원보기</p>
        </a>
        </li>
    </ul><!--ico-->
</div><!--about-->


<div id="insta_area">
	<div class="in">
        <ul class="gal cf">
        	<span class="tit"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01">성혼갤러리</a></span>
        	<li class="wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo01.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo02.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo03.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInDown animated" data-wow-delay="0.8s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo04.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInDown animated" data-wow-delay="1.2s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo06.jpg" /><div class="bg"></div></a></li>
            <li class="wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="0.4s"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01"><img src="<?php echo G5_THEME_IMG_URL ?>/main/photo05.jpg" /><div class="bg"></div></a></li>
        </ul>
    </div>
</div><!--insta_area-->


<div class="main_news">
            <div class="main_tit">
                <h2>UNIKOREA NEWS</h2>
                <h3>유니코리아 뉴스</h3>
            </div>
            
        <div class="in_box">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01" class="rv wow fadeInUp" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/business01.jpg">
                <div class="txt">
                    <h5>UNI 성혼갤러리</h5>
                    <p>실제 매칭이 성사된<br />회원님들의 생생한 갤러리</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/business02.jpg">
                <div class="txt">
                    <h5>UNI 소식&amp;이벤트</h5>
                    <p>유니코리아에서 진행하는<br />다양한 이벤트와 소식들</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna" class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/business03.jpg">
                <div class="txt">
                    <h5>UNI 온라인 상담</h5>
                    <p>회원님들과 함께<br />소통하고 나누는 공간</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=data" class="wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/business04.jpg">
                <div class="txt">
                    <h5>UNI 자료실</h5>
                    <p>행복한 결혼을 위한<br />다양한 자료공간</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>
        </div><!--in_box-->
</div><!--main_news-->

<div id="big_form">
<div class="in">
	<h1>더이상 고민하지 마시고 지금 바로 상담하세요.<span><strong>유니코리아</strong> 무료상담센터는 언제나 열려있습니다.</span></h1>
	     <form action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
		 <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
		 <input type="hidden" name="bo_table" value="consult">
        <div class="formbox">  
            <strong class="title">이름</strong>
            <div class="form"><input type="text" name="wr_name" required></div>
        </div>
        <div class="formbox">  
            <strong class="title">나이</strong>
            <div class="form"><input type="text" name="wr_1"></div>
        </div>
        <div class="formbox">  
            <strong class="title">성별</strong>
            <div class="rd"><input type="radio" name="wr_2" value="남성" checked> 남성 <input type="radio" name="wr_2" value="여성"> 여성</div>
        </div>
        <div class="formbox">  
            <strong class="title">결혼</strong>
            <div class="rd"><input type="radio" name="wr_3" value="초혼" checked> 초혼 <input type="radio" name="wr_3" value="재혼"> 재혼</div>
        </div>
        <div class="formbox">  
            <strong class="title">거주지</strong>
            <div class="form"><input type="text" name="wr_content" value="" id="wr_content"></div>
        </div>
        <div class="formbox">  
            <strong class="title">전화번호</strong>
            <div class="form"><input type="text" name="wr_subject"  required></div>
        </div>
        <div class="formbox">  
            <strong class="title">이메일</strong>
            <div class="form"><input type="text" name="wr_email"></div>
        </div>
       <div class="agree">
            <label>
                <input type="checkbox" name="agree" class="" id="" value=1>
                <em></em><span>개인정보수집이용에 동의합니다.</span>
            </label>	    										
       </div>
        
        <div class="subm"><input type="submit" value="무료상담신청"></div>
        </form>
</div>
</div><!--big_form-->

<script>
function index_write_submit(f){

			if(!f.wr_name.value){
				alert("이름을 입력해주세요");
				return false;
			}
			if(!f.wr_subject.value){
				alert("전화번호를 입력해주세요");
				return false;
			}					
			
			if(!f.wr_content.value){
				f.wr_content.value="거주지 내용 없음";
			}
			

		return true;
}
</script>

<div id="business" class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
	<h1>진정한 삶의 동반자를 찾아드립니다.<br /><strong>유니코리아</strong>에서 소중한 인연을 만나보세요.</h1>
	<h2 class="title">대표전화<strong><?php echo $config['cf_5']; ?></strong></h2>
    <div class="cn">평일 09:00 ~ 19:00 / 주말, 공휴일 09:00 ~ 15:00 상담가능합니다.</div>
    <div class="sec03_link wow flipInX animated" data-wow-delay="0.5s" data-wow-duration="0.6s">
        <a href="mailto:setarmis@naver.com"><i class="fas fa-envelope"></i> 이메일문의 →</a>
        <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem01"><i class="fas fa-clipboard-list"></i> 가입안내 바로가기 →</a>
	</div>
</div>



<?php
include_once(G5_THEME_PATH.'/tail2.php');
?>
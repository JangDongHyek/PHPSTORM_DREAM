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

    <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
          <ul class="sliderbx">

              <?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
              echo banner('top'); ?>
                
        </ul><!--.sliderbx-->
    </div><!-- //visual -->

    <!--메인슬라이더 시작-->
    <?php /* <div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
        <ul class="sliderbx">
        	<li class="mv01">
            	<div id="mg">
                	<div class="a wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.5s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_01.png"></div>
                    <div class="b wow fadeInRightBig animated" data-wow-delay="0.2s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_02.png"></div>
                    <div class="c wow bounceInUp animated" data-wow-delay="1s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img1_03.png"></div>
                </div>
                <div id="slogan">
                    <div class="txt01 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong>재능있는 청년</strong> <?php echo $config['cf_title']; ?>에 다 모였다!</div>
                    <div class="txt02 wow fadeInDown animated" data-wow-delay="1.5s" data-wow-duration="0.8s">내가 원하는 재능을</div>
                    <div class="txt03 wow fadeInUp animated" data-wow-delay="2s" data-wow-duration="0.8s">가장 쉽고 빠르게</div>
                </div>
            </li>
        	<li class="mv02">
            	<div id="mg">
                	<div class="d wow fadeInLeft animated" data-wow-delay="0.2s" data-wow-duration="0.5s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_01.png"></div>
                    <div class="e wow fadeInRightBig animated" data-wow-delay="0.6s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_02.png"></div>
                    <div class="f wow bounceInDown animated" data-wow-delay="1s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_03.png"></div>
                    <div class="g wow bounceInUp animated" data-wow-delay="1.4s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_04.png"></div>
                    <div class="h wow bounceInUp animated" data-wow-delay="1.8s" data-wow-duration="1s"><img src="<?php echo G5_THEME_IMG_URL ?>/main/m_img2_05.png"></div>
                </div>
                <div id="slogan">
                    <div class="txt02 wow fadeInDown animated" data-wow-delay="1s" data-wow-duration="0.8s">어떤 <strong>수업</strong>을<br />찾으시나요?</div>
                    <div class="txt01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">각 분야의 재능 전문가가 알려드려요.</div>
                </div>
            </li>
        </ul><!--.sliderbx-->
    </div><!-- //visual --> */ ?>
</div><!--  #idx_wrapper -->


<!--메인 재능상품 1차 카테고리(아이콘) 영역-->
<div id="main_item">
	<div class="in cf">
        <?php $code = common_code('ctg','code_ctg','json');
        for ($i = 0; $i <count($code); $i++){
            $code2 = common_code($code[$i]['idx'],'code_p_idx','json');
//            $code3 = common_code($code2[0]['idx'],'code_p_idx','json');

            if ($i == 0 ){
                $number = 3;
            }else if ($i > 5){
                $number = $i+2;

                if ($i == 8){
                    $number = 12;
                }
                if ($i == 9){
                    $number = 11;
                }

            }else if ($i > 2 ){
                $number = $i+1;
            }else{
                $number = $i;
            }

            if ($i != 8 && $i != 9){
                $number = '0'."".$number;
            }

            ?>
            <div class="item">
                <a href="<?php echo G5_BBS_URL; ?>/category_list.php?category=<?=$code[$i]['name']?>">
                    <div class="ico">
                        <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate<?=$number?>.png"></div>
                        <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate<?=$number?>_on.png"></div>
                    </div>
                    <h2><?=$code[$i]['name']?></h2>
                </a>
            </div>
        <?php } ?>
        <div class="item">
            <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=video_lecture">
                <div class="ico">
                    <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate10.png"></div>
                    <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate10_on.png"></div>
                </div>
                <h2>재능강의</h2>
            </a>
        </div>
        <div class="item">
            <a href="<?php echo G5_BBS_URL; ?>/contest_list.php">
                <div class="ico">
                    <div class="l"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate07.png"></div>
                    <div class="r"><img src="<?php echo G5_THEME_IMG_URL ?>/main/cate07_on.png"></div>
                </div>
                <h2>공모전</h2>
            </a>
        </div>

    </div><!--in-->
</div><!--main_item-->


<!--인기 카테고리 영역-->
<div id="fav_area">
	<!--인기 카테고리(마케팅)-->
	<div class="fav">
        <h2 class="title">인기있어요! <strong class="mark">마케팅</strong></h2>
        <div class="slide-wrap">
            <div class="arr">
                <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
            </div><!--arr 버튼부분-->
            
            <div class="slide-box">
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm01.jpg"></div>
                    <span class="tit">체험단마케팅</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm02.jpg"></div>
                    <span class="tit">인스타그램</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm03.jpg"></div>
                    <span class="tit">앱마케팅</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm04.jpg"></div>
                    <span class="tit">온라인배너광고</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm05.jpg"></div>
                    <span class="tit">유튜브</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm01.jpg"></div>
                    <span class="tit">종합광고대행</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm02.jpg"></div>
                    <span class="tit">포털마케팅</span>
                    </a>
                </div>
            </div><!--slide-box-->        
        </div><!--slide-wrap-->
    </div><!--fav--><!--인기 카테고리(마케팅)-->
    
    
	<!--인기 카테고리(디자인)-->
	<div class="fav">
        <h2 class="title">인기있어요! <strong class="design">디자인</strong></h2>
        <div class="slide-wrap">
            <div class="arr">
                <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
            </div><!--arr 버튼부분-->
            
            <div class="slide-box">
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm06.jpg"></div>
                    <span class="tit">시각디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm07.jpg"></div>
                    <span class="tit">제품디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm08.jpg"></div>
                    <span class="tit">포장디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm09.jpg"></div>
                    <span class="tit">환경디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm10.jpg"></div>
                    <span class="tit">멀티디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm06.jpg"></div>
                    <span class="tit">기타디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm07.jpg"></div>
                    <span class="tit">서비스디자인</span>
                    </a>
                </div>
            </div><!--slide-box-->        
        </div><!--slide-wrap-->
    </div><!--fav--><!--인기 카테고리(디자인)-->
    
    
	<!--인기 카테고리(영상·음향·사진)-->
	<div class="fav">
        <h2 class="title">인기있어요! <strong class="mov">영상·음향·사진</strong></h2>
        <div class="slide-wrap">
            <div class="arr">
                <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
            </div><!--arr 버튼부분-->
            
            <div class="slide-box">
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm11.jpg"></div>
                    <span class="tit">영상촬영·편집</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm12.jpg"></div>
                    <span class="tit">사진촬영</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm13.jpg"></div>
                    <span class="tit">음악·사운드</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm14.jpg"></div>
                    <span class="tit">엔터테이너</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm15.jpg"></div>
                    <span class="tit">영상제작</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm11.jpg"></div>
                    <span class="tit">더빙·녹음</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm12.jpg"></div>
                    <span class="tit">애니메이션</span>
                    </a>
                </div>
            </div><!--slide-box-->        
        </div><!--slide-wrap-->
    </div><!--fav--><!--인기 카테고리(영상·음향·사진)-->
    
    
	<!--인기 카테고리(교육)-->
	<div class="fav">
        <h2 class="title">인기있어요! <strong class="edu">교육</strong></h2>
        <div class="slide-wrap">
            <div class="arr">
                <span class="btn-prev"><a href="javascript:;"><i class="far fa-chevron-left"></i></a></span>
                <span class="btn-next"><a href="javascript:;"><i class="far fa-chevron-right"></i></a></span>
            </div><!--arr 버튼부분-->
            
            <div class="slide-box">
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm16.jpg"></div>
                    <span class="tit">외국어</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm17.jpg"></div>
                    <span class="tit">스포츠</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm18.jpg"></div>
                    <span class="tit">사진촬영·편집</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm19.jpg"></div>
                    <span class="tit">뷰티·미용</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm20.jpg"></div>
                    <span class="tit">작곡·편곡</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm16.jpg"></div>
                    <span class="tit">그래픽디자인</span>
                    </a>
                </div>
                <div class="thm">
                    <a href="javascript:;">
                    <div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm17.jpg"></div>
                    <span class="tit">보컬·랩</span>
                    </a>
                </div>
            </div><!--slide-box-->        
        </div><!--slide-wrap-->
    </div><!--fav--><!--인기 카테고리(교육)-->
    
</div><!--fav_area-->


<!--인기카테고리 추출 스크립트(pc화면용)-->
<script>
$('.slide-box').each(function(){
        $(this).slick({
            slidesToShow:5,
            slidesToScroll: 1,
            infinite: true,
            dots: true, 
            accessibility: true,
            arrows: true,
            prevArrow: $(this).parents('.slide-wrap').find('.btn-prev'),
            nextArrow: $(this).parents('.slide-wrap').find('.btn-next'),
            speed: 300,
            autoplay: false,
            autoplaySpeed: 1000,
			responsive: [  // 반응형일때 원하는 사이즈에서 보여지는 갯수 조절함
				{
					breakpoint: 990,
					settings: {
						slidesToShow: 3,
					}
				}
			] 

        })
})


function open_tab(f,type) {
    // 새탭으로 띄우기 = 1
    var link = $('#'+f.id).data('link');

    if (type == 1){
        window.open(link);
    }else{
        window.location = link
    }
}
</script>



<!--회원들이 많이 찾아본 서비스-->
<div id="goods">
	<div class="in">
        <h2 class="title">회원들이 많이 <strong>찾아 본</strong> 서비스</h2><!--회원들이 많이 검색하고 찾아본 상품들이 추출될 예정-->
        <div class="list cf">
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span><!--prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                        <div class="heart">
                            <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                            <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>--><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm21.jpg"></div></div><!--상품사진-->
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">인스타그램 마케팅관리, 계정 활성화 및 게시물 피드 관리해 드립니다.</div><!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div><!--사람들이 좋아요 한 횟수-->
                        </div>
                        <div class="price">11,000원</div><!--상품가격-->
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm22.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                          <div id="lecture_writer_list">
                                      <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">유튜브 구독자, 조회수 높은채널 활용 영상 채널수익창출 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                        </div>
                        <div class="price">5,000원~</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm23.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">한글속기 보유, 속기사무소 소장 직접 작업 녹취록, 각종 타이핑 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                        </div>
                        <div class="price">28,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm24.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                    	<div class="tit">영어 번역 회사소개서, 카달로그, 게임, 홈페이지 브로셔 해드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                        </div>
                        <div class="price">65,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                            <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                            <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>--><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm25.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">가격파괴 블로그 모바일 및 PC 블로그탭 타겟 키워드 한달 유지해 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div>
                        </div>
                        <div class="price">11,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm26.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">모던한 디자인으로 간단한 웹사이트와 안드로이드 앱 저렴한 가격에 개발해 드립니다..</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                        </div>
                        <div class="price">770,000원~</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                        <div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm27.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">기악 및 작곡전공생이  클래식 기타 및 클래식 악기를 가르쳐 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                        </div>
                        <div class="price">155,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm28.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">영상학과 전공, 100건의 다양한 경험으로 고퀄리티 2D, 3D 모션그래픽 영상 제작합니다. </div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                        </div>
                        <div class="price">100,000원</div>
                    </div>
                </a>
            </div>
        </div><!--list-->
    </div><!--in-->
</div><!--goods-->


<!--회원들이 많이 이용한 서비스-->
<div id="goods">
	<div class="in">
        <h2 class="title">회원들이 많이 <strong>이용한</strong> 서비스</h2><!--회원들이 많이 구매한 상품들이 추출될 예정-->
        <div class="list cf">
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span><!--prime 광고등록 상품은 해당 아이콘이 뜨도록-->
                        <div class="heart">
                            <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                            <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>--><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm21.jpg"></div></div><!--상품사진-->
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">인스타그램 마케팅관리, 계정 활성화 및 게시물 피드 관리해 드립니다.</div><!--상품제목(최대2줄까지만 추출, 나머지는 ... 처리함)-->
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div><!--사람들이 좋아요 한 횟수-->
                        </div>
                        <div class="price">11,000원</div><!--상품가격-->
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm22.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">유튜브 구독자, 조회수 높은채널 활용 영상 채널수익창출 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                        </div>
                        <div class="price">5,000원~</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm23.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">한글속기 보유, 속기사무소 소장 직접 작업 녹취록, 각종 타이핑 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                        </div>
                        <div class="price">28,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm24.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">영어 번역 회사소개서, 카달로그, 게임, 홈페이지 브로셔 해드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                        </div>
                        <div class="price">65,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                            <button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button><!--좋아요 누른후-->
                            <!--<button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>--><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm25.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">가격파괴 블로그 모바일 및 PC 블로그탭 타겟 키워드 한달 유지해 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>100명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 25</div>
                        </div>
                        <div class="price">11,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                    	<span class="pri">PRIME</span>
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm26.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">모던한 디자인으로 간단한 웹사이트와 안드로이드 앱 저렴한 가격에 개발해 드립니다..</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>165명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 50</div>
                        </div>
                        <div class="price">770,000원~</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                        <div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm27.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">기악 및 작곡전공생이  클래식 기타 및 클래식 악기를 가르쳐 드립니다.</div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 4.8</span><span>98명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 70</div>
                        </div>
                        <div class="price">155,000원</div>
                    </div>
                </a>
            </div>
            <div class="thm">
                <a href="javascript:;">
                	<div class="mg">
                        <div class="heart">
                        	<!--<button type="button" class="heart on"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_on.png" alt="좋아요on" title="좋아요on"></button>--><!--좋아요 누른후-->
                            <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button><!--좋아요 누르기전-->
                        </div>
                    	<div class="mg_in"><div class="over"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm28.jpg"></div></div>
                    </div><!--mg-->
                    <div class="info">
                        <!-- 재능강의 작성자 정보 -->
                        <div id="lecture_writer_list">
                                    <div class="mb">
                                            <div class="photo"><img class="p_img" src='<?=G5_THEME_IMG_URL?>/sub/01.png'></div>
                                        <div class="mb_info">
                                            <p>태양청년&nbsp;&nbsp;<span><i class="fas fa-star"></i>&nbsp;4.5</span></p>
                                        </div>
                                    </div>
                        </div>
                    	<div class="tit">영상학과 전공, 100건의 다양한 경험으로 고퀄리티 2D, 3D 모션그래픽 영상 제작합니다. </div>
                        <div class="rate cf">
                        	<div class="star"><span><i class="fas fa-star"></i> 5.0</span><span>54명의 평가</span></div>
                        	<div class="heart_hit"><span><i class="fas fa-heart"></i></span> 125</div>
                        </div>
                        <div class="price">100,000원</div>
                    </div>
                </a>
            </div>
        </div><!--list-->
    </div><!--in-->
</div><!--goods-->


<!--실시간 후기 추출-->
<div id="main_review">
	<div class="in">
    	<h2 class="title">실시간 후기</h2>
        <h3 class="stitle">매일 매일 업데이트 되는 의뢰인들의 따끈한 <span>이용<strong><i class="fas fa-heart"></i></strong>후기</span></h3>
        <div class="rev cf">
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm29.jpg"></div><!--서비스 썸네일 추출-->
                    <div class="info">
                        <h2 class="cate">마케팅</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다. 3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다.</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>아름다운***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.23 12:05<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm30.jpg"></div>
                    <div class="info">
                        <h2 class="cate">번역·통역</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">빠르고 정확한 번역 굿입니다. 이후에도 다시 한번 맡기고 싶은 마음입니다. 번창하세요!!</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>공하나***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.22 09:30<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm31.jpg"></div><!--서비스 썸네일 추출-->
                    <div class="info">
                        <h2 class="cate">디자인</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">디자인 너무 잘 나왔어요^^ 항상 친절하시고 많은 요구사항에도 작업 빨리 해주셨어요. 수정요청사항도 너무 잘 반영해 주셔서 만족만족 또 만족입니다. 감사합니다. 또 이용할게요~~~</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>콩나라***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.23 12:05<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm32.jpg"></div>
                    <div class="info">
                        <h2 class="cate">공예·예술</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">지금까지 맡겨본 전문인 중에 가장 만족도가 높아요. 하나하나 꼼꼼하게 살펴봐주시고,, 친절하시고,,다음에 또 인연이 되길 바랍니다.</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>소나무***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.22 09:30<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm33.jpg"></div><!--서비스 썸네일 추출-->
                    <div class="info">
                        <h2 class="cate">마케팅</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다. 3번째 의뢰했는데, 이번에도 완벽했습니다. 마케팅을 너무 잘 해주셔서 결과가 정말 좋았습니다. 앞으로도 종종 이용하고 싶어요. 다시 한번 감사드립니다.</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>둘리둘***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.23 12:05<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        	<div class="list cf">
            	<a href="javascript:;">
                    <div class="mg"><img src="<?php echo G5_THEME_IMG_URL ?>/main/thm34.jpg"></div>
                    <div class="info">
                        <h2 class="cate">번역·통역</h2><!--해당 리뷰가 등록된 상품의 1차 카테고리명 추출-->
                        <div class="txt">빠르고 정확한 번역 굿입니다. 이후에도 다시 한번 맡기고 싶은 마음입니다. 번창하세요!!</div> <!-- 리뷰내용최대3줄추출 -->
                        <div class="nick"><span><i class="fas fa-user-circle"></i></span>숑숑숑***</div><!--닉네임 일부분 노출-->
                        <div class="date">2020.12.22 09:30<div class="star"><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span><span class="on"><i class="fas fa-star"></i></span></div></div>
                    </div>
                </a>
            </div>
        </div><!--rev-->
    </div><!--in-->

</div><!--main_review-->

<div id="visual" class="wow fadeIn animated" data-wow-delay="0.2s" data-wow-duration="0.5s">
      <ul class="sliderbx">
            
			<?php //관리자: 하단배너관리에서 넣은 이미지 불러오기
            echo banner('btm'); ?>

            
    </ul><!--.sliderbx-->
</div><!-- //visual -->


<!--<div id="event">-->
<!--	<div class="in">-->
<!--    	<h2 class="title"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/main/event_banner01.png" title="회원가입이벤트"></h2>-->
<!--        <div class="mg"><img src="--><?php //echo G5_THEME_IMG_URL ?><!--/main/event_banner02.png" title="회원가입이벤트"></div>-->
<!--    </div>-->
<!--</div>-->


<?php
include_once(G5_PATH.'/tail.php');
?>
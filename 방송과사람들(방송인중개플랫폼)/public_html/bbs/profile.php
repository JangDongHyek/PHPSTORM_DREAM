<?
include_once('./_common.php');
$g5['title'] = '전문가 정보';
include_once('./_head.php');
$name = "profile";
$pid = "profile";

?>

        <style>
            @media screen and (max-width:1024px) {
                #nav_area{display: none;}
            }
        </style>

<div id="profile_view" class="view">
    <div class="inr">

        <div class="item_right">
            <div class="item_hd">
                <div class="title">김방송 님의 프로필</div>
                <!--공유하기버튼--><a class="btn_share"><i class="fa-regular fa-share-nodes"></i></a>
            </div>
            <div class="item_info">
                <i class="cate">배우·연기</i> <i class="cate">모델</i><!--전문분야-->
                <div class="company_info">
                    <div class="profile_box">
                        <div class="profile"><?php
                            $icon_file = G5_DATA_PATH.'/file/member/'.$mb['mb_no'].'.jpg';
                            if (file_exists($icon_file)) {
                                $icon_url = G5_URL.'/data/file/member/'.$mb['mb_no'].'.jpg';
                                echo '<img src="'.$icon_url.'" alt="">';
                            }else{
                                echo '<img src="'.G5_IMG_URL .'/img_smile.jpg">';
                            }
                            ?></div>
                        <div class="profile_info" onclick="location.href='<?=G5_URL?>/bbs/profile_company.php?mb_no=<?=$mb['mb_no']?>'">
                            <h3><?=$mb['mb_nick']?>김방송</h3>

                            <?
                            $j = 0;
                            for($i=1; $i<7; $i++) {

                                if($mb['file'.$i] != "") $j++;

                                ?>


                            <?}?>

                            <!--<span>포트폴리오 <?/*=$j*/?>건</span>-->
                            <div class="area_star">
                                <div class="img_star v45">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <em>5.0</em>
                                <span class="review">(0개 리뷰)</span>
                            </div>
                        </div>
                    </div>
                    <ul class="list_info">
                        <li>
                            <span>거래건수</span>
                            <h3>10건</h3>
                        </li>
                        <li>
                            <span>만족도</span>
                            <h3>98%</h3>
                        </li>
                        <li>
                            <span>회원구분</span>
                            <h3>
                                개인
                            </h3>
                        </li>
                        <!--<li>
                            <span>평균응답시간</span>
                            <h3>
                                <?/* if($mb['re_time'] == "1") echo "30분 이내";
                                else if($mb['re_time'] == "2") echo "1시간 이내";
                                else echo "1시간 이상";
                                */?>
                            </h3>
                        </li>-->
                    </ul>
                    <!--자기소개글-->
                    <p class="pf_produce"><?=$mb['mb_about']?></p>
                    <div class="btn_ft"><a href="javascript:chatting('<?=$mb['mb_id']?>',<?=$view['i_idx']?>)" class="btn_cs">전문가에게 문의하기</a></div>
                </div>
                <br>
            </div>
        </div>
        <div class="item_left">
            <div class="area_tab">
                <nav class="lnb">
                    <div class="inr">
                        <ul>
                            <li><a href="#area_info">전문가 정보</a></li>
                            <li><a href="#area_service">서비스</a></li>
                            <li><a href="#area_portfolio">포트폴리오</a></li>
                            <li><a href="#area_review">서비스 평가</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="tab_cont">
                    <section id="area_info">
                        <h3>전문가 정보</h3>
                        <div class="box_line">
                            <h4>소개</h4>
                            <div class="conts">안녕하세요 배우 겸 모델 김방송 입니다.</div>
                        </div>
                        <div class="box_line">
                            <h4>활동정보</h4>
                            <dl class="grid">
                                <dt>연락 가능 시간</dt>
                                <dd>언제나 가능</dd>
                                <dt>평균 응답 시간</dt>
                                <dd>10분 이내</dd>
                                <dt>지역</dt>
                                <dd>서울</dd>
                                <dt>희망 시급</dt>
                                <dd>협의 가능</dd>
                                <dt>상주 가능 여부</dt>
                                <dd>가능</dd>
                                <!--상주 가능 으로 체크 했을시 추가되는 부분-->
                                <dt>희망 근무 형태</dt>
                                <dd>파트타임</dd>
                                <dt>희망 근무지</dt>
                                <dd>송파/강동</dd>
                                <dt>현재상태</dt>
                                <dd>프로젝트 찾는 중</dd>
                                <dt>근무 시작 가능일</dt>
                                <dd>2022.10.03</dd>
                                <dt>희망 월급 (세전)</dt>
                                <dd>500,000원-5,000,000원</dd>
                                <!--상주 가능 으로 체크 했을시 추가되는 부분-->
                            </dl>
                        </div>
                        <div class="box_line">
                            <h4>경력 사항</h4>
                            <dl class="grid">
                                <dt>00엔터소속</dt>
                                <dd>2년 2개월</dd>
                                <dt>00광고사 메인모델</dt>
                                <dd>1년</dd>
                            </dl>
                        </div>
                        <div class="box_line">
                            <h4>관련 기술</h4>
                            <div class="tag"><span>생활체육지도사</span><span>모델</span><span>배우</span></div>
                        </div>
                        <div class="box_line">
                            <h4>학력 전공</h4>
                            <dl class="grid">
                                <dt>서울예대대학교</dt>
                                <dd>모델학과(졸업)</dd>
                            </dl>
                        </div>
                        <div class="box_line">
                            <h4>자격증</h4>
                            <dl class="grid">
                                <dt>00자격증</dt>
                                <dd>2024-05</dd>
                            </dl>
                        </div>
                    </section>
                    <section id="area_service">
                        <h3>서비스</h3>
                        <div class="swiper ftSwiper">
                            <ul id="product_list" class="swiper-wrapper">
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="https://itforone.com:443/~broadcast/bbs/item_view.php?idx=15">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                            <div class="price">50,000원 </div> <!-- 가격 -->
                                            <div class="star"><i></i><em>5.0</em></div> <!-- 별점 -->
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section id="area_portfolio">
                        <h3>포트폴리오</h3>
                        <!--디자인 변경-->
                        <?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == "121.140.204.65"){ ?>
                            <div class="portfolio_list">
                                <ul>
                                    <li>
                                        <div>

                                            <button>더보기</button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php }?>
                        <!--//디자인 변경-->

                        <div class="swiper ftSwiper">
                            <ul id="product_list" class="swiper-wrapper">
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 -->
                                        </div>

                                    </a>
                                </li>
                                <li class="swiper-slide">
                                    <i class="heart " onclick="heart_click(15,this)"></i>
                                    <a href="<? echo G5_BBS_URL ?>/portfolio_view.php">
                                        <div class="area_img">
                                            <img src="https://itforone.com:443/~broadcast/data/file/main_img/0_2039270465__d3e9d3a90aff883a7a587b48a12d57dd7db70d9c.jpg" title="">
                                        </div>
                                        <div class="area_txt">

                                            <span></span><!-- 업체명 -->
                                            <h3>영상제작</h3> <!-- 제목 --></div>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <section id="area_review">
                        <h3>받은 평가</h3>
                        <div class="box">
                            <div class="review_total">
                                <h3>5.0</h3>
                                <div class="area_star">
                                    <div class="img_star v45">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <span class="review">3개 리뷰</span>
                                </div>
                            </div>
                            <ul class="review_list">
                                <li>
                                    <div class="title">
                                        <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>
                                        <div class="profile_info">
                                            <h4>김**</h4><!-- 이름 -->
                                            <div class="area_star">
                                                <div class="img_star v45">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <em>5.0</em>
                                                <span class="data">21.09.15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                    <div class="cont" id="content">
                                        저는 최근에 중요한 가족 행사를 맞아 전문가님께 사진 촬영을 의뢰했습니다. 솔직히 말해서, 결과물에 대해 기대가 컸는데, 그 기대를 훨씬 뛰어넘는 경험이었습니다.

                                        우선, 촬영 당일 전문가님께서는 촬영 장소에 일찍 도착하여 모든 장비를 세팅하고 준비해 주셨습니다. 이는 그분의 철저한 준비성과 전문성을 단적으로 보여주었습니다. 또한, 촬영 내내 편안하고 자연스러운 분위기를 만들어 주셔서 저희 가족 모두가 긴장하지 않고 즐겁게 촬영에 임할 수 있었습니다.
                                    </div>
                                    <div class="button" id="toggleButton" onclick="toggleContent()">더보기</div>
                                </li>
                                <li>
                                    <div class="title">
                                        <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>
                                        <div class="profile_info">
                                            <h4>k**</h4><!-- 이름 -->
                                            <div class="area_star">
                                                <div class="img_star v45">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <em>5.0</em>
                                                <span class="data">21.09.15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                    <div class="cont">
                                        꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user02.jpg"></div>
                                        <div class="profile_info">
                                            <h4>k**</h4><!-- 이름 -->
                                            <div class="area_star">
                                                <div class="img_star v45">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <em>5.0</em>
                                                <span class="data">21.09.15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                    <div class="cont">
                                        항상 믿고 쓰는 전문가님 항상 감사드립니다
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user01.jpg"></div>
                                        <div class="profile_info">
                                            <h4>김**</h4><!-- 이름 -->
                                            <div class="area_star">
                                                <div class="img_star v45">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <em>5.0</em>
                                                <span class="data">21.09.15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                    <div class="cont">
                                        항상 믿고 쓰는 전문가님 항상 감사드립니다
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <div class="profile"><img src="<?php echo G5_THEME_IMG_URL ?>/app/img_user03.jpg"></div>
                                        <div class="profile_info">
                                            <h4>k**</h4><!-- 이름 -->
                                            <div class="area_star">
                                                <div class="img_star v45">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <em>5.0</em>
                                                <span class="data">21.09.15</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order_info"><span>작업일 : 24시간 이내</span><span>주문금액 : 20 ~ 30만원</span></div>
                                    <div class="cont">
                                        꼼꼼히 확인하시고 좋은 결과물 만들어주십니다~
                                    </div>
                                </li>
                            </ul>
                            <div class="btn_more"><span>더보기</span></div>
                        </div>
                    </section>
                </div>

                <script>
                    //리뷰 문장더보기
                    function toggleContent() {
                        var content = document.getElementById("content");
                        var button = document.getElementById("toggleButton");

                        if (content.classList.contains("expanded")) {
                            content.classList.remove("expanded");
                            button.textContent = "더보기";
                        } else {
                            content.classList.add("expanded");
                            button.textContent = "접기";
                        }
                    }

                    //포트폴리오
                    var swiper = new Swiper(".ftSwiper", {
                        slidesPerView: 2.5,
                        spaceBetween: 10,
                        grabCursor: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        breakpoints: {
                            // 화면 너비가 1200px 이상일 때
                            1200: {
                                slidesPerView: 3.5,
                                spaceBetween: 20
                            },
                            // 화면 너비가 992px 이상일 때
                            950: {
                                slidesPerView: 3.5,
                                spaceBetween: 20
                            },
                            // 화면 너비가 768px 이상일 때
                            768: {
                                slidesPerView: 2.5,
                                spaceBetween: 15
                            },
                        }
                    });
                </script>
            </div>
        </div>

    </div>
</div>

<form style="display: none" method="post" action="./order.php" id="orderfrm">
    <input type="hidden" name="i_idx" value="<?=$idx?>">
</form>
<!--채팅-->
<form id="fchatting" name="fchatting" method="post" action="./chat.php">
    <input type="hidden" name="inquiry_idx" id="inquiry_idx" value="<?=$idx?>">
    <input type="hidden" name="you_mb_id" id="you_mb_id" value="">
</form>




<?
include_once('./_tail.php');
?>


<?
include_once('./_common.php');

$g5['title'] = '자료검색결과';
include_once('./_head.php');

//loginCheck($member['mb_id'], $member['mb_category']);
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">
<style>
    #wrapper{background:#fff;}
    #container{padding:0 0 140px;}
    #area_shop .search{margin-top: 0;}
    #area_shop .area_bottom .top_filter{display: flex; justify-content: space-between; align-items: center;}
    #area_shop input[type="checkbox"] + label span {margin-bottom: -4px; }
</style>

<div id="area_shop">
    <!--상단배너-->
    <div class="area_top">
        <div class="inr v3">
            <!--<div class="bn_list">
                <div class="txt">
                    <h3>
                    <strong>바다에서 필요했던 모든 자료와 정보들을 공유해보세요!</strong>
                    <p>정보가 곧 자산인 시대! 나만의 정보를 통해 수익을 얻어보세요!</p>
                    </h3>
                    <a href="shop_write.php" class="btn_inquiry">나만의 정보 등록하기</a>
                </div>
                <div class="obj"><img src="<?php /*echo G5_IMG_URL */?>/shop_bn.png"></div>
                <div class="obj2"><img src="<?php /*echo G5_IMG_URL */?>/shop_bn2.png"></div>
            </div>-->
            <div class="search">
                <strong>자료검색창</strong> <input type="search" placeholder="검색어를 입력하세요"><button><i class="far fa-search"></i></button>
            </div>
        </div>

    </div>
    <!--//상단배너-->


    <div class="area_bottom">
        <div class="inr v3">
            <!--<div class="area_cate">
                <div class="inr v3">
                    <ul>
                        <li id="over1"><a id="t1" class="default"><i class="fal fa-ship"></i><p>인기자료</p></a></li>
                        <li id="over2"><a id="t2"><i class="fal fa-scroll"></i><p>좋은자료</p></a></li>
                        <li id="over3"><a id="t3"><i class="fal fa-building"></i><p>사업계획서</p></a></li>
                        <li id="over4"><a id="t4"><i class="fal fa-window-restore"></i><p>제안서</p></a></li>
                        <li id="over5"><a id="t5"><i class="fal fa-edit"></i><p>계약서</p></a></li>
                        <li id="over6"><a id="t6"><i class="fal fa-file-exclamation"></i><p>규정</p></a></li>
                        <li id="over7"><a id="t7"><i class="fal fa-briefcase"></i><p>비지니스</p></a></li>
                        <li id="over8"><a id="t8"><i class="fal fa-user-tie"></i><p>자기소개서</p></a></li>
                    </ul>
                </div>
            </div>-->
            <h3>검색결과</h3>
            <div class="top_filter">
                <div class="box_left">
                    <span class="view"><a href="<?=$_SERVER['SCRIPT_NAME']?>">전체</a> <span class="blue"></span>건</span>
                    <ul class="sort_list">
                        <li class="selected"><span>최신순</span></li>
                        <li><span>별점 높은순</span></li>
                    </ul>
                </div>
                <div class="box_right cdata">
                        <input type="checkbox" id="cr_always2" name="cr_always2" <?php echo $cr['cr_always'] == 'Y' ? 'checked' : ''; ?> value="<?=$cr['cr_always']?>" onclick="alwaysRecruit();">
                        <label for="cr_always2">
                            <span></span>
                            <em>무료 자료만 보기</em>
                        </label>
                </div>
            </div>
            <div class="shop_list">
                <ul class="list">
                    <li onclick="location.href='shop_view.php'">
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/8moJn1655883399.jpg"></p>
                            <p class="wish on"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li><li>#실무서</li><li>#기획</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/tSglB1647239554.png"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/9cyLA1638845259.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price">무료</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/yoV3u1647857755.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price">무료</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/OHgJ71626246194.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/w3qHe1596459002.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/wFALq1648643889.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/Rw50y1660809646.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#소비심리학</li></ul>
                            <p class="title">소비심리학을 적용한 팔리는 상세페이지의 비밀을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>13,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                </ul>
                <ul class="list">
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/TegZ61655537611.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#인물드로잉</li></ul>
                            <p class="title">기분좋은 설득을 담은 UX Writing/기획 해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>49,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/vABI71647231556.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#인물드로잉</li></ul>
                            <p class="title">섬세한 인물화를 그리는 방법을 알려드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>49,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/3lJBE1658798183.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#합격률</li><li>#입사서류</li></ul>
                            <p class="title">합격률 높이는 입사서류 첨삭서비스 제공</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>30,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/pWDsk1650605905.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#자소서</li><li>#경력기술서</li></ul>
                            <p class="title">첨삭 자소서 이력서 경력기술서 빛나게 해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>35,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/LNeOC1648008365.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#블로그</li><li>#원고작성</li></ul>
                            <p class="title">국어국문학과 졸업자가 업종 관계없이 블로그 원고 작성해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>11,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/5ludG1655430124.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#영어번역</li></ul>
                            <p class="title">각 분야 비즈니스 전문 영어 번역해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>15,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/rR6jd1655442135.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#인물드로잉</li></ul>
                            <p class="title">섬세한 인물화를 그리는 방법을 알려드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>49,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/0qkW91612748209.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#번역</li></ul>
                            <p class="title">오역없는 정확한 의미 전달해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>7,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>5.0</strong>
                            이제 4강정도 듣고 있는데 엄청 기대됩니다.
                        </div>
                    </li>
                </ul>
                <ul class="list">
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/qeusg1587379846.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#최적화로직</li><li>#블로그원고</li></ul>
                            <p class="title">최적화 로직 원고 작성해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>9,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/cyiwE1642990316.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#투잡</li><li>#재태크</li></ul>
                            <p class="title">뿌리기업,소재부품장비전문기업 인증 도와 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>99,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/vsd3M1553482705.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#투잡</li><li>#재태크</li></ul>
                            <p class="title">KOITA 기업 부설연구소 설립 진행 해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>99,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/pFuwY1607853350.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#마케팅</li><li>#컨설팅</li></ul>
                            <p class="title">매출이 일어날 수 있는'진짜'마케팅을 알려 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>99,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/Zbc7K1657603496.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#투잡</li><li>#재태크</li></ul>
                            <p class="title">퇴근 후 30분, 주식투자 1000만원 수익 노하우</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>99,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/hdX731661211244.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#논문</li><li>#요약</li></ul>
                            <p class="title">논문 요약해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>15,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/1dFub1622550487.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#투잡</li><li>#재태크</li></ul>
                            <p class="title">한달 걸릴 선행논문조사, 하루 만에 완벽히 해결해 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>199,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                    <li>
                        <div class="img">
                            <p class="img_wrap"><img src="https://d2v80xjmx68n4w.cloudfront.net/gigs/UEMsg1597124500.jpg"></p>
                            <p class="wish"><!--찜 class : on 추가--><i class="fal fa-heart"></i></p>
                            <p class="coin">유료</p>
                        </div>
                        <div class="text">
                            <ul class="tag"><li>#화장품</li><li>#추천</li></ul>
                            <p class="title">전문가가 추천하는 화장품 제조업체 리스트를 드립니다.</p>
                            <p class="gray">구매 43개</p>
                            <p class="price"><strong>49,000</strong>원</p>
                        </div>
                        <div class="review">
                            <strong><i class="fas fa-star"></i>3.0</strong>
                            감사합니다. 천천히 읽어보고 적용해 볼게요
                        </div>
                    </li>
                </ul>
            </div>

            <div id="paging"></div>
        </div>
    </div>
</div>

<?
include_once('./_tail.php');
?>


<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 롱런 2번째 도메인이면 /app로 이동처리 (	http://www.lovelongrun.com)
if ($long_run_web) {
    // goto_url(G5_URL."/app");
    // 301 redirect
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".G5_URL."/app");
    exit();
}

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/main.css?ver='.G5_CSS_VER.'">',2);//메인

?>
    <section class="area_main" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="0">
        <div class="inr">
            <div class="slogan">
                <img src="<?php echo G5_IMG_URL ?>/logo_white.svg" alt="<?php echo $config['cf_title']; ?>" class="logo"
                     data-aos="zoom-out" data-aos-duration="1000" data-aos-delay="100">
                <p data-aos="fade-down" data-aos-duration="1000" data-aos-delay="300"><img src="<?php echo G5_IMG_URL ?>/slogan.png"></p>
            </div>
            <div class="btn_down">
                <a href="https://play.google.com/store/apps/details?id=com.longrun" target="_blank" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_google_b.svg">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_google.svg" class="over">
                    download</a>
                <a href="<?php echo G5_URL ?>/app/" target="_blank" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800"><img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_apple_b.svg">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main/icon_apple.svg" class="over">download</a>
            </div>
        </div>
    </section>
    <div class="phone">
        <p data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1400"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_phone02.png"></p>
        <p class="ab_top" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="1000"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_phone01.png"></p>
        <p data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1200"><img src="<?php echo G5_THEME_IMG_URL ?>/main/main_phone03.png"></p>
    </div>
    <section class="area_guide">
        <h2><strong>매칭방식</strong><p>LONG-RUN Guide</p></h2>
        <div class="guide">
            <dl data-aos="fade-up" data-aos-duration="800" data-aos-delay="0">
                <p>Chapter 1</p>
                <dt>회원가입</dt>
                <dd>롱런 회원가입을 클릭합니다.</dd>
            </dl>
            <dl data-aos="fade-down" data-aos-duration="800" data-aos-delay="500">
                <p>Chapter 2</p>
                <dt>카운슬러 지정</dt>
                <dd>회원님들을 도와 줄 카운슬러가 지정됩니다.</dd>
            </dl>
            <dl data-aos="fade-up" data-aos-duration="800" data-aos-delay="1000">
                <p>Chapter 3</p>
                <dt>매칭상담</dt>
                <dd>연애전문 카운슬러와 매칭상담을 진행합니다.</dd>
            </dl>
            <dl data-aos="fade-down" data-aos-duration="800" data-aos-delay="1500">
                <p>Chapter 4</p>
                <dt>프로필교환 및 성사</dt>
                <dd>이상형에 맞는 프로필을 확인 후<br>상대방의 소개의사를 묻고 소개가 진행됩니다.</dd>
            </dl>
            <dl data-aos="fade-up" data-aos-duration="800" data-aos-delay="2000">
                <p>Chapter 5</p>
                <dt>매칭완료</dt>
                <dd>매칭이후에도 카운슬러에게 이성분과의<br> 대화 피드백 및 도움을 받으며 이성분과<br> 알아가 볼소중한 시간을 만드시면 됩니다.</dd>
            </dl>
        </div>


    </section>
    <section class="area_cho" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="0">
        <h2 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <strong>회원들의 선택 왜 롱런 일까 ?</strong>
            <p>Reason for choice</p>
        </h2>
        <div class="inr">
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="300">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon01.png">
                <dt>검증회원</dt>
                <dd>본인인증을 통해 가입후, 연애전문상담사, 즉 카운슬러가 직접 1:1 상담을 통해 타겟을 맞춰 매칭하기 때문에 알바 및 유령회원은 전부 NO!</dd>
            </dl>
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="400">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon02.png">
                <dt>카운슬러 응답률</dt>
                <dd>카운슬러님들의 근무시간 응답률 99.8% 실시간 응답에 의한 회원님들간의 프라이드유지</dd>
            </dl>
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="500">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon03.png">
                <dt>신속환불</dt>
                <dd>매칭전 단순변심에 의한 환불 요청은 해당 영업일 기준 신속한 환불처리로 회원님들과 원활한 소통</dd>
            </dl>
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="600">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon04.png">
                <dt>고객관리</dt>
                <dd>회원님들 한분한분 매칭이후에도 신속한 답변으로 매칭에 대한 궁금증이나 대화피드백을 유지합니다.</dd>
            </dl>
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="700">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon05.png">
                <dt>맞춤 소개팅</dt>
                <dd>자동AI매칭이 아닌 고객 한분,한분 컨설팅 1:1 맞춤 소개팅</dd>
            </dl>
            <dl data-aos="zoom-out" data-aos-duration="500" data-aos-delay="800">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main/cho_icon06.png">
                <dt>블랙 회원</dt>
                <dd>롱런은 회원분들간의 매너와 신뢰 프라이드를 중요시 합니다.<br>
                    비매너 회원의 언행과 행위 24시간 모니터링 중이며 회원분들의 신고또한 철저하게 확인 중입니다.
                    의사없는 소개팅 행위 및  비매너 회원 적발 시 블랙리스트 제명 처리 됩니다.</dd>
            </dl>
        </div>
    </section>
    <section class="area_review">
        <div class="inr">
            <h2 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                <strong>롱런 BEST 후기</strong>
                <p>LONG-RUN Review</p>
            </h2>
            <div class="review">
                <ul>
                    <li data-aos="fade-left" data-aos-duration="500" data-aos-delay="600">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">00년생 박**</div>
                        </div>
                        <div class="conts">
                            카운스러분들에게 감사할 따름입니다.
                            지인들에게도 추천 하고 있습니다
                            물론 연결되고 마음에 안든 경우도 있지만 그건 제 취향문제라 ,,ㅎㅎ
                            카운슬러님이 중간에서 케어도 잘해주시고 이성분에게 다가가는 방법도 열심히 조언해주셔서 저도 솔탈하게 되었네요.
                            꼭 여러분들께 추천드려보고 싶어요                </div>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="700">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">94년생 김**</div>
                        </div>
                        <div class="conts">
                            비슷한 어플 많이 해보면서 실패 했던 경험도 많습니다.
                            마지막으로 선택한 롱런은 타 어플과 달리 카운슬러분들의 적극적인 조언과 이상형 매칭을 통해 정말 연애 시작을 하게 1인이에요!
                            친 언니에게도 추천해서 이용하고 있습니다
                            꼭 추천 드려 볼게요                </div>
                    </li>
                    <li data-aos="fade-left" data-aos-duration="500" data-aos-delay="800">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">90년생 이**</div>
                        </div>
                        <div class="conts">
                            요즘 일 떄문에 사람 만날 기회 없이 솔로 생활을 전전하다 , 외로운 마음에 롱런이라는 어플을 접하게 되었어요
                            카운슬러님들의 꼼꼼한 상담과 이상형 추천을 통해 지금의 여자친구를 만나게 되었고 행복한 하루하루를 보내고 있습니다
                            저 같이 사람을 만날기회가 적은 요즘 사회분들에게 꼭 추천드립니다.</div>
                    </li>

                    <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="500">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">88년생 유**</div>
                        </div>
                        <div class="conts">
                            솔직하게 리뷰 남겨볼게요
                            타 어플들도 이용해보고 롱런도 이용해 봤습니다.
                            롱런에서 여러번 도전해보고 물론 실패도 했어요 알아가보는 단계에서 서로 연인으로 발전보다는 친구로 남으신분들도 많고 즐거운 대화시간이 많았습니다
                            카운슬러님들도 같이 안타까워 해주며 조언들도 해주고 결국 저도 커플이 되어 이쁘게 연애중입니다.
                        </div>
                    </li>
                    <li data-aos="fade-left" data-aos-duration="500" data-aos-delay="600">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">98년생 최**</div>
                        </div>
                        <div class="conts">
                            우선 리뷰정말 안쓰는데 이번에는 느낀게 많아서 써봅니다 소개팅어플을 이용햇던 사람은아닌데 광고보고 롱런을 처음으로 사용하게됏어요 지속적인 도움을받아 커플이됏엇습니다 그이후 롱런어플을 삭제하고 잘만나다가 헤어져서 다른어플들을 이용하게되엇어요 근데 진짜 롱런만한 어플이 없엇습니다 제가 바보같앗던거죠...계속 과금만하고...그러다 다시 돌아와서 이번에 주선해주신분과 잘 만나고잇습니다 진짜 꼭 이용해보세요 정말 추천드리는 앱입니다
                        </div>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="700">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">96년생 황**</div>
                        </div>
                        <div class="conts">
                            제가 기다리는걸 정말 싫어하는 1인인데 그래서 주선자가잇는 소개팅어플은 이용을 잘안햇습니다 근데 롱런은 상담하는것마저 기다린다는 생각조차 들지않아서 너무 마음에 들엇고 서비스적으로나 친근감잇게 다가와주시는게 이용하는데에잇어서 정말 편햇습니다 비록 아직 커플이 된건 아니지만 잘연락하고 잇고 의심으로 다가갓던게 사실 부끄러울정도로 카운슬러님들에게 죄송스럽기도합니다 누군가 이 리뷰를 본다면 정말 추천드립니다
                        </div>
                    </li>
                    <li data-aos="fade-left" data-aos-duration="500" data-aos-delay="800">
                        <div class="title">
                            <div class="photo"><img src="<?php echo G5_THEME_IMG_URL ?>/main/review_user.png"></div>
                            <div class="name">89년생 유**</div>
                        </div>
                        <div class="conts">
                            정말 좋은분 소개받앗다고 생각해서 리뷰써봅니다! 여자친구랑 헤어지고나서 다신 연애안한다 다짐해놓고 6개월정도 지나자 슬슬 외로워진탓에 소개팅어플 이것저것 사용해봣는데 다른곳들보다 서비스가 너무 좋고 이용할때 불편함을 하나도 못느꼇다는게 놀라워서 롱런을 추천드리고싶습니다 말씀해주신 조언들로 소개받은 여성분과 썸을타고잇는데 만약 소개팅어플을 한다고하신다면 이 어플을 꼭 사용해보셧으면좋겟습니다
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </section>


<?php
include_once(G5_PATH.'/tail.php');
?>
<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');

?>
<?php if($_SERVER['REMOTE_ADDR'] == "59.19.201.109") { ?>
    <style>
        #visual div.bx-pager{display: block}
    </style>
<?php }?>
    <!--상담 팝업-->
    <!--<div id="popup" class="popup">
        <div class="popup-content">
            <div id="pop_banner">
                <div class="title_img">
                    <h1><strong>무료 미팅 이벤트</strong><br>결혼상담/결혼컨설팅</h1>
                    <h2>인륜지대사 결혼....나중에 후회하지말고
                        <br>먼저 결혼전문가와 상담하세요</h2>
                </div>
                <div class="info_box">
                    <dl>
                        <dt>기간</dt>
                        <dd>2024년 7월20일 ~ 09월30일까지</dd>
                        <dt>대상</dt>
                        <dd>만27세 이상 미혼 남녀</dd>
                        <dt>당첨자 발표</dt>
                        <dd>매일 개별 연락</dd>
                        <dt>문의</dt>
                        <dd>T. 051)703-0250</dd>
                        <dt>혜택</dt>
                        <dd>상담과 컨설팅 후 신원인증을 완료한 고객에게<br> 1회 무료 미팅 기회 부여</dd>
                    </dl>
                    <div class="box">
                        결혼도 상담이 필요한 시대....<br>
                        결혼도 컨설팅이 필요한 시대....<br>
                        <br>
                        결정사를 통한 결혼이 더 안전하고 믿을 수 있다.<br>
                        결정사를 통한 만남도 충분한 시간 동안 사랑하고 썸 탈 수 있다.
                    </div>
                    <button class="btn">무료 미팅 이벤트 신청 <i class="fa-thin fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="btn_wrap">
                <button id="dont-show-today">오늘은 더이상 보지 않기</button>
                <button id="close-popup" class="close-button">&times;닫기</button>
            </div>
        </div>
    </div>-->
    <div id="popup" class="popup">
        <div class="popup-content" style="display:none">
            <div id="pop_banner">
                <div class="title_img">
                    <h1>솔로 탈출<br>무료 특별이벤트</h1>
                    <h2>옆구리가 시린 계절 가을!<br>
                        결혼 촉진을 위해 외로운 싱글 청춘남녀들에게<br>
                        커플 맺기 특별이벤트를 마련했습니다.</h2>
                </div>
                <div class="info_box">
                    <dl>
                        <dt>이벤트 기간</dt>
                        <dd>2024년11월 12일  ~  2024년11월30일</dd>
                        <dt>이벤트 대상</dt>
                        <dd>27세 이상 미혼 남여</dd>
                        <dt>당첨자 발표</dt>
                        <dd>매일 개별 연락</dd>
                        <dt>이벤트 문의</dt>
                        <dd>1551-0408</dd>
                    </dl>
                    <div class="box text-left">
                        <p>※ 1인1회만 가능 / 신원인증 필수</p>
                    </div>
                    <button class="btn">무료 미팅 이벤트 신청 <i class="fa-thin fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="btn_wrap">
                <button id="dont-show-today">오늘은 더이상 보지 않기</button>
                <button id="close-popup" class="close-button">&times;닫기</button>
            </div>
        </div>
    </div>
    <div id="popup02" class="popup">
        <div class="popup-content">
            <div id="big_form">
            <div class="in">
                <h1><span><strong>진실된 나의 반쪽</strong>을 찾을수 있는기회!</span> 고민하지 마시고 지금 바로 신청하세요.</h1>
                <form name="frm" action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
                    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                    <input type="hidden" name="bo_table" value="free">
                    <input type="hidden" name="wr_subject" value="무료상담 신청이 접수되었습니다.">
                    <input type="hidden" name="wr_content" value="무료상담 신청이 접수되었습니다.">
                    <div class="formbox">
                        <strong class="title">이름</strong>
                        <div class="form"><input type="text" name="wr_name"></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">생년월일</strong>
                        <div class="form"><input class="" type="text" placeholder="예시) 19840101 형태로" name="wr_1" id="wr_1" value="<?=$member['wr_1']?>"/></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">성별</strong>
                        <div class="rd">
                            <label><input type="radio" name="wr_2" value="남성" checked> 남성</label>
                            <label><input type="radio" name="wr_2" value="여성"> 여성</label>
                        </div>
                    </div>
                    <div class="formbox">
                        <strong class="title">결혼여부</strong>
                        <div class="rd">
                            <label><input type="radio" name="wr_3" value="초혼" checked> 초혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 재혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 썸혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 황혼</label>
                        </div>
                    </div>
                    <div class="formbox">
                        <strong class="title">휴대폰번호</strong>
                        <div class="form"><input type="text" name="wr_5" id="mtel"></div>
                    </div>
                    <!--<div class="formbox">
                        <strong class="title">이메일</strong>
                        <div class="form"><input type="text" name="wr_email"></div>
                    </div>-->
                    <div class="formbox">
                        <strong class="title">&nbsp;</strong>
                        <div class="form select">
                            <select name="wr_4" id="wr_4" required >
                                <option>거주지역</option>
                                <option value="서울"<?php echo $write['wr_4']=="서울"?" selected":"";?>>서울</option>
                                <option value="경기"<?php echo $write['wr_4']=="경기"?" selected":"";?>>경기</option>
                                <option value="인천/부천"<?php echo $write['wr_4']=="인천/부천"?" selected":"";?>>인천/부천</option>
                                <option value="강원도"<?php echo $write['wr_4']=="강원도"?" selected":"";?>>강원도</option>
                                <option value="대전"<?php echo $write['wr_4']=="대전"?" selected":"";?>>대전</option>
                                <option value="세종"<?php echo $write['wr_4']=="세종"?" selected":"";?>>세종</option>
                                <option value="대구"<?php echo $write['wr_4']=="대구"?" selected":"";?>>대구</option>
                                <option value="광주"<?php echo $write['wr_4']=="광주"?" selected":"";?>>광주</option>
                                <option value="울산"<?php echo $write['wr_4']=="울산"?" selected":"";?>>울산</option>
                                <option value="부산"<?php echo $write['wr_4']=="부산"?" selected":"";?>>부산</option>
                                <option value="충북"<?php echo $write['wr_4']=="충북"?" selected":"";?>>충북</option>
                                <option value="충남"<?php echo $write['wr_4']=="충남"?" selected":"";?>>충남</option>
                                <option value="경북"<?php echo $write['wr_4']=="경북"?" selected":"";?>>경북</option>
                                <option value="경남"<?php echo $write['wr_4']=="경남"?" selected":"";?>>경남</option>
                                <option value="전북"<?php echo $write['wr_4']=="전북"?" selected":"";?>>전북</option>
                                <option value="전남"<?php echo $write['wr_4']=="전남"?" selected":"";?>>전남</option>
                                <option value="제주"<?php echo $write['wr_4']=="제주"?" selected":"";?>>제주</option>
                                <option value="해외"<?php echo $write['wr_4']=="해외"?" selected":"";?>>해외</option>
                                <option value="기타"<?php echo $write['wr_4']=="기타"?" selected":"";?>>기타</option>
                            </select>
                            <select name="wr_7" id="wr_7" required >
                                <option>최종학력</option>
                                <option value="대학교 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학교 졸업</option>
                                <option value="대학교 중퇴"<?php echo $write['wr_7']=="대학교 중퇴"?" selected":"";?>>대학교 중퇴</option>
                                <option value="대학교 재학"<?php echo $write['wr_7']=="대학교 재학"?" selected":"";?>>대학교 재학</option>
                                <option value="대학원 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학원 졸업</option>
                                <option value="대학(2,3년제) 졸업"<?php echo $write['wr_7']=="대학(2,3년제) 졸업"?" selected":"";?>>대학(2,3년제) 졸업</option>
                                <option value="대학(2,3년제) 중퇴"<?php echo $write['wr_7']=="대학(2,3년제) 중퇴"?" selected":"";?>>대학(2,3년제) 중퇴</option>
                                <option value="고등학교 졸업"<?php echo $write['wr_7']=="고등학교 졸업"?" selected":"";?>>고등학교 졸업</option>
                                <option value="기타"<?php echo $write['wr_7']=="기타"?" selected":"";?>>기타</option>
                            </select>
                            <select name="wr_12" id="wr_12" required >
                                <option>나의 직업</option>
                                <option value="사무/금융직"<?php echo $write['wr_12']=="사무/금융직"?" selected":"";?>>사무/금융직</option>
                                <option value="연구원/엔지니어"<?php echo $write['wr_12']=="연구원/엔지니어"?" selected":"";?>>연구원/엔지니어</option>
                                <option value="건축/설계"<?php echo $write['wr_12']=="건축/설계"?" selected":"";?>>건축/설계</option>
                                <option value="교사 및 강사"<?php echo $write['wr_12']=="교사 및 강사"?" selected":"";?>>교사 및 강사</option>
                                <option value="공무원/공사"<?php echo $write['wr_12']=="공무원/공사"?" selected":"";?>>공무원/공사</option>
                                <option value="승무원/항공관련"<?php echo $write['wr_12']=="승무원/항공관련"?" selected":"";?>>승무원/항공관련</option>
                                <option value="서비스/영업"<?php echo $write['wr_12']=="서비스/영업"?" selected":"";?>>서비스/영업</option>
                                <option value="의사/한의사/약사"<?php echo $write['wr_12']=="의사/한의사/약사"?" selected":"";?>>의사/한의사/약사</option>
                                <option value="변호사/법조인"<?php echo $write['wr_12']=="변호사/법조인"?" selected":"";?>>변호사/법조인</option>
                                <option value="회계사 등 전문직"<?php echo $write['wr_12']=="회계사 등 전문직"?" selected":"";?>>회계사 등 전문직</option>
                                <option value="간호 및 의료사"<?php echo $write['wr_12']=="간호 및 의료사"?" selected":"";?>>간호 및 의료사</option>
                                <option value="자영업/사업"<?php echo $write['wr_12']=="자영업/사업"?" selected":"";?>>자영업/사업</option>
                                <option value="유학생/석,박사"<?php echo $write['wr_12']=="유학생/석,박사"?" selected":"";?>>유학생/석,박사</option>
                                <option value="프리랜서 및 기타"<?php echo $write['wr_12']=="기타"?" selected":"";?>>프리랜서 및 기타</option>
                            </select>
                        </div>
                    </div>
                    <div class="agree">
                        <label>
                            <input type="checkbox" name="agree" class="" id="" value=1>
                            <em></em>개인정보 수집 이용에 동의합니다. <a data-toggle="modal" data-target="#privacyModal">자세히 보기</a>
                        </label>
                        <label>
                            <input type="checkbox" name="agree02" class="" id="" value=2>
                            <em></em>마케팅 활용에 동의 (선택)<span>- 서비스안내 수신동의 내용 포함</span> <a data-toggle="modal" data-target="#marketingModal">자세히 보기</a>
                        </label>
                    </div>

                    <div class="subm"><input type="submit" value="무료 미팅 이벤트 신청"></div>
                </form>
            </div>
        </div><!--big_form-->
            <div class="btn_wrap">
                <button id="close-popup" class="close-button">&times;닫기</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('popup');
            const popup02 = document.getElementById('popup02');
            const closePopup = document.getElementById('close-popup');
            const closePopup02 = popup02.querySelector('.close-button');
            const dontShowToday = document.getElementById('dont-show-today');
            const eventButton = popup.querySelector('.btn');
            const today = new Date().toISOString().split('T')[0];

            // Check if the popup should be shown
            if (localStorage.getItem('dontShowPopup') !== today) {
                popup.style.display = 'flex';
            }

            // Close the popup
            closePopup.addEventListener('click', function() {
                popup.style.display = 'none';
            });

            // Don't show the popup again today
            dontShowToday.addEventListener('click', function() {
                localStorage.setItem('dontShowPopup', today);
                popup.style.display = 'none';
            });

            // Show popup02 when the event button is clicked, keep popup visible
            eventButton.addEventListener('click', function() {
                popup02.style.display = 'flex';
            });

            // Close popup02
            closePopup02.addEventListener('click', function() {
                popup02.style.display = 'none';
            });
        });


    </script>
    <!--//상담팝업-->
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
                <div class="abox_img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/mvisual01.jpg">
                </div>
                <div id="slogan">
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">진심이 일합니다</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong><?php echo $config['cf_title']; ?></strong></div>
                    <div class="img01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">Marien, Your Pathway to Lasting Love</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv02">
                <div class="abox_img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/mvisual02.jpg">
                </div>
                <div id="slogan">
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">누구나 회원이 될 수 있습니다</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong><?php echo $config['cf_title']; ?></strong></div>
                    <div class="img01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">Marien, Your Pathway to Lasting Love</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv03">
                <div class="abox_img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/mvisual03.jpg">
                </div>
                <div id="slogan">
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">신뢰를 바탕으로 성혼이 이루어지는 그날까지</div>
					<div class="img03 wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong><?php echo $config['cf_title']; ?></strong>가 함께 합니다.</div>
                    <div class="img01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">Marien, Your Pathway to Lasting Love</div>
                </div><!--#slogan-->
            </li>
        	<li class="mv04">
                <div class="abox_img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/mvisual04.jpg">
                </div>
                <div id="slogan">
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">부모의 마음으로 진행됩니다</div>
					<div class="img03 wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="0.8s"><strong><?php echo $config['cf_title']; ?></strong></div>
                    <div class="img01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">Marien, Your Pathway to Lasting Love</div>
                </div><!--#slogan-->
            </li>
            <li class="mv05">
                <div class="abox_img">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/mvisual05.jpg">
                </div>
                <div id="slogan">
                    <div class="img02 wow fadeInLeft animated" data-wow-delay="0.5s" data-wow-duration="0.8s">진심을 담아, 당신의 이상적인 파트너를</div>
                    <div class="img03 wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="0.8s">찾아가는 길을 여는 <strong><?php echo $config['cf_title']; ?></strong></div>
                    <div class="img01 wow fadeInUp animated" data-wow-delay="1.5s" data-wow-duration="0.8s">Marien, Your Pathway to Lasting Love</div>
                </div><!--#slogan-->
            </li>
        </ul><!--.sliderbx-->
    </div><!-- //visual -->
</div><!--  #idx_wrapper -->
<div class="counter_area">
    <div class="titleArea">
        <h4 class="wow fadeInDown" data-wow-delay="0.3s"><span class="txtPoint">Marien</span> Delivering Stable Encounters</h4>
        <h2 class="wow fadeInUp" data-wow-delay="0.4s">마리엔은 안정된 회원 기반과 균형있는 성비로 <br><strong>다양한 만남의 기회</strong>를 제공합니다</h2>
    </div>
    <!--숫자증감애니메이션-->
    <div class="counterareabg">
        <div>
            <span class="title">회원수</span>
            <span class="title">남녀 회원 성비</span>
            <span class="title">교제 및 성혼수</span>
        </div>
        <div class="counter_wrap">
            <p><span class="counter" data-start="0" data-end="9648"><br />0</span></p>
            <p><span class="counter" data-start="0" data-end="47">0</span>:<span class="counter" data-start="0" data-end="53">0</span></p>
            <p><span class="counter" data-start="0" data-end="3418">0</span></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // 클래스가 "counter"인 모든 요소를 선택합니다.
        const $counters = $(".counter");

        // 노출 비율(%)과 애니메이션 속도(ms)을 설정합니다.
        const exposurePercentage = 100; // ex) 스크롤 했을 때 $counters 컨텐츠가 화면에 100% 노출되면 숫자가 올라갑니다.
        const duration = 1000; // ex) 1000 = 1초

        // 숫자에 쉼표를 추가할지 여부를 설정합니다.
        const addCommas = true; // ex) true = 1,000 / false = 1000

        // 숫자를 업데이트하고 애니메이션하는 함수 정의
        function updateCounter($el, start, end) {
            let startTime;
            function animateCounter(timestamp) {
                if (!startTime) startTime = timestamp;
                const progress = (timestamp - startTime) / duration;
                const current = Math.round(start + progress * (end - start));
                const formattedNumber = addCommas ? current.toLocaleString() : current;
                $el.text(formattedNumber);

                if (progress < 1) {
                    requestAnimationFrame(animateCounter);
                } else {
                    $el.text(addCommas ? end.toLocaleString() : end);
                }
            }
            requestAnimationFrame(animateCounter);
        }

        // 초기화 함수 정의
        function initCounters() {
            $counters.each(function() {
                const $el = $(this);
                const start = parseInt($el.data("start"));
                const end = parseInt($el.data("end"));
                // 숫자를 업데이트하고 애니메이션을 시작합니다.
                updateCounter($el, start, end);
            });
        }

        // 초기화 함수 호출
        initCounters();

        // 윈도우의 사이즈가 변경될 때마다 실행됩니다.
        $(window).on('resize', function() {
            if ($(window).width() > 1200) {
                $(window).on('scroll', function() {
                    // 각 "counter" 요소에 대해 반복합니다.
                    $counters.each(function() {
                        const $el = $(this);
                        // 요소가 아직 스크롤되지 않았다면 처리합니다.
                        if (!$el.data('scrolled')) {
                            // 요소의 위치 정보를 가져옵니다.
                            const rect = $el[0].getBoundingClientRect();
                            const winHeight = window.innerHeight;
                            const contentHeight = rect.bottom - rect.top;

                            // 요소가 화면에 특정 비율만큼 노출될 때 처리합니다.
                            if (rect.top <= winHeight - (contentHeight * exposurePercentage / 100) && rect.bottom >= (contentHeight * exposurePercentage / 100)) {
                                const start = parseInt($el.data("start"));
                                const end = parseInt($el.data("end"));
                                // 숫자를 업데이트하고 애니메이션을 시작합니다.
                                updateCounter($el, start, end);
                                $el.data('scrolled', true);
                            }
                        }
                    });
                }).scroll(); // 초기화
            } else {
                // 윈도우 사이즈가 1200px 이하일 때 스크롤 이벤트 제거
                $(window).off('scroll');
                // 초기화 함수 호출
                initCounters();
            }
        }).resize(); // 초기화
    });
</script>
<div class="ad cf wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="0.4s">
    <h4>Embarking on the Journey of Love</h4>
    <h2>아름다운 결혼의 시작, <strong>마리엔과 함께</strong></h2>

    <div class="inr">
        <ul>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico01.png"></p>
                    <i>프리미엄 매칭 서비스</i>
                    <span class="line"></span>
                    <em>개인별 성향과 이상형을 반영한 맞춤형 매칭으로 최적의 인연을 찾아드립니다. 세심한 분석과 상담으로 성공적인 만남을 보장합니다.</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico02.png"></p>
                    <i>다양한 성혼 프로그램</i>
                    <span class="line"></span>
                    <em>다양한 니즈를 충족시키는 성혼 프로그램으로 성공적인 결혼을 돕습니다. 연애 코칭부터 결혼 준비까지 전 과정 지원 서비스 제공합니다</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico03.png"></p>
                    <i>감성매칭과 제안매칭</i>
                    <span class="line"></span>
                    <em>상담을 통해 얻은 회원의 니즈를 분석하여 섬세한 감성 매칭과 매니저의 센스를 발휘해 추천하는 제안 매칭으로 성혼률이 높습니다</em>
                </div>
            </li>
            <li>
                <div>
                	<p><img src="<?php echo G5_THEME_IMG_URL ?>/main/ico04.png"></p>
                    <i>믿을 수 있는 정회원 제도</i>
                    <span class="line"></span>
                    <em>신뢰도 높은 정회원 제도로 안심하고 만남을 가질 수 있습니다. 엄격한 검증 절차를 통해 안전한 매칭 환경을 제공합니다.</em>
                </div>
            </li>
        </ul>
    </div>
</div><!--inr-->

<!--<article class="area_service wow fadeInUp animated" data-wow-delay="0.8s" data-wow-duration="0.8s"></article>-->
<article class="area_quick wow fadeInDown animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
    <div class="title">
        <h1 class="enF wow fadeInLeft" data-wow-delay="0.5s" data-wow-duration="1s">Marien’s Promise</h1>
        <p class="wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1s">새로운 인생을 함께 설계할 배우자와 행복한 결혼을 위해<br class="hidden-xs" />
            회원님의 입장에서 진심어린 마음과 정직한 시스템으로<br class="hidden-xs" />
            한 분 한분의 행복을 위해 최선을 다하겠습니다.
        </p>
    </div>

    <div id="about">
	<h2 class="wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.6s"><strong>당신이 꿈꾸는</strong> 이상적인 파트너를 찾고 계십니까?</h2>
    <div class="con wow fadeInDown animated" data-wow-delay="0.8s" data-wow-duration="0.6s">
        <h3>마리엔 결혼정보회사는 당신의 맞춤형 서비스로로, <br><strong>이상적인 파트너</strong>를 찾아드립니다. </h3>
        <h4>마리엔에서 당신의 파트너를 찾아보세요. <br>결혼을 위한 시작은 여기서부터입니다.</h4>
    </div>
    <div class="text-center wow fadeInDown" data-wow-delay="0.6s">
        <a class="btn" href="<?php echo G5_BBS_URL ?>/ideal_find_test.php"><span>내 결혼상대 찾기 <i class="fa-thin fa-arrow-right"></i></span></a>
    </div>
</div><!--about-->

</article>

<section class="review_area">
    <div class="titleArea">
        <h4 class="wow fadeInDown" data-wow-delay="0.3s"><span class="txtPoint">Marien</span> WEDDING REVIEW</h4>
        <h2 class="wow fadeInUp" data-wow-delay="0.4s">마리엔 회원들이 경험한 <strong>특별한 순간</strong>들을 함께 나눠보세요</h2>
    </div>
    <!-- Swiper -->
    <div class="swiper swiperReview wow fadeInUp" data-wow-delay="0.5s">
        <div class="swiper-button-wrap">
            <div class="swiper-button-prev"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_top.png"></div>
            <div class="swiper-button-next"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_bt.png"></div>
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review01.jpg">
                    </div>
                    <div class="txtArea">
                        <span>법률사무소 컨설턴트 <i class="fas fa-heart"></i> D그룹 비서실</span>
                        <p>마리엔으로 시작한 우리의 특별한 여정: 성혼 후기</p>
                        <div>마리엔을 통해 만난 파트너와의 성혼 후기를 남기고 싶습니다. 마리엔의 매칭은 우리가 상상하는 것 이상이었습니다. 서로의 가치관과 성격이 잘 맞아 사랑이 깊어지고 결혼을 하게 되었습니다. 마리엔에게 진심으로 감사드립니다!</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review02.jpg">
                    </div>
                    <div class="txtArea">
                        <span>K은행 근무 <i class="fas fa-heart"></i> 변호사</span>
                        <p>마리엔으로 찾은 특별한 연인과의 성혼 이야기</p>
                        <div>마리엔의 도움으로 결혼을 앞두고 있습니다. 우리의 만남은 우연이 아닌 정말로 특별한 것이었습니다. 마리엔의 전문가들이 신중하게 매칭해준 결과, 우리는 서로에게 완벽한 파트너를 찾게 되었습니다. 결혼을 앞두고 마리엔에게 진심으로 감사드립니다</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review03.jpg">
                    </div>
                    <div class="txtArea">
                        <span>치과의사 <i class="fas fa-heart"></i> 개업약사</span>
                        <p>마리엔에서의 만남이 우리에게 주는 축복</p>
                        <div>마리엔을 통해 만난 사람과 결혼을 하게 되었습니다. 마리엔은 단순히 만남을 주선하는 곳이 아니라, 우리의 이야기와 가치관을 듣고 신중하게 매칭해준 곳입니다. 우리는 이제 서로를 사랑하며 결혼을 앞두고 있습니다. 마리엔에게 감사드립니다!</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review01.jpg">
                    </div>
                    <div class="txtArea">
                        <span>법률사무소 컨설턴트 <i class="fas fa-heart"></i> D그룹 비서실</span>
                        <p>마리엔으로 시작한 우리의 특별한 여정: 성혼 후기</p>
                        <div>마리엔을 통해 만난 파트너와의 성혼 후기를 남기고 싶습니다. 마리엔의 매칭은 우리가 상상하는 것 이상이었습니다. 서로의 가치관과 성격이 잘 맞아 사랑이 깊어지고 결혼을 하게 되었습니다. 마리엔에게 진심으로 감사드립니다!</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review02.jpg">
                    </div>
                    <div class="txtArea">
                        <span>K은행 근무 <i class="fas fa-heart"></i> 변호사</span>
                        <p>마리엔으로 찾은 특별한 연인과의 성혼 이야기</p>
                        <div>마리엔의 도움으로 결혼을 앞두고 있습니다. 우리의 만남은 우연이 아닌 정말로 특별한 것이었습니다. 마리엔의 전문가들이 신중하게 매칭해준 결과, 우리는 서로에게 완벽한 파트너를 찾게 되었습니다. 결혼을 앞두고 마리엔에게 진심으로 감사드립니다</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="box">
                    <div class="imgArea">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/review03.jpg">
                    </div>
                    <div class="txtArea">
                        <span>치과의사 <i class="fas fa-heart"></i> 개업약사</span>
                        <p>마리엔에서의 만남이 우리에게 주는 축복</p>
                        <div>마리엔을 통해 만난 사람과 결혼을 하게 되었습니다. 마리엔은 단순히 만남을 주선하는 곳이 아니라, 우리의 이야기와 가치관을 듣고 신중하게 매칭해준 곳입니다. 우리는 이제 서로를 사랑하며 결혼을 앞두고 있습니다. 마리엔에게 감사드립니다!</div>
                    </div>
                </div>
            </div>

        </div>
        <!--<div class="swiper-pagination"></div>-->
    </div>

    <!--<div class="text-center wow fadeInDown" data-wow-delay="0.6s">
        <a class="btn">후기 더보기 <i class="fa-light fa-plus"></i></a>
    </div>-->
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        //리뷰
        var swiper = new Swiper(".swiperReview", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            loop: true, // Enable looping
            /*autoplay: {
                delay: 3000, // Set the delay in milliseconds
                disableOnInteraction: false, // Allow manual navigation while autoplay is active
            },*/
            breakpoints: {
                // When window width is <= 1200px, set slidesPerView to 3
                1200: {
                    slidesPerView: 3,
                },
                // When window width is <= 768px, set slidesPerView to 2
                768: {
                    slidesPerView: 2,
                },
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });

</script>


    <!--<div id="insta_area">
	<div class="in">
        <ul class="gal cf">
        	<div class="tit">
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01">
                    <p>GALLERY</p>
                    <span>성혼갤러리</span>
                </a>
            </div>
        	<li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo01.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo02.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo03.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo04.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo06.jpg" /></li>
            <li><img src="<?php echo G5_THEME_IMG_URL ?>/main_re/photo05.jpg" /></li>
        </ul>
    </div>
</div>insta_area-->

    <div class="grid">
        <!--<div id="big_form">
            <div class="in">
                <h1>더이상 고민하지 마시고 지금 바로 상담하세요.<span><strong>마리엔</strong> 무료상담센터는 언제나 열려있습니다.</span></h1>
                <form name="frm" action="<?=G5_BBS_URL?>/write_update.php" onsubmit="return index_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
                    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                    <input type="hidden" name="bo_table" value="free">
                    <input type="hidden" name="wr_subject" value="무료상담 신청이 접수되었습니다.">
                    <input type="hidden" name="wr_content" value="무료상담 신청이 접수되었습니다."> 
                    <div class="formbox">
                        <strong class="title">이름</strong>
                        <div class="form"><input type="text" name="wr_name"></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">생년월일</strong>
                        <div class="form"><input class="" type="text" placeholder="예시) 19840101 형태로" name="mb_birth" id="mb_birth" value="<?=$member['mb_birth']?>"/></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">성별</strong>
                        <div class="rd">
                            <label><input type="radio" name="wr_2" value="남성" checked> 남성</label>
                            <label><input type="radio" name="wr_2" value="여성"> 여성</label>
                        </div>
                    </div>
                    <div class="formbox">
                        <strong class="title">결혼여부</strong>
                        <div class="rd">
                            <label><input type="radio" name="wr_3" value="초혼" checked> 초혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 재혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 썸혼</label>
                            <label><input type="radio" name="wr_3" value="재혼"> 황혼</label>
                        </div>
                    </div>
                    <div class="formbox">
                        <strong class="title">휴대폰번호</strong>
                        <div class="form"><input type="text" name="wr_5" id="mtel"></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">이메일</strong>
                        <div class="form"><input type="text" name="wr_email"></div>
                    </div>
                    <div class="formbox">
                        <strong class="title">&nbsp;</strong>
                        <div class="form">
                            <select name="wr_3" id="wr_3" required >
                                <option>거주지역</option>
                                <option value="서울"<?php echo $write['wr_3']=="서울"?" selected":"";?>>서울</option>
                                <option value="경기(북부 - 고양,파주,의정부 등)"<?php echo $write['wr_3']=="경기(북부 - 고양,파주,의정부 등)"?" selected":"";?>>경기(북부 - 고양,파주,의정부 등)</option>
                                <option value="경기(서부 - 김포,광명,시흥 등)"<?php echo $write['wr_3']=="경기(서부 - 김포,광명,시흥 등)"?" selected":"";?>>경기(서부 - 김포,광명,시흥 등)</option>
                                <option value="경기(남부 - 분당,과천,수원,용인 등)"<?php echo $write['wr_3']=="경기(남부 - 분당,과천,수원,용인 등)"?" selected":"";?>>경기(남부 - 분당,과천,수원,용인 등)</option>
                                <option value="경기(동부 - 구리,하남,남양주 등)"<?php echo $write['wr_3']=="경기(동부 - 구리,하남,남양주 등)"?" selected":"";?>>경기(동부 - 구리,하남,남양주 등)</option>
                                <option value="인천/부천"<?php echo $write['wr_3']=="인천/부천"?" selected":"";?>>인천/부천</option>
                                <option value="강원도"<?php echo $write['wr_3']=="강원도"?" selected":"";?>>강원도</option>
                                <option value="대전"<?php echo $write['wr_3']=="대전"?" selected":"";?>>대전</option>
                                <option value="세종"<?php echo $write['wr_3']=="세종"?" selected":"";?>>세종</option>
                                <option value="대구"<?php echo $write['wr_3']=="대구"?" selected":"";?>>대구</option>
                                <option value="광주"<?php echo $write['wr_3']=="광주"?" selected":"";?>>광주</option>
                                <option value="울산"<?php echo $write['wr_3']=="울산"?" selected":"";?>>울산</option>
                                <option value="부산"<?php echo $write['wr_3']=="부산"?" selected":"";?>>부산</option>
                                <option value="충북"<?php echo $write['wr_3']=="충북"?" selected":"";?>>충북</option>
                                <option value="충남"<?php echo $write['wr_3']=="충남"?" selected":"";?>>충남</option>
                                <option value="경북"<?php echo $write['wr_3']=="경북"?" selected":"";?>>경북</option>
                                <option value="경남"<?php echo $write['wr_3']=="경남"?" selected":"";?>>경남</option>
                                <option value="전북"<?php echo $write['wr_3']=="전북"?" selected":"";?>>전북</option>
                                <option value="전남"<?php echo $write['wr_3']=="전남"?" selected":"";?>>전남</option>
                                <option value="제주"<?php echo $write['wr_3']=="제주"?" selected":"";?>>제주</option>
                                <option value="해외"<?php echo $write['wr_3']=="해외"?" selected":"";?>>해외</option>
                                <option value="기타"<?php echo $write['wr_3']=="기타"?" selected":"";?>>기타</option>
                            </select>
                            <select name="wr_7" id="wr_7" required >
                                <option>최종학력</option>
                                <option value="대학교 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학교 졸업</option>
                                <option value="대학교 중퇴"<?php echo $write['wr_7']=="대학교 중퇴"?" selected":"";?>>대학교 중퇴</option>
                                <option value="대학교 재학"<?php echo $write['wr_7']=="대학교 재학"?" selected":"";?>>대학교 재학</option>
                                <option value="대학원 졸업"<?php echo $write['wr_7']=="대학교 졸업"?" selected":"";?>>대학원 졸업</option>
                                <option value="대학(2,3년제) 졸업"<?php echo $write['wr_7']=="대학(2,3년제) 졸업"?" selected":"";?>>대학(2,3년제) 졸업</option>
                                <option value="대학(2,3년제) 중퇴"<?php echo $write['wr_7']=="대학(2,3년제) 중퇴"?" selected":"";?>>대학(2,3년제) 중퇴</option>
                                <option value="고등학교 졸업"<?php echo $write['wr_7']=="고등학교 졸업"?" selected":"";?>>고등학교 졸업</option>
                                <option value="기타"<?php echo $write['wr_7']=="기타"?" selected":"";?>>기타</option>
                            </select>
                            <select name="wr_12" id="wr_12" required >
                                <option>나의 직업</option>
                                <option value="사무/금융직"<?php echo $write['wr_12']=="사무/금융직"?" selected":"";?>>사무/금융직</option>
                                <option value="연구원/엔지니어"<?php echo $write['wr_12']=="연구원/엔지니어"?" selected":"";?>>연구원/엔지니어</option>
                                <option value="건축/설계"<?php echo $write['wr_12']=="건축/설계"?" selected":"";?>>건축/설계</option>
                                <option value="교사 및 강사"<?php echo $write['wr_12']=="교사 및 강사"?" selected":"";?>>교사 및 강사</option>
                                <option value="공무원/공사"<?php echo $write['wr_12']=="공무원/공사"?" selected":"";?>>공무원/공사</option>
                                <option value="승무원/항공관련"<?php echo $write['wr_12']=="승무원/항공관련"?" selected":"";?>>승무원/항공관련</option>
                                <option value="서비스/영업"<?php echo $write['wr_12']=="서비스/영업"?" selected":"";?>>서비스/영업</option>
                                <option value="의사/한의사/약사"<?php echo $write['wr_12']=="의사/한의사/약사"?" selected":"";?>>의사/한의사/약사</option>
                                <option value="변호사/법조인"<?php echo $write['wr_12']=="변호사/법조인"?" selected":"";?>>변호사/법조인</option>
                                <option value="회계사 등 전문직"<?php echo $write['wr_12']=="회계사 등 전문직"?" selected":"";?>>회계사 등 전문직</option>
                                <option value="간호 및 의료사"<?php echo $write['wr_12']=="간호 및 의료사"?" selected":"";?>>간호 및 의료사</option>
                                <option value="자영업/사업"<?php echo $write['wr_12']=="자영업/사업"?" selected":"";?>>자영업/사업</option>
                                <option value="유학생/석,박사"<?php echo $write['wr_12']=="유학생/석,박사"?" selected":"";?>>유학생/석,박사</option>
                                <option value="프리랜서 및 기타"<?php echo $write['wr_12']=="기타"?" selected":"";?>>프리랜서 및 기타</option>
                            </select>
                        </div>
                    </div>
                    <div class="agree">
                        <label>
                            <input type="checkbox" name="agree" class="" id="" value=1>
                            <em></em><span>개인정보 수집 이용에 동의합니다.</span>
                        </label>
                    </div>

                    <div class="subm"><input type="submit" value="무료상담신청"></div>
                </form>
            </div>
        </div>big_form-->
        <div id="map">
            <!-- * 카카오맵 - 지도퍼가기 -->
            <!-- 1. 지도 노드 -->
            <div id="daumRoughmapContainer1717043650166" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%;"></div>

            <!--
                2. 설치 스크립트
                * 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
            -->
            <script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

            <!-- 3. 실행 스크립트 -->
            <script charset="UTF-8">
                new daum.roughmap.Lander({
                    "timestamp" : "1717043650166",
                    "key" : "2jhrc",
                    "mapWidth" : "100%",
                    "mapHeight" : "525"
                }).render();
            </script>
        </div>
        <div id="business" class="wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="0.6s">
            <div>
                <h1>진정한 삶의 동반자를 찾아드립니다.<br /><strong>마리엔</strong>에서 소중한 인연을 만나보세요.</h1>
                <h2 class="title"><span>대표전화</span><strong><?php echo $config['cf_2']; ?></strong></h2>
                <div class="cn">평일 09:00 ~ 19:00 / 주말, 공휴일 09:00 ~ 15:00 상담가능합니다.</div>
                <div class="sec03_link wow flipInX animated" data-wow-delay="0.5s" data-wow-duration="0.6s">
                    <a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna"><i class="fa-light fa-envelope"></i> 빠른상담신청 →</a>
                    <a href="<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa-light fa-clipboard-list-check"></i> 회원가입 →</a>
                </div>
            </div>
        </div>
    </div>
    <script>
		//자동하이픈 넣기
		$(document).on("keyup", "#mtel", function() {
			$(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/(^02|^0505|^1[0-9]{3}|^0[0-9]{2})([0-9]+)?([0-9]{4})/,"$1-$2-$3").replace("--", "-") );
		});
	</script>
    <script>
        function index_write_submit(f){

			if( frm.wr_name.value == "" ) {
				frm.wr_name.focus();
				alert("이름을 입력해 주세요.");
				return false;	
			}

			if(checkHan(frm.wr_name.value) == false){
                frm.wr_name.focus();
                alert("이름은 한글로만 입력해 주세요.");
                return false;
            }

			if( frm.wr_1.value == "" ) {
				frm.wr_1.focus();
				alert("생년월일을 입력해 주세요.");
				return false;	
			}
			if( frm.wr_4.value == "" ) {
				frm.wr_4.focus();
				alert("거주지역을 입력해 주세요.");
				return false;	
			}
			if( frm.wr_5.value == "" ) {
				frm.wr_5.focus();
				alert("휴대폰번호를 입력해 주세요.");
				return false;	
			}
			if (!f.agree.checked) {
				alert("개인정보 수집 및 이용에 동의하셔야 서비스를 받을 수 있습니다.");
				f.agree.focus();
				return false;
			}
			if (!f.agree02.checked) {
				alert("마케팅 활용에 동의하셔야 서비스를 받을 수 있습니다.");
				f.agree02.focus();
				return false;
			}
            return true;
        }
    </script>


    <!--<div class="main_news">
            <div class="main_tit">
                <h2>UNIKOREA <strong>NEWS</strong></h2>
                <h3>마리엔 뉴스</h3>
            </div>
            
        <div class="in_box">
            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=pro01" class="rv wow fadeInUp" data-wow-delay="0s" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/business01.jpg">
                <div class="txt">
                    <h5>UNI 성혼갤러리</h5>
                    <p>실제 매칭이 성사된<br />회원님들의 생생한 갤러리</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/business02.jpg">
                <div class="txt">
                    <h5>UNI 소식&amp;이벤트</h5>
                    <p>마리엔에서 진행하는<br />다양한 이벤트와 소식들</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

			<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna" class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/business03.jpg">
                <div class="txt">
                    <h5>UNI 온라인 상담</h5>
                    <p>회원님들과 함께<br />소통하고 나누는 공간</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>

            <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=data" class="wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                <img src="<?php echo G5_THEME_IMG_URL ?>/main_re/business04.jpg">
                <div class="txt">
                    <h5>UNI 자료실</h5>
                    <p>행복한 결혼을 위한<br />다양한 자료공간</p>
                    <span class="go_btn"><img src="<?php echo G5_THEME_IMG_URL ?>/main/go_arrow.png"></span>
                </div>
            </a>
        </div>
</div>main_news-->







<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
<?php
global $pid;
$pid = "new_service";
$sub_id = "new_service";
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

?>
<style>
    @media (max-width: 767px){
        #hd {
            display: none;
        }
    }
</style>
<section id="new_service" class="srv">
    <div class="main">
        <img src="<?php echo G5_THEME_IMG_URL ?>/land/new4.png">
    </div>
    <div class="inner">
        <h2>청년만 지원 가능한 MZ 일자리!</h2>
        <h1>잡고와 안전하게!</h1>
        <!-- 상단 콘텐츠 영역 -->
        <div class="content">
            <div class="tab-content" data-content="tab1">
                <img src="<?php echo G5_THEME_IMG_URL ?>/land/new1.png">
            </div>
            <div class="tab-content" data-content="tab2" style="display:none">
                <img src="<?php echo G5_THEME_IMG_URL ?>/land/new2.png">
            </div>
            <div class="tab-content" data-content="tab3" style="display:none">
                <img src="<?php echo G5_THEME_IMG_URL ?>/land/new3.png">
            </div>
        </div>
        <!-- 탭 메뉴 -->
        <div class="tab-menu">
            <button class="tablink" data-tab="tab1">
                <div>
                    <h2>#입소문 <br class="visible-xs">#온라인홍보</h2>
                    <h1>SNS</h1>
                    <i class="fa-solid fa-chevrons-down"></i>
                </div>
            </button>
            <button class="tablink" data-tab="tab2">
                <div>
                    <h2>#인력동원 <br class="visible-xs">#매장방문</h2>
                    <h1>체험단</h1>
                    <i class="fa-solid fa-chevrons-down"></i>
                </div>
            </button>
            <button class="tablink" data-tab="tab3">
                <div>
                    <h2>#트렌디 <br class="visible-xs">#상부상조</h2>
                    <h1>디자인</h1>
                    <i class="fa-solid fa-chevrons-down"></i>
                </div>
            </button>
        </div>
        <!-- 하단 콘텐츠 영역 -->
        <div class="content">
            <div class="tab-content" data-content="tab1">
                <h6>캠페인 참여시 혜택</h6>
                <ul>
                    <li>캠페인에 필요한 자료를 제공받아요</li>
                    <li>캠페인 미션 수행 시 잡고 캐쉬가 적립돼요.</li>
                    <li>원하는 캠페인을 골라 진행할 수 있어요.</li>
                </ul>
            </div>
            <div class="tab-content" data-content="tab2" style="display:none">
                <h6>캠페인 참여시 혜택</h6>
                <ul>
                    <li>캠페인에 따라 서비스가 제공돼요. (서비스, 상품, 음식 외)</li>
                    <li>캠페인 이용 후 미션 수행 시 잡고 캐쉬가 적립돼요.</li>
                    <li>원하는 캠페인을 골라 진행할 수 있어요.</li>
                </ul>
            </div>
            <div class="tab-content" data-content="tab3" style="display:none">
                <h6>캠페인 참여시 혜택</h6>
                <ul>
                    <li>개인 포트폴리오에 활용가능해요.</li>
                    <li>캠페인 미션 수행 시 잡고 캐쉬가 적립돼요.</li>
                    <li>원하는 캠페인을 골라 진행할 수 있어요.</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="process">
        <div class="inner">
            <h6>캠페인 진행 절차</h6>
            <ul>
                <li>
                    <p>
                        <span>1</span>
                        <b>캠페인 신청</b>
                    </p>
                    <p>캠페인을 확인하고<br>
                        취향껏 신청해요</p>
                </li>
                <li>
                    <p>
                        <span>2</span>
                        <b>캠페인 선정</b>
                    </p>
                    <p>모집 기간이 종료 되면<br>
                        캠페인 선정 여부를 알 수 있어요</p>
                </li>
                <li>
                    <p>
                        <span>3</span>
                        <b>서비스 이용</b>
                    </p>
                    <p>캠페인에 따라 제공되는<br>
                        서비스를 이용해요</p>
                </li>
                <li>
                    <p>
                        <span>4</span>
                        <b>활동 보고 및 종료</b>
                    </p>
                    <p>캠페인 필수 활동 후 완료 보고시<br>
                        혜택이 제공돼요</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_fixed">
        <a href="<?php echo G5_BBS_URL ?>/campaign_exp_list.php">캠페인 바로가기 <i class="fa-solid fa-right"></i></a>
    </div>
</section>
<script>
    document.querySelectorAll('.tablink').forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');

            // 모든 탭에서 active 클래스 제거
            document.querySelectorAll('.tablink').forEach(btn => {
                btn.classList.remove('active');
            });

            // 클릭된 탭에 active 클래스 추가
            button.classList.add('active');

            // 모든 콘텐츠 숨기기
            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });

            // 선택된 탭의 콘텐츠 보여주기
            document.querySelectorAll(`.tab-content[data-content="${tabId}"]`).forEach(content => {
                content.style.display = 'block';
            });
        });
    });

    // 기본적으로 첫 번째 탭을 활성화
    document.querySelector('.tablink[data-tab="tab1"]').click();


</script>
<?php
include_once(G5_PATH.'/tail.php');
?>
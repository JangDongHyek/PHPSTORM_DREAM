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
<section id="new_service" class="cpn">
    <div class="main">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/slide1.png">
    </div>
    <div class="inner">
        <h2>청년 인재가 필요한 곳이라면?</h2>
        <h1>잡고가 소개해드려요!</h1>
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
                <h6>이런 업체에게 추천합니다</h6>
                <ul>
                    <li>서비스 제공은 할 수 없지만 홍보가 필요해요</li>
                    <li>요즘 뜨는 SNS로 홍보하고 싶어요</li>
                    <li>간단하고 다량의 콘텐츠가 필요해요</li>
                    <li>특정 타겟(성별, 나이, 관심사)의 활동을 희망해요</li>
                </ul>
            </div>
            <div class="tab-content" data-content="tab2" style="display:none">
                <h6>이런 업체에게 추천합니다</h6>
                <ul>
                    <li>매장에 방문해  우리 서비스(상품)을 체험하면 좋겠어요</li>
                    <li>X월 X일 행사 장소에 방문객으로 참석해주면 좋겠어요</li>
                    <li>매장을 실이용해본 온라인 후기가 필요해요</li>
                    <li>특정 타겟(성별, 나이, 관심사)의 집단 방문을 희망해요</li>
                </ul>
            </div>
            <div class="tab-content" data-content="tab3" style="display:none">
                <h6>이런 업체에게 추천합니다</h6>
                <ul>
                    <li>젊은 감각의 디자인이 필요해요</li>
                    <li>저렴한 가격으로 의뢰하고 싶어요</li>
                    <li>다량의 콘텐츠가 필요해요</li>
                    <li>전문 인력에게 맡기고 싶어요</li>
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
                        <b>광고 문의</b>
                    </p>
                    <p>상담 신청 시, 담당자와<br>
                        캠페인에 대한 상담 진행</p>
                </li>
                <li>
                    <p>
                        <span>2</span>
                        <b>컨설팅 진행</b>
                    </p>
                    <p>캠페인 규모에 알맞는 적절한<br>
                        모집 인원 및 진행 비용 책정</p>
                </li>
                <li>
                    <p>
                        <span>3</span>
                        <b>계약완료</b>
                    </p>
                    <p>캠페인 진행 가이드라인 컨펌 후<br>
                        청년 인재 모집 및 선정</p>
                </li>
                <li>
                    <p>
                        <span>4</span>
                        <b>진행 및 완료</b>
                    </p>
                    <p>캠페인 일정에 따른 모집 진행<br>
                        및 인원 선정, 활동 완료 보고</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="btn_fixed">
        <a data-toggle="modal" href="#campaignCs">협업문의 <i class="fa-solid fa-right"></i></a>
    </div>
</section>

    <!-- 협업문의 -->
    <div class="modal fade" id="campaignCs" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">협업문의 </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>업체명</p>
                    <input type="text" id="" placeholder="업체명을 작성하세요.">

                    <p>담당자명</p>
                    <input type="text" id="" placeholder="담당자명을 작성하세요.">

                    <p>연락처</p>
                    <input type="text" id="" placeholder="연락처를 작성하세요.">
                    
                    <p>협업 문의</p>
                    <textarea placeholder="협업 문의을 작성하세요."></textarea>
                    
                    <p>첨부 파일</p>
                    <div class="file-input-container">
                        <input type="text" id="fileName" placeholder="파일을 선택해주세요" readonly>
                        <input type="file" id="fileInput" accept="*/*">
                        <button type="button" class="btn btn_color btn_h40" onclick="document.getElementById('fileInput').click();">파일 선택</button>
                    </div>

                    <script>
                        document.getElementById('fileInput').addEventListener('change', function() {
                            var fileName = this.files[0].name;
                            document.getElementById('fileName').value = fileName;
                        });
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">제출하기</button>
                </div>

            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 협업문의 모달창 -->
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
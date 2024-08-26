<?php
global $pid;
$pid = "compete_view";
$sub_id = "compete_view";
include_once('./_common.php');

$g5['title'] = '공모전 상세';
include_once('./_head.php');
?>

    <div class="wrapper" id="com_view">

    <!--아이템정보 왼쪽-->
        <div class="scroll_content">

            <!--이미지롤링-->
            <!-- Swiper -->
            <div class="swiper comSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
                    <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".comSwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    autoHeight : true,
                });
            </script>

            <div class="com_info">
                <div id="cam_count" class="flex ai-c gap10">
                    <div class="mb flex gap5 ai-c">
                        <div class="count">
                            <b class="">접수중</b>
                        </div>
                        <p>카테고리 · 조회수 0</p>
                    </div>
                    <div class="heart male-auto" name="">
                        <button type="button" class="heart off"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_off.png" alt="좋아요off" title="좋아요off"></button>
                    </div>
                </div>
                <header>
                    <h6 class="item_tit">공모전 제목</h6>
                    <p class="txt_color">업체명</p>
                </header>
                <div id="cam_info"class="flex ai-c gap10">
                    <span>
                        <p class="flex ai-c jc-sb">
                            <span>접수기간</span>
                            <span>2024.09.01까지</span>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>심사기간</span>
                            <span>2024.10.01까지</span>
                        </p>
                    </span>
                    <span>
                        <p class="txt_mini text-right">
                            <span class="txt_mini">0명의 참가자</span>
                        </p>
                        <p class="text-right">
                            <span class="txt_mini">1등 * 1명</span>
                            총상금 <b class="txt_color">0원</b>
                        </p>
                    </span>
                </div>
                <button type="button" class="btn btn_large btn_color" data-toggle="modal" href="#competeSubmit">참여하기 </button>
            </div>
        </div>
        <div class="tabs">
            <div class="tab-menu">
                <button class="tab-button active" data-tab="tab1">공모전 의뢰 내용</button>
            </div>
            <div class="tab-content active" id="tab1">

                <div class="contest_cont">
                    <section>
                        <h3 class="title">상세내용</h3>
                        <div class="cont" style="white-space: pre-wrap;"></div>
                    </section>
                    <section>
                        <h3 class="title">선호하는 디자인</h3>
                        <div class="flex ai-s gap10 sample">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                            <img src="<?php echo G5_THEME_IMG_URL ?>/main/no_img.jpg">
                        </div>
                    </section>
                    <section>
                        <h3 class="title">참고자료</h3>
                        <div class="cont"></div>
                    </section>
                </div><!--//contest_cont-->
            </div>
        </div>
    </div>


    <!-- 공모전 참여 -->
    <div class="modal fade" id="competeSubmit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">공모전 참여 </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <p>제출 파일</p>
                    <div class="file-input-container">
                        <input type="text" id="fileName" placeholder="파일을 선택해주세요" readonly>
                        <input type="file" id="fileInput" accept="*/*">
                        <button type="button" class="btn btn_color btn_h40" onclick="document.getElementById('fileInput').click();">파일 선택</button>
                    </div>

                    <p>추가 설명</p>
                    <textarea placeholder="설명을 작성하세요."></textarea>

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
    <!-- // 공모전 참여  모달창 -->

<?php
include_once('./_tail.php');
?>
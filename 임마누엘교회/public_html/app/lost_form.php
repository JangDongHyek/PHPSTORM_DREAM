<?php
$pid = "lost_form";
include_once("./app_head.php");

?>
    <div id="lost" class="form">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./lost'"><i class="fa-solid fa-arrow-left"></i> 분실 목록</button>
        <div class="box_radius box_white table">
            <span class="txt_color">*</span> <span class="txt_gray">표시된 항목은 필수기입 항목입니다.</span>
            <div class="table">
                <table>
                    <tbody>
                    <tr class="top">
                        <td>품목 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>분실장소 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr class="top">
                        <td>분실일시 <span class="txt_color">*</span></td>
                        <td>
                            <div class="date-container">
                                <input type="date" class="date-input" aria-label="날짜 선택" />
                                <label for="date-input" class="date-placeholder-label">날짜를 선택해주세요</label>
                            </div>
                            <div class="date-container">
                                <input type="time" class="time-input" />
                                <label for="date-input" class="date-placeholder-label">시간을 선택해주세요</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>특징 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text" placeholder="최대한 자세히 작성해주세요">
                        </td>
                    <tr>
                    <tr>
                        <td>사진</td>
                        <td>
                            <div class="flex gap5">
                                <div class="uploader" data-id="1">사진 선택</div>
                                <div class="uploader" data-id="2">사진 선택</div>
                                <div class="uploader" data-id="3">사진 선택</div>
                                <input type="file" id="file-input" accept="image/*" style="display: none;">
                            </div>
                        </td>
                    <tr>
                        <td>분실인 <span class="txt_color">*</span></td>
                        <td>
                            <input type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>연락처</td>
                        <td>
                            <input type="text" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>교구/속</td>
                        <td>
                            <input type="text" placeholder="교회를 통해 연락 받길 원하면 작성해주세요">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <button type="button" class="btn btn_color btn-large" onclick="location.href='./lost'">신청하기</button>
        </div>
    </div>


    <script>
        // 파일 입력 요소와 업로더 DIV들 가져오기
        const fileInput = document.getElementById('file-input');
        const uploaders = document.querySelectorAll('.uploader');

        // 업로더 클릭 이벤트 처리
        uploaders.forEach((uploader) => {
            uploader.addEventListener('click', () => {
                const id = uploader.dataset.id; // 각 업로더의 고유 ID 가져오기
                fileInput.dataset.target = id; // 파일 입력의 타겟을 설정
                fileInput.click(); // 파일 선택창 열기
            });
        });

        // 파일 선택 시 프리뷰 생성
        fileInput.addEventListener('change', (event) => {
            const files = event.target.files;
            if (files.length > 0) {
                const file = files[0];
                const targetId = fileInput.dataset.target;
                const targetUploader = document.querySelector(`.uploader[data-id="${targetId}"]`);

                // 파일 읽기 및 이미지 미리보기 생성
                const reader = new FileReader();
                reader.onload = (e) => {
                    targetUploader.style.background = "none"; // 텍스트 제거
                    if (!targetUploader.querySelector('img')) {
                        const img = document.createElement('img');
                        targetUploader.appendChild(img);
                    }
                    targetUploader.querySelector('img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.date-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            const dateInputs = document.querySelectorAll('.time-input');

            dateInputs.forEach(dateInput => {
                // 포커스 시 'hide' 클래스를 추가하여 안내 문구를 숨김
                dateInput.addEventListener('focus', () => {
                    dateInput.classList.add('filled');
                }, { once: true }); // { once: true } 옵션으로 이벤트가 한 번만 실행되도록 설정
            });
        });
    </script>




<?php
include_once("./app_tail.php");
?>
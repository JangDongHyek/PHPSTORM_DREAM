<? 
include_once('./_common.php');

$g5['title'] = '프로젝트 의뢰';
include_once('./_head.php');
$name = "project_form";
$pid = "project_form";
?>

<div id="area_project">
    <div class="inr v2 project-form">
        <h3>프로젝트 지원</h3>

        <div class="project-item">
            <a href="./project_view.php" class="project-link">
                <div class="thumb">
                    <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="프로젝트 이미지">
                </div>
                <div class="project-cont">
                    <div class="project-info">
                        <div class="project-category">
                            1차 카테고리 · 2차 카테고리
                        </div>
                        <h2 class="project-title">프로젝트명</h2>
                        <p class="project-desc">프로젝트 설명입니다.</p>
                    </div>
                    <div class="project-user">
                        <div class="user-info">
                            <img src="http://itforone.com/~broadcast/theme/basic_app/img/noimg.jpg" alt="유저 프로필" class="user-img">
                            <span class="user-name">의뢰인</span>
                        </div>
                        <div class="view-count">👁️ 1,662</div>
                    </div>
                </div>
                <ul class="prize-info">
                    <li><span>🏆 총 상금</span> 80만 원</li>
                    <li><span>📌 참여작</span> 21개</li>
                    <li><span>📅 진행 기간</span> 6일</li>
                    <li><span>📆 날짜</span> 25.02.05 ~ 25.02.11</li>
                </ul>
            </a>
        </div>
        <form>
            <div class="box_write">
                <h4>작품명</h4>
                <div class="cont">
                    <input name="" id="" type="text" maxlength="30" placeholder="7자이상 30자 이하">
                </div>
            </div>
            <div class="box_content">
                <div class="box_write02">
                    <h4 class="b_tit">작품 사용</h4>
                    <div class="cont">
                        <textarea></textarea><!--에디터 말고 textarea 사용-->
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="box_write02">
                    <h4 class="b_tit">작품 이미지
                        <em><i class="point" id="img_count">0</i>/10</em>
                        <span id="img_limit_msg" style="color: red; display: none;">작품 이미지는 최대 10장입니다.</span>
                    </h4>
                    <div class="cont">
                        <div class="area_box">
                            <ul class="photo_list" id="file_list"></ul>

                            <input type="file" id="input_file" multiple accept="image/*" style="display: none;">

                            <div id="fileDrag" class="img_wrap">
                                <div class="area_txt">
                                    <div class="area_img">
                                        <img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_upload.svg" alt="업로드 아이콘">
                                    </div>
                                    <span class="w">마우스로 드래그해서 파일을 추가하세요.</span>
                                    <span class="m">파일을 추가하세요.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_write">
                <h4>첨부파일</h4>
                <div class="cont">
                    <label class="file-upload">
                        파일 선택
                        <input type="file" id="fileInput">
                    </label>
                    <p class="file-name" id="fileName">선택된 파일 없음</p>
                </div>
            </div>

            <button type="button" class="project-add" onclick="location.href='./mypage_project_my.php'">프로젝트 지원하기</button>
        </form>
    </div>
</div>


    <script>
        document.getElementById("fileInput").addEventListener("change", function () {
            let fileName = this.files.length > 0 ? this.files[0].name : "선택된 파일 없음";
            document.getElementById("fileName").textContent = fileName;
        });
    </script>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        let images = [];
        const fileList = document.getElementById("file_list");
        const imgCount = document.getElementById("img_count");
        const imgLimitMsg = document.getElementById("img_limit_msg");
        const inputFile = document.getElementById("input_file");
        const fileDrag = document.getElementById("fileDrag");

        function updateList() {
            fileList.innerHTML = images.map((img, i) => `
            <li class="file_1">
                <div class="area_img">
                    <img src="${img}" width="100">
                    <div class="area_delete" onclick="removeImage(${i})"></div>
                </div>
            </li>
        `).join("");

            imgCount.textContent = images.length;
            imgLimitMsg.style.display = images.length > 10 ? "block" : "none";
        }

        function handleFiles(files) {
            if (images.length >= 10) return alert("최대 10장까지만 업로드할 수 있습니다.");
            [...files].forEach(file => {
                if (!file.type.startsWith("image/")) return;
                const reader = new FileReader();
                reader.onload = e => {
                    if (images.length < 10) images.push(e.target.result);
                    updateList();
                };
                reader.readAsDataURL(file);
            });
        }

        window.removeImage = i => {
            images.splice(i, 1);
            updateList();
        };

        inputFile.addEventListener("change", e => handleFiles(e.target.files));
        fileDrag.addEventListener("click", () => inputFile.click());
        fileDrag.addEventListener("drop", e => { e.preventDefault(); handleFiles(e.dataTransfer.files); });
        fileDrag.addEventListener("dragover", e => e.preventDefault());
    });


</script>

<?php
include_once('./_tail.php');
?>
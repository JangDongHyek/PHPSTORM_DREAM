<!--광고배너 등록-->
<section class="from">
    <div>
        <button type="button" class="btn btn_small btn_line" onclick="location.href='./company'">목록</button>
        <button type="button" class="btn btn_small btn_color" onclick="">등록 완료</button>
    </div>
    <hr>
    <h4>업체 정보</h4>
    <div class="box_gray">
        <div class="grid grid2">
            <dl class="form_wrap">
                <dt>구분</dt>
                <dd class="select">
                    <input type="radio" id="main-banner" name="banner" value="1">
                    <label for="main-banner">메인 배너</label>
                    <input type="radio" id="sub-banner" name="banner" value="2">
                    <label for="sub-banner">서브 배너</label>
                </dd>
            </dl>
        </div>
        <br>
        <dl class="form_wrap">
            <dt>
                <label for="">PC 이미지 등록</label>
                <p class="txt_color txt_down">※ 메인 배너 PC 이미지는 1600X400사이즈를 권장합니다</p>
                <p class="txt_color txt_down">※ 서브 배너 PC 이미지는 1600X300사이즈를 권장합니다</p>
            </dt>
            <dd>
                <div class="flex ai-c gap5">
                    <label for="upload" class="btn btn_black">이미지 등록</label>
                    <input type="file" id="upload" style="display: none;" accept="image/*" onchange="handleFileSelect(event)">
                    <span id="file-name">메인 이미지를 선택하세요..</span>
                    <a class="btn btn_mini btn_line" id="delete-btn" style="display: none;" onclick="deleteImage()">삭제</a>
                </div>
            </dd>
            <dt>
                <label for="">모바일 이미지 등록</label>
                <p class="txt_color txt_down">※ 메인 배너 모바일 이미지는 900X450사이즈를 권장합니다</p>
                <p class="txt_color txt_down">※ 서브 배너 모바일 이미지는 900X225사이즈를 권장합니다</p>
            </dt>
            <dd>
                <div class="flex ai-c gap5">
                    <label for="upload" class="btn btn_black">이미지 등록</label>
                    <input type="file" id="upload" style="display: none;" accept="image/*" onchange="handleFileSelect(event)">
                    <span id="file-name">메인 이미지를 선택하세요..</span>
                    <a class="btn btn_mini btn_line" id="delete-btn" style="display: none;" onclick="deleteImage()">삭제</a>
                </div>
            </dd>
            <dt><label for="">기간</label></dt>
            <dd class="flex ai-b"><input type="date"/> ~ <input type="date"/></dd>
            <dt><label for="">메모</label></dt>
            <dd><input type="text" placeholder="메모"/></dd>
            <dt><label for="">연결 링크</label></dt>
            <dd><input type="text" placeholder="연결 링크"/></dd>
        </dl>
    </div>
</section>

<script>
    //이미지 첨부
    function handleFileSelect(event) {
        const file = event.target.files[0];
        const fileName = document.getElementById('file-name');
        const deleteBtn = document.getElementById('delete-btn');

        if (file) {
            fileName.textContent = file.name;  // 선택된 파일명을 표시
            deleteBtn.style.display = 'flex';  // 삭제 버튼 표시
        }
    }

    function deleteImage() {
        const uploadInput = document.getElementById('upload');
        const fileName = document.getElementById('file-name');
        const deleteBtn = document.getElementById('delete-btn');

        // 선택된 파일 리셋
        uploadInput.value = '';
        fileName.textContent = '이미지를 선택하세요..';  // 기본 메시지로 되돌림
        deleteBtn.style.display = 'none';  // 삭제 버튼 숨김
    }
</script>
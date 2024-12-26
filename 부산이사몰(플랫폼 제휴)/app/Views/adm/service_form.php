<!--홈서비스 등록-->
<section class="from">
    <div>
        <button type="button" class="btn btn_small btn_line" onclick="location.href='./service'">목록</button>
        <button type="button" class="btn btn_small btn_color" onclick="">등록 완료</button>
    </div>
    <hr>
    <h4>업체 정보</h4>
    <div class="box_gray">
        <div class="grid grid2">
            <dl class="form_wrap">
                <dt><label for="">업체명</label></dt>
                <dd><input type="text" name="" id="" placeholder="업체명"/></dd>
                <dt><label for="">주소</label></dt>
                <dd><input type="text" name="" id="" placeholder="주소"/></dd>
                <dt><label for="">연락처</label></dt>
                <dd><input type="tel" name="" id="" placeholder="연락처"/></dd>
            </dl>
            <dl class="form_wrap">
                <dt><label for="">구분</label></dt>
                <dd>
                    <select>
                        <option>구분 선택</option>
                        <option>에어컨</option>
                        <option>이사청소</option>
                        <option>부동산</option>
                        <option>추천업소</option>
                    </select>
                </dd>
                <dt><label for="">지역 선택</label></dt>
                <dd class="flex">
                    <select>
                        <option>부산</option>
                        <option>울산</option>
                        <option>경남</option>
                    </select>
                    <select>
                        <option>구/군</option>
                    </select>
                </dd>
            </dl>
        </div>
        <br>
        <dl class="form_wrap">
            <dt><label for="">간단 소개</label></dt>
            <dd><textarea placeholder=""></textarea></dd>
            <dt>
                <label for="">메인 이미지 등록</label>
                <p class="txt_color txt_down">※메인 이미지는 900X500사이즈를 권장합니다</p>
            </dt>
            <dd>
                <div class="flex ai-c gap5">
                    <label for="upload" class="btn btn_black">이미지 등록</label>
                    <input type="file" id="upload" style="display: none;" accept="image/*" onchange="handleFileSelect(event)">
                    <span id="file-name">메인 이미지를 선택하세요..</span>
                    <a class="btn btn_mini btn_line" id="delete-btn" style="display: none;" onclick="deleteImage()">삭제</a>
                </div>
            </dd>
        </dl>
    </div>
    <hr>
    <h4>연결 주소</h4>
    <div class="box_gray">
        <div class="grid grid2">
            <dl class="form_wrap">
                <dt><label for="">홈페이지</label></dt>
                <dd><input type="text" name="" id="" placeholder="홈페이지 주소"/></dd>
                <dt><label for="">블로그</label></dt>
                <dd><input type="text" name="" id="" placeholder="블로그 주소"/></dd>
                <dt><label for="">인스타그램</label></dt>
                <dd><input type="text" name="" id="" placeholder="인스타그램 주소"/></dd>
            </dl>
            <dl class="form_wrap">
                <dt><label for="">유튜브</label></dt>
                <dd><input type="text" name="" id="" placeholder="유튜브 주소"/></dd>
                <dt><label for="">틱톡</label></dt>
                <dd><input type="text" name="" id="" placeholder="틱톡 주소"/></dd>
            </dl>
        </div>
        <!--등록된 해당 링크만 상세 페이지에 아이콘이 추가됩니다.-->
    </div>
    <hr>
    <h4>서비스 설명</h4>
    <div class="box_gray">
        <div class="editor">
            <textarea placeholder="에디터 추가"></textarea>
        </div>
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
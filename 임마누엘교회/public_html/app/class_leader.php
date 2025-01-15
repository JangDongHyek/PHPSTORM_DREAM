<?php
$pid = "class_leader";
include_once("./app_head.php");

?>
    <div id="class" class="leader">
        <button class="btn btn_large btn_back" type="button" onclick="location.href='./class'"><i class="fa-solid fa-arrow-left"></i> 속회방 메인</button>
        <div class="wrap">
            <button class="btn" type="button" data-toggle="modal" data-target="#classDataModal"><i class="fa-solid fa-book-medical"></i>이번주 속회공부 자료</button>
            <button class="btn" type="button" data-toggle="modal" data-target="#classNotiModal"><i class="fa-sharp fa-solid fa-quote-left"></i>속회소식 작성</button>
            <button class="btn" type="button" onclick="location.href='./class_noti'"><i class="fa-solid fa-align-left"></i>지난 속회보고 열람</button>
        </div>
    </div>

    <div class="modal fade" id="classDataModal" tabindex="-1" role="dialog" aria-labelledby="classNotiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="classNotiModalLabel">속회공부 자료</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>제 *과</label>
                    <input type="number">
                    <label>제목</label>
                    <input type="text">
                    <label>자료</label>
                    <div>
                        <!-- 숨겨진 파일 입력 요소 -->
                        <input type="file" id="file-input" class="file-input">
                        <!-- 커스텀 파일 입력 라벨 -->
                        <label for="file-input" class="custom-file-label">파일 선택</label>
                        <!-- 선택된 파일 이름을 표시할 요소 -->
                        <span class="file-name" id="file-name">선택된 파일 없음</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-default">작성</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // JavaScript를 사용하여 파일 이름 표시 업데이트
        const fileInput = document.getElementById('file-input');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            } else {
                fileNameDisplay.textContent = '선택된 파일 없음';
            }
        });
    </script>
    <div class="modal fade" id="classNotiModal" tabindex="-1" role="dialog" aria-labelledby="classNotiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="classNotiModalLabel">속회보고</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <textarea placeholder="속회소식를 작성하세요."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                    <button type="button" class="btn btn-default">작성</button>
                </div>
            </div>
        </div>
    </div>
<?php
include_once("./app_tail.php");
?>
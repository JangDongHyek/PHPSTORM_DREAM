<?php
$pid = "class_leader";
include_once("./app_head.php");
include_once("../jl/JlConfig.php");
?>
<div id="app">
    <class-leader></class-leader>
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


<?
$jl->vueLoad('app');
$jl->componentLoad("/class");
$jl->componentLoad("/item");
$jl->componentLoad("/external");
?>

<?php
include_once("./app_tail.php");
?>
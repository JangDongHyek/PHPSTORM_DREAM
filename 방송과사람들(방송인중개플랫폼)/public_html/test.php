<?php
include_once ("./jl/JlConfig.php");
?>

<div id="app">
    <external-summernote></external-summernote>
</div>

<?php $jl->vueLoad("app");?>
<?php $jl->componentLoad("external");?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="plugin/summernote/summernote.min.js"></script>
<link rel="stylesheet" href="plugin/summernote/summernote.min.css">

<script>
    //$(document).ready(function() {
    //    $('#editor').summernote({
    //        height: 400,
    //        lang: 'ko-KR',
    //        toolbar: [
    //            // 기본 툴바 설정
    //            ['font', ['bold', 'underline', 'clear']],
    //            ['fontsize', ['fontsize']],
    //            ['color', ['color']],
    //            ['para', ['paragraph']], //'ul', 'ol',
    //            ['insert', ['picture', 'link']], // 이미지 삽입 버튼 추가
    //            // 플러그인 버튼 추가
    //            ['view', ['undo', 'redo']],
    //        ],
    //        fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '28', '30', '36', '50', '72'],
    //        placeholder: '내용을 입력해 주세요',
    //        popover: {
    //            image: [
    //                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
    //                ['float', ['floatLeft', 'customFloatCenter', 'floatRight', 'floatNone']],
    //                ['remove', ['removeMedia']]
    //            ]
    //        },
    //
    //
    //    });
    //
    //    //$('#editor').summernote('code', 'ss'); // 에디터 내용 불러오기
    //});
</script>
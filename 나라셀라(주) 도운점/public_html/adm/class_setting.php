<?php
$sub_menu = "350100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'w');

$g5['title'] = 'CLASS - 세팅';
include_once('./admin.head.php');

$class_idx = empty($_GET['class_idx'])? 0 : $_GET['class_idx'];

$settingType = empty($class_idx)? 'insert' : 'update';
$info = array(
    'thumbnailImgJson' => array()
);

if($settingType == 'update'){
    $info = getClassInfo($class_idx);    
}

?>
<style>
    table tr:hover {
        background: unset !important;
    }
    
    tbody td{
        text-align: left;
    }
</style>

<link rel="stylesheet" href="./css/bootstrap.min.3.3.2.css">
<link rel="stylesheet" href="./css/summernote.min.css">

<script src="./js/bootstrap.min.3.3.2.js"></script>
<script src="./js/summernote.min.js"></script>
<script src="./js/summernote-ko-KR.js"></script>

<div class="tbl_frm01 tbl_wrap">
    <table>
        <tbody>
            <tr>
                <th scope="row">위치</th>
                <td colspan="3">
                    <? foreach(CLASS_FLOOR as $key=>$data){ ?>
                    <input type="radio" name="floor" class="floor" id="floor<?=$key?>" value="<?=$key?>" <?=$info['floor'] == $key? 'checked' : ''?>>
                    <label for="floor<?=$key?>"><?=$key.'F - '.$data?></label>
                    <? } ?>
                </td>
            </tr>
            <tr>
                <th scope="row">CLASS명</th>
                <td colspan="3"><input type="text" id="className" value="<?=$info['className']?>" class="required frm_input" style="width:500px;"></td>
            </tr>
            <tr>
                <th scope="row">대표이미지</th>
                <td colspan="3">
                    <input id="thumbnailController" type="file" class="hide" accept="image/*" />

                    <button id="btnSetThumnail" class="btn_submit" onclick="setThumbnailImg()">이미지<?=empty($info['thumbnail'])? '등록' : '수정'?></button>
                    
                    <div class="img" style="width: 250px; display: inline-block;">
                        <img id="thumbnail" src="<?=$info['thumbnail']?>" class="<?=empty($info['thumbnail'])? 'hide' : ''?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row">CLASS 시간</th>
                <td colspan="3">
                    <span class="hy">날짜 - </span>
                    <input type="date" id="eventDate" value="<?=$info['eventDate']?>" class="required frm_input">
                    <span class="hy">시작시간 - </span>
                    <input type="time" id="eventTime1" value="<?=$info['eventTime1']?>" class="required frm_input">
                    <span class="hy">종료시간 - </span>
                    <input type="time" id="eventTime2" value="<?=$info['eventTime2']?>" class="required frm_input">
                </td>
            </tr>
            <tr>
                <th scope="row">정원</th>
                <td colspan="3"><input type="number" id="maxPerson" value="<?=$info['maxPerson']?>" class="required frm_input"></td>
            </tr>

            <tr>
                <th scope="row">가격</th>
                <td colspan="3"><input type="number" id="price" value="<?=$info['price']?>" class="required frm_input"></td>
            </tr>
            <tr>
                <th scope="row">설명글</th>
                <td colspan="3"><textarea id="content" style="max-width:650px;"><?=$info['content']?></textarea></td>
            </tr>
            <tr>
                <th scope="row">클래스정보</th>
                <td colspan="3">
                    <textarea id="tmpClassContent" class="hide"><?=$info['classContent']?></textarea>
                    <div id="classContent"></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="저장" class="btn_submit" onclick="setClass()">
</div>

<script>
    const $class_idx = <?=$class_idx?>;
    const G5_CLASS_THUMBNAIL_URL = '<?=G5_CLASS_THUMBNAIL_URL?>';

    var thumbnailImgArr = <?=json_encode($info['thumbnailImgJson']);?>;    

    function init(){
        let $classContent = $('#classContent');
        
        $classContent.summernote({
            height: 450,
            lang: 'ko-KR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                //['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'undo', 'redo']],
            ],            
        });
        
        /* 수정일 경우 */
        if($class_idx > 0){            
            $classContent.summernote('code', $("#tmpClassContent").val());
        }
    }
    
    async function setClass() {

        let $floor = $('.floor:checked'),
            $className = $('#className'),
            $eventDate = $('#eventDate'),
            $eventTime1 = $('#eventTime1'),
            $eventTime2 = $('#eventTime2'),
            $maxPerson = $('#maxPerson'),
            $price = $('#price'),
            $content = $('#content'),
            $classContent = $('#classContent');                

        if (!$floor.val()) {
            showAlert('위치를 선택해주세요.', $('.floor').focus());
            return;
        } else if (!$className.val()) {
            showAlert('CLASS명을 입력해주세요.', $className.focus());
            return;
        } else if (!thumbnailImgArr.length) {
            showAlert('대표이미지를 등록해주세요.', setThumbnailImg());
            return;
        } else if (!$eventDate.val()) {
            showAlert('날짜를 입력해주세요.', $eventDate.focus());
            return;
        } else if (!$eventTime1.val()) {
            showAlert('시작시간을 입력해주세요.', $eventTime1.focus());
            return;
        } else if (!$eventTime2.val()) {
            showAlert('종료시간을 입력해주세요.', $eventTime2.focus());
            return;
        } else if (!$maxPerson.val()) {
            showAlert('정원을 입력해주세요.', $maxPerson.focus());
            return;
        } else if (!$price.val()) {
            showAlert('가격을 입력해주세요.', $price.focus());
            return;
        } else if (!$content.val()) {
            showAlert('설명글을 입력해주세요.', $content.focus());
            return;
        }

        const setClassRes = await postJson(getAjaxUrl('class'), {
            mode: 'setClass',
            class_idx: $class_idx,
            floor: $floor.val(),
            className: $className.val(),
            thumbnailImgArr : thumbnailImgArr,
            eventDate: $eventDate.val(),
            eventTime1: $eventTime1.val(),
            eventTime2: $eventTime2.val(),
            maxPerson: $maxPerson.val(),
            price: $price.val(),
            content: $content.val(),
            classContent: $classContent.summernote('code')
        });

        if (!setClassRes.result) {
            showAlert(setClassRes.msg);
            return;
        }

        showAlert("저장되었습니다.")
            .then(() => {
                location.href = "./class_list.php";
            });
    }

    function setThumbnailImg() {
        $('#thumbnailController').click();
    }

    async function readThumbnailImg(input) {
        if (!input.files.length) return;

        let formData = new FormData();

        for (let i = 0; i < input.files.length; i++) {
            let file = input.files[i],
                extension = file.name.split('.').pop().toLowerCase(),
                imgFileTypes = ['jpg', 'jpeg', 'png', 'gif'],
                isImage = imgFileTypes.indexOf(extension) > -1;

            if (!isImage) {
                showAlert('이미지 파일만 업로드가능합니다.');
                return;
            }
            formData.append('files[]', file);
        }

        formData.append('mode', 'setClassThumbnail');
        const setThumbnailImgRes = await postFormJson(getAjaxUrl('class'), formData);

        if (!setThumbnailImgRes.result) {
            swal(setThumbnailImgRes.msg);
            return false;
        }

        thumbnailImgArr = setThumbnailImgRes.files;

        $('#btnSetThumnail').text("이미지수정");
        $('#thumbnail').attr('src', `${G5_CLASS_THUMBNAIL_URL}${thumbnailImgArr[0].fileName}`).removeClass('hide');
        input.value = '';
    }

    $(function() {
        $('#thumbnailController').on('change', function() {
            readThumbnailImg(this);
        });
        
        init();
    });
</script>

<?php
include_once('./admin.tail.php');
?>
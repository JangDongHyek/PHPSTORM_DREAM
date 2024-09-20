<?php
$sub_menu = "251100";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

$model = new JlModel(array(
    "table" => "campaign",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

auth_check($auth[$sub_menu], 'w');

if ($w == '')
{
    $sound_only = '<strong class="sound_only">필수</strong>';
    $html_title = '추가';
}

if($_GET['idx']) {
    $w = 'u';
    $model->where("idx",$_GET['idx']);
    $results = $model->get();

    if(!$results['count']) {
        echo "해당 idx가 존재하지않는 잘못된접근입니다.";
        die();
    }else {
        $data = $results['data'][0];

    }
}

$g5['title'] = '캠페인 '.$html_title;
include_once('./admin.head.php');

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨


?>
<style>
  .form.photo_in .photo {
        float: left;
        margin-right: 5px;
        margin-bottom: 5px;
        border: 1px solid #f1f1f1;
        background: #fff;
        width: 60px;
        height: 60px;
        z-index: 1;
        position: relative;
    }

 .form.photo_in .photo .btn_del {
     position: absolute;
     background: rgba(0, 0, 0, 0.5);
     width: 18px;
     height: 18px;
     line-height: 18px;
     border: 0;
     border-radius: 50%;
     right: -3px;
     top: -4px;
     color: #fff;
     font-size: 0.8em;
     z-index: 10;
 }
   .form label {
       display: block;
       color: #bfbfbf;
       font-size: 1.1em;
       font-weight: 500;
   }
  .photo_in .pbtn {
      display: block;
      position: absolute;
      left: 0;
      top: 0;
      font-size: 2em;
      width: 100%;
      height: 100%;
      line-height: 60px;
      background: #fff;
      text-align: center;
      border: 0;
  }
 .form input {
      display: none;
  }
</style>

<form name="fmember" id="fmember" action="./campaign_form_update.php" onsubmit="return campaignSubmit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">

<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?=$_GET['idx']?>">
<input type="hidden" id="thumb_del" name="thumb_del" value="">
<input type="hidden" id="company_thumb_del" name="company_thumb_del" value="">
<input type="hidden" id="basic_guide" name="basic_guide" value="">



<!--<input type="hidden" name="mb_level" value="--><?//=$mb['mb_level']?><!--">-->
<?php //for ($i=1; $i<=10; $i++) { ?>
<!--<input type="hidden" name="mb_--><?php //echo $i ?><!--" value="--><?php //echo $mb['mb_'.$i] ?><!--" id="mb_--><?php //echo $i ?><!--">-->
<?php //} ?>


<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="cp_category1">카테고리<strong class="sound_only">필수</strong></label></th>
        <td>
            <select id="cp_category1" name="category" class="frm_input">
                <option value="">카테고리</option>
                <option value="SNS" <?=$data['category'] == 'SNS' ? 'selected' : ''?>>SNS</option>
                <option value="디자인" <?=$data['category'] == '디자인' ? 'selected' : ''?>>디자인</option>
                <option value="체험단" <?=$data['category'] == '체험단' ? 'selected' : ''?>>체험단</option>
            </select>
        </td>
        <th scope="row"><label for="">모집인원<strong class="sound_only">필수</strong></label></th>
        <td>
            <input type="text" name="recruitment" value="<?=$data['recruitment']?>" class="frm_input" size="20">명
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="mb_id">업체 아이디</label></th>
        <td style="width: 30%">
            <input  type="text" name="company_id" value="<?= $data['company_id']?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="cp_company_name">업체명</label></th>
        <td>
            <input type="text" name="company_name" value="<?=$data['company_name'] ?>" class="frm_input" size="40">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">업체 영업시간</label></th>
        <td>
            <input type="text" name="company_time" value="<?= $data['company_time']?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="">업체 대표전화</label></th>
        <td>
            <input type="text" name="company_tel" value="<?= $data['company_tel']?>" class="frm_input" size="40">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="">업체 주소</label></th>
        <td>
            <div style="display: flex; gap: 5px">
            <input type="text" id="company_address1" name="company_address1" value="<?= $data['company_address1']?>" class="frm_input" size="" onclick="onPostCode();" readonly>
                <a class="btn_01" onclick="onPostCode()">우편번호 검색</a>
            <input type="text" id="company_address2" name="company_address2" value="<?= $data['company_address2']?>" class="frm_input" size="">
            </div>
        </td>
        <th scope="row"><label for="">업체 썸네일</label></th>
        <td>
            <?if($data['company_thumb']) {?>
                <span><?=$data['company_thumb']['name']?></span>
            <?}?>
            <input type="file" name="company_thumb" id="company_thumb">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_title">제목</label></th>
        <td colspan="3"><input type="text" name="subject" value="<?php echo $data['subject'] ?>" required id="cp_title" class="frm_input required" size="180" maxlength="200"></td>
    </tr>

    <tr>
        <th scope="row"><label for="recruitment_date">모집기간</label></th>
        <td>
            <input type="date" name="recruitment_date" value="<?=$data ? $data['recruitment_date']  : ''?>" class="frm_input" size="40"> 까지
        </td>
        <th scope="row"><label for="activity_date">활동기간</label></th>
        <td>
            <input type="date" name="activity_date" value="<?=$data ? $data['activity_date']  : ''?>" class="frm_input" size="40"> 까지
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="thumb">썸네일</label></th>
        <td>
            <?foreach($data['thumb'] as $index => $t) {?>
                <img src="<?=$jl->URL?><?=$t['src']?>" style="width: 50px; height: 50px;">
                <a class="btn_01" onclick="deleteThumb(<?=$index?>)">삭제</a>
            <?}?>
            <div id="preview">
            </div>
            <label for="thumb">
                <a class="btn_02">추가</a>
            </label>
            <div style="display: flex; gap: 5px">
                <input type="file" multiple="multiple" name="thumb[]" id="thumb" accept="image/*" style="display: none">

            </div>
        </td>
        <th scope="row"><label for="cp_progress">진행상태</label></th>
        <td>
            <select name="status">
                <option value="대기" <?=$data['status'] == '대기' ? 'selected' : ''?>>대기</optionvalue>
                <option value="모집" <?=$data['status'] == '모집' ? 'selected' : ''?>>모집</optionvalue>
                <option value="활동" <?=$data['status'] == '활동' ? 'selected' : ''?>>활동</optionvalue>
                <option value="종료" <?=$data['status'] == '종료' ? 'selected' : ''?>>종료</optionvalue>
            </select>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="cp_reward">제공내역</label></th>
        <td colspan="3">
            <div style="display: flex; gap: 5px">
                <input type="text" name="service" value="<?=$data['service']?>" class="frm_input" size="20">
                + 
                잡고 캐쉬 <input type="text" name="service_cash" value="<?=$data['service_cash']?>" class="frm_input" size="20"> 원
            </div>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_logo_content">기본안내</label></th>
        <td colspan="2">
            <textarea id="naver_content" name="naver_content" rows="10" cols="100" style="width:100%; height:300px; display:none;"></textarea>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_logo_content2">필수활동</label></th>
        <td colspan="2"><textarea style="width: 200%" name="required" id="required" class="frm_input"><?php echo $data['required'] ?></textarea></td>
    </tr>

    <tr>
        <th scope="row"><label for="cp_logo_content2">활동안내</label></th>
        <td colspan="2"><textarea style="width: 200%" name="activity_guide" id="activity_guide" class="frm_input"><?php echo $data['activity_guide'] ?></textarea></td>
    </tr>

    <?php if ($w == 'u') { ?>
    <tr>

        <th scope="row">작성일</th>
        <td colspan="3"><?php echo $data['wr_datetime'] ?></td>

    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./campaign_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<?$jl->jsLoad();?>
<script>
    const jl = new Jl();
    const idx = "<?=$_GET['idx']?>"

    async function deleteThumb(index) {
        try {
            var obj = {idx : idx, thumb_idx : index}
            let res = await jl.ajax("delete_thumb",obj,"/api/campaign.php");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>

<script>


    // 파일 입력 요소와 미리보기 컨테이너 가져오기
    const fileInput = document.getElementById('thumb');
    const previewContainer = document.getElementById('preview');
    let selectedFiles = Array.from(fileInput.files);

    fileInput.addEventListener('change', function() {
        //selectedFiles = Array.from(fileInput.files); // 새로운 파일 목록으로 업데이트
        previewContainer.innerHTML = ''; // Clear previous previews
        selectedFiles = selectedFiles.concat(Array.from(fileInput.files));
        console.log(selectedFiles);

        // 각 파일에 대해 미리보기 생성
        selectedFiles.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgPreview = document.createElement('div');
                imgPreview.classList.add('image-preview');

                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.width = 50;
                imgElement.height = 50;

                const deleteBtn = document.createElement('button');
                deleteBtn.classList.add('delete-btn');
                deleteBtn.textContent = 'x';
                deleteBtn.addEventListener('click', function() {
                    // 삭제 버튼 클릭 시 미리보기 제거
                    previewContainer.removeChild(imgPreview);

                    // 삭제된 파일을 `selectedFiles`에서 제거
                    selectedFiles = selectedFiles.filter(f => f !== file);

                    // 새로운 파일 목록으로 `fileInput` 업데이트
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(f => dataTransfer.items.add(f));
                    fileInput.files = dataTransfer.files;
                });

                imgPreview.appendChild(imgElement);
                imgPreview.appendChild(deleteBtn);
                previewContainer.appendChild(imgPreview);
            }
            reader.readAsDataURL(file);
        });
    });
</script>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=$jl->URL.$jl->EDITOR_JS?>"></script>
<script>
    var default_content = [];
    var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
    var content = "<?=$data['basic_guide']?>";
    document.addEventListener('DOMContentLoaded', function(){
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: default_content,
            elPlaceHolder: "naver_content",
            sSkinURI: "<?=$jl->URL?><?=$jl->EDITOR_HTML?>",
            htParams : {
                bUseToolbar : true,				// 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer : true,		// 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger : true,			// 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                bSkipXssFilter : true,		// client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                I18N_LOCALE : sLang,
                fOnBeforeUnload : function(){}
            }, //boolean
            fOnAppLoad : function(){
                //기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
                default_content.getById["naver_content"].exec("PASTE_HTML", [content]);
            },
            fCreator: "createSEditor2"
        });
        default_content.outputBodyHTML = function(){
            default_content.getById["naver_content"].exec("UPDATE_CONTENTS_FIELD", []);
        }
    },false);

    function campaignSubmit(f) {
        $('#basic_guide').val(default_content.getById["naver_content"].getIR().replaceAll('"',"'"));
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(f => dataTransfer.items.add(f));
        fileInput.files = dataTransfer.files;
        //return false;
    }


    function onPostCode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
                // 예제를 참고하여 다양한 활용법을 확인해 보세요.
                var post = data.zonecode;
                var address = data.roadAddress || data.jibunAddress;

                $('#company_address1').val(post + " " + address);

            }
        }).open();
    }
</script>

<script>
    $(document).ready(function() {
        $("[name='cp_category1']").val(<?= $row['cp_category1']?>);
        $("[name='cp_category2']").val(<?= $row['cp_category2']?>);
        $("[name='cp_progress']").val(<?= $row['cp_progress']?>);



    });


    function ctg1_change(val) {


        $.ajax({
            url: g5_bbs_url+"/ajax.controller.php",
            type: "POST",
            data: {
                "pro_ctg1": val,
                "mode": "pro_ctg2_common"
            },
            dataType: "html",
            success: function(data) {
                $('#cp_category2').html('<option value="">상세분야 선택</option>' + data);
            }
        });

    }


</script>

<?php
include_once('./admin.tail.php');
?>

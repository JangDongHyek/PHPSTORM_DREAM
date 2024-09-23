<?php
$sub_menu = "251000";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

auth_check($auth[$sub_menu], 'w');

$model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));

if($_GET['idx']) {
    $w = 'u';
    $model->where("idx",$_GET['idx']);
    $results = $model->get();

    if(!$results['count']) {
        echo "해당 idx가 존재하지않는 잘못된접근입니다.";
        die();
    }else {
        $row = $results['data'][0];

        if($row['prize'] == "null") $row['prize'] = "";
    }
}


$g5['title'] = '공모전 '.$html_title;
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

<form name="fmember" id="fmember" action="./compete_form_update.php" onsubmit="return competeSubmit(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="idx" value="<?php echo $_GET['idx'] ?>">
<input type="hidden" name="prize" id="prize" value="">
<input type="hidden" id="content" name="content" value="">
<input type="hidden" id="reference" name="reference" value="">


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
        <th scope="row"><label for="company_id">업체 아이디</label></th>
        <td style="width: 30%">
            <input <?=$readonly?> type="text" name="company_id" value="<?= $row['company_id']?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="company_name">업체명</label></th>
        <td>
            <input type="text" name="company_name" value="<?=$row['company_name'] ?>" class="frm_input" size="40">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="subject">제목</label></th>
        <td colspan="3"><input type="text" name="subject" value="<?php echo $row['subject'] ?>" required id="cp_title" class="frm_input required" size="180" maxlength="200"></td>
    </tr>
    <tr>
        <th scope="row"><label for="content">상세내용</label></th>
        <td colspan="2">
            <textarea id="naver_content" name="naver_content" rows="10" cols="100" style="width:100%; height:300px; display:none;"></textarea>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="start_date">신청기간</label></th>
        <td>
            <input type="date" name="start_date" value="<?=explode(" ",$row['start_date'])[0] ? : ''?>" class="frm_input" size="40">
        </td>
        <th scope="row"><label for="end_date">심사기간</label></th>
        <td>
            <input type="date" name="end_date" value="<?=explode(" ",$row['end_date'])[0] ? : ''?>" class="frm_input" size="40">
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="image">썸네일</label></th>
        <td>
            <?foreach($row['thumb'] as $index => $t) {?>
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
            <!--
        <th scope="row"><label for="cp_progress">진행상태</label></th>
        <td>
            <select name="status">
                <option value="진행중" <?=$row['status'] == '진행중' ? 'selected' : '' ?>>진행중</option>
                <option value="심사중" <?=$row['status'] == '심사중' ? 'selected' : '' ?>>심사중</option>
                <option value="종료" <?=$row['status'] == '종료' ? 'selected' : '' ?>>종료</option>
                <option value="지급완료" <?=$row['status'] == '지급완료' ? 'selected' : '' ?>>지급완료</option>
            </select>
        </td>
    </tr>
            -->
    <tr>
        <th scope="row"><label for="cp_reward">상금</label></th>
        <td>
            <span>맨 위에 상금이 리스트에 노출됩니다.</span>
            <a class="btn_02" onclick="addPrize()">추가</a>
            <div id="container2">

            </div>

        </td>
        <th scope="row"><label for="image">선호하는 디자인</label></th>
        <td>
            <?foreach($row['design'] as $index => $t) {?>
                <img src="<?=$jl->URL?><?=$t['src']?>" style="width: 50px; height: 50px;">
                <a class="btn_01" onclick="deleteDesign(<?=$index?>)">삭제</a>
            <?}?>
            <div id="preview2">
            </div>
            <label for="design">
                <a class="btn_02">추가</a>
            </label>
            <div style="display: flex; gap: 5px">
                <input type="file" multiple="multiple" name="design[]" id="design" accept="image/*" style="display: none">

            </div>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="reference">참고자료</label></th>
        <td colspan="2">
            <textarea id="naver_content2" name="naver_content2" rows="10" cols="100" style="width:100%; height:300px; display:none;"></textarea>
        </td>
    </tr>

    <tr>
        <th scope="row"><label for="reference">신청서</label></th>
        <td colspan="2">
            <?=$row['upfile'] ? $row['upfile']['name'] : '' ?><input type="file" name="upfile">
        </td>
    </tr>

    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" style="background: #0A7CC7" class="btn_submit"accesskey='s'>
    <a href="./compete_list.php?<?php echo $qstr ?>">목록</a>
</div>

</form>

<? $jl->jsLoad();?>
<script>
    const jl = new Jl();
    const idx = "<?=$_GET['idx']?>";
    let prize = <?=$row['prize'] ? json_encode($row['prize'],JSON_UNESCAPED_UNICODE) : "[]"?>;

    async function deleteThumb(index) {
        try {
            var obj = {idx : idx, thumb_idx : index}
            let res = await jl.ajax("delete_thumb",obj,"/api/compete.php");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    async function deleteDesign(index) {
        try {
            var obj = {idx : idx, design_idx : index}
            let res = await jl.ajax("delete_design",obj,"/api/compete.php");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        if(prize.length) setPrize();
    });

    function addPrize() {
        event.preventDefault();
        setPrizeValue();
        prize.push({rank : "",people : "",money : ""});
        setPrize();
    }

    function setPrizeValue() {
        prize.forEach((item,index) => {
            prize[index].rank = document.getElementById(`rank${index}`).value;
            prize[index].people = document.getElementById(`people${index}`).value;
            prize[index].money = document.getElementById(`money${index}`).value;
        });
    }

    function setPrize() {
        const container = document.getElementById('container2');

        container.innerHTML = "";


        prize.forEach((item,index) => {
            const div = document.createElement('div');
            div.style.display = "flex";
            div.style.gap = "5px";

            const input1 = document.createElement('input');
            input1.classList.add("frm_input");
            input1.type = "text";
            input1.name = `rank${index}`;
            input1.id = `rank${index}`;
            input1.value = item.rank;
            input1.placeholder = "상이름";
            input1.size = 5;

            const rank_text = document.createTextNode(' *');

            const input2 = document.createElement('input');
            input2.classList.add("frm_input");
            input2.type = "text";
            input2.name = `people${index}`;
            input2.id = `people${index}`;
            input2.value = item.people;
            input2.placeholder = "인원수"
            input2.size = 5;

            const people_text = document.createTextNode('명 *');

            const input3 = document.createElement('input');
            input3.classList.add("frm_input");
            input3.type = "text";
            input3.name = `money${index}`;
            input3.id = `money${index}`;
            input3.placeholder = "상품명"
            input3.value = item.money;

            const money_text = document.createTextNode('');

            const a = document.createElement('a');
            a.classList.add("btn_01")
            a.innerText = "삭제"

            a.addEventListener('click',(event) => {
                event.preventDefault();
                setPrizeValue();

                prize.splice(index,1);
                setPrize();
            })


            div.appendChild(input1);
            div.appendChild(rank_text);
            div.appendChild(input2);
            div.appendChild(people_text);
            div.appendChild(input3);
            div.appendChild(money_text);
            div.appendChild(a);

            container.appendChild(div);

        });
    }

    function competeSubmit(f) {
        setPrizeValue();
        document.getElementById("prize").value = JSON.stringify(prize);
        $('#content').val(default_content.getById["naver_content"].getIR().replaceAll('"',"'"));
        $('#reference').val(default_content2.getById["naver_content2"].getIR().replaceAll('"',"'"));
        //return false;
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

    // 파일 입력 요소와 미리보기 컨테이너 가져오기
    const fileInput2 = document.getElementById('design');
    const previewContainer2 = document.getElementById('preview2');
    let selectedFiles2 = Array.from(fileInput2.files);

    fileInput2.addEventListener('change', function() {
        //selectedFiles2 = Array.from(fileInput2.files); // 새로운 파일 목록으로 업데이트
        previewContainer2.innerHTML = ''; // Clear previous previews
        selectedFiles2 = selectedFiles2.concat(Array.from(fileInput2.files));
        console.log(selectedFiles2);

        // 각 파일에 대해 미리보기 생성
        selectedFiles2.forEach(file => {
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
                    previewContainer2.removeChild(imgPreview);

                    // 삭제된 파일을 `selectedFiles2`에서 제거
                    selectedFiles2 = selectedFiles2.filter(f => f !== file);

                    // 새로운 파일 목록으로 `fileInput2` 업데이트
                    const dataTransfer = new DataTransfer();
                    selectedFiles2.forEach(f => dataTransfer.items.add(f));
                    fileInput.files = dataTransfer.files;
                });

                imgPreview.appendChild(imgElement);
                imgPreview.appendChild(deleteBtn);
                previewContainer2.appendChild(imgPreview);
            }
            reader.readAsDataURL(file);
        });
    });
</script>

<script src="<?=$jl->URL.$jl->EDITOR_JS?>"></script>
<script>
    var default_content = [];
    var default_content2 = [];
    var sLang = "ko_KR";	// 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
    var content = "<?=$row['content']?>";
    var content2 = "<?=$row['reference']?>";
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

        nhn.husky.EZCreator.createInIFrame({
            oAppRef: default_content2,
            elPlaceHolder: "naver_content2",
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
                default_content2.getById["naver_content2"].exec("PASTE_HTML", [content2]);
            },
            fCreator: "createSEditor2"
        });
        default_content2.outputBodyHTML = function(){
            default_content2.getById["naver_content2"].exec("UPDATE_CONTENTS_FIELD", []);
        }
    },false);


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


<?php
include_once('./admin.tail.php');
?>

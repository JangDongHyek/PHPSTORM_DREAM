<?php
global $pid;
$pid = "compete_view";
$sub_id = "compete_view";
include_once('./_common.php');
include_once("../jl/JlConfig.php");

if(!$_GET['idx']) alert("잘못된경로입니다.");



//공모전 데이터
$model = new JlModel(array(
    "table" => "compete",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$data = $model->where("idx",$_GET['idx'])->get()['data'][0];

//공모전 조회수
if($member['mb_no']) {
    if(!isset($_SESSION['compete_views'])) {
        $_SESSION['compete_views'] = array();
    }
    if(!in_array($_GET['idx'],$_SESSION['compete_views'])) {
        array_push($_SESSION['compete_views'],$_GET['idx']);
        $data['views'] = (int)$data['views'] + 1;
        $model->update($data);
    }
}

// 공모전  좋아요
$heart = "off";
if($member['mb_no']) {
    $compete_like = new JlModel(array(
        "table" => "compete_like",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    ));
    $getLike = $compete_like->where("user_idx",$member['mb_no'])->get()['data'];

    $likes = array();
    foreach ($getLike as $index => $d) {
        array_push($likes,$d['compete_idx']);
    }

    if(in_array((int)$_GET['idx'],$likes,true)) $heart = "on";
}

$compete_request_model = new JlModel(array(
    "table" => "compete_request",
    "primary" => "idx",
    "autoincrement" => true,
    "empty" => false
));
$compete_request = $compete_request_model->where("compete_idx",$_GET['idx'])->count();



$g5['title'] = '공모전 상세';
include_once('./_head.php');
?>

<style>
    .download-btn {
        padding: 10px 20px;
        background-color: #7d75db;
        color: white !important;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-align: center;
        text-decoration: none;
        width : 100%;
        margin-top : 10px;
    }

    .download-btn:hover {
        background-color: #3700b3;
    }

    .download-btn:active {
        background-color: #03dac6;
    }
</style>

    <div class="wrapper" id="com_view">

    <!--아이템정보 왼쪽-->
        <div class="scroll_content">

            <!--이미지롤링-->
            <!-- Swiper -->
            <div class="swiper comSwiper">
                <div class="swiper-wrapper">
                    <? foreach($data['thumb'] as $d) { ?>
                        <div class="swiper-slide"><img src="<?=$jl->URL.$d['src']?>"></div>
                    <?}?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".comSwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    autoHeight : true,
                });
            </script>

            <div class="com_info">
                <div id="cam_count" class="flex ai-c gap10">
                    <div class="mb flex gap5 ai-c">
                        <div class="count">
                            <b class=""><?=$data['status']?></b>
                        </div>
                        <p>조회수 <?=number_format($data['views'])?></p>


                    </div>
                    <div class="heart male-auto" name="">
                        <button type="button" class="heart <?=$heart?>" onclick="postLike('<?=$_GET['idx']?>')"><img src="<?php echo G5_THEME_IMG_URL ?>/main/heart_<?=$heart?>.png" alt="좋아요off" title="좋아요off"></button>
                    </div>
                </div>
                <header>
                    <h6 class="item_tit"><?=$data['subject']?></h6>
                    <p class="txt_color"><?=$data['company_name']?></p>
                </header>
                <div id="cam_info"class="flex ai-c gap10">
                    <span>
                        <p class="flex ai-c jc-sb">
                            <span>접수기간</span>
                            <span><?=explode(" ",$data['start_date'])[0]?>까지</span>
                        </p>
                        <p class="flex ai-c jc-sb">
                            <span>심사기간</span>
                            <span><?=explode(" ",$data['end_date'])[0]?>까지</span>
                        </p>

                        <?if($data['upfile']) {?>
                        <p class="flex ai-c jc-sb">
                            <a class="download-btn" href="<?=$jl->URL?><?=$data['upfile']['src']?>" download="<?=$data['upfile']['name']?>">신청서 다운로드</a>
                        </p>
                        <?}?>
                    </span>
                    <span>
                        <p class="txt_mini text-right">
                            <span class="txt_mini"><?=number_format($compete_request)?>명의 참가자</span>
                        </p>
                        <p class="text-right">
                            <? foreach($data['prize'] as $index => $d){?>
                            <span class="txt_mini"><?=$d['rank']?> * <?=$d['people']?>명</span>
                            상품 <b class="txt_color"><?=$d['money']?></b><br>
                            <?}?>
                        </p>
                    </span>
                </div>
                <button type="button" class="btn btn_large btn_color" onclick="openModal()">참여하기 </button>
            </div>
        </div>
        <div class="tabs">
            <div class="tab-menu">
                <button class="tab-button active" data-tab="tab1">공모전 의뢰 내용</button>
            </div>
            <div class="tab-content active" id="tab1">

                <div class="contest_cont">
                    <section>
                        <h3 class="title">상세내용</h3>
                        <div class="cont" style="white-space: pre-wrap;"><?=$data['content']?></div>
                    </section>
                    <section>
                        <h3 class="title">선호하는 디자인</h3>
                        <div class="flex ai-s gap10 sample">
                            <?if(count($data['design'])) {
                                foreach($data['design'] as $d) {?>
                                    <img src="<?=$jl->URL.$d['src']?>">
                            <?}}else {?>
                            <? foreach($data['thumb'] as $d) { ?>
                                    <img src="<?=$jl->URL.$d['src']?>">
                            <?}}?>
                        </div>
                    </section>
                    <section>
                        <h3 class="title">참고자료</h3>
                        <div class="cont"><?=$data['reference']?></div>
                    </section>
                </div><!--//contest_cont-->
            </div>
        </div>
    </div>


    <!-- 공모전 참여 -->
    <div class="modal fade" id="competeSubmit" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">공모전 참여 </h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <style>
                    .image-preview {
                        display: flex;
                        align-items: center;
                        margin-bottom: 10px;
                    }

                    .image-preview p {
                        margin: 0;
                        margin-right: 10px;
                    }

                    .delete-btn {
                        background-color: red;
                        color: white;
                        border: none;
                        padding: 5px 10px;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    .delete-btn:hover {
                        background-color: darkred;
                    }
                </style>

                <div class="modal-body">
                    <p>제출 파일</p>
                    <div id="preview"></div>

                    <div class="file-input-container">
                        <input type="text" id="fileName" placeholder="파일을 선택해주세요" readonly>
                        <input type="file"  multiple="multiple" name="compete_file[]" id="company_file" accept="*/*" style="display: block">
                        <!--<button type="button" class="btn btn_color btn_h40" onclick="document.getElementById('fileInput').click();">파일 선택</button>-->
                    </div>

                    <p>추가 설명</p>
                    <textarea placeholder="설명을 작성하세요." id="compete_description"></textarea>

                    <script>
                        // 파일 입력 요소와 미리보기 컨테이너 가져오기
                        const fileInput = document.getElementById('company_file');
                        const previewContainer = document.getElementById('preview');
                        let selectedFiles = Array.from(fileInput.files);

                        fileInput.addEventListener('change', function() {
                            //selectedFiles = Array.from(fileInput.files); // 새로운 파일 목록으로 업데이트
                            previewContainer.innerHTML = ''; // Clear previous previews
                            selectedFiles = selectedFiles.concat(Array.from(fileInput.files));

                            // 각 파일에 대해 미리보기 생성
                            selectedFiles.forEach(file => {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const imgPreview = document.createElement('div');
                                    imgPreview.classList.add('image-preview');

                                    const imgElement = document.createElement('p');
                                    imgElement.textContent = file.name; // 파일 이름 추가

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
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="postRequest('<?=$data['idx']?>')">제출하기</button>
                </div>
            </div><!--//modal-content-->
        </div>

    </div>
    <!-- // 공모전 참여  모달창 -->
<? $jl->jsLoad(); ?>

    <script>
        const jl = new Jl();
        const user_idx = "<?=$member['mb_no']?>";

        function openModal() {
            if(!user_idx) {
                alert("로그인이 필요한 기능입니다.");
                window.location.href = "/bbs/login.php";
                return false;
            }

            $('#competeSubmit').modal('show');
        }

        async function postRequest(idx) {
            try {

                if(selectedFiles.length <= 0) {
                    alert("제출할 파일을 올려주세요.");
                    return false;
                }

                let obj = {
                    user_idx : user_idx,
                    compete_idx : idx,
                    compete_file : selectedFiles,
                    description : $('#compete_description').val(),
                    status : ""
                }


                let res = await jl.ajax("insert",obj,"/api/compete_request.php");

                showConfirm('신청완료', '결과는 공모전 관리에서 확인하세요.')
                $('#competeSubmit').modal('hide');
            }catch (e) {
                alert(e.message)
            }
        }

        async function postLike(idx) {
            try {
                if(!user_idx) {
                    alert("로그인이 필요한 기능입니다.");
                    window.location.href = "/bbs/login.php";
                }
                let obj = {
                    user_idx : user_idx,
                    compete_idx : idx
                }

                let res = await jl.ajax("insert",obj,"/api/compete_like.php");
                window.location.reload();
            }catch (e) {
                alert(e.message)
            }
        }
    </script>
<?php
include_once('./_tail.php');
?>
<?php
include_once('./_common.php');
include_once("../jl/JlConfig.php");
$sub_menu = "400000";   // 게시판이 나타나야 하는 기본 메뉴
auth_check($auth[$sub_menu], 'r');	// 권한체크
$token = get_token();
if ($is_admin != 'super') alert('최고관리자만 접근 가능합니다.');    // 관리자만 볼 수 있습니다.

function getDateRange($startDate, $endDate) {
    // 날짜 포맷을 'Y-m-d'로 강제 변환
    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);

    // 날짜 범위를 저장할 배열
    $dateArray = array();

    // 시작일과 종료일이 같은 경우도 처리
    while ($startDate <= $endDate) {
        $dateArray[] = date('Y-m-d', $startDate);
        // 하루씩 더해줌 (86400초 = 1일)
        $startDate = strtotime('+1 day', $startDate);
    }

    return $dateArray;
}

// 원하는 날짜 설정 (예: 2024-09-13)
$desiredDate = $_GET['today'] ? $_GET['today'] : date('Y-m-d');
$date =$desiredDate;
// 원하는 날짜의 요일 (1 = 월요일, 7 = 일요일)
$dayOfWeek = date('N', strtotime($desiredDate));
// 해당 주의 월요일 구하기
$monday = date('Y-m-d', strtotime($desiredDate . ' -' . ($dayOfWeek - 1) . ' days'));
// 해당 주의 일요일 구하기
$sunday = date('Y-m-d', strtotime($monday . ' +6 days'));
$dates = getDateRange($monday,$sunday);

$model = new JlModel(array("table" => "meal_plan"));
$file_model = new JlModel(array("table" => "meal_plan_file"));

$sheet = $_GET['sheet'] ? $_GET['sheet'] : 'Senior';
$time = $_GET['time'] ? $_GET['time'] : '';


$dayOfWeek = date('w', strtotime($desiredDate));
$eng_day = date('D', strtotime($date));
switch ($dayOfWeek) {
    case "1" :
        $day = "월";
        break;
    case "2" :
        $day = "화";
        break;
    case "3" :
        $day = "수";
        break;
    case "4" :
        $day = "목";
        break;
    case "5" :
        $day = "금";
        break;
    case "6" :
        $day = "토";
        break;
    case "0" :
        $day = "일";
        break;
}

// 조식,석식 그날의 데이터 시간타임을 가져오는 쿼리
$sql = "SELECT DISTINCT times AS times_list FROM meal_plan where day = '$date' and sheet = '$sheet'";
$time_list = $model->query($sql);

if(!$time && count($time_list)) {
    $time = $time_list[0][0];
}

// 파일부분
$files = "";
if($time) {
    $file_model->where("sheet",$sheet);
    $file_model->where("times",$time);
    $file_model->where("day",$date);
    $files = $file_model->get();
    $files = $files['data'][0];
}

$mode = $files ? "update" : "insert";
$idx = $files ? $files['idx'] : "";

include_once ('./admin.head.php');
?>

<link rel="stylesheet" href="<?=G5_URL?>/mobile/skin/board/carte/style.css">

<div id="container">
    <div id="text_size">
        <!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
        <button onclick="font_resize('container', 'ts_up ts_up2', '');"><img src="https://www.dreamforone.com:443/~jjcatering/adm/img/ts01.gif" alt="기본"></button>
        <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up');"><img src="https://www.dreamforone.com:443/~jjcatering/adm/img/ts02.gif" alt="크게"></button>
        <button onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2');"><img src="https://www.dreamforone.com:443/~jjcatering/adm/img/ts03.gif" alt="더크게"></button>
    </div>
    <h1>일간 식단표</h1>
    <div style="padding:10px;">
        <div>
            <div id="bo_tbtn">
                <a href="?bo_table=carte&amp;is_day=1&amp;mktime=1725980400&amp;sme=Lunch&amp;now_sheet=0">UJ</a>
                <a href="?bo_table=carte&amp;is_day=1&amp;mktime=1725980400&amp;sme=Lunch&amp;now_sheet=1">LJ</a>
                <a href="?bo_table=carte&amp;is_day=1&amp;mktime=1725980400&amp;sme=Lunch&amp;now_sheet=2">MS,SS</a>
            </div>
            <div class="swiper-container swiper-initialized swiper-horizontal swiper-backface-hidden" style="">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="swiper_content" aria-live="polite">
                <? if($files) {
                    foreach($files['upfiles'] as $index => $f) {
                ?>
                    <div class="swiper-slide" role="group" style="width: 1883px;"><img src="<?=G5_URL?><?=$f['src']?>"></div>
                <?}}?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal"><span class="swiper-pagination-bullet swiper-pagination-bullet-active" aria-current="true"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span><span class="swiper-pagination-bullet"></span></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper_content"></div>
                <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper_content"></div>


                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>

            <input type="hidden" name="sme" id="sme" value="Lunch">
            <div id="bo_list" style="width:100%">
                <div class="date_title">
                    <a href="#" onclick="prevWeek()" class="arrow_left">  </a>
                    <?=$desiredDate?> ( <?=$day?> )
                    <a href="#" onclick="nextWeek()" class="arrow_right">  </a>
                </div>
                <div id="menu">
                    <? foreach($time_list as $t) {
                        $t = $t[0];
                        ?>
                        <input type="button" name="menu[]" value="<?=$t?> (영문 타임)" class="<?=$t == $time ? 'btn_submit' : 'btn_cancel'?>">
                    <?}?>
                </div>


                <? if($time) {
                    //그날의 조식의 메뉴의 카테고리를 가져오는 쿼리
                    $sql = "SELECT times, GROUP_CONCAT(DISTINCT category) AS lists FROM meal_plan where day = '$date' and times = '$time' and sheet = '$sheet' GROUP BY times";
                    $data = $model->query($sql);
                    $categories = explode(",",$data[0]['lists']);

                ?>
                <div id="info">
                    <div class="tbl_head01 tbl_wrap" style="margin-top:20px;">
                        <table>
                            <colgroup>
                                <col style="width:12%">
                                <col style="width:auto">
                            </colgroup>
                            <tbody>
                            <tr></tr>
                            <? foreach($categories as $category) {
                                $model->where("day",$date);
                                $model->where("category",$category);
                                $model->where("sheet",$sheet);
                                $menus = $model->where("times",$time)->get();
                            ?>
                                <tr><th rowspan="<?=$menus['count'] + 1?>"><?=$category?> (영문 카테고리)</th></tr>
                                <? foreach($menus['data'] as $menu) {?>
                                <tr><td><?=$menu['name']?><br>메뉴영문명</td></tr>
                            <?}}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?}?>
            </div>

            <script src="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/jquery-1.9.1.min.js"></script>
            <script src="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/bootstrap.min.css"><!--게시판공통-->




            <form name="fwrite" id="fwrite" action="./upload.image.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data">
                <input type="hidden" name="img_date" id="img_date" value="2024-09-11">
                <input type="hidden" name="nowsheet" id="nowsheet" value="0">
                <input type="hidden" name="tmcate" id="tmcate" value="Lunch">
                <input type="hidden" name="url_before" id="url_before" value="https://www.dreamforone.com/~jjcatering/adm/bbs/board.php?bo_table=carte&amp;is_day=1&amp;mktime=1725980400&amp;now_sheet=0&amp;sme=Lunch">
                <div class="modal fade" id="myModal" style="margin-top:100px">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- header -->
                            <div class="modal-header">
                                <!-- 닫기(x) 버튼 -->
                                <button type="button" class="close" data-dismiss="modal" id="cls_modal">×</button>
                                <h4 class="modal-title">식단 이미지 등록</h4>
                                <!-- header title -->
                            </div>
                            <!-- body -->
                            <div class="modal-body">
                                <?if($files){?>
                                <?foreach($files['upfiles'] as $index => $t) {?>
                                    <img src="<?=$jl->URL?><?=$t['src']?>" style="width: 50px; height: 50px;">
                                    <a class="btn_01" onclick="deleteThumb(<?=$index?>)">삭제</a>
                                <?}}?>
                                <div id="preview"></div>

                                <input type="file" multiple="multiple" name="thumb[]" id="thumb" accept="image/*">
                            </div>
                            <!-- Footer -->
                            <div class="modal-footer">
                                <!-- 					<a href="https://www.dreamforone.com:443/~jjcatering/data/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a> -->
                                <button type="button" class="btn btn-primary" onclick="postRequest()">등록</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <br>
            <a href="javascript:void(0);" class="btn_cancel" onclick="upload_modal()">식단 이미지 등록</a>
            <!--<a href="javascript:void(0);" class="btn_cancel" onclick="delete_imgs()">식단 이미지 삭제</a>-->

        </div>
    </div>
    <!-- 사용스킨 : carte -->

    <noscript>
        <p>
            귀하께서 사용하시는 브라우저는 현재 <strong>자바스크립트를 사용하지 않음</strong>으로 설정되어 있습니다.<br>
            <strong>자바스크립트를 사용하지 않음</strong>으로 설정하신 경우는 수정이나 삭제시 별도의 경고창이 나오지 않으므로 이점 주의하시기 바랍니다.
        </p>
    </noscript>

</div>

<?$jl->jsLoad();?>
<script>
    const jl = new Jl();
    let day = "<?=$desiredDate?>";
    let mode = "<?=$mode?>";
    let idx = "<?=$idx?>";

    async function deleteThumb(index) {
        try {
            var obj = {idx : idx, thumb_idx : index}
            let res = await jl.ajax("delete_thumb",obj,"/api/meal_plan_file.php");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }

    async function postRequest() {
        try {

            if(!time) {
                alert("잘못된 접근입니다. 데이터가 있는 날짜만 이미지를 올릴수있습니다.");
                return false;
            }

            if(selectedFiles.length <= 0) {
                alert("이미지 파일을 올려주세요.");
                return false;
            }

            let obj = {
                idx : idx,
                sheet : sheet,
                times : time,
                day : day,
                upfiles : selectedFiles
            }


            let res = await jl.ajax(mode,obj,"/api/meal_plan_file.php");

            alert("추가되었습니다.");
            window.location.reload();
        }catch (e) {
            alert(e.message)
        }
    }
</script>

<!-- 파일관련 스크립트 -->
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

<script>
    let     currentDate = new Date('<?=$desiredDate?>');
    const   sheet = "<?=$sheet?>";
    const   time = "<?=$time?>";

    // 이전 주로 이동
    function prevWeek() {
        event.preventDefault();

        currentDate.setDate(currentDate.getDate() - 1);
        let year = currentDate.getFullYear();
        let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // 월은 0부터 시작하므로 +1
        let day = currentDate.getDate().toString().padStart(2, '0');
        let date = `${year}-${month}-${day}`;
        //console.log(date);
        window.location.href = `?today=${date}&sheet=${sheet}`
        //displayWeekInfo();
    }

    // 다음 주로 이동
    function nextWeek() {
        event.preventDefault();

        currentDate.setDate(currentDate.getDate() + 1);
        let year = currentDate.getFullYear();
        let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // 월은 0부터 시작하므로 +1
        let day = currentDate.getDate().toString().padStart(2, '0');
        let date = `${year}-${month}-${day}`;
        //console.log(date);
        window.location.href = `?today=${date}&sheet=${sheet}`
    }

    function upload_modal() {
        $("#myModal").modal();
    }
</script>

<script>
    var swiper;

    swiper = new Swiper('.swiper-container', {
        // Optional parameters
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>

<? include_once ('./admin.tail.php'); ?>

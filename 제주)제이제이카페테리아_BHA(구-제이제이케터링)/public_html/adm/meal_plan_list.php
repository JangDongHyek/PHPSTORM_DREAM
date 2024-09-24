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
// 원하는 날짜의 요일 (1 = 월요일, 7 = 일요일)
$dayOfWeek = date('N', strtotime($desiredDate));
// 해당 주의 월요일 구하기
$monday = date('Y-m-d', strtotime($desiredDate . ' -' . ($dayOfWeek - 1) . ' days'));
// 해당 주의 일요일 구하기
$sunday = date('Y-m-d', strtotime($monday . ' +6 days'));
$dates = getDateRange($monday,$sunday);

$model = new JlModel(array("table" => "meal_plan"));
$info = new JlModel(array("table" => "meal_plan_info"));

$sheet = $_GET['sheet'] ? $_GET['sheet'] : 'MS,SS';

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
    <h1>주간 식단표</h1>
    <div style="padding:10px;">
        <div><div id="bo_tbtn">

                <a href="?today=<?=$desiredDate?>&sheet=MS,SS">MS,SS</a>
                <a href="?today=<?=$desiredDate?>&sheet=UJ">UJ</a>
                <a href="?today=<?=$desiredDate?>&sheet=LJ">LJ</a>
                <a href="?today=<?=$desiredDate?>&sheet=간식">간식</a>
            </div>

            <div id="bo_list">
                <div class="date_title">
                    <a href="" class="arrow_left" onclick="prevWeek()"></a>
                    <div id="week-info"></div>
                    <a href="" class="arrow_right" onclick="nextWeek()">  </a>
                </div>



                <style>
                    .box{ padding:0 5px 20px 5px;letter-spacing:0; margin-bottom:30px; border-bottom:1px solid #ddd;}
                    #box_wrap .box:last-child{ border-bottom:0; margin-bottom:0;}
                    .box .date{ font-size:1.3em;font-weight:bold; color:#222; margin-bottom:10px;}
                    .box .box_line{ margin-bottom:20px;}
                    .box .box_in{ padding:15px 20px 18px 20px; border:1px solid #e1e1e1; border-radius:10px; margin-bottom:5px;}
                    .box .box_in:nth-child(even){ background:#f7f7f7;}
                    .box .ftime{background:#118ccf; color:#fff; font-size:1.15em; font-weight:bold; padding:10px 20px; line-height:12px; border-radius:30px; margin-bottom:5px;}
                    .box .ftime span{ font-size:12px; font-weight:normal; display:inline-block; margin-left:5px; opacity:0.8;}
                    .box .fs{ font-size:1.2em; font-weight:500; color:#333; margin-bottom:10px;}
                    .box .fs span{ display:inline-block; position:relative;}
                    .box .fs span:after{ display:block; content:""; width:100%; height:5px; background:rgba(17,140,207,0.4); position:absolute; bottom:2px; left:0;}
                    .box .fc{ overflow-x:scroll; overflow-y:hidden; padding-bottom:5px;}
                    .box .fc_no{ text-align:center; color:#999; padding:10px 0;}
                    .box .fc ul{ max-width:100%; display:flex;}
                    .box .fc ul:after{ display:block; content:""; clear:both;}
                    .box .fc li{ float:left; padding-right:20px; margin-left:20px; border-right:1px dotted #e1e1e1;word-break: keep-all;word-wrap:break-word;}
                    .box .fc li:first-child{ margin-left:0}
                    .box .fc li:last-child{ border-right:0; padding-right:0;}

                </style>



                <div class="box">
                    <? foreach($dates as $date) {
                    $dayOfWeek = date('w', strtotime($date));
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
                    $sql = "SELECT DISTINCT times AS times_list , times_en FROM meal_plan where day = '$date' and sheet = '$sheet'";
                    $time_list = $model->query($sql);


                    ?>
                    <div class="date"><?=$date?>(<?=$day?> | <?=$eng_day?>)</div><!--날짜표시-->

                    <?
                    foreach($time_list as $time) {

                        $time_en = $time[1];
                        $time = $time[0];
                    //그날의 조식의 메뉴의 카테고리를 가져오는 쿼리
                    $sql = "SELECT times, GROUP_CONCAT(DISTINCT category) AS lists FROM meal_plan where day = '$date' and times = '$time' and sheet = '$sheet' GROUP BY times";
                    $data = $model->query($sql);
                    $categories = explode(",",$data[0]['lists']);

                    $sql = "SELECT times, GROUP_CONCAT(DISTINCT category_en) AS lists FROM meal_plan where day = '$date' and times = '$time' and sheet = '$sheet' GROUP BY times";
                    $data = $model->query($sql);
                    $categories_en = explode(",",$data[0]['lists']);
                    if(count($categories)) {
                    ?>

                        <div class="ftime"><?=$time?>(<?=$time_en?>) <span><?=$date?>(<?=$day?> | <?=$eng_day?>)</span></div><!--아침/점심/저녁 , 날짜표시-->
                        <?foreach($categories as $index => $category) {
                        $model->where("day",$date);
                        $model->where("category",$category);
                        $model->where("sheet",$sheet);
                        $menus = $model->where("times",$time)->get();
                        ?>
                        <div class="box_line">

                            <div class="box_in">
                                <div class="fs"><span><?=$category?>(<?=$categories_en[$index]?>)</span></div><!--음식종류-->
                                <div class="fc"><!--식단-->
                                    <ul>
                                        <? foreach($menus['data'] as $d) {?>
                                        <li>
                                            <?=$d['name']?><br>
                                            <?=$d['name_en']?><br>
                                        </li>
                                        <? } ?>
                                    </ul>
                                </div><!--.fc-->
                            </div><!--.box_in-->
                            <?}?>
                        </div><!--.box_line-->
                    <?}?>



                <? } ?>
                <? } ?>
                </div>

                <div id="bo_div" class="tbl_head01 tbl_wrap">

                    <table>
                        <tbody>
                        <tr>
                            <th>Note</th>
                            <td>
                                •알러지 식품 표기는 각 메뉴당 ‘알러지 음식 표기’란의 번호와 대조하여 확인하시기 바랍니다.                        •위 메뉴는 당일 식자재 수급 상황에 따라 변동될 수 있습니다.
                                •Please look for the numbers on the listed menu if you have a food allergy.                                            • We may have to make sm
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <script src="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/jquery-1.9.1.min.js"></script>
                    <script src="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/bootstrap.min.js"></script>
                    <link rel="stylesheet" href="https://www.dreamforone.com:443/~jjcatering/theme/basic2/js/bootstrap.min.css"><!--게시판공통-->

                    <div class="modal fade" id="myModal" style="margin-top:100px">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- header -->
                                <div class="modal-header">
                                    <!-- 닫기(x) 버튼 -->
                                    <button type="button" class="close" data-dismiss="modal" id="cls_modal">×</button>
                                    <h4 class="modal-title">식단등록</h4>
                                    <!-- header title -->
                                </div>
                                <!-- body -->
                                <div class="modal-body">
                                    <p>엑셀양식에 맞게 입력하셔야 식단이 정상적으로 등록됩니다.</p>
                                    <p>데이터 수정은 요일,제공시간,음식종류,타입이 같아야지 음식명이 바뀝니다. 나머지는 수정이 안됩니다</p>
                                    <p>10월1일 조식 한식 메인 돈사태조림 -> 10월1일 조식 한식 메인 오리훈제</p>
                                    <p>데이터의 삭제 같은경우 업체에 요청 부탁드립니다.</p>
                                    <dl><input type="file" placeholder="엑셀파일등록" id="excel_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"></dl>
                                    <dl id="excel_loading"></dl>
                                </div>
                                <!-- Footer -->
                                <div class="modal-footer">
                                    <a href="https://www.dreamforone.com:443/~jjcatering/jl/jl_resource/sample.xlsx" class="btn btn-info" style="float:left; color: #FFF !important;" target="_blank">엑셀양식다운</a>
                                    <button type="button" onclick="uploadExcel()" class="btn btn-primary">등록</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="loadingModal" class="modal-overlay" style="display: none;">
                        <div class="loader"></div>
                    </div>

                </div>
                <div style="text-align:left; padding:5px 0 0 0;">
                    <a href="javascript:void(0);" class="btn_cancel" onclick="upload_modal()">식단등록</a>

                </div>
            </div>
            <div id="result"></div>



</div>
<Style>
    /* 전체 화면을 덮는 반투명한 배경 */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5); /* 반투명한 배경 */
        z-index: 1100; /* 최상위로 설정 */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* 로딩 애니메이션을 감싸는 컨테이너 */
    .loader-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* 화면 전체 높이 */
    }

    /* 동그라미 애니메이션 */
    .loader {
        border: 8px solid #f3f3f3; /* 동그라미 테두리 색상 */
        border-radius: 50%;
        border-top: 8px solid #3498db; /* 동그라미 상단 색상 */
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite; /* 애니메이션 효과 */
    }

    /* 동그라미 회전 애니메이션 */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</Style>

<?$jl->jsLoad();?>

<script>
    const jl = new Jl();

    async function uploadExcel() {
        const fileInput = document.getElementById('excel_file');
        let selectedFiles = Array.from(fileInput.files);

        if(selectedFiles.length == 0) {
            alert("파일을 올려주세요.");
            return false;
        }

        let obj = {
            info : selectedFiles
        }
        document.getElementById('loadingModal').style.display = 'flex';

        let res = await jl.ajax("ss",obj,"/adm/excel_upload.php");

        alert("등록되었습니다.");

        window.location.reload();
    }

    function upload_modal() {
        $("#myModal").modal();
    }
</script>

<script>
    let currentDate = new Date('<?=$desiredDate?>');
    const sheet = "<?=$sheet?>";

    // 주의 시작일(월요일)과 종료일(일요일)을 계산하는 함수
    function getWeekRange(date) {
        const day = date.getDay(); // 요일을 숫자로 반환 (일요일: 0, 월요일: 1, ..., 토요일: 6)
        const diffToMonday = (day === 0 ? -6 : 1) - day;
        const startOfWeek = new Date(date);
        startOfWeek.setDate(date.getDate() + diffToMonday);

        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);

        return {
            start: startOfWeek,
            end: endOfWeek
        };
    }

    // 주차를 계산하는 함수
    function getWeekOfMonth(date) {
        const startOfMonth = new Date(date.getFullYear(), date.getMonth(), 1);
        const firstMonday = startOfMonth.getDay() === 1 ? startOfMonth : new Date(startOfMonth.setDate(startOfMonth.getDate() + (1 - startOfMonth.getDay() + 7) % 7));
        const currentWeekMonday = new Date(date.setDate(date.getDate() - date.getDay() + (date.getDay() === 0 ? -6 : 1)));
        return Math.ceil(((currentWeekMonday - firstMonday) / (7 * 24 * 60 * 60 * 1000)) + 1);
    }

    // 화면에 현재 주 정보 표시
    function displayWeekInfo() {
        const weekRange = getWeekRange(currentDate);
        const weekOfMonth = getWeekOfMonth(new Date(currentDate));

        document.getElementById('week-info').innerHTML = `
    <strong>${currentDate.getFullYear()}년 ${currentDate.getMonth() + 1}월 ${weekOfMonth}주차</strong
`;
    }

    // 이전 주로 이동
    function prevWeek() {
        event.preventDefault();

        currentDate.setDate(currentDate.getDate() - 7);
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

        currentDate.setDate(currentDate.getDate() + 7);
        let year = currentDate.getFullYear();
        let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // 월은 0부터 시작하므로 +1
        let day = currentDate.getDate().toString().padStart(2, '0');
        let date = `${year}-${month}-${day}`;
        //console.log(date);
        window.location.href = `?today=${date}&sheet=${sheet}`
    }

    // 초기 주 정보 표시
    displayWeekInfo();
</script>

<? include_once ('./admin.tail.php'); ?>

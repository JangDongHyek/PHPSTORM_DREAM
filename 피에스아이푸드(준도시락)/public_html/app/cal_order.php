<?php
$pid = "cal_order";
include_once("./app_head.php");
/**
 * 정기배달도시락 주문하기 - 날짜및메뉴선택/배송지정보/결제예정금액 (new)
 */

loginCheck($member['mb_id']);
if(!$private) {
    orderCheck(date('H:i')); // 주문가능시간 체크
}
?>

<style>
    .holi { color: red !important; }
    .hide { display: none; }
</style>

<div id="order_step" role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link" href="#step-1"><span>01</span><p>날짜 및 메뉴선택</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-2"><span>02</span><p>배송지정보</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#step-3"><span>03</span><p>결제예정금액</p></a></li>
    </ul>
    <!-- Tab panes -->
    <form id="forder" name="forder" method="post">
    <input type="hidden" id="w" name="w">
    <div class="tab-content">
        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
            <div class="area_calendar">
                <!-- 달력영역 -->
                <div class="order_calendar"></div>

                <!-- Button trigger modal -->
                <!--<a type="button" data-toggle="modal" data-target="#myModal">
                  메뉴선택 팝업
                </a>-->

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">메뉴선택</h4>
                            </div>
                            <div class="modal-body">
                                <div class="order_menu">
                                    <h3><i class="fa-regular fa-calendar-check"></i> <span id="ord_date"></span></h3>
                                    <!--ajax.add_menu.php-->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" onclick="cancelSelect();">선택해제</button>
                                <button type="button" class="btn btn-brown" onclick="completeSelect();">선택완료</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
            <div class="order_frm">
                <label>받는사람</label>
                <input type="text" class="frm_input" id="order_name" name="order_name" placeholder="이름" value="<?= $w == 'u' ? $do['order_name'] : $member['mb_name'] ?>"/>
                <label>연락처</label>
                <input type="text" class="frm_input" id="order_tel" name="order_tel" placeholder="연락처" maxlength="13" value="<?= $w == 'u' ? $do['order_tel'] : $member['mb_hp'] ?>"/>
                <label for="">주문배송지</label><a class="addr_btn" onclick="sample2_execDaumPostcode()">주소검색</a>
                <input type="text" class="frm_input" id="order_addr1" name="order_addr1" placeholder="주소입력" value="<?= $w == 'u' ? $do['order_addr1'] : $member['mb_addr1'] ?>"/>
                <input type="text" class="frm_input" id="order_addr2" name="order_addr2" placeholder="상세주소" value="<?= $w == 'u' ? $do['order_addr2'] : $member['mb_addr2'] ?>"/>
                <input type="hidden" class="frm_input" id="order_post" name="order_post" value="<?= $w == 'u' ? $do['order_post'] : $member['mb_zip1'] ?>"/>
                <label for="">메모</label>
                <input type="text" class="frm_input" id="order_memo" name="order_memo" placeholder="전달할 내용을 간략하게 적어주세요"/>
            </div>
        </div>
        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
            <!--ajax.cal_order_action.php-->
            <ul class="order_pay"></ul>
        </div>
    </div>
    </form>

    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:3;-webkit-overflow-scrolling:touch;">
        <div class="add_title">
            <h2>주소찾기</h2>
            <div class="btn_close" onclick="closeDaumPostcode()" alt="접기버튼">
                <span></span>
                <span></span>
            </div>
        </div>
        <i id="btnCloseLayer" style="margin-right:0px; font-style:normal; width:40px; height:40px; color:#fff; background:#222; font-size:1.2em; text-align:center; font-weight:bold; line-height:40px; cursor:pointer;position:absolute;right:0;bottom:0;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">X</i>
    </div>
</div>

<!-- JavaScript -->
<script src="<?=G5_PLUGIN_URL?>/powerful-calendar/calendar.js?v=<?=G5_JS_VER?>"></script> <!--주문달력-->
<!--
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
-->

<script src="./js/smartwizard5.js" type="text/javascript"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script type="text/javascript">
var cur_date = new Date();
var weekday = new Array('일', '월', '화', '수', '목', '금', '토');
var delivery_date = ''; // 배달시작일
$(function () {
    calOrderAction('del'); // 초기화

    var curr = new Date();
    var utc = curr.getTime() + (curr.getTimezoneOffset() * 60 * 1000);
    // UTC to KST (UTC + 9시간)
    var KR_TIME_DIFF = 9 * 60 * 60 * 1000;
    cur_date = new Date(utc + (KR_TIME_DIFF));
    // console.log("한국시간 : " + cur_date);

    setTimeout(function() {
        // 달력
        $('.order_calendar').calendar({
            prevButton: "이전",
            nextButton: "다음",
            showTodayButton: false,
            todayButtonContent: "오늘",
            highlightSelectedWeek: false,
            highlightSelectedWeekday: false,
            date: cur_date,
            onClickDate: function (date) {
                var today = cur_date.getFullYear() + '-' + addZero(cur_date.getMonth() + 1) + '-' + addZero(cur_date.getDate()); // 오늘
                var chk_date = new Date(date); // 선택 날짜

                var year = chk_date.getFullYear();
                var month = chk_date.getMonth() + 1;
                var day = chk_date.getDate();
                var yoil = chk_date.getDay();

                // 22.10.18 - [CS] No.1322 22.10.23(일)부터 일요일 정기휴무일 지정함
                // 23.05.31 - CS. 토요일 휴무 지정
                if(weekday[yoil] == "일" || weekday[yoil] == "토") return false;

                $('#ord_date').text(month + '월 ' + day + '일 (' + weekday[yoil] + ')'); // 선택일
                delivery_date = year + '-' + addZero(month) + '-' + addZero(day); // 선택일

                // 오늘보다 이전날짜는 선택 못하도록
                if(today <= delivery_date) {
                    $('.addmenu').remove(); // 초기화
                    calOrderAction('get'); // 선택한 메뉴가 있으면 조회
                    $('#myModal').modal('show'); // 메뉴선택 모달
                }
            },
        });
    }, 150);
    setTimeout(function() {
        // Toolbar extra buttons
        var btnFinish = $('<button type="button""></button>').text('주문완료')
            .addClass('btn btn-contact disabled')
            .on('click', function () {
                orderComplete();
            });
        //var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click', function(){ $('#work_step').smartWizard("reset"); });

        // Step show event
        $("#order_step").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled');
                $(".btn-contact").addClass('disabled');
            } else if (stepPosition === 'last') {
                $("#next-btn").addClass('disabled');
                $(".btn-contact.disabled").removeClass('disabled');
            } else {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                $(".btn-contact").addClass('disabled');

                calOrderAction('info');
            }

            if(stepPosition !== 'first' && $('.pay_ord').length == 0) {
                swal("메뉴를 선택해 주세요.");
                $('#order_step').smartWizard("goToStep", 0);
                $(".btn-contact").addClass('disabled');
            }
        });

        // Smart Wizard
        $('#order_step').smartWizard({
            selected: 0,
            theme: 'dots', // default, arrows, dots, progress
            // darkMode: true,
            transition: {
                animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // both bottom
                toolbarExtraButtons: [btnFinish]
            },
            lang: { // Language variables for button
                next: '다음',
                previous: '이전'
            }
        });
    }, 100);
});

var delivery_arr = [];
function prevNextInit() {
    // 입력한 정보 있으면 날짜 체크하여 클래스(check) 적용 - 월이 바뀌면 클래스가 사라져 재적용
    $('.jun_day').each(function() {
        var day = $(this)[0]['attributes'][1]['value'];
        if(delivery_arr.includes(day)) {
            $(this).addClass('check');
        }
    });
}

// 도시락 정보 (카테고리 별 도시락 조회)
function getDosirak(main, num) {
    $.ajax({
        url: './ajax.get_dosirak.php',
        data: {main: main},
        type: 'post',
        dataType: 'html',
        async: false,
        success: function (data) {
            $('#sub_'+num).html(data);
        }
    });
}

// 날짜-도시락 선택 완료
var order_arr = new Array();
function completeSelect() {
    var flag = true;
    $('select[name^="sub"]').each(function() { // 도시락 선택
       if(this.value == "") {
           flag = false;
           return false;
       }
    });
    var flag2 = true;
    $('input[name^="amount"]').each(function() { // 수량 입력
        if(this.value == "" || this.value == 0) {
            flag2 = false;
            return false;
        }
    });
    if(!flag) {
        swal("도시락을 선택해 주세요.");
        return false;
    }
    if(!flag2) {
        swal("수량을 입력해 주세요.");
        return false;
    }

    $('select[name^="sub"]').each(function() {
        var num = this.id.split('_')[1];
        order_arr.push([$('#main_'+num).val(), this.value, $('#amount_'+num).val()]); // 선택 도시락 정보 배열로 생성
        delivery_arr.push(delivery_date);
    });

    calOrderAction('reg');
}

// 날짜-도시락 선택 해제
function cancelSelect() {
    calOrderAction('del');
}

// 도시락 선택완료/선택해제/조회 이벤트
function calOrderAction(mode) {
    $.ajax({
        url: './ajax.cal_order_action.php',
        data: {mode: mode, delivery_date: delivery_date, order_arr: order_arr},
        type: 'post',
        async: false,
        success: function(data) {
            if(mode == 'reg' || mode == 'del') {
                if(mode == 'reg') { $('.now_click').addClass('check'); }
                else if(mode == 'del') { $('.now_click').removeClass('check'); }
                $('#myModal').modal('hide');
                order_arr = []; // 배열 비움
                //calOrderAction('info'); // 결제예정금액에 메뉴 표시
            } else if(mode == 'get') {
                if(data) {
                    $('.ordmenu').remove();
                    $('.order_menu').append(data);
                } else {
                    addMenu();
                }
            } else if(mode =='info') {
                $('.order_pay').html(data);
            }
        },
    });
}

// 선택한 도시락 전부 표시
function getDosirakInfo() {
    $.ajax({
        url: './ajax.cal_order_action.php',
        data: {mode: 'info'},
        type: 'post',
        async: false,
        success: function(data) {
            $('.order_pay').html(data);
        },
    });
}

// 메뉴 추가
function addMenu() {
    var num = $('.ordmenu').length + 1;
    $.ajax({
        url: './ajax.add_menu.php',
        data: {num: num, delivery_date: delivery_date},
        type: 'post',
        dataType: 'html',
        success: function(data) {
            $('.order_menu').append(data);
        },
    });
}

// 메뉴 삭제
function delMenu(num) {
    $('.ord_'+num).remove();
}

// 모달 닫힐 때 click 클래스 삭제 (now_click : 선택한 날짜 확인용)
$('#myModal').on('hidden.bs.modal', function () {
    $('.day').removeClass('now_click');
});

// 주문완료
var is_post = false;
function orderComplete() {
    if(is_post) {
        return false;
    }
    is_post = true;

    var f = $("#forder")[0];
    // 필수체크
    if(f.order_name.value.length == 0) {
        swal("받는사람을 입력해 주세요.");
        is_post = false;
        return false;
    }
    if(f.order_tel.value.length == 0) {
        swal("연락처를 입력해 주세요.");
        is_post = false;
        return false;
    }
    if(f.order_addr1.value.length == 0) {
        swal("주소를 입력해 주세요.");
        is_post = false;
        return false;
    }

    var formData = new FormData(f);
    $.ajax({
        url: './cal_order_complete.php',
        type: 'post',
        processData: false,
        contentType: false,
        data: formData,
        success: function(data) {
            if(data) {
                swal("주문이 완료되었습니다.")
                .then(()=> {
                    location.href = "./cal_order_details.php";
                });
            }
        },
        error: function(data) {
            swal("오류가 발생하였습니다.\n다시 시도해 주세요.")
            .then(() => {
                location.reload();
            });
        }
    });
}

// *** 다음 주소 api ***
var element_layer = document.getElementById('layer');

function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}

function sample2_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function (data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if (data.userSelectedType === 'R') {
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if (data.buildingName !== '' && data.apartment === 'Y') {
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if (extraAddr !== '') {
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample2_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample2_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById("order_post").value = data.zonecode;
            document.getElementById("order_addr1").value = addr + ' ' + extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("order_addr2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width: '100%',
        height: '100%',
        maxSuggestItems: 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition() {
    var width = "450"; //우편번호서비스가 들어갈 element의 width 350
    var height = "500"; //우편번호서비스가 들어갈 element의 height 400
    var borderWidth = 1; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
}

// *** 다음 주소 api ***
</script>

<?php
include_once("./app_tail.php");
?>

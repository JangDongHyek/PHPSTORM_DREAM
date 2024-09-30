<?php
$pid = "cal_order_details";
include_once("./app_head.php");
/**
 * 22.05.20
 * 정기배달 도시락 주문내역 (new)
 */
?>

<style>
    .holi { color: red !important; }
</style>

<!--
주문 가능 불가능
day클래스 뒤에 on / off 클래스 추가
-->
<div id="sch">
    <form id="fsch" name="fsch" method="get">
        <select class="sch_input" id="cate" name="cate">
            <option value="정기배달" <?=$cate == "정기배달" ? "selected" : ""?>>정기배달</option>
        </select>
        <input type="date" id="st_date" name="st_date" class="sch_input" value="<?=$st_date ?>" onchange="$('#fsch').submit();"/>~<input type="date" id="ed_date" name="ed_date" class="sch_input" value="<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" onchange="$('#fsch').submit();"/>
    </form>
    <?php if($is_ios) { // IOS -- 사파리에서 바로 다운받을 수 있게 하기 위하여 중간 링크 한번 거쳐서 감?>
    <a href="<?=APP_URL?>/excel.php?mb_id=<?=$member['mb_id']?>&cate=정기배달&st_date=<?=$st_date?>&ed_date=<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" class="save_btn"><i class="fas fa-save"></i> 주문내역 엑셀파일다운</a>
    <?php } else { //AOS?>
    <a href="<?=APP_URL?>/excel_download.php?mb_id=<?=$member['mb_id']?>&cate=정기배달&st_date=<?=$st_date?>&ed_date=<?=empty($ed_date) ? date('Y-m-d') : $ed_date?>" class="save_btn"><i class="fas fa-save"></i> 주문내역 엑셀파일다운</a>
    <?php } ?>
</div>
<div id="order_details">
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
                        <h4 class="modal-title" id="myModalLabel">주문내역</h4>
                    </div>
                    <form id="forder" name="forder" method="post" action="./cal_order_complete.php">
                    <input type="hidden" id="w" name="w" value="u">
                    <input type="hidden" id="idx" name="idx" value=""> <!--주문idx-->
                    <input type="hidden" id="delivery_date" name="delivery_date"> <!--정기배달일-->
                    <input type="hidden" id="total_price" name="total_price"> <!--총금액-->
                    <div class="modal-body">
                        <!--ajax.get_order_data-->
                        <ul class="order_edit">
                            <!--<dt><i class="fa-regular fa-calendar-check"></i> <span id="ord_date"></span></dt>
                            <dd><span>일반 정기배달 도시락</span><strong><input class="frm_input" value="10" />개</strong></dd>
                            <dd><span>샐러드팩</span><strong><input class="frm_input" value="10" />개</strong></dd>-->
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <!--<ul>
                            <li><button type="button" class="btn btn-brown" id="btn_edit" onclick="editComplate();">주문수정</button></li>
                            <li><button type="button" class="btn btn-brown" id="btn_confirm" onclick="$('#myModal').modal('hide');">확인</button></li>
                        </ul>-->
                        <button type="button" class="btn btn-brown" id="btn_edit" onclick="editComplate();">주문수정</button>
                        <p id="p_edit" style="display: none;text-align: center;">주문 수정 가능 시간이 아닙니다.</p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="order_view">
        <h3><strong><?=$member['mb_name']?>님의 <strong id="ordermonth">5월</strong> 주문내역</strong><!-- <span>22.11.12</span--></h3>
        <div class="menu">
        <ul class="menulist v2">
            <!--<dd><span>일반 정기배달 도시락 10개</span><strong>99,000원</strong></dd>
            <dd><span>일반 정기배달 도시락(발열) 10개</span><strong>99,000원</strong></dd>
            <dd><span>프리미엄 정기배달 도시락 10개</span><strong>99,000원</strong></dd>
            <dd><span>샐러드팩 10개</span><strong>99,000원</strong></dd>-->
        </ul>
        </div>

        <!--<div class="total">
        <span>합계</span> <strong>594,000원</strong>
        </div>

        <br />

    	<h3>배송지정보</h3>
        <div class="info">
            <dl class="addr">
                <dt>주문배송지</dt>
                <dd>[48059] 부산 해운대구 센텀동로 6(우동)</dd>
            </dl>
            <dl class="date">
                <dt>받는사람</dt>
                <dd>홍길동</dd>
            </dl>
            <dl class="date">
                <dt>연락처</dt>
                <dd>010-1111-1111</dd>
            </dl>
            <dl class="memo">
                <dt>메모</dt>
                <dd>메모메모메모</dd>
            </dl>
        </div>
        <div class="ft_btn">
        	<a href="" class="btn edit">정보변경</a>
        </div>-->

    </div>
</div>

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

<!-- JavaScript -->
<script src="<?=G5_PLUGIN_URL?>/powerful-calendar/calendar2.js?v=<?=G5_JS_VER?>"></script> <!--주문달력-->
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

                //$('#ord_date').text(month + '월 ' + day + '일 (' + weekday[yoil] + ')'); // 선택일
                delivery_date = year + '-' + addZero(month) + '-' + addZero(day); // 선택일

                getOrder(delivery_date);
            },
        });
    }, 100);

    getOrder(cur_date.getFullYear()+'-'+addZero(cur_date.getMonth() + 1)); // 주문내역
});

// 주문내역
var deli_arr = [];
function getOrder(date) {
    var ord_date = "";
    // 특정 날짜를 선택하지 않으면 해당 월의 전체 주문내역, 특정 날짜를 선택하면 선택 날짜의 주문내역 표시
    if(delivery_date == "") { ord_date = $('.month-label').text(); }
    else { ord_date = formatDate(date) }
    $('#ordermonth').text(ord_date);

    $.ajax({
        url: './ajax.get_order.php',
        type: 'post',
        dataType: 'json',
        data: {date: date},
        async: false,
        success: function(data) {
            var html = "";
            for(var i=0; i<data.length; i++) {
                html += "<li>";
                html += "<span class='date'>주문날짜 "+data[i].wr_datetime+"</span>";
                html += "<h4><strong>"+data[i].do_name+" "+number_format(data[i].order_amount)+"개</strong> <a onclick='editOpen("+data[i].idx+", \""+data[i].delivery_date+"\", \""+data[i].total_price+"\")'>상세보기<i class='fa-regular fa-angle-right'></i> </a></h4>";
                html += "<p class='menu'><span>정기배달일 "+data[i].delivery_date+"</span> <strong>"+number_format(data[i].total_price)+"원</strong></p>";
                html += "</li>";

                deli_arr.push(data[i].delivery_date);
            }
            if(data.length == 0) {
                html += "<li class='nodata' style='text-align: center;'>주문내역이 없습니다.</li>";
            }
            $('.menulist').html(html);
        }
    });

    // 주문내역있으면 check 클래스 적용
    $('.jun_day').each(function() {
        var day = $(this)[0]['attributes'][1]['value'];
        if(deli_arr.includes(day)) {
            $(this).addClass('check');
        }
    });
}

// 상세정보 모달 오픈
function editOpen(idx, deli_date, total_price) {
    $('#btn_edit').show();
    $('#p_edit').hide();
    $('#p_edit').text('주문 수정 가능 시간이 아닙니다.');

    // 정기배달일(당일 8시 00분 전까지) 지남 ==> 수정못함
    // deli_date.replace(/-/gi, '/') ==> iOS에서 시간 계산이 정확하게 되지 않아 사용
    if(new Date().getTime() > new Date(deli_date.replace(/-/gi, '/') + ' 08:00:00').getTime()) {
        $('#btn_edit').hide();
        $('#p_edit').text('수정할 수 없는 주문입니다.');
        $('#p_edit').show();
    } else { // 정기배달일 안지남
        // 주문가능시간 아님 (8시 00분 ~ 09시 00분 주문 못함) ==> 수정못함 ==> 22.09.29 업체요청으로 주문 수정 불가능 시간 삭제
        //if('<?//=date('H:i', strtotime('08:00')) < date('H:i') && date('H:i') < date('H:i', strtotime('09:00'))?>//') {
        //     $('#btn_edit').hide();
        //     $('#p_edit').show();
        // }
    }

    $('#idx').val(idx);
    $('#delivery_date').val(deli_date);
    $.ajax({
        url: './ajax.get_order_data.php',
        data: {idx: idx},
        type: 'post',
        dataType: 'html',
        async: false,
        success: function(data) {
            $('.order_edit').html(data);
            $('#total_price').val(total_price);
        }
    })
    $('#myModal').modal('show');
}

// 날짜 월-일 (요일) 포맷으로 변경
function formatDate(date) {
    var tmp = new Date(date); // 선택 날짜

    var month = tmp.getMonth() + 1;
    var day = tmp.getDate();
    var yoil = tmp.getDay();

    return month + '월 ' + day + '일 (' + weekday[yoil] + ')';
}

// 주문 수량 확인 (도시락개당가격, 입력수량)
function amountChk(price, amount) {
    amount = amount.replace(/,/gi, "");

    var option_price = 0;
    var total = (price * amount) + option_price;
    $('#total').html(number_format(total.toString())+"원");
    $('#total_price').val(total);
}

// 수정 가능한지 체크
function editChk(delivery_date) {
    console.log('now: ', new Date());
    console.log('deli_date: ', new Date(delivery_date.replace(/-/gi, '/') + ' 08:00:00'));
    if(new Date() > new Date(delivery_date.replace(/-/gi, '/') + ' 08:00:00')) { // 정기배달일 지나면 수정 못함 (당일 8시 00분 전까지)
        console.log("수정불가");
    } else {
        console.log("수정가능");
    }
}

// 수정 완료
var is_post = false;
function editComplate() {
    if(is_post) {
        return false;
    }
    is_post = true;

    var f = $("#forder")[0];
    // 필수체크
    if(f.w.value == '') { // 주문 시에는 0을 입력할 수 없고 수정 시에는 0을 입력할 수 있음
        if(f.order_amount.value == 0) {
            swal("수량을 입력해 주세요.");
            is_post = false;
            return false;
        }
    }
    if(f.order_amount.value.length == 0) { // 미입력 시 체크
        swal("수량을 입력해 주세요.");
        is_post = false;
        return false;
    }
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
            if(data == 'success') {
                swal("주문이 수정되었습니다.")
                .then(()=> {
                    location.href = "./cal_order_details.php";
                });
            } else {
                swal("수정할 수 없는 주문입니다.")
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
        oncomplete: function(data) {
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
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                // document.getElementById("sample2_extraAddress").value = extraAddr;

            } else {
                // document.getElementById("sample2_extraAddress").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById("order_post").value = data.zonecode;
            document.getElementById("order_addr1").value = addr +' '+extraAddr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("order_addr2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
    var width = "450"; //우편번호서비스가 들어갈 element의 width 350
    var height = "500"; //우편번호서비스가 들어갈 element의 height 400
    var borderWidth = 1; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
// *** 다음 주소 api ***
</script>

<?php
include_once("./app_tail.php");
?>

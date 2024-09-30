$(function() {
    // 휴대번호 체크
    $("#order_tel").keydown(function (event) {
        var mb_hp = $(this);
        var key = event.charCode || event.keyCode || 0;
        if (key !== 8 && key !== 9) {
            if (mb_hp.val().length === 3) {
                mb_hp.val(mb_hp.val() + '-');
            }
            if (mb_hp.val().length === 8) {
                mb_hp.val(mb_hp.val() + '-');
            }
        }

        return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
    });
});

// 주문 수량 확인 (도시락개당가격, 입력수량, 발열도시락여부)
function amountChk(price, amount, warm) {
    amount = amount.replace(/,/gi, "");

    var option_price = 0;
    /*// 발열도시락으로 변경
    if (warm == "Y" && $('#option').val() == "Y") { // 개당 1,000원 추가 (추가금액옵션이 있을 경우만)
        if(amount == 0) {
            swal("수량을 입력해 주세요.");
            $("#order_amount").focus();
            return false;
        }

        option_price = amount * 1000;
    } else {
        option_price = 0;
    }*/

    //var total = (price * amount) + option_price + $('#shipping_fee').val()*1;
    var total = (price * amount) + option_price;
    if($('#category').val() == "정기배달" || $('#category').val() == "샐러드팩") {
        $('#total').html(number_format(total.toString())+"원");
    } else { // 행사용/샐러드팩
        $('#total').html("<span>(+) 배송비 "+number_format($('#shipping_fee').val())+"원</span>"+number_format(total.toString())+"원"); // 결제금액
    }
    $('#total_price').val(total);
}

// 주문 완료
var is_post = false;
function orderComplete(cate) {
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
    if(cate == "event") { // 일반도시락
        if(f.event_date.value == "") {
            swal("행사날짜를 선택해 주세요.");
            is_post = false;
            return false;
        }
        if(f.event_date.value < $('#today').val()) {
            swal("행사날짜를 다시 선택해 주세요.");
            $("#event_date").val("");
            is_post = false;
            return false;
        }
        if(f.event_time.value === "") {
            swal("행사시간을 입력해 주세요.");
            is_post = false;
            return false;
        }
        /*if(f.order_amount.value < $('#min_cnt').val()*1) {
            swal("최소주문수량은 "+$('#min_cnt').val()+"개 입니다.");
            is_post = false;
            return false;
        }*/
    }
    else { // 정기도시락
        if(f.delivery_date.value == "") {
            swal("정기배달시작일을 선택해 주세요.");
            is_post = false;
            return false;
        }
        if(f.delivery_date.value < $('#today').val() && f.w.value == "") {
            swal("정기배달시작일을 다시 선택해 주세요.");
            $("#delivery_date").val("");
            is_post = false;
            return false;
        }
        /*// 정기배달도시락 최소주문수량은 4개
        if(f.order_amount.value < 4) {
            swal("최소주문수량은 4개 입니다.");
            is_post = false;
            return false;
        }*/
    }

    $("#forder").submit();
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

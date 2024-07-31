
function swal(msg) {
    return Swal.fire({ text: msg });
}


$.fn.phoneFormat = function() {
    this.on('input', function() {
        var num = $(this).val().replace(/\D/g,'');
        var len = num.length;
        if(len < 4) {
            $(this).val(num);
        } else if(len < 7) {
            $(this).val(num.slice(0,3) + '-' + num.slice(3));
        } else if(len < 11) {
            var part1 = (num.slice(0,2) === '02') ? num.slice(0,2) : num.slice(0,3);
            var part2 = (num.slice(0,2) === '02') ? num.slice(2,5) : num.slice(3,6);
            var part3 = (num.slice(0,2) === '02') ? num.slice(5) : num.slice(6);
            $(this).val(part1 + '-' + part2 + '-' + part3);
        } else {
            $(this).val(num.slice(0,3) + '-' + num.slice(3,7) + '-' + num.slice(7));
        }
    });
    return this;
};

// 우편번호
function daum_zip(zip, addr1, addr2, addr3, addr4, triggerId = '') {
    const triggerElement = triggerId ? $(`#${triggerId}`) : $(`#${zip}`);

    if ($('#wrap').length === 0) {
        $(triggerElement).after(`
                <div id="wrap" style="display:none;border:1px solid;width:500px;height:300px;margin:5px 0;position:relative">
                    <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-1px;z-index:1" alt="접기 버튼">
                </div>
            `);
        $('#btnFoldWrap').click(function() {
            $('#wrap').hide();
        });
    }

    var element_wrap = $('#wrap');

    new daum.Postcode({
        oncomplete: function(data) {
            $('#' + zip).val(data.zonecode);
            $('#' + addr1).val(data.roadAddress || data.jibunAddress);
            $('#' + addr3).val(data.bname);
            $('#' + addr4).val(data.buildingName);
            $('#' + addr2).focus();
            $('#wrap').hide();
        },
        onresize: function(size) {
            element_wrap.height(size.height + 'px');
        },
        width: '100%',
        height: '100%'
    }).embed(element_wrap[0]);

    element_wrap.show();
}

// 에러메시지
function err_msg(err_id, msg, is_err = true) {
    let currentElement = $("#" + err_id);
    let msgText;
    let attempts = 0;
    let maxAttempts = 10;

    while (attempts < maxAttempts) {
        msgText = currentElement.nextAll('p.msg-text').first();

        if (msgText.length > 0) {
            msgText.removeClass('comp');
            if (!is_err) {
                msgText.addClass('comp');
            }
            msgText.text(msg).show();
            return;
        }

        currentElement = currentElement.parent();
        attempts++;
    }
}

function showLoading(show=true) {
    if(show){
        $("#loading").show();
    } else {
        $("#loading").hide();
    }
}


// Date to YYYY-mm-dd 포맷변환
function formatDate(date) {
    let year = date.getFullYear();
    let month = ('0' + (date.getMonth() + 1)).slice(-2);
    let day = ('0' + date.getDate()).slice(-2);
    return `${year}-${month}-${day}`;
}

// Date to YYYY-mm-dd 포맷변환
function formatDateTime(date) {
    let year = date.getFullYear();
    let month = ('0' + (date.getMonth() + 1)).slice(-2);
    let day = ('0' + date.getDate()).slice(-2);
    let hour = date.getHours();
    let min = date.getMinutes();
    let sec = date.getSeconds();
    return `${year}-${month}-${day} ${hour}:${min}:${sec}`;
}

function AddComma(num) {
    var regexp = /\B(?=(\d{3})+(?!\d))/g;
    num = Number(num) * 1;
    return num.toString().replace(regexp, ',');
}

// 날짜기간 생성
const getStartAndEndDate = (rangeType) => {
    let returnDateRange = {start: '', end: ''};
    const today = new Date();
    const now = dayjs();

    switch (rangeType.toString()) {
        case "1" : // 오늘
            returnDateRange.start = formatDate(today);
            returnDateRange.end = formatDate(today);
            break;

        case "2" : // 이번주
            let firstDay = today.getDate() - today.getDay() + 1;
            let lastDay = firstDay + 6;
            let firstDate = new Date(today.setDate(firstDay));
            // let lastDate = new Date(today.setDate(lastDay));
            // returnDateRange.start = formatDate(firstDate);
            // returnDateRange.end = formatDate(lastDate);
            let firstDateFormat = formatDate(firstDate);
            let lastDate = dayjs(firstDateFormat).add(6, 'day');
            let lastDateFormat = lastDate.format('YYYY-MM-DD');
            returnDateRange.start = firstDateFormat;
            returnDateRange.end = lastDateFormat;
            break;

        case "3" : // 이번달
            let thisMonthFirstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            let thisMonthLastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            returnDateRange.start = formatDate(thisMonthFirstDay);
            returnDateRange.end = formatDate(thisMonthLastDay);
            break;

        case "4" : // 지난달
            let lastMonthFirstDay = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            let lastMonthLastDay = new Date(today.getFullYear(), today.getMonth(), 0);
            returnDateRange.start = formatDate(lastMonthFirstDay);
            returnDateRange.end = formatDate(lastMonthLastDay);
            break;

        case "5" : // 3개월
            let last3MonthFirstDay = new Date(today.getFullYear(), today.getMonth() - 3, 1);
            let last3MonthLastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
            returnDateRange.start = formatDate(last3MonthFirstDay);
            returnDateRange.end = formatDate(last3MonthLastDay);
            break;
    }

    return returnDateRange;
}

// (상단 검색 공통) 기간선택
const changeDateRange = (value) => {
    const searchFrm = document.searchFrm;
    if (searchFrm) {
        const dateList = getStartAndEndDate(value);
        searchFrm.sdt.value = dateList.start;
        searchFrm.edt.value = dateList.end;
        searchFrm.submit();
    }
}
// (상단 검색 공통) 날짜선택
const changeInputDate = (value) => {
    const searchFrm = document.searchFrm;
    if (searchFrm) {
        const radios = document.querySelectorAll('[name=dtRange]');
        radios.forEach(radio => {
            radio.checked = false;
        });
        searchFrm.submit();
    }
}

// AJAX POST
const fetchData = async (url, bodyData, method = "POST") => {
    let requestOptions = {
        method: method, headers: {}, body: bodyData,
    };

    if (typeof bodyData === "object" && !(bodyData instanceof FormData)) {
        requestOptions.body = JSON.stringify(bodyData);
        requestOptions.headers["Content-Type"] = "application/json";
        requestOptions.headers["X-Requested-With"] = "XMLHttpRequest";
    }

    // GET 요청시 파라미터는 queryString으로만
    if (method == "GET") requestOptions = null;

    try {
        const apiHost = (baseUrl.endsWith('/'))? baseUrl.slice(0, -1) : baseUrl;
        const response = await fetch(apiHost + url, requestOptions);
        const data = await response.json();
        //console.log(`data:\n`, data);

        if (!response.ok) {
            // response 에러 -> catch
            throw new Error('Network response was not ok');
        }

        return data;

    } catch (error) {
        console.log('fetchJSON() error:\n', error);
        // throw error;
        return {result: false, message: '서버와의 통신에 실패했습니다.'};

    } finally {
        //showLoading(0);
    }
}

// 상태에따라 상품링크창열기
const openSiteGoodsNo = (status,SiteGoodsNo) => {
    if(status == 1){
        window.open('http://itempage3.auction.co.kr/DetailView.aspx?frm3=V2&itemNo=' + SiteGoodsNo );
    }else{
        window.open('https://item.gmarket.co.kr/Item?goodscode=' + SiteGoodsNo);
    }
}


var calendar = '';
const $calendar = $('#calendar');

function init() {
    let defaultConfig = {
        weekDayLength: 1,
        date: new Date(),
        onClickDate: selectDate,
        showYearDropdown: true,
        disable: function (date) {
            return date < new Date();
        }
    };

    calendar = $calendar.calendar(defaultConfig);    
}

function selectDate(date) {
    $calendar.updateCalendarOptions({
        date: date
    });
}

function selectedTime($this) {
    let $timeTab = $('.timeTab');

    $timeTab.removeClass('active');
    $this.addClass('active');
}

function getDateForamt(originalTimeStr){
    // Date 객체 생성
    const originalDate = new Date(originalTimeStr);

    // 날짜 정보 가져오기
    const year = '20'+originalDate.getFullYear().toString().slice(-2); // 연도의 마지막 두 자리 가져오기
    const month = String(originalDate.getMonth() + 1).padStart(2, '0'); // 월 가져오기 (0부터 시작하므로 +1, 두 자리로 맞추기)
    const day = String(originalDate.getDate()).padStart(2, '0'); // 일 가져오기 (두 자리로 맞추기)

    // YY-MM-dd 형식으로 조합
    const formattedTimeStr = `${year}-${month}-${day}`;

    return formattedTimeStr; // 출력 예: "23-07-27"
}

/* 
  fnc - onSumbitRental(대관신청)
   : floor - 층수
*/
async function onSumbitRental(floor) {
    let $rentName = $('#rentName'),
        $rentTel = $('#rentTel'),
        $rentEmail = $('#rentEmail'),
        $timeTab = $('.timeTab.active'),
        $isSetting = $('.isSetting:checked'),
        $isCleaning = $('.isCleaning:checked'),
        $glassRental = (floor == 1? $('#glassRental') : $('.glassRental:checked')),
        $person = $('#person'),
        $category = $('#category'),
        $detailSchedule = $('#detailSchedule'),
        $request = $('#request');

    if (!$rentName.val()) {
        showAlert('담당자 성함을 입력해주세요.', $rentName.focus());
        return;
    } else if (!$rentTel.val()) {
        showAlert('연락처를 입력해주세요.', $rentTel.focus());
        return;
    } else if (!$rentEmail.val()) {
        showAlert('이메일을 입력해주세요.', $rentEmail.focus());
        return;
    } else if (!$isSetting.val()) {
        showAlert('세팅 필요 여부 항목을 선택해주세요.', $('.isSetting').focus());
        return;
    } else if (!$isCleaning.val()) {
        showAlert('클리닝 필요 여부 항목을 선택해주세요.', $('.isCleaning').focus());
        return;
    } else if ((floor == 1 || floor == 2) && !$glassRental.val()) {
        if(floor == 1){
            showAlert('글라스 렌탈 필요수량을 기입해주세요.', $glassRental.focus());
        }else{
            showAlert('글라스 렌탈 항목을 선택해주세요.', $('.glassRental').focus());   
        }
        return;
    } else if (!$person.val()) {
        showAlert('인원을 입력해주세요.', $person.focus());
        return;
    } else if (!$category.val()) {
        showAlert('행사 유형을 입력해주세요.', $category.focus());
        return;
    } else if (!$detailSchedule.val()) {
        showAlert('당일 상세 일정을 입력해주세요.', $detailSchedule.focus());
        return;
    }
    
    const onSumbitRentalRes = await postJson(getAjaxUrl('rent'), {
        mode : 'sumbitRental',        
        floor : floor,
        rentDate : getDateForamt(calendar.getSelectedDate()),
        rentName : $rentName.val(),
        rentTel : $rentTel.val(),
        rentEmail : $rentEmail.val(),
        rentTime : parseInt($timeTab.data('time')),
        isSetting : $isSetting.val(),
        isCleaning : $isCleaning.val(),
        glassRental : (floor == 1 || floor == 2)? $glassRental.val() : '',
        person : $person.val(),
        category : $category.val(),
        detailSchedule : $detailSchedule.val(),
        request : $request.val()
    });
    
    if(!onSumbitRentalRes.result){
        showAlert(onSumbitRentalRes.msg);
        return;
    }
    
    showAlert("신청이 접수되었습니다.<br/><br/>내용 확인 후 1~3일 내 기재해주신 연락처로 비용 및 희망일 가능여부 안내가 진행됩니다.")
    .then(() => {
        location.replace(`${g5_url}/mypage.php`);
    });
}

$(function () {
    init();
});
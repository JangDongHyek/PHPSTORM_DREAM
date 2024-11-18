$(function(){

    var month_arr = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        day_arr = ['일', '월', '화', '수', '목', '금', '토'];

    $(".date_picker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        showButtonPanel: true,
        showMonthAfterYear : true,
        monthNames: month_arr,
        monthNamesShort: month_arr,
        dayNames : day_arr,
        dayNamesShort : day_arr,
        dayNamesMin : day_arr,
        currentText: '오늘',
        closeText: '닫기'
    });

})

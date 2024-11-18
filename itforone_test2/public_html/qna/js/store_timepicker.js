$(function() {
    $(".time_picker").timepicker({
        timeFormat: 'HH:mm',
        interval: 10,
        minTime: '08:00am',
        maxTime: '11:00pm',
        defaultTime: '08',
        startTime: $("#start_time").val(),
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

});

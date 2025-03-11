$(function(){
	//HRM tab
	$('.sub_tab.hrm ul li a').click(function(){
		var tab_on = $(this).attr('id');
		$('.tab').css('display','none');
		$('.sub_tab.hrm ul li a').css('background-position','0 -75px');

		$("."+tab_on).css('display','block');
		$(this).css('background-position','0 0');
	});

	//HRD tab
	$('.sub_tab.hrd ul li a').click(function(){
		var tab_on = $(this).attr('id');
		$('.tab').css('display','none');
		$('.sub_tab.hrd ul li a').css('background-position','0 -48px');

		$("."+tab_on).css('display','block');
		$(this).css('background-position','0 0');
	});
});

$(function(){
	$(".fz_list li").not(".fz_list_th").hover(function(){
		$(this).addClass('bg_e');
	}, function(){
		$(this).removeClass('bg_e');
	});
	$(".select_box").select_box({useBorderbox:true});
});
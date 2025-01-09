// JavaScript Document


function prog(){
	var position = $(window).scrollTop();
	$(".def .prod_st2").each(function (i) {
		var position_prog = $(this).find(".prog").offset().top;
		if(position+win_h-30 > position_prog){
			var defProg = $(".def .prog").width()/100;
			var per = $(this).find(".per").find(".no").text();
			$(this).find(".bar").animate({width:per+"%"},per*20,"easeInOutCubic");
		}
    });
}
function prog_end(){
	$(".end .prod_st2").each(function (i) {
		var no1 = $(this).find(".per").find(".no1").text();
		var no2 = $(this).find(".per").find(".no2").text();
		var endProg = $(".end .prog").width()/no2;
		$(this).find(".bar").css("width",endProg*no1)
		if(no1 == no2){
			$(this).find(".bar").css("background", "#6c727c")
			$(this).find(".per").css("color", "#fff")
		}
    });
}
$(function(){
	var prod_leng = $(".end .prod_list2 > .prod_st2").length
	if(prod_leng > 2){
	$(".end .prod_list2").addClass("st3")
	}
})
$(window).load(function(){
	prog_end()
	prog();
});
function gotop(){
	$('body, html').animate({ scrollTop: 0 }, 1000, "easeInOutCubic"); 
}
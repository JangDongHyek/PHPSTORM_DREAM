//���ϴܹٷΰ��� ��ư
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 0) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});	



//���ν����̵����
$(function(){ // �������
	
	 $(".main_slider").slidesjs({
	   width:817,
	   height:430,
	   navigation : {
		 active : true, // �¿��ư����ϸ� true, �ƴϸ� false
		 effect : "fade" // �¿��ư ���� �߻��Ǵ� ȿ������.
	   }, pagination : {
		 active : true,
		 effect : "fade"
	   }, play : {
		 active : true,
		 effect : "fade",
		 auto : true ,
		 interval: 2000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 1000,
				auto : true,
				crossfade: true
		 } 
	   }
	 })
}) // ���ೡ
//���ν����̵峡






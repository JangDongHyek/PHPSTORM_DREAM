//���ϴܹٷΰ��� ��ư
$(document).ready(function(){
	$("#gobtn").hide();
	 
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});
	
	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});	



//���ν����̵����
$(function(){ // �������
	
	 $(".main_slider").slidesjs({
	   width:2000,
	   height:480,
	   navigation : {
		 active : true, // �¿��ư����ϸ� true, �ƴϸ� false
		 //effect : "fade" // �¿��ư ���� �߻��Ǵ� ȿ������.
	   }, pagination : {
		 active : true,
		 //effect : "fade"
	   }, play : {
		 active : true,
		// effect : "fade",
		 auto : true ,
		 interval: 3000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 2500,
				crossfade: true
		 } 
	   }
	 })
}) // ���ೡ
//���ν����̵峡






//��ܸ޴�����
$(document).ready(function() {	
	$('.gnb .m').hover(function() {
		$('.sub', this).slideDown(200);
		$('.sun', this).css('display','block');
		$(this).children('a:first').addClass("hov");
	}, function() {
		$('.sub', this).slideUp(200);
		$('.sub', this).css('display','none');
		$(this).children('a:first').removeClass("hov");		
	});
});
//��ܸ޴���




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
		 interval: 5000
	   }, effect: {
		 slide: {
		 speed:1000 
		  },
		 fade : {
				speed : 3000,
				crossfade: true
		 } 
	   }
	 })
}) // ���ೡ
//���ν����̵峡






$(document).ready(function () {
	/*메뉴 영역*/
	//$('#m_content').wordBreakKeepAll();
    
    //용산 때문에 추가한 변수
 //   var space_gnb_2=[];
  //  var space_url_2;

	menu_f = 1;
	sub_menu_f =1;
	/*menu_h = $("#wrap").height();
	$("#menu_user").height((menu_h-49));*/
	$(".left").click(function(){
		if( menu_f==1){
			TweenLite.to($("#menu_user"), 0.5, {left:"0%" , ease:Power2.easeIn});
			menu_f++
		}else{
			TweenLite.to($("#menu_user"), 0.5, {left:"-50%" , ease:Power2.easeIn});
			menu_f--
		}
	});
	$(".main_menu li a").click(function(){
		$(this).next(".sub_menu").addClass("on");
		$(this).next(".sub_menu").slideToggle();
		$(".sub_menu:not(.on)").slideUp();
		$(".sub_menu").removeClass("on");
	});

	$(".tel_num").attr('href',''+tel_num+'');
	$(".pc_btn").attr('href',''+pc_url+'');
	

	/*탭 on/off*/
	var tap_n;
	$(".tap_ul li").click(function(){
		$(".tap_ul li").removeClass("on");
		$(this).addClass("on");
	})

	var suply_btn = $(".supply_list ul li:last-child").index()+1;
    suply_btn = 100/suply_btn
    $(".supply_list ul li").css('width',''+(suply_btn-0.5)+'%');







});




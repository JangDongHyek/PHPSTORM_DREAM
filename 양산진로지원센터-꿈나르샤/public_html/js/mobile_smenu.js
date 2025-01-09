// JavaScript Document


//HTML5 
	document.createElement('header');
	document.createElement('nav');
	document.createElement('section');
	document.createElement('article');
	document.createElement('footer');	
	
	
	
 //서브메뉴
var isShowMenuList = false;
function showMenuList() {
	if (isShowMenuList) {			
		$("#menu_list").hide();	
		$(".btn_img").removeClass("on")
	} else {
		$("#menu_list").show();
		$(".btn_img").addClass("on");
	}
	isShowMenuList = !isShowMenuList;
}


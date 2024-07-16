//$(document).ready(function(){
//	$("ul.panels li:not("+$("ul.tabs li a.selected").attr("href")+")").hide();
//	$("ul.tabs li a").click(function(){
//		$("ul.tabs li a").removeClass("selected");
//		$(this).addClass("selected");
//		$("ul.panels li").hide();
//		$($(this).attr("href")).show();
//		return false;
//	 });
//});


function inputPhoneNumber(obj) {

    var number = obj.value.replace(/[^0-9]/g, "");
    var phone = "";



    if(number.length < 4) {
        return number;
    } else if(number.length < 7) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3);
    } else if(number.length < 11) {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 3);
        phone += "-";
        phone += number.substr(6);
    } else {
        phone += number.substr(0, 3);
        phone += "-";
        phone += number.substr(3, 4);
        phone += "-";
        phone += number.substr(7);
    }
    obj.value = phone;
}



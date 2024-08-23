var hover=0;

$(document).ready(function() {
	let hover = 0;

	$('#hd').hover(function() {
		if (hover == 0) {
			$('.gnb_2dul').stop(true, true).slideDown(50);
			$('#hd').addClass('on');
		}
		setTimeout(function() {
			hover = 0;
		}, 1000);
		hover++;
	}, function() {
		$('.gnb_2dul').stop(true, true).slideUp(50);
		$('#hd_wrapper').animate({background: "transparent"}, 3000);
		$("#hd").removeClass("on");
	});
});



// mobile 해쉬메뉴
$(document).ready(function() {
	$(".mobile_open").click(function() {
		$("#mobile_menu,.page_cover,html").addClass("open");
		window.location.hash = "#open";
	});
	
	window.onhashchange = function() {
		if (location.hash != "#open") {
		$("#mobile_menu,.page_cover,html").removeClass("open");
		}
	};
});

//mobile 해쉬메뉴 > 메뉴
$(document).ready(function() {
	$("#mobile_menu .mgnb_1dli .mgnb_1da").click(function(){
		var dp = $(this).siblings("ul.mgnb_2dul").css("display");
		if(dp=="none"){
			$("#mobile_menu .mgnb_1dli .mgnb_1da").removeClass("on");
			$(this).addClass("on");
			$("#mobile_menu .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			$(this).siblings("ul.mgnb_2dul").slideDown(500);
			}
		if(dp=="block"){
			$("#mobile_menu .mgnb_1dli .mgnb_1da").removeClass("on");
			$("#mobile_menu .mgnb_1dli ul.mgnb_2dul").slideUp(500);
			}
		return false;
	});
});


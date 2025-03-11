

/* Navigation */
function naviAction() {
	var gnbD1 = $('#gnb > ul:first > li > a');
	var gnbD2 = gnbD1.parent().find('li > a');

	var lnbD2 = $('.lnb > li > a');
	var lnbD3 = $('.lnb > li > ul > li > a');
	var lnbD4 = $('.lnb > li > ul > li > ul > li > a');

	var className = 'on';
	var lFlag = false;
	var gFlag = false;

	var imgOn = 'On.png';
	var imgOff = 'Off.png';

	var gnbPrev = $('.topSearch').find('input:last');
	var gnbNext = lnbD2.eq(0);

	var docTitle1 = $('span:first', '#location').text();
	var docTitle2 = $('span:first', '#location').next().text();
	var docTitle3 = $('span:first', '#location').next().next().text();
	var docTitle4 = $('span:first', '#location').next().next().next().text();
	var lnbTitle;

	// LNB 4Depth 탐색
	lnbD4.each(function(){
		var onLnb = $(this);
		var onText = onLnb.text();
		if($.browser.msie){
			onText = $(onLnb.parent().html().replace('<BR>', '')).text();
		}
		if(onText == docTitle4){
			var tImg = onLnb.addClass(className).parents('ul:first').parents('li:first').children('a:first').addClass(className).parents('ul:first').parents('li:first').children('a:first').addClass(className).children('img:first');
			lnbTitle = tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn)).attr('alt');
			lFlag = true;
		}
	});

	// LNB 3Depth 탐색
	if(!lFlag && lnbD3.length > 0){
		lnbD3.each(function(){
			var onLnb = $(this);
			var onText = onLnb.text();
			if($.browser.msie){
				onText = $(onLnb.parent().html().replace('<BR>', '')).text();
			}
			if(onText == docTitle3){
				var tImg = onLnb.addClass(className).parents('ul:first').parents('li:first').children('a:first').addClass(className).children('img:first');
				lnbTitle = tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn)).attr('alt');
				lFlag = true;
			}
		});
	}

	// LNB 2Depth 탐색
	if(!lFlag && lnbD2.length > 0){
		lnbD2.each(function(){
			var onLnb = $(this);
			if(onLnb.children('img:first').attr('alt') == docTitle2){
				var tImg = onLnb.addClass(className).children('img:first');
				lnbTitle = tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn)).attr('alt');
			}else if(onLnb.text() == docTitle2){
				onLnb.addClass(className);
				lnbTitle =  docTitle2;
			}
		});
	}


	// GNB 2Depth 탐색
	if(docTitle2)
	{
		gnbD1.next().hide();
		gnbD2.each(function()
		{
			var onGnb = $(this);
			//onGnb.next().hide();
			//alert(docTitle2);
			if(onGnb.children('img:first').attr('alt') == docTitle2)
			{
				
				var tImg = onGnb.parents('ul:first').parents('li:first').find('a:first').addClass(className).find('img:first');
				tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn)).parent().next('div:first').css({display:'block'});
				//
				var tImg2 = onGnb.addClass(className).find('img:first');
				tImg2.attr('src', tImg2.attr('src').replace(imgOff, imgOn));
				
				
			}
		});
	}

	// GNB 1Depth 탐색
	if(!gFlag && lnbTitle){
		gnbD1.each(function(){
			var onGnb = $(this);
			if(onGnb.children('img:first').attr('alt') == docTitle1)
			{
				var tImg = onGnb.addClass(className).find('img:first');
				tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn));
			}

			// fallback
			if(!lFlag && lnbD2.length == 1){
				if(onGnb.children('img:first').attr('alt') == $('.lnb').prev().find('img:first').attr('alt')){
					var tImg = onGnb.addClass(className).find('img:first');
					tImg.attr('src', tImg.attr('src').replace(imgOff, imgOn));
				}
			}
		});
	}


	// GNB 2Depth 롤오버
	gnbD2.bind('mouseover focus', function(){
		var onGnb = $(this);
		if(!onGnb.hasClass(className)){
			onGnb.children('img:first').attr('src', onGnb.children('img:first').attr('src').replace(imgOff, imgOn));
		}
	})
	.bind('mouseout blur', function(){
		var onGnb = $(this);
		if(!onGnb.hasClass(className)){
			onGnb.children('img:first').attr('src', onGnb.children('img:first').attr('src').replace(imgOn, imgOff));
		}
	});


	// GNB 1Depth 롤오버
	gnbD1.bind('mouseover focus', function(){
		var onGnb = $(this);
		gnbD1.next().hide();
		if(onGnb.next('div:first')){
			if(!onGnb.hasClass(className)){
				onGnb.children('img:first').attr('src', onGnb.children('img:first').attr('src').replace(imgOff, imgOn));
			}
			onGnb.next('div:first').show();
		}
	})
	.bind('mouseout blur', function(){
		var onGnb = $(this);
		if(onGnb.next('div:first')){
			if(!onGnb.hasClass(className)){
				onGnb.children('img:first').attr('src', onGnb.children('img:first').attr('src').replace(imgOn, imgOff));
			}
		}
	});

	// LNB 2Depth 롤오버
	lnbD2.bind('mouseover focus', function(){
		var onlnb = $(this);
		if(!onlnb.hasClass(className)){
			onlnb.children('img:first').attr('src', onlnb.children('img:first').attr('src').replace(imgOff, imgOn));
		}
	}).bind('mouseout blur', function(){
		var onlnb = $(this);
		if(!onlnb.hasClass(className)){
			onlnb.children('img:first').attr('src', onlnb.children('img:first').attr('src').replace(imgOn, imgOff));
		}
	});

	// gnb 2뎁스 활성화시 1뎁스 오버기능 활성화 시켜놓기
	$('#gnb > ul:first > li ul').mouseover(function(){
		var onlnb = $(this);
		var tmpImg = onlnb.parents('li:first').find('img:first');
		tmpImg.attr('src', tmpImg.attr('src').replace(imgOff, imgOn));
	}).mouseout(function(){
		var onlnb = $(this);
		var tmpImg = onlnb.parents('li:first').find('img:first');
		if(!onlnb.parents('li:first').find('a:first').hasClass(className)){
			tmpImg.attr('src', tmpImg.attr('src').replace(imgOn, imgOff));
		}
	});





	/*gnbD2.each(function(){
		var onlnb = $(this);
		onlnb.focus(function(){
			var tmpImg = onlnb.parents('ul:first').parents('li:first').find('img:first');
			tmpImg.attr('src', tmpImg.attr('src').replace(imgOff, imgOn));
		}).blur(function(){
			var tmpImg = onlnb.parents('ul:first').parents('li:first').find('img:first');
			if(!onlnb.parents('ul:first').parents('li:first').find('a:first').hasClass(className)){
				tmpImg.attr('src', tmpImg.attr('src').replace(imgOn, imgOff));
			}
		});

	});*/

	/* LNB 접기펴기, 기능 사용할 LNB에 fold 클래스 추가 */
	if($('.lnb').hasClass('fold')){
		$('.lnb > li > ul').hide();
		lnbD2.each(function(){
			var onLnb = $(this);
			if(onLnb.hasClass(className)){
				onLnb.parent().children('ul').show();
			}
		});
	}

	// GNB 초기화
	$('#gnb').bind('mouseleave', function(){
		initGnb();
	});

	gnbNext.focus(function(){
		initGnb();
	});

	gnbPrev.focus(function(){
		initGnb();
	});

	function initGnb(){
		gnbD1.next().hide().prev().filter('[class=on]').next('div:first').hide();
	}
}



$(document).ready(function() {
	naviAction();

	$('input[type=text]').each(function(){
		var oInput = $(this);
		var oText = oInput.attr('value');
		oInput.focus(function(){
			if(oInput.attr('value') == oText){
				oInput.attr('value', '');
			}
		});
		oInput.blur(function(){
			if(oInput.attr('value') == ''){
				oInput.attr('value', oText);
			}
		});
	});

	
});





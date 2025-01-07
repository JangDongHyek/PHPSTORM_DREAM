/*
	hashClass/tranClass 클래스는 js 수정할 때 일괄적으로 수정 필요
*/
/*
	2017-07-03
	뒤로가기 빠르게 여러번 클릭시 페이지 이동 막아야함
*/

// 페이지 미리 불러오기
function hashload(){
	for(var i=0; i<$("a.data-load").length; i++){
		var hidx = $("a.data-load").eq(i).attr("id");
		hidx = hidx.replace("-", "_");
		var hid = "#" + hidx;

		// defualt setting
		var option = {
				hid			: hidx,													// ID 값				
				url			: $(hid).data("url"),													// ajax 로 불러올 url 경로
				ref			: $(hid).data("ref") ? $(hid).data("ref"):1,							// z-index 값
				animation	: $(hid).data("animation") ? $(hid).data("animation") : "left",			// 표현될 방법(left, right, top, bottom, fade)
				hashClass	: $(hid).data("hashClass") ? $(hid).data("hashClass") : "hash",			//hashClass 가 있으면 적용, 아니면 Default 값
				tranClass	: $(hid).data("tranClass") ? $(hid).data("tranClass") : "transform"		//tranClass 가 있으면 적용, 아니면 Default 값
		};

		if(option.url){
			$.ajax({
				type : "POST",
				url : option.url,
				data : { option : option },
				dataType:"html",
				async: false,
				success:function(datas){
						// 아작스로 불러온 페이지 설정
						setDatas(datas, option);
				},
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		}
	}
}

// 해쉬 바뀔때 불러오기
function hashAjax(hid){
	if(hid=="" || hid=="#"){
		clearSession("oldHash");
		clearSession("oldRef");
		clearSession("oldLangth");
	}

	hid = hid.replace("-", "_");
	var hidx = hid.replace("#", "");

	if(hidx){
		// defualt setting
		var option = {
				hid			: hidx,													// ID 값				
				url			: $(hid).data("url"),													// ajax 로 불러올 url 경로
				ref			: $(hid).data("ref") ? $(hid).data("ref"):1,							// z-index 값
				animation	: $(hid).data("animation") ? $(hid).data("animation") : "left",			// 표현될 방법(left, right, top, bottom, fade)
				hashClass	: $(hid).data("hashClass") ? $(hid).data("hashClass") : "hash",			//hashClass 가 있으면 적용, 아니면 Default 값
				tranClass	: $(hid).data("tranClass") ? $(hid).data("tranClass") : "transform"		//tranClass 가 있으면 적용, 아니면 Default 값
		};

		if(option.url){
			$.ajax({
				type : "POST",
				url : option.url,
				data : { option : option },
				dataType:"html",
				async: false,
				success:function(datas){
						// 아작스로 불러온 페이지 설정
						setDatas(datas, option);

						// setTimeout 을 쓰지 않으면 아작스로 불러왔을 때 한번에 나타남
						setShow(option);
						
				},
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		}
	}else{

		var len = $(".hash").length;

		setTimeout(function (){
			for(var i=0; i<len; i++){
				var tempClass = $(".hash").eq(i).attr("class").split(" ");
				$(".hash").eq(i).removeClass(tempClass[2]);

				setFade(i, tempClass[2]);
			}
		}, 100);
	}
}

function setDatas(datas, option){

	// div 에 hash-... 고유 아이디 부여
	var hid = "hash-" + option.hid;

	// div 가 없을때 불러옴
	if($("#" + hid).length == 0){
		
		// 필요한 글래스 와 data-ref 추가
		var div = $('<div />', {
						"id" : hid,
						"class" : option.hashClass + " " + option.hashClass + "-" + option.animation,
						"data-ref" : option.ref
					});
		div.append(datas);
		$("body").append(div);
	}
}

function setShow(option){
	var hashHid = "hash-" + option.hid;
	var hashRef = $("#" + hashHid).data("ref");
	var hashLan = window.history.length;
	
	var his = new Array();							// 히스토리
	his['oldHash']	= getSession("oldHash");
	his['oldRef']	= getSession("oldRef");
	his['oldLangth']= getSession("oldLangth");

	if(hashRef == 1 && his['oldRef']==1 && hashLan == his['oldLangth']){
		location.hash = "";
	}

	// hash 카운트
	var len = $(".hash").length;
	
	for(var i=0; i<len; i++){
		// 불러온 ref 값 보다 값이 같거나 더 높을 때, 높은 값들은 화면에서 제거, 해당 hid 일때는 제거안되도록
		if(hashRef <= $(".hash").eq(i).data("ref") && hashHid != $(".hash").eq(i).attr("id")){
			var tempClass = $("." + option.hashClass).eq(i).attr("class").split(" ");
			$("." + option.hashClass).eq(i).removeClass(tempClass[2]);
			
			setFade(i, tempClass[2]);
		}
	}
		
	// 페이드 설정
	if(option.animation == "fade"){
		$("#" + hashHid).css("display", "");
	}

	setTimeout(function (){
		$("#" + hashHid).addClass(option.tranClass + "-" + option.animation);

		setSession("oldHash", option.hid);
		setSession("oldRef", hashRef);
		setSession("oldLangth", window.history.length);
	}, 100);
	
}

// 페이드 설정
function setFade(i, temp){
	if(temp=="transform-fade"){
		var k = i;
		setTimeout(function (){
			$(".hash").eq(k).css("display", "none");
		}, 300);
	}
}

// 세션 생성
function setSession(sid, v){
	clearSession(sid);
	sessionStorage.setItem(sid, v);		
}

// 세션 불러오기
function getSession(sid){
	return sessionStorage.getItem(sid);
}

// 세션 삭제
function clearSession(sid){
	sessionStorage.removeItem(sid);						
}

function getHash(hid){
	location.hash = hid;
}

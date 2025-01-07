/*
	hashClass 클래스는 js 수정할 때 일괄적으로 수정 필요
*/

function hashAjax(hid){
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
		}else{
			var len = $(".hash").length;
			if(len == 0){
				history.back();
			}
		}
	}else{

		var len = $(".hash").length;

		setTimeout(function (){
			for(var i=0; i<len; i++){
				var tempClass = $(".hash").eq(i).attr("class").split(" ");
				$(".hash").eq(i).removeClass(tempClass[2]);

				if(tempClass[2]=="transform-fade"){
				}
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
	var hid = "hash-" + option.hid;

	var his = new Array();							// 히스토리
	var hah = new Array();							// 해쉬
	var ref;										// ref

	// 해쉬채인지가 실행될때마다 his-new, hah-now 세션 재설정
	his['new'] = getSession("his['new']");			// his-new 세션 얻기

	if(his['new'] == "NaN")
		his['new'] = 0;								// his-new 세션 설정
	else
		his['new'] = parseInt(getSession("his['new']"));
	
	if(hah['bef'] == hah['now'])
		his['new']--;// his-new 세션 얻기
	
	setSession("his['new']", his['new']);				// his-new 세션 설정
	setSession("hah['now']", window.history.length);	// hah-now 세션 설정
	
	
	hah['bef'] = getSession("hah['bef']");				// hah-bef 세션 얻기
	hah['now'] = getSession("hah['now']");				// hah-now 세션 얻기
	ref = getSession("ref");							// ref

	//alert(his['new'] + "//" + hah['bef'] + "//" + hah['now']);

	// hash 카운트
	var len = $(".hash").length;
	
	for(var i=0; i<len; i++){
		if($("#" + hid).data("ref") == $(".hash").eq(i).data("ref")){
			var tempClass = $("." + option.hashClass).eq(i).attr("class").split(" ");
			$("." + option.hashClass).eq(i).removeClass(tempClass[2]);
		}
		
		// 불러온 ref 값 보다 값이 더 높을 때, 높은 값들은 화면에서 제거 
		if($("#" + hid).data("ref") < $(".hash").eq(i).data("ref")){

			var tempClass = $("." + option.hashClass).eq(i).attr("class").split(" ");
			$("." + option.hashClass).eq(i).removeClass(tempClass[2]);
			
			if(tempClass[2]=="transform-fade"){
			}
		}
	}
		
	// hah-bef 와 hah-now 의 값이 값이 같을 경우, sesstion ref 와 data ref 가 1일 경우
	// 최상위 1,2 를 여러번 눌렀다가 뒤로가기로 닫았을 경우에
	// hisCnt 의 값 만큼 history.go(-x) 가 된다.
	// history.back() 이 아니라 바로닫기 기능
	if(hah['bef'] == hah['now'] && ref == 1 && $("#" + hid).data("ref") == 1){
		var hisCnt = his['new'] + 2;
		
		clearSession("hah['bef']");
		clearSession("hah['now']");
		clearSession("his['new']");
		clearSession("ref");
		
		if(hisCnt < 0)
			history.go(hisCnt);
	}

	// his-now, ref, hid 세션 설정
	setSession("hah['bef']", window.history.length);
	setSession("ref", $("#" + hid).data("ref"));
	setTimeout(function (){
		$("#" + hid).addClass(option.tranClass + "-" + option.animation);
		if(option.tranClass + "-" + option.animation == "transform-fade"){
		}
	}, 100);
	
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


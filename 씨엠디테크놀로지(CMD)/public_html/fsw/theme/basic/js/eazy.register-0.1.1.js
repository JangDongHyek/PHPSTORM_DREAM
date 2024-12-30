(function($){ 
	//함수 확장
	$.fn.regist = function(option){
		// 플러그인의 파라미터 기본값 설정
		var $val = $(this);

		var $i = 0;
		var defulatLabel = $val.find(".place-label").html();
		var explainText = $val.find(".explain-txt").html();
		
		//비밀번호 변수 설정
		pwText = "";
		reText = "";
		
		// defualt setting
		$.setting = {
			iconReqClass	: "icon-frm glyphicon",			// icon 필수 클래스
			textReqClass	: "explain-txt",				// text 필수 클래스
			
			//변경될 css 클래스 명과 상태
			iconClass1		: "glyphicon-minus-sign",		// default
			iconClass2		: "glyphicon-remove-sign",		// failed
			iconClass3		: "glyphicon-ok-sign",			// success
							  
			colorClass1		: "fc-default",					// default
			colorClass2		: "fc-failed",					// failed
			colorClass3		: "fc-success",					// success
			
			//textReqClass 와 값을 맞춰서 해당 값에 들어갈 값을 입력
			textHtml1		: "",							// default
			textHtml2		: "",							// failed
			textHtml3		: "",							// success
			
			// 글자길이
			minlength	: 6,			
			maxlength	: 20,
			
			strPattern	: "[]",								// 제외 문자 
			
			emailId		: false,							// 이메일 조건
			password	: false,							// 비밀번호 조건
			passwordRe	: false,							// 비밀번호 확인 조건
			pwre		: "",
			tmp			: ""
		};
		
		//사용자정의 파리미터 객체와 기본으로 설정한 값을 extend
		option = $.extend($.setting, option);
		
		//place-label을 클릭했을 때, 포커스는 해당 div 안 input으로
		$val.find(".place-label").click(function (){
			$val.find(".frm-input").focus();
		});
		
		$val.find(".frm-input").keydown(function (e){
			var nextFrm = $(this).index(".frm-input") + 1;

			if(e.keyCode == 13){
				$(".frm-input").eq(nextFrm).focus();
				return false;
			}
		});

		//input keyup
		$val.find(".frm-input").keyup(function (e){
			var str = $(this).val().trim();					// 공백제거
			var len = str.length;					// 글자길이
			
			//공백이 아닐때 place-label 값 제거, 공백일 때 label 추가
			if(str != "")
				$val.find(".place-label").html("");
			else
				$val.find(".place-label").html(defulatLabel);
			
			//띄어쓰기 입력시 공백제거 후 return
			if(e.keyCode==32)
				$(this).val(str);
			
			//특문 제거 패턴
			var pattern = new RegExp(option.strPattern);
			
			//케이스 점검
			$i = setCase(str, pattern, len);

			switch($i){
				case 0 : 
					$val.find(".icon-frm").removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
					$val.find(".explain-txt").removeClass().addClass(option.textReqClass + " " + option.colorClass1).html(option.textHtml1);
					break;
				case 1 :
					$val.find(".icon-frm").removeClass().addClass(option.iconReqClass + " " + option.iconClass2 + " " + option.colorClass2);
					$val.find(".explain-txt").removeClass().addClass(option.textReqClass + " " + option.colorClass2).html(option.textHtml2);
					break;
				case 2 : 
					$val.find(".icon-frm").removeClass().addClass(option.iconReqClass + " " + option.iconClass3 + " " + option.colorClass3);
					$val.find(".explain-txt").removeClass().addClass(option.textReqClass + " " + option.colorClass3).html(option.textHtml3);
					break;
				default : 
					break;
			}
		});

		function setCase(str, pattern, len){
			var i;
			var pass = false;
			var security = 0;
			
			if(option.password)
				security = setPassword(str, security);

			if(option.passwordRe)
				reText = str;
			
			if(option.pwre){
				if(reText != "" && pwText != reText){
					$(option.pwre).find(".icon-frm").removeClass().addClass(option.iconReqClass + " " + option.iconClass2 + " " + option.colorClass2);
					$(option.pwre).find(".explain-txt").removeClass().addClass(option.textReqClass + " " + option.colorClass2).html("비밀번호가 같지 않습니다.");
				}
			}

			// 이메일 확인
			if(option.emailId){
				if($(option.emailId).val()==""){
					if(option.tmp=="") 
						option.tmp = option.textHtml2;

					if(pattern.exec(str))
						option.textHtml2 = option.tmp;
					else
						option.textHtml2 = "이메일 주소를 모두 입력해주세요.";

					pass = true;
				}else{
					option.textHtml2 = option.tmp;
				}
			}

			if(pattern.exec(str)) pass = true;														//특문 제거
			else if(str.length < option.minlength || str.length > option.maxlength) pass = true;	//글자 길이
			else if(option.password && security < 2)pass = true;									//패스워드 조합확인
			else if(option.passwordRe && pwText != reText) pass = true;			//패스워드 확인
			
			
			if(len <= 0){
				i = 0;
			}else if(pass){
				i = 1;
			}else{
				i = 2;
			}
		
			return i;
		}
		
		function setPassword(str, security){
			if(str.search(/[A-Z]/gi) != -1) security++;
			if(str.search(/[0-9]/gi) != -1) security++;
			if(str.search(/[^0-9A-Z]/gi) != -1) security--;

			if(security >= 2)
				pwText = str;

			return security;
		}
	}

	//아이디 중복체크
	$.fn.idCheck = function(option){
		
		// defualt setting
		$.setting = {
			targetId	: "",			// target
			
			iconReqClass	: "icon-frm glyphicon",			// icon 필수 클래스
			textReqClass	: "explain-txt",				// text 필수 클래스
			
			//변경될 css 클래스 명과 상태
			iconClass1		: "glyphicon-remove-sign",		// failed
			iconClass2		: "glyphicon-ok-sign",			// success
							  
			colorClass1		: "fc-failed",					// failed
			colorClass2		: "fc-success",					// success
			
			//reClas 와 값을 맞춰서 해당 값에 들어갈 값을 입력
			textHtml1		: "",							// failed
			textHtml2		: "",							// success
			
			// 글자길이
			minlength	: 6,			
			maxlength	: 20,
			
			strPattern	: "[]"								// 제외 문자 

		};
		
		//사용자정의 파리미터 객체와 기본으로 설정한 값을 extend
		option = $.extend($.setting, option);
		
		$(this).click(function (){
			var t_input = $(option.targetId).find(".frm-input");
			var mb_id = t_input.val().trim();

			var pattern = new RegExp(option.strPattern);
			
			if(mb_id == ""){
				alert("아이디를 입력해주세요.");
				t_input.focus();
				return false;
			}
			
			if(mb_id.length < option.minlength || mb_id.length > option.maxlength){
				alert("아이디는 " + option.minlength + "자리 이상, " + option.maxlength + "이하여야 합니다.");
				t_input.focus();
				return false;
			}

			if(pattern.exec(mb_id)){
				alert("아이디는 영문/숫자만 입력가능합니다.");
				t_input.focus();
				return false;
			}

			$.ajax({
				type:"POST",
				url:"./ajax.mb_id_chk.php?mb_id="+mb_id,
				dataType:"html",
				success:function(datas){
					var i = parseInt(datas.trim());
					switch(i){
						case 0 : 
							$(option.targetId).find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass2).html(option.textHtml2);
							$(option.targetId).find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass2 + " " + option.colorClass2);
							break;
						default :
							$(option.targetId).find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html(option.textHtml1);
							$(option.targetId).find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
							break;
					}
				},
				error:function(request,status,error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		});
	}

	//이메일, 추후 수정필요할듯
	$.fn.email = function(option){
		
		// 플러그인의 파라미터 기본값 설정
		var $val = $(this);

		// defualt setting
		$.setting = {
			targetId	: "",			// target
			
			iconReqClass	: "icon-frm glyphicon",			// icon 필수 클래스
			textReqClass	: "explain-txt",				// text 필수 클래스
			
			//변경될 css 클래스 명과 상태
			iconClass1		: "glyphicon-remove-sign",		// failed
			iconClass2		: "glyphicon-ok-sign",			// success
							  
			colorClass1		: "fc-failed",					// failed
			colorClass2		: "fc-success",					// success
			
			//reClas 와 값을 맞춰서 해당 값에 들어갈 값을 입력
			textHtml1		: "이메일 주소를 모두 입력해주세요",							// failed
			textHtml2		: "",							// success
			
			// 글자길이
			minlength	: 6,			
			maxlength	: 20,
			
			strPattern	: "[]",								// 제외 문자 
			selectId	: "",
			targetId	: ""
		};
		
		//사용자정의 파리미터 객체와 기본으로 설정한 값을 extend
		option = $.extend($.setting, option);	


		$val.find(option.selectId).change(function (){
			$val.find(option.targetId).val($(this).val());
			var str2 = $val.find(".frm-input").val();

			//특문 제거 패턴
			var pattern2 = new RegExp("[!@#$%\^&()_=+`~{}<.>/?*:;\\\|\'\"]");

			
			if(pattern2.exec(str2)){
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html("이메일 주소는 영문/숫자만 입력가능합니다.");
				return false;
			}

			if($val.find(".frm-input").val()== "" || $val.find(option.targetId).val() == ""){
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html(option.textHtml1);
			}else{
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass2 + " " + option.colorClass2);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass2).html(option.textHtml2);
			}
		});

		$val.find(option.targetId).keyup(function (e){
			var str = $(this).val().trim();
			var str2 = $val.find(".frm-input").val();

			//특문 제거 패턴
			var pattern = new RegExp(option.strPattern);
			var pattern2 = new RegExp("[!@#$%\^&()_=+`~{}<.>/?*:;\\\|\'\"]");
			
			//띄어쓰기 입력시 공백제거 후 return
			if(e.keyCode==32){
				$(this).val(str);
				return false;
			}

			$val.find(option.selectId).find("option:eq(0)").prop("selected", true);
			
			if(pattern2.exec(str2)){
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html("이메일 주소는 영문/숫자만 입력가능합니다.");
				return false;
			}

			if(pattern.exec(str)){
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html("이메일 뒷자리에는 .을 제외한 특수문자는 들어갈 수 없습니다.");
			}else if($val.find(".frm-input").val()== "" || $val.find(option.targetId).val() == ""){
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass1 + " " + option.colorClass1);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass1).html(option.textHtml1);
			}else{
				$val.find('.icon-frm').removeClass().addClass(option.iconReqClass + " " + option.iconClass2 + " " + option.colorClass2);
				$val.find('.explain-txt').removeClass().addClass(option.textReqClass +" "+ option.colorClass2).html(option.textHtml2);
			}
		});
	}
})(jQuery);

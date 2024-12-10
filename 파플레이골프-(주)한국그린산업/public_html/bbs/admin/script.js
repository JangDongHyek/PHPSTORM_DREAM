if (REQUIRE_ONCE == null)
{
    // 한번만 실행되게
    var REQUIRE_ONCE = true;

    var wrestMsg = "";
    var wrestFld = null;
    var wrestFldDefaultColor = "f5ffff";
    var wrestFldBackColor = "ffe4e1";
    var arrAttr  = new Array ("required", "trim", "minlength", "email", "nospace");

    // subject 속성값을 얻어 return, 없으면 tag의 name을 넘김
    function wrestItemname(fld)
    {
        var itemname = fld.getAttribute("itemname");
        if (itemname != null && itemname != "")
            return itemname;
        else
            return fld.name;
    }

    // 양쪽 공백 없애기
    function wrestTrim(fld) 
    {
        var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
        fld.value = fld.value.replace(pattern, "");
        return fld.value;
    }

    // 필수 입력 검사
    function wrestRequired(fld)
    {
        if (wrestTrim(fld) == "") {
            if (wrestFld == null) {
								if(fld.type == "select-one")
                	wrestMsg = wrestItemname(fld) + "을(를) 선택해주세요.\n";
								else
                	wrestMsg = wrestItemname(fld) + "는(은) 필수 입력사항입니다.\n";
                wrestFld = fld;
            }
        }
    }

    // 최소 길이 검사
    function wrestMinlength(fld)
    {
        var len = fld.getAttribute("minlength");
        if (fld.value.length < len) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "는(은) 최소 " + len + "자 이상 입력하세요.\n";
                wrestFld = fld;
            }
        }
    }

    // 전자메일주소 형식 검사
    function wrestEmail(fld) 
    {
        if (!wrestTrim(fld)) return;

        //var pattern = /(\S+)@(\S+)\.(\S+)/; 전자메일주소에 한글 사용시
        var pattern = /([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/;
        if (!pattern.test(fld.value)) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "는(은) 전자메일주소 형식이 아닙니다.\n";
                wrestFld = fld;
            }
        }
    }

    // 공백 검사후 공백을 "" 로 변환
    function wrestNospace(fld)
    {
        var pattern = /(\s)/g; // \s 공백 문자
        if (pattern.test(fld.value)) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "는(은) 공백이 없어야 합니다.\n";
                wrestFld = fld;
            }
        }
    }

    // submit 할 때 속성을 검사한다.
    function wrestSubmit()
    {
        wrestMsg = "";
        wrestFld = null;

        var attr = null;

        // 해당폼에 대한 요소의 갯수만큼 돌려라
        for (var i = 0; i < this.elements.length; i++) {
            // Input tag 의 type 이 text, file, password 일때만
            if (this.elements[i].type == "text" || 
                this.elements[i].type == "file" || 
                this.elements[i].type == "password" ||
								this.elements[i].type == "select-one" || 
                this.elements[i].type == "textarea") {
                // 배열의 길이만큼 돌려라
                for (var j = 0; j < arrAttr.length; j++) {
                    // 배열에 정의한 속성과 비교해서 속성이 있거나 값이 있다면
                    if (this.elements[i].getAttribute(arrAttr[j]) != null) {
                        // 기본 색상으로 돌려놓고
//                        this.elements[i].style.backgroundColor = wrestFldDefaultColor;
                        switch (arrAttr[j]) {
                            case "required"  : wrestRequired(this.elements[i]); break;
                            case "trim"      : wrestRequired(this.elements[i]); break;
                            case "minlength" : wrestMinlength(this.elements[i]); break;
                            case "email"     : wrestEmail(this.elements[i]); break;
                            case "nospace"   : wrestNospace(this.elements[i]); break;
                            default : break;
                        }
                    }
                }
            }
        }

        // 필드가 null 이 아니라면 오류메세지 출력후 포커스를 해당 오류 필드로 옮김
        // 오류 필드는 배경색상을 바꾼다.
        if (wrestFld != null) {
            alert(wrestMsg);
//            wrestFld.style.backgroundColor = wrestFldBackColor;
            wrestFld.focus();
            return false;
        }

        if (this.oldsubmit && this.oldsubmit() == false)  {
            return false;
        }

        return true;
    }

    // 초기에 onsubmit을 가로채도록 한다.
    function wrestInitialized()
    {
        for (var i = 0; i < document.forms.length; i++) {
            // onsubmit 이벤트가 있다면 저장해 놓는다.
            if (document.forms[i].onsubmit) document.forms[i].oldsubmit = document.forms[i].onsubmit;
            document.forms[i].onsubmit = wrestSubmit;
            for (var j = 0; j < document.forms[i].elements.length; j++) {
                // 필수 입력일 경우는 * 배경이미지를 준다.
                if (document.forms[i].elements[j].getAttribute("required") != null) {
//                    document.forms[i].elements[j].style.backgroundColor = wrestFldDefaultColor;
                    /*
                    document.forms[i].elements[j].className = "wrest_required";
                    document.forms[i].elements[j].style.backgroundPosition = "top right";
                    document.forms[i].elements[j].style.backgroundRepeat = "no-repeat";
                    */
                }
            }
        }
    }

	// 주민등록번호 검사
	function jumin_check(j1, j2) 
	{
			if (j1.value.length < 6 || j2.value.length < 7)
					return false;
	
			var sum_1 = 0;
			var sum_2 = 0;
			var at=0;
			var juminno= j1.value + j2.value;
			sum_1 = (juminno.charAt(0)*2)+
							(juminno.charAt(1)*3)+
							(juminno.charAt(2)*4)+
							(juminno.charAt(3)*5)+
							(juminno.charAt(4)*6)+
							(juminno.charAt(5)*7)+
							(juminno.charAt(6)*8)+
							(juminno.charAt(7)*9)+
							(juminno.charAt(8)*2)+
							(juminno.charAt(9)*3)+
							(juminno.charAt(10)*4)+
							(juminno.charAt(11)*5);
			sum_2=sum_1 % 11;
	
			if (sum_2 == 0) {
					at = 10;
			} else {
					if (sum_2 == 1) 
							at = 11;
					else 
							at = sum_2;
			}
			att = 11 - at;
			if (juminno.charAt(12) != att) {
					return false;
			}
	
			return true
	}

	// 회원아이디 중복검색 창
	function popup_id(frm_name, dir, frm_id, id)
	{		
			if( id.value == '' ) {
				alert("아이디를 입력해주세요.")
				id.focus();
				return false;
			}
			url = dir+'confirm_id.php?frm_name='+frm_name+'&frm_id='+frm_id+'&id='+id.value;
			opt = 'scrollbars=no,width=355,height=200';
			window.open(url, "mbid", opt);
	}

	// 닉네임 중복검색 창
	function popup_nick(frm_name, dir, frm_nick, nick)
	{	
			if( nick.value == '' ) {
				alert("닉네임을 입력해주세요.")
				nick.focus();
				return false;
			}
			url = dir+'confirm_nick.php?frm_name='+frm_name+'&frm_nick='+frm_nick+'&nick='+nick.value;
			opt = 'scrollbars=no,width=355,height=200';
			window.open(url, "mbwriter", opt);
	}
	
	// 우편번호 창
	function popup_zip(frm_name, dir, frm_zip1, frm_zip2, frm_addr1, frm_addr2)
	{
			url = dir+'confirm_zip.php?frm_name='+frm_name+'&frm_zip1='+frm_zip1+'&frm_zip2='+frm_zip2+'&frm_addr1='+frm_addr1+'&frm_addr2='+frm_addr2;
			opt = 'scrollbars=yes,width=500,height=300';
			window.open(url, "mbzip", opt);
	}
		
	// 회원아이디 목록창
	function popup_mb_list(frm_name, dir, frm_id, frm_num, key, multi)
	{		
			if(!multi) multi=1
			if(!key) key=''
			url = dir+'popup_member_list.php?frm_name='+frm_name+'&frm_id='+frm_id+'&frm_num='+frm_num+'&key='+key+'&multi='+multi;
			opt = 'scrollbars=yes,width=450,height=500';
			window.open(url, "popup_mb_list", opt);
	}

	// 암호 전송창
	function popup_passwd(dir)
	{	
			url = dir+'send_passwd.php';
			opt = 'scrollbars=no,width=450,height=380';
			window.open(url, "mbpasswd", opt);
	}
	
	// 삭제 검사 확인
	function del(href) 
	{
			if(confirm("정말 삭제하시겠습니까?")) 
					document.location.href = href;
	}

	// 경고메시지
	function warning_msg(type)
	{	
		switch(type) {
			case 'login' : alert("로그인하신후 사용하세요.")
				break;
			}
		return;			
	}

	// 로그인 메시지
	function before_login(dir)
	{	
		alert("로그인 하신후 사용하세요.");
		location.href=dir+'login.php?url='+location.href;
	}

	// 체크박스에 하나라도 체크되면 참
	function list_checkbox(form,fname) {
		var Check_List=false;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(form[i].checked) Check_List=true;
			}
		}
		return Check_List;
	}

  // 배열체크박스의 값을 ,로 연결한다.
	function list_checkbox_value(form,fname) {
		var _reslut='';
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(form[i].checked) {
					if(_reslut=='')
						_reslut = form[i].value
					else
						_reslut = _reslut + ','+form[i].value
				}
			}
		}
		return _reslut;
	}
	

	var layername = 'rg_layer_div'

	function rg_layer_action(name, status)
	{
		var obj = document.all[name];

		if (typeof(obj) == 'undefined') {
			return;
		}

		if (status) {
			obj.style.visibility = status;
		} else {
			if(obj.style.visibility == 'visible')
				obj.style.visibility='hidden';
			else
				obj.style.visibility='visible';
		}
	}

	function rg_layer(dir,bbs_id, id, name, email, homepage, profile, skin_url)
	{
		// event.clientX : 클릭한곳의 X 좌표
		// event.clientY : 클릭한곳의 Y 좌표
		// obj.offsetWidth  : DIV 오브젝트의 폭
		// obj.offsetHeight : DIV 오브젝트의 높이
		// document.body.clientWidth  : 브라우저의 폭
		// document.body.clientHeight : 브라우저의 높이
		// document.body.scrollLeft : 스크롤 Left
		// document.body.scrollTop  : 스크롤 Top
		// obj.style.posLeft : DIV 오브젝트의 X 좌표
		// obj.style.posTop  : DIV 오브젝트의 Y 좌표

		var obj = document.all[layername];
		var x, y;
		var body = "";
		var height = 0;

		x = event.clientX + document.body.scrollLeft - 20;
		y = event.clientY + document.body.scrollTop - 20;
		obj.style.posLeft = x;
		obj.style.posTop = y;
		/*
		if (id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"memo.php?mode=write&mo_recv_mb_id="+id+"', 'mbmemo', 'left=50,top=50,width=500,height=400,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"memo_icon.gif border=0 width='12' height='12'> &nbsp;쪽지보내기&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		*/
		if (name && bbs_id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"location.href='"+dir+"list.php?bbs_id="+bbs_id+"&ss[sn]=1&ss[kw]="+name+"';\"><td height=20>&nbsp; <IMG src="+skin_url+"namesearch_icon.gif border=0 width='12' height='12'> &nbsp;이름으로 검색&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		
		if (email) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"admin/member_mail.php?condition=SELECT * FROM $db_table_member WHERE mb_id=%27"+id+"%27', 'profile', 'left=50,top=50,width=650,height=650,scrollbars=0');\"><td height=20>&nbsp; <IMG src="+skin_url+"mail_icon.gif border=0 width='12' height='12'> &nbsp;메일보내기&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (homepage) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+homepage+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"home_icon.gif border=0 width='12' height='12'> &nbsp;홈페이지&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (parseInt(profile)) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"mb_profile.php?mb_id="+id+"', 'profile', 'left=50,top=50,width=600,height=600,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"me_icon.gif border=0 width='12' height='12'> &nbsp;인쇄하기&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (body) {
			var layer_body = "<table border=0 width=100%><tr><td colspan=3 height=10></td></tr><tr><td width=5></td><td bgcolor=222222 style='cursor:hand'><table border=0 cellspacing=0 cellpadding=3 width=100% height=100% bgcolor=e5e5e5>"+body+"</table></td><td width=10></td></tr><tr><td colspan=3 height=10></td></tr></table>";
			obj.innerHTML = layer_body;
			obj.style.width = 150;
			obj.style.height = height;
			obj.style.visibility='visible';
		}
	}

	function rg_init_layer(layername)
	{
		document.writeln("<div id="+layername+" style='position:absolute; left:1px; top:1px; width:1px; height:1px; z-index:1; visibility: hidden' onmousedown=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseout=\"rg_layer_action('"+layername+"', 'hidden')\" onmouseover=\"rg_layer_action('"+layername+"', 'visible')\">");
		document.writeln("</div>");
	}
	
	rg_init_layer('rg_layer_div');
  wrestInitialized();
}

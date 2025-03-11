if (REQUIRE_ONCE == null)
{
    // �ѹ��� ����ǰ�
    var REQUIRE_ONCE = true;

    var wrestMsg = "";
    var wrestFld = null;
    var wrestFldDefaultColor = "f5ffff";
    var wrestFldBackColor = "ffe4e1";
    var arrAttr  = new Array ("required", "trim", "minlength", "email", "nospace");

    // subject �Ӽ����� ��� return, ������ tag�� name�� �ѱ�
    function wrestItemname(fld)
    {
        var itemname = fld.getAttribute("itemname");
        if (itemname != null && itemname != "")
            return itemname;
        else
            return fld.name;
    }

    // ���� ���� ���ֱ�
    function wrestTrim(fld) 
    {
        var pattern = /(^\s*)|(\s*$)/g; // \s ���� ����
        fld.value = fld.value.replace(pattern, "");
        return fld.value;
    }

    // �ʼ� �Է� �˻�
    function wrestRequired(fld)
    {
        if (wrestTrim(fld) == "") {
            if (wrestFld == null) {
								if(fld.type == "select-one")
                	wrestMsg = wrestItemname(fld) + "��(��) �������ּ���.\n";
								else
                	wrestMsg = wrestItemname(fld) + "��(��) �ʼ� �Է»����Դϴ�.\n";
                wrestFld = fld;
            }
        }
    }

    // �ּ� ���� �˻�
    function wrestMinlength(fld)
    {
        var len = fld.getAttribute("minlength");
        if (fld.value.length < len) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "��(��) �ּ� " + len + "�� �̻� �Է��ϼ���.\n";
                wrestFld = fld;
            }
        }
    }

    // ���ڸ����ּ� ���� �˻�
    function wrestEmail(fld) 
    {
        if (!wrestTrim(fld)) return;

        //var pattern = /(\S+)@(\S+)\.(\S+)/; ���ڸ����ּҿ� �ѱ� ����
        var pattern = /([0-9a-zA-Z_-]+)@([0-9a-zA-Z_-]+)\.([0-9a-zA-Z_-]+)/;
        if (!pattern.test(fld.value)) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "��(��) ���ڸ����ּ� ������ �ƴմϴ�.\n";
                wrestFld = fld;
            }
        }
    }

    // ���� �˻��� ������ "" �� ��ȯ
    function wrestNospace(fld)
    {
        var pattern = /(\s)/g; // \s ���� ����
        if (pattern.test(fld.value)) {
            if (wrestFld == null) {
                wrestMsg = wrestItemname(fld) + "��(��) ������ ����� �մϴ�.\n";
                wrestFld = fld;
            }
        }
    }

    // submit �� �� �Ӽ��� �˻��Ѵ�.
    function wrestSubmit()
    {
        wrestMsg = "";
        wrestFld = null;

        var attr = null;

        // �ش����� ���� ����� ������ŭ ������
        for (var i = 0; i < this.elements.length; i++) {
            // Input tag �� type �� text, file, password �϶���
            if (this.elements[i].type == "text" || 
                this.elements[i].type == "file" || 
                this.elements[i].type == "password" ||
								this.elements[i].type == "select-one" || 
                this.elements[i].type == "textarea") {
                // �迭�� ���̸�ŭ ������
                for (var j = 0; j < arrAttr.length; j++) {
                    // �迭�� ������ �Ӽ��� ���ؼ� �Ӽ��� �ְų� ���� �ִٸ�
                    if (this.elements[i].getAttribute(arrAttr[j]) != null) {
                        // �⺻ �������� ��������
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

        // �ʵ尡 null �� �ƴ϶�� �����޼��� ����� ��Ŀ���� �ش� ���� �ʵ�� �ű�
        // ���� �ʵ�� �������� �ٲ۴�.
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

    // �ʱ⿡ onsubmit�� ����ä���� �Ѵ�.
    function wrestInitialized()
    {
        for (var i = 0; i < document.forms.length; i++) {
            // onsubmit �̺�Ʈ�� �ִٸ� ������ ���´�.
            if (document.forms[i].onsubmit) document.forms[i].oldsubmit = document.forms[i].onsubmit;
            document.forms[i].onsubmit = wrestSubmit;
            for (var j = 0; j < document.forms[i].elements.length; j++) {
                // �ʼ� �Է��� ���� * ����̹����� �ش�.
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

	// �ֹε�Ϲ�ȣ �˻�
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

	// ȸ�����̵� �ߺ��˻� â
	function popup_id(frm_name, dir, frm_id, id)
	{		
			if( id.value == '' ) {
				alert("���̵� �Է����ּ���.")
				id.focus();
				return false;
			}
			url = dir+'confirm_id.php?frm_name='+frm_name+'&frm_id='+frm_id+'&id='+id.value;
			opt = 'scrollbars=no,width=355,height=200';
			window.open(url, "mbid", opt);
	}

	// �г��� �ߺ��˻� â
	function popup_nick(frm_name, dir, frm_nick, nick)
	{	
			if( nick.value == '' ) {
				alert("�г����� �Է����ּ���.")
				nick.focus();
				return false;
			}
			url = dir+'confirm_nick.php?frm_name='+frm_name+'&frm_nick='+frm_nick+'&nick='+nick.value;
			opt = 'scrollbars=no,width=355,height=200';
			window.open(url, "mbwriter", opt);
	}
	
	// �����ȣ â
	function popup_zip(frm_name, dir, frm_zip1, frm_zip2, frm_addr1, frm_addr2)
	{
			url = dir+'confirm_zip.php?frm_name='+frm_name+'&frm_zip1='+frm_zip1+'&frm_zip2='+frm_zip2+'&frm_addr1='+frm_addr1+'&frm_addr2='+frm_addr2;
			opt = 'scrollbars=yes,width=500,height=300';
			window.open(url, "mbzip", opt);
	}
		
	// ȸ�����̵� ���â
	function popup_mb_list(frm_name, dir, frm_id, frm_num, key, multi)
	{		
			if(!multi) multi=1
			if(!key) key=''
			url = dir+'popup_member_list.php?frm_name='+frm_name+'&frm_id='+frm_id+'&frm_num='+frm_num+'&key='+key+'&multi='+multi;
			opt = 'scrollbars=yes,width=450,height=500';
			window.open(url, "popup_mb_list", opt);
	}

	// ��ȣ ����â
	function popup_passwd(dir)
	{	
			url = dir+'send_passwd.php';
			opt = 'scrollbars=no,width=450,height=380';
			window.open(url, "mbpasswd", opt);
	}
	
	// ���� �˻� Ȯ��
	function del(href) 
	{
			if(confirm("���� �����Ͻðڽ��ϱ�?")) 
					document.location.href = href;
	}

	// ���޽���
	function warning_msg(type)
	{	
		switch(type) {
			case 'login' : alert("�α����Ͻ��� ����ϼ���.")
				break;
			}
		return;			
	}

	// �α��� �޽���
	function before_login(dir)
	{	
		alert("�α��� �Ͻ��� ����ϼ���.");
		location.href=dir+'login.php?url='+location.href;
	}

	// üũ�ڽ��� �ϳ��� üũ�Ǹ� ��
	function list_checkbox(form,fname) {
		var Check_List=false;
		for(i=0;i<form.length;i++) {
			if(form[i].type=="checkbox" && form[i].name==fname) {
				if(form[i].checked) Check_List=true;
			}
		}
		return Check_List;
	}

  // �迭üũ�ڽ��� ���� ,�� �����Ѵ�.
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
		// event.clientX : Ŭ���Ѱ��� X ��ǥ
		// event.clientY : Ŭ���Ѱ��� Y ��ǥ
		// obj.offsetWidth  : DIV ������Ʈ�� ��
		// obj.offsetHeight : DIV ������Ʈ�� ����
		// document.body.clientWidth  : �������� ��
		// document.body.clientHeight : �������� ����
		// document.body.scrollLeft : ��ũ�� Left
		// document.body.scrollTop  : ��ũ�� Top
		// obj.style.posLeft : DIV ������Ʈ�� X ��ǥ
		// obj.style.posTop  : DIV ������Ʈ�� Y ��ǥ

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
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"memo.php?mode=write&mo_recv_mb_id="+id+"', 'mbmemo', 'left=50,top=50,width=500,height=400,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"memo_icon.gif border=0 width='12' height='12'> &nbsp;����������&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		*/
		if (name && bbs_id) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"location.href='"+dir+"list.php?bbs_id="+bbs_id+"&ss[sn]=1&ss[kw]="+name+"';\"><td height=20>&nbsp; <IMG src="+skin_url+"namesearch_icon.gif border=0 width='12' height='12'> &nbsp;�̸����� �˻�&nbsp;&nbsp;</td></tr>";
			height += 20;
		}
		
		if (email) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"admin/member_mail.php?condition=SELECT * FROM $db_table_member WHERE mb_id=%27"+id+"%27', 'profile', 'left=50,top=50,width=650,height=650,scrollbars=0');\"><td height=20>&nbsp; <IMG src="+skin_url+"mail_icon.gif border=0 width='12' height='12'> &nbsp;���Ϻ�����&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (homepage) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+homepage+"');\"><td height=20>&nbsp; <IMG src="+skin_url+"home_icon.gif border=0 width='12' height='12'> &nbsp;Ȩ������&nbsp;&nbsp;</td></tr>";
			height += 20;
		}

		if (parseInt(profile)) {
			body += "<tr onmouseover=this.style.backgroundColor='#ffffff' onmouseout=this.style.backgroundColor='#e5e5e5' onmousedown=\"window.open('"+dir+"mb_profile.php?mb_id="+id+"', 'profile', 'left=50,top=50,width=600,height=600,scrollbars=1');\"><td height=20>&nbsp; <IMG src="+skin_url+"me_icon.gif border=0 width='12' height='12'> &nbsp;�μ��ϱ�&nbsp;&nbsp;</td></tr>";
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

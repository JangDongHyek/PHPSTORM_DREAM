<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <link href="../admin/admin.css" rel="stylesheet" type="text/css">
  <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
  </style>
</HEAD>

 <BODY>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

              
              <tr>
                <td><!--���� �ٵ�--><link rel=stylesheet type=text/css href="/css/css.css">
<script language="javascript" src="/js/openWin.js"></script>
<script language="javascript" src="/js/registCheckForm.js"></script>
<script language="javascript">
function cal_pre(field)
{
	var tmpStr;
	var form = eval ("document.signform." + field);
	tmpStr = form.value;
	cal_byte(field, tmpStr);
}

//�޼���â�� byte ���
function cal_byte(field, aquery) 
{
	var tmpStr;
	var temp=0;
	var onechar;
	var tcount;
	tcount = 0;
	 
	tmpStr = new String(aquery);
	temp = tmpStr.length;

	for (k=0;k<temp;k++)
	{
		onechar = tmpStr.charAt(k);

		if (escape(onechar).length > 4) {
			tcount += 2;
		}
		else if (onechar!='\r') {
			tcount++;
		}
	}

	var cbyte_form = eval ("document.signform." + field + "_cbyte");
	var value_form = eval ("document.signform." + field);
	cbyte_form.value = tcount;

	if (tcount > 80) {
		reserve = tcount - 80;
		alert("�޽��� ������ 80����Ʈ �̻��� �����ϽǼ� �����ϴ�.\r\n ���� �޽����� "+reserve+"����Ʈ�� �ʰ��Ǿ����ϴ�.\r\n �ʰ��� �κ��� �ڵ����� �����˴ϴ�."); 
		nets_check(field, value_form.value, 80);
		return;
	}	
}

function nets_check(field, aquery, max)
{
	var tmpStr;
	var temp=0;
	var onechar;
	var tcount;
	tcount = 0;
	 
	tmpStr = new String(aquery);
	temp = tmpStr.length;

	for(k=0;k<temp;k++)
	{
		onechar = tmpStr.charAt(k);
		
		if(escape(onechar).length > 4) {
			tcount += 2;
		}
		else if(onechar!='\r') {
			tcount++;
		}
		if(tcount>max) {
			tmpStr = tmpStr.substring(0,k);			
			break;
		}
	}
	
	if (max == 80) {
		var form = eval ("document.signform." + field);
		form.value = tmpStr;
		cal_byte(field, tmpStr);
	}
	
	return tmpStr;
}

// �޼���â�� Ư�� ���� �Է�
function inputSchar(schar)
{
	f = document.signform;
	f.mbs_msg_member_join.focus();
	f.mbs_msg_member_join.value += schar;
	cal_pre('mbs_msg_member_join');
}

// Ư�� ���ڿ� ����� �޼��� â ��ȯ
function change_menu(service_name) {
	if(service_name=='schar')//card
	{
		special_char.style.display = "block";
		save_msg.style.display = "none";
	} //
	else if(service_name=='smsg')//ISP
	{
		special_char.style.display = "none";
		save_msg.style.display = "block";
	} //
} //function change_menu()

// �׷� ���� ��ȣ ��� �߰�
function insertPhone(insPhone1) {
	
	var fullPhone;
	var make_length;
	
	f = document.signform;

	if(f.phone2.value.search(/(\d+)/) == -1  || f.phone3.value.search(/(\d+)/) == -1)
		alert('��ȣ�� ��Ȯ�ϰ� �Է��Ͽ� �ֽʽÿ�');
	else {

		// fullphone�� ��ȣ �Է�.
		fullPhone = insPhone1+"-"+f.phone2.value+"-"+f.phone3.value;
		
		if(f.send_phone.options.length >= 20000) {
			alert('20000�� ������ �׷� ������ �����մϴ�.\n�� �̻��� �����Ҷ��� �ּҷϿ��� �����Ͽ� �ֽʽÿ�.');
		} else {
			// �ܿ��Ǽ� üũ. options �׸��� ������ �ܿ��Ǽ����� ���ų� Ŭ��� ƨ�ܳ���.
			if(f.send_phone.options.length >= 2000)
				alert('������ SMS �����ܿ� �Ǽ��� �����մϴ�.\n������ My ȣ���ÿ��� �����Ͻ� �� �ֽ��ϴ�.');
			else {
				f.send_phone.options.length = f.send_phone.options.length + 1;
				make_length = f.send_phone.options.length;

				f.send_phone.options[make_length - 1].text = fullPhone;
				f.send_phone.options[make_length - 1].value = fullPhone;

				f.number_receive_people.value = parseInt(f.number_receive_people.value) + 1;
				
				// �Է��� �Է¶� ����
				f.phone2.value = '';
				f.phone3.value = '';
				f.phone2.focus();
				//f.send_phone.options[f.send_phone.options.length] = new Option(fullPhone);
			}
		}
	} //end f.phone2.value || f.phone3.value
}

// �׷� ���� ��ȣ ��� ����
function removePhone(rmvPhone) {
	f = document.signform;
	
	if(rmvPhone >= 0) { // if nothing is selected then the value of rmvPhone is negative.
		f.send_phone[rmvPhone] = null;
		f.number_receive_people.value = parseInt(f.number_receive_people.value) - 1;
	}
	else
		alert('������ ��ȣ�� ���� ��Ͽ��� �����Ͽ� �ֽʽÿ�');
}

// �ٽ� �ۼ� ��ư Ŭ����
function clrMsg() {
	f = document.signform;
	f.mbs_msg_member_join.value = ''
	cal_pre('mbs_msg_member_join');
	f.mbs_msg_member_join.focus();
}

// ���, ���� ���� ���ý� ��¥ ���� ����
function trsfRsrv(choice) {
	
	f = document.signform;

	if(choice) {
		f.start_year.disabled = true;
		f.start_month.disabled = true;
		f.start_day.disabled = true;
		f.start_hour.disabled = true;
		f.start_min.disabled = true;
	} else {
		f.start_year.disabled = false;
		f.start_month.disabled = false;
		f.start_day.disabled = false;
		f.start_hour.disabled = false;
		f.start_min.disabled = false;
	}
	
}

// ���� �����Կ��� �ڵ������� ���� ����
function cpyMsg(msg) {
	signform.mbs_msg_member_join.focus();
	signform.mbs_msg_member_join.value = msg.replace(/<br>/g, '\n');
	cal_pre('mbs_msg_member_join');
}

// ���� �����Կ��� �޼��� ����
function rmvMsg(no) {
	signform.mode.value='delmsg';
	signform.delmsgnum.value=no;
	signform.submit();
}

// ���� ������ â ����
function openwin(url, w, h, scroll)
{
        myWindow = window.open(url, "Now", "width="+w+",height="+h+",scrollbars="+scroll+",resizable=no,left=0,top=0");
}

// �޼��� ����!
function sendMsg() {
	f = document.signform;
	var allPhone = '';
	
	// ȸ�Ź�ȣ�� ��ȿ�� üũ
	if(f.rphone.value.search(/(\d+)/) == -1 ) {
		alert('��ȣ�� ��Ȯ�ϰ� �Է��Ͽ� �ֽʽÿ�');
		return
	}

	// ������ ��ȭ��ȣ�� 1�� �̻� �ִ��� üũ
	if(f.send_phone.options.length <= 0) {
		alert('������ ��ȭ��ȣ�� �Է��Ͽ� �ֽʽÿ�');
		f.phone2.focus();
		return
	}
	
	// ������ �޼����� �ִ��� üũ
	if(f.mbs_msg_member_join.value == '') {
		f.mbs_msg_member_join.focus();
		alert('������ �޼����� �Է��Ͽ� �ֽʽÿ�');
		return
	}

	for(i=0; i<f.send_phone.options.length; i++) 
		 allPhone += f.send_phone.options[i].value+',';
	
	f.allPhone.value = allPhone;


	f.submit();
}
function openadd()
{
sms_mem_list=window.open('sms_mem_list.php','sms_mem_list','left=50,top=10,width=500,height=600,yes,scrollbars=yes');
sms_mem_list.focus();
}
</script>
</head>

<body onLoad="javascript:cal_pre('mbs_msg_member_join')">
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<form name='signform' method='post' action='./sms_send_process.php' >
<input type=hidden name='mode' value=''>
<input type=hidden name='delmsgnum' value=''>
<input type=hidden name='allPhone' value=''>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
 
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="170"><table width="164" border="0" cellspacing="0" cellpadding="0">
                 <tr>
                    <td valign="top"><TABLE cellSpacing=0 cellPadding=0 border=0>
                        <TBODY>
                          <TR>
                            <TD  background="images/typebox_top.gif" width=164 height=54 
                      colSpan=3 align=middle vAlign=center><INPUT 
                        style="border:0px; BACKGROUND-COLOR: #fafbfb; TEXT-ALIGN: right" 
                        readOnly maxLength=3 size=2 value=0 
                        name=mbs_msg_member_join_cbyte>
                                <SPAN class=ad> / 80 byte&nbsp;&nbsp;<BR>
                                <BR>
                              </SPAN></TD>
                          </TR>
                          <TR>
                            <TD width=23 
                      background="images/typebox_left.gif" 
                      height=81></TD>
                            <TD align=middle width=118 bgColor=#84D8F2 height=81><TEXTAREA class=sms onKeyUp="javascript:cal_pre('mbs_msg_member_join')" name=mbs_msg_member_join rows=7 cols=13></TEXTAREA></TD>
                            <TD width=23 
                      background="images/typebox_right.gif" 
                      height=81></TD>
                          </TR>
                          <TR>
                            <TD  background="images/typebox_bottom.gif" width=164 
                      colSpan=3 height=63></TD>
                          </TR>
                        </TBODY>
                    </TABLE></td>
                  </tr>
              </table></td>
              <td valign="top"><table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                  <!-- Ư�� ���� �Է� -->
                  <DIV id="special_char" style="display:;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="97" height="26" background="images/sms_tab2.gif" style="padding-top:5px;"><div align="center">
                          <span class="style1"><strong> Ư������</strong></span></td>
                        <!-- <td width="97" background="/images/sms_tab.gif" style="padding-top:5px;"><div align="center" style="cursor:hand" onClick="change_menu('smsg')"><strong>���ں�����</strong></td> -->
                        <td width="97" >&nbsp;</td>
                        <td valign="top"><div align="right"><img src="images/sms_btn3.gif" width="98" height="20" style="cursor:hand" onClick="openadd()"></div></td>
                      </tr>
                    </table>
                    <table width="100%" height="168" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                      <tr bgcolor="#FFFFFF">
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">�� </td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">�� </td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                      </tr>
                      <tr bgcolor="#FFFFFF">
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">�� </td>
                        <td align=center class="text" style="cursor:hand" onClick="inputSchar('��')" OnMouseOver="this.style.backgroundColor='FAF1B2'" OnMouseOut="this.style.backgroundColor=''">��</td>
                      </tr>
                    </table>
                  </div>
                <!-- ����� �޼��� -->
                  <DIV id="save_msg" style="display:none;">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="97" height="26" background="/images/sms_tab.gif" style="padding-top:5px;"><div align="center" style="cursor:hand" onClick="change_menu('schar')"><strong>Ư������</strong></div></td>
                      <!-- <td width="97" background="/images/sms_tab.gif" style="padding-top:5px;"><div align="center" style="cursor:hand" onClick="change_menu('smsg')"><strong>���ں�����</strong></td> -->
                      <td width="97" >&nbsp;</td>
                      <td valign="top"><div align="right"><img src="/images/sms_btn3.gif" width="98" height="20" style="cursor:hand" onClick="openadd()"></div></td>
                    </tr>
                  </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div class="TABLE_SCROLL">
                          <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                            <tr bgcolor="#EAEAEA">
                              <td width="300" colspan=2><div align="center"><strong>���� </strong></div></td>
                              <td width="60"><div align="center"><strong>����</strong></div></td>
                            </tr>
                            <tr bgcolor="#FFFFFF">
                              <td colspan=3 align=center ><font color=red>����� �޼����� �����ϴ�.</font></td>
                            </tr>
                          </table>
                      </div></td>
                    </tr>
                </table></td>
            </tr>
            <tr>
              <td height="35"><div align="center">
                  <!-- <img src="/images/sms_btn1.gif" style="cursor:hand" onClick="openwin('popup_sms_keeping.asp', 400, 330, 'no')">  -->
                  <img src="images/sms_btn2.gif" width="61" height="20" style="cursor:hand" onClick="clrMsg()"> </div></td>
              <td>&nbsp;</td>
            </tr>
          </table>
            <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="7" height="7"><img src="images/box_top_left.gif" width="7" height="7"></td>
                <td background="images/box_top_center.gif"></td>
                <td width="7" height="7"><img src="images/box_top_right.gif" width="7" height="7"></td>
              </tr>
              <tr>
                <td background="images/box_middle_left.gif"></td>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="8">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="320" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td width="100%" height="25"><strong class="text">���� ��ȣ �Է�</strong>
                                      <select name="phone1" >
                                        <option selected value=010>010</option>
                                        <option value=011>011</option>
                                        <option value=016>016</option>
                                        <option value=017>017</option>
                                        <option value=018>018</option>
                                        <option value=019>019</option>
                                      </select>
                                    -
                                    <input name="phone2" type="text" size="5" maxlength="4">
                                    -
                                    <input name="phone3" type="text" size="6" maxlength="4">
                                    <span class="POINT04">
                                      <INPUT 
                        style="border:0px; BACKGROUND-COLOR: #fafbfb; TEXT-ALIGN: right" 
                        readOnly maxLength=4 size=4 value=0 
                        name=number_receive_people>
                                      ��</span></td>
                                </tr>
                                <tr>
                                  <td height="35" valign="bottom" style="padding-right:52px;"><div align="right"> <img src="images/sms_btn4.gif" width="46" height="20" style="cursor:hand" onClick="javascript:insertPhone(document.signform.phone1.options[document.signform.phone1.options.selectedIndex].value);"> <img src="images/sms_btn5.gif" width="46" height="20" style="cursor:hand" onClick="javascript:removePhone(document.signform.send_phone.options.selectedIndex)"> </div></td>
                                </tr>
                            </table></td>
                            <td valign="top"><div align="center">
                                <select name="send_phone"  style="width:200px;" size="4" multiple>
                                </select>
                            </div></td>
                          </tr>
                        </table>
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td height="1" background="images/dot2.gif"></td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="320" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td height="30" valign="top"><span class="text"><strong>ȸ�� ��ȣ �Է�</strong></span>
                                        <input name="rphone" type="text" size="15" maxlength="16" value=''>                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                          </table>
</td>
                    </tr>
                </table></td>
                <td background="images/box_middle_right.gif"></td>
              </tr>
            </table>
            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="50" valign="bottom"><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><table width="120" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="22" height="29"><td style="cursor:hand" onClick="sendMsg()"><img src="images/jung_butten.gif" width="104" height="27"></td>
                            <td width="8">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</form>
<? include("admin.footer.php"); ?>
                </BODY>
</HTML>

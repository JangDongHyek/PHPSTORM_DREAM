<?
include "../lib/Mall_Admin_Session.php";
?>
<?
//�׷� ���� ��ġ
$cur_category_name = category_navi($category_num);

$SQL = "select * from $MartDesignTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
if(mysql_num_rows($dbresult)>0){
	mysql_data_seek($dbresult, 0);
	$ary=mysql_fetch_array($dbresult);
	$item_zoom_module = $ary["item_zoom_module"];
}
$SQL = "select * from $MartMngInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0){
	mysql_data_seek($dbresult,0);
	$ary = mysql_fetch_array($dbresult);
	$if_gnt_item = $ary["if_gnt_item"];
	$if_customer_price = $ary["if_customer_price"];
}
//����Ʈ ����
$shop_sql2 = "select * from $MartMngInfoTable where mart_id ='$mart_id'";
$shop_res2 = mysql_query($shop_sql2, $dbconn);
$row2 = mysql_fetch_array($shop_res2);
$bonus_auto_ok = $row2[bonus_auto_ok];
$bonus_auto_percent = $row2[bonus_auto_percent];

//echo $item_explain;
//exit;
if(!isset($flag)||$flag==""){
	$reg_date = date(Y)."-".date(m)."-".date(d);
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(frm){
	if(frm.item_name.value==""){
		alert("\nȸ���̸��� �Է��ϼ���.");
		frm.item_name.focus();
		return false;
	}	
	


	if (frm.item_code.value==""){
		alert("ȸ����ȣ�� �Է��ϼ���");
		frm.item_code.focus();
		return false;
	}
	if (frm.item_pw.value==""){
		alert("ȸ�� ��й�ȣ�� �Է��ϼ���");
		frm.item_pw.focus();
		return false;
	}



	if (frm.start_date.value==""){
		alert("ȸ���Ⱓ�� �Է��ϼ���");
		frm.start_date.focus();
		return false;
	}

	if (frm.end_date.value==""){
		alert("ȸ���Ⱓ�� �Է��ϼ���");
		frm.end_date.focus();
		return false;
	}



	return true;
}
function createXMLHttpRequest(){
	if(window.ActiveXObject){
		xmlHttpRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}else if(window.XMLHttpRequest){
		xmlHttpRequest=new XMLHttpRequest();
	}
	return xmlHttpRequest;
}
xmlHttpRequest=createXMLHttpRequest();
function idcheck(){
	var item_id = document.writeform.item_id.value;
	var url = "../category/xml_id_check.php";
	


        var uid = document.getElementById("item_id");


        if(!/^[a-zA-Z0-9]{4,16}$/.test(uid.value))

        { 
            alert('���̵�� ���ڿ� ������ �������� 4~16�ڸ��� ����ؾ� �մϴ�.');
            uid.value = "";
            uid.focus();
            return false;
        }

        var chk_num1 = uid.value.search(/[0-9]/g); 
        var chk_eng1 = uid.value.search(/[a-z]/ig); 

        if(chk_num1 < 0 || chk_eng1 < 0)
        { 
            alert('���̵�� ���ڿ� �����ڸ� ȥ���Ͽ��� �մϴ�.');
            uid.value = "";
            uid.focus(); 
            return false;
        }

	
	
		if(xmlHttpRequest){
			try{
				if(item_id){
					if(xmlHttpRequest.readyState==4||xmlHttpRequest.readyState==0){
						var params="mart_id=<?=$mart_id?>&form_info=f.item_id&user_id="+encodeURIComponent(item_id);
						//POST������� xmltest.php�� ����, �񵿱������ �ҷ���
						xmlHttpRequest.open("post",url,true);
						//������ ��û�ϰ� ������ �ޱ� ���� �Լ�(�޼���)
						xmlHttpRequest.onreadystatechange=Member_check;
						//�ѱ� ���� �����ϱ� ���� ��
						xmlHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=euc-kr');
						xmlHttpRequest.send(params);
					}else{}
				}	
			}catch(e){}
		}else{
				alert("�������� ������ �����ϴ�.");
		}
		//checkwin.focus(); 
	
}
function Member_check(){
	var id_chk=document.getElementById("id_chk");
	if(xmlHttpRequest.readyState==4){
			if(xmlHttpRequest.status==200){
				var xml=xmlHttpRequest.responseTEXT;
				var item_id = document.writeform.item_id.value;
				//�ߺ��� ���̵� ������ ���̵� ��밡��
				if(xml==0){
					id_chk.innerHTML=document.writeform.item_id.value+"�� ��� ������ ���̵��Դϴ�.";
					document.writeform.g_pw.focus();
				//�׷��� ���� ��� ���̵� ���Ұ�
				}else{
					id_chk.innerHTML=document.writeform.item_id.value+"�� ������� ���̵��Դϴ�.";
					document.writeform.item_id.value="";
					document.writeform.item_id.focus();
				}
			}
		}else{
			id_chk.innerHTML="(���̵�� ������, ���� �����ؼ� 6���̻�)";
		}
}
</script>


<script language="javascript">
<!--
function opensub2(x)
{	
	var child;
	window.open(x,'x' ,'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,width=800,height=200,left=0,top=0');
}
// -->
</script>
<script language="javascript">

//*************************** ���� ���ε� â ******************************

function fileup(formname,imagename, title){
// formname : form �� name
// mart_id : ���� mart_id
// imagename : ���ε�Ǵ� �̹��� ������ �ԷµǴ� field name, �� ���� DB�� ����
	
	var url = "../file_upload_2img.php?formname="+formname+"&imagename="+imagename+"&title="+title
	var uploadwin = window.open(url,"uploadwin","width=350,height=100,scrollbars=no,toolbar=no,navationbar=no,resizable=no");
}

//*************************** ���� ���ε� â *********************************
</script>
<script>
/*
var blnBodyLoaded = false;
var blnEditorLoaded = false;

function HandleLoad() {
	blnBodyLoaded = true;
	if (blnEditorLoaded == true) {
		init();
	}
}

function setEditMode(sMode){
	var f = document.writeform;
	f.editBox.editmode = sMode;
}

function init() {
	var f = document.writeform;
	f.editmode[0].click();
	f.editBox.editmode = "html";
	f.editBox.html = f.item_explain.value;
	f.editBox.focus();
	f.editBox.setFocus();
}

function checkform1(){
	var f = document.writeform;
	f.editBox.editmode = "html";
	f.item_explain.value = f.editBox.html;
	return true;
}*/
</script>
<SCRIPT event="onscriptletevent(name, eventData)" for=editBox>
if (name == "onafterload") {
	blnEditorLoaded = true;
	if (blnBodyLoaded == true) {
		init();
	}
}
</SCRIPT>
<script language="javascript">
//�޸� �ֱ�(������ �ش�) 
function comma(val){ 
	val = get_number(val); 
	if(val.length <= 3) return val; 

	var loop = Math.ceil(val.length / 3); 
	var offset = val.length % 3; 
	if(offset==0) offset = 3; 
	var ret = val.substring(0, offset); 
	for(i=1;i<loop;i++) { 
	ret += "," + val.substring(offset, offset+3); 
	offset += 3; } return ret; 
} 

//���ڿ����� ���ڸ� �������� 
function get_number(str){ 
	var val = str; 
	var temp = ""; 
	var num = ""; 

	for(i=0; i<val.length; i++){ 
		temp = val.charAt(i); 
		if(temp >= "0" && temp <= "9") num += temp; 
	} 
	return num; 
}
//���ڸ� �Է��ϱ� 
function checkNumber(){
	var objEv = event.srcElement;
	var num ="0123456789,";
	event.returnValue = true;
	 
	for (var i=0;i<objEv.value.length;i++){
		if(-1 == num.indexOf(objEv.value.charAt(i)))
		event.returnValue = false;
	}
	 
	if (!event.returnValue)
	objEv.value="";
}
//����Ʈ �ڵ����
function checkPrice(){
	var form = document.writeform;
	var z_p = form.address2.value;
	form.bonus.value = Math.floor((z_p * <?=$bonus_auto_percent?>) / 100);
}
//����Ʈ �ڵ����
function checkPrice_opt(){
	var form = document.writeform;
	var z_p2 = form.pro_price1.value;
	form.pro_bonus1.value = Math.floor((z_p2 * <?=$bonus_auto_percent?>) / 100);
}

//���� ����ϱ�
function cal(){
	var here = document.writeform;
	var pr = eval(here.zip.value);
	var gr = eval(here.g_margin.value);
	var tot = Math.ceil( ( pr * (100+ gr) ) / 100 );
	here.address2.value=tot;
	here.bonus.focus();
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function toggle1(iobject){
		document.all.auto.style.display = ""
		document.all.passive.style.display = "none"
}	
function toggle2(iobject){
		document.all.auto.style.display = "none"
		document.all.passive.style.display = ""
}
//-->
</SCRIPT>
<style>
.fc_main { background: #DDDDDD; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { font-family: tahoma; border: 1px solid #D9D9D9;  cursor:pointer; font-size: 8pt; text-align: center;}
.fc_dateHover, TD.fc_date:hover { font-family: tahoma;cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 8pt; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 11px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 11px; text-align: center;}
.fc_wknd1 { color: blue; font-weight: bold; font-size: 11px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
.style1 {color: #003399;font-weight: bold;}
.style2 {color: #007eb9;font-weight: bold;}
</style>
<script language="javascript">
	var fc_ie = false;
	if (document.all) { fc_ie = true; }
	
	var calendars = Array();
	var fc_months = Array('1��', '2��', '3��', '4��', '5��', '6��', '7��', '8��', '9��', '10��', '11��', '12��');
	var fc_openCal;

	var fc_calCount = 0;
	
	function getCalendar(fieldId) {
		return calendars[fieldId];
	}
	
	function displayCalendarFor(fieldId) {
		var formElement = fc_getObj(fieldId);
		displayCalendar(formElement);
	}
	
	function displayCalendar(formElement) {
		if (!formElement.id) {
			formElement.id = fc_calCount++;
		} 
		var cal = calendars[formElement.id];
		if (typeof(cal) == 'undefined') {
			cal = new floobleCalendar();
			cal.setElement(formElement);
			calendars[formElement.id] = cal;
		}
		if (cal.shown) {
			cal.hide();
		} else {
			cal.show();
		}
	}
	
	function display3FieldCalendar(me, de, ye) {
		if (!me.id) { me.id = fc_calCount++; }
		if (!de.id) { de.id = fc_calCount++; }
		if (!ye.id) { ye.id = fc_calCount++; }
		var id = me.id + '-' + de.id + '-' + ye.id;
		var cal = calendars[id];
		if (typeof(cal) == 'undefined') {
			cal = new floobleCalendar();
			cal.setElements(me, de, ye);
			calendars[id] = cal;
		}
		if (cal.shown) {
			cal.hide();
		} else {
			cal.show();
		}
	}

	//--Class Stuff--------------------------------------------------
	function floobleCalendar() {
		// Define Methods
		this.setElement = fc_setElement;
		this.setElements = fc_setElements;
		this.parseDate = fc_parseDate;
		this.generateHTML = fc_generateHTML;
		this.show = fc_show;
		this.hide = fc_hide;
		this.moveMonth = fc_moveMonth;
		this.setDate = fc_setDate;
		this.formatDate = fc_formatDate;
		this.setDateFields = fc_setDateFields;
		this.parseDateFields = fc_parseDateFields;
		
		this.shown = false;
	}
	
	function fc_setElement(formElement) {
		this.element = formElement;
		this.format = this.element.title;
		this.value = this.element.value;
		this.id = this.element.id;
		this.mode = 1;
	}
	
	function fc_setElements(monthElement, dayElement, yearElement) {
		this.mElement = monthElement;
		this.dElement = dayElement;
		this.yElement = yearElement;
		this.id = this.mElement.id + '-' + this.dElement.id + '-' + this.yElement.id;
		this.element = this.mElement;
		if (fc_absoluteOffsetLeft(this.dElement) < fc_absoluteOffsetLeft(this.element)) {
			this.element = this.dElement;
		}
		if (fc_absoluteOffsetLeft(this.yElement) < fc_absoluteOffsetLeft(this.element)) {
			this.element = this.yElement;
		}
		if (fc_absoluteOffsetTop(this.mElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.mElement;
		}
		if (fc_absoluteOffsetTop(this.dElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.dElement;
		}
		if (fc_absoluteOffsetTop(this.yElement) > fc_absoluteOffsetTop(this.element)) {
			this.element = this.yElement;
		}

		this.mode = 2;
	}
	
	function fc_parseDate() {
		if (this.element.value) {
			this.date = new Date();
			var out = '';
			var token = '';
			var lastCh, ch;
			var start = 0;
			lastCh = this.format.substring(0, 1);
			for (i = 0; i < this.format.length; i++) {
				ch = this.format.substring(i, i+1);
				if (ch == lastCh) { 
					token += ch;
				} else {
					fc_parseToken(this.date, token, this.element.value, start);
					start += token.length;
					token = ch;
				}
				lastCh = ch;
			}
			fc_parseToken(this.date, token, this.element.value, start);
		} else {
			this.date = new Date();
		}
		if ('' + this.date.getMonth() == 'NaN') {
			this.date = new Date();
		}
	}	
	
	function fc_parseDateFields() {
		this.date = new Date();
		if (this.mElement.value) this.date.setMonth(fc_getFieldValue(this.mElement) - 1);
		if (this.dElement.value) this.date.setDate(fc_getFieldValue(this.dElement));
		if (this.yElement.value) this.date.setFullYear(fc_getFieldValue(this.yElement));
		if ('' + this.date.getMonth() == 'NaN') {
			this.date = new Date();
		}
	}
	
	function fc_setDate(d, m, y) {
		this.date.setYear(y);
		this.date.setMonth(m);
		this.date.setDate(d);
		if (this.mode == 1) {
			this.element.value = this.formatDate();
		} else {
			this.setDateFields();
		}
		this.hide();
	}
	
	function fc_setDateFields() {
		fc_setFieldValue(this.mElement, fc_zeroPad(this.date.getMonth() + 1));
		fc_setFieldValue(this.dElement, fc_zeroPad(this.date.getDate()));
		fc_setFieldValue(this.yElement, this.date.getFullYear());
	}
	
	function fc_formatDate() {
		var out = '';
		var token = '';
		var lastCh, ch;
		lastCh = this.format.substring(0, 1);
		for (i = 0; i < this.format.length; i++) {
			ch = this.format.substring(i, i+1);
			if (ch == lastCh) { 
				token += ch;
			} else {
				out += fc_formatToken(this.date, token);
				token = ch;
			}
			lastCh = ch;
		}
		out += fc_formatToken(this.date, token);
		return out;
	}
	
	function fc_show() {
		if (typeof(fc_openCal) != 'undefined') { fc_openCal.hide(); }
	
		if (this.mode == 1) {
			this.parseDate();
		} else {
			this.parseDateFields();
		}
		this.showDate = new Date(this.date.getTime());
		if (typeof(this.div) != 'undefined') {
			this.div.innerHTML = this.generateHTML();
		}

		if (typeof(this.div) == 'undefined') {
			this.div = document.createElement('DIV');
			this.div.id="calendar";
			this.div.style.position = 'absolute';
			this.div.style.display = 'none';
			this.div.className = 'fc_main';
			this.div.innerHTML = this.generateHTML();
			this.div.style.left = fc_absoluteOffsetLeft(this.element);
			this.div.style.top = fc_absoluteOffsetTop(this.element) + this.element.offsetHeight + 1;
			document.body.appendChild(this.div);
		}
		this.div.style.display = 'block';
		this.shown = true;
		fc_openCal = this;
	}
	
	function fc_generateHTML() {
		var html = '<TABLE id=canlendar><TR><TD CLASS="fc_head" COLSPAN="6">CALENDAR :</TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').hide();"><B>X</B></TD></TR>';
		html += '<TR><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(-12);"><B><<</B></TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(-1);"><B><</B></TD><TD COLSPAN="3" CLASS="fc_wk">' + fc_getYear(this.showDate) + '�� ' + fc_months[this.showDate.getMonth()] + ' </TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(1);"><B>></B></TD><TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').moveMonth(12);"><B>>></B></TD></TR>';
		html += '<TR><TD WIDTH="14%" CLASS="fc_wk">��</TD><TD WIDTH="14%" CLASS="fc_wk">ȭ</TD><TD WIDTH="14%" CLASS="fc_wk">��</TD><TD WIDTH="14%" CLASS="fc_wk">��</TD><TD WIDTH="14%" CLASS="fc_wk">��</TD><TD class="fc_wknd1" WIDTH="14%">��</TD><TD class="fc_wknd" WIDTH="14%">��</TD></TR>';
		html += '<TR>';
		var dow = 0;
		var i, style;
		var totald = fc_monthLength(this.showDate);
		for (i = 0; i < fc_firstDOW(this.showDate); i++) {
			dow++;
			html += '<TD> </TD>';
		}
		for (i = 1; i <= totald; i++) {
			if (dow == 0) { html += '<TR>'; }
			if (this.showDate.getMonth() == this.date.getMonth() && this.showDate.getYear() == this.date.getYear() && this.date.getDate() == i) { 
				style = ' style="font-weight: bold;"';
			} else {
				style = '';
			}
			html += '<TD CLASS="fc_date" onMouseover="this.className = \'fc_dateHover\';" onMouseout="this.className=\'fc_date\';" onClick="getCalendar(\'' + this.id + '\').setDate(' + i + ', ' + this.showDate.getMonth() + ', ' + this.showDate.getFullYear() + ');" ' + style + '>' + i + '</TD>';
			dow++;
			if (dow == 7) {
				html += '</TR>';
				dow = 0;
			}
		}
		if (dow != 0) {
			for (i = dow; i < 7; i++) {
				html += '<TD> </TD>';
			}
		}
		html +='</TR>';
		html += '</TABLE>';
		return html;
	}
	
	function fc_hide() {
		
		if (this.div != false) {
			this.div.style.display = 'none';
		}
		this.shown = false;
		fc_openCal = undefined;
		//getContent();
	}
	function fc_hide2() {
		if (this.div != false) {
			this.div.style.display = 'none';
		}
		this.shown = false;
		fc_openCal = undefined;
		//getContent();
	}
	function fc_moveMonth(amount) {
		var m = this.showDate.getMonth();
		var y = fc_getYear(this.showDate);
		if (amount == 1)  {
			if (m == 11)  {
				this.showDate.setMonth(0);
				this.showDate.setYear(y + 1);
			} else {
				this.showDate.setMonth(m + 1);
			}
		} else if (amount == -1)  {
			if (m == 0)  {
				this.showDate.setMonth(11);
				this.showDate.setYear(y - 1);
			} else {
				this.showDate.setMonth(m - 1);
			}
		} else if (amount == 12) {
			this.showDate.setYear(y + 1);
		} else if (amount == -12) {
			this.showDate.setYear(y - 1);
		}
		this.div.innerHTML = this.generateHTML();
	}
	
	//--Utils-------------------------------------------------------------
	function fc_absoluteOffsetTop(obj) {
     	var top = obj.offsetTop;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		top += parent.offsetTop;
     		parent = parent.offsetParent;
     	}
     	return top;
     }
     
     function fc_absoluteOffsetLeft(obj) {
     	var left = obj.offsetLeft;
     	var parent = obj.offsetParent;
     	while (parent != document.body) {
     		left += parent.offsetLeft;
     		parent = parent.offsetParent;
     	}
     	return left;
     }
     
     function fc_firstDOW(date) {
     	var dow = date.getDay();
     	var day = date.getDate();
 		if (day % 7 == 0) return dow;
     	return (7 + dow - (day % 7)) % 7; 
     }
     
     function fc_getYear(date) {
     	var y = date.getYear();
     	if (y > 1900) return y;
     	return 1900 + y;
     }
     
     function fc_monthLength(date) {
		var month = date.getMonth();
		var totald = 30;
		if (month == 0 
			|| month == 2
			|| month == 4
			|| month == 6
			|| month == 7
			|| month == 9
			|| month == 11) totald = 31;
		if (month == 1) {
			var year = date.getYear();
			if (year % 4 == 0 && (year % 400 == 0 || year % 100 != 0))
		 		totald = 29;
			else
				totald = 28;
		}
		return totald;
     }
     
     function fc_formatToken(date, token) {
		var command = token.substring(0, 1);
		if (command == 'y' || command == 'Y') {
			if (token.length == 2) { return fc_zeroPad(date.getFullYear() % 100); }
			if (token.length == 4) { return date.getFullYear(); } 
		}
		if (command == 'd' || command == 'D') {
			if (token.length == 2) { return fc_zeroPad(date.getDate()); }
		}
		if (command == 'm' || command == 'M') {
			if (token.length == 2) { return fc_zeroPad(date.getMonth() + 1); }
			if (token.length == 3) { return fc_months[date.getMonth()]; } 
		}
		return token;
     }
     
     function fc_parseToken(date, token, value, start) {
		var command = token.substring(0, 1);
		var v;
		if (command == 'y' || command == 'Y') {
			if (token.length == 2) { 
				v = value.substring(start, start + 2);
				if (v < 70) { date.setFullYear(2000 + parseInt(v)); } else { date.setFullYear(1900 + parseInt(v)); } 
			}
			if (token.length == 4) { v = value.substring(start, start + 4); date.setFullYear(v);} 
		}
		if (command == 'd' || command == 'D') {
			if (token.length == 2) { v = value.substring(start, start + 2); date.setDate(v); }
		}
		if (command == 'm' || command == 'M') {
			if (token.length == 2) { v = value.substring(start, start + 2); date.setMonth(v - 1); }
			if (token.length == 3) { 
				v = value.substring(start, start + 3);
				var i;
				for (i = 0; i < fc_months.length; i++) {
					if (fc_months[i].toUpperCase() == v.toUpperCase()) { date.setMonth(i); }
				}
			} 
		}
     }
     
     function fc_zeroPad(num) {
		if (num < 10) { return '0' + num; }
		return num;
     }

	function fc_getObj(id) {
		if (fc_ie) { return document.all[id]; } 
		else { return document.getElementById(id);	}
	}

      function fc_setFieldValue(field, value) {
                if (field.type.substring(0,6) == 'select') {
                        var i;
                        for (i = 0; i < field.options.length; i++) {
                                if (fc_equals(field.options[i].value, value)) {
                                        field.selectedIndex = i;
                                }
                        }
                } else {
                        field.value = value;
                }
      }

      function fc_getFieldValue(field) {
                if (field.type.substring(0,6) == 'select') {
                        return field.options[field.selectedIndex].value;
                } else {
                        return field.value;
                }
      }
      
      function fc_equals(val1, val2) {
      		if (val1 == val2) return true;      		
      		if (1 * val1 == 1 * val2) return true;
      		return false;
      }

	
	

</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table width="900" height="100%"  border="0" cellpadding="0" cellspacing="0" align=center>
	<tr valign="top">
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="stitle"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle">����׷� : <?=$cur_category_name?></td>
				</tr>
			</table>

			<!--���� START~~-->  	
			<table border="0" width="90%" cellspacing="0" cellpadding="0" align='center'>
			<tr>
				<td width="90%" bgcolor="#FFFFFF" valign="top"><br>
					<p style="padding-left: 10px" class="stitle2">[ȸ�� ���] ���ο� ȸ���� ����մϴ�.<br><br>
				</td>
			</tr>

      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
        		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td width="100%" bgcolor="#FFFFFF"></td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
        		<table border="0" width="95%">
          		<form action='item_add.php' method="post" name='writeform' onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type="hidden" name="flag" value="add">
				<input type="hidden" name="pu" value="<?=$pu?>">
				<input type="hidden" name="first_no" value="<?=$first_no?>">
				<input type="hidden" name="second_no" value="<?=$second_no?>">
				<input type="hidden" name="thirdno" value="<?=$thirdno?>">
				<input type="hidden" name="category_num" value="<?=$category_num?>">
				<input type="hidden" name="img_sml_updateflag" value='ok'>
				<input type="hidden" name="img_updateflag" value='ok'>
				<input type="hidden" name="img_big_updateflag" value='ok'>
				<input type="hidden" name="img_big2_updateflag" value='ok'>
				<input type="hidden" name="img_big3_updateflag" value='ok'>
				<input type="hidden" name="img_big4_updateflag" value='ok'>
				<input type="hidden" name="img_big5_updateflag" value='ok'>
				<input type="hidden" name="img_high_updateflag" value='ok'>
				<!--<input type="hidden" name="op1" value="">
				<input type="hidden" name="op2" value="">
				<input type="hidden" name="op3" value="">-->
				<input type="hidden" name="doctype" value="0">
				<!--<input type="hidden" name="opt">-->
				<input type="hidden" name="reg_date" value='<?=$reg_date?>'>
				<input type="hidden" name="provider_id" value="<?=$Mall_Admin_ID?>">
          		<tr>
            		<td width="90%">
            			<table border="0" width="100%" cellspacing="0" cellpadding="0" class="box2">

<?
$SQL = "select * from $CategoryTable where g_id='$_SESSION[Mall_Admin_ID]'";
$dbresult = mysql_query($SQL, $dbconn);
$rows = mysql_fetch_array($dbresult);
$my_category_num = $rows[category_num];
$category_limit_start = $rows[category_limit_start];
$category_limit_end = $rows[category_limit_end];

$sea_num = $rows[sea_num];
$sung_num = $rows[sung_num];
$khan_num = $rows[khan_num];
$sea_area = $rows[sea_area];
$sung_area = $rows[sung_area];
$khan_area = $rows[khan_area];


$SQL = "select max(item_code) from $ItemTable where if_hide='0' and category_num='$my_category_num'";
$dbresult = mysql_query($SQL, $dbconn);
$max_item_code = mysql_result($dbresult,0,0);

if(!$max_item_code){
	$final_item_code = $category_limit_start;
}else{	
	$final_item_code = $max_item_code + 1;
}
if($category_limit_end >= $final_item_code){
	$item_code = $final_item_code;
}else{
	echo "
	 <script>	
		alert(\"�� �̻��� ȸ���� ����� �� �����ϴ�.\");
		hisgory.go(-1);
	</script>
	";
}




?>
              			<tr>
			                <td align='center' colSpan="2" class="title">
								������ȣ 
							</td>
			                <td bgColor="#ffffff" colspan=4>
						<input class="aa" type="text" name="sea_num" value='<?=$sea_num?>' size="5" maxlength=4 readonly>
						<input type="hidden" name="sea_area" value='<?=$sea_area?>' >
						<input class="aa" type="text" name="sung_num" value='<?=$sung_num?>' size="3" maxlength=2 readonly>
						<input type="hidden" name="sung_area" value='<?=$sung_area?>' >
						<input class="aa" type="text" name="khan_num" value='<?=$khan_num?>' size="3" maxlength=2 readonly>
						<input type="hidden" name="khan_area" value='<?=$khan_area?>' >
						<input class="aa" type="text" name="sudong_num" value='<?=$sudong_num?>' size="5" maxlength=4>
							</td>
			              </tr>

						
						
						<tr>
                			<td width="15%" align="center" colspan="2" class="title">
                				����
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_name" size="14">
							</td>




                			<td width="15%" align="center" colspan="2" class="title">
                				ȸ����ȣ
							</td>
                			<td width="35%" bgcolor="#FFFFFF">
                				<input class='input' name="item_code" size="16" value="<?=$item_code?>" readonly> 
							</td>
              			</tr>



              			<tr>
			                <td align='center' colSpan="2" class="title">
								���̵� 
							</td>
			                <td bgColor="#ffffff">
								<input class="aa" name="item_id" value='<?=$item_id?>' size="14" style='ime-mode:inactive'>
								<input type="button" value="�ߺ�Ȯ��" style="BACKGROUND-COLOR:#f2f2f2; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" style='cursor:hand' onClick="idcheck();"><br>
								<span id="id_chk" class="text_14_s2">(���̵�� ������, ���� �����ؼ� 4~16 ��) </span>
							</td>
			                <td align="center" colspan="2" class="title">
								��й�ȣ
							</td>
			                <td bgColor="#ffffff">
								<input class='input' name="item_pw" size="10">
							</td>
			              </tr>



      

           
              			<tr>
			                <td align='center' colSpan="2" class="title">
								����
							</td>
			                <td bgColor="#ffffff">
								<input type=radio name="sex" value="��" checked>�� <input type=radio name="sex" value="��">��
							</td>
			                <td align="center" colspan="2" class="title">
								����ڹ�ȣ
							</td>
			                <td bgColor="#ffffff">
								<input name="co_num" class='input' size="11" maxlength=10>('-'���� ���ڸ��Է�)
							</td>
			              </tr>
						  





              			<tr>
			                <td align='center'  colSpan="2" class="title">
								��ȭ 
							</td>
			                <td bgColor="#ffffff">
								<input name="tel" class='input' size="24">
							</td>
			                <td align="center"  colspan="2" class="title">
								�ڵ���
							</td>
			                <td bgColor="#ffffff">
								<input name="mobile" class='input' size="24">
							</td>
			              </tr>
			              <tr>
			                <td align='center'  colSpan="2" class="title">
								�̸���
							</td>
			                <td bgColor="#ffffff">
								<input name="email" class='input' size="34">
							</td>
			                <td  colspan="2" align="center" class="title">
								����
							</td>
			                <td bgColor="#ffffff">
								<input name="job" class='input' size="34">
							</td>
			              </tr>
						  <tr>
			                <td align='center' colSpan="2" class="title">
								�ּ�
							</td>
			                <td bgColor="#ffffff">
								<input name="address" class='input' size="34">
							</td>
			                <td  colspan="2" align="center" class="title">
								�����ȣ
							</td>
			                <td bgColor="#ffffff">
								<input name="zip" class='input' size="34">
							</td>
			              </tr>
			              <tr>
			                <td align='center' colSpan="2" class="title">
								�ּ�2
							</td>
			                <td bgColor="#ffffff">
								<input name="address2" class='input' size="34">
							</td>
			                <td  colspan="2" align="center" class="title">
								ĭī��
							</td>
			                <td bgColor="#ffffff">
								<input type="file" name="img_big" class='input' size="30">
							</td>
			              </tr>
<?
/*
?>			
			              <tr>
			                <td align='center' bgColor="#c8dfec" colSpan="2">
								ĭ�����۱ݰ���
							</td>
			                <td bgColor="#ffffff" colspan=4>
								<?
								echo ("				
								<select name='com_bank_name' tabIndex='5' selectedindex='0' size='1'>
								<option value=''
								");
								if($bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($bank_name == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($bank_name == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($bank_name == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($bank_name == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($bank_name == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($bank_name == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($bank_name == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($bank_name == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($bank_name == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($bank_name == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($bank_name == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($bank_name == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($bank_name == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="com_bank_account" class='input' size="44">
								������:<input name="com_bank_master" class='input' size="10">
							</td>
			              </tr>
<?
*/
?>
			              <tr>
			                <td align='center'  colSpan="2" class="title">
								���ǰŷ�����
							</td>
			                <td bgColor="#ffffff" colspan=4>
								<?
								echo ("				
								<select name='my_bank_name' tabIndex='5' selectedindex='0' size='1'>
								<option value=''
								");
								if($bank_name == '') echo " selected";
								echo ("
								>========</option>
								<option value='�λ�����'
								");
								if($bank_name == '�λ�����') echo " selected";
								echo ("
								>�λ�����</option>
								<option value='�泲����'
								");
								if($bank_name == '�泲����') echo " selected";
								echo ("
								>�泲����</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�� ��'
								");
								if($bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='�뱸����'
								");
								if($bank_name == '�뱸����') echo " selected";
								echo ("
								>�뱸����</option>
								<option value='�� �� ġ'
								");
								if($bank_name == '�� �� ġ') echo " selected";
								echo ("
								>�� �� ġ</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='�������ݰ�'
								");
								if($bank_name == '�������ݰ�') echo " selected";
								echo ("
								>�������ݰ�</option>
								<option value='�������'
								");
								if($bank_name == '�������') echo " selected";
								echo ("
								>�������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�� ��'
								");
								if($bank_name == '�� ��') echo " selected";
								echo ("
								>�� ��</option>
								<option value='��Ƽ����'
								");
								if($bank_name == '��Ƽ����') echo " selected";
								echo ("
								>��Ƽ����</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�Ϸ�����'
								");
								if($bank_name == '�Ϸ�����') echo " selected";
								echo ("
								>�Ϸ�����</option>
								<option value='��ȯ����'
								");
								if($bank_name == '��ȯ����') echo " selected";
								echo ("
								>��ȯ����</option>
								<option value='�츮����'
								");
								if($bank_name == '�츮����') echo " selected";
								echo ("
								>�츮����</option>
								<option value='�� ü ��'
								");
								if($bank_name == '�� ü ��') echo " selected";
								echo ("
								>�� ü ��</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='��������'
								");
								if($bank_name == '��������') echo " selected";
								echo ("
								>��������</option>
								<option value='�ϳ�����'
								");
								if($bank_name == '�ϳ�����') echo " selected";
								echo ("
								>�ϳ�����</option>
								<option value='�ѹ�����'
								");
								if($bank_name == '�ѹ�����') echo " selected";
								echo ("
								>�ѹ�����</option>
								<option value='ȫ������'
								");
								if($bank_name == 'ȫ������') echo " selected";
								echo ("
								>ȫ������</option>
								</select>
								");

								?>
								���¹�ȣ:<input name="my_bank_account" class='input' size="44">	
								������:<input name="my_bank_master" class='input' size="10">
								</td>
			              </tr>
						  <tr>
			                <td align='center'  colSpan="2" class="title">
								ȸ���Ⱓ
							</td>
			                <td bgColor="#ffffff" colspan=4>



								
								<input name='start_date' type=text size=15 class=b_input id="start_date"  value='<?=$start_date?>' title="YYYY-MM-DD" readonly required='required' itemname='�����'  onclick="displayCalendarFor('start_date');">							
								~
								
								
								<input name='end_date' type=text size=15 class=b_input id="end_date"  value='<?=$end_date?>' title="YYYY-MM-DD" readonly required='required' itemname='�����'  onclick="displayCalendarFor('end_date');">							



							</td>
			              </tr>
</table>

<table border="0" width="100%" cellpadding=0 cellspacing=0 class="box2">

              			<tr>
                			<td width="100%"  align="center" colspan="6" class="title">
                				�� ��
							</td>
              			</tr>
              			<tr>
                			<td width="100%" bgcolor="#FFFFFF" colspan="6">
								<textarea name="short_explain" rows='10' cols='128'></textarea>
                			</td>
              			</tr>
     
              			<tr>
                			<td width="50%" align="center" colspan="3" class="title">
                				�����
							</td>
                			<td width="50%" bgcolor="#FFFFFF" align="center" colspan="3"><?=$reg_date?></td>
              			</tr>

            			</table>
            		</td>
          		</tr>
        		</table>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" bgcolor="#FFFFFF" valign="top" align="center"><br>
<?
$SQL = "select service_name from $MartInfoTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($numRows>0) {
	$service_name = mysql_result($dbresult,0,0);
}		
$SQL = "select * from $ItemTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($service_name == 'base'&& $numRows > 2000){
	echo "
	 <script>
	 function check_ver(){
		alert(\"ȸ�������� 2000���� �Ѿ� �� �̻��� ȸ���� ����� �� �����ϴ�.\");
		return false;
	}
	</script>
	";
}
else if($service_name == 'indi_base'&& $numRows > 2000){
	echo "
	 <script>
	 function check_ver(category_num,prevno){
		alert(\"ȸ�������� 2000���� �Ѿ� ���̻��� ȸ���� ����� �� �����ϴ�.\");
		return false;
	}
	</script>	
	";
}
else if($service_name == 'free_base'&& $numRows > 150){
	echo "
	<script>
	 function check_ver(){
		alert(\"ȸ�������� 150���� �Ѿ� �� �̻��� ȸ���� ����� �� �����ϴ�.\");
		return false;
	}
	</script>	
	"	;
}
else{
	echo "
	<script>
	 function check_ver(){
		return true;
	}
	</script>
	";
}
?>
				<img src='../images/btn_finish.gif' onclick='return check_ver()'  style='cursor:hand;'>
				<img src='../images/list.gif' onClick="location.href='item_list.php?pu=<?=$pu?>&category_num=<?=$category_num?>&page=<?=$page?>&searchword=<?=$searchword?>'"  style='cursor:hand;'>
				
        	</td>
      	</tr>
  
		</form>
      	<tr align="center">
        	<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
      	</tr>
    	</table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
}
?>
<?
//================== ȸ���� ����� =======================================================
if($flag == "add"){


	//================== ���ε� ������ �ҷ��� ================================================
	include "../../upload.php";
	$upload = "$Co_img_UP"."$mart_id/";
	//================== ÷�� ������ ���ε��� ================================================

	
##################################img_big###############################################
	
	if (isset($img_big_name)&&($img_big_name != "")){
		if(!file_exists("$Co_img_UP$mart_id")){
			mkdir ("$Co_img_UP$mart_id", 0755 );
		}


		
		if( $img_big_name ){


			$file = FileUploadName( "", "$upload", $img_big, $img_big_name );//������ ���ε� ��

			if( !$file ){
				echo("
					<script>
					window.alert('���� ���ε忡 �����߽��ϴ�.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
###########################################################################################

	$SQL = "select max(item_no), count(*) from $ItemTable";
	$dbresult = mysql_query($SQL, $dbconn);
	if ($dbresult == false) echo "���� ���� ����!";
	if (mysql_result($dbresult,0,1) > 0)
		$maxItem_no = mysql_result($dbresult, 0, 0);
	else
		$maxItem_no = 0;
	$maxItem_no_1 = $maxItem_no+1;


	if($img_big_updateflag=="ok" && $img_big_name != ""){
		$img_big_new = "item_big_".$maxItem_no_1."_".$img_big_name;
	}
	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
		copy ("$Co_img_UP$mart_id/$img_big_name","$Co_img_UP$mart_id/$img_big_new" );	//���ε� ���� ����
	}

	if($img_big_updateflag=="ok" && $img_big_name != ""){
		if(file_exists("$Co_img_UP$mart_id/$img_big_name"))
			unlink("$Co_img_UP$mart_id/$img_big_name");
	}



	$rg_file1_path = "$Co_img_UP$mart_id/$img_big_new";

	/*
	$FileName : ���ϸ�
	$ori_path : �������ϰ��
	$maxItem_no_1 : �����ֱٱ۹�ȣ + 1�Ѱ�
	$mart_id : ���� ���̵�
	�Ǹ��������� : ���ϼ��� �α�����

	����� ����� home2�� �ֽż����� �ű�� home�� ����
	*/
	function MakeThum1($FileName,$ori_path,$maxItem_no_1,$mart_id,$unique) 
	{
			$ThumFileName120 = $maxItem_no_1."_".$unique."_".$FileName."120.gif";
			
			$FileName = $ori_path;
			$ThumFileName120 = "/home/".$mart_id."/public_html/co_img/".$mart_id."/" . $ThumFileName120;
			
			exec ("convert -geometry 120x $FileName $ThumFileName120");




			if(file_exists("$ori_path")){ 
				unlink ("$ori_path");	
			}



	}
	if($img_big_new){
		MakeThum1($img_big_name,$rg_file1_path,$maxItem_no_1,$mart_id,1); 
		$img_big_new_th =  $maxItem_no_1."_1_".$img_big_name."120.gif";
	}





	$item_order = "1";//ȸ�� ��� ����


	$SQL = "insert into $ItemTable (mart_id, firstno, prevno, thirdno,category_num, country_num, sea_num, sung_num, khan_num, sea_area, sung_area, khan_area, sudong_num, item_name, start_date, end_date, jumin1, jumin2, sex, co_name, co_num, tel, address2, g_margin, zip, bonus, use_bonus, address, job, hobby, img, img_big, img_big2, img_big3, img_big4, img_big5, doctype, item_explain, short_explain, reg_date, item_code, item_id, item_pw, read_num, mobile, email,com_bank_name, com_bank_account,com_bank_master, my_bank_name, my_bank_account ,my_bank_master, item_order,  provider_id,  img_sml, if_hide, img_high) values ('$mart_id', '$first_no', '$second_no', '$thirdno', '$category_num', '100', '$sea_num', '$sung_num', '$khan_num', '$sea_area', '$sung_area', '$khan_area', '$sudong_num', '$item_name', '$start_date','$end_date', '$jumin1', '$jumin2', '$sex', '$co_name', '$co_num', '$tel', '$address2', '$g_margin', '$zip', '$bonus', '$use_bonus','$address','$job','$hobby','$img_new','$img_big_new_th','$img_big2_new_th','$img_big3_new_th','$img_big4_new_th','$img_big5_new_th','$doctype','$item_explain', '$short_explain', '$reg_date','$item_code', '$item_id', '$item_pw',0, '$mobile', '$email','$com_bank_name', '$com_bank_account', '$com_bank_master', '$my_bank_name', '$my_bank_account', '$my_bank_master','$item_order', '$provider_id', '$img_sml_new','0', '$img_high_new')";

//echo $SQL;
//exit;

	$dbresult = mysql_query($SQL, $dbconn);
	echo "<meta http-equiv='refresh' content='0; URL=item_list.php?category_num=$category_num&pu=$pu'>";
}
//========================================================================================
?>
<?
mysql_close($dbconn);
?>

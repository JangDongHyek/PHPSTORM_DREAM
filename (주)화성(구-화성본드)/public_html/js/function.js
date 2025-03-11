// ���� �߾�����
function verticalAlign(obj){
    result=(obj.offsetParent.offsetHeight - obj.offsetHeight)/2+"px";
    if(obj.readyState == "complete"){
        obj.style.marginTop="0";
        obj.style.marginTop=result;
    }else{
        return result;
    }
}

//max-width, max-height
function maxSize(obj,w,h){
    if(obj.readyState != "complete") return "auto";
    real_w=obj.offsetWidth;
    real_h=obj.offsetHeight;
    virt_w=obj.offsetWidth;
    virt_h=obj.offsetHeight;
    if(w>0 && virt_w>w){
        virt_w = w;
        virt_h = real_h * (virt_w/real_w);
    }
    if(h>0 && virt_h>h){
        virt_h = h;
        virt_w = real_w * (virt_h/real_h);
    }

    obj.style.width="0";
    obj.style.height="0";
    obj.style.width=virt_w+"px";
    obj.style.height=virt_h+"px";

}

//min-height
function min_height(obj,h){
    if(obj.readyState != "complete") return "auto";
    if(obj.offsetHeight<h){
        obj.style.height="0";
        obj.style.height=h+"px";
    }

}

//����,üũ��ư border ���ֱ�
function input_nb(obj){
    obj.style.zIndex="1";
    if(obj.type.toLowerCase()=="radio" || obj.type.toLowerCase()=="image"

|| obj.type.toLowerCase()=="checkbox"){

        obj.style.border="0";

    }
}

function getOpener(objectId) {
	
	if(opener.document.getElementById && opener.document.getElementById(objectId)) {	// W3C DOM
		return opener.document.getElementById(objectId);		
	} else if(opener.document.all && opener.document.all(objectId)) {					// IE4
		return opener.document.all(objectId);
	} else if(opener.document.layers && opener.document.layers[objectId]) {			// NN4
		return opener.document.layer[objectId];
	} else {
		return false;
	}
}

function getObject(objectId) {
	
	if(document.getElementById && document.getElementById(objectId)) {	// W3C DOM
		return document.getElementById(objectId);		
	} else if(document.all && document.all(objectId)) {					// IE4
		return document.all(objectId);
	} else if(document.layers && document.layers[objectId]) {			// NN4
		return document.layer[objectId];
	} else {
		return false;
	}
}

function getName(objectId) {
	
	if(document.getElementByName && document.getElementByName(objectId)) {	// W3C DOM
		return document.getElementByName(objectId);		
	} else if(document.all && document.all(objectId)) {					// IE4
		return document.all(objectId);
	} else if(document.layers && document.layers[objectId]) {			// NN4
		return document.layer[objectId];
	} else {
		return false;
	}
}

// ���̺� ������
function ShowTable(sty){
	document.all[sty].style.display='';
}

// ���̺� ����
function HideTable(sty){
	document.all[sty].style.display='none';
}

//�÷�������//

//flash
function flash_contents(file, width, height){
document.writeln("<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='"+width+"' height='"+height+"' title=''>");
document.writeln("<param name='movie' value='"+file+"' />");
document.writeln("<param name='quality' value='high' />");
document.writeln("<param name='wmode' value='transparent' />");
//document.writeln("<param name='swfversion' value='9.0.45.0' />");
document.writeln("<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->");
document.writeln("<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> ");
document.writeln("<!--[if !IE]>-->");
document.writeln("<object type='application/x-shockwave-flash' data='"+file+"' width='"+width+"' height='"+height+"'>");
document.writeln("<!--<![endif]-->");
document.writeln("<param name='quality' value='high' />");
document.writeln("<param name='wmode' value='transparent' />");
//document.writeln("<param name='swfversion' value='9.0.45.0' />");
document.writeln("<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->");
document.writeln("<div>");
document.writeln("<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>");
document.writeln("<p><a href='http://www.adobe.com/go/getflashplayer'><img src='http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' width='112' height='33' /></a></p>");
document.writeln("</div>");
document.writeln("<!--[if !IE]>-->");
document.writeln("</object>");
document.writeln("<!--<![endif]-->");
document.writeln("</object>");

}

//flash
function flash(width, height,flash_name){
	document.writeln("<OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' WIDTH='"+width+"' HEIGHT='"+height+"' ALIGN=''>");
	document.writeln("<PARAM NAME=movie value='"+flash_name+"' />");
	document.writeln("<PARAM NAME=quality VALUE=high>");
	document.writeln("<PARAM NAME=bgcolor VALUE=#FFFFFF>");
	document.writeln("<PARAM NAME=wmode VALUE=transparent> ");
	document.writeln("<embed src='"+flash_name+"' quality='high' bgcolor='#FFFFFF' width='"+width+"' height='"+height+"' align='middle' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />");
	document.writeln("</OBJECT>");
}

//������
function tv_adplay(file, width, height, mediaName) {
	document.write('<OBJECT ID="'+mediaName+'" CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6" width="'+width+'" height="'+height+'">')
	document.write('	<param name="autoStart" value="true">')
	document.write('	<param name="balance" value="0">')
	document.write('	<param name="enableContextMenu" value="">')
	document.write('	<param name="ShowControls" value="true">')
	document.write('	<param name="enabled" value="true">')
	document.write('	<param name="fullScreen" value="">')
	document.write('	<param name="mute" value="">')
	document.write('	<param name="playCount" value="1">')
	document.write('	<param name="rate" value="1.0">')
	document.write('	<param name="SAMIFileName" value="">')
	document.write('	<param name="SAMILang" value="">')
	document.write('	<param name="SAMIStyle" value="">')
	document.write('	<param name="stretchToFit" value="">')
	document.write('	<param name="URL" value="'+file+'">')
	document.write('	<param name="volume" value="50">')
	document.write('</OBJECT>')
}
	
//������ autosize
function tv_adplay_autosize(file, mediaName) {
	document.write('<OBJECT ID="'+mediaName+'" CLASSID="CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6">')
	document.write('	<param name="autoStart" value="true">')
	document.write('	<param name="balance" value="0">')
	document.write('	<param name="enableContextMenu" value="">')
	document.write('	<param name="ShowControls" value="true">')
	document.write('	<param name="enabled" value="true">')
	document.write('	<param name="fullScreen" value="">')
	document.write('	<param name="mute" value="">')
	document.write('	<param name="playCount" value="1">')
	document.write('	<param name="rate" value="1.0">')
	document.write('	<param name="SAMIFileName" value="">')
	document.write('	<param name="SAMILang" value="">')
	document.write('	<param name="SAMIStyle" value="">')
	document.write('	<param name="stretchToFit" value="">')
	document.write('	<param name="URL" value="'+file+'">')
	document.write('	<param name="volume" value="50">')
	document.write('	<param name="AutoSize" value="true">')
	document.write('</OBJECT>')
}
//--------------------------------------------------------------

function active_source(source) {
	document.write(source);
}
//�÷�������//



function go(url)
{
	location.href=url;
}

// �� ���� ���� ó��
function fnLastDay ()
{
	var Index;
	var MaxIndex;
	var Year;
	var Month;
	var NewOption;
	
	Year = board.selYear.value;
	Month = board.selMonth.value;

	MaxIndex = board.selDay.length;
	
	for (Index = MaxIndex; Index  >= 28; Index--)
	{
		board.selDay.options [Index] = null;
	}
	
	switch (eval(Month))
	{
		case 1  :
		case 3  :
		case 5  :
		case 7  :
		case 8  :
		case 10 :
		case 12 :
			NewOption = new Option ("29", "29");
			board.selDay.options [28] = NewOption;
			NewOption = new Option ("30", "30");
			board.selDay.options [29] = NewOption;
			NewOption = new Option ("31", "31");
			board.selDay.options [30] = NewOption;
			
			break;
			
		case 4  :
		case 6  :
		case 9  :
		case 11 :
			NewOption = new Option ("29", "29");
			board.selDay.options [28] = NewOption;
			NewOption = new Option ("30", "30");
			board.selDay.options [29] = NewOption;

			break;
			
		case 2 :
			Index = Year % 4;
			
			if (Index == 0)
			// ����
			{
				Index = Year % 100;
				
				if (Index == 0)
				// ���� �ƴ�
				{
					Index = Year % 400;                        
					
					if (Index == 0)
					// ����
					{
						NewOption = new Option ("29", "29");
						board.selDay.options [28] = NewOption;                            
					}
					else
					// ���� �ƴ�
					{
					}                        
				}
				else
				// ����
				{
					NewOption = new Option ("29", "29");
					board.selDay.options [28] = NewOption;                        
				}
			}
			else
			// ���� �ƴ�
			{

			}
			break;
			
		default :
			break;
	}
	
	return true;
}

function returnURL(alertMessage, rurl) {
	sure = confirm(alertMessage);
	if (sure)
		location.href=rurl;
}

function Imgview () {
  document.all.tempImg.src = "";
  document.all.tempImg.src = document.board.imageFile.value;
}

function checkFileName(file){
	var extFile = file.split("\\");
	var ImgInfo = extFile[extFile.length-1];
	var ext = ImgInfo.split(".");
	if (!isKorean(ext[0])){
		alert("�ѱ۸��� ������� �ʽ��ϴ�.");
	}
}

// �̹��� ���� ���� (jpg,gif)
function CheckImageFile(imageName) {
  var ImageFile = imageName;
  var extFile = ImageFile.split("\\");
  var ImgInfo = extFile[extFile.length-1];
  var ext = ImgInfo.split(".");
    if (ext[1].toUpperCase() == "JPG" || ext[1].toUpperCase() == "GIF" || ext[1].toUpperCase() == "PIN" || ext[1].toUpperCase() == "BMP") {
      if (isKorean(ext[0])) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
	}
}

function isValidDateFormat(input) {
    var format = /^(\d\d\d\d)-(\d\d)-(\d\d)$/;
    return isValidFormat(input,format);
}

/**
  * �Է°��� ����ڰ� ������ ���� �������� üũ
  * �ڼ��� format ������ �ڹٽ�ũ��Ʈ�� ''regular expression''�� ����
  */
 function isValidFormat(input,format) {
     if (input.value.search(format) != -1) {
         return true; //�ùٸ� ���� ����
     }
     return false;
 }


function isSelected(selObj){
	if (selObj.options[selObj.selectedIndex].value != "" ){
		return true;
	} else {
		return false;
	}
}

function hasCheckedRadio(input) {
    if (input.length > 1) {
        for (var inx = 0; inx < input.length; inx++) {
            if (input[inx].checked) return true;
        }
    } else {
        if (input.checked) return true;
    }
    return false;
}

function isEng(str) { 
  for(var i=0;i<str.length;i++){ 
    achar = str.charCodeAt(i);  
    if( achar > 128 ){  
      return false; 
    }  
  } 
  return true;  
} 

// ���ڸ� �޾Ƽ� �ƴϸ� �޼��� ���� �ִ� 
function onlyNumber(objEv) {
	if(!isNum(objEv)){
		alert("���ڸ� �Է°����մϴ�.");
		objEv.value = "";
		objEv.focus();
		return;
	}
}

function psnoCheck(it) {

	psnoTot = 0;
	psnoAdd = '234567892345';

	for(i=0;i<12;i++) {
		psnoTot = psnoTot + parseInt(it.substring(i,i+1))*parseInt(psnoAdd.substring(i,i+1));
	}
	psnoTot = 11 - (psnoTot%11);
	if (psnoTot==10) {
		psnoTot=0;
	} else if(psnoTot==11) {
		psnoTot=1;
	}
	if(parseInt(it.substring(12,13))!=psnoTot) return true
}

function delConfirm(alertMessage, rurl) {
	sure = confirm(alertMessage);
	if (sure)
		location.href=rurl;
}

function searchzipcode(zipname, addrname, addrname2, inputnext){
	var urlname = "/zipsearch/zipsearch.jsp?zipname="+zipname+"&addrname="+addrname+"&addrname2="+addrname2+"&inputnext="+inputnext;
	//window.open(urlname,"browse_org","height=240,width=400,menubar=no,directories=no,resizable=no,status=no,scrollbars=no");
	window.open(urlname,"browse_org","height=430,width=400,menubar=no,directories=no,resizable=no,status=no,scrollbars=no");
}

function searchzipcode2(zipname, addrname, addrname2, inputnext){
	var urlname = "/zipsearch/zipsearch2.jsp?zipname="+zipname+"&addrname="+addrname+"&addrname2="+addrname2+"&inputnext="+inputnext;
	//window.open(urlname,"browse_org","height=240,width=400,menubar=no,directories=no,resizable=no,status=no,scrollbars=no");
	window.open(urlname,"browse_org","height=430,width=400,menubar=no,directories=no,resizable=no,status=no,scrollbars=no");
}

function handlePress(obj, e) {
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if ( String.fromCharCode(whichCode) < obj.length ) {
		obj.selectedIndex = String.fromCharCode(whichCode);
	}
}

function moveFocus(obj,length,nextval){
	onlyNumber(obj);
	if ( obj.value.length == length ){
		nextval.focus();
	}
}

function formattedMoney(v) {
	var format = "";
	var money = removeFormattedMoney(v);

	money = reverse(money);
	for(var i = money.length-1; i > -1; i--) {
		if((i+1)%3 == 0 && money.length-1 != i) format += ",";
			format += money.charAt(i);
		}
	return format;
}

function removeFormattedMoney(v) {
	var unformat = "";
	var money = getNumber(v);
	var arr = money.split(",");
	for(var i = 0; i < arr.length; i++) {
		unformat += arr[i];
	}
	return unformat;
}

function reverse(s) {
	var rev = "";

	for(var i = s.length-1; i >= 0 ; i--) {
		rev += s.charAt(i);
	}
	return rev;
}

function isNumberOrComma(){
	if ( (event.keyCode == 46) ||  // DEL
       (event.keyCode == 8)  ||  // backspace
       (event.keyCode == 9)  ||  // tab
       (event.keyCode == 37) ||  // �� key
       (event.keyCode == 38) ||  // �� key
       (event.keyCode == 39) ||  // �� key
       (event.keyCode == 40) ||  // �� key
       (event.keyCode == 35) ||  // HOME key
       (event.keyCode == 36) ||  // END key
       (event.keyCode == 13) ||  // Enter key
       
       (event.keyCode == 109) ||  // - key in �����е�
	   (event.keyCode == 189) ||  // - key in Ű�е�

	   (event.keyCode == 188)  ||  // comma
	   (event.keyCode == 17)  ||  // ctrl
	   (event.keyCode == 67)  ||  // c
	   (event.keyCode == 86)  ||  // v
	   (event.keyCode == 88)  ||  // v

       ( (event.keyCode >= 48) && (event.keyCode <= 57 ) ) || // 0 ~ 9
       ( (event.keyCode >= 96) && (event.keyCode <= 105 ) )   // 0 ~ 9 in �����е�
     )
    event.returnValue=true;
  else
    event.returnValue=false;
}

function isNumberOrDash(){
  if ( (event.keyCode == 46) ||  // DEL
       (event.keyCode == 8)  ||  // backspace
       (event.keyCode == 9)  ||  // tab
       (event.keyCode == 37) ||  // �� key
       (event.keyCode == 38) ||  // �� key
       (event.keyCode == 39) ||  // �� key
       (event.keyCode == 40) ||  // �� key
       (event.keyCode == 35) ||  // HOME key
       (event.keyCode == 36) ||  // END key
       (event.keyCode == 13) ||  // Enter key

	   (event.keyCode == 188)  ||  // comma
	   (event.keyCode == 17)  ||  // ctrl
	   (event.keyCode == 67)  ||  // c
	   (event.keyCode == 86)  ||  // v
	   (event.keyCode == 88)  ||  // v
       
       (event.keyCode == 109) ||  // - key in �����е�
	   (event.keyCode == 189) ||  // - key in Ű�е�
       ( (event.keyCode >= 48) && (event.keyCode <= 57 ) ) || // 0 ~ 9
       ( (event.keyCode >= 96) && (event.keyCode <= 105 ) )   // 0 ~ 9 in �����е�
     )
    event.returnValue=true;
  else
    event.returnValue=false;
}

function isNumberOrPoint(){
  if ( (event.keyCode == 46) ||  // DEL
       (event.keyCode == 8)  ||  // backspace
       (event.keyCode == 9)  ||  // tab
       (event.keyCode == 37) ||  // �� key
       (event.keyCode == 38) ||  // �� key
       (event.keyCode == 39) ||  // �� key
       (event.keyCode == 40) ||  // �� key
       (event.keyCode == 35) ||  // HOME key
       (event.keyCode == 36) ||  // END key
       (event.keyCode == 13) ||  // Enter key

	   (event.keyCode == 188)  ||  // comma
	   (event.keyCode == 17)  ||  // ctrl
	   (event.keyCode == 67)  ||  // c
	   (event.keyCode == 86)  ||  // v
	   (event.keyCode == 88)  ||  // v
       
       (event.keyCode == 110) ||  // . key
       ( (event.keyCode >= 48) && (event.keyCode <= 57 ) ) || // 0 ~ 9
       ( (event.keyCode >= 96) && (event.keyCode <= 105 ) )   // 0 ~ 9 in �����е�
     )
    event.returnValue=true;
  else
    event.returnValue=false;
}

function fnMaxReal(arg, max){
	arg.value = arg.value.trim();

	var str = arg.value;
	var sum = 0;

	var k;

	for(var i = 0; i < str.length; i++)	{
		k = str.charCodeAt(i) ; 

		if(k >= 48 && k <= 57){ 
			sum += 1;
		}
	}

	if (sum > max){
		alert ("�Է��� �� �ִ� ���ڼ��� �Ѿ����ϴ�.")
		arg.select();
		return false;
	}
	return true;
}

function chkFixReal(v, size, scale) {
	var index = v.value.indexOf(".");
	var num;
	var point;
	if ( index != -1 ) {
		num = v.value.substring(0,index);
		point = v.value.substring(index+1,v.value.length);
		if ( v.value > size ) {
			alert(size+"%�� ���� �� �����ϴ�.");
			v.value = "0";
			v.focus();
		}
		if ( point.length > scale ) {
			alert("�Ҽ������� "+scale+"�ڸ������� �Է� �����մϴ�.");
			v.value = "0";
			v.focus();
		}
	} else {
		if ( v.value > size ) {
			alert(size+"%�� ���� �� �����ϴ�.");
			v.value = "0";
			v.focus();
		}
	}
}

function getRealNumber(format) {
  var number="";
  for(var i=0; i < format.length; i++) {
    if(format.charAt(i) >= '0' && format.charAt(i) <= '9') number += format.charAt(i);
  }
  return eval(number);
}

function chkDateValidity(yearObj, monthObj, dateObj){
	var tmpDate = new Date(yearObj.value, monthObj.value-1, dateObj.value);
	if ( tmpDate.getYear() != yearObj.value || tmpDate.getMonth() != monthObj.value-1 || tmpDate.getDate() != dateObj.value) {
		return false;
	} else {
		return true;
	}
}

function setMoneyFormat( tmpObj ){
	var cruVal = formattedMoney(tmpObj);
	tmpObj.value = cruVal;
}
function getMoneyFormat( tmpObj ) {
	return formattedMoney(tmpObj);
}
function setRemainder (obj,nextVal){
	var tmp = 100 - obj.value;
	nextVal.value = tmp;
}

function setMoneyUpper(obj, bound){
	var tmp = removeFormattedMoney(obj);
	if ( tmp.length > bound ) {
		alert(bound+"�ڸ��� �̻� �ʰ��� �� �����ϴ�.");
		obj.value = "0";
		obj.focus();
	}
}
function chkFixReal(v, size, scale) {
	var index = v.value.indexOf(".");
	var num;
	var point;
	if ( index != -1 ) {
		num = v.value.substring(0,index);
		point = v.value.substring(index+1,v.value.length);
		if ( v.value > size ) {
			alert(size+"�� ���� �� �����ϴ�.");
			v.value = "0";
			v.focus();
		}
		if ( point.length > scale ) {
			alert("�Ҽ������� "+scale+"�ڸ������� �Է� �����մϴ�.");
			v.value = "0";
			v.focus();
		}
	} else {
		if ( v.value > size ) {
			alert(size+"�� ���� �� �����ϴ�.");
			v.value = "0";
			v.focus();
		}
	}
}

function toUpperCase() {
  if(!(event.keyCode < 97 || event.keyCode > 122)) {
    event.keyCode -= 32;
    event.returnValue=true;
  }
}
//����� ��Ϲ�ȣ
function cvtBNumber(obj){
	var exp = /-/g;
	var number = obj.value.replace(exp,"");
	var num = "";
	
	if ( number.length > 5 ) {
		num = number.substring(0,3) + "-" + number.substring(3,5) + "-" + number.substring(5);
	} else if ( number.length > 3 ) {
		num = number.substring(0,3) + "-" + number.substring(3);
	} else if ( number.length <= 3 ) {
		num = obj.value;
	}
	obj.value = num;
	
}

//���ε�Ϲ�ȣ
function cvtCNumber(obj){
	var exp = /-/g;
	var number = obj.value.replace(exp,"");
	var num = "";
	
	if ( number.length > 6 ) {
		num = number.substring(0,6) + "-" + number.substring(6);
	} else {
		num = obj.value;
	}
	obj.value = num;
	
}


function cvtDate(obj){
	var exp = /-/g;
	var number = obj.value.replace(exp,"");
	var num = "";
	
	if ( number.length > 6 ) {
		num = number.substring(0,4) + "-" + number.substring(4,6) + "-" + number.substring(6);
	} else if ( number.length > 4 ) {
		num = number.substring(0,4) + "-" + number.substring(4);
	} else if ( number.length <= 4 ) {
		num = obj.value;
	}
	obj.value = num;
}
function insertHyphen(target){
	var rev = reverse(target);
	var cnt = 0;
	if ( target.length%4 != 0 ) {
		cnt = Math.floor(target.length/4);
	} else {
		cnt = Math.floor(target.length/4)-1;
	}
	var result = "";
	if ( cnt > 0 ) {
		var token = new Array();
		for ( var i=0; i<=cnt; i++ ) {
			token[i] =  reverse(rev.substring(0,4));
			rev = rev.substring(4);
		}
		for ( var i=cnt; i>0; i-- ){
			result = result + token[i] + "-";
		}
		result += token[0];
		return result;

	} else {
		return target;
	}
}

function formSave(btn){
	if ( event.ctrlKey ) {
		if ( event.keyCode == 83 ){
			btn.click();
		}
	}
}

/**
 * ��ɼ���		: ���ڿ��� �յ� ������ �����Ѵ�.
 * ��뿹		: ���ڿ�.trim()
 */
String.prototype.trim = function() { 
	return this.replace(/(^\s*)|(\s*$)/g, ""); 
}

function setMoneyFormat2( tmpObj ){
	var cruVal = formattedMoney2(tmpObj);
	tmpObj.value = cruVal;
}

function formattedMoney2(v) {
	var format = "";
	var money = removeFormattedMoney2(v);
	var flag = "";

	if ( money.substring(0,1) == "-" ){
		flag ="-";
		money = money.substring(1);
	}
	
	money = reverse(money);
	
	for(var i = money.length-1; i > -1; i--) {
		if((i+1)%3 == 0 && money.length-1 != i) format += ",";
			format += money.charAt(i);
		}
	return flag+format;
	
}

function removeFormattedMoney2(v) {
	var unformat = "";
	var money = getNumber2(v);
	var flag = "";
	if ( money.substring(0,1) == "-" )	{
		flag = "-";
		money = money.substring(1);
	}
	var arr = money.split(",");
	for(var i = 0; i < arr.length; i++) {
		unformat += arr[i];
	}
	return flag+unformat;
}

function getNumber2(obj){
	var exp = /[^0-9-]/g;
	var number = obj.value.replace(exp,"");
	return number;
}

function addCommaPoint(obj,fLen){ 

	if(event.keyCode == 37 || event.keyCode == 39 ) {                                              
		return;
	}
	var fLen = fLen || 2; 
	var strValue = obj.value.replace(/,|\s+/g,'');
	var strBeforeValue = (strValue.indexOf('.') != -1)? strValue.substring(0,strValue.indexOf('.')) :strValue ;
	var strAfterValue  = (strValue.indexOf('.') != -1)? strValue.substr(strValue.indexOf('.'),fLen+1) : '' ;
	if(isNaN(strValue)){
		alert(strValue.concat(' -> ���ڰ� �ƴմϴ�.'));
		return false;
	}
	var intLast =  strBeforeValue.length-1;
	var arrValue = new Array;
	var strComma = '';
	for(var i=intLast,j=0; i >= 0; i--,j++){ 
		if( j !=0 && j%3 == 0) {   
			strComma = ',';
		}else{
			strComma = '';
		}
		arrValue[arrValue.length] = strBeforeValue.charAt(i) + strComma  ;
	}
	obj.value=  arrValue.reverse().join('') +  strAfterValue; 
}

function autoSum(obj1, obj2, obj3){
	if ( obj1.value.length > 0 && obj2.value.length > 0 ) {
		obj3.value = Math.round(eval(removeFormattedMoney(obj1))+Math.round(removeFormattedMoney(obj2)));
		addCommaPoint(obj3);
	} else {
		obj3.value = "";
		addCommaPoint(obj3);
	}
}

function autoSend(obj1, obj2){
	if ( obj1.value.length > 0 ) {
		obj2.value = Math.round(eval(removeFormattedMoney(obj1)));
	} else {
		obj2.value = "";
	}
}

function taborder(arg,nextname,len) {
	if (arg.value.length==len) {
		nextname.focus() ;
		return;
  }
}    

// 2008-02-26 ���� ����� ��ũ��Ʈ

// �̸��� ���� üũ
function isValidEmail(input) {
	var format = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.[a-zA-Z]{2,4}$/;
	return isValidFormat(input,format);
}

// �̸��ϸ���Ʈ ���� üũ
function isValidEmailing(input) {
    var mail = input.value;
	var splitStart;
	var splitEnd;
	mail = mail.replace(/ /gi,"");
	mail = mail.replace(/\n/gi,",");
	mail = mail.replace(/[;]/gi,",");
	var mailList = mail.split(",");
	var format = /\w+([-+.]\w+)*@\w+([-.]\w+)*\.[a-zA-Z]{2,4}$/;

	for (var i = 0; i < mailList.length ; i++) {
		mail = mailList[i].trim();
		if (mail.length > 3) {
			if (mail.search(format) == -1) {
				return false;
			}
		}
	}
	return true;
}


// ��¥ �ð� ������ yyyy-MM-dd HH:mm:dd���� �����Ѵ�.
function cvtDateTime(obj){
	var number = obj.value;
	var num = "";

	number = replace(number, "-", "");
	number = replace(number, ":", "");
	number = replace(number, " ", "");
	
	if ( number.length == 13 ) {
		num = number.substring(0,4) + "-" + number.substring(4,6) + "-" + number.substring(6, 8) +" "+ number.substring(8, 10) +":"+number.substring(10, 12)+":"+number.substring(12);
		obj.value = num;
	} else if ( number.length == 11 ) {
		num = number.substring(0,4) + "-" + number.substring(4,6) + "-" + number.substring(6, 8) +" "+ number.substring(8, 10) +":"+number.substring(10);
		obj.value = num;
	} else if ( number.length == 9 ) {
		num = number.substring(0,4) + "-" + number.substring(4,6) + "-" + number.substring(6, 8) +" "+ number.substring(8);
		obj.value = num;
	} else if ( number.length == 7 ) {
		num = number.substring(0,4) + "-" + number.substring(4,6) + "-" + number.substring(6);
		obj.value = num;
	} else if ( number.length == 5 ) {
		num = number.substring(0,4) + "-" + number.substring(4);
		obj.value = num;
	}
}

// ���ڿ� ġȯ�ϱ�(���ڿ�, ã�����ڿ�, �����ҹ��ڿ�)
function replace(str,s,d){
 var i=0;

 while(i > -1){
  i = str.indexOf(s);
  str = str.substr(0,i) + d + str.substr(i+1,str.length);
 }
 return str;
}


// ���ڸ� �Է� �����ϵ��� �����ϱ�
function isNumber(){
  if ( (event.keyCode == 46) ||  // DEL
       (event.keyCode == 8)  ||  // backspace
       (event.keyCode == 9)  ||  // tab
       (event.keyCode == 37) ||  // �� key
       (event.keyCode == 38) ||  // �� key
       (event.keyCode == 39) ||  // �� key
       (event.keyCode == 40) ||  // �� key
       (event.keyCode == 35) ||  // HOME key
       (event.keyCode == 36) ||  // END key
       (event.keyCode == 13) ||  // Enter key

	   (event.keyCode == 188)  ||  // comma
	   (event.keyCode == 17)  ||  // ctrl
	   (event.keyCode == 67)  ||  // c
	   (event.keyCode == 86)  ||  // x
	   (event.keyCode == 88)  ||  // v
       
       ( (event.keyCode >= 48) && (event.keyCode <= 57 ) ) || // 0 ~ 9
       ( (event.keyCode >= 96) && (event.keyCode <= 105 ) )   // 0 ~ 9 in �����е�
     )
    event.returnValue=true;
  else
    event.returnValue=false;
}

// ��¥�� �ð��� �����ϴ� üũ
function chkDateTime(obj) {
	var input = obj.value;
	input = replace(input, "-", "");
	input = replace(input, ":", "");
	input = replace(input, " ", "");
	var inputYear = input.substring(0, 4);
	var inputMonth = input.substring(4, 6) - 1;
	var inputDate = input.substring(6, 8);
	var inputHour = input.substring(8, 10);
	var inputMinute = input.substring(10, 12);
	var inputSecond = input.substring(12);
	var resultDate = new Date(inputYear, inputMonth, inputDate, inputHour, inputMinute, inputSecond);

	if (resultDate.getFullYear()	!= inputYear	||
		resultDate.getMonth()		!= inputMonth	||
		resultDate.getDate()		!= inputDate	||
		resultDate.getHours()		!= inputHour	||
		resultDate.getMinutes()		!= inputMinute	||
		resultDate.getSeconds()		!= inputSecond	) {
		return false;
	} else {
		return true;
	}
}

// ���� Ȯ�� �ϱ�
function delConfirm(alertMessage, rurl) {
	sure = confirm(alertMessage);
	if (sure)
		location.href=rurl;
}

// ������ üũ�ڽ� �����ϱ�
function check(allChk, chkbox){
	if ( chkbox ) {
	    if ( chkbox.length ) {
	        for(var i = 0; i<chkbox.length; i++) {
	            chkbox[i].checked = allChk.checked;
	        }
	    } else {
	        chkbox.checked = allChk.checked;
	    }
    } else {
    	alert("������ �׸��� �����ϴ�.");
    }
}

// üũ�ڽ��� �ϳ��� üũ�Ǿ� �ִ��� Ȯ��
function isSeleted(objCheck){
	var count = 0;
	if ( objCheck ) {
		if(objCheck.name != undefined) {
			if (objCheck.checked ==true) {
				count=1;
			}
		} else {
			for (i=0; i<objCheck.length; i++) {
				if (objCheck[i].checked == true) {
					count=count+1; 
					break;
				}
			}
		}
    }
	if (count==0){
		return false;
	} else {
		return true;
	}
}

//�̹����� width�� ���� ���� �� ���� ū�� Ȯ�� �� �� ũ�� ���� ���� ������ �����Ѵ�.
function imgReSize(img, width)	{
	var temp;
	temp	= new Image();
	temp.src=img.src;
	
	if( temp.width > width )	{
		img.width = width;
	}
}

// �˾� ���� ����

function startTime(cName, cMain, layerTop, layerLeft, layerWidth, layerHeight, type) {

	cookieIndex = getCookie(cName);
	if ( !cookieIndex || type == "0") {     
		document.getElementById(cName).style.visibility = "visible";
	} else {
		document.getElementById(cName).style.visibility = "hidden";
	}

    document.getElementById(cName).style.top = layerTop+"px";
    document.getElementById(cName).style.left = layerLeft+"px";
    document.getElementById(cName).style.width = layerWidth+"px";
    document.getElementById(cMain).style.height = layerHeight+"px";
}

function setCookie( name, value ) {
	var expiredays = 1;			//����â �Ϸ� �ȶ��� �ð�. 1�� �Ϸ���
	var todayDate = new Date();
	todayDate.setDate(todayDate.getDate() + expiredays);
	document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function closeLayer(cName, chkbox, type , pName) {
    if ( chkbox.checked ) {
		setCookie(cName, "os");
	}
	if (type == "1") {
		document.getElementById(pName).style.display = "none";
		document.getElementById(cName).style.visibility = "hidden";
	} else {
		window.close();
	}
}

isIE  = document.all;
isNN  = !document.all && document.getElementById;
isN4  = document.layers;

var max_zindex = 30;
function drag( mode,e,obj ) {
    if ( mode == 'start' ) {
		obj.offsetx = isIE ? event.clientX : e.clientX;
		obj.offsety = isIE ? event.clientY : e.clientY;

		obj.nowX    = parseInt(obj.style.left);
		obj.nowY    = parseInt(obj.style.top);
		obj.dragable = '1';

		var new_zindex = max_zindex + 1;
		obj.style.zIndex = new_zindex;
		max_zindex = new_zindex;
	} else if ( mode == 'move' ) {
		if ( obj.dragable == '1' ) {
			var x = isIE ? (obj.nowX + event.clientX - obj.offsetx) : (obj.nowX + e.clientX - obj.offsetx);
			var y = isIE ? (obj.nowY + event.clientY - obj.offsety) : (obj.nowY + e.clientY - obj.offsety);
			var max_winw = document.body.clientWidth - parseInt(obj.style.width);
			var max_winh = document.body.clientHeight - parseInt(obj.style.height);

			if ( x >= 0 && x <=max_winw ) obj.style.left = x;
			if ( y >= 0 && y <=max_winh ) obj.style.top  = y;
		}
	} else if ( mode == 'stop' ) {
		obj.dragable='0'
	}
}

function getCookie( name ) {
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length ) {
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
			endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}

		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 )
		break;
    }
    return "";
}

// �˾� ���� ��

// ���� üũ
function isNum(input) {
    var chars = "0123456789";
    return containsCharsOnly(input,chars);
}

// ���� ��ư�� üũ �� �׸��� ���� ���Ѵ�.
function getRadioValue(obj){

	var result = "";
	
	var tmpRad = new Array();
	tmpRad = obj;
	
	for ( var i=0; i<tmpRad.length; i++ ){
		if ( tmpRad[i].checked ){
			result = tmpRad[i].value;
		} 
	}
	return result;
}

/**
* �Է°��� �����̽� �̿��� �ǹ��ִ� ���� �ִ��� üũ
* ex) if (isEmpty(form.keyword)) {
*         alert("�˻������� �Է��ϼ���.");
*     }
*/
function isEmpty(input) {
    if (input.value == null || input.value.replace(/ /gi,"") == "") {
		return true;
    }
    return false;
}

// �����ϴ� �̹������� �⺻��ȿ�� Ȯ���� �� �ѱ� �̹����� üũ
function checkImgFormat(input){

	if ( !input.value.match(/\.(gif|jpg|png|bmp)$/i) ) {
		alert("�������� �ʴ� �����Դϴ�.(���� ���� :.jpg, .gif, .png, .bmp)");
		return true;
	}

	var extFile = input.value.split("\\");
	var ImgInfo = extFile[extFile.length-1];
	var ext = ImgInfo.split(".");
/*	if ( !isAlphaNum(ext[0]) ) {
		alert("�̹������� ����, ����, -, _ �� ����մϴ�.(���� ��� �� ��)");
		return true;
	}*/
}

// �˾� �������� �̹������� �⺻��ȿ�� Ȯ���� �� �ѱ� �̹����� üũ
function checkImgFormatPopup(input){

	if ( !input.value.match(/\.(gif|jpg)$/i) ) {
		alert("�������� �ʴ� �����Դϴ�.(���� ���� :.jpg, .gif)");
		return true;
	}

	var extFile = input.value.split("\\");
	var ImgInfo = extFile[extFile.length-1];
	var ext = ImgInfo.split(".");
	if ( !isAlphaNum(ext[0]) ) {
		alert("�̹������� ����, ����, -, _ �� ����մϴ�.(���� ��� �� ��)");
		return true;
	}
}

// �����ϴ� �̵���� �⺻��ȿ�� Ȯ���� �� �ѱ� �̹����� üũ
function checkMediaFormat(input){

	if ( !input.value.match(/\.(asf|wmv|avi|mpeg|mpg|wav|mp3|mid)$/i) ) {
		alert("�������� �ʴ� �����Դϴ�.(���� ���� :.asf, .wmv, .avi. .mpeg, .mpg, .wav, mp3, .mid)");
		return true;
	}

	var extFile = input.value.split("\\");
	var ImgInfo = extFile[extFile.length-1];
	var ext = ImgInfo.split(".");
	if ( !isAlphaNum(ext[0]) ) {
		alert("�̵����� ����, ����, -, _ �� ����մϴ�.(���� ��� �� ��)");
		return true;
	}
}

// �Է°��� ���ĺ�,����, -, _ �Ǿ��ִ��� üũ
function isAlphaNum(input) {
    var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_";
    return containsCharsValueOnly(input,chars);
}

// input(object) ���� chars���θ� �̷�� ������ Ȯ���Ѵ�.
function containsCharsOnly(input,chars) {
    for (var inx = 0; inx < input.value.length; inx++) {
       if (chars.indexOf(input.value.charAt(inx)) == -1)
           return false;
    }
    return true;
}

// input(String ��) ���� chars���θ� �̷�� ������ Ȯ���Ѵ�.
function containsCharsValueOnly(input,chars) {
    for (var inx = 0; inx < input.length; inx++) {
       if (chars.indexOf(input.charAt(inx)) == -1)
           return false;
    }
    return true;
}

// select box�� option�� ���õǾ� �ִ��� Ȯ��
function selectBoxSelectedCheck(input) {
	var result = false;
	for (var i=0 ; i < input.options.length ; i++) {
		if (input.options[i].selected == true) {
			result = true;
		}
	}
	return result;
}

//------------------------- sms �κ� ���� -----------------------------
function addChar (ch){
	var f = document.frm;
	var t;
	var msglen;
	msglen = 0;
	f.tran_msg.value = f.tran_msg.value + ch;
	l = f.tran_msg.value.length;
	for(k=0;k<l;k++){
		t = f.tran_msg.value.charAt(k);
		if (escape(t).length > 4)
			msglen += 2;
		else
			msglen++;
	}
	f.msgLength.value = msglen;
}

/*
 * textarea ���� ���� ����
 */

// ������ ������ üũ �ϱ�
function chkLengthMulti(name) {

	var tmpStr, nStrLen, reserve;

	sInputStr = document.all[name].value;
	nStrLen = calculate_byte(sInputStr);

	if ( nStrLen > 2000 ) {
		tmpStr = Cut_Str(sInputStr,2000);
		reserve = nStrLen - 2000;

		alert("�ۼ��Ͻ� ������ " + reserve + "����Ʈ�� �ʰ��Ǿ����ϴ�.(�ִ� 2000Bytes)"); 

		// 2000byte�� �°� �Է³��� ����
		document.all[name].value = tmpStr;
		nStrLen = calculate_byte(tmpStr);
	}

	return;
}

function chkLength(frm) {
	var f = frm;
	var tmpStr, nStrLen, reserve;

	sInputStr = f.message.value;
	nStrLen = calculate_byte(sInputStr);

	if ( nStrLen > 80 ) {
		tmpStr = Cut_Str(sInputStr,80);
		reserve = nStrLen - 80;

		alert("�ۼ��Ͻ� ������ " + reserve + "����Ʈ�� �ʰ��Ǿ����ϴ�.(�ִ� 80Bytes)"); 

		// 80byte�� �°� �Է³��� ����
		f.message.value = tmpStr;
		nStrLen = calculate_byte(tmpStr);
		f.msgLength.value = nStrLen;
	} else {
		f.msgLength.value = nStrLen;
	}

	return;
}
// mms ������ ������ üũ �ϱ�
function mmsChkLengthMulti(name) {

	var tmpStr, nStrLen, reserve;

	sInputStr = document.all[name].value;
	nStrLen = calculate_byte(sInputStr);

	if ( nStrLen > 2000 ) {
		tmpStr = Cut_Str(sInputStr,2000);
		reserve = nStrLen - 2000;

		alert("�ۼ��Ͻ� ������ " + reserve + "����Ʈ�� �ʰ��Ǿ����ϴ�.(�ִ� 2000Bytes)"); 

		// 80byte�� �°� �Է³��� ����
		document.all[name].value = tmpStr;
		nStrLen = calculate_byte(tmpStr);
	}

	return;
}

function mmsChkLength(frm) {
	var f = frm;
	var tmpStr, nStrLen, reserve;

	sInputStr = f.message.value;
	nStrLen = calculate_byte(sInputStr);
	

	if ( nStrLen > 2000 ) {
		tmpStr = Cut_Str(sInputStr,2000);
		reserve = nStrLen - 2000;

		alert("�ۼ��Ͻ� ������ " + reserve + "����Ʈ�� �ʰ��Ǿ����ϴ�.(�ִ� 2000Bytes)"); 

		// 80byte�� �°� �Է³��� ����
		f.message.value = tmpStr;
		nStrLen = calculate_byte(tmpStr);
		f.msgLength.value = nStrLen;
	} else {
		f.msgLength.value = nStrLen;
	}

	return;
}



function calculate_byte( sTargetStr ) {
	var sTmpStr, sTmpChar;
	var nOriginLen = 0;
	var nStrLength = 0;
	 
	sTmpStr = new String(sTargetStr);
	nOriginLen = sTmpStr.length;

	for ( var i=0 ; i < nOriginLen ; i++ ) {
		sTmpChar = sTmpStr.charAt(i);

		if (escape(sTmpChar).length > 4) {
			nStrLength += 2;
		} else if (sTmpChar!='\r') {
			nStrLength ++;
		}
	}
	
	return nStrLength; 
	
}
/*
 * textarea ���� ���� ���� ��
 */

function Cut_Str( sTargetStr , nMaxLen ) {
	var sTmpStr, sTmpChar, sDestStr;
	var nOriginLen = 0;
	var nStrLength = 0;
	var sDestStr = "";
	sTmpStr = new String(sTargetStr);
	nOriginLen = sTmpStr.length;

	for ( var i=0 ; i < nOriginLen ; i++ ) {
		sTmpChar = sTmpStr.charAt(i);

		if (escape(sTmpChar).length > 4) {
			nStrLength = nStrLength + 2;
		} else if (sTmpChar!='\r') {
			nStrLength ++;
		}

		if (nStrLength <= nMaxLen) {
			sDestStr = sDestStr + sTmpChar;
		} else {
			break;
		}

	}
	
	return sDestStr; 
	
}

function cvtPhoneNumberForTextArea(obj){
	if ( (event.keyCode == 46) ||  // DEL
       (event.keyCode == 8)  ||  // backspace
       (event.keyCode == 9)  ||  // tab
       (event.keyCode == 37) ||  // �� key
       (event.keyCode == 38) ||  // �� key
       (event.keyCode == 39) ||  // �� key
       (event.keyCode == 40) ||  // �� key
       (event.keyCode == 35) ||  // HOME key
       (event.keyCode == 36) ||  // END key
       (event.keyCode == 13) ||  // Enter key

	   (event.keyCode == 17)  ||  // ctrl
	   (event.keyCode == 67)  ||  // c
	   (event.keyCode == 86)  ||  // v
	   (event.keyCode == 88)  ||  // v
       
       (event.keyCode == 109) ||  // - key in �����е�
	   (event.keyCode == 189)	  // - key in Ű�е�
    ){} else {
		var exp = /\s/g;
		var expDash = /-/g;
		var numbers = obj.value.split("\n");
		var result = "";
		var rowNumber;
		var rowReverse;
		var rowResult;
		for ( var i=0; i<numbers.length ; i++){
			rowNumber = "";
			rowReverse = "";
			rowResult = "";
			rowNumber = numbers[i].replace(exp,"");
			rowNumber = rowNumber.replace(expDash,"");
			if ( rowNumber.length > 2 ) {
				if ( rowNumber.substring(0,2) == "02" ) {
					rowResult = rowNumber.substring(0,2) + "-" + insertHyphen(rowNumber.substring(2));
				} else if ( rowNumber.length >= 3 && rowNumber.substring(0,2) != "02" ) {
					rowResult = rowNumber.substring(0,3)+"-"+insertHyphen(rowNumber.substring(3));
				}
			} else {
				rowResult = rowNumber;
			}
			numbers[i] = rowResult;
		}
		for ( var i=0; i<numbers.length ; i++){
			if ( numbers[i].length > 0 ) {
				if ( i < numbers.length-1 ) {
					result = result + numbers[i]+"\n";
				} else {
					result = result + numbers[i];
				}
			}
		}
		obj.value = result;
	}
}

//------------------------- sms �κ� �� -----------------------------

// ���� ���ڸ�
function isOnlyNumber(obj){
	var exp = /[^0-9]/g;
	if ( exp.test(obj.value) ) {
		alert("���ڸ� �Է°����մϴ�.");
		obj.value = "";
		obj.focus();
	}
}

//���ڿ� ������ ǥ��
function isNumberOrHyphen(obj){
	var exp = /[^0-9-]/g;
	if ( exp.test(obj.value) ) {
		alert("���ڿ� '-'�� �Է°����մϴ�.");
		obj.value = "";
		obj.focus();
	}
}

function isNumberOrHyphen2(obj){
	var exp = /[^0-9,]/g;
	if ( exp.test(obj.value) ) {
		alert("���ڸ� �Է°����մϴ�.");
		obj.value = "";
		obj.focus();
	}
}


//���� ������, ���͸� ǥ��
function isNumberOrHyphenOrEnter(obj){
	var exp = /[^0-9-\r\n]/g;
	if ( exp.test(obj.value) ) {
		alert("���ڿ� '-'�� ����Ű�� �����մϴ�.");
		obj.value = "";
		obj.focus();
	}
}

// ���ڸ� �����Ѵ�.
function getNumber(obj){
	var exp = /[^0-9]/g;
	var number = obj.value.replace(exp,"");
	return number;
}

// ��ȭ��ȣ�� ������ ����ֱ�
function cvtPhoneNumber(obj){
	var exp = /-/g;
	var number = obj.value.replace(exp,"");
	var revNumber = reverse(number);
	if ( obj.value.length > 2 ) {
		if ( number.substring(0,2) == "02" ){
			obj.value = number.substring(0,2)+"-"+insertHyphen(number.substring(2));
		} else if ( obj.value.length > 3 && number.substring(0,2) != "02" && number.substring(0,1) == "0" ) {
			obj.value = number.substring(0,3)+"-"+insertHyphen(number.substring(3));
		} else if (obj.value.length > 4 && number.substring(0,1) != "0") {
			obj.value = number.substring(0,4)+"-"+insertHyphen(number.substring(4));
		}
	}
}

// table ���� rowspan �ڵ� ó��
// tableId :  table id 
// rowIndex : table�� ���� row index(0���� ����)
// cellIndex : �ش� row�� cell index(0���� ����)
function cellMergeChk(tableObj, rowIndex, cellIndex) {
	var rowsCn = tableObj.rows.length;
	
	if(rowsCn-1 > rowIndex)
		cellMergeProcess(tableObj, rowIndex, cellIndex);
}

function cellMergeProcess(tableObj, rowIndex, cellIndex) {
	var flag = 0;
	var rowsCn = tableObj.rows.length;
	var compareCellsLen = tableObj.rows(rowIndex).cells.length;  //���� row�� cell ����

	//�ʱ�ȭ
	var compareObj = tableObj.rows(rowIndex).cells(cellIndex);
	var compareValue = compareObj.innerHTML;
	var cn = 1;
	var delCells = new Array();
	var arrCellIndex = new Array();

	for(i=rowIndex+1; i < rowsCn; i++) {
		var cellsLen = tableObj.rows(i).cells.length;
		var bufCellIndex = cellIndex

		// �������� row�� cellIndex�� ������.
		if(compareCellsLen != cellsLen) {
			bufCellIndex = bufCellIndex - (compareCellsLen - cellsLen);
		}

		if (bufCellIndex < 0) {
			break;
		}

		cellObj = tableObj.rows(i).cells(bufCellIndex);

		if(compareValue == cellObj.innerHTML) {
			delCells[cn-1] = tableObj.rows(i);		// ������ cell�� row�� �����Ѵ�.
			arrCellIndex[cn - 1] = bufCellIndex;	// �ش� row cell index�� �����Ѵ�.
			cn++;
			flag = 1;
		} else {
			compareObj.rowSpan = cn;				// ����
			for(j=0; j < delCells.length; j++) {	// ����
				delCells[j].deleteCell(arrCellIndex[j]);
			}

			flag = 0;
			//�ʱ�ȭ
			compareObj = cellObj;
			compareValue = cellObj.innerHTML;
			cn = 1;
			delCells = new Array();
			arrCellIndex = new Array();
		}
	}

	if (flag == 1) {
		compareObj.rowSpan = cn;					// ����
		for(j=0; j < delCells.length; j++) {		// ����
			delCells[j].deleteCell(arrCellIndex[j]);
		}
	}

	function setZero(obj){
		if ( obj.value == "" ) {
			obj.value = "0";
		}
	}

	function initZero(obj){
		if ( obj.value == 0 ) {
			obj.value = "";
			obj.focus();
		}
	}
}    


// sms �� mms ����
function selfchkLength(frm) {
	var f = frm;
	var tmpStr, nStrLen, reserve;
	var tmpN = 0;
	sInputStr = f.message.value;
	nStrLen = calculate_byte(sInputStr);


	if ( nStrLen > 80) {
		ShowBlend();
	} else {
		ReturnBlend();
	}

	if ( nStrLen > 2000 ) {
		tmpStr = Cut_Str(sInputStr,2000);
		reserve = nStrLen - 2000;

		alert("�ۼ��Ͻ� ������ " + reserve + "����Ʈ�� �ʰ��Ǿ����ϴ�.(�ִ� 2000Bytes)"); 

		// 2000byte�� �°� �Է³��� ����
		f.message.value = tmpStr;
		nStrLen = calculate_byte(tmpStr);
		f.msgLength.value = nStrLen;
	} else {
		f.msgLength.value = nStrLen;
	}

	return;
}

// �������� ����
function filterInfo(contents) {

	// �������� ���� ����
	var cellRegcnt = 0;
	var emailRegcnt = 0;
	var psnoRegcnt = 0;
	var totalRegcnt = 0;
	var RegMessage = "";
	var regCell = /\d{2,3}[-\.]\d{3,4}[-\.]\d{4}/g;								// �޴�����ȣ ���Խ�
	var regEmail = /(\w+\.)*\w+@[\w+\.]+\w+/g;									// �̸��� ���Խ�
	var regPsno = /\d{2}(0[1-9]|1[0-2])(0[1-9]|[12][0-9]|3[01])-[1-4]\d{6}/g;	// �ֹε�Ϲ�ȣ ���Խ�
	var sure = true;;

	if(regCell.test(contents)) {
		cellRegcnt++;
		totalRegcnt++;
	}

	if(regEmail.test(contents)) {
		emailRegcnt++;
		totalRegcnt++;
	}

	if(regPsno.test(contents)) {
		psnoRegcnt++;
		totalRegcnt++;
	}

	if(totalRegcnt == 3 || totalRegcnt == 2) {

		RegMessage = "���뿡 �������� ���� ������ ���ֽ��ϴ�.\n�˻������� ���� �� ����� �ֽ��ϴ�.\n������������ �׸���� �ش���� ���°� �����մϴ�.\n�׷��� �����Ͻðڽ��ϱ�?";	

	} else if(totalRegcnt == 1) {

		if(cellRegcnt > 0) {

			RegMessage = "���뿡 �������� ���� ������ ���ֽ��ϴ�.\n�˻������� ���� �� ����� �ֽ��ϴ�.\n����ó ������ �޴��� �� ��ȭ��ȣ���� ���°� �����մϴ�.\n�׷��� �����Ͻðڽ��ϱ�?";

		} else if(emailRegcnt > 0) {

			RegMessage = "���뿡 �������� ���� ������ ���ֽ��ϴ�.\n�˻������� ���� �� ����� �ֽ��ϴ�.\n�̸��� ������ �̸��϶��� ���°� �����մϴ�.\n�׷��� �����Ͻðڽ��ϱ�?";

		} else if(psnoRegcnt > 0) {

			RegMessage = "���뿡 �������� ���� ������ ���ֽ��ϴ�.\n�˻������� ���� �� ����� �ֽ��ϴ�.\n�ֹι�ȣ ������ ������� ���� �ʴ°� �����մϴ�.\n�׷��� �����Ͻðڽ��ϱ�?";
		}
	}	

	if(totalRegcnt > 0) {
		sure = confirm(RegMessage);
	}

	return sure;
	
}


// �빮�� �ڵ� ��ȯ
function upperCase(){
     document.getElementById("chkflag").value = document.getElementById("chkflag").value.toUpperCase();
}

// ajax�� ������ ȣ���ؼ� �ش� id�� append (Jquery)
function getAjaxPage(reqPage, param1, param2, param3, innerId, msg) {
	$.ajax({ 
		  type: "GET", 
		  url: reqPage, 
		  async:true,
		  data:"param1="+param1+"&param2="+param2+"&param3="+param3,
		  dataType:"html",
		  success: function(html){
			  //$("#"+innerId).remove();
			  $("#"+innerId).html(html);
		  },
		  error : function(request, status, error) {
			  alert("code : "+request.status+"\r\nmessage : "+request.responseText);
		  }
	});
	
}

/*// ��й�ȣ ��ȿ��üũ
function validPassword(password) {
	var pass = password.value;
	var str = /^[a-zA-Z0-9]{6,12}$/;
	var str2 = /(\w)\1\1\1/;
	var chk_num = pass.search(/[0-9]/g);
	var chk_eng = pass.search(/[a-z]/ig);
	var check = false;
	if (pass == "") {
		alert("��й�ȣ�� �Է��� �ּ���.");
		password.focus();
	}else if(!str.test(pass) || pass.indexOf(' ') > -1){
		alert("��й�ȣ�� ����+���� 6~12�ڸ��� �Է��� �ּ���.");
		password.focus();
	}else if(str2.test(pass)){
		alert("��й�ȣ�� �ݺ��Ǵ� ���� �� ���ڰ� �ֽ��ϴ�.");
		password.focus();
	}else if(chk_num < 0 || chk_eng < 0) {
		alert("��й�ȣ�� ���ڿ� �����ڸ� ȥ���Ͽ��� �մϴ�.");
		password.focus();
	}else{
		check = true;
	}
	return check;
}

//��й�ȣ ��ȿ��üũ(��й�ȣȮ��)
function validConfirmPassword(password, confirmPassword) {
	var pass = password.value;
	var confirm = confirmPassword.value;
	var str = /^[a-zA-Z0-9]{6,12}$/;
	var str2 = /(\w)\1\1\1/;
	var chk_num = pass.search(/[0-9]/g);
	var chk_eng = pass.search(/[a-z]/ig);
	var check = false;
	if (pass == "") {
		alert("��й�ȣ�� �Է��� �ּ���.");
		password.focus();
	}else if (pass != confirm) {
		alert("�Է��� ��й�ȣ�� ���� �ٸ��ϴ�.");
		confirmPassword.focus();
	}else if(!str.test(pass) || pass.indexOf(' ') > -1){
		alert("��й�ȣ�� ����+���� 6~12�ڸ��� �Է��� �ּ���.");
		password.focus();
	}else if(str2.test(pass)){
		alert("��й�ȣ�� �ݺ��Ǵ� ���� �� ���ڰ� �ֽ��ϴ�.");
		password.focus();
	}else if(chk_num < 0 || chk_eng < 0) {
		alert("��й�ȣ�� ���ڿ� �����ڸ� ȥ���Ͽ��� �մϴ�.");
		password.focus();
	}else{
		check = true;
	}
	return check;
}*/

// url, msg, where[sms:1, email:2]
function openPop(url, msg, whr){
	var height = whr == 1 ? 500: 800;
	var width = whr == 1 ? 589 : 1000;
	window.open(url, msg, "width="+width+", height="+height+", menubar=no, toolbar=no, location=no, resizable=yes, scrollbars=yes");
}


function setEditor(holder){
	var oEditors = [];
	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: holder,
		sSkinURI: "/smarteditor/SmartEditor2Skin.html",	
		htParams : {
			bUseToolbar : true,				// ���� ��� ���� (true:���/ false:������� ����)
			bUseVerticalResizer : true,		// �Է�â ũ�� ������ ��� ���� (true:���/ false:������� ����)
			bUseModeChanger : true,			// ��� ��(Editor | HTML | TEXT) ��� ���� (true:���/ false:������� ����)
			fOnBeforeUnload : function(){
				//alert("�ƽ�!");	
			}
		}, //boolean
		fOnAppLoad : function(){
			//���� �ڵ�
			//oEditors.getById["contents"].exec("PASTE_HTML", ["�ε��� �Ϸ�� �Ŀ� ������ ���ԵǴ� text�Դϴ�."]);
		},
		fCreator: "createSEditor2"
	});
	
	return oEditors;
}


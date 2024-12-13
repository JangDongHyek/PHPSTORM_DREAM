<?
$site_path='../../../';
include($site_path.'include/lib.inc.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>용인열쇠 모바일홈페이지</title>
<link rel="stylesheet" type="text/css" href="<?=$skin_board_url?>board.css"/>
<style type="text/css">
body {margin:0;}

#img {
	position: absolute;
	top: 0px;
	left: 0px;
}
</style>

</head>



<SCRIPT LANGUAGE="JavaScript">
<!--
var checkZIndex = true;

var dragobject = null;
var tx;
var ty;

var ie5 = document.all != null && document.getElementsByTagName != null;
var imgWidth=0;
var imgHeight=0;

function initpage() {
	if((image1.width+30)>(screen.width-5)) 
		imgWidth=screen.width-5;
	else
		imgWidth=image1.width+30;

	if((image1.height+35)>(screen.height-30)) 
		imgHeight=screen.height-30;
	else
		imgHeight=image1.height+60;

	a = 30;
/*	for(iW=150;iW<imgWidth;iW+=a)
	{
		a+=20;
		iH=iW*(imgHeight/imgWidth)
		var x=screen.width/2-iW/2;
		var y=(screen.height-30)/2-iH/2;

		self.resizeTo(iW,iH);
		self.moveTo(x,y);
	}
	var x=screen.width/2-imgWidth/2; //창을 화면 중앙으로 위치
	var y=(screen.height-30)/2-imgHeight/2; */
	var x=screen.width/2-imgWidth/2;
	var y=(screen.height-30)/2-imgHeight/2;
	self.moveTo(x,y);  
	self.resizeTo(imgWidth,imgHeight+17);
}

function getReal(el) {
	temp = el;

	while ((temp != null) && (temp.tagName != "BODY")) {
		if ((temp.className == "moveme") || (temp.className == "handle")){
			el = temp;
			return el;
		}
		temp = temp.parentElement;
	}
	return el;
}


function moveme_onmousedown() {
	el = getReal(window.event.srcElement)

	if (el.className == "moveme" || el.className == "handle") {
		if (el.className == "handle") {
			tmp = el.getAttribute("handlefor");
			if (tmp == null) {
				dragobject = null;
				return;
			}
			else
				dragobject = document.all[tmp];
		}
		else
			dragobject = el;

		if (checkZIndex) makeOnTop(dragobject);

		ty = window.event.clientY - getTopPos(dragobject);
		tx = window.event.clientX - getLeftPos(dragobject);

		window.event.returnValue = false;
		window.event.cancelBubble = true;
	}
	else {
		dragobject = null;
	}
}

function moveme_onmouseup() {
	if(dragobject) {
		dragobject = null;
	}
}


function moveme_onmousemove() {
	if (dragobject) {
		if (window.event.clientX >= 0 && window.event.clientY >= 0) {
			wx = window.event.clientX - tx;
			wy = window.event.clientY - ty;
			dragobject.style.left = wx + "px";
			dragobject.style.top = wy + "px";


//			if((wx<0) && (dragobject.style.width<self.innerWidth)) dragobject.style.left = wx + "px";
//			if(dragobject.style.width>imgWidth) dragobject.style.left = wx + "px";
//			if(wy<0 && ) dragobject.style.top = wy + "px";
//			scroll(window.event.clientX - tx,window.event.clientY - ty); 
		}
		window.event.returnValue = false;
	}
}

function getLeftPos(el) {
	if (ie5) {
		if (el.currentStyle.left == "auto")
			return 0;
		else
			return parseInt(el.currentStyle.left);
	}
	else {
		return el.style.pixelLeft;
	}
}

function getTopPos(el) {
	if (ie5) {
		if (el.currentStyle.top == "auto")
			return 0;
		else
			return parseInt(el.currentStyle.top);
	}
	else {
		return el.style.pixelTop;
	}
}

function makeOnTop(el) {
	var daiz;
	var max = 0;
	var da = document.all;

	for (var i=0; i<da.length; i++) {
		daiz = da[i].style.zIndex;
		if (daiz != "" && daiz > max)
			max = daiz;
	}

	el.style.zIndex = max + 1;
}

if (document.all) { //이 부분은 IE4 이상 버전에서만 작동됩니다.
	document.onmousedown = moveme_onmousedown;
	document.onmouseup = moveme_onmouseup;
	document.onmousemove = moveme_onmousemove;
}

document.write("<style>");
document.write(".moveme, .handle	{cursor: move;}");
document.write("</style>");

//-->
</SCRIPT>
<body onload="initpage()">
<div class="moveme" id="img" onDblClick="self.close()"><img src="../../../<?=$image?>" border=0 id=image1 title='그림 이동이 가능하고 더블클릭하면 창이 닫힙니다.' width=100%></div>
</body>
</html>

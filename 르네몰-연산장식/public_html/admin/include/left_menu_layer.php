<style type="text/css">
<!--
#watermark {position:absolute}
-->
</style>

<Script Language="JavaScript">
<!--
var isDOM = (document.getElementById ? true : false);
var isIE4 = ((document.all && !isDOM) ? true : false);
var isNS4 = (document.layers ? true : false);
var isNS = navigator.appName == "Netscape";

function getRef(id) {
		  if (isDOM) return document.getElementById(id);
		  if (isIE4) return document.all[id];
		  if (isNS4) return document.layers[id];
}

var scrollerHeight = 88;
var puaseBetweenImages = 3000;
var imageIdx = 0;

function startVScroll() { }

function moveRightEdge() {
	var yMenuFrom, yMenuTo, yOffset, timeoutNextCheck;

	if (isDOM) {
		yMenuFrom   = parseInt (divMenu.style.top, 10);
		yMenuTo     = (isNS ? window.pageYOffset : document.body.scrollTop) + 0; // 위쪽 위치
	}

	timeoutNextCheck = 500;

	if (yMenuFrom != yMenuTo) {
		yOffset = Math.ceil(Math.abs(yMenuTo - yMenuFrom) / 20);
		if (yMenuTo < yMenuFrom)
			yOffset = -yOffset;
			if (isNS4)
				divMenu.top += yOffset;
			else if (isDOM)
				divMenu.style.top = parseInt (divMenu.style.top, 10) + yOffset;

			timeoutNextCheck = 10;
	}
	
	setTimeout ('moveRightEdge()', timeoutNextCheck);
}

//-->
</Script>

<div id="divMenu" style="left:0; visibility: visible; width: 200x; position:absolute ; z-index:1"> 
  <!--//시작 : 여기에 해당 메뉴 .... -->
<?
if($left_menu == "1")
	include "../include/left_menu01.php"; 
else if($left_menu == "2")
	include "../include/left_menu02.php"; 
else if($left_menu == "3")
	include "../include/left_menu03.php"; 
//else if($left_menu == "3_1")
//	include "../include/left_menu03_1.php"; 
else if($left_menu == "4")
	include "../include/left_menu04.php"; 
else if($left_menu == "5")
	include "../include/left_menu05.php"; 
else if($left_menu == "6")
	include "../include/left_menu06.php"; 
else if($left_menu == "7")
	include "../include/left_menu07.php"; 
else if($left_menu == "8")
	include "../include/left_menu08.php"; 
else if($left_menu == "9")
	include "../include/left_menu09.php"; 
else if($left_menu == "10")
	include "../include/left_menu10.php"; 
?>
  <!--//끝 : 여기에 해당 메뉴 ... -->
</div> 

<script language="javascript">
<!--
if (isDOM) {
	var divMenu = getRef('divMenu');
	divMenu.style.top = (isNS ? window.pageYOffset : document.body.scrollTop) + 0;
	divMenu.style.visibility = "visible";
	moveRightEdge();
}
//-->
</script>
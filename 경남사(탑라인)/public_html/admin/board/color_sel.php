<HTML>
<HEAD>
<TITLE>색상 선택</TITLE>
<META http-equiv=Content-Type content="text/html; charset=ks_c_5601-1987">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<META content="MSHTML 5.50.4616.200" name=GENERATOR>
<STYLE>DIV {
	POSITION: absolute
}
TD {
	BORDER-RIGHT: #808080 1px solid; BORDER-TOP: #808080 1px solid; FONT-SIZE: 11px; BORDER-LEFT: #808080 1px solid; CURSOR: default; BORDER-BOTTOM: #808080 1px solid
}
</STYLE>

<SCRIPT>
window.onresize = new Function ("window.resizeTo(332,300);window.moveTo(200,200);");
window.onblur = new Function ("setTimeout(\"window.focus()\",300)");

var coltab = new Array(9)
coltab[0] = new Array("000000","FFFFFF","808080","c0c0c0","ff0000","008000","71bc3f","ffff00","800080","808000","000080","00ffff","00ff00","800000","008080","ff00ff")
coltab[1] = new Array("006400","191970","696969","708090","778899","00008b","0000cd","008b8b","00bfff","00ced1","00fa9a","00ff7f","00ffff","1e90ff","20b2aa","228b22")
coltab[2] = new Array("2e8b57","2f4f4f","32cd32","3cb371","40e0d0","4169e1","4682b4","483d8b","48d1cc","4b0082","556b2f","5f9ea0","6495ed","66cdaa","6a5acd","6b8e23")
coltab[3] = new Array("7b68ee","7cfc00","7fff00","7fffd4","87ceeb","87cefa","8a2be2","8b0000","8b008b","8b4513","8fbc8b","90ee90","9370db","9400d3","98fb98","9932cc")
coltab[4] = new Array("9acd32","a0522d","a52a2a","a9a9a9","add8e6","adff2f","afeeee","b0c4de","b0e0e6","b22222","b8860b","ba55d3","bc8f8f","bdb76b","c71585","cd5c5c")
coltab[5] = new Array("cd5c5c","d2691e","d2b48c","d3d3d3","d8bfd8","da70d6","daa520","db7093","dc143c","dcdcdc","dda0dd","deb887","e0ffff","e6e6fa","e9967a","ee82ee")
coltab[6] = new Array("eee8aa","f08080","f0e68c","f0f8ff","f0fff0","f0ffff","f4a460","f5deb3","f5f5dc","f5f5f5","f5fffa","f8f8ff","fa8072","faebd7","faf0e6","fafad2")
coltab[7] = new Array("fdf5e6","ff00ff","ff1493","ff4500","ff6347","ff69b4","ff7f50","ff8c00","ffa07a","ffa500","ffb6c1","ffc0cb","ffd700","ffdab9","ffdead","ffe4b5")
coltab[8] = new Array("ffe4c0","ffe4c4","ffe4e1","ffebcd","ffefd5","fff0f5","fff5ee","fff8dc","fffacd","fffaf0","fffafa","fffcfa","fffdd0","ffffe0","fffff0","fffff6")

function sel(i,j) {
	document.forms[0].val.value = coltab[i][j]
	pal.style.backgroundColor = "#"+coltab[i][j]
}
function setCol(str) {
	document.forms[0].val.value = str
	pal.style.backgroundColor = "#"+str
}
function setColor() {
	var color;
	
	color = "#" + document.forms[0].val.value;
	window.opener.document.<?echo $formname?>.<?echo $target?>.value = color;
	window.close();
}
function wincancel() {
	if (window.opener.document.all.editBox == null) {
		window.opener.focus();
	}
	else {
		window.opener.document.all.editBox.focus();
	}
	
	window.close();
}
</SCRIPT>
</HEAD>
<BODY bgColor=#FFFFFF topMargin=10
onload=document.forms[0].btn.onclick=setColor; marginheight="10"
marginwidth="10"><FONT size=2>기본 색상</FONT>
<CENTER>
<TABLE width="100%" border=0>
  <SCRIPT>
for (var j=0; j<16; j++) {
	document.write ("<TD bgcolor=\"#"+coltab[0][j]+"\" onClick=\"sel(0,"+j+")\">&nbsp;")
}
</SCRIPT>

  <TBODY></TBODY></TABLE></CENTER><FONT size=2>추가 색상</FONT>
<CENTER>
<TABLE width="100%" border=0>
  <SCRIPT>
for (var i=1; i<9; i++) {
	document.write("<TR>")
	for (var j=0; j<16; j++) {
		document.write ("<TD bgcolor=\"#"+coltab[i][j]+"\" onClick=\"sel("+i+","+j+")\">&nbsp;")
	}
}
</SCRIPT>

  <TBODY></TBODY></TABLE></CENTER>
<FORM>
<DIV id=pal
style="BORDER-RIGHT: #808080 1px solid; BORDER-TOP: #808080 1px solid; LEFT: 10px; BORDER-LEFT: #808080 1px solid; WIDTH: 24px; BORDER-BOTTOM: #808080 1px solid; TOP: 232px; HEIGHT: 25px"></DIV>
<DIV
style="BORDER-RIGHT: silver 1px ridge; PADDING-RIGHT: 2px; BORDER-TOP: silver 1px ridge; PADDING-LEFT: 2px; LEFT: 40px; PADDING-BOTTOM: 2px; BORDER-LEFT: silver 1px ridge; WIDTH: 160px; PADDING-TOP: 2px; BORDER-BOTTOM: silver 1px ridge; TOP: 232px; HEIGHT: 25px"><FONT
size=2>&nbsp;&nbsp;&nbsp;&nbsp;색상 값 : #<INPUT
style="BORDER-RIGHT: #FFFFFF 0px; BORDER-TOP: #FFFFFF 0px; BORDER-LEFT: #FFFFFF 0px; BORDER-BOTTOM: #FFFFFF 0px; BACKGROUND-COLOR: #FFFFFF"
onfocus=this.blur(); onchange=setCol(this.value) size=6 value=c0c0c0
name=val></DIV>
<DIV style="LEFT: 223px; TOP: 232px"></DIV>
<DIV style="LEFT: 140px; TOP: 262px"><INPUT onclick=setColor() type=button value="   확 인   " name=btn></DIV>
<DIV style="LEFT: 226px; TOP: 262px"><INPUT onclick=wincancel() type=button value="   취 소   "></DIV></FORM></FONT>
</BODY>
</HTML>
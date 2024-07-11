<!--
// 쇼핑몰이름
var mart_id = "W.I.C.KHAN";

//마우스 우클릭 금지
document.onmousedown = mouseRightButtonDisabled;
function mouseRightButtonDisabled(){
	if ((event.button==2) ||  (event.button==3)){
		//alert("마우스 오른쪽 버튼은 사용하실 수 없습니다");
		return false;
	}
}
document.onkeydown=KeyEventHandle;
document.onkeyup=KeyEventHandle;
function KeyEventHandle() {
        if((event.ctrlKey == true && (event.keyCode == 78 || event.keyCode == 82)) || (event.keyCode >= 112 && event.keyCode <= 123)) {
                event.keyCode = 0;
                event.cancelBubble = true;
                event.returnValue = false;
        }
}
// -->
<!--

//자주묻는질문관련 소스

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

// 이미지 주위 점선없애기 소스
function bluring(){ 
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus(); 
} 
document.onfocusin=bluring; 

//타이틀 주소 고정
try {
 //top.document.title=mart_id+'-믿을 수 있는 쇼핑몰'
}catch (Exception){
}

// 상태바 주소 감추기 소스
function hidestatus(){
	//window.status=mart_id+'-믿을 수 있는 쇼핑몰'
	//return true
}

if (document.layers)
document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT)

document.onmouseover=hidestatus
document.onmouseout=hidestatus

//새창
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//중앙에서 새창띄우는 소스
function CenterWin(url,winname,features)
{
features = features.toLowerCase();
len = features.length;
sumchar= "";
for (i=1; i <= len; i++) // 빈칸 제거
{ 
onechar = features.substr(i-1, 1);
if (onechar != " ") sumchar += onechar;
}

features = sumchar; 
sp = new Array();
sp = features.split(',', 10); // 배열에 옵션을 분리해서 입력
splen = sp.length; // 배열 갯수
for (i=0; i < splen; i++) // width, height 값을 구하기 위한 부분
{ 
if (sp[i].indexOf("width=") == 0) // width 값일때 
{ 
width = Number(sp[i].substring(6)); 
} else if (sp[i].indexOf("height=") == 0) // height 값일때
{
height = Number(sp[i].substring(7)); 
}
}
sleft = (screen.width - width) / 2;
stop = (screen.height - height) / 2;
features = features + ",left=" + sleft + ",top=" + stop;
popwin = window.open(url,winname,features); 
}

//셀렉트 대메뉴 관련 스크립트

// 년도 이동
function change_year(obj) {
	if (obj.value.length > 0) {
		location.href = obj.value;
		return;
		//document.location.href = "/portfolio/port_01.htm?search_year=" + obj.value; 
	}
	else {
		alert("선택하세요");
		return;
		//document.location.href = "/portfolio/port_01.htm"; 
	}
}

//========================== Wish List 에 추가하는 함수 ==================================
function wishlist(item_no){
	document.add.location.replace("../mypage/wishlist_add.html?item_no="+item_no);	
}

//콤마 넣기(정수만 해당) 
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

//문자열에서 숫자만 가져가기 
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
//숫자만 입력하기 
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
// -->
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->

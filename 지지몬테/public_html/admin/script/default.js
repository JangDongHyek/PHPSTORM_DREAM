<!--
// 이미지 주위 점선없애기 소스
function bluring(){ 
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus(); 
} 
document.onfocusin=bluring; 

// 상태바 주소 감추기 소스
function hidestatus(){
	window.status=''
	return true
}

function partner_info(mart_id){
	var url = "../partner/index.php?mart_id="+mart_id
	var uploadwin = window.open(url,"infowin","width=650,height=600,scrollbars=yes,status=yes, toolbar=no,navationbar=no,resizable=yes");
}


function jumpcate(url, key, value){
	if( key == "" || value == ""){
		return;
	}else{
		document.location.href = url + "?" + key + "=" + value;
	}
}

function isNumber() {
 	if ((event.keyCode<48)||(event.keyCode>57)) {
          if(event.keyCode==13){
               return;
          }else{
  	     	alert("숫자만 입력 가능합니다.\n\n다시 입력하여 주시기 바랍니다.");
     		event.returnValue=false;
          }
 	}
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

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

function trans_open(url)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=500,height=500,left=0,top=0"
	window.open(url,'trans' ,option);
}
// -->
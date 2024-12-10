function happycall1(systdate,table,handtel){
  ref = '/sms/handphone.htm?systdate='+systdate+'&seltable='+table+'&receivenum='+handtel;
  window.open(ref, 'client', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=bo,resizable=no,width=700,height=560,left=0,top=0');
}
function happycall2(systdate,table,handtel){
  ref = '../sms/handphone.htm?systdate='+systdate+'&seltable='+table+'&receivenum='+handtel;
  window.open(ref, 'client', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=bo,resizable=no,width=700,height=560,left=0,top=0');
}
function foc(){
  document.jform.searchword.value = '';
  document.jform.searchword.focus();
}
function foc1(){
  document.jform.search_str.value = '';
  document.jform.search_str.focus();
}

function showDisplay(lname) {
	document.getElementById(lname).style.display = "block";
}
//div 숨기기
function hideDisplay(lname) {
	document.getElementById(lname).style.display = "none";
}
//GIFT 보여주기
function showGift(idname,n){
  if(n == 1) showDisplay(idname);
  else hideDisplay(idname);
}
function showoption(idname){
  if(idname == 'd3907'){
    showDisplay(idname);
    showDisplay('d3907_1');
    hideDisplay('d3810');
  }else if(idname == 'd3810'){
    showDisplay(idname);
    hideDisplay('d3907');
    hideDisplay('d3907_1');
  }else{
    showDisplay('d3907');
    showDisplay('d3907_1');
    showDisplay('d3810');
  }
}

arrLinks = new Array();
arrTargets = new Array();

function AddShortcut( cKey, strLink ) {
  var nPos = -1;
  var strHREF = "";
  var strTarget = "";
  var cUpperKey = cKey;
  cUpperKey.toUpperCase();

  nPos = strLink.indexOf( " " );
  if ( nPos > 0 ) {
    strHREF = strLink.substring( 0, nPos );
    nPos = strLink.indexOf( "target=" );
    if ( nPos > 0 ) strTarget = strLink.substr( nPos + 7 );
  } else strHREF = strLink;

  arrLinks[ cUpperKey ] = strHREF;
  arrTargets[ cUpperKey ] = strTarget;
}
function OnBtnClick( strLink, strTarget ) {
  if ( strTarget && strTarget.length > 0 ) window.open( strLink, strTarget );
  else document.location = strLink;
}
function GetStrWidth( str, nUnit ) {
  var i, nCode;
  var nWidth = 0;
  if ( !str ) return 0;

  for ( i = 0 ; i < str.length; i++ ) {
    nCode = str.charCodeAt( i );
    if ( ( nCode < 0 ) || ( nCode > 127 ) ) nWidth += nUnit * 2;
    else nWidth += nUnit;
  }
  return nWidth;
}
function ForceQuote( str ) {
  var nDouble = 0;
  var ch;
  var i;

  ch = str.charCodeAt( 0 );
  if ( ( ch == 34 ) || ( ch == 39 ) ) return str;

  for ( i = 1 ; i < str.length - 1 ; i++ ) {
    ch = str.charCodeAt( i );
    if ( ch == 39 ) {
      nDouble = 1;
      break;
    }
  }
  if ( nDouble ) strQuote = "\"";
  else strQuote = "'";
  return ( strQuote + str + strQuote );
}
function GetBtnHREF( strLink ) {
  var strOnBtnClick = "";
  var nPos = -1;
  var strHREF = "";
  var strTarget = "";
  var strLow;

  strLow = strLink;
  strLow.toLowerCase();
  nPos = strLow.indexOf( "javascript:" );
  if ( nPos >= 0 ) return ForceQuote( strLink );

  nPos = strLink.indexOf( " " );
  if ( nPos > 0 ) strHREF = strLink.substring( 0, nPos );
  else strHREF = strLink;

  nPos = strLink.indexOf( "target=" );
  if ( nPos > 0 ) strTarget = strLink.substr( nPos + 7 );

  strHREF = ForceQuote( strHREF );
  strTarget = ForceQuote( strTarget );
  strOnBtnClick = "javascript:OnBtnClick( " + strHREF + " , " + strTarget + " )";
  strOnBtnClick = ForceQuote( strOnBtnClick );

  return strOnBtnClick;
}
function NeoSayTab( strBtnTitle, strLink, nWidth, nHeight, strCR, strBDCR, strCSS, cKey ) {
  var strFormat;

  if ( !strBtnTitle ) strBtnTitle = "선 택";
  if ( !strLink ) strLink = "#";

  if ( cKey ) {
    AddShortcut( cKey, strLink );
    strBtnTitle += " (" + cKey + ")";
  }

  strLink = GetBtnHREF( strLink );
  if ( !nWidth ) nWidth = GetStrWidth( strBtnTitle, 20 );
  if ( !nHeight ) nHeight = 15;
  if ( !strCR ) strCR = "#D1D1D1";
  if ( !strBDCR ) strBDCR = "black";
  if ( !strCSS ) strCSS = "tab";

  strFormat = "<table border=0 cellpadding=0 cellspacing=0 width=" + nWidth + " onmouseover=\"this.style.cursor='hand'\" onclick=" + strLink + " STYLE='table-layout:fixed'>";
  document.write( strFormat );
  strFormat = "<tr HEIGHT=1><td colspan=3 HEIGHT=1 width=3></td><td width=" + ( nWidth - 6 ) + " bgcolor=" + strBDCR + "></td><td colspan=3 width=3></td></tr>";
  document.write( strFormat );
  strFormat = "<tr HEIGHT=1><td HEIGHT=1 width=1></td><td colspan=2 width=2 bgcolor=" + strBDCR + "></td><td width=" + ( nWidth - 6 ) + " bgcolor=" + strCR + "></td><td colspan=2 width=2 bgcolor=" + strBDCR + "></td><td width=1></td></tr>";
  document.write( strFormat );
  strFormat = "<tr HEIGHT=1><td HEIGHT=1 width=1></td><td width=1 bgcolor=" + strBDCR + "></td><td colspan=3 width=" + ( nWidth - 4 ) + " bgcolor=" + strCR + "></td><td width=1 bgcolor=" + strBDCR + "></td><td width=1></td></tr>";
  document.write( strFormat );
  strFormat = "<tr HEIGHT=1><td HEIGHT=1 width=1 bgcolor=" + strBDCR + "></td><td colspan=5 width=" + ( nWidth - 2 ) + " bgcolor=" + strCR + "><table border=0 cellspacing=1 cellpadding=0><tr><td></td></tr></table> </td><td width=1 bgcolor=" + strBDCR + "></td></tr>";
  document.write( strFormat );
  strFormat = "<tr height=" + (nHeight - 5) + "><td width=1 HEIGHT=" + (nHeight - 5) + " bgcolor=" + strBDCR + "></td><td colspan=5 width=" + ( nWidth - 2 ) + " bgcolor=" + strCR + " class='" + strCSS + "' align=center><a href=" + strLink + " onclick='window.event.returnValue=false'>" + strBtnTitle + "</a></td><td width=1 bgcolor=" + strBDCR + "></td></tr>";
  document.write( strFormat );
  strFormat = "<tr HEIGHT=1><td HEIGHT=1 width=1 bgcolor=" + strBDCR + "></td><td colspan=5 width=" + ( nWidth - 2 ) + " bgcolor=" + strCR + "><table border=0 cellspacing=1 cellpadding=0><tr><td></td></tr></table> </td><td width=1 bgcolor=" + strBDCR + "></td></tr>";
  document.write( strFormat );
  document.write( "</table>" );
}
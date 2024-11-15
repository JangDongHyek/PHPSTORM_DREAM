<?ob_start();?> 
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "connect_index.php";

$url = str_replace("www.", "", $HTTP_HOST);

$SQL = "select * from domain_forward where if_confirm = '1'";
$dbresult = mysql_query($SQL, $dbconn);
if ($dbresult == false) echo "쿼리 실행 실패!";
$numRows = mysql_num_rows($dbresult);
if($numRows > 0){
	$mart_id = mysql_result($dbresult, 0, "mart_id");
	$title = mysql_result($dbresult, 0, "title");
	$keywords = mysql_result($dbresult, 0, "keywords");
	$description = mysql_result($dbresult, 0, "description");
	$info_meta1 = mysql_result($dbresult, 0, "info_meta1");
}
if( $mart_id == "" ){
	$frame_src = "/";
}else{
	$frame_src = "$home_dir/market/main/";
}


$path = "admin/log";
$counter = "daylife";
include "$path/nalog.php";

?>
<!DOCTYPE HTML>
<html>
<head>

<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
    if(!wcs_add) var wcs_add = {};
     wcs_add["wa"] = "s_49cee49e4652";
     wcs.inflow("elflower.co.kr");
	 wcs_do();
 </script>
 

 <!--AceCounter-Plus Log Gathering for AceTag Manager V.9.2.20170103>
<script type="text/javascript">
var _AceTM = (function (_j, _s, _b, _o, _y) {
	var _uf='undefined',_pmt='',_lt=location;var _ap = String(typeof(_y.appid) != _uf ? _y.appid():(isNaN(window.name))?0:window.name);var _ai=(_ap.length!=6)?(_j!=0?_j:0):_ap;if(typeof(_y.em)==_uf&&_ai!=0){var _sc=document.createElement('script');var _sm=document.getElementsByTagName('script')[0];
	var _cn={tid:_ai+_s,hsn:_lt.hostname,hrf:(document.referrer.split('/')[2]),dvp:(typeof(window.orientation)!=_uf?(_ap!=0?2:1):0),tgp:'',tn1:_y.uWorth,tn2:0,tn3:0,tw1:'',tw2:'',tw3:'',tw4:'',tw5:'',tw6:'',tw7:_y.pSearch};_cn.hrf=(_cn.hsn!=_cn.hrf)?_cn.hrf:'in';for(var _aix in _y){var _ns=(_y[_aix])||{};
	if(typeof(_ns)!='function'){_cn.tgp=String(_aix).length>=3?_aix:'';_cn.tn2=_ns.pPrice;_cn.tn3=_ns.bTotalPrice;_cn.tw1=_ns.bOrderNo;_cn.tw2=_ns.pCode;_cn.tw3=_ns.pName;_cn.tw4=_ns.pImageURl;_cn.tw5=_ns.pCategory;_cn.tw6=_ns.pLink;break;};};_cn.rnd=(new Date().getTime());for(var _alx in _cn){
	var _ct=String(_cn[_alx]).substring(0,128);_pmt+=(_alx+"="+encodeURIComponent((_ct!=_uf)?_ct:'')+"&");};_y.acid=_ai;_y.atid=_cn.tid;_y.em=_cn.rnd;_sc.src=((_lt.protocol.indexOf('http')==0?_lt.protocol:'http:')+'//'+_b+'/'+_o)+'?'+_pmt+'py=0';_sm.parentNode.insertBefore(_sc,_sm);};return _y;
})(127793,'CT-50-A', 'atm.acecounter.com','ac.js',window._AceTM||{});
</script>
<!--AceCounter-Plus Log Gathering for AceTag Manager End -->


<!-- Mirae Log Analysis Script Ver 1.0   >
<script TYPE="text/javascript">
var mi_adkey = "oisch";
var mi_is_defender = "";
var mi_date = parseInt(new Date().toISOString().slice(0,13).replace(/-/g,"").replace(/t/gi,"").replace(/:/gi,""))+Math.abs(new Date().getTimezoneOffset()/60) ;
var mi_script = "<scr"+"ipt "+"type='text/javascr"+"ipt' src='//log1.toup.net/mirae_log.js?t="+mi_date+"' async='true'></scr"+"ipt>"; 
document.writeln(mi_script);
</script>
<!-- Mirae Log Analysis Script END  -->




<title><?=$title?></title>
<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="naver-site-verification" content="9bb018cca9e09d2a32f7e4d16976aed58ac7abc0"/>
<meta http-equiv="refresh" content="0; url=./market/main/index.html">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<meta name='description' content='<?=$description?>'>
<meta name='keywords' content='<?=$keywords?>'>
<!-- #endif -->
<?=$info_meta1?>


<script type="text/javascript">
var ua = window.navigator.userAgent.toLowerCase();
if ( /iphone/.test(ua) || /android/.test(ua) || /opera/.test(ua) || /bada/.test(ua) ) {
document.location.replace('http://www.elflower.co.kr/mobile/index.html');
}
</script>
</head>
</html>

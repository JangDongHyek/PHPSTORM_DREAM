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
<html>
<head>
<title><?=$title?></title>
<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<!-- #if expr="$HTTP_USER_AGENT=/^Mozilla/" --><!--#else -->
<!--meta name='description' content='<?=$description?>'-->
<meta name='keywords' content='<?=$keywords?>'>



<!--네이버 사이트등록-->
<link rel="canonical" href="http://www.신한사물함.kr/"/> 
<meta name="naver-site-verification" content="ad00fc49d053c02d3d842c64a23fcf4e3673d853"/>
<meta name="description" content="골프락카, 사우나, 목욕탕, 옷장, 헬스장, 학교, 수영장, 신발장, 사물함, 병원가구, 사무용가구점, 대할인, 전국공장운영, 무료배송(골프장,워터파크,대형공사전문)">
<meta property="og:type" content="website">
<meta property="og:title" content="신한사물함">
<meta property="og:description" content="골프락카, 사우나, 목욕탕, 옷장, 헬스장, 학교, 수영장, 신발장, 사물함, 병원가구, 사무용가구점, 대할인, 전국공장운영, 무료배송(골프장,워터파크,대형공사전문)">
<meta property="og:image" content="http://www.신한사물함.kr/market/images/start_01.gif/">
<meta property="og:url" content="http://www.신한사물함.kr/">

<!--네이버 사이트등록-->



<!-- #endif -->
<?=$info_meta1?>


<!-- AceCounter Log Gathering Script V.8.0.2019080601 -->
<script language='javascript'>
	var _AceGID=(function(){var Inf=['gtb20.acecounter.com','8080','BI3A47477099599','AW','0','NaPm,Ncisy','ALL','0']; var _CI=(!_AceGID)?[]:_AceGID.val;var _N=0;var _T=new Image(0,0);if(_CI.join('.').indexOf(Inf[3])<0){ _T.src ="https://"+Inf[0]+'/?cookie'; _CI.push(Inf);  _N=_CI.length; } return {o: _N,val:_CI}; })();
	var _AceCounter=(function(){var G=_AceGID;var _sc=document.createElement('script');var _sm=document.getElementsByTagName('script')[0];if(G.o!=0){var _A=G.val[G.o-1];var _G=(_A[0]).substr(0,_A[0].indexOf('.'));var _C=(_A[7]!='0')?(_A[2]):_A[3];var _U=(_A[5]).replace(/\,/g,'_');_sc.src='https:'+'//cr.acecounter.com/Web/AceCounter_'+_C+'.js?gc='+_A[2]+'&py='+_A[4]+'&gd='+_G+'&gp='+_A[1]+'&up='+_U+'&rd='+(new Date().getTime());_sm.parentNode.insertBefore(_sc,_sm);return _sc.src;}})();
</script>
<!-- AceCounter Log Gathering Script End -->



<!-- LOGGER(TM) TRACKING SCRIPT V.40 FOR logger.co.kr / 101313 : COMBINE TYPE / DO NOT ALTER THIS SCRIPT. 20181029 -->
<script type="text/javascript">var _TRK_LID = "101313";var _L_TD = "ssl.logger.co.kr";var _TRK_CDMN = "";</script>
<script type="text/javascript">var _CDN_DOMAIN = location.protocol == "https:" ? "https://fs.bizspring.net" : "http://fs.bizspring.net"; 
(function (b, s) { var f = b.getElementsByTagName(s)[0], j = b.createElement(s); j.async = true; j.src = '//fs.bizspring.net/fs4/bstrk.1.js'; f.parentNode.insertBefore(j, f); })(document, 'script');
</script>
<noscript><img alt="Logger Script" width="1" height="1" src="http://ssl.logger.co.kr/tracker.1.tsp?u=101313&amp;js=N"/></noscript>
<!-- END OF LOGGER TRACKING SCRIPT -->


</head>

<frameset rows='0,*' border=0 framespacing=0 frameborder=0>
<frame name='blank' src='blank.html' marginwidth='0' marginheight='0' scrolling='no' frameborder='no'>
<frame name='content1' src='<?=$frame_src?>'  marginwidth='0' marginheight='0' scrolling='auto' frameborder='no'>
</frameset><noframes></noframes>
</html>
<?
mysql_close($dbconn);
?>

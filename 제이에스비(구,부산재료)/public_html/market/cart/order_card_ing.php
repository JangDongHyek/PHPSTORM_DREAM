<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

$SQL = "select * from $MemberTable where mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$perms = mysql_result($dbresult, 0, "perms");
if($perms == "4") {
	echo ("		
	<script>
		alert('미등록 쇼핑몰입니다.');
		history.go(-1);
	</script>
	");
	exit;
}

include( '../include/getmartinfo.php' );

if(strstr($icon_module,"icon12")!=false) include('../include/head_template6.inc');
else include('../include/head_alltemplate.inc');
?>
<script langauage="Javascript">
<!-- 
  function hidestatus(){ 
  window.status='' 
  return true 
  } 

  if (document.layers) 
  document.captureEvents(Event.MOUSEOVER | Event.MOUSEOUT) 

  document.onmouseover=hidestatus 
  document.onmouseout=hidestatus 
//--> 
</script> 
<?
if(strstr($icon_module,"icon7")!=false) include( '../include/topmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/topmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/topmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/topmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/topmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) include( '../include/topmenu_template6.inc' );

if(strstr($icon_module,"icon7")!=false) include( '../include/leftmenu.inc' );
if(strstr($icon_module,"icon8")!=false) include( '../include/leftmenu_template2.inc' );
if(strstr($icon_module,"icon9")!=false) include( '../include/leftmenu_template3.inc' );
if(strstr($icon_module,"icon10")!=false) include( '../include/leftmenu_template4.inc' );
if(strstr($icon_module,"icon11")!=false) include( '../include/leftmenu_template5.inc' );
if(strstr($icon_module,"icon12")!=false) {
?>
<!--검색부분-->
<table width="990" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
  <form name=search onsubmit='return frm_search(this)' action='../product/search.php'>
	<input type=hidden name='search_type' value='item'>
	<input type=hidden name='mart_id' value='<?echo $mart_id?>'>
	<tr>
    <td width="30" height="30">&nbsp;</td>
    <td width="500" background="../images/template6/image/top/search_bg.gif" class="text_left"><img src="../images/template6/image/nevigation_icon.gif" width="17" height="14" align="absmiddle">
    홈 &gt; 주문서 작성
    </td>
    <td width="460" align="right" background="../images/template6/image/top/search_bg.gif" class="text_right"><input name="itemname" type="text" class="input_search">
        <a href='javascript:document.search.submit()'><img src="../images/template6/image/top/bu_search.gif" width="56" height="22" border="0" align="absmiddle"></a></td>
  </tr>
  </form>
  <tr>
    <td height="10" colspan="3" ></td>
  </tr>
</table>
<!--검색부분끝-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30">&nbsp;</td>
    <td width="960">
   <!--타이들이미지 시작-->
   <table width="960" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td background="../images/template6/image/product/title_bg.gif"><img src="../images/template6/image/product/title_1.gif" width="130" height="40"><img src="../images/template6/image/product/title_type.gif" width="180" height="40"></td>
     </tr>
  </table>
  <!--타이들이미지  끝-->
  <table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
<?
	include( '../include/leftmenu_template6.inc' );
}
?>	<td width="609" valign="top" bgcolor='#ffffff'>
    	<div align="center"><center>
    	
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%"><img src="../images/pay_ing.gif" WIDTH="122" HEIGHT="27"></td>
      	</tr>
      	<tr>
        	<td width="100%">
<?
if($ti_line_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_line_img")){
	echo "	
<img src='$Co_img_DOWN$mart_id/design2/$ti_line_img' WIDTH='571' HEIGHT='12'>
	";
}
else{
	echo "
<img src='../images/line.gif' WIDTH='571' HEIGHT='12'>
	";
}
?>
        	</td>
      	</tr>
      	<tr>
        	<td width="100%" height="20"><span class="aa"></span></td>
      	</tr>
      	<tr>
        	<td width="100%">
        		<div align="center"><center>
        		<table cellspacing="1" background="../images/dot2.gif" width="75%" border="0">
          		<tr>
            		<td bgcolor="#FFFFFF" valign="top"><p align="center"><br>
            			<br>
            			<span class="bb">확인을 누르십시오.</span><strong><span class="zz"><br>
            			<br><br>
            			</span></strong>
            		</td>
          		</tr>
				<form name='FormA'  method='post' action='https://www.kointek.com/servlet/EcpayOrder' target='POPWIN' onsubmit="return OpenWindow()">
				<!-- 결제를 위한 필수 hidden정보 -->
				<input type='hidden' name='ShopID' value='TT01'> <!-- 상점 아이디를 수정 하는 곳입니다 //-->
				<input type='hidden' name='OrderID' value='<?=$OrderID ?>'>
				<input type='hidden' name='Amount' value='<?=$Amount ?>'>
				<input type='hidden' name='Ret_URL' value='<?=$Ret_URL ?>'>
				<input type='hidden' name='Name' value='<?=$Name ?>'>
				<input type='hidden' name='Good' value='<?=$Good ?>'>
				<tr>
                    <td height="20" colspan="4" bgcolor="#FFFFFF"><center><BR><input Type="image" src="http://dgway.co.kr/file_manager/dgway/member/bu_ok.gif" border="0"><BR><BR></center></td>
                </tr>
				</form>
        		</table>
        		</center></div>
        	</td>
      	</tr>
    	</table>
    	</center></div>
    </td>
</tr>
</table>
<script>
function OpenWindow(){   	
var winopts = "width=570,height=470,  toolbar=no, status=no, statusbar=no, menubar=no, scrollbars=yes";
var popWindow = window.open('','POPWIN', winopts);
}
</script>
<?
include( '../include/bottom.inc' );
?>
</body>
</html>
<?
mysql_close($dbconn);
?>
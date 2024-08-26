<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
include( '../include/getmartinfo.inc' );
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<title><?=$page_title?></title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
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
</head>

<body topmargin="0" bgcolor="#FFFFFF" link="#B9B6BD" vlink="#B9B6BD" alink="#B9B6BD">

<table border="0" width="610" cellspacing="0" cellpadding="0" height="100%">
<tr>
    <td width="609" valign="top">
    	<div align="center"><center>
    	<table border="0" width="500">
      	<tr>
        	<td width="100%" height="15"></td>
      	</tr>
      	<tr>
        	<td width="100%">
        	<?
        	if($ti_com_intro_img != '' && file_exists("$Co_img_UP$mart_id/design2/$ti_com_intro_img")){
        		echo "	
        	<img src='$Co_img_DOWN$mart_id/design2/$ti_com_intro_img' WIDTH='89' HEIGHT='27'>
        		";
        	}
        	else{
        		echo "
        	<img src='../images/company-title.gif' WIDTH='89' HEIGHT='27'>
        		";
        	}
        	?>
        	</td>
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
        	<td width="100%" height="10"><span class="aa"></span></td>
      	</tr>
      	<?
      	if($intro_type == 1){
		?>
		<tr>
		    <td width="572"><p style="padding-left: 10px">
		    	<img height="173" src='<?=$Co_img_DOWN$mart_id/intro_img/$attach?>' width="154" align="left" hspace="5">
		    	<?=$help?>
		    </td>
		</tr>
		<tr>
		    <td width="576"></td>
		</tr>
		<tr>
		    <td width="576" height="20"></td>
		</tr>
		<tr>
		    <td width="576">
		    	<img src="../images/map.gif" hspace="10" WIDTH="128" HEIGHT="20"></td>
		</tr>
		<tr>
		    <td width="576"><p align="center"><br>
		    	<img src='<?=$Co_img_DOWN$mart_id/intro_img/$attach1?>' WIDTH="450" HEIGHT="350"></td>
		</tr>
		<?
		}
		if($intro_type == 2){
		?>
		<tr>
		    <td width="572">
		    	<?=$help?>
		    </td>
		</tr>
		<?
		}
		?>
		
    	</table>
    	</center></div>
    </td>
</tr>
<tr>
    <td width="610" valign="top" colspan="3" height="20">
    </td>
</tr>
<tr>
    <td width="610" valign="top" colspan="3" height="40"><center>
        <input class="aa" onclick='window.close()' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="창닫기"> 
		</center>
	</td>
</tr>
</table>
</body>
</html>
<?
mysql_close($dbconn);
?>